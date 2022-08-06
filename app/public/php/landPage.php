<?php require_once("../bootstrap.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>armar.io</title>
    <link rel="stylesheet" href="../css/landPageStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php session_start();?>
    <aside id="menuLateral">
        <div id="topAside">
            ARMAR.IO
        </div>
        <nav id="navServicios">
            <ul>
                <li id="inicio"><a href="../php/landPage.php">Inicio</a></li>
                <li id="compra"><a href="../php/compra.php">Compras</a></li>
                <li id="alquiler"><a href="../php/alquiler.php">Alquiler</a></li>
                <li id="reparaciones"><a href="../php/reparacion.php">Reparaciones</a></li>
                <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true ):?>
                    <?php if(($_SESSION['user']->getRol() == "admin") || ($_SESSION['user']->getRol() == "trabajador")):?>
                        <li id="usuarios"><a href="../php/usuarios.php?action=todos">Usuarios</a></li>
                        <li id="addArticulo"><a href="../php/addArticulo.php">Add articulo</a></li>
                    <?php endif ?>
                <?php endif ?>
            </ul>
        </nav>
        <ul id="sesiones">
            <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && $_SESSION['user']->getRol() == "cliente"):?>
                <li id="editProfile"><a href="../php/editProfile.php?uid=<?php echo $_SESSION['user']->getDNI()?>">Edit Profile</a></li>
            <?php endif ?>

            

            <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true):?>
                <form method="post" id="logoutForm" action="usersController.php?action=logout">
                    <button id="logout">Cerrar sesion</button>
                </form>
            <?php endif ?>
            
            <?php if( isset($_SESSION['logueado'])==false || $_SESSION['logueado'] == false):?>
                <li id="inicioSesion"><a href="../php/inicioSesion.php">Iniciar sesion</a></li>
                <li id="registro"><a href="../php/registro.php">Registrarse</a></li>
            <?php endif ?>
            
        </ul>
            
        </ul>
    </aside>
    <div id="content">
        
        <header id="cabecera">
            Inicio
        </header>
        
        
        <section id="servicios" class="seccion">
            <div id="serviciosHeader" class="titulo">
                Accede a nuestros servicios
            </div>
            <div id="tipoServicios" >
                <div id="tipoCompra">
                    <a href="../php/compra.php">Compra</a>
                    <a href="../php/compra.php"><img id="iconoCompra" src="../imagenes/compra.png" alt="icono de compra"></a>
                </div>
                <div id="tipoAlquiler">
                    <a href="../php/alquiler.php">Alquiler</a> 
                    <a href="../php/alquiler.php"><img id="iconoAlquiler" src="../imagenes/alquiler.png" alt="icono de alquiler"></a>
                </div>
                <div id="tipoReparacion">
                    <a href="../php/reparacion.php">Reparacion</a> 
                    <a href="../php/reparacion.php"><img id="iconoReparacion" src="../imagenes/arreglos.png" alt="icono de reparaciones"></a>
                </div>
            </div>
        </section>
        <section id="presentacion" class="seccion"> 
            <div id="presentacionHeader" class="titulo">
                Quienes somos
            </div>
            <div id="presentacionContent">
                <p id="textoPresentacion">Somos una empresa fundada en el sur de Suiza, por el maestro de la ebanisteria Finn Muller.
                    <br><br>    
                    Desde nuestros inicios hemos ido creciendo y expandiendonos por el mundo pero siempre manteniendo la calidad y el buen hacer de nuestros productos junto con un trato cercano con 
                    el cliente.
                </p>
                <img src="../imagenes/ebanistas-almeria-2.jpg" alt="imagen de ebanista">
            </div>
        </section>
        <section id="contacto" class="seccion">
            <div id="contactoHeader" class="titulo">
                Contacto
            </div>
            <div id="contactoContent">
                <div id="instagramContact">
                    <a href="https://www.instagram.com/?hl=es" target="_blank"><img src="../imagenes/instagram.png" alt="icono instagra"></a>
                    <a href="https://www.instagram.com/?hl=es" target="_blank">@armar.io</a>
                </div>
                <div id="facebookContact">
                    <a href="https://www.facebook.com/" target="_blank"><img src="../imagenes/facebook.png" alt="icono facebook"></a>
                    <a href="https://www.facebook.com/" target="_blank">@armar.io</a>
                </div>
                <div id="twitterContact">
                    <a href="https://twitter.com/" target="_blank"><img src="../imagenes/twitter.png" alt="icono twitter"></a>
                    <a href="https://twitter.com/" target="_blank">@armar.io</a>
                </div>
                <div id="emailContact">
                    <img src="../imagenes/email.png" alt="../icono email">
                    <span>armar.io@gmail.com</span>
                </div>
                
            </div>
        </section>
    </div>
    
</body>
</html>
