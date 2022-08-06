<?php
    require_once("libusers.php");
    //require_once("../bootstrap.php");
     // Accion para eliminar un articulo
     $pagina =$_GET['pagina'];
     if( $_GET['action']=='eliminarArticulo' ) {
        $error = '';
        $almacen = buscarArticulo($_GET['nombre']);

        if( $almacen==null ) {
            $error = 'No existe el articulo';
        } 
        else {
            $completado = modificarStock($almacen, 0);
            if( $completado ) {
                $error = '';
                header("Location: $pagina.php");

            } else {
                $error = 'Error al eliminar el articulo';
                header("Location: $pagina.php?error=$error");
            }
        }  
    } 

     // Accion para modificar el stock de un articulo
    
     if( $_GET['action']=='modificarStock' ) {
        $error = '';
        $almacen = buscarArticulo($_GET['nombre']);
        $pagina =$_GET['pagina'];
        if( $almacen==null ) {
            $error = 'No existe el articulo';
        } 
        else {
            $completado = modificarStock($almacen, $_GET['cantidad']);
            if( $completado ) {
                $error = '';
                header("Location: $pagina.php");

            } else {
                $error = 'Error al eliminar el articulo';
                header("Location: $pagina.php?error=$error");
            }
        }  
    } 

    // Accion para registrar un articulo
    
    if( $_GET['action']=='registerArticulo' ) {
        $error = '';
        $almacen = buscarArticulo($_POST['nombre']);
        if( $almacen ) {
            $error = 'El articulo ya existe';
        } 
        else {
            $completado = registrarArticulos($_POST['id'], $_POST['nombre'], $_POST['tipo'], $_POST['madera'], $_POST['color'], $_POST['precio'], $_POST['cantidad']);
            if( $completado ) {
                $error = '';
                header("Location: compra.php");

            } else {
                $error = 'Error al registrar el articulo';
                header("Location: compra.php?error=$error");
            }
        }  
    } 

    
    // Accion para autentificar usuario
    
    if( $_GET['action']=='login' ) {
        $error = '';
        $user = user_login($_POST['email'], $_POST['password'], $error);
        if( $user ) {
            session_start();
            $_SESSION['logueado'] = true;
            $_SESSION['user'] = $user;
            // Redireccion a parte privada
            header("Location: landPage.php");
            exit; 
        }
        else {
            header("Location: inicioSesion.php?error=$error");
            exit;      
        }
    }   
  

    // Accion para registrar usuario

    if( $_GET['action']=='registerUser' ) {

        $error = '';
        $rol = 'cliente';
        $id = user_add($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['DNI'], md5($_POST['password']),$rol, $error);
        if( is_numeric($id) ) {
            header('Location: inicioSesion.php');
            exit;
        }
        else {
            if( $error=='exists' ) {
                header("Location: registro.php?error=$error");
                exit;
            }
            else {
                header("Location: registro.php?error=unknown");
                exit; 
            }
            ;
        }
    }  

    // Accion para registrar un usuario sindo administrador(dar de alta trabajador)
    if( $_GET['action']=='registerAdmin' ) {

        $error = '';
        $result = user_add($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['DNI'],  md5($_POST['password']),$_POST['rol'], $error);
        if( $error=='exists' ) {
            header("Location: registroAdmin.php?error=$error");

            exit;
        }
        else {
            header('Location: inicioSesion.php');

            exit;
        }
    }  
     
    // Accion para editar usuario
    else if( $_GET['action']=='perfil' ) {
        $error = '';
        $result = user_edit($_GET['uid'], $_POST['password'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $error);
        if( $result ) {
            header('Location: landPage.php');
            exit;
        }
        else {
            header('Location: landPage.php?error=failed');
            exit;
        }
    } 
    
    //Accion para cerrar sesion
    else if( $_GET['action']=='logout' ) {
        session_start();
        $_SESSION['logueado'] = true;
        session_destroy();  // Borra todo en $_SESSION

        header("Location: landPage.php");
        exit;   
    }
    
    
   // Accion para eliminar usuario
    else if( $_GET['action']=='delete' ) {
        $user = null;
        if ( isset($_GET['uid']) ) {
            $user = user_find_id($_GET['uid'], $error); 
            // Solo borramos si existe el usuario
            if( $user===null ) {
                header("Location: privada.php?error=user");
                exit;
            }     
            session_start();
            if( $_GET['uid']!=$_SESSION['user']['id'] ) {
                header("Location: privada.php?error=permissions");
                exit;
            }         
        }  
        $result = user_delete($_GET['uid'], $error);
        if( $result ) {    
            header("Location: login.php");
            exit;   
        }
        else {
            header("Location: privada.php");
            exit; 
        }
    }       

    // Accion eliminar usuario desde admin

    else if( $_GET['action']=='deleteAdmin' ) {
        $user = null;
        if ( isset($_GET['uid']) ) {
            $user = user_find_id($_GET['uid'], $error); 
            // Solo borramos si existe el usuario
            if( $user===null ) {
                header("Location: usuarios.php?action=todos&error=user");
                exit;
            }     
            session_start();
            /*
            if( $_SESSION['user']['rol'!="admin"] ) {
                header("Location: usuarios.php?action=todos&error=permissions");
                exit;
            } 
            */        
        }  
        $result = user_delete($_GET['uid'], $error);
        if( $result ) {    
            header("Location: usuarios.php?action=todos");
            exit;   
        }
        else {
            header("Location: usuarios.php?action=todos");
            exit; 
        }
    }       