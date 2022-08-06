<?php
function db()
{
    
    $dsn = 'mysql:dbname=tienda;host=127.0.0.1;port=3306;charset=utf8';
    $username = 'root';
    $password = 'manager';

    try {
        $db = new PDO($dsn, $username, $password);
        return $db;
    } catch (PDOException $e) {
        return null;
    }
}
