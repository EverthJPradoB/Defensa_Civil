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

    public function idObtener()
    {
        try {
            $conexion = $this->Conexion();

            $sql = "SELECT aux_idesc FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '4' ORDER BY aux_idesc::int  DESC LIMIT 1 ";
            $stmt = $conexion->prepare($sql);
            $stmt->execute();

            // Obtener el resultado como un array asociativo
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cerrar la conexión


            // Retornar el valor de aux_idesc
            return isset($resultado['aux_idesc']) ? $resultado['aux_idesc'] : null;
        } catch (PDOException $e) {
            // Manejar la excepción si ocurre un error en la base de datos
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo,
        $name,
        $tipo
    ) {
        try {
            // Obtener la conexión
            $conexion = $this->Conexion();

            // Preparar la consulta SQL
            $sql = 'INSERT INTO sc_gitse3.tb_auxiliar__(
            	aux_itemcod, 
                aux_item, 
                aux_tipocod, 
                aux_tipo, 
                aux_catacod, 
                aux_cat, 
                aux_idesc, 
                aux_desc1, 
                aux_desc2, 
                aux_tipoanexo)
           	VALUES (
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?);';

            // Preparar la declaración
            $stmt = $conexion->prepare($sql);


            $stmt->bindParam(1, $aux_itemcod, PDO::PARAM_STR);

            $stmt->bindParam(2, $aux_item, PDO::PARAM_STR);

            $stmt->bindParam(3, $aux_tipocod, PDO::PARAM_STR);

            $stmt->bindParam(4, $aux_tipo, PDO::PARAM_STR);

            $stmt->bindParam(5, $aux_catacod, PDO::PARAM_STR);

            $stmt->bindParam(6, $aux_cat, PDO::PARAM_STR);


            if ($tipo != 1) {

                $stmt->bindParam(10, $tipoAnexo, PDO::PARAM_STR);
                // Iterar sobre cada elemento del array y realizar la inserción
                $longitud = count($arrayAux_desc1);
                $id_ = $this->idObtener() + 1;


                for ($i = 0; $i < $longitud; $i++) {

                    $idesc = $id_ + $i;

                    $stmt->bindParam(7,  $idesc, PDO::PARAM_STR);
                    $stmt->bindParam(8, $arrayAux_desc1[$i], PDO::PARAM_STR);
                    $stmt->bindParam(9, $arrayAux_desc2[$i], PDO::PARAM_STR);
                    $stmt->execute();
                }
            } else {


                // Iterar sobre cada elemento del array y realizar la inserción
                $longitud = count($arrayAux_desc1);
                $id_ = $this->idObtener() + 1;


                for ($i = 0; $i < $longitud; $i++) {

                    $idesc = $id_ + $i;

                    $stmt->bindParam(7,  $idesc, PDO::PARAM_STR);
                    $stmt->bindParam(8, $arrayAux_desc1[$i], PDO::PARAM_STR);
                    $stmt->bindParam(9, $arrayAux_desc2[$i], PDO::PARAM_STR);
                    $stmt->bindParam(10, $tipoAnexo[$i], PDO::PARAM_STR);
                    $stmt->execute();
                }
            }




            echo "Inserción exitosa ___ " . $name;
        } catch (Exception $e) {
            echo "!Error al insertar: " . $e->getMessage() . "<br/>";
        }
    }
}


Conectar::Conexion();
$conexion = new Conectar();


/* -------------------  RIESGO_DE_INCENDIO  -------------------------*/

