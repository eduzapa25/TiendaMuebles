<?php require_once("../bootstrap.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="../css/addArticulo.css">
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
            if( $user->getRol()!="admin" ) {
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
    <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && ($_SESSION['user']->getRol() == "admin")):?>
                    
                
    <div id="marcoPrincipal">
        <div id="titulo">
            <p>Añadir nuevo articulo</p>
        </div>
        <div id="formularios">
            <form method="post" id="formDatos" action="usersController.php?action=registerArticulo">
                <div id="formNombre" class="campo">
                    <div class="contenedorLable">
                        <label for="nombre">Nombre</label>
                        <div class="campoError" id="errorNombre"></div>
                    </div>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del articulo">
                </div>
                <div id="formId" class="campo">
                    <div class="contenedorLable">
                        <label for="id">Id</label>
                        <div class="campoError" id="errorId"></div>
                    </div>
                    <input type="text" id="id" name="id" placeholder="Id del articulo(numerico)">
                </div>
                
                <div id="formTipo" class="campo">
                    <div class="contenedorLable">
                        <label for="formTipo">Tipo</label>
                        <div class="campoError" id="errorTipo"></div>
                    </div>
                    
                    <input type="text" id="tipo" name="tipo" placeholder="Tipo de articulo">
                </div>
                <div id="formMadera" class="campo">
                    <div class="contenedorLable">
                        <label for="madera">Madera</label>
                        <div class="campoError" id="errorMadera"></div>
                    </div>
                    <input type="text" id="madera" name="madera" placeholder="Tipo de madera del articulo">
                </div>
                <div id="formColor" class="campo"> 
                    <div class="contenedorLable" >
                        <label for="color">Color</label>
                        <div class="campoError" id="errorColor"></div>
                    </div>
                    <input type="text" id="color" name="color" placeholder="Color del articulo">
                </div>
                <div id="formPrecio" class="campo">
                    <div class="contenedorLable">
                        <label for="precio">Precio</label>
                        <div class="campoError" id="errorPrecio"></div>
                    </div>
                    <input type="text" id="precio" name="precio" placeholder="Precio del articulo">
                </div>
                <div id="formCantidad" class="campo">
                    <div class="contenedorLable">
                        <label for="cantidad">Cantidad</label>
                        <div class="campoError" id="errorCantidad"></div>
                    </div>
                    <input type="text" id="cantidad" name="cantidad" placeholder="Numero de unidades a introducir">
                </div>
                <button id="registro">Agregar Articulo</button>
            </form>
        </div>
        
        
    </div>
    <?php endif ?>
</body>
<script src="../js/addArticulo.js"></script>
</html>
