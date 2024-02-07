<?php

// Inicializando la sesión del usuario
session_start();

// Iniciamos clase conectar
class Conectar
{
     protected   $dbh;

    // Funcion protegida de la cadena de conexion
    public   function Conexion()
    {
        try {
            $servername = "localhost";
            $port = "5432"; // Puerto personalizado
            $username = "postgres";
            $password = "123";
            $dbname = "db_gitse3";

            // Crear una nueva instancia de PDO y almacenarla en una variable local
            $conectar = $this->dbh = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);

            // Configurar el modo de error y excepción
            $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conectar;
        } catch (Exception $e) {
            print "!Error DB: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    // Para impedir que tengamos problemas con las ñ o tildes
    public function set_names()
    {
        // Acceder a $this->dbh
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    // Ruta principal del proyecto
    public static function ruta()
    {
        return "http://localhost/Defensa_Civil/";
    }

}
