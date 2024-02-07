<?php
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

    public function idObtener()
    {
        try {
            $conexion = $this->Conexion();

            // TIPO ITSE
            // $sql = "SELECT comp_idesc FROM sc_gitse3.tb_componente WHERE comp_id = '1' ORDER BY comp_idesc DESC LIMIT 1 ";

            // FUNCION
            // $sql = "SELECT comp_idesc FROM sc_gitse3.tb_componente WHERE comp_id = '2' ORDER BY comp_idesc DESC LIMIT 1 ";

            // CLASIFICACION RIESGO
            // $sql = "SELECT comp_idesc FROM sc_gitse3.tb_componente WHERE comp_id = '3' ORDER BY comp_idesc DESC LIMIT 1 ";

            // REPRESENTANTE
            // $sql = "SELECT comp_idesc FROM sc_gitse3.tb_componente WHERE comp_id = '4' ORDER BY comp_idesc DESC LIMIT 1 ";

            // LICENCIA_FUNCIONAMIENTO
            $sql = "SELECT comp_idesc FROM sc_gitse3.tb_componente WHERE comp_id = '5' ORDER BY comp_idesc DESC LIMIT 1 ";


            $stmt = $conexion->prepare($sql);
            $stmt->execute();

            // Obtener el resultado como un array asociativo
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retornar el valor de comp_idesc
            return isset($resultado['comp_idesc']) ? $resultado['comp_idesc'] : null;
        } catch (PDOException $e) {
            // Manejar la excepción si ocurre un error en la base de datos
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado, // valor estatico
        $valor
    ) {
        try {
            // Obtener la conexión
            $conexion = $this->Conexion();

            // Preparar la consulta SQL
            $sql = 'INSERT INTO sc_gitse3.tb_componente(
                comp_id, comp_value, comp_idesc, comp_desc, comp_tipoanexo, comp_estado)
                VALUES (?, ?, ?, ?, ?, ?);';

            // Preparar la declaración
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(1, $comp_id, PDO::PARAM_STR);

            $stmt->bindParam(2, $comp_value, PDO::PARAM_STR);

            $stmt->bindParam(6, $comp_estado, PDO::PARAM_STR);

            $id_ = $this->idObtener() + 1;
            $longitud = count($array_comp_desc);

            for ($i = 0; $i < $longitud; $i++) {

                $idesc = $id_ + $i;

                $stmt->bindParam(3,  $idesc, PDO::PARAM_STR);
                $stmt->bindParam(4, $array_comp_desc[$i], PDO::PARAM_STR);
                $stmt->bindParam(5, $array_tipoanexo[$i], PDO::PARAM_STR);

                $stmt->execute();
            }

            echo "Inserción exitosa: " . $valor;
        } catch (Exception $e) {
            echo "!Error al insertar: " . $e->getMessage() . "<br/>";
        }
    }
}

Conectar::Conexion();
$conexion = new Conectar();

//TIPO_ITSE($conexion);

function TIPO_ITSE($conexion)  ///1
{

    $comp_id = '1';
    $comp_value = 'TIPOITSE';


    $array_comp_desc = array(
        "ITSE POSTERIOR AL INICIO DE ACTIVIDADES", //1  
        "ITSE PREVIA AL INICIO DE ACTIVIDADES", //1
        "ITSE POSTERIOR", //1
        "ITSE PREVIA", //1
        "ECSE HASTA 3000 PERSONAS", //1
        "ECSE MAYOR A 3000 PERSONAS", //1
        "ITSE POSTERIOR A LA LICENCIA DE FUNCIONAMIENTO", //6
        "ITSE POSTERIOR AL INICIO DE ACTIVIDADES", //6
        "ITSE PREVIA A LA LICENCIA DE FUNCIONAMIENTO",  //7
        "ITSE PREVIA AL INICIO DE ACTIVIDADES", //7
        "ITSE POSTERIOR A LA LICENCIA DE FUNCIONAMIENTO", //9
        "ITSE PREVIA A LA LICENCIA DE FUNCIONAMIENTO0", //9
        "ITSE POSTERIOR AL INICIO DE ACTIVIDADES", //9
        "ITSE PREVIA AL INICIO DE ACTIVIDADES" //9
    );

    $array_tipoanexo = array(
        "1",   //1
        "1",   //2
        "1",   //3
        "1",   //4
        "1",   //5
        "1",  //6
        "6",  //7
        "6",   //8
        "7",  //9
        "7",   //10
        "9",  //111
        "9",  //12
        "9", //13
        "9"  //14
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'TIPO_ITSE' // valor estatico
    );
}



