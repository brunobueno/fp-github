<?php

/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 21/12/2015
 * Time: 19:27
 */
class Conexao
{
    private $host = "localhost";
    private $db = "";
    private $user = "root";
    private $pass = "";

    public static function conectar(){
        try
        {
            $conexao = new PDO("mysql:host=".self::host.";dbname=".self::$db.";charset=utf8", self::$user, self::$pass);
            return $conexao;
        }
        catch (PDOException $e)
        {
            echo "Erro ao conectar com o banco: " . $e->getMessage();
        }
    }
}