<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class mainController extends AbstractController{
    /**
     * @Route("/landPage", name="landPage" , methods={"GET"})
     */
    public function landPage()
    {          
       
        return $this->render('landPage.html.twig');
        
    }  

    /**
     * @Route("/login", name="loginPost", methods={"POST"})
     */
    public function loginPost(Request $request, SessionInterface $session)
    {   
        $email = $request->request->get('email');  
        $password = $request->request->get('password');  

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('App\Entity\Usuario')->findOneBy(['email'=>$email, 'password'=>md5($password)]);
        if( $user !=null ) {
            // Login exitoso
            $session->set('user', $user);
            $pedido = new \App\Entity\Pedido();
            $pedido->setIdPedido(rand(1,10000));
            $pedido->setFecha(new \DateTime());
            $pedido->setDNI_pedido($user);


            $session->set('pedido', $pedido);
            return $this->redirectToRoute('landPage');
        }
        else {
            // Login erroneo
            return $this->redirectToRoute('login', ['error'=>'auth']);    //  /login?error=auth
        }
    } 
    
     /**
     * @Route("/login", name="login", methods={"GET"})
     */
    public function login(Request $request)
    {   
        return $this->render('inicioSesion.html.twig', []);
    }  

    /**
     * @Route("/logOut", name="logOut", methods={"POST"})
     */
    public function logOut(Request $request, SessionInterface $session)
    {   
        $session->set('user', null);
        if($session->has('pedido')){
            $session->remove('pedido');
        }
        if($session->has('alquiler')){
            $session->remove('alquiler');
        }
        if($session->has('compra')){
            $session->remove('compra');
        }
        if($session->has('reparacion')){
            $session->remove('reparacion');
        }
        return $this->redirectToRoute('landPage');
    }  

    /**
     * @Route("/compra", name="compra", methods={"GET","POST"})
     */
    public function compra(Request $request, SessionInterface $session)
    {      
        $allArticles = $this->mostrarAllArticles();
        return $this->render('compra.html.twig', ['allArticles'=>$allArticles]);
    }  
    /**
     * @Route("/mostrarAllArticles", name="mostrarAllArticles", methods={"GET","POST"})
     */
    public function mostrarAllArticles()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\Almacen')->findAll();
        
    }

    function buscarArticulo($nombre)
    {
        $em = $this->getDoctrine()->getManager();
        $articulo = $em->getRepository('App\Entity\Articulos')->findOneBy(['nombre'=>$nombre]);
        $almacen = $em->getRepository('App\Entity\Almacen')->findOneBy(['idArticulo'=>$articulo]);
        return $almacen;
    }

    /**
     * @Route("/modificarStock", name="modificarStock", methods={"GET","POST"})
     */
    function modificarStock(Request $request){
        $error = '';
        $almacen = $this->buscarArticulo($request->query->get('nombre'));
        $pagina =$request->query->get('pagina');
        if( $almacen==null ) {
            $error = 'No existe el articulo';
        } 
        else {
            $completado = $this->modificarStockDB($almacen, $request->query->get('cantidad'));
            if( $completado ) {
                $error = '';
                
                //header("Location: $pagina.php");

            } else {
                $error = 'Error al eliminar el articulo';
                $pagina = $pagina."?error=".$error;
                //header("Location: $pagina.php?error=$error");
            }
        }  
        return $this->redirectToRoute($pagina);
    }

    function modificarStockDB($almacen, $cantidad)
    {
        $completado = false;
        $em = $this->getDoctrine()->getManager();
        $almacen->setCantidad($cantidad);
        try {
            $em->persist($almacen);
            $em->flush();
            $completado = true;
        }catch(\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        return $completado;
    }
    /**
     * @Route("/eliminarArticulo", name="eliminarArticulo", methods={"GET","POST"})
     */
    function eliminarArticulo(Request $request){
        $error = '';
        $almacen = $this->buscarArticulo($request->query->get('nombre'));
        $pagina =$request->query->get('pagina');
        
        if( $almacen==null ) {
            $error = 'No existe el articulo';
        } 
        else {
            $completado = $this->modificarStockDB($almacen, 0);
            if( $completado ) {
                $error = '';
                
                //header("Location: $pagina.php");

            } else {
                $error = 'Error al eliminar el articulo';
                $pagina = $pagina."?error=".$error;
                //header("Location: $pagina.php?error=$error");
            }
        }  
        return $this->redirectToRoute($pagina);
    }

    /**
     * @Route("/alquiler", name="alquiler", methods={"GET","POST"})
     */
    public function alquiler(Request $request, SessionInterface $session)
    {      
        $allArticles = $this->mostrarAllArticles();
        return $this->render('alquiler.html.twig', ['allArticles'=>$allArticles]);
    } 
    
    /**
     * @Route("/pedidos", name="pedidos", methods={"GET","POST"})
     */
    public function pedidos(Request $request, SessionInterface $session)
    {    
        
            $allAlquileres = $this->mostrarAllAlquileres();
            $allCompras = $this->mostrarAllCompras();
            $allReparaciones = $this->mostrarAllReparaciones();
            return $this->render('pedidos.html.twig', ['allAlquileres'=>$allAlquileres, 'allCompras'=>$allCompras, 'allReparaciones'=>$allReparaciones]);
        
        
            
        
    } 

    /**
     * @Route("/mostrarAllArticles", name="mostrarAllArticles", methods={"GET","POST"})
     */
    public function mostrarAllAlquileres()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\AlquilerArticulo')->findAll();
        
    }

    /**
     * @Route("/mostrarAllPedidos", name="mostrarAllPedidos", methods={"GET","POST"})
     */
    public function mostrarAllPedidos()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\Pedido')->findAll();
        
    }

    /**
     * @Route("/createPedido", name="createPedido", methods={"GET","POST"})
     */
    public function createPedido()
    {    
        $em = $this->getDoctrine()->getManager();
        
    

        $user = $em->getRepository('App\Entity\Usuario')->findOneBy(['email'=>"trabajador@gmail.com"]);
        $completado = false;
        
        
        $newArticulo = new \App\Entity\Pedido();
        $newArticulo->setIdPedido(rand(1,10000));
      
        $newArticulo->setDNI_pedido($user);
        

        try {
            
            $em->persist($newArticulo);
            
            $em->flush();
 
            $completado=true;
        }catch(\Exception $ex) {
            // Error de base de datos
            $completado = false;
            echo $ex->getMessage();
            exit;
        }

        
        return $completado;

        }

     /**
     * @Route("/mostrarAllCompras", name="mostrarAllCompras", methods={"GET","POST"})
     */
    public function mostrarAllCompras()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\CompraArticulo')->findAll();
        
    }

    /**
     * @Route("/mostrarAllReparaciones", name="mostrarAllReparaciones", methods={"GET","POST"})
     */
    public function mostrarAllReparaciones()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\ReparacionArticulo')->findAll();
        
    }
    
    /**
     * @Route("/mostrarAllReparaciones", name="mostrarAllReparaciones", methods={"GET","POST"})
     */
    public function mostrarAllReparaciones2()
    {    
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('App\Entity\ReparacionArticulo')->findAll();
        
    }

    /**
     * @Route("/deleteAlquiler", name="deleteAlquiler", methods={"GET","POST"})
     */
    public function deleteAlquiler(Request $request, SessionInterface $session)
    {    
        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('uid');

        $item = $em->getRepository('App\Entity\AlquilerArticulo')->findOneBy(['idAlquiler'=>$id]);
        $em->remove($item);
        try {
            $em->flush();
        }
        catch(\Exception $ex) {
           
        }   
        return $this->redirectToRoute('pedidos');
    }

    /**
     * @Route("/deleteCompra", name="deleteCompra", methods={"GET","POST"})
     */
    public function deleteCompra(Request $request, SessionInterface $session)
    {    
        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('uid');

        $item = $em->getRepository('App\Entity\CompraArticulo')->findOneBy(['idCompra'=>$id]);
        $em->remove($item);
        try {
            $em->flush();
        }
        catch(\Exception $ex) {
           
        }   
        return $this->redirectToRoute('pedidos');

        
    }
    /**
     * @Route("/deleteReparacion", name="deleteReparacion", methods={"GET","POST"})
     */
    public function deleteReparacion(Request $request, SessionInterface $session)
    {    
        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('uid');

        $item = $em->getRepository('App\Entity\ReparacionArticulo')->findOneBy(['idReparacion'=>$id]);
        $em->remove($item);
        try {
            $em->flush();
        }
        catch(\Exception $ex) {
           
        }   
        return $this->redirectToRoute('pedidos');

        
    }

    /**
     * @Route("/carrito", name="carrito", methods={"GET","POST"})
     */
    public function carrito(Request $request, SessionInterface $session)
    {    

        
        return $this->render('carrito.html.twig');
        
    }

    /**
     * @Route("/createAlquiler", name="createAlquiler", methods={"GET","POST"})
     */
    public function createAlquiler(Request $request, SessionInterface $session)
    {    
        
        $em = $this->getDoctrine()->getManager();
        $id= rand(1,10000);
        $nombre = $request->query->get('nombre');
        $fInicio = $request->query->get('fInicio');
        $fFinal = $request->query->get('fFin');

        $item = $em->getRepository('App\Entity\Articulos')->findOneBy(['nombre'=>$nombre]);
        
        $pedido = $session->get('pedido');
        $newAlquiler = new \App\Entity\AlquilerArticulo;

        
        $fecha1= date_create($fInicio);
        $fecha2= date_create($fFinal);
        $diff = date_diff($fecha1, $fecha2);
        //$diff = $fecha1->diff($fecha2);

        $dias = $diff->format('%a');
        //$dias = $diff->days;
        $coste = $dias * ($item->getPrecioAlquiler());
       
        $newAlquiler->setIdAlquiler($id);
        $newAlquiler->setFInicio(new \DateTime($fInicio));
        $newAlquiler->setFFinal(new \DateTime($fFinal));
        $newAlquiler->setIdPedido($pedido);
        $newAlquiler->setIdArticulo($item);
        $newAlquiler->setIdAlquiler($id);
        $newAlquiler->setPrecioTotal($coste);


        if ($session->has('alquiler')){
            $alquileres = $session->get('alquiler', []);
            $alquileres[]=$newAlquiler;
            $session->set('alquiler', $alquileres);
        }
        else{
            $alquileres = array($newAlquiler);
            $session->set('alquiler', $alquileres);
        }
        
        
        return $this->redirect('alquiler');
        
    }

    /**
     * @Route("/createCompra", name="createCompra", methods={"GET","POST"})
     */
    public function createCompra(Request $request, SessionInterface $session)
    {    
        $em = $this->getDoctrine()->getManager();
        $id= rand(1,10000);
        $nombre = $request->query->get('nombre');

        $item = $em->getRepository('App\Entity\Articulos')->findOneBy(['nombre'=>$nombre]);
        
        $pedido = $session->get('pedido');
        $newCompra = new \App\Entity\CompraArticulo;
       
        $newCompra->setIdCompra($id);
        $newCompra->setIdPedido($pedido);
        $newCompra->setIdArticulo($item);


        if ($session->has('compra')){
            $compras = $session->get('compra', []);
            $compras[]=$newCompra;
            $session->set('compra', $compras);
        }
        else{
            $compras = array($newCompra);
            $session->set('compra', $compras);
        }
        
        
        return $this->redirect('compra');
        
    }

    /**
     * @Route("/createReparacion", name="createReparacion", methods={"GET","POST"})
     */
    public function createReparacion(Request $request, SessionInterface $session)
    {    
        
        $em = $this->getDoctrine()->getManager();
        $id= rand(1,10000);
        $nombre = $request->query->get('nombre');
        $tipo = $request->query->get('tipo');

        $item = $em->getRepository('App\Entity\Articulos')->findOneBy(['nombre'=>$nombre]);
        
        
        $pedido = $session->get('pedido');
        $newReparacion = new \App\Entity\ReparacionArticulo;
       
        $newReparacion->setIdReparacion($id);
        $newReparacion->setTipoReparacion($tipo);
        $newReparacion->setIdArticulo($item);
        $newReparacion->setIdPedido($pedido);
        


        if ($session->has('reparacion')){
            $reparacion = $session->get('reparacion', []);
            $reparacion[]=$newReparacion;
            $session->set('reparacion', $reparacion);
        }
        else{
            $reparacion = array($newReparacion);
            $session->set('reparacion', $reparacion);
        }
        
        
        return $this->redirect('reparacion');
        
    }


    /**
     * @Route("/realizarPago", name="realizarPago", methods={"GET","POST"})
     */
    public function realizarPago(Request $request, SessionInterface $session)
    {    
        
        $em = $this->getDoctrine()->getManager();
        $completado = false;
        
        if(($session->get('user')->getTarjeta() != null) && ($session->get('user')->getDireccion() != null) ){
            $importeTotal = 0;
            $pedido = $session->get('pedido');
            
            try {
                $em->merge($pedido);
                $em->flush();
                
            }catch(\Exception $ex) {
                echo $ex->getMessage();
                exit;
            }
            if($session->has('alquiler')){
                foreach($session->get('alquiler') as $alquiler){
                    $importeTotal = $importeTotal + $alquiler->getPrecioTotal();
                    try {
                        $em->merge($alquiler);
                        $idArticulo = $alquiler->getIdArticulo();
                        $almacen = $em->getRepository('App\Entity\Almacen')->findOneBy(['idArticulo'=>$idArticulo]);
                        $almacen->setCantidad($almacen->getCantidad()-1);
                        $em->persist($almacen);
                        $em->flush();
                    }catch(\Exception $ex) {
                        echo $ex->getMessage();
                        exit;
                    }
                }
            }
            if($session->has('compra')){
                foreach($session->get('compra') as $compra){
                    $importeTotal = $importeTotal + $compra->getIdArticulo()->getPrecio();
                    try {
                        $em->merge($compra);
                        $idArticulo = $compra->getIdArticulo();
                        $almacen = $em->getRepository('App\Entity\Almacen')->findOneBy(['idArticulo'=>$idArticulo]);
                        $almacen->setCantidad($almacen->getCantidad()-1);
                        $em->persist($almacen);
                        $em->flush();
                    }catch(\Exception $ex) {
                        echo $ex->getMessage();
                        exit;
                    }
                }
            }

            if($session->has('reparacion')){
                foreach($session->get('reparacion') as $reparacion){
                    $importeTotal = $importeTotal + ($reparacion->getIdArticulo()->getPrecio())*0.5;
                    try {
                        $em->merge($reparacion);
                        $idArticulo = $reparacion->getIdArticulo();
                        $em->flush();
                    }catch(\Exception $ex) {
                        echo $ex->getMessage();
                        exit;
                    }
                }
            }

            
            $newFactura =  new \App\Entity\Factura;
            $id = rand(1, 100000);
            
            $newFactura->setIdFactura($id);
            $newFactura->setImporteTotal($importeTotal);
            $newFactura->setIdPedido($pedido);

            try {
                $em->merge($newFactura);
                $em->flush();
                $completado = true;
                $pedido = new \App\Entity\Pedido();
                $pedido->setIdPedido(rand(1,10000));
                $pedido->setFecha(new \DateTime());
                $pedido->setDNI_pedido($session->get('user'));
                $session->set('pedido', $pedido);
                if($session->has('alquiler')){
                    $session->remove('alquiler');
                }
                if($session->has('compra')){
                    $session->remove('compra');
                }
                if($session->has('reparacion')){
                    $session->remove('reparacion');
                }
               

            }catch(\Exception $ex) {
                echo $ex->getMessage();
                exit;
            }

            

        }
        
        return $this->render('pago.html.twig', ['completado'=>$completado]);
        
    }

    /**
     * @Route("/reparacion", name="reparacion", methods={"GET","POST"})
     */
    public function reparacion(Request $request, SessionInterface $session)
    {      
        $allArticles = $this->mostrarAllArticles();
        return $this->render('reparacion.html.twig', ['allArticles'=>$allArticles]);
    }  

    /**
     * @Route("/registro", name="registro", methods={"GET","POST"})
     */
    public function registro(Request $request, SessionInterface $session)
    {      
        //user_add($nombre, $apellido, $email, $DNI, $password, $rol, &$error)


        return $this->render('registro.html.twig');
    }  

    /**
     * @Route("/createUser", name="createUser", methods={"GET","POST"})
     */
    public function createUser(Request $request, SessionInterface $session)
    {      
        $error = '';
        $rol = 'cliente';

        $em = $this->getDoctrine()->getManager();
        $user = new \App\Entity\Usuario();
        $user->setNombre($request->request->get('nombre'));
        $user->setDNI($request->request->get('DNI'));
        $user->setApellido($request->request->get('apellido'));
        $user->setEmail($request->request->get('email'));
        $user->setPassword(md5($request->request->get('password')));
        $user->setRol($rol);

        try {
            $em->persist($user);
            $em->flush();
            $completado = true;
            return $this->redirect('login');
        }catch(\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        return $this->redirect('registro');
    }  

    /**
     * @Route("/editProfile", name="editProfile", methods={"GET","POST"})
     */
    public function editProfile(Request $request, SessionInterface $session)
    {      
        return $this->render('editProfile.html.twig');
    }  

    /**
     * @Route("/editUsuario", name="editUsuario", methods={"GET","POST"})
     */
    public function editUsuario(Request $request, SessionInterface $session)
    {      
        $error = '';
        $rol = 'cliente';

        $em = $this->getDoctrine()->getManager();
        /*
        if(!empty($session->get('user')->getDNI())!= !empty($request->request->get('DNI'))){
            $session->get('user')->setDNI() = $request->request->get('DNI');
        }
        if($session->get('user')->getNombre()!= $request->request->get('nombre')){
            $session->get('user')->setNombre() = $request->request->get('nombre');
        }
        if($session->get('user')->getApellido()!= $request->request->get('apellido')){
            $session->get('user')->setApellido() = $request->request->get('apellido');
        }
        if($session->get('user')->getEmail()!= $request->request->get('email')){
            $session->get('user')->setEmail() = $request->request->get('email');
        }
        if($session->get('user')->getPassword() != md5($request->request->get('password'))){
            $session->get('user')->setPassword() = md5($request->request->get('password'));
        }
        if($session->get('user')->getTarjeta() != $request->request->get('tarjeta')){
            $session->get('user')->setTarjeta() = $request->request->get('tajeta');
        }
        if($session->get('user')->getTelefono() != $request->request->get('telefono')){
            $session->get('user')->setTelefono() = $request->request->get('telefono');
        }
        if($session->get('user')->getDireccion() != $request->request->get('direccion')){
            $session->get('user')->setDireccion() = $request->request->get('direccion');
        }

        try {
            $em->merge($session->get('user'));
            $em->flush();
            $completado = true;
            return $this->redirect('landPage');
        }catch(\Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        */
        return $this->redirect('registro');
    }  
       





    
} 


