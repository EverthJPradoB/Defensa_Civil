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

            $sql = "SELECT * FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '2'  ORDER BY aux_idesc::int  DESC LIMIT 1 ";
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
                echo "hola";

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

//RIESGO_DE_INCENDIO____MEDIOS_EVACUACION_SEÑALIZACIÓN_OTROS($conexion);
function RIESGO_DE_INCENDIO____MEDIOS_EVACUACION_SEÑALIZACIÓN_OTROS($conexion)  ///1
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '1';
    $aux_cat = 'MEDIOS DE EVACUACION, SEÑALIZACIÓN Y OTROS';

    $arrayAux_desc1 = array(
        "MEDIOS DE EVACUACION, SEÑALIZACIÓN Y OTROS",
        "Los medios de evacuación (pasadizos, escaleras, accesos y salidas) del
        establecimiento presentan un ancho mínimo de 1.20 m y/o que permitan la
        evacuación de las personas de manera segura. RNE A.010.",
        "Los medios de evacuación (pasadizos, escaleras, accesos y salidas) se
        encuentran libres de obstáculos. RNE A.130 Art 13; A.010 Art 25",
        "El establecimiento cuenta con señalización de seguridad (direccionales de salida,
        salida, zona segura en caso de sismo, riesgo eléctrico, extintores, otros). RNE
        A.130, Art. 39; NTP 399.010 -1",
        "Cuenta con luces de emergencia operativas. RNE- A-130 Art. 40",
        "Las puertas que se utilizan como medios de evacuación abren en el sentido del
        flujo de los evacuantes o permanecen abiertas en horario de atención, sin obstruir
        la libre circulación y evacuación. RNE A130 Art. 5 y 6",
        "En caso de contar con un ambiente con aforo mayor a 100 personas, en cualquier
        caso, la puerta de salida cuenta con barra antipánico. RNE A130 Art. 8",
        "No cuenta con material combustible o inflamable debajo de las escaleras que
        sirvan como medios de evacuación (cartones, muebles, plásticos otros similares).
        RNE A.010 Art. 26, b16",
        "Las escaleras cumplen con las caraceristicas en numero y tipo (incluye
        excepciones de la norma señaladas en el RNE A010 art 28) pasos, dimensiones,
        contrapasos, descansos y barandas correspondientes al tipo de la edificación y su
        altura. RNE A.010 hasta la A.110; A.140",
        "Las escaleras que comunican todos los niveles de la edificacion, son continuas
        desde el primer piso hasta el ultimo en sentido vertical u horizontal estan
        intercomunicadas entre si, por pasadizos de circulacion libre. Barreras de
        contencion y direccionamiento en piso de evacuacion en escaleras con continuidad
        a niveles inferiores de la salida de evacuacion. Las escaleras a los sotanos podran
        ser independientes; RNE A.010: 26 b.4"

    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{4, 6A,7A}";

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
//RIESGO_DE_INCENDIO____INSTALACIONES_ELECTRICAS($conexion);
function RIESGO_DE_INCENDIO____INSTALACIONES_ELECTRICAS($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '2';
    $aux_cat = 'INSTALACIONES ELÉCTRICAS';

    $arrayAux_desc1 = array(
        "INSTALACIONES ELÉCTRICAS",
        "El gabinete es de material metálico o de resina termoplástica y/o se encuentran en
        buen estado de conservación. CNE-U 020.024, 020.026 b",
        "Cuenta con interruptores termomagnéticos y corresponden a la capacidad de
        corriente de los conductores eléctricos que protege. No utiliza llaves tipo cuchilla.
        CNE-U 080.010, 080.100, 080.400",
        "Cuenta con un circuito eléctrico por cada interruptor termomagnético. El tablero
        tiene un interruptor general en su interior o adyacente al mismo. CNE-U 080.010,
        080.100, 080.400",
        "No utiliza conductores flexibles (tipo mellizo) en instalaciones permanentes de
        alumbrado y/o tomacorriente. CNE-U 030.010.3",
        "Los circuitos de tomacorrientes no están sobrecargados con extensiones o
        adaptadores. CNE-U 080.100 a",
        "En locales de pública concurrencia construidos con posterioridad a abril del 2008
        tales como: cines, teatros, auditorios, estadios, ferias, parques de atracciones,
        salas de fiesta, discotecas, salas de juego de azar y similares, templos, museos,
        salas de conferencias, establecimientos comerciales, centros comerciales,
        mercados, hoteles y similares, hospitales, clínicas, bibliotecas, colegios,
        universidades y otros, las instalaciones eléctricas de cables y conductores
        eléctricos deben ser del tipo no propagador del incendio, con baja emisión de
        humos, libre de halógenos y ácidos corrosivos.
        CNE-U 010.010.4, 020.126 (RM No. 175-2008-MEM/DM)",
        "La alimentación eléctrica a la bomba de agua contra incendios es independiente, no controlada por el interruptor general del edificio e interconectada al grupo
        electrógeno de emergencia del edificio, en caso de tenerlo. RNE IS 010.4.2. j"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{4, 6A,7A}";

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

//RIESGO_DE_INCENDIO____MEDIOS_DE_PROTECCIÓN_CONTRA_INCENDIOS($conexion);
function RIESGO_DE_INCENDIO____MEDIOS_DE_PROTECCIÓN_CONTRA_INCENDIOS($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '3';
    $aux_cat = 'MEDIOS DE PROTECCIÓN CONTRA INCENDIOS';

    $arrayAux_desc1 = array(
        "MEDIOS DE PROTECCIÓN CONTRA INCENDIOS",
        "Cuenta con extintores operativos y en cantidad adecuada de acuerdo al riesgo
            existente en el establecimiento. NTP 350.043:2011",
        "Los extintores cuentan con tarjeta de control y mantenimiento actualizada, se
            encuentran operativos, a una altura no mayor de 1.50m, numerados, ubicados en
            los lugares accesibles. Los extintores tienen constancia de operatividad y
            mantenimiento. RNE A 130 ART 163, 165; NTP 350.043-1s",
        "Los extintores ubicados a la intemperie están colocados dentro de gabinetes o
            cobertores. RNE A 130 ART 163, 165; NTP 350.043-1",
        "Cuenta con plan de seguridad para hacer frente a los riesgos de incendio y otros
            vinculados a la actividad, para establecimientos de dos a más pisos. DS N° 002- 2018 PCM",

        /* 7A*/  "Las mangueras del tipo flexible de los cilindros (balones) de Gas Licuado de
            Petróleo (GLP) tipo 10 (de capacidad hasta 25kg) se encuentran en buen estado
            de conservación (sin rajaduras, libres de grasa, limpias, con sujeción firme con
            abrazaderas. DS N° 027-94 EM",

        /* 4 , 6A*/    "Los cilindros (balones) de Gas Licuado de Petróleo (GLP) tipo 10 (menos a 25kg) que cuentan con mangueras del tipo flexible, se encuentran en
            buen estado de conservación (sin rajaduras, libres de grasa, limpias, con sujeción firme con abrazaderas. DS N° 027-94 EM.",

        "Las instalaciones de GLP que utilizan cilindros tipo 45 (de capacidad mayor a
            25Kg), tienen tuberías de cobre o fierro galvanizado. DS N° 027-94 EM",
        "Los cilindros de GLP están alejados de interruptores a una distancia mayor a
            0.30m, y mayor a 0.50m de tomacorrientes, se ubican en lugares ventilados y
            alejados de cualquier fuente de calor. D S N° 027-94 EM.",
        "Los cilindros de GLP no se encuentran ubicados en nivel de semisótano, sótanos,
            cajas de escalera, pasillos, pasadizos de uso común y vía pública. DS N° 027-94 EM.",
        "En escaleras presurizadas, la alimentación de energía para los motores del
            ventilador debe contar con dos fuentes independientes, de transferencia
            automática. RNE A 130 Art. 34",
        "El sistema de presurización se encuentra en buen estado de conservación y
            operativo. CNE-U 010.010-3",
        "Cuenta con un sistema de proteccion contraincendios a base de agua en función al
            tipo de edificación, área, altura, y clasificacion del riesgo. RNE A-130 Art.100 y 102
            (DISEÑO) NFPA 14. VIVIENDA -art 66, 67, 69, y 70 art 71 y 75 art 81 art 89 art 99 art.100,
            102, 117, y 152) art 172, 179, y 181, 185 , 186, 187, 188, y 189.art 197 , 201 , 205 
            , 208 , 213 y 214 - RNE A.100 art 25 y 26. INDUSTRIAS - DS 42F, CAPITULO II, Seccion 2da Art 145",
        "Para todas las edificaciones se debe cumplir con las distancias máximas de
            recorrido hasta una zona segura exterior o hasta una escalera del tipo de
            evacuación. Los rociadores son de uso obligatorio en las edificaciones donde sea
            requerido de acuerdo a la norma en particular de cada tipo de edificación. NFPA 13. RNC S-224-1,2, RNE A.130 Art 102.A; Art 162 A.130 Art 161.COMERCIO RNE
            A.130 Art 89, y 96 OFICINAS - RNE A.130 Art 99; ALMACENES - RNE A.130 ART 171, ART
            181 (ALT MENOR A 3.7), 185 (ALT ENTRE 3.70 Y 7.6), 186 (ALT MAYOR A 7.6), Art 188,
            189, y 192; INDUSTRIAS USAR DS 42F art 114, 157, 158",
        "Las puertas de la escalera de evacuación cumplen con las caracteristicas de
            resistencia al fuego y cuentan con accesorios (cierrapuertas, barra antipanico)
            segun corresponda, en base al riesgo, tipo, uso y altura de la edificacion. RNE A.010 Art. 26 
            b), A.130:art.,7-8, 10-11, A 010 Art. 26.b,A.060 art. 13.)"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = array(
        "{4,6A,7A}", //0
        "{4,7A}", //1
        "{4,7A}", //2
        "{4,7A}", //3
        "{4,6A,7A}", //4
        "{7A}", //5
        "{4,6A}", //6
        "{4,6A,7A}", //7
        "{4,6A,7A}", //8
        "{4,6A,7A}", //9
        "{7A}", //10
        "{7A}", //11
        "{7A}", //12
        "{7A}", //13
        "{7A}", //14
    );

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
        1
    );
}

