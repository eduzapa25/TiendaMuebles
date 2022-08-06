<?php require_once("../../config/bootstrap.php");
    require_once("libusers.php");
    $limite=0;
    $allArticles = mostrarAllArticles();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>armar.io</title>
    <link rel="stylesheet" href="../css/alquiler.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <?php $limite=-1;?>
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
    </aside>
    <div id="content">


        <header id="cabecera">
            Alquilar
        </header>
        <div id="zonaFiltros">
            <form method="post" id="filtroForm" >
                <div class="filtro">
                    <label for="tipo" id="tipoLable">Tipo</label>
                    <select name="tipo" id="tipo" class="selector">
                        <option id="sinSeleccionTipo" value="0" hidden selected>Selecciones el tipo de mueble</option>
                        <option id="mesa" value="1">Mesa</option>
                        <option id="silla" value="2">Silla</option>
                        <option id="armario" value="3">Armario</option>
                        <option id="allTipos" value="4">Todos</option>
                    </select>
                </div>
                <div class="filtro">
                    <label for="madera" id="maderaLable">Madera</label>
                    <select name="madera" id="madera"  class="selector">
                        <option id="sinSeleccionMadera" value="0" hidden selected>Seleccione el tipo de madera</option>
                        <option id="roble" value="1">Roble</option>
                        <option id="ebano" value="2">Ebano</option>
                        <option id="pino" value="3">Pino</option>
                        <option id="nogal" value="4">Nogal</option>
                        <option id="allMaderas" value="5">Todos</option>
                    </select>
                </div>
                <div class="filtro">
                    <label for="color" id="colorLable">Color</label>
                    <select name="color" id="color"  class="selector">
                        <option id="sinSeleccionColor" value="0" hidden selected>Seleccione el color</option>
                        <option id="blanco" value="1">Blanco</option>
                        <option id="claro" value="2">Claro</option>
                        <option id="oscuro" value="3">Oscuro</option>
                        <option id="negro" value="4">Negro</option>
                        <option id="allColores" value="5">Todos</option>
                    </select>
                </div>
            </form>
        </div>
        
        
        <section id="articulos" class="seccion">
            <div id="articulosHeader" class="titulo">
                <p>Todos los articulos</p>
            </div>
            <div id="bloqueArticulos" >
            <?php foreach($allArticles as $u) : ?>
                <?php if($u->getCantidad() > $limite):?>
                <div id="articulo1" class="articulo silla nogal claro">
                    <div class="contenedorImg">
                        <img src="../imagenes/silla2.jpg" alt="">
                    </div>
                    <div class="info">
                        <span class="nombre"><?php echo $u->getIdArticulo()->getNombre()?></span>
                        <span class="unidades"><?php echo $u->getCantidad()?> unidades</span>
                        <div class="caracteristicas">
                            <span ><?php echo $u->getIdArticulo()->getTipo()?></span>
                            <span><?php echo $u->getIdArticulo()->getMadera()?></span>
                            <span><?php echo $u->getIdArticulo()->getColor()?></span>
                        </div>
                        <span class="precio"><?php echo $u->getIdArticulo()->getPrecio()?>$</span>
                        
                        <div class="marcoAlquiler">
                            <?php if((empty($_SESSION['logueado'])) || ($_SESSION['user']->getRol() == "cliente")):?>
                            <div class="marcoFechas">
                                <div class="fInicio">
                                    <label for="inicio">Inicio:</label>
                                    <input class="inputInicio" type="text" name="inicio" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="fFin">
                                    <label for="fin">Final  :</label>
                                    <input class="inputFin" type="text" name="fin" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            
                            <div class="divBtAlquiler">
                                <button class="btAlquiler">Alquilar</button>
                                <div class="errores"></div>
                            </div>
                            <?php endif ?>
                            <?php if((isset($_SESSION['logueado'])) && ($_SESSION['user']->getRol() != "cliente")):?>
                                    <div class="divModificacion">
                                        <div id="divBtEliminacion">
                                            <button calss="btEliminacion" class="btModificacion">Eliminar</button>
                                        </div>
                                        <div id="divBtModificacion">
                                            <input class="cantidadArticulos" name="cantidadArticulos" placeholder="stock">
                                            <button class="btModificacion" class="btModificacion">Modificar</button>
                                        </div>

                                    </div>
                            <?php endif ?>
                            
                            </div>
                        

                    </div>
                </div>
                <?php endif ?>
            <?php endforeach ?>
            </div>
        </section>
    </div>
</body>
<script src="../js/alquiler.js"></script>
</html>
