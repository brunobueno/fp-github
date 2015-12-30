<?php

/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 21/12/2015
 * Time: 19:27
 */

class Conexao
{
    private static $host = "localhost";
    private static $db = "crud_oo";
    private static $user = "root";
    private static $pass = "";

    public static function conectar()
    {
        try
        {
            return new PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=utf8", self::$user, self::$pass);
        }
        catch (PDOException $e)
        {
            echo "Erro ao conectar com o banco: " . $e->getMessage();
        }
    }
}

?>