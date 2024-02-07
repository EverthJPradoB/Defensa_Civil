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

            $sql = "SELECT aux_idesc FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '3' ORDER BY aux_idesc::int  DESC LIMIT 1 ";
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

// //RIESGO_INCENDIO()
// function RIESGO_INCENDIO()
// {

// RIESGO_DE_INCENDIO____MEDIOS_EVACUACION_SEÑALIZACIÓN_OTROS($conexion);
function RIESGO_DE_INCENDIO____MEDIOS_EVACUACION_SEÑALIZACIÓN_OTROS($conexion)  ///1
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '1';
    $aux_cat = 'MEDIOS DE EVACUACION, SEÑALIZACIÓN Y OTROS';

    $arrayAux_desc1 = array(
        "MEDIOS DE EVACUACION, SEÑALIZACIÓN Y OTROS", // 1
        "Ampliar los medios de evacuación (pasadizos, escaleras, accesos y salidas)
        del establecimiento de manera de cumplir con el ancho mínimo de 1.20 m o que
        permita la evacuación de las personas de manera segura. RNE A.010.", //2
        "Retirar los obstáculos de los medios de evacuación (pasadizos, escaleras,
        accesos y salidas). RNE A.130 Art 13; A.010 Art 25", //3
        "Implementar / completar la señalización de seguridad (direccionales de
        salida, salida, zona segura en caso de sismo, riesgo eléctrico, extintores, otros),
        según lo establecido en el RNE A.130, Art. 39 y la NTP 399.010 -1", //4
        "Dar mantenimiento a las luces de emergencia inoperativas. RNE- A-130 Art. 40.", //5
        "Acondicionar las puertas que se utilizan como medios de evacuación para
        que abran en el sentido del flujo de los evacuantes o permanezcan abiertas en
        horario de atención, sin obstruir la libre circulación y evacuación. RNE A130 Art. 5 y 6", //6
        "Instalar barra antipánico en puerta de salida de ambiente con aforo mayor
        a 100 personas. RNE A130 Art. 8", //7
        "Retirar debajo de las escaleras utilizadas como medios de evacuación el
        material combustible o inflamable (cartones, muebles, plásticos otros similares). RNE
        A.010 Art. 26, b16", //8
        "Colocar pasamanos a ambos lados en escaleras de evacuacion o escalera
        integrada utilizada como medio de evacuacion con ancho minimo de 1.20M hasta
        2.40M RNE A.010 hasta la A.110;", //9
        "Instalar barrera de contencion y direccionamiento en nivel de salida de
        evacuacion de la escalera para evitar seguir evacuando hacia el sotano. RNE A.010: 26 b.4" //10
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____MEDIOS_EVACUACION_SEÑALIZACIÓN_OTROS",
        0
    );
}
/////////////////////////------------------------------------------
// RIESGO_DE_INCENDIO____INSTALACIONES_ELECTRICAS($conexion);
function RIESGO_DE_INCENDIO____INSTALACIONES_ELECTRICAS($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '2';
    $aux_cat = 'INSTALACIONES ELÉCTRICAS';

    $arrayAux_desc1 = array(
        "INSTALACIONES ELÉCTRICAS",
        "Instalar un gabinete de material metálico o de resina termoplástica y/o debe
       encontrase en buen estado de conservación. CNE-U 020.024, 020.026 b.",
        "Instalar interruptores termomagnéticos que correspondan a la capacidad de
       corriente de los conductores eléctricos que protege. Retirar las llaves tipo cuchilla.
       CNE-U 080.010, 080.100, 080.400",
        "Independizar los circuitos eléctricos de manera de tener un interruptor
       termomagnético por circuito",
        "Instalar un interruptor general al interior del tablero o adyacente al mismo.
       CNE-U 080.010, 080.100, 080.400",
        "Retirar conductores flexibles (tipo mellizo) en instalaciones permanentes de
       alumbrado y/o tomacorriente. CNE-U 030.010.3",
        "Retirar extensiones o adaptadores de los circuitos de tomacorrientes
       sobrecargados. CNE-U 080.100 a",
        "Instalar cables y conductores eléctricos del tipo no propagador del incendio, con baja emisión de humos, libre de halógenos y ácidos corrosivos en cines, teatros,
       auditorios, estadios, ferias, parques de atracciones, salas de fiesta, discotecas,
       salas de juego de azar y similares, templos, museos, salas de conferencias,
       establecimientos comerciales, centros comerciales, mercados, hoteles y similares,
       hospitales, clínicas, bibliotecas, colegios, universidades y otros.
       CNE-U 010.010.4, 020.126 (RM No. 175-2008-MEM/DM)",
        "Conectar a la bomba de agua contra incendios, de forma independiente, no
       controlada por el interruptor general del edificio e interconectada al grupo
       electrógeno de emergencia del edificio, en caso de tenerlo. RNE IS 010.4.2. j"
    );


    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____INSTALACIONES_ELECTRICAS",
        0,
    );
}

