<?php
//require_once('db.inc.php');
//require_once("../bootstrap.php");
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

define('USERSPATH', __DIR__.'/users.json');

function mostrarAllArticles()
{    
    global $em;
    return $em->getRepository("\\Model\\Entity\\Almacen")->findAll();
    
}
function buscarArticulo($nombre)
{
    global $em;
    $articulo = $em->getRepository("\\Model\\Entity\\Articulos")->findOneBy(['nombre'=>$nombre]);
    $almacen = $em->getRepository("\\Model\\Entity\\Almacen")->findOneBy(['idArticulo'=>$articulo]);
    return $almacen;

}

function modificarStock($almacen, $cantidad)
{
    $completado = false;
    global $em;
    $almacen->setCantidad($cantidad);
    try {
        $em->persist($almacen);
        $em->flush();
        $completado = true;
    }catch(\Exception $ex) {
        echo $ex->getMessage();
        exit;
    }
    return $completado;
}



function registrarArticulos($id, $nombre, $tipo, $madera, $color,  $precio, $cantidad)
{
    global $em;
    $completado = false;
    
    
    $newArticulo = new \Model\Entity\Articulos();
    $newArticulo->setIdArticulo($id);
    $newArticulo->setNombre($nombre);
    $newArticulo->setTipo($tipo);
    $newArticulo->setColor($color);
    $newArticulo->setMadera($madera);
    $newArticulo->setPrecio($precio);
    $newAlmacen = new \Model\Entity\Almacen();
    $newAlmacen->setCantidad($cantidad);
    $newAlmacen->setIdArticulo($newArticulo);

    try {
        
        $em->persist($newArticulo);
        
        $em->flush();
        
        $em->persist($newAlmacen);
       
        $em->flush();
        

        $completado=true;
    }catch(\Exception $ex) {
        // Error de base de datos
        $completado = false;
        echo $ex->getMessage();
        exit;
    }

    
    return $completado;


}

/**
 * Modifica un usuario en los datos
 * 
 * @param username
 * @param password
 * @param nombre
 * @param apellidos
 * @param email
 * @param error
 * 
 * @return boolean
 */

/*
function user_edit($DNI, $password, $nombre, $apellido, $email, &$error)
{
    if( !is_file(USERSPATH) ) {
        file_put_contents(USERSPATH, json_encode([]));
    }        
    $users = json_decode( file_get_contents(USERSPATH), true );
    $changed = false;
    foreach($users as &$u) {
        if( $u['DNI']==$DNI ) {
            // Solo editamos la contraseña si ha cambiado
            if( $password!=$u['password'] ) {
                $u['password'] = md5($password);
            }
            $u['nombre'] = $nombre;
            $u['apellido'] = $apellido;
            $u['email'] = $email;
            $changed = true;
        }
    }
    file_put_contents(USERSPATH, json_encode($users, JSON_PRETTY_PRINT));
    return $changed;
}

*/

/**
 * Modifica un usuario en la base de datos
 * 
 * @param id
 * @param username
 * @param password
 * @param nombre
 * @param apellidos
 * @param email
 * @param error
 * 
 * @return boolean
 */

 function user_edit($DNI, $password, $nombre, $apellido, $email, &$error)
{
    $conn = db();    

    // No se modifica un usuario que no existe
    $error = null;
    $user = user_find_id($DNI, $error);
    if( $user===null ) {
        $error = 'user';
        return false;
    }    

    // Los campos que puedan ser NULL, hay que editarlos como nombre, apellidos o email
    // Como password se puede pasar vacío y entonces no hay que cambiarlo, se condiciona el SQL
    $SQL = "
    UPDATE usuarios SET
        dni = :dni, 
        nombre = :nombre,
        apellido = :apellido,        
    ";
    if( $password ) {
        $password = md5($password);
        $SQL .= "password = :password,"; 
    }
    $SQL .= "
        email = :email  
    WHERE
        dni = :dni
    ";
    $rs = $conn->prepare($SQL);
    $rs->bindParam('dni', $DNI);
    $rs->bindParam('nombre', $nombre);
    $rs->bindParam('apellido', $apellido);
    $rs->bindParam('email', $email);
    if( $password ) {
        $rs->bindParam('password', $password);
    }
    $numrows = $rs->execute();
    if( $numrows===false ) {
        $error = 'unknown';
        return false;
    }
    return true;
}

function mostrar($rol,$dni, $nombre, $apellido, $email, &$error)
{
    $conn = db();    

    // No se modifica un usuario que no existe
    $error = null;
    
    if($dni==null){
        $dni="%%";
    }
    if($rol=="0"){
        $rol="%%";
    }
    if($nombre==null){
        $nombre="%%";
    }
    if($apellido==null){
        $apellido="%%";
    }
    if($email==null){
        $email="%%";
    }
    

    
    $SQL = "select * from usuarios where rol like \"".$rol."\" and dni like \"".$dni."\" and nombre 
    like \"".$nombre."\" and apellido like \"".$apellido."\" and email like \"".$email."\"";
    $rs = $conn->query($SQL); 
    $users = null;
    if( $rs===false ) {
        $error = 'Sin respuesta BD';
        return $users;
    }
   
    while( $row = $rs->fetch(PDO::FETCH_ASSOC) ) {
        $users[] = $row;
    }
   return $users;
    
}