// IV_DILIGENCIA_SUSPENDIDA_POR($conexion);
function IV_DILIGENCIA_SUSPENDIDA_POR($conexion)  ///1
{
    $aux_itemcod = '4';
    $aux_item =  'ANEXO 09 ACTA DE DILIGENCIA DE ITSE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'IV.- DILIGENCIA SUSPENDIDA POR';

    $aux_catacod = '1';
    $aux_cat = 'IV.- DILIGENCIA SUSPENDIDA POR';

    $arrayAux_desc1 = array(
        "IV.- DILIGENCIA SUSPENDIDA POR", // 1
       "1.- Por ausencia del/de la administrado/a o de la persona a quien este/a
       designe.",
       "2.- Por la complejidad del establecimiento objeto de Inspección",
       "3.- Por existir impedimentos para la verificación de
       todo o parte del establecimiento objeto de Inspección",
       "4.- Por caso fortuito o fuerza mayor",
       "Fecha de programación dentro de los dos (2) días hábiles siguientes:",
       "5.- Existen observaciones subsanables en cuanto al
       cumplimiento de condiciones de seguridad no relevantes
       en términos de riesgo",
       "4.- Existen observaciones subsanables en la ITSE
       Previa",
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{9}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo,
        "RIESGO_DE_INCENDIO____IV_DILIGENCIA_SUSPENDIDA_POR",
        0
    );
}

/////////////////////////------------------------------------------
// V_DILIGENCIA_NO_REALIZADA_POR($conexion);
function V_DILIGENCIA_NO_REALIZADA_POR($conexion)
{
    $aux_itemcod = '4';
    $aux_item =  'ANEXO 09 ACTA DE DILIGENCIA DE ITSE';

    //
    $aux_tipocod = '2';
    $aux_tipo = 'V.- DILIGENCIA NO REALIZADA POR';

    $aux_catacod = '2';
    $aux_cat = 'V.- DILIGENCIA NO REALIZADA POR';

    $arrayAux_desc1 = array(
        "V.- DILIGENCIA NO REALIZADA POR",
        "1.- Presentar un nivel de riesgo distinto al declarado, siendo este",
        "2.-  No se puede evaluar el riesgo y las condiciones de seguridad, al no
        encontrase implementado el Establecimiento Objeto de Inspección para el tipo de
        actividad a desarrollar."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{9}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,

        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo,
        "RIESGO_DE_INCENDIO____V_DILIGENCIA_NO_REALIZADA_POR",
        0,
    );
}

