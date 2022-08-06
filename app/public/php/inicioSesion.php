<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="../css/inicioSesion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="marcoPrincipal">
        <div id="titulo">
            <p>Welcome</p>
        </div>
        <div id="formularios">
            <form method="post" id="formDatos" action="usersController.php?action=login">
                <div id="formEmail">
                    <div class="contenedorLable" id="contenedoremail">
                        <label for="email">E-mail</label>
                        <div id="errorEmail" class="campoError"></div>
                    </div>
                    
                    <input type="text" id="email" name="email" placeholder="Tu direccion e-mail" autocomplete="off">
                </div>
                <div id="formPassword">
                    <div class="contenedorLable" >
                        <label for="password">Password</label>
                        <div id="errorPassword" class="campoError"></div>
                    </div>
                    
                    <input type="password" id="password" name="password" placeholder="Escriba su contraseña" autocomplete="off">
                </div>
                <div id="botones">
                    <button id="logIn">Log in</button>
                </div>
            </form>
            <button id="registro">Registrarse</button>
        </div>
        
       
    </div>
</body>
<script src="../js/inicioSesion.js"></script>
</html>