//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_COMERCIO($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_COMERCIO($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '4';
    $aux_cat = 'PARA LA FUNCIÓN COMERCIO';

    $arrayAux_desc1 = array(
        /*4,6A ,7A*/
        "PARA LA FUNCIÓN COMERCIO",
        /*7A */ "Cuenta con un sistema de detección y alarma de incendios centralizado operativo. Se encuentran exceptuados. RNE A.130 Art 89",

        /*4,6A */   "Cuenta con un sistema de detección y alarma de incendios centralizado operativo. Se encuentran exceptuados: Restaurantes con área
             construida menor a 300 m2, mercado minorista sin techo común (puestos independientes) solo pulsador de alarma, tienda de área techada menor a 250m2.
            RNE A.130 Art 89.",

        /*4,6A ,7A*/     "enta con extintores operativos en cantidad adecuada de acetato de potasio para
            ambientes que cuentan con freidora, producen humos y vapores de grasa. NTP
            350.043:2011; RNE A-130 Art. 165"
    );

    $arrayAux_desc2 = null;

    // $tipoAnexo = "{4, 6A,7A}";
    $tipoAnexo = array(
        "{4,6A,7A}",
        "{7A}",
        "{4,6A}",
        "{4,6A,7A}",
    );

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
        1
    );
}