//FUNCION($conexion);
function FUNCION($conexion)  ///1
{

    $comp_id = '2';
    $comp_value = 'FUNCION';


    $array_comp_desc = array(
        "ALMACEN", //1  
        "COMERCIO", //1
        "EDUCACION", //1
        "ENCUENTRO", //1
        "HOSPEDAJE", //1
        "INDUSTRIAL", //1
        "OFICINAS ADMINISTRATIVAS", //6
        "SALUD"

    );

    $array_tipoanexo = array(
        "G",   //1
        "G",   //2
        "G",   //3
        "G",   //4
        "G",   //5
        "G",   //6
        "G",   //7
        "G",   //8
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'FUNCION' // valor estatico
    );
}


// CLAISIFCACION_RIESGO($conexion);
function CLAISIFCACION_RIESGO($conexion)  ///1
{

    $comp_id = '3';
    $comp_value = 'CLASIFICACIONRIESGO';

    $array_comp_desc = array(
        "ITSE Riesgo bajo", //1  
        "ITSE Riesgo medio", //1
        "ITSE Riesgo alto", //1
        "ITSE Riesgo muy alto" //1
    );

    $array_tipoanexo = array(
        "1",   //1
        "1",   //2
        "1",   //3
        "1",   //4
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'CLAISIFCACION_RIESGO' // valor estatico
    );
}


//REPRESENTANTE($conexion);
function REPRESENTANTE($conexion)
{

    $comp_id = '4';
    $comp_value = 'REPRESENTANTE';

    $array_comp_desc = array(
        "PROPIETARIO",
        "REPRESENTANTE LEGAL",
        "CONDUCTOR / ADMINISTRADOR",
        "ORGANIZADOR / PROMOTOR"
    );

    $array_tipoanexo = array(
        "1",   //1
        "1",   //2
        "1",   //3
        "1",   //3
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'REPRESENTANTE' // valor estatico
    );
}


// LICENCIA_FUNCIONAMIENTO($conexion);
function LICENCIA_FUNCIONAMIENTO($conexion)
{

    $comp_id = '5';
    $comp_value = 'LICENCIA_FUNCIONAMIENTO';

    $array_comp_desc = array(
        "Requiere Licencia de Funcionamiento",
        "No requiere Licencia de Funcionamiento"
    );

    $array_tipoanexo = array(
        "4",   //1
        "4"  //2
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'LICENCIA_FUNCIONAMIENTO' // valor estatico
    );
}

function RESULTADO_RIEGO($conexion){

    $comp_id = '5';
    $comp_value = 'LICENCIA_FUNCIONAMIENTO';

    $array_comp_desc = array(
        "Requiere Licencia de Funcionamiento",
        "No requiere Licencia de Funcionamiento"
    );

    $array_tipoanexo = array(
        "4",   //1
        "4"  //2
    );

    $comp_estado = 'A';

    $conexion->insertarDatos(
        $comp_id, // valor estatico
        $comp_value, // valor estatico
        $array_comp_desc, // valor dinamico
        $array_tipoanexo, // valor estatico por ahora
        $comp_estado,
        'LICENCIA_FUNCIONAMIENTO' // valor estatico
    );
}