// RIESGO_DE_INCENDIO____MEDIOS_DE_PROTECCIÓN_CONTRA_INCENDIOS($conexion);
function RIESGO_DE_INCENDIO____MEDIOS_DE_PROTECCIÓN_CONTRA_INCENDIOS($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '3';
    $aux_cat = 'MEDIOS DE PROTECCIÓN CONTRA INCENDIOS';

    $arrayAux_desc1 = array(
        "MEDIOS DE PROTECCIÓN CONTRA INCENDIOS",
        "Realizar mantenimiento a los extintores inoperativos e implementar una
        cantidad adecuada de acuerdo al riesgo existente en el establecimiento según la
        memoria descriptiva presentada. NTP 350.043:2011",
        "Actualizar la tarjeta de control y mantenimiento.",
        "Instalar los extintores a una altura no mayor de 1.50m y numerados",
        "Ubicar los extintores en lugares accesibles.",
        "Actualizar la constancia de operatividad y mantenimiento. RNE A 130 ART 163, 165; NTP 350.043-1s",
        "Colocar los extintores ubicados a la intemperie dentro de gabinetes o
       cobertores. RNE A 130 ART 163, 165; NTP 350.043-1",
        "Desarrollar el plan de seguridad según lo establecido en el literal e),
       numeral 2.2.1.3 del Manual de Ejecución de Inspección Técnica de Seguridad en Edificaciones. DS N° 002-2018 PCM",
        "Cambiar las mangueras de tipo flexible deterioradas, rajadas y/o limpiarlas de la grasa",
        "Fijar la manguera con abrazaderas. DS N° 027-94 EM",
    
        "Instalar tuberías de cobre o fierro galvanizado en las instalaciones de GLP
       que utilizan cilindros tipo 45 (de capacidad mayor a 25Kg). DS N° 027-94 EM",
        "Alejar los cilindros de GLP de interruptores a una distancia mayor a 0.30m,
       y de tomacorrientes a una distancia mayor a 0.50m",
        "Ubicar los cilindros de GLP en lugares ventilados y alejados de cualquier fuente de calor. DS N° 027-94 EM.",
        "Retirar los cilindros de GLP ubicados en nivel de semisótano, sótanos,
       cajas de escalera, pasillos, pasadizos de uso común y vía pública. DS N° 027-94 EM.",
        "Instalar dos fuentes de alimentación de energía independientes para los
       motores del ventilador y con transferencia automática. RNE A 130 Art. 34",
        "Realizar mantenimiento y/o actualizar el protocolo de operatividad y
       mantenimiento del sistema mecánico de presurización de la escalera emitido por
       una empresa especializada o profesional calificado. CNE-U 010.010-3",
        "Implementar y/o realizar mantenimiento al sistema de protección
       contraincendios a base de agua. Presentar o actualizar el protocolo de operatividad
       y mantenimiento. RNE A130",
        "Instalar / realizar mantenimiento al sistema de rociadores. Presentar o
       actualizar el protocolo de operatividad y mantenimiento, así como la memoria
       descriptiva del sistema por empresa especializada o profesional calificado. RNE
       A130 Art. 162 ",
        "Instalar puertas cortafuego de resistencia adecuada",
        "Presentar certificacion del fabricante y/o proveeedor autorizado de
       resistencia al fuego de los marcos, puertas, y accesorios de evacuación.",
        "Presentar declaracion jurada de resistencia al fuego de la puerta en
       caso de edificaciones anteriores a junio del 2006 firmada por el propietario de la
       edificación. RNE A.010 Art. 26 b), A.130:art.,7-8, 10-11, A 010 Art. 26.b,A.060 art. 13"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____MEDIOS_DE_PROTECCIÓN_CONTRA_INCENDIOS",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_COMERCIO($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_COMERCIO($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '4';
    $aux_cat = 'PARA LA FUNCIÓN COMERCIO';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN COMERCIO",
        "Instalar / realizar mantenimiento al sistema de detección y alarma de
     incendios centralizado. Presentar o actualizar el protocolo de operatividad y
     mantenimiento. RNE A.130 Art 89",
        "Instalar / realizar mantenimiento a los extintores de acetato de potasio.
     Presentar o actualizar el protocolo de operatividad y mantenimiento. NTP
     350.043:2011; RNE A-130 Art. 165"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";
    // $tipoAnexo = array(
    //     "{4,6A,7A}",
    //     "{7A}",
    //     "{4,6A}",
    //     "{4,6A,7A}",
    // );

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_COMERCIO",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ENCUENTRO($conexion);
//modificar, algulas lineas tiene _____, osea otro tipo de campo en la base de datos
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ENCUENTRO($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';
    //
    $aux_catacod = '5';
    $aux_cat = 'PARA LA FUNCIÓN ENCUENTRO';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN ENCUENTRO",
        "Instalar / realizar mantenimiento al sistema de detección y alarma de
       incendios. Presentar o actualizar el protocolo de operatividad y mantenimiento. RNE
       A.130 Art 53",
        "Ampliar y/o incrementar salidas existentes para cumplir con las
       dimensiones de ancho minimo de _________ ml.",
        "Construir una escalera de ancho ________.ml como una salida alterna
       independiente de salida de la escalera de uso general y conectada a la escalera de
       emergencia a prueba de humo con acceso directo al exterior",
        "Reducir aforo y mobiliario para cumplir con los medios de evacuacion
       existentes. RNE A.100 Art. 8,16 c),A.130 -22)",
        "Instalar / realizar mantenimiento a los extintores de acetato de potasio.
       Presentar o actualizar el protocolo de operatividad y mantenimiento. NTP
       350.043:2011; RNE A-130 Art. 165"

    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";


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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ENCUENTRO",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '6';
    $aux_cat = 'PARA LA FUNCIÓN DE OFICINAS ADMINISTRATIVAS';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN DE OFICINAS ADMINISTRATIVAS",
        "Instalar / realizar mantenimiento al sistema de detección y alarma de
        incendios. Presentar o actualizar el protocolo de operatividad y mantenimiento. RNE
        A.130 Art 53"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_SALUD($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_SALUD($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '7';
    $aux_cat = 'PARA LA FUNCIÓN SALUD';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN SALUD",
        "Instalar / realizar mantenimiento al sistema de detección y alarma de
        incendios. Presentar o actualizar el protocolo de operatividad y mantenimiento. RNE
        A.130 Art 53",
        "Realizar mantenimiento al sistema de presurización de la escalera de
        evacuación y a sus componentes. Actualizar el protocolo de operatividad y
        mantenimiento. RNE- A 010.-Art26-b",
        "Instalar / realizar mantenimiento al sistema de protección contra incendios a
        base de agua, (gabinetes contra incendio y/o rociadores). Presentar / actualizar la
        constancia de operatividad y mantenimiento. RNE A-130 Art.100, 159, 160, 105, 153",
        "Instalar en la sala de operaciones y de partos , pisos conductivos
        antiestaticos de resietencia entre 0.5 y 1.0 megaohmios. RM N° 660-2014/MINSA"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_SALUD",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '8';
    $aux_cat = 'PARA LA FUNCIÓN HOSPEDAJE';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN HOSPEDAJE",
        "Instalar / realizar mantenimiento a los extintores de acetato de potasio.
       Presentar protocolo de operatividad y mantenimiento. NTP 350.043:2011; RNE A130 Art. 165",
        "Instalar / realizar mantenimiento al sistema de detección y alarma de
       incendios. Presentar o actualizar la constancia de operatividad y mantenimiento. RNE A.130 Art 53"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ALMACÉN($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ALMACÉN($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '9';
    $aux_cat = 'PARA LA FUNCIÓN ALMACÉN';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN ALMACÉN",
        "Clasificar y almacenar productos y materiales peligrosos (productos
        quimicos peligrosos) de acuerdo a las hojas de seguridad correspondientes (MSDS)
        RNE- A-130- Art. 175, Art 1762.",
        "Almacenar los materiales peligrosos con proteccion permanente,
        estable, impermeable y separado del suelo, con un sistema de drenaje adecuado.
        RNE 130 ART 177, ART 178",
        "Exhibir en lugar visible de acceso a las zonas de almacenaje, las
        etiquetas de los materiales peligrosos, guia de respuesta de emergencia, y hojas de
        seguridad del producto. (D.S.042 F.- Art. 1020)"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ALMACÉN",
        0
    );
}

// RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_INDUSTRIA($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_INDUSTRIA($conexion)
{
    $aux_itemcod = '3';
    $aux_item =  'OBSERVACIÓN SUBSANABLE';
    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '10';
    $aux_cat = 'PARA LA FUNCIÓN INDUSTRIA';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN INDUSTRIA",
        "En el caso de puertas de sala de calderas",
        "Aperturar una puerta a una distancia maxima de 15 metros y que abra
        hacia afuera.",
        "Cambiar el giro de apertura de la puerta hacia afuera",
        "Cerrar con muros resistentes al fuego en la colindancia con ambientes
        donde se fabriquen, empleen o manipulen material explosivo o altamante inflamable
        o en colindancia con ambientes de uso publico o vias de evacuacion.
        RNC V-II-14.2, RNE: NTP 350.302-2009 art 5.1.2 a), b) c)
        D.S. 42 F Art. 458, 445, 457, UNE 60601 RNE EM 100 Art. 9; RNE EM 100 Art. 4.2",
        "Retirar el material de cierre o acabados que tienen riesgo inflamable o
        toxico. RNE A.130: CAP XI, CAP XII"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_INDUSTRIA",
        0
    );
}
//}
/* --------------------------RIESGO_COLAPSO----------------------------*/

// RIESGO_COLAPSO($conexion);
function RIESGO_COLAPSO($conexion)
{

    function RIESGO_COLAPSO_____________($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';
        //
        $aux_catacod = 11;
        $aux_cat = null;
        //
        $arrayAux_desc1 = array(
            "",
            "Controlar la filtración de agua, erosión o socavamiento u otros de manera
            que no afecte la cimentación o parte de ella. La cimentación no debe encontrarse
            expuesta. RNE E.050."
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO_____________",
            0
        );
    }
    RIESGO_COLAPSO_____________($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_CONCRETO($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 12;
        $aux_cat = "ESTRUCTURAS DE CONCRETO";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE CONCRETO",
            "Reparar o reforzar las estructuras de concreto que presentan fisuras,
            grietas, rajaduras, deflexiones, pandeos, muros inclinados, otros.",
            "Colocar recubrimiento de concreto o epóxico a las varillas de acero
            expuestas a la intemperie en columnas, vigas, losas de techos, otros.",
            "Reparar el deterioro de las estructuras originado por humedad,
            filtraciones de tanques y cisternas de almacenamiento de agua, de líquidos, tuberías
            rotas, lluvias, etc. Controlar las causas que originan la filtración, humedad y otros. RNE E.060 ",
            "Reparar o reforzar las estructuras de la edificación (losas y vigas de techos,
            azoteas o losas en niveles intermedios), que presentan fisuras, grietas, rajaduras,
            pandeos, deflexiones, humedad, otros; como consecuencia de sobrecargas
            existentes producidas por: tanque elevado, equipos, antenas, panel publicitario,
            otros. RNE E.060, E.020",
            "Reparar o reforzar los muros de contención en sótanos, en cercos y otros,
            que presentan fisuras, grietas, rajaduras, deflexiones, pandeos, inclinaciones,
            varillas de acero expuestas a la intemperie sin recubrimiento, deterioro por humedad
            producido por filtraciones de tanques y cisternas de almacenamiento de agua, de
            líquidos, tuberías rotas, lluvias, etc. y otros. RNE E.060"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO______ESTRUCTURAS_CONCRETO",
            0
        );
    } 
    RIESGO_COLAPSO______ESTRUCTURAS_CONCRETO($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ALBAÑILERÍA_LADRILLO($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 13;
        $aux_cat = "ESTRUCTURAS DE ALBAÑILERÍA (LADRILLO)";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ALBAÑILERÍA (LADRILLO)",
            "Confinar o amarrar la edificación de albañilería (muros) con elementos de
            concreto armado tales como: cimientos, columnas, vigas, losas. RNE E.070.",
            "Reparar los muros de albañilería que presentan daños por humedad,
            rajaduras, grietas, inclinaciones, otros. RNE E.070"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO______ESTRUCTURAS_ALBAÑILERÍA_LADRILLO",
            0
        );
    } 
    RIESGO_COLAPSO______ESTRUCTURAS_ALBAÑILERÍA_LADRILLO($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ADOBE($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 14;
        $aux_cat = "ESTRUCTURAS DE ADOBE";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ADOBE",
            "Reparar o reforzar los muros de adobe que presentan fallas y daños
            ocasionados por el deterioro y/o humedad (fisuras, grietas, inclinaciones).",
            "Retirar los materiales, suelos que ejercen empuje sobre los muros de
            adobe.",
            "Retirar construcciones de albañilería o concreto ubicadas sobre los muros de adobe",
            "Proteger a los muros de adobe de la lluvia en zonas lluviosas. RNE E.080, E.020"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO______ESTRUCTURAS_ADOBE",
            0
        );
    } 
    RIESGO_COLAPSO______ESTRUCTURAS_ADOBE($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_MADERA_BAMBÚ($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 15;
        $aux_cat = "ESTRUCTURAS DE MADERA / BAMBÚ";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE MADERA / BAMBÚ",
            "Retirar, reparar o reforzar las estructuras de madera, bambú, que presentan
            presentan rajaduras, deflexiones, pandeos, deterioro por apolillamiento, humedad,
            otros. RNE E.010",
            "Retirar, reparar o reforzar las estructuras (postes, columnas, vigas,
            viguetas, techos entablados, tijerales o cerchas, etc.), que presentan rajaduras,
            pandeos, deflexiones, como consecuencia de sobrecargas existentes producidas
            por: tanque elevado, equipos, antenas, panel publicitario, o como consecuencia de
            otros usos que impliquen cargas mayores a la que puede soportar la estructura. RNE
            E.010, E.020",
            "Retirar, proteger o aislar la estructura de madera que se encuentra cerca a
            fuentes de calor. Proteger con material incombustible y/o realizar tratamiento con
            sustancias retardantes o ignifugas u otro. RNE E.010 Numeral 11.3.8."
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO______ESTRUCTURAS_MADERA_BAMBÚ",
            0
        );
    }
    RIESGO_COLAPSO______ESTRUCTURAS_MADERA_BAMBÚ($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ACERO($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 16;
        $aux_cat = "ESTRUCTURAS DE ACERO";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ACERO",
            "Reparar o reforzar las edificaciones o techos de estructura de acero que
            presentan deformaciones o pandeos excesivos y visibles que perjudiquen su
            estabilidad",
            "Fijar de manera segura los apoyos, uniones y anclajes.",
            "Realizar mantenimiento contra el óxido y corrosión a los pernos y
            soldaduras. RNE E.090.",
            "Realizar mantenimiento contra el óxido y corrosión a las estructuras de
            acero. RNE E.090"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "RIESGO_COLAPSO______ESTRUCTURAS_ACERO",
            0
        );
    }
    RIESGO_COLAPSO______ESTRUCTURAS_ACERO($conexion);

}