//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ENCUENTRO($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ENCUENTRO($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '5';
    $aux_cat = 'PARA LA FUNCIÓN ENCUENTRO';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN ENCUENTRO",
        "Cuenta con un sistema de detección y alarma de incendios centralizado operativo.
             Están exceptuados los locales menores a 100m2 de área techada. RNE A.130 Art 53",
        "En salas de centro de diversion y espectaculos, el numero y dimension de las
             puertas de escape depende del numero de ocupantes y de la necesidad de
             evacuarlos en un maximo de 3 minutos.
             Los locales ubicados a uno o mas pisos por encima o por debajo del nivel de
               acceso al exterior deberán contar con una o mas salidas de emergencia de las
            escaleras de uso general que constituya una ruta de escape alterna, conectada a
                la escalera de emergencia con acceso directo al exterior. RNE A.100 Art. 8,16 c),A.130
                -22)",
        "Cuenta con extintores operativos en cantidad adecuada de acetato de potasio
                   (Tipo K) para ambientes que cuentan con freidora, producen humos y vapores de
              grasa. NTP 350.043:2011; RNE A-130 Art. 165"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = array(
        "{4,6A,7A}",
        "{4,6A,7A}",
        "{7A}",
        "{4,6A,7A}"
    );

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
        1
    );
}

//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '6';
    $aux_cat = 'PARA LA FUNCIÓN DE OFICINAS ADMINISTRATIVAS';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN DE OFICINAS ADMINISTRATIVAS",
        "Cuenta con un sistema de detección y alarma de incendios centralizado operativo. RNE A.130 Art 99",
        "Para edificaciones con conformidad de obra de una antigüedad no mayor a (5) años",

        "Cuenta con sistema de detección y alarma de incendios centralizado operativo, con red húmeda de agua contra incendios y gabinetes de
        mangueras y con sistema automático de rociadores para oficinas de más de cinco (5) niveles. RNE A-130 Art. 99",
        "Cuenta con dos escaleras de evacuación a prueba de fuego y humo y se encuentran operativas.
        RNE A-130 Art. 26",
        "Cuenta con una escalera de evacuación a prueba de fuego y humo y se encuentra operativa, ya
        que el edificio tiene una altura no mayor a (30) treinta metros, la planta completa de piso no supera
        el área máxima de 650m2, la carga máxima de evacuantes por planta (piso) no supera las 100
        personas, toda la edificación cuenta con un sistema de detección y alarma de incendios centralizado
        y cumple también con las demás exigencias establecidas en el RNE. RNE A-130 Art. 28 b)"


    );

    $arrayAux_desc2 = null;

    $tipoAnexo = array(
        "{4,6A,7A}",
        "{4,6A,7A}",
        "{4,6A}",
        "{4,6A}",
        "{4,6A}",
        "{4,6A}",
    );

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_DE_OFICINAS_ADMINISTRATIVAS",1
    );
}
//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_SALUD($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_SALUD($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '7';
    $aux_cat = 'PARA LA FUNCIÓN SALUD';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN SALUD",

        "En caso de contar con un sistema de detección y alarma de incendio centralizado,
        este se encuentra operativo; esto es obligatorio para centros de salud de dos o más pisos. RNE A.130 Art 53",

        "En caso de contar con escalera de evacuación presurizada, el sistema debe
        encontrarse operativo. RNE- A 010.-Art 26-b",

        "En caso de contar con un sistema de protección contra incendios a base de agua,
        (gabinetes contra incendio y/o rociadores), estos se encuentran operativos. Para
        centros de salud de tres o más niveles es obligatorio. RNE A-130 Art.100, 159, 160,
        105, 153.",

        "La sala de operaciones y de partos, cuentan con piso conductivo antiestatico, de
        resistencia entre 0.5 y 1.0 megaohmios. RM N° 660-2014/MINSA"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = array(
        "{4,6A,7A}",
        "{4,6A,7A}",
        "{4,6A,7A}",
        "{4,6A,7A}",
        "{4}",
    );

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
        1

    );
}

