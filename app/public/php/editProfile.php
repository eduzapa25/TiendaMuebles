<?php require_once("../bootstrap.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion de perfil</title>
    <link rel="stylesheet" href="../css/editProfile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php 
    require_once("libusers.php");
    session_start();
    if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true ) {
        $error = null;
        $user = null;
        if ( isset($_GET['uid']) ) {
            $user = user_find_id($_GET['uid'], $error); 
            if( !$user ) {
                header("Location: perfil.php?error=user");
                exit;
            }     
            if( $_GET['uid']!=$_SESSION['user']->getDNI() ) {
                header("Location: landPage.php?error=permissions");
                exit;
            }         
        } 
    } 
    ?>
    <div id="marcoPrincipal">
        <div id="titulo">
            <p>Editar perfil</p>
        </div>
        <div id="formularios">
            <form method="post" id="formDatos" action="usersController.php?action=perfil&uid=<?php echo $_SESSION['user']->getDNI()?>">

                <div id=bloqueInputs>
                    <div id=bloque1>
                        <div id="formNombre" class="campo">
                            <div class="contenedorLable">
                                <label for="nombre">Nombre</label>
                                <div class="campoError" id="errorNombre"></div>
                            </div>
                            <input type="text" id="nombre" name="nombre" placeholder=<?php echo $_SESSION['user']->getNombre()?> value = <?php echo $_SESSION['user']->getNombre()?>>
                        </div>
                        <div id="formApellido" class="campo">
                            <div class="contenedorLable">
                                <label for="apellido">Apellido</label>
                                <div class="campoError" id="errorApellido"></div>
                            </div>
                            
                            <input type="text" id="apellido" name="apellido" placeholder=<?php echo $_SESSION['user']->getApellido()?> value = <?php echo $_SESSION['user']->getApellido()?>>
                        </div>
                        <div id="formEmail" class="campo">
                            <div class="contenedorLable">
                                <label for="email">E-mail</label>
                                <div class="campoError" id="errorEmail"></div>
                            </div>
                            <input type="text" id="email" name="email" placeholder=<?php echo $_SESSION['user']->getEmail()?> value = <?php echo $_SESSION['user']->getEmail()?>>
                        </div>
                        <div id="formDNI" class="campo"> 
                            <div class="contenedorLable" >
                                <label for="DNI">DNI</label>
                                <div class="campoError" id="errorDNI"></div>
                            </div>
                            <input type="text" id="DNI" name="DNI" placeholder=<?php echo $_SESSION['user']->getDNI()?> value = <?php echo $_SESSION['user']->getDNI()?>>
                        </div>
                    </div>

                    <div id=bloque2>
                        <div id="formPassword" class="campo">
                            <div class="contenedorLable">
                                <label for="password">Password</label>
                                <div class="campoError" id="errorPassword"></div>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Escriba su nueva contraseña">
                        </div>


                        <div id="formTarjeta" class="campo">
                            <div class="contenedorLable">
                                <label for="tarjeta">Tarjeta</label>
                                <div class="campoError" id="errorTarjeta"></div>
                            </div>
                            <input type="text" id="tarjeta" name="tarjeta" placeholder="Escriba su tarjeta de credito">
                        </div>
                        <div id="formTelefono" class="campo">
                            <div class="contenedorLable">
                                <label for="telefono">Telefono</label>
                                <div class="campoError" id="errorTelefono"></div>
                            </div>
                            <input type="text" id="telefono" name="telefono" placeholder="Escriba su telefono de contacto">
                        </div>
                        <div id="formDireccion" class="campo">
                            <div class="contenedorLable">
                                <label for="direccion">Direccion</label>
                                <div class="campoError" id="errorDireccion"></div>
                            </div>
                            <input type="text" id="direccion" name="direccion" placeholder="Escriba su direccion de envio">
                        </div>
                    </div> 
                </div>
               
                
                
                <button id="registro">Actualizar</button>
            </form>
        </div>
        
    </div>
</body>
<script src="../js/editProfile.js"></script>
</html>
