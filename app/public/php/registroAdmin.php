<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="../css/registroAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php 
    require_once("libusers.php");
    session_start();
    if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true  ) {
      
        $user = null;
        if ( isset($_GET['uid']) ) {
            $user = user_find($_GET['uid']); 
            if( !$user ) {
                header("Location: perfil.php?error=user");
                exit;
            }  
            if( $user['rol']!="admin" ) {
                header("Location: perfil.php?error=permisoDenegado");
                exit;
            }   
            if( $_GET['uid']!=$_SESSION['user']['DNI'] ) {
                header("Location: perfil.php?error=permissions");
                exit;
            }         
        } 
    } 
    ?>
    <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && ($_SESSION['user']['rol'] == "admin")):?>
                    
                
    <div id="marcoPrincipal">
        <div id="titulo">
            <p>Welcome</p>
        </div>
        <div id="formularios">
            <form method="post" id="formDatos" action="usersController.php?action=registerAdmin">
                <div id="formNombre" class="campo">
                    <div class="contenedorLable">
                        <label for="nombre">Nombre</label>
                        <div class="campoError" id="errorNombre"></div>
                    </div>
                    <input type="text" id="nombre" name="nombre" placeholder="Su nombre">
                </div>
                <div id="formApellido" class="campo">
                    <div class="contenedorLable">
                        <label for="apellido">Apellido</label>
                        <div class="campoError" id="errorApellido"></div>
                    </div>
                    
                    <input type="text" id="apellido" name="apellido" placeholder="Escriba su apellido">
                </div>
                <div id="formEmail" class="campo">
                    <div class="contenedorLable">
                        <label for="email">E-mail</label>
                        <div class="campoError" id="errorEmail"></div>
                    </div>
                    <input type="text" id="email" name="email" placeholder="Tu direccion e-mail">
                </div>
                <div id="formDNI" class="campo"> 
                    <div class="contenedorLable" >
                        <label for="DNI">DNI</label>
                        <div class="campoError" id="errorDNI"></div>
                    </div>
                    <input type="text" id="DNI" name="DNI" placeholder="Escriba su DNI">
                </div>
                <div id="formPassword" class="campo">
                    <div class="contenedorLable">
                        <label for="password">Password</label>
                        <div class="campoError" id="errorPassword"></div>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Escriba su contraseña">
                </div>
                <div id="formRol" class="campo">
                    <div class="contenedorLable">
                        <label for="rol">Rol</label>
                        <div class="campoError" id="errorRol"></div>
                    </div>
                    <input type="text" id="rol" name="rol" placeholder="Escriba el rol">
                </div>
                <button id="registro">Registrarse</button>
            </form>
        </div>
        
        <div id="botones">
            <form id="formBoton" method = "post" >
                 <div id="bloqueInicioSesion">
                     <span>¿Ya eres cliente?</span>
                     <button id="logIn">Log in</button>
                </div>

            </form>            
        </div>
    </div>
    <?php endif ?>
</body>
<script src="../js/registroAdmin.js"></script>
</html>