//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '8';
    $aux_cat = 'PARA LA FUNCIÓN HOSPEDAJE';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN HOSPEDAJE",
        "Cuenta con extintores operativos en cantidad adecuada, de acetato de potasio
        (Tipo K) para ambientes que cuentan con freidora, producen humos y vapores de
        grasa. NTP 350.043:2011; RNE A-130 Art. 165",
        "Cuenta con un sistema de detección y alarma de incendios centralizado y se
        encuentra operativo. RNE A.130 Art 71."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{4, 6A,7A}";

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
        "RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_HOSPEDAJE"
        ,0
    );
}


//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ALMACÉN($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_ALMACÉN($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '9';
    $aux_cat = 'PARA LA FUNCIÓN ALMACÉN';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN ALMACÉN",
        "Almacenaje no techado de productos peligrosos.Las mercancias deben ser almacenadas en funcion al tipo de riesgo, no juntando o almacenando productos
        que reaccionan entre si y/o que no son compatibles, de acuerdo a las guias NFPA
        49 491, RNE- A-130- Art. 175, Art 176, Art 177, Art 178.NFPA 704.D.S.042 F.- Art. 1020
        Almacenaje techado de productos peligrosos.Los almacenes mayores a 250 m2
        destinados a carga y/o mercaderias y/o materiales peligrosos, deberan ser diseñados y protegidos segun NFPA 5000.Basados en el grado de peligrosidad y
        cantidad de mercancia almacenada. RNE A.130 Art 188"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{4, 6A,7A}";

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

//RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_INDUSTRIA($conexion);
function RIESGO_DE_INCENDIO____PARA_LA_FUNCIÓN_INDUSTRIA($conexion)
{
    $aux_itemcod = '2';
    $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

    //
    $aux_tipocod = '1';
    $aux_tipo = 'RIESGO DE INCENDIO';

    $aux_catacod = '10';
    $aux_cat = 'PARA LA FUNCIÓN INDUSTRIA';

    $arrayAux_desc1 = array(
        "PARA LA FUNCIÓN INDUSTRIA",
        "En salas de calderas, la puerta se ubica a una distancia no mayor de 15 metros y
      abre hacia afuera.
      Cerramiento en colindancia con ambiente donde se fabriquen , empleen o manipulen material explosivo o altamante inflamable o en colindancia con
      ambientes de uso publico o vias de evacuacion, se encuentran cerrados
      completamente con muros resistentes al fuego de minimo 2 horas.
      RNC V-II-14.2, RNE: NTP 350.302-2009 art 5.1.2 a), b) c)
      D.S. 42 F Art. 458, 445, 457, UNE 60601 RNE EM 100 Art. 9; RNE EM 100 Art. 4.2",
        "Los elementos de cierre o acabados no presentan caracteristicas de riesgo
      inflamable o toxico, como poliuretano expandido, espuma plastica, plasticos,
      cauchos, cartones , y similar. RNE A.130: CAP XI, CAP XII
      "
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{4, 6A,7A}";

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

RIESGO_COLAPSO($conexion);

