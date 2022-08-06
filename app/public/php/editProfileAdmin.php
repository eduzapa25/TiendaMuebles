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
        $error = null;
        $user = null;
        if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true ) {
            if ( $_GET['uid']) {
                $user = user_find_id($_GET['uid'], $error);
                if( !$user ) {
                    header("Location: perfil.php?error=user");
                    exit;
                }          
            } 
             
            
        

    ?>
    <div id="marcoPrincipal">
        <div id="titulo">
            <p>Editar perfil</p>
        </div>
        <div id="formularios">
            <form method="post" id="formDatos" action="usersController.php?action=perfil&uid=<?php echo $user['dni']?>">

                <div id=bloqueInputs>
                    <div id=bloque1>
                        <div id="formNombre" class="campo">
                            <div class="contenedorLable">
                                <label for="nombre">Nombre</label>
                                <div class="campoError" id="errorNombre"></div>
                            </div>
                            <input type="text" id="nombre" name="nombre" placeholder=<?php echo $user['nombre']?> value = <?php echo $user['nombre']?>>
                        </div>
                        <div id="formApellido" class="campo">
                            <div class="contenedorLable">
                                <label for="apellido">Apellido</label>
                                <div class="campoError" id="errorApellido"></div>
                            </div>
                            
                            <input type="text" id="apellido" name="apellido" placeholder=<?php echo $user['apellido']?> value = <?php echo $user['apellido']?>>
                        </div>
                        <div id="formEmail" class="campo">
                            <div class="contenedorLable">
                                <label for="email">E-mail</label>
                                <div class="campoError" id="errorEmail"></div>
                            </div>
                            <input type="text" id="email" name="email" placeholder=<?php echo $user['email']?> value = <?php echo $user['email']?>>
                        </div>
                        <div id="formDNI" class="campo"> 
                            <div class="contenedorLable" >
                                <label for="DNI">DNI</label>
                                <div class="campoError" id="errorDNI"></div>
                            </div>
                            <input type="text" id="DNI" name="DNI" placeholder=<?php echo $user['dni']?> value = <?php echo $user['dni']?>>
                        </div>
                    </div>

                    <div id=bloque2>
                        <div id="formPassword" class="campo">
                            <div class="contenedorLable">
                                <label for="password">Password</label>
                                <div class="campoError" id="errorPassword"></div>
                            </div>
                            <input type="password" id="password" name="password" placeholder=<?php echo $user['password']?> value = <?php echo $user['password']?>>
                        </div>


                        <div id="formTarjeta" class="campo">
                            <div class="contenedorLable">
                                <label for="tarjeta">Tarjeta</label>
                                <div class="campoError" id="errorTarjeta"></div>
                            </div>
                            <input type="text" id="tarjeta" name="tarjeta" placeholder=<?php echo $user['tarjeta']?> value = <?php echo $user['tarjeta']?>>
                        </div>
                        <div id="formTelefono" class="campo">
                            <div class="contenedorLable">
                                <label for="telefono">Telefono</label>
                                <div class="campoError" id="errorTelefono"></div>
                            </div>
                            <input type="text" id="telefono" name="telefono" placeholder=<?php echo $user['telefono']?> value = <?php echo $user['telefono']?>>
                        </div>
                        <div id="formDireccion" class="campo">
                            <div class="contenedorLable">
                                <label for="direccion">Direccion</label>
                                <div class="campoError" id="errorDireccion"></div>
                            </div>
                            <input type="text" id="direccion" name="direccion" placeholder=<?php echo $user['direccion']?> value = <?php echo $user['direccion']?>>
                        </div>
                    </div> 
                </div>
               
                
                
                <button id="registro">Actualizar</button>
            </form>
        </div>
        
    </div>
</body>
<?php } ?>
<script src="../js/editProfile.js"></script>
</html>
