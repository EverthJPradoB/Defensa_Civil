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

            $sql = "SELECT aux_idesc FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '1' ORDER BY aux_idesc::int  DESC LIMIT 1";
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
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
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


            echo "Inserción exitosa";
        } catch (Exception $e) {
            echo "!Error al insertar: " . $e->getMessage() . "<br/>";
        }
    }
}


Conectar::Conexion();
$conexion = new Conectar();

//SALUD($conexion);
function SALUD($conexion)  ///1
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';



    //
    $aux_tipocod = '1';
    $aux_tipo = '1. SALUD';

    // $aux_tipocod = '2';
    // $aux_tipo = '2. ENCUENTRO';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8"
    );

    $arrayAux_desc1 = array(
        "SALUD",
        "Categoría I-1: Puesto o posta de salud, consultorio de profesional de la salud (no médico).",
        "Categoría I-2: Puesto o posta de salud, consultorio médico.",
        "Categoría I-3: Centro de salud, centro médico, centro médico especializado, policlínico.",
        "Categoría I-4: Centro de salud o centro médico con camas de internamiento, tiene ususarios no autosuficientes",
        "Tiene usuarios no autosuficientes o cuenta con camas de internamiento",
        "Categoría II: Hospitales y clínicas de atención general",
        "Tiene usuarios no autosuficientes o cuenta con camas de internamiento",
        "Categoría III: Hospitales y clínicas de atención especializada, instituto especializado."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//ENCUENTRO($conexion);
function ENCUENTRO($conexion) ///2
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '2';
    $aux_tipo = '2. ENCUENTRO';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "9",
        "10",
        "11",
        "12"
    );

    $arrayAux_desc1 = array(
        "2. ENCUENTRO",
        "2.1 Edificación con carga de ocupantes hasta 50 personas.",
        "2.2 Edificación con carga de ocupantes mayor a 50 personas.",
        "2.3 La actividad de encuentro se realiza en el sótano.",
        "2.4 Edificación donde se desarrollan los siguientes usos: discotecas, casinos, tragamonedas, teatros, cines, salas de concierto, anfiteatros, auditorios, centros de convenciones, clubes, estadios, plazas de toros, coliseos, hipódromos, velódromos, autódromos, polideportivos, parques de diversión, zoológicos y templos."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//HOSPEDAJE($conexion);
function HOSPEDAJE($conexion) /// 3
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '3';
    $aux_tipo = '3. HOSPEDAJE';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "13",
        "14",
        "15",
        "16"
    );

    $arrayAux_desc1 = array(
        "3. HOSPEDAJE",
        "3.1 Establecimientos de Hospedaje de o hasta 3 estrellas y hasta 4 pisos, ecolodge, albergue o establecimiento ubicado en cualquiera de los cuatro (4) pisos, sin sótano.",
        "3.2 Establecimientos de Hospedaje de o hasta 3 estrellas y hasta 4 pisos, ecolodge, albergue o establecimiento ubicado en cualquiera de los cuatro (4) pisos, con sótano.",
        "3.3 Hospedaje con más de cuatro (4) pisos, o establecimiento ubicado en piso superior al cuarto.",
        "3.4 Para todo tipo de hospedaje que cuenta con sótano de estacionamiento con área mayor a 500m2 o 250m2 de depósitos o servicios generales."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

/*              ACA  */
//EDUCACIÓN($conexion);
function EDUCACIÓN($conexion) /// 4
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '4';
    $aux_tipo = '4. EDUCACIÓN';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "17",
        "18",
        "19",
        "20"
    );

    $arrayAux_desc1 = array(
        "EDUCACIÓN",
        "4.1 Centros de educación inicial, primaria y secundaria, para personas con discapacidad: hasta tres (3)
        pisos.",
        "4.2 Toda edificación educativa mayor a (3) pisos.",
        "4.3 Centro de Educación Superior: Universidades, Institutos, Centros y Escuelas Superiores",
        "4.4 Toda edificación remodelada o acondicionada para uso educativo."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//INDUSTRIAL($conexion);
function INDUSTRIAL($conexion) /// 5
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '5';
    $aux_tipo = '5. INDUSTRIAL';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "21",
        "22",
        "23"

    );

    $arrayAux_desc1 = array(
        "INDUSTRIAL",
        "5.1. Taller Artesanal, donde se transforman manualmente o con ayuda de herramientas manuales, materiales o
        sustancias en nuevos productos . El establecimiento puede incluir un área destinada a comercialización",
        "5.2. Industria en General.",
        "5.3. Fábricas de productos explosivos o materiales relacionados. Talleres o Fábricas de productos pirotécnicos."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//OFICINAS_ADMINISTRATIVAS($conexion);
function OFICINAS_ADMINISTRATIVAS($conexion)  /// 6
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '6';
    $aux_tipo = '6. OFICINAS ADMINISTRATIVAS';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "24",
        "25",
        "26",
        "27",
        "28"

    );

    $arrayAux_desc1 = array(
        "OFICINAS ADMINISTRATIVAS",
        "6.1. Edificación hasta cuatro (4) pisos y/o planta techada por piso igual o menor a 560m2",
        "6.2. Edificación con conformidad de obra de una antigüedad no mayor a (5) años donde se desarrolla la
        actividad o giro correspondiente al diseño o habiéndose realizado remodelaciones, ampliaciones o cambios de
        giro, se cuenta con conformidades de obras correspondientes.",
        "6.3. Establecimiento ubicado en cualquier piso de edificaciones cuyas áreas e instalaciones de uso común
        cuentan con Certificado de ITSE vigente.",
        "6.4. Establecimiento ubicado en cualquier piso de edificaciones cuyas áreas e instalaciones de uso común no
        cuentan con Certificado de ITSE vigente.",
        "6.5. Edificación con cualquier número de pisos con planta techada por piso mayor a 560m2"

    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//COMERCIO($conexion);
function COMERCIO($conexion)  /// 7
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '7';
    $aux_tipo = '7. COMERCIO';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "29",
        "30",
        "31",
        "32",
        "33",
        "34"

    );

    $arrayAux_desc1 = array(
        "COMERCIO",
        "7.1. Edificación hasta tres (3) pisos y/o área techada total hasta 750m2.",
        "7.2. Módulos, stands o puestos, cuyo mercado de abastos, galería comercial o centro comercial cuenten con
             una licencia de funcionamiento en forma corporativa.",
        "7.3. Edificación mayor a tres (3) pisos y/o área techada total mayor a 750m2.",
        "7.4. Áreas e instalaciones de uso común de las edificaciones de uso mixto, mercados de abastos, galerías
        comerciales y centros comerciales",
        "7.5. Mercado minorista, mercado mayorista, supermercados, tiendas por departamentos, complejo comercial,
        centros comerciales y galerías comerciales.",
        "7.6. Comercialización de productos explosivos, pirotécnicos y relacionados."

    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}