function RIESGO_COLAPSO($conexion)
{

    function RIESGO_COLAPSO_____________($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 11;
        $aux_cat = null;

        $arrayAux_desc1 = array(
            "",
            "La cimentación o parte de ella no se encuentra expuesta, inestable en peligro de
            colapso como consecuencia de filtraciones de agua, erosión, socavamiento, otros. RNE E.050."
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    //RIESGO_COLAPSO_____________($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_CONCRETO($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 12;
        $aux_cat = "ESTRUCTURAS DE CONCRETO";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE CONCRETO",
            "Las estructuras de concreto no presentan i) fisuras, grietas, rajaduras, deflexiones,
            pandeos, muros inclinados, varillas de acero expuestas a la intemperie sin
            recubrimiento en: columnas, vigas, losas de techos, etc., ii) deterioro por humedad
            producido por: filtraciones, de tanques y cisternas de almacenamiento de agua, de
            líquidos, tuberías rotas, lluvias, etc., otras fallas estructurales. RNE E.060",
            "Las estructuras de la edificación (losas y vigas de techos, azoteas o losas en
            niveles intermedios), no presentan fisuras, grietas, rajaduras, pandeos, deflexiones,
            humedad, otros; como consecuencia de sobrecargas existentes producidas por:
            tanque elevado, equipos, antenas, panel publicitario, otros. RNE E.060, E.020",
            "Los muros de contención en sótanos, en cercos y otros, no presentan fisuras,
            grietas, rajaduras, deflexiones, pandeos, inclinaciones, varillas de acero expuestas a la intemperie sin recubrimiento, deterioro por humedad producido por filtraciones
            de tanques y cisternas de almacenamiento de agua, de líquidos, tuberías rotas,
            lluvias, etc. y otros. RNE E.060",
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    } //RIESGO_COLAPSO______ESTRUCTURAS_CONCRETO($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ALBAÑILERÍA_LADRILLO($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 13;
        $aux_cat = "ESTRUCTURAS DE ALBAÑILERÍA (LADRILLO)";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ALBAÑILERÍA (LADRILLO)",
            "La edificación de albañilería cuenta con elementos de concreto armado de
            confinamiento, amarre y/o arriostramiento tales como: cimientos, columnas, vigas,
            losas. RNE E.070.",
            "Los muros de albañilería no presentan daños: humedad, rajaduras, grietas,
            inclinaciones, otros. RNE E.070"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    } //RIESGO_COLAPSO______ESTRUCTURAS_ALBAÑILERÍA_LADRILLO($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ADOBE($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 14;
        $aux_cat = "ESTRUCTURAS DE ADOBE";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ADOBE",
            "Los muros de albañilería no presentan daños: humedad, rajaduras, grietas,
            inclinaciones, otros. RNE E.070"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    } //RIESGO_COLAPSO______ESTRUCTURAS_ADOBE($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_MADERA_BAMBÚ($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 15;
        $aux_cat = "ESTRUCTURAS DE MADERA / BAMBÚ";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE MADERA / BAMBÚ",
            "Las estructuras de madera, bambú, no presentan rajaduras, deflexiones, pandeos,
           deterioro por apolillamiento, humedad, otros. RNE E.010",
            "Las estructuras (postes, columnas, vigas, viguetas, techos entablados, tijerales o
           cerchas, etc.), no presentan rajaduras, pandeos, deflexiones, como consecuencia
           de sobrecargas existentes producidas por: tanque elevado, equipos, antenas,
           panel publicitario, o como consecuencia de otros usos que impliquen cargas
           mayores a la que puede soportar la estructura. RNE E.010, E.020",
            "La estructura de madera se encuentra alejada o aislada de fuentes de calor que
           podrían dañarla, o en caso de encontrarse próxima a fuentes de calor, se
           encuentra protegida con material incombustible y/o tratada con sustancias
           retardantes o ignifugas. RNE E.010 Numeral 11.3.8."
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    //RIESGO_COLAPSO______ESTRUCTURAS_MADERA_BAMBÚ($conexion);

    function RIESGO_COLAPSO______ESTRUCTURAS_ACERO($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '2';
        $aux_tipo = 'RIESGO DE COLAPSO';

        $aux_catacod = 16;
        $aux_cat = "ESTRUCTURAS DE ACERO";

        $arrayAux_desc1 = array(
            "ESTRUCTURAS DE ACERO",

            "Las edificaciones o techos de estructura de acero no presentan deformaciones o
         pandeos excesivos y visibles que perjudiquen su estabilidad. Los apoyos, uniones
         y anclajes son seguros (tienen pernos y soldaduras en buen estado de
         conservación). RNE E.090",

            "No presentan deterioro por oxido y/o corrosión y se encuentra protegida contra
         este. RNE E.090"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    // RIESGO_COLAPSO______ESTRUCTURAS_ACERO($conexion);

}


/* --------------------------OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES----------------------------*/

OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES($conexion);

function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES($conexion)
{

    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_ELECTROCUCIÓN($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 17;
        $aux_cat = "RIESGO DE ELECTROCUCIÓN";

        $arrayAux_desc1 = array(
            "RIESGO DE ELECTROCUCIÓN",

            "El tablero eléctrico de material metálico está conectado a tierra. CNE-U 060.402.1 h",

            "El tablero cuenta con placa de protección (mandil). CNE-U 020.202.1",

            "Las aberturas no usadas en los tableros eléctricos (espacios de reserva) se
            encuentran cerradas con tapas. CNE-U 070.3026",

            "Todos los circuitos eléctricos tienen protección de interruptores diferenciales. CNE- U 020.132 (RM No.175-2008-MEM)",

            "Los componentes del pozo de puesta a tierra presentan óxido, deterioro del cable
            de conexión, conector y varilla en mal estado de conservacion . CNE-U 010.010.3",

            "Cuenta con certificado de medición de resistencia del pozo de tierra, firmado por un ingeniero
            electricista o mecánico electricista colegiado y habilitado, siendo la medida menor o igual a 25
            ohmios. Dicho certificado debe tener un periodo de vigencia anual. CNE-U 060.712",

            "Si cuenta con equipos y/o artefactos eléctricos, (hornos microondas, congeladoras,
            refrigeradoras, lavadoras, calentadores y similares) los enchufes tienen espiga de
            puesta a tierra y los tomacorrientes cuentan con conexión al sistema de puesta a
            tierra. CNE-U 060 512.c",

            "Las carcasas de los motores eléctricos estacionarios, grupos electrógenos y
            equipos de aire acondicionado están conectados al sistema de puesta a tierra. CNE- U 060.400, 060.402",

            "Las estructuras metálicas de techos, anuncios publicitarios, canaletas y otros, que
            tienen instalado equipamiento eléctrico y se encuentran al alcance de una persona
            parada sobre el piso, deben estar conectados al sistema de puesta a tierra. CNE-U
            060.002, 060.400",

            "La carcaza y motor del ascensor, montacargas, escaleras mecánicas y de equipos
            de elevación eléctrica, deben estar conectados al sistema de puesta a tierra.
            CNE-U 200.046, 200.048",

            "El ascensor, montacargas, escaleras mecanicas y equipos de elevacion electrica,
             cuentan con constancia de operatividad y mantenimiento, firmado por ing.
             mecánico, electricista o mecánico electricista colegiado y habilitado. CNE-U 010.010.3",

            "Los conductores eléctricos utilizados se encuentran protegidos con tubos o canaletas de PVC. CNEU 070.212",

            "Las cajas de paso de conductores eléctricos deben tener tapa. CNE-U 070.3002, 070.3004",

            "La subestación esta protegida con cercos, tabiques o paredes para limitar el acceso de personas no autorizadas. La estructura metálica esta conectada al
             sistema de puesta a tierra. SUM 110.A.1",

            "Las estructuras metálicas de soporte y/o los equipos electrónicos, deben estar
              conectados al sistema de puesta a tierra.
              CNE-U 060.102, 060.106",

            "Las máquinas tragamonedas no presentan superficies energizadas y están
               conectadas al sistema de puesta a tierra.
               CNE-U 060.106, 010.010.3",

            "Los equipos electromecánicos de gimnasios deben estar conectados al sistema de
               puesta a tierra.
               CNE-U 060.106, 010.010.3",

            "Los diagramas unifilares, plano(s) de distribución de tableros electricos y cuadro de
               cargas concuerdan con lo verificado físicamente. RNE GE 020 Art.14, CNE-U 010.008",
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = array(
            /// slgunos del 6a estan en la ultima tabla
            //utlizar la colusula in para ordenarlos
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{7A}",
            "{4,6A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{7A}",
            "{7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
        );

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
            1
        );
    }
    // OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_ELECTROCUCIÓN($conexion);


    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_CAÍDAS($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 18;
        $aux_cat = "RIESGO DE CAÍDAS";

        $arrayAux_desc1 = array(
            "RIESGO DE CAÍDAS",
            "Las rampas tienen una pendiente no mayor al 12% permitiendo la evacuación,
            tienen pisos antideslizantes y tienen barandas. RNE A.130, Art. 16",
            "Las aberturas al exterior ubicadas a una altura mayor a 1.00 m sobre el suelo, en
            tragaluces, escaleras y azotea cuentan con protección al vacío de altura mínima de
            1.00m, para evitar caídas al vacío. RNE NTE 060 Art. 11; RNE A.010 Art. 33"
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{4, 6A,7A}";

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
    //OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_CAÍDAS($conexion);



    function OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '3';
        $aux_tipo = 'OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES';

        $aux_catacod = 19;
        $aux_cat = "RIESGO DE COLAPSO EN ESTRUCTURAS DE SOPORTE Y OTROS";

        $arrayAux_desc1 = array(
            "RIESGO DE COLAPSO EN ESTRUCTURAS DE SOPORTE Y OTROS",
            "Las estructuras que soportan las antenas y/o paneles publicitarios son seguras,
            estables, tienen anclajes y se encuentran en buen estado de conservación, no
            presentan óxido o corrosión, inclinaciones que podrían desestabilizarlas y
            ocasionar su colapso. RNE E.090, GE.040 Art. 11 y 12",
            "Las estructuras metálicas de soporte de productos de almacenamiento (racks)
            están fijas, asegurando su estabilidad, se encuentran en buen estado de
            conservación, no presentan óxido o corrosión, inclinaciones que podrían
            desestabilizarlas y ocasionar su colapso. RNE E.090, GE.040 Art. 11 y 12",
            "Las estructuras de soporte de equipos de aire acondicionado, condensadores y
            otros, apoyados en la pared y/o techo, están adecuadamente fijadas y en buen
            estado de conservación, no presentan óxido ni corrosión. Los equipos instalados
            sobre estas estructuras se encuentran debidamente asegurados. RNE 0.90,
            GE.040 Art. 11 y 12",
            "En caso de contar con sistema el sistema de extracción de monóxido de carbono
            en sótano, éste se encuentra operativo y cuenta con constancia de operatividad y
            mantenimiento. RNE A010 Articulo 69",
            "Los juegos infantiles de carpintería metálica, de madera o plástico, son estables,
            seguros, están bien instalados y en buen estado de conservación. RNE E.090, E.010,
            GE.040 Art. 11 y 12",
            "Las puertas, ventanas, mamparas, techos; enchapes de muros con espejos,
            ubicados en áreas donde existe el riesgo de impacto accidental o de exposición de
            las personas ante roturas, que son de vidrio, son de vidrio templado o laminado. En
            caso de ser de vidrios primarios, tienen láminas de seguridad en todo el paño de
            vidrio u otro sistema de protección en caso de rotura. RNE E.040 Art. 23 y GE.040 Art. 11 y 12.",
            "El(los) tablero(s) eléctrico(s) cuenta(n) con identificación. CNE-U 020.100.1, 020.100.3.1",
            "Tiene directorio de los circuitos, indicando de manera visible y clara la instalación
            que controla. CNE-U 020.100.1, 020.100.3.1",
            "Existe espacio libre no menor a un metro frente a los tableros eléctricos. CNE-U
            020.308",
            "Existe iluminación general y de emergencia en la zona de ubicación de los tableros
            eléctricos. CNE-U 020.314",
            "Si el establecimiento cuenta con tanque estacionario de Gas Licuado de Petróleo
            (GLP) en cantidades superiores a 0.45m3 (118.18gl) y/o liquido combustible y sus derivados en cantidades a partir de 1m3 (264.17gl), llamado Consumidor Directo,
            debe tener constancia de registro de hidrocarburos emitido por OSINERGMIN. NTP
            321.121",
            "En caso de tener caldero: Mostrar el libro del servicio del caldero visado por el
            Ministerio de Trabajo, el mismo que debe estar actualizado a la fecha.
            El nivel del agua del caldero debe encontrarse dentro del rango de mínimo y
            máximo. La presión de trabajo debe ser menor a la presión indicada por el
            fabricante. El caldero debe contar con valvula de seguridad, presostato y
            manómetro.
            Para el caso del caldero que se encuentre en una ruta de evacuación debe estar
            cercado con muros de resistencia al fuego. De utilizar combustible GLP o GN no se
            permite su instalación en sótano. DS No. 042-F",
            "El caldero se encuentra en buen estado de conservación y mantenimiento. DS No. 042-F",
            "El caldero se encuentra operado por un personal calificado que cuenta con
            constancia de capacitación actualizada emitido por profesional o empresa
            especializada. DS No. 042-F",
            "Para edificaciones con giro de explosivos, artefactos pirotécnicos y otros afines:
                Cuenta con sistemas a prueba de explosión, si corresponde. Ley No. 30299 y su Reglamento Decreto Supremo No. 010-2017-IN"


        );

        $arrayAux_desc2 = null;

        $tipoAnexo = array(
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,6A,7A}",
            "{4,7A}",
            "{4,7A}",
            "{4,7A}",
            "{4,7A}",
            "{7A}",
            "{7A}",
            "{7A}",
            "{7A}",
            "{7A}",
        );

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
            1
        );
    }
    //OTROS_RIESGOS_VINCULADOS_ACTIVIDAD_APLICABLE_PARA_TODAS_LAS_FUNCIONES____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion);

    function OBSERVACIONES_NO_RELEVANTES_EN_TERMINOS_DE_RIESGO____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion)
    {
        $aux_itemcod = '2';
        $aux_item =  'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN';

        //
        $aux_tipocod = '3';
        $aux_tipo = 'OBSERVACIONES NO RELEVANTES EN TERMINOS DE RIESGO PARA TODAS LAS FUNCIONES';

        $aux_catacod = 20;
        $aux_cat = "";

        $arrayAux_desc1 = array(
            "OBSERVACIONES NO RELEVANTES EN TERMINOS DE RIESGO PARA TODAS LAS FUNCIONES",
            "Los medios de evacuación (pasadizos, escaleras, accesos y salidas) se encuentran libres de obstáculos. RNE A.130 Art 13; A.010 Art
            25",
            "El establecimiento cuenta con señalización de seguridad (direccionales de salida, salida, zona segura en caso de sismo, riesgo
            eléctrico, extintores, otros). RNE A.130, Art. 39; NTP 399.010 -1",
            "3 Cuenta con luces de emergencia operativas. RNE- A-130 Art. 40",
            "Las puertas que se utilizan como medios de evacuación abren en el sentido del flujo de los evacuantes o permanecen abiertas en
            horario de atención, sin obstruir la libre circulación y evacuación. RNE A130 Art. 5 y 6",
            "Cuenta con extintores operativos y en cantidad adecuada de acuerdo al riesgo existente en el establecimiento. NTP 350.043:2011",
            "Los extintores cuentan con tarjeta de control y mantenimiento actualizada, a una altura no mayor de 1.50m, numerados, ubicados en
            los lugares accesibles. Los extintores tienen constancia de operatividad y mantenimiento. RNE A 130 ART 163, 165; NTP 350.043-1s",
            "Los extintores ubicados a la intemperie están colocados dentro de gabinetes o cobertores. RNE A 130 ART 163, 165; NTP 350.043-1",
            "Las aberturas no usadas en los tableros eléctricos (espacios de reserva) se encuentran cerradas con tapas. CNE-U 070.3026",
            "Cuenta con certificado de medición de resistencia del pozo de tierra, firmado por un ingeniero electricista o mecánico electricista
            colegiado y habilitado, siendo la medida menor o igual a 25 ohmios. Dicho certificado debe tener un periodo de vigencia anual. CNE-U
            060.712",
            "Si cuenta con equipos y/o artefactos eléctricos, (hornos microondas, congeladoras, refrigeradoras, lavadoras, calentadores y similares)
            los enchufes tienen espiga de puesta a tierra y los tomacorrientes cuentan con conexión al sistema de puesta a tierra. CNE-U 060
            512.c",
            "Los conductores eléctricos utilizados se encuentran protegidos con tubos o canaletas de PVC. CNE-U 070.212",
            "Las cajas de paso de conductores eléctricos deben tener tapa. CNE-U 070.3002, 070.3004",
            "El(los) tablero(s) eléctrico(s) cuenta(n) con identificación. CNE-U 020.100.1, 020.100.3.1",
            "Los taleros eléctricos tienen directorio de los circuitos, indicando de manera visible y clara la instalación que controla. CNE-U
            020.100.1, 020.100.3.1",
            "Existe espacio libre no menor a un metro frente a los tableros eléctricos. CNE-U 020.308",
            "Existe iluminación general y de emergencia en la zona de ubicación de los tableros eléctricos. CNE-U 020.314"
 
        );

        $arrayAux_desc2 = null;

        $tipoAnexo = "{6A}";
        
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
            "OBSERVACIONES_NO_RELEVANTES_EN_TERMINOS_DE_RIESGO",
            0
        );
    }
    // OBSERVACIONES_NO_RELEVANTES_EN_TERMINOS_DE_RIESGO____RIESGO_COLAPSO_ESTRUCTURAS_SOPORTE_OTROS($conexion);

}