// PARA_EL_CASO_DE_LA_ITSE_POSTERIOR($conexion);
function PARA_EL_CASO_DE_LA_ITSE_POSTERIOR($conexion)
{
    $aux_itemcod = '4';
    $aux_item =  'ANEXO 09 ACTA DE DILIGENCIA DE ITSE';
    //
    $aux_tipocod = '3';
    $aux_tipo = 'VI.- VERIFICACIÓN DEL CUMPLIMIENTO DE LAS CONDICIONES DE SEGURIDAD';

    $aux_catacod = '3';
    $aux_cat = 'VI.1.- PARA EL CASO DE LA ITSE POSTERIOR: Observaciones subsanables en cuanto al cumplimiento de condiciones de seguridad no relevantes en terminos de riesgo';

    $arrayAux_desc1 = array(
        "VI.1.- PARA EL CASO DE LA ITSE POSTERIOR: Observaciones subsanables en cuanto al cumplimiento de condiciones de seguridad no relevantes en terminos de riesgo",
       " Dejar libre de obstáculos los medios de evacuación (pasadizos, escaleras, accesos y salidas). RNE A.130
       Art 13; A.010 Art 25",
       " Completar la señalización de seguridad faltante (direccionales de salida, salida, zona segura en caso de
       sismo, riesgo eléctrico, extintores, otros). RNE A.130, Art. 39; NTP 399.010 -1",
       "Poner operativas las luces de emergencia faltantes. RNE- A-130 Art. 40",
       "Acondicionar las puertas que se utilizan como medios de evacuación para que abran en el sentido del flujo
       de los evacuantes o hacer que permanezcan abiertas en horario de atención, sin obstruir la libre circulación y
       evacuación. . RNE A130 Art. 5 y 6",
       "Recargar los extintores con fecha de recarga vencida.",
       "Completar la cantidad de extintores de acuerdo a lo declarado. NTP 350.043:2011",
       "Actualizar la tarjeta de control y mantenimiento de los extintores,",
       "ubicarlos a una altura no mayor de 1.50m y en lugares accesibles,",
       "numerarlos",
       "Presentar constancia de operatividad y mantenimiento. RNE A 130 Art. 163, 165; NTP 350.043-1",
       "Colocar dentro de gabinetes o cobertores los extintores ubicados a la intemperie. RNE A 130 ART 163, 165; NTP 350.043-1",
       "Colocar tapas a la aberturas no usadas en los tableros eléctricos (espacios de reserva). CNE-U 070.3026",
       "Presentar",
       "Actualizar el certificado de medición de resistencia del pozo a tierra, firmado por un
       ingeniero electricista o mecánico electricista colegiado y habilitado. CNE-U 060.712",
       "Conectar al sistema de puesta a tierra los equipos y/o artefactos eléctricos que faltan, instalar
       enchufes con espiga de puesta a tierra y/o tomacorrientes con puesta a tierra.CNE-U 060 512.c",
       "Proteger con tubos o canaletas de PVC los conductores eléctricos faltantes. CNE-U 070.212",
       "Colocar tapas a las cajas de paso de conductores eléctricos. CNE-U 070.3002, 070.3004",
       "Colocar identificación a el(los) tablero(s) eléctrico(s). CNE-U 020.100.1, 020.100.3.1",
       "Colocar directorio de circuitos en el(los) tablero(s) eléctrico(s) de la instalación que controla de
       manera clara y visible. CNE-U 020.100.1, 020.100.3.1",
       "Dejar espacio libre no menor a un metro frente a los tableros eléctricos. CNE-U 020.308",
       "Instalar iluminación general y de emergencia en la zona de ubicación de los tableros eléctricos.
       CNE-U 020.314",
       "EL ESTABLECIMIENTO OBJETO DE INSPECCCION NO CUMPLE CON LAS CONDICIONES DE SEGURIDAD SEGÚN LO VERIFICADO POR EL INSPECTOR",
       "Plazo de Subsanación:",
       "Nota: Para el levantamiento de las observaciones subsanables en cuanto al cumplimiento de condiciones de seguridad no relevantes en términos de
       riesgo, el administrado debe presentar por mesa de partes del Gobierno Local una declaración jurada acompañada de panel fotográfico legible, con
       leyenda explicativa que sustente el levantamiento de las subsanaciones y en las que se pueda apreciar el cumplimiento de las condiciones de seguridad
       del Establecimiento Objeto de Inspección, de sus instalaciones, equipos y otros observados; pudiendo adicionalmente presentar documentación que
       estime pertinente para sustentar el levantamiento de dichas observacioners.",
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{9}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo,
        "RIESGO_DE_INCENDIO____PARA_EL_CASO_DE_LA_ITSE_POSTERIOR",
        0
    );
}

// VI_PARA_EL_CASO_DE_LA_ITSE_PREVIA($conexion);
function VI_PARA_EL_CASO_DE_LA_ITSE_PREVIA($conexion)
{
    $aux_itemcod = '4';
    $aux_item =  'ANEXO 09 ACTA DE DILIGENCIA DE ITSE';
    //
    $aux_tipocod = '3';
    $aux_tipo = 'VI.- VERIFICACIÓN DEL CUMPLIMIENTO DE LAS CONDICIONES DE SEGURIDAD';

    $aux_catacod = '4';
    $aux_cat = 'VI.2.- PARA EL CASO DE LA ITSE PREVIA: En caso de SI existir observaciones subsanables';

    $arrayAux_desc1 = array(
        "VI.2.- PARA EL CASO DE LA ITSE PREVIA: En caso de SI existir observaciones subsanables",
        "EL ESTABLECIMIENTO OBJETO DE INSPECCIÓN NO CUMPLE CON LAS CONDICIONES DE SEGURIDAD SEGUN LO VERIFICADO POR EL GRUPO INSPECTOR",
        "Plazo de Subsanación:",
        "Fecha de reanudación de la diligencia de ITSE:"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{9}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,

        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo,
        "VI_PARA_EL_CASO_DE_LA_ITSE_PREVIA",
        0
    );
}
