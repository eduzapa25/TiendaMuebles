<?php require_once("../bootstrap.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>armar.io</title>
    <link rel="stylesheet" href="../css/usuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php session_start()?>
<?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true ):?>
    <?php if(($_SESSION['user']->getRol() == "admin") || ($_SESSION['user']->getRol() == "trabajador")):?>

    
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
        <?php?>
            <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && $_SESSION['user']->getRol() == "cliente"):?>
                <li id="editProfile"><a href="../php/editProfile.php?uid=<?php echo $_SESSION['user']['dni']?>">Edit Profile</a></li>
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
            Backoffice usuarios
        </header>
        <div id="zonaSeleccion">
            <div id=contenedorAddUsuario>
                <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && $_SESSION['user']->getRol() == "admin"):?>
                    <span>Quires añadir un nuevo usuario?</span>
                    <form method="post" id="addUserForm" action="registroAdmin.php">
                        <button id="botonAdd" >Añadir</button>
                    </form>
                <?php endif ?>
            </div>
            <span id="buscarUsuario">Buscar Usuario</span>
            <form method="post" id="filtroForm" action="usuarios.php?action=mostrar">
            
                <div class="selector">
                    
                    <label for="rol" id="rolLable">Rol</label>
                    <select name="rol" id="rol">
                        <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && $_SESSION['user']->getRol() == "trabajador"):?>
                            <option id="sinSeleccionRol" value="cliente" hidden selected>Selecciones el tipo de Rol</option>
                        <?php endif ?>

                        <?php if( isset($_SESSION['logueado']) && $_SESSION['logueado'] == true && $_SESSION['user']->getRol() == "admin"):?>
                            <option id="sinSeleccionRol" value="0" hidden selected>Selecciones el tipo de Rol</option>
                            <option id="trabajador" value="trabajador">Trabajador</option>
                            <option id="admin" value="admin">Admin</option>

                        <?php endif ?>
                        <option id="cliente" value="cliente">Cliente</option>
                    </select>
                </div>
                <div class="selector">
                    <label for="dni" id="dniLable">DNI</label>
                    <input type="text" id="dni" name="dni" placeholder="Escriba el DNI a buscar" autocomplete="off">

                    <label for="nombre" id="nombreLable">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escriba el nombre a buscar" autocomplete="off">

                    <label for="apellido" id="apellidoLable">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Escriba el apellido a buscar" autocomplete="off">

                    <label for="email" id="emailLable">Email</label>
                    <input type="text" id="email" name="email" placeholder="Escriba el email a buscar" autocomplete="off">
                    <button id="botonFiltros" >Buscar</button>

                    
                    
                </div>
                <div id="errores"></div>
                
            </form>
            
        </div>
        
        
        
    
        <section id="articulos" class="seccion">
            <div id="articulosHeader" class="titulo">
                <p>Usuarios</p>
            </div>
            <div id="bloqueArticulos" >
            <table>
                <thead>
                    <th>DNI</th> <th>Nombre</th> <th>Apellido</th> <th>mail</th> <th>Rol</th>
                </thead>
                <tbody>
                <?php
                    $rol = "";
                    $dni = "";
                    $error = '';
                    $users = "";
                    require_once("libusers.php");
                    if($_GET['action']=='mostrar' || $_GET['action']=='todos'){
                        if( $_GET['action']=='mostrar' ) {
                            
                            $rol = $_POST->getRol();
                            $dni = $_POST['dni'];
                            $nombre = $_POST['nombre']; 
                            $apellido = $_POST['apellido']; 
                            $email = $_POST['email'];                            
                        }
                        else{
                            if($_SESSION['user']->getRol() == "trabajador"){
                                $rol = "cliente";
                            }
                            else{
                                $rol = "0";
                            }
                            $dni = "";
                            $nombre = ""; 
                            $apellido = ""; 
                            $email = "";     

                        }
                        $users = mostrar($rol,$dni,$nombre, $apellido, $email, $error);
                        if( $users!=null ) {
                    
                ?>
                <?php foreach($users as $u) : ?>
                    <tr>
                        <td class = tdDNI><?php echo $u['dni'];?></td>
                        <td class = tdNombre><?php echo $u['nombre'];?></td>
                        <td class = tdApellido><?php echo $u['apellido'];?></td>
                        <td class = tdEmail><?php echo $u['email'];?></td>
                        <td class = tdRol><?php echo $u->getRol();?></td>
                        <td class = tdBotonModificar><button class=botonModificar>modificar</button></td>
                        <td class = tdBotonEliminar><button class=botonEliminar>eliminar</button></td>
                    </tr>
                <?php endforeach ?>
                <?php
                
                    }
                    else{
                        exit; 
                    }
                    }
                ?>
                </tbody>
            </table>
            </div>    
        </section>
    </div>
    <?php endif ?>
    <?php endif ?> 
</body>
<script src="../js/usuarios.js"></script>
</html>