//// para el anexos 4 y algunos del 6A
// SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
// 	FROM sc_gitse3.tb_auxiliar__;


// SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
// 	FROM sc_gitse3.tb_auxiliar__ where aux_itemcod ='2' and aux_catacod = '2' order by aux_idesc::int asc ;
	
// -- 	UPDATE sc_gitse3.tb_auxiliar__
// -- 	SET aux_tipoanexo='{7A}'
// -- 	WHERE   aux_itemcod ='2'  and aux_idesc in ('17','18');
// -- 	UPDATE sc_gitse3.tb_auxiliar__
// -- 	SET aux_tipoanexo='{7A}'
// -- 	WHERE   aux_itemcod ='2' and aux_idesc in ('52');

// 	UPDATE sc_gitse3.tb_auxiliar__
// 	SET aux_tipoanexo='{7A}'
// 	WHERE   aux_itemcod ='2' and aux_idesc in ('56','57');
	
// 		UPDATE sc_gitse3.tb_auxiliar__
// 	SET aux_tipoanexo='{7A}'
// 	WHERE   aux_itemcod ='2' and aux_idesc in ('58','59','60');
	

// SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
// 	FROM sc_gitse3.tb_auxiliar__ where aux_itemcod ='2' /*and aux_catacod = '2' */order by aux_idesc::int asc ;
	
	
	
	
	
	
	
	
	