/**
 * Elimina un usuario de los datos
 * 
 * @param id
 * @param error
 * 
 * @return boolean
 */
function user_delete($id, &$error)
{
    $conn = db();    

    // No se elimina un usuario que no existe
    $error = null;
    $user = user_find_id($id, $error);
    if( $user===null ) {
        $error = 'user';
        return false;
    }    

    // Los campos que puedan ser NULL, hay que editarlos como nombre, apellidos o email
    $SQL = "DELETE FROM usuarios WHERE dni like \"".$id."\"";
    
    $numrows = $conn->query($SQL);
    if( $numrows===false ) {
        $error = 'unknown';
        return false;
    }
    return true;
}





/**
 * Busca un usuario en los datos a partir del username
 * 
 * @param username
 * @param password
 * @param error
 * 
 * @return array|null
 */

function user_login($email, $password, &$error)
{
    $user = user_find_emailOB($email, $error);  
    if( $error!=null ) {
        return null;
    }
    else{
        if( $user->getPassword()!=md5($password) ) {
            $error = 'password';
            return null;
        }
        else {
            return $user;
        }
    }
}


/**
 * Busca un usuario en los datos a partir del username
 * 
 * @param username
 * @param error
 * @param nopasswd
 * 
 * @return array|null
 */
/*
 function user_find_username($username, &$error, $nopasswd = false)
{
    $conn = db();    

    $SQL = "SELECT * FROM users WHERE username = :username";
    if( SQLDEBUG ) sqllog("DEBUG", "user_find", $SQL);
    $rs = $conn->prepare($SQL);
    $rs->bindParam('username', $username);
    $result = $rs->execute();
    if( $result ) {
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        if( $row !== false ) {
            if( $nopasswd ) {
                unset($row['password']);
            }
            $error = null;
            return $row;
        }
        else {
            $error = 'user';
            return null; 
        }
    }
    else {
        sqllog("ERROR", "user_find", $rs->errorInfo()[1].' '.$rs->errorInfo()[2]);
        $error = 'unknown';
        return null; 
    }
}
*/
function user_find_id($DNI, &$error, $nopasswd = false)
{
    $conn = db();    

    $SQL = "SELECT * FROM usuarios WHERE dni = :dni";
    $rs = $conn->prepare($SQL);
    $rs->bindParam('dni', $DNI);
    $result = $rs->execute();
    if( $result ) {
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        if( $row !== false ) {
            if( $nopasswd ) {
                unset($row['password']);
            }
            $error = null;
            return $row;
        }
        else {
            $error = 'user';
            return null; 
        }
    }
    else {
        $error = 'unknown';
        return null; 
    }
}
function user_find_email($email, &$error, $nopasswd = false)
{
    $conn = db();    

    $SQL = "SELECT * FROM usuarios WHERE email = :email";
    $rs = $conn->prepare($SQL);
    $rs->bindParam('email', $email);
    $result = $rs->execute();
    if( $result ) {
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        if( $row !== false ) {
            if( $nopasswd ) {
                unset($row['password']);
            }
            $error = null;
            return $row;
        }
        else {
            $error = 'email';
            return null; 
        }
    }
    else {
        $error = 'unknown';
        return null; 
    }
}

function user_find_emailOB($email, &$error, $nopasswd = false)
{
    global $em;
    $usuario = $em->getRepository("\\Model\\Entity\\Usuario")->findOneBy(['email'=>$email]);
    $error = null;
    
    if ($usuario == null) {
        $error = 'No se encontro el usuario';
    }
    return $usuario;
}


function user_add($nombre, $apellido, $email, $DNI, $password, $rol, &$error)
{    
    $conn = db();    
    
    // No se registra un usuario que ya exista
    $error = null;
    $dni = user_find_id($DNI, $error);
    $EMAIL = user_find_email($email, $error);
    if( $dni || $error!='email') {
        $error = 'exists';
        return null;
    }    
    $error = null;
    $SQL = "
    INSERT INTO usuarios (
        dni, 
        nombre, 
        apellido, 
        email, 
        password, 
        rol
    ) VALUES (
        '".$DNI."', 
        '".$nombre."', 
        '".$apellido."', 
        '".$email."', 
        '".$password."', 
        '".$rol."'
    )";
    $numrows = $conn->query($SQL);
    if( $numrows===false ) {
        $error = 'unknown';
        return null;
    }

    // Opcion 1, devolvemos todos los datos del usuario. Implica una operacion más (select)
    // return user_find($username);

    // Opcion 2, devolvemos el id asignado por la BD
    return $conn->lastInsertId();
}



