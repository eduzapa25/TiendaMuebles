<?php
    require_once("bootstrap.php");

    // select * from users
    //$usuario = $em->getRepository("\\Model\\Entity\\Usuario")->findOneBy(['nombre'=>'pepe']);
    //$usuario = $em->getRepository("\\Model\\Entity\\Usuario")->findAll();
    //$newf = new \Model\Entity\Articulos();
    //$allUsers = $em->getRepository("\\Model\\Entity\\Articulos")->find(0);
    /*
    select * from users where id = 1
    $user1 = $em->getRepository("\\Model\\Entity\\User")->find(1);
    // select * from users where username='admin'
    $users = $em->getRepository("\\Model\\Entity\\User")->findBy(['username'=>'admin']);        // array con 1 elemento
    $user2 = $em->getRepository("\\Model\\Entity\\User")->findOneBy(['username'=>'admin']);     // objeto User
    
    // Metodos custom de repositorio
    $mayusers = $em->getRepository("\\Model\\Entity\\User")->getCustomUsers1();
    $user5 = $em->getRepository("\\Model\\Entity\\User")->getCustomUser('fperez');
    // select * from facturas where user_id = 2
    $u5_facturas = $user5->getFacturas();

    $newf = new \Model\Entity\Factura();
    $newf->setCantidad(123.56)
         ->setDate(new \DateTime())
         ->setUsuario($user5)
    ;
    $user5->addFactura($newf);
    try {
        $em->persist($newf);
        $em->persist($user5);
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
        echo $ex->getMessage();
        exit;
    }

    $leer = $em->getRepository("\\Model\\Entity\\Interes")->findOneBy(['nombre'=>'Leer']);
    $user5->addInteres($leer);
    $leer->addUser($user5);
    try {
        $em->persist($leer);
        $em->persist($user5);
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
        echo $ex->getMessage();
        exit;
    }

    // insert into users (...) values (...)
    $user3 = new \Model\Entity\User();
    $user3->setUsername('prueba')
          ->setPassword(md5('1234'))
          ->setNombre('Usuario')
          ->setApellidos('Pruebas')
          ->setEmail('prueba@localhost.local')
          ->setCreatedAt(new \DateTime())
          ->setUpdatedAt(new \DateTime())
    ;
    $em->persist($user3);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }

    // update users set ... where ...
    $user4 = $em->getRepository("\\Model\\Entity\\User")->findOneBy(['username'=>'prueba']); 
    $user4->setEmail('prueba@gmail.com')
          ->setUpdatedAt(new \DateTime())
    ;
    $em->persist($user4);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }    

    // delete from users where ...
    $em->remove($user4);
    try {
        $em->flush();
    }
    catch(\Exception $ex) {
        // Error de base de datos
    }   
          */     
?>
<!DOCTYPE html>
<html>
<head>    
    <meta charset="utf-8" />
</head>
<body>
    <pre>
        <b>Resultados</b>
        <ul>
        <?php
           $fecha1= new DateTime('2022-02-04');
           $fecha2= new DateTime('2022-06-12');
           //$diff = date_diff($fecha1, $fecha2);
           $diff = $fecha1->diff($fecha2);
           echo $diff->days . ' dias';
           //$dias = new DateTime();
            //echo ($dias->format('Y-m-d'));
        
            
            //foreach($usuario as $u) {
              //  echo "<li>".$u->getNombre().' '.$u->getEmail().' '.$u->getDNI().' '.$u->getApellido().' '.$u->getRol()."</li>";
            //}
            
        ?>
        </ul>
        
    </pre>
</body>
</html>