//ALMACÉN($conexion);

function ALMACÉN($conexion)  /// 8
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '8';
    $aux_tipo = '8. ALMACÉN';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "35",
        "36",
        "37"

    );

    $arrayAux_desc1 = array(
        "ALMACÉN",
        "8.1. Almacén o estacionamiento no techado: puede incluir áreas administrativas y de servicios techadas.",
        "8.2. Almacén o estacionamiento techado.",
        "8.3. Almacén de productos explosivos, pirotécnicos y relacionados."
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//FACTORES_ADICIONALES($conexion);
function FACTORES_ADICIONALES($conexion)
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '9';
    $aux_tipo = 'FACTORES ADICIONALES QUE CONTRIBUYEN AL INCREMENTO DEL NIVEL DE RIESGO PARA TODAS LAS FUNCIONES';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "35",
        "36",
        "37"

    );

    $arrayAux_desc1 = array(
        "FACTORES ADICIONALES QUE CONTRIBUYEN AL INCREMENTO DEL NIVEL DE RIESGO PARA TODAS LAS FUNCIONES",
        "El establecimiento cuenta con tanque de Gas Licuado de Petróleo (GLP) y/o líquido combustible y sus
        derivados en cantidades superiores a 0.45m3 (118.18gl) y 1m3 (264.17gl), respectivamente.",
        "El establecimiento usa caldero"
    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{2, 3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}

//FACTORES_ADICIONALES__3($conexion);
function FACTORES_ADICIONALES__3($conexion)   ///// anexo 3
{
    $aux_itemcod = '1';
    $aux_item = 'FUNCIÓN';

    //
    $aux_tipocod = '9';
    $aux_tipo = 'FACTORES ADICIONALES QUE CONTRIBUYEN AL INCREMENTO DEL NIVEL DE RIESGO PARA TODAS LAS FUNCIONES';


    $aux_catacod = null;
    $aux_cat = null;

    $arrayAux_idesc = array(
        "35",
        "36",
        "37"

    );

    $arrayAux_desc1 = array(
        "Resultado de la Clasificación del Nivel de Riesgo:",
        "Con la información proporcionada por el solicitante y según la Matriz de Riesgos, se determina que el
        Establecimiento Objeto de Inspección tiene un nivel de riesgo: "

    );

    $arrayAux_desc2 = null;

    $tipoAnexo = "{3}";

    $conexion->insertarDatos(
        $aux_itemcod,
        $aux_item,
        $aux_tipocod,
        $aux_tipo,
        $aux_catacod,
        $aux_cat,
        $arrayAux_idesc,
        $arrayAux_desc1,
        $arrayAux_desc2,
        $tipoAnexo
    );
}




































// $arrayItem = array(
//     "Los medios de evacuación (pasadizos, escaleras, accesos y salidas) del
//     establecimiento presentan un ancho mínimo de 1.20 m y/o que permitan la
//     evacuación de las personas de manera segura. RNE A.010.",
//     "Los medios de evacuación (pasadizos, escaleras, accesos y salidas) se
//     encuentran libres de obstáculos. RNE A.130 Art 13; A.010 Art 25",
//     "El establecimiento cuenta con señalización de seguridad (direccionales de salida,
//     salida, zona segura en caso de sismo, riesgo eléctrico, extintores, otros). RNE
//     A.130, Art. 39; NTP 399.010 -1",
//     "Cuenta con luces de emergencia operativas. RNE- A-130 Art. 40",
//     "Las puertas que se utilizan como medios de evacuación abren en el sentido del
//     flujo de los evacuantes o permanecen abiertas en horario de atención, sin obstruir
//     la libre circulación y evacuación. RNE A130 Art. 5 y 6",
//     "En caso de contar con un ambiente con aforo mayor a 100 personas, en cualquier
//     caso, la puerta de salida cuenta con barra antipánico. RNE A130 Art. 8",
//     "No cuenta con material combustible o inflamable debajo de las escaleras que
//     sirvan como medios de evacuación (cartones, muebles, plásticos otros similares).
//     RNE A.010 Art. 26, b16",
//     "Las escaleras cumplen con las caraceristicas en numero y tipo (incluye
//     excepciones de la norma señaladas en el RNE A010 art 28) pasos, dimensiones,
//     contrapasos, descansos y barandas correspondientes al tipo de la edificación y su
//     altura. RNE A.010 hasta la A.110; A.140",
//     "Las escaleras que comunican todos los niveles de la edificacion, son continuas
//     desde el primer piso hasta el ultimo en sentido vertical u horizontal estan
//     intercomunicadas entre si, por pasadizos de circulacion libre. Barreras de
//     contencion y direccionamiento en piso de evacuacion en escaleras con continuidad
//     a niveles inferiores de la salida de evacuacion. Las escaleras a los sotanos podran
//     ser independientes; RNE A.010: 26 b.4"
// );
