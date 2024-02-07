<?php

// Inicializando la sesión del usuario
session_start();

// Iniciamos clase conectar
class Conectar
{
    public  static $dbh;

    // Funcion protegida de la cadena de conexion
    public   static function Conexion()
    {
        try {
            $servername = "localhost";
            $port = "5432"; // Puerto personalizado
            $username = "postgres";
            $password = "123";
            $dbname = "db_gitse3";

            // Crear una nueva instancia de PDO y almacenarla en una variable local
            $conectar = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);

            // Configurar el modo de error y excepción
            $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conectar;
        } catch (Exception $e) {
            print "!Error DB: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}