/* --------------------------OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES----------------------------*/

// OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES($conexion);

function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES($conexion)
{

    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_ELECTROCUCIÓN($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 17;
        $aux_cat = "RIESGO DE ELECTROCUCIÓN";

        $arrayAux_desc1 = array(
            "RIESGO DE ELECTROCUCIÓN",
            "Conectar el sistema de puesta a tierra al tablero eléctrico de material
            metálico. CNE-U 060.402.1 h",
            "Instalar placa de protección (mandil). CNE-U 020.202.1",
            "Colocar tapas de proteccion en los espacios de reserva. CNE-U 070.3026",
            "Instalar protección de interruptores diferenciales en los circuitos eléctricos.
            CNE-U 020.132 (RM No.175-2008-MEM)",
            "Realizar mantenimiento a los componentes del pozo a tierra a tierra.",
            "Actualizar el protocolo de medición de la resistencia del pozo a tierra,
            firmado por un ingeniero electricista o mecánico electricista colegiado y habilitado.
            Dicho certificado debe tener un periodo de vigencia anual. CNE-U 060.712",
            "Instalar enchufes y tomacorrientes que conecten al sistema de puesta a
            tierra a los equipos y/o artefactos eléctricos, (hornos microondas, congeladoras,
            refrigeradoras, lavadoras, calentadores y similares). CNE-U 060 512.c",
            "Conectar al sistema de puesta a tierra las carcasas de los motores
            eléctricos estacionarios, grupos electrógenos y equipos de aire acondicionado.
            CNE-U 060.400, 060.402",
            "Conectar al sistema de puesta a tierra las estructuras metálicas de techos,
            anuncios publicitarios, canaletas y otros, que tienen instalado equipamiento eléctrico
            y se encuentran al alcance de una persona parada sobre el piso.
            CNE-U 060.002, 060.400",
            "Conectar la carcaza y motor del ascensor, montacargas, escaleras
            mecánicas y de equipos de elevación eléctrica, al sistema de puesta a tierra.
            CNE-U 200.046, 200.048",
            "Presentar constancia de operatividad y mantenimiento del ascensor,
            montacargas, escaleras mecanicas y equipos de elevacion electrica, , firmado por
            ing. mecánico, electricista o mecánico electricista colegiado y habilitado. CNE-U 010.010.3",
            "Instalar tubos y/o canaletas para dar proteccion a los conductores
            eléctricos. CNE-U 070.212",
            "Colocar tapas ciegas a las cajas de paso de conductores eléctricos.
            CNE-U 070.3002, 070.3004",
            "Proteger la subestación con cercos, tabiques o paredes para limitar el
            acceso de personas no autorizadas.",
            "Conectar la estructura metálica al sistema de puesta a tierra. SUM 110.A.1",
            "Conectar las estructuras metálicas de soporte y/o los equipos electrónicos,
            al sistema de puesta a tierra. CNE-U 060.102, 060.106",
            "Conectar las máquinas tragamonedas al sistema de puesta a tierra.
            CNE-U 060.106, 010.010.3",
            "Conectar los equipos electromecánicos de gimnasios al sistema de puesta
            a tierra. CNE-U 060.106, 010.010.3",
            "Actualizar los diagramas unifilares, plano(s) de distribución de tableros
            electricos y cuadro de cargas. RNE GE 020 Art.14, CNE-U 010.008"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_ELECTROCUCIÓN",
            0
        );
    }
    OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_ELECTROCUCIÓN($conexion);


    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_CAÍDAS($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 18;
        $aux_cat = "RIESGO DE CAÍDAS";

        $arrayAux_desc1 = array(
            "RIESGO DE CAÍDAS",
            "Instalar rampas con una pendiente no mayor al 12% , permitiendo la
            evacuación, colocando pisos antideslizantes y barandas. RNE A.130, Art. 16",
            "Instalar barandas o antepechos para evitar caidas al vacio en tragaluces,
            escaleras y azotea. RNE NTE 060 Art. 11; RNE A.010 Art. 33"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_CAÍDAS",
            0
        );
    }
    OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_CAÍDAS($conexion);



    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion)
    {
        $aux_itemcod = '3';
        $aux_item =  'OBSERVACIÓN SUBSANABLE';
        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 19;
        $aux_cat = "RIESGO DE COLAPSO EN ESTRUCTURAS DE SOPORTE Y OTROS";

        $arrayAux_desc1 = array(
            "RIESGO DE COLAPSO EN ESTRUCTURAS DE SOPORTE Y OTROS",
             "Fijar de manera segura y dar mantenimiento a las estructuras que soportan
             las antenas y/o paneles publicitarios. RNE E.090, GE.040 Art. 11 y 12.",
             "Fijar adecuadamente y dar mantenimiento a las estructuras metálicas de
             soporte de productos de almacenamiento (racks) . RNE E.090, GE.040 Art. 11 y 12",
             "Fijar adecuadamente y dar mantenimiento a las estructuras de soporte de
             equipos de aire acondicionado, condensadores y otros, apoyados en la pared y/o
             techo. RNE 0.90, GE.040 Art. 11 y 12",
             "Presentar constancia de operatividad y mantenimiento del sistema de
             extracción de monóxido de carbono. RNE A010 Articulo 69.",
             "Instalar de forma segura y dar mantenimiento a los juegos infantiles de
             carpintería metálica, de madera o plástico. RNE E.090, E.010, GE.040 Art. 11 y 12",
             "Instalar láminas de seguridad en los paños de vidrio primario en puertas,
             ventanas, mamaparas, techos, otros. RNE E.040 Art. 23 y GE.040 Art. 11 y 12",
             "Colocar identificacion a los tableros eléctricos. CNE-U 020.100.1,
             020.100.3.1",
             "Colocar directorio de los circuitos, indicando de manera visible y clara la
             instalación que controla. CNE-U 020.100.1, 020.100.3.1",
             "Mantener espacio libre no menor a un metro frente a los tableros eléctricos. CNE-U 020.308",
             "nstalar iluminación general y de emergencia en la zona de ubicación de
             los tableros eléctricos. CNE-U 020.314",
             "Presentar constancia de registro de hidrocarburos emitido por
             OSINERGMIN, ademas de la constancia de Operatividad y mantenimiento de la red
             de interna de GLP y/o líquido combustible, emitido por empresa o profesional
             especializado. NTP 321.121",
             "Mostrar el libro del servicio del caldero visado por el Ministerio de
             Trabajo y actualizado a la fecha",
             "Realizar mantenimiento conservando el nivel del agua dentro del rango
             de mínimo y máximo, la presión de trabajo menor a la presión del fabricante y contar
             con valvula de seguridad, presostato, manometro.",
             "Cercar con muros de resistencia al fuego, si se encuentra el caldero en
             una ruta de evacuación. DS No. 042-F",
             "Realizar mantenimiento al caldero y presentar constancia, firmada por
             empresa o profesional especializado. DS No. 042-F",
             "Presentar constancia de capacitación del personal a cargo de la operación
             del caldero emitido por un profesional o empresa especializada. DS No. 042-F",
             "Instalar sistemas a prueba de explosión. Ley No. 30299 y su Reglamento
             Decreto Supremo No. 010-2017-IN"       
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{7A}";

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
            "OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS",
            0
        );
    }
    OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion);


}


