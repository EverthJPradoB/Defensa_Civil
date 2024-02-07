<?php
/* Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/* Llamando a la clase */
require_once("../models/Solicitud.php");

$solicitud = new Solicitud();

/* Opcion de solicitud de controller */
switch ($_GET["op"]) {

    case "guardar":

        if (isset($_POST['soit_id'])) {

            if (empty($_POST['fechaDiliItse'])) {
                $_POST['fechaDiliItse']  = null;
            }

            //FECHA PROGRAMADA PARA LA DILIGENCIA DE ECSE: 
            if (empty($_POST['fechaDiliEcse'])) {
                $_POST['fechaDiliEcse']  = null;
            }

            ///////// UPDATE INFORMACION GENERAL

            $solicitud->update_informacion_general_anexo_01(
                $_POST["grupoItse"],
                $_POST["grupoFuncion"],
                $_POST["grupoRiesgo"],
                // $_POST["organoEjecu"],
                $_POST["numeroExpe"],
                $_POST['fechaDiliItse'],  // permite nullos 
                $_POST['fechaDiliEcse'],
                $_POST['soli_id'],
                $_POST['esta_id'],
                $_SESSION["usuario_id"],
                $_POST['soit_id']

            );

            ///////// UPDATE OBJETO DE SOLICITANTE

            $solicitud->update_datos_solicitante_anexo_01(
                $_POST["tipoSolicitante"],
                $_POST["apepSoli"],
                $_POST["apemSoli"],
                $_POST["nombreSoli"],
                $_POST["tipoDocSolicitante"],
                $_POST['dniSoli'],
                $_POST['domicilioSoli'],
                $_POST["emailSoli"],
                $_POST["telefonoSoli"],
                $_POST["soli_id"]
            );

            ///////// UPDATE OBJETO DE INSPECCION

            if (empty($_POST['distritoComer'])) {
                $_POST['distritoComer'] = null;
            }

            if (empty($_POST['horaAten'])) {
                $_POST['horaAten'] = null;
            }

            if (empty($_POST['giroComer'])) {
                $giroIdsString = '{}';
            } else {
                $valoresSeleccionados = $_POST["giroComer"];
                $giroIdsString = "{" . implode(",", $valoresSeleccionados) . "}";
            }

            $solicitud->update_objeto_inspeccion_anexo_01(
                $_POST["razonSocial"],
                $_POST["ruc"],
                $_POST["nombreComer"],
                $_POST["telefonoComer"],
                $_POST["direccionComer"],
                $_POST['referenciaComer'],
                $_POST["localidadComer"],
                $_POST["horaAten"],
                $giroIdsString,
                $_POST["distritoComer"],

                $_POST["areaTotal"],
                $_POST["numPisos"],
                $_POST["pisoUbi"],

                $_POST["esta_id"]
            );

            ////////////////////////////////////////////////

        } else {
            // ---------------- DATOS SOLICITANTE -----------------

            $resultadoInsercion_solicitante   = $solicitud->insert_solicitante(
                $_POST["tipoSolicitante"],
                $_POST["apepSoli"],
                $_POST["apemSoli"],
                $_POST["nombreSoli"],
                $_POST["tipoDocSolicitante"],
                $_POST['dniSoli'],
                $_POST['domicilioSoli'],
                $_POST["emailSoli"],
                $_POST["telefonoSoli"]

            );

            $soliIdInsertado = $resultadoInsercion_solicitante[0]['soli_id'];

            // //---------------- DATOS OBJETO INSPECCION ----------- 

            if (empty($_POST['distritoComer'])) {
                $_POST['distritoComer'] = null;
            }

            if (empty($_POST['horaAten'])) {
                $_POST['horaAten'] = null;
            }

            if (empty($_POST['giroComer'])) {
                $giroIdsString = '{}';
            } else {
                $valoresSeleccionados = $_POST["giroComer"];
                $giroIdsString = "{" . implode(",", $valoresSeleccionados) . "}";
            }

            $resultadoInsercion_estable   = $solicitud->insert_objeto_inspeccion(
                $_POST["razonSocial"],
                $_POST["ruc"],
                $_POST["nombreComer"],
                $_POST["telefonoComer"],
                $_POST["direccionComer"],
                $_POST['referenciaComer'],
                $_POST["localidadComer"],
                $_POST["horaAten"],
                $giroIdsString,
                $_POST["distritoComer"],

                // $esta_areatotal,        $esta_numpisos,      $esta_pisoubi
                $_POST["areaTotal"],
                $_POST["numPisos"],
                $_POST["pisoUbi"]

            );

            $estaIdInsertado = $resultadoInsercion_estable[0]['esta_id'];

            // ---------------INFORMACION GENERAL ----------------
            // FECHA PROGRAMADA PARA LA DILIGENCIA DE ITSE: 

            // $_POST['fechaDiliItse']  = $_POST['fechaDiliItse']  ?? null;
            if (empty($_POST['fechaDiliItse'])) {
                $_POST['fechaDiliItse']  = null;
            }

            //  $_POST['fechaDiliEcse'] = $_POST['fechaDiliEcse'] ?? null;

            //FECHA PROGRAMADA PARA LA DILIGENCIA DE ECSE: 
            if (empty($_POST['fechaDiliEcse'])) {
                $_POST['fechaDiliEcse']  = null;
            }
            /// ME FALTA AGREGAR " PALABRAS MAS::::::

            $resultadoInsercion_solicitud = $solicitud->insert_solicitud(
                $_POST["grupoItse"],
                $_POST["grupoFuncion"],
                $_POST["grupoRiesgo"],
                $_POST["organoEjecu"],
                $_POST["numeroExpe"],
                $_POST['fechaDiliItse'],  // permite nullos 
                $_POST['fechaDiliEcse'],
                $soliIdInsertado,
                $estaIdInsertado,
                $_SESSION["usuario_id"]
            );

            $solicitudIdInsertado = $resultadoInsercion_solicitud[0]['soit_id'];
            $_SESSION['soit_id']  = $solicitudIdInsertado;

            ////////////////////---IV.- DOCUMENTOS PRESENTADOS --////////////////////////

            if ($_POST['grupoItse'] == 1) {


                $solicitud->insert_documento_ITSE_POSTERIOR(
                    $_POST["grupoItse"],
                    $solicitudIdInsertado
                );
            }

            if ($_POST['grupoItse'] == 2) {
                $solicitud->insert_documento_ITSE_PREVIA(

                    $_POST["grupoItse"],
                    $_POST["docuDesc1"],
                    $solicitudIdInsertado

                );
            }
            if ($_POST['grupoItse'] == 3 || $_POST['grupoItse'] == 4) {
                $solicitud->insert_documento_ITSE_RENOVACIÓN(

                    $_POST["grupoItse"],
                    $_POST["docuDesc2"],
                    $solicitudIdInsertado

                );
            }
            if ($_POST['grupoItse'] == 5 || $_POST['grupoItse'] == 6) {

                if (empty($_POST['DocuEcseHoraIni'])) {
                    $_POST['DocuEcseHoraIni']  = null;
                }
                if (empty($_POST['DocuEcseFechaIni'])) {
                    $_POST['DocuEcseFechaIni']  = null;
                }

                if (empty($_POST['DocuEcseHoraFin'])) {
                    $_POST['DocuEcseHoraFin']  = null;
                }
                if (empty($_POST['DocuEcseFechaFin'])) {
                    $_POST['DocuEcseFechaFin']  = null;
                }

                $solicitud->insert_documento_ECSE_3000(

                    $_POST["grupoItse"],
                    $_POST["docuDesc3"],

                    $_POST["DocuEcseHoraIni"],
                    $_POST["DocuEcseFechaIni"],

                    $_POST["DocuEcseHoraFin"],
                    $_POST["DocuEcseFechaFin"],

                    $_POST["docuDesc4"],

                    /// se guarda con la session,
                    //dificultades para guardar con la variable $solicitudIdInsertado;
                    $_SESSION['soit_id']

                );
            }
            // se crea la session para los demas anexos
            $_SESSION['opcionAnexo_1_idesx']  = $solicitudIdInsertado;

            $_SESSION['grupoFuncion']  = $_POST['grupoFuncion'];

            $solicitud->insert_estado_solicitud(
                $_SESSION['soit_id'],
                null,
                null,
                null,
                '0'
            );
        }

        break;

    case "combo_distrito":

        $datos = $solicitud->get_distrito();

        // echo is_array($datos);
        if (is_array($datos) == true and count($datos) > 0) {

            $html = "<option  label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['ubi_id'] . "'>" . $row['ds_nombre'] . "</option>";
            }
            echo $html;
        }

        break;

    case "combo_distrito_checked":

        $soit_id = $_POST["soit_id"];
        $tipo_anexo = '2'; // opcional, el anexo 1, no tiene detalle, tiene una tabla personal
        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        $datos = $solicitud->get_distrito();

        // echo is_array($datos);
        if (is_array($datos) && count($datos) > 0) {
            $html = "<option value='' label='Seleccione'></option>"; // Corregir aquí

            foreach ($datos as $row) {
                $selected = ($datos_anexo1['ubig_id'] == $row['ubi_id']) ? 'selected' : ''; // Corregir aquí
                $html .= "<option value='" . $row['ubi_id'] . "' $selected>" . $row['ds_nombre'] . "</option>"; // Corregir aquí
            }
            echo $html;
        }

        break;

    case "combo_giro":

        $datos = $solicitud->get_giro();

        // ' . ($valor[0] == 1 ? ' checked' : '') . '
        // echo is_array($datos);
        if (is_array($datos) == true and count($datos) > 0) {

            $html = "<option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['gico_id'] . "'>" . $row['gico_nombre'] . "</option>";
            }
            echo $html;
        }

        break;

    case "combo_giro_checked":

        $soit_id = $_POST["soit_id"];

        $tipo_anexo = '2'; // opcional, el anexo 1, no tiene detalle, tiene una tabla personal

        $datos = $solicitud->get_giro();

        if (is_array($datos) == true and count($datos) > 0) {

            $html = "<option label='Seleccione'></option>";

            $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

            foreach ($datos as $row) {

                if (!empty($datos_anexo1) && isset($datos_anexo1['esta_giro'])) {
                    $aux_idesc_array = $datos_anexo1['esta_giro'];
                    $valores = explode(',', trim($aux_idesc_array, '{}'));

                    $selected = ((in_array($row['gico_id'], $valores) ? 'checked' : '')) ? 'selected' : ''; // Corregir aquí

                    $html .= "<option value='" . $row['gico_id'] . "'    $selected     >" . $row['gico_nombre'] . "</option>";
                }
            }

            echo $html;
        }

        break;

    case "mostrar_anexo_02_parte_1":

        $datos = $solicitud->get_anexo_02();
        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple']
        ];

        $htmlContenedor = ''; // Declarar la variable fuera del bucle
        $cont = 0;

        //  for ($i = 1; $i <= 8; $i++) {
        $i = $_SESSION['grupoFuncion'];
        // 
        $array_salud = filtrarAnexo_2($datos, $i);

        $htmlArray = array();
        $html = '';
        foreach ($array_salud as $row) {
            //$html = '';

            if (
                $row['aux_idesc'] == 1 || $row['aux_idesc'] == 10  ||  $row['aux_idesc'] == 15
                ||  $row['aux_idesc'] == 20 || $row['aux_idesc'] ==  25 ||  $row['aux_idesc'] == 29
                ||  $row['aux_idesc'] == 35 || $row['aux_idesc'] ==  42
            ) {
                $html .= '
                    <div class="form-row pb-4">
                        <h5 class="col-md-1">' .  $i . '</h5 >
                        <div class="col-md-9">
                            <h5 class="text-justify">' . $row['aux_desc1'] . ' </h5>
                        </div>
                        <div class="col-md-2">
                            <div class="">
                              
                            </div>
                        </div>
                    </div>
                ';
            } else {
                $cont++;
                $html .= '
                    <div class="form-row">
                        <div class="col-md-1">' . $i . '.'  . $cont . '</div>
                        <div class="col-md-9">
                            <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                        </div>
                        <div class="col-md-2">
                            <div class="ckbox ">
                                <label class=" ml-3" for="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']">                      
                                <input name="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']"  class="opcionAnexo_2_idesx_parte1 form-check-input" type="checkbox" value="1" >
                                <span> Si Cumple</span>                  
                                </label>
                            </div>
                        </div>
                    
                    </div>
                ';
            }

            // Almacenar la respuesta HTML en el array
            //  $htmlArray[] = $html;
        }
        $cont = 0;
        // Envolver todos los bloques en un contenedor y concatenar en cada iteración
        // $htmlContenedor .= '<div class="p-3" id="contenidoAnexo_2_' . $i . '" >' . implode('', $htmlArray) . '</div>';
        $htmlContenedor .= '<div class="p-3" id="parte_2_Anexo_02">' . $html . '</div>';

        // }


        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;



    case "mostrar_anexo_02_parte_2":
        $datos = $solicitud->get_anexo_02_aux_tipocod_9_aux_idesc_46_47_48();
        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple']
        ];

        $htmlContenedor = ''; // Declarar la variable fuera del bucle
        $cont = 0;

        $html = '';

        foreach ($datos as $row) {


            if (
                $row['aux_idesc'] == 46
            ) {
                // ingrese siempre cuando el $i = 0 
                $html .= '
                <hr>
                    <div class=" pb-3 text-center   font-weight-bold d-flex align-items-center justify-content-center">
                    <p class="">
                        ' . $row['aux_desc1'] . '
    
                    </p>
                </div>
                        ';
            } else {
                $cont++;
                $html .= '
                            <div class="form-row">
                                <div class="col-md-1">'  . $cont . '</div>
                                <div class="col-md-9">
                                    <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                                </div>
                                <div class="col-md-2">
                                    <div class="ckbox">
                                        <label class="form-check-label " for="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']">
                                        <input name="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" class="form-check-input m-0 ml-5" type="checkbox" value="1">

                                        <span>Si Cumple</span>
                                      
                                       </label>
                                     </div>
                                </div>
                            
                            </div>
                        ';
            }

            // Almacenar la respuesta HTML en el array

        }
        $cont = 0;

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="parte_2_Anexo_02">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_anexo_03":

        $datos = $solicitud->get_anexo_03_aux_tipocod_9_aux_idesc_49();
        // $datos_comp = $solicitud->get_componentes();

        // $array_comp = filtrarComponentes($datos_comp, 'RIESGO');

        $htmlContenedor = ''; // Declarar la variable fuera del bucle

        $html = '';

        $html .=    '<div class="p-3" id="">
                <div class="form-row p-3">
                    <div class="col-md-9">
                        <p class="text-justify"><b>' . $datos[0]['aux_desc1'] . '</b> <br>
                            ' . $datos[1]['aux_desc1'] . ':</p>
                    </div>
                    <div class="col-md-3">

                        <div class="form-col" style="margin-left: 110px;">
                            <div>
                               <label class="rdiobox" for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_1"  >
                               <input type="radio" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_1" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="1" >

                               <span>Bajo</span>

                               </label>
                            </div>
                        </div>
                        

                        <div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox"  for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_2"  >
                                <input type="radio" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_2" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="2" >
                                <span>Medio</span>           
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox"  for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_3"  >
                                <input type="radio" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_3" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="3" >
                                <span>Alto</span>              
                                </label>
                            </div>
                        </div>
       
                        
                        <div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox"  for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_4" >
                                <input type="radio" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_4" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="4" >
                                <span>Muy Alto</span>              

                                </label>
                            </div>
                        </div>
       
       

                    </div>
                </div>
            </div>';

        $cont = 0;

        // Envolver el bloque en un contenedor HTML
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_anexo_04":

        $datos = $solicitud->get_anexo_04();

        // $componentes = $solicitud->get_anexo_04_componentes();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            // ['id' => 2, 'nombre' => 'No Corresponde']
        ];
        //    <div class="col-md-0">'  . convertir_a_letras($cont) . '</div>

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';
        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 19 ||
                $row['aux_idesc'] == 34  || $row['aux_idesc'] == 38  || $row['aux_idesc'] == 42  ||
                $row['aux_idesc'] == 48 || $row['aux_idesc'] == 53  || $row['aux_idesc'] == 56  ||
                $row['aux_idesc'] == 58 || $row['aux_idesc'] == 61  || $row['aux_idesc'] == 63  || $row['aux_idesc'] == 67  ||
                $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72  || $row['aux_idesc'] == 76  ||
                $row['aux_idesc'] == 79 || $row['aux_idesc'] == 98  || $row['aux_idesc'] == 101
            ) {

                if ($row['aux_idesc'] == 1) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                if ($row['aux_idesc'] == 61) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                if ($row['aux_idesc'] == 79) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OTROS RIESGOS VINCULADOS A LA ACTIVIDAD

                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                $cont = 0;
                $html .= '
                            <div class="form-row ">
                                <div class="col-md-9">
                                    <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                </div>
                                <div class="col-md-3 form-row">
                                </div>
                            </div>
                            <hr>
                        ';
            } else {

                if ($row['aux_idesc'] == 44) {
                    $html .= '
                    <div class="form-row">
                    <div class="col-md-0 mr-2">
                    <p class="text-justify"> </p>
                    </div>
                        <div class="col-md-9">
                            <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                        </div>
                        <div class="col-md-2 form-row">
                           
                       
                        </div>
                    </div>
                    <hr>
                ';
                } else {
                    $cont++;
                    $html .= '
    
                        <div class="form-row">
                            <div class="col-md-0 mr-2">
                                <p class="text-justify"> <b>' . $cont . '</b> </p>
                            </div>
                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>
                            <div class="col-md-6 form-row " > ';


                    if ($row['aux_idesc'] == 20) {
                        $html .= '     <div class="pb-3" style="width: 100%;display: flex;justify-content: center;">

                                <table border="1"   style="width: 80%" >
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Polvo Químico Seco - PQS</td>      
                                            <td><input class="form-control form-control-sm" type="text" name="pqs" id="pqs"></td>
                           
                                        <tr>
                                            <td>Gas Carbónico – CO2</td>
                                            <td><input class="form-control form-control-sm" type="text" name="co2" id="co2"></td>
                                        </tr>
                                        <tr>
                                            <td>Acetato de Potasio</td>
                                            <td><input class="form-control form-control-sm" type="text" name="ack" id="ack"></td>
                                        </tr>
                                        <tr>
                                            <td>Agua Presurizada:</td>
                                            <td><input class="form-control form-control-sm" type="text" name="h2o" id="h2o"></td>
                                        </tr>
                                        <tr>
                                            <td>Otros: </td>
                                            <td><input class="form-control form-control-sm" type="text" name="otro_quimicos" id="otro_quimicos"></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

                            </div>    ';
                    }



                    foreach ($opciones as $opcion) {
                        $html .= '
               
                                <div class=" ml-5 ">
                                    <label>
                                        <input type="checkbox" name="opcionAnexo_4_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)">
                                        ' . $opcion['nombre'] . '
                                    </label>
                                </div>
                        
                                ';
                    }
                    // 

                    $html .=   ' </div>
                    </div>
                    <hr>

                ';
                }
            }
        }

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);
        break;

    case "mostrar_anexo_06_07_09":

        $soit_id = 171;
        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, '2', $_SESSION["usuario_id"]);

        $tipo_anexo = $_POST["tipo_anexo"];
        $html = '';
        $htmlContenedor = '';

        //  I.- INFORMACION GENERA
        $html .=  '
        <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >I.- INFORMACION GENERAL </h6>
        <hr>
        <div class=" text-center font-weight-bold">
            <p>I.1.- TIPO DE ITSE</p>
        </div>

        <div class= "d-flex flex-wrap align-items-center justify-content-around">';

        $datos_comp = $solicitud->get_componentes('1', '6');

        // TIPO DE ITSE
        foreach ($datos_comp as $row_comp) {

            $html .= '
                        <div class="form-check  mr-5" >
                            <label class="rdiobox" for="grupoItse_insp' . $row_comp['comp_idesc'] . '">
            
                            <input class="" type="radio" name="grupoItse_insp" id="grupoItse_insp' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '" ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soit_tipoitse'])) ? 'checked' : '') . ' required>
                            <span>   ' . $row_comp['comp_desc'] . '   </span>            
                            
                            </label>
                        </div>
                        ';
        }
        $html .=  '</div>
        <hr>
        '; //END RADIO TIPO_ITSE

        // START RADIO FUNCION
        $html .= '  
        <div class="text-center font-weight-bold">
        <p>I.3.- FUNCION</p>
        </div>

        <div class=" p-2 d-flex flex-wrap align-items-center justify-content-between">';
        $datos_comp = $solicitud->get_componentes('2', 'G');

        foreach ($datos_comp as $row_comp) {

            $html .= '<div class="">
                <label class="rdiobox" for="radio_fun' . $row_comp['comp_idesc'] . '">   
    
                <input class="" type="radio" name="grupoFuncion" id="radio_fun' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '" ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soit_funcion'])) ? 'checked' : '') . ' >
                <span class="mr-5">    ' . $row_comp['comp_desc'] . '     </span>
                
                </label>
              </div>';
        }
        $html .= '</div>
        <hr>
        ';

        $html .= '
            <!-- FECHA DE EXPEDIENTE-->
            <div class="">
                <div class="form-row">
    
                    <div class="form-group col-md-3">
                        <label for="organoEjecu" class="form-label">ORGANO EJECUTANTE:</label>
                        <input type="text" class="form-control" style="font-size: 16px;" id="organoEjecu" name="organoEjecu" value="' . $datos_anexo1['soit_organo'] . '" placeholder="Ingrese organo" readonly >
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="numeroExpediente" class="form-label">Nº EXPEDIENTE:</label>          
                       <input  id="numeroExpediente" class="form-control" style="font-size: 16px;" name="numeroExpe" value="' . $datos_anexo1['soit_numexpe'] . '" placeholder="Ingrese expediente" readonly> 
                    </div>
    
                    <div class="form-group col-md-3">
                        <label for="fecha_insp" class="form-label">FECHA DE INSPECCION:</label>
                        <input type="date" class="form-control" style="font-size: 16px;" id="fecha_insp" name="fecha_insp" value="" required>
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="hora_inicio" class="form-label">HORA INICIO:</label>
                        <input type="time" class="form-control" style="font-size: 16px;" id="hora_inicio" name="hora_inicio"  value="" required>
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="hora_fin" class="form-label">HORA FIN:</label>
                        <input type="time" class="form-control" style="font-size: 16px;" id="hora_fin" name="hora_fin"  value="" required>
                    </div>
    
                </div>
    
        </div> 
        <hr>
        ';

        //  II.- DATOS DEL SOLICITANTE

        $html .= ' 
            <div id="datos_solicitante" class="datos_solicitante">
            <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >II.- DATOS DEL SOLICITANTE</h6>
            <hr>
            ';

        $html .=
            '<div class="">';

        $datos_comp = $solicitud->get_componentes('4', '1');

        foreach ($datos_comp as $row_comp) {
            $html .= '  
                    <div class="form-check mb-2">
                        <label class="rdiobox" for="tipoSolicitante' . $row_comp['comp_idesc'] . '">
                        <input class=" ml-1" type="radio" name="tipoSolicitante" id="tipoSolicitante' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '"  ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soli_tipo'])) ? 'checked' : '') . '  require >
    
                        <span class="mr-5">    ' . $row_comp['comp_desc'] . '     </span>
                        </label>
                    </div>';
        }

        $html .=
            '</div>
            <hr>
            ';

        $html .=
            '<div class=" ">
          
                <div class="form-row">';
        $html .=
            '           <div class="form-group col-md-3">
                            <label for="nomCompleto" class="form-label">NOMBRES Y APELLIDOS :</label> 
                            <input type="text" name="nomCompleto" style="font-size: 16px;" class="form-control" id="nomCompleto" placeholder="Apellido Paterno" value="' . $datos_anexo1['soli_nombre'] . ' ' . $datos_anexo1['soli_apep'] . ' ' . $datos_anexo1['soli_apem'] . '" readonly>                  
                        </div>
                      
                        <div class="form-group col-md-3">
                            <label for="dniSoli" class="form-label ">DNI - C.E:</label>
                            <input type="text" name="dniSoli" style="font-size: 16px;" class="form-control" id="dniSoli" placeholder="Ingrese DNI" value="' . $datos_anexo1['soli_numdocident'] . '" readonly>    
                        </div>
    
                        <div class="form-group col-md-3">
                            <label for="domicilioSoli" class="form-label">DOMICILIO:</label>
                            <input type="text" name="domicilioSoli" style="font-size: 16px;" class="form-control" id="domicilioSoli" placeholder="Ingrese Domicilio" value="' . $datos_anexo1['soli_domocilio'] . '" readonly>    
                        </div>
    
                        <div class="form-group col-md-3">
    
                            <label for="telefonoSoli" class="form-label ">TELEFONO</label>                            
                            <input type="text" name="telefonoSoli" style="font-size: 16px;" class="form-control" id="telefonoSoli" placeholder="Ingrese Domicilio" value="' . $datos_anexo1['soli_telefono'] . '" readonly>    

                        </div>
    
                        <div class="form-group col-md-3">
                    
                            <label for="emailSoli" class="form-label ">CORREO ELECTRONICO:</label>
                            <input type="text" name="emailSoli" style="font-size: 16px;" class="form-control" id="emailSoli" placeholder="Ingrese Domicilio" value="' . $datos_anexo1['soli_correo'] . '" readonly>    

                        </div>  
                </div>
            </div>
        <hr>';


        $html .= '
            <div id="datos_objetos_inspeccion" class="datos_objetos_inspeccion">
            <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >III.- DATOS DEL OBJETO DE INSPECCIÓN</h6>
            <hr>
    
                <div class="">
    
                    <div class="form-row" id="infoAnexo1">';

        $html .= '
                        <div class="form-group  col-md-4">
                            <label for="razonSocial" class="form-label">RAZÓN SOCIAL:</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" value="' . $datos_anexo1['esta_razsocial'] . '" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="ruc" class="form-label">RUC:</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control " name="ruc" id="ruc" placeholder="RUC" value="' . $datos_anexo1['esta_ruc'] . '" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="nombreComer" class="form-label">NOMBRE COMERCIAL:</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control " name="nombreComer" id="nombreComer" placeholder="Nombre Comercial" value="' . $datos_anexo1['esta_nomcomer'] . '" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="telefonoComer" class="form-label ">TELEFONO</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control " name="telefonoComer" id="telefonoComer" placeholder="Telefono" value="' . $datos_anexo1['esta_tel'] . '" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="direccionComer" class="form-label">DIRECCIÓN/UBICACIÓN:</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control" name="direccionComer" id="direccionComer" placeholder="Dirección/Ubicación" value="' . $datos_anexo1['esta_direccion'] . '" readonly>
    
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="referenciaComer" class="form-label">REFERENCIA DE DIRECCION:</label>
    
                            <input type="text" style="font-size: 16px;" class="form-control" name="referenciaComer" id="referenciaComer" placeholder="Referencia de Direccion" value="' . $datos_anexo1['esta_referencia'] . '" readonly>
    
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="localidadComer" class="form-label">LOCALIDAD: </label>
                            <input type="text" style="font-size: 16px;" class="form-control" name="localidadComer" id="localidadComer" placeholder="Referencia de Localidad" value="' . $datos_anexo1['esta_localidad'] . '" readonly>
                        </div>
    
                        <div class="form-group col-md-4" id="div_form_distrito" >
                       
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="provinciaComer" class="form-label">PROVINCIA: </label>
                            <input type="text" style="font-size: 16px;" class="form-control" name="provinciaComer" id="provinciaComer" value="CHICLAYO" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="departamentoComer" class="form-label">DEPARTAMENTO: </label>
                            <input type="text" style="font-size: 16px;" class="form-control" name="departamentoComer" id="departamentoComer" value="LAMBAYEQUE" readonly>
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="horaAten" class="form-label">HORARIO DE ATENCIÓN:</label>
                            <input type="text" style="font-size: 16px;"  name="horaAten" style="width: 100%;" class="form-control " id="horaAten" placeholder="Horario de Atención" value="' . $datos_anexo1['esta_horarioaten'] . '" readonly>
                        </div> 
      
                        <div class="form-group col-md-4">
                            <label for="areaOcupadaTotal" class="form-label">AREA OCUPADA TOTAL (M2):</label>
                            <input type="text" style="font-size: 16px;"  value="' . $datos_anexo1["esta_areatotal"] . '" name="areaOcupadaTotal" class="form-control" id="areaOcupadaTotal" readonly>
                        </div>';

        if ($tipo_anexo == '6A') {
            $html .= ' 
                        <div class="form-group col-md-4">
                            <label for="numPisos" class="form-label">N° DE PISOS DEL EDIFICIO:</label>
                            <input type="text" name="numPisos"  style="font-size: 16px;" value="' . $datos_anexo1["esta_numpisos"] . '" style="width: 100%;" class="form-control " id="numPisos" readonly>
                        </div>
       
                        <div class="form-group col-md-4">
                            <label for="pisoUbi" class="form-label">PISO / DONDE FUNCIONA EL LOCAL:</label>
                            <input type="text" name="pisoUbi"  style="font-size: 16px;" style="width: 100%;"  value="' . $datos_anexo1["esta_pisoubi"] . '" class="form-control " id="pisoUbi" readonly >
                        </div>';
        }
        if ($tipo_anexo == '7A') {
            $html .= ' 

            <div class="form-group col-md-3">
                <label for="antiCon" class="form-label">ANTIGÜEDAD DE LA CONSTRUCCIÓN:</label>
                <input type="text" name="antiCon"  style="font-size: 16px;" value="" style="width: 100%;" class="form-control " id="antiCon" required>
            </div>

            <div class="form-group col-md-3">
                <label for="antiGiro" class="form-label">ANTIGÜEDAD DEL GIRO O ACTIVIDAD:</label>
                <input type="text" name="antiGiro"  style="font-size: 16px;" style="width: 100%;"  value="" class="form-control " id="antiGiro"  required>
            </div>


            <div class="form-group col-md-3">
                <label for="numPisos" class="form-label">N° DE PISOS DEL EDIFICIO:</label>
                <input type="text" name="numPisos"  style="font-size: 16px;" value="' . $datos_anexo1["esta_numpisos"] . '" style="width: 100%;" class="form-control " id="numPisos" readonly >
            </div>

            <div class="form-group col-md-3">
                <label for="pisoUbi" class="form-label">PISO / DONDE FUNCIONA EL LOCAL:</label>
                <input type="text" name="pisoUbi"  style="font-size: 16px;" style="width: 100%;"  value="' . $datos_anexo1["esta_pisoubi"] . '" class="form-control " id="pisoUbi" readonly >
            </div>
  
            ';
        }

        $html .= ' 
                        <div class="form-group col-md-12" id="div_form_giro">
                           
                        </div>

      
                    </div>
    
                </div>
    
            </div>';

        $html .= '<hr>';

        if ($tipo_anexo == '6A') {
            $html .= '
        
            <div class="verificacion">
    
            <h6 class="text-center">IV.- VERIFICACIÓN DE CUMPLIMIENTO DE LAS CONDICIONES DE SEGURIDAD</h6>
            
            <br>

            <div>
                <p><strong>IV.1.- VERIFICACIÓN DE LA CLASIFICACIÓN DEL NIVEL DE RIESGO DEL ESTABLECIMIENTO OBJETO DE INSPECCIÓN</strong></p>
                <label class="ckbox">
                    <input type="checkbox" name="veri_1_6" id="veri_1_6" value="1" required>
                    <span>El inspector verifica que la clasificación del nivel de riesgo del Establecimiento Objeto
                        de Inspección si corresponde a la clasificación del nivel de riesgo según Formato del Anexo 3 de Reporte de Nivel de Riesgo que figura en el expediente.</span>
                </label>
            </div>
    
            <div>
                <p><strong>IV.2.- VERIFICACIÓN DE LA IMPLEMENTACIÓN DEL ESTABLECIMIENTO OBJETO DE INSPECCIÓN</strong></p>
                <label class="ckbox">
                    <input type="checkbox" name="veri_2_6" id="veri_2_6" value="1" required>
                    <span> El inspector verifica que el Establecimiento Objeto de Inspección se encuentra implementado para el tiipo de actividad a desarrollar, según lo dispuesto en el numeral 1.2.9 del Manual de Ejecución
                        de Inspección Técnica de Seguridad en Edificaciones.</span>
                </label>
            </div>
    
        </div>';
        }

        if ($tipo_anexo == '7A') {

            $html .= '
        
            <div class="verificacion">

            <h6 class="text-center">IV.- VERIFICACIÓN DE CUMPLIMIENTO DE LAS CONDICIONES DE SEGURIDAD</h6>
            <br>
    
            <div>
                <p><strong>IV.1.- EN CASO DE NO EXISTIR OBSERVACIONES SUBSANABLES:</strong></p>
                
                <div class="form-inline">

                    <div class="mr-2">
                        <p class=""> EL ESTABLECIMIENTO OBJETO DE INSPECCIÓN </p>
                    </div>

                    <div class="form-inline pb-3"  >

                        <div class="pl-3">
                            <label class="rdiobox">
                                <input type="radio" value="1" name="veri_1_7" id="" required>
                                <span>Si</span>
                            </label>
                        </div>

                        <div class="pl-3 ">
                            <label class="rdiobox ">
                                <input type="radio" value="2" name="veri_1_7" id="">
                                <span>No</span>
                            </label>
                        </div>

                    </div>
                   
                    <div>
                        <p class="mb-0" style="display: inline-block;">CUMPLE CON LAS CONDICIONES DE SEGURIDAD SEGÚN LO VERIFICADO POR EL GRUPO INSPECTOR.</p>
                    </div>

                </div>
            </div>
    
        </div>  
    
        ';
        }

        $htmlContenedor .= '<div class="" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_detalle_anexo_06_parte1":
        //mostrar_detalle_anexo_06_07_09_parte2

        $tipos_anexo = $_POST["tipo_anexo"];
        $datos = $solicitud->get_auxiliar('2', $tipos_anexo);

        // $componentes = $solicitud->get_anexo_04_componentes();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            ['id' => 2, 'nombre' => 'No Cumple'],
            ['id' => 3, 'nombre' => 'No Aplica']
        ];

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';
        foreach ($datos as $row) {

            if ($row['aux_idesc']  < 117) {

                if (
                    $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 19 ||
                    $row['aux_idesc'] == 34  || $row['aux_idesc'] == 38  || $row['aux_idesc'] == 42  ||
                    $row['aux_idesc'] == 48 || $row['aux_idesc'] == 53  || $row['aux_idesc'] == 56  ||
                    $row['aux_idesc'] == 58 || $row['aux_idesc'] == 61  || $row['aux_idesc'] == 63  || $row['aux_idesc'] == 67  ||
                    $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72  || $row['aux_idesc'] == 76  ||
                    $row['aux_idesc'] == 79 || $row['aux_idesc'] == 98  || $row['aux_idesc'] == 101  || $row['aux_idesc'] == 117
                ) {

                    if ($row['aux_idesc'] == 1) {
                        $cont = 0;
                        $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                    } else if ($row['aux_idesc'] == 61) {
                        $cont = 0;
                        $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                    } else if ($row['aux_idesc'] == 79) {
                        $cont = 0;
                        $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OTROS RIESGOS VINCULADOS A LA ACTIVIDAD

                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                    } else if ($row['aux_idesc'] == 117) {
                        $cont = 0;
                        $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OBSERVACIONES NO RELEVANTES EN TERMINOS DE RIESGO PARA TODAS LAS FUNCIONES


                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                    } else {
                        $cont = 0;
                        $html .= '
                                <div class="form-row ">
                                    <div class="col-md-9">
                                        <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                    </div>
                                    <div class="col-md-3 form-row">
                                       
                                   
                                    </div>
                                </div>
                                <hr>
                            ';
                    }
                } else {

                    if ($row['aux_idesc'] == 44) {
                        $html .= '
                    <div class="form-row">
                    <div class="col-md-0 mr-2">
                    <p class="text-justify"> </p>
                    </div>
                        <div class="col-md-9">
                            <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                        </div>
                        <div class="col-md-2 form-row">
                        </div>
                    </div>
                    <hr>
                    ';
                    } else {

                        $cont++;
                        $html .= '
                    <div class="form-row">
                        <div class="col-md-0 mr-2">
                            <p class="text-justify"> <b>' . $cont . '</b> </p>
                        </div>
                        <div class="col-md-10">
                            <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                        </div>
                        <div class="col-md-6 form-row">';

                        foreach ($opciones as $opcion) {
                            $html .=
                                '<div class=" ml-5 ">
                                    <label class="ckbox" >
                                        <input type="checkbox" class="opcionAnexo_6A_1_idesx" name="opcionAnexo_6A_1_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)" >
                                        <span>   ' . $opcion['nombre'] . ' </span>
                                    </label>
                                </div>';
                        }
                        $html .=   ' </div>
                    </div>
                    <hr>
                ';
                    }
                }
            }
        }

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;
    case "mostrar_detalle_anexo_06_parte2":

        //mostrar_detalle_anexo_06_07_09_parte2

        $tipos_anexo = $_POST["tipo_anexo"];
        $datos = $solicitud->get_auxiliar('2', $tipos_anexo);

        // $componentes = $solicitud->get_anexo_04_componentes();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            ['id' => 2, 'nombre' => 'No Cumple'],
            ['id' => 3, 'nombre' => 'No Aplica'],
            ['id' => 4, 'nombre' => 'Si Cumple VERIF. LEVANT. OBSERV.'],
            ['id' => 5, 'nombre' => 'No Cumple VERIF. LEVANT. OBSERV.']

            // ['id' => 2, 'nombre' => 'No Corresponde']
        ];

        //    <div class="col-md-0">'  . convertir_a_letras($cont) . '</div>

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';
        foreach ($datos as $row) {

            if ($row['aux_idesc'] >= 117) {

                if (
                    $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 19 ||
                    $row['aux_idesc'] == 34  || $row['aux_idesc'] == 38  || $row['aux_idesc'] == 42  ||
                    $row['aux_idesc'] == 48 || $row['aux_idesc'] == 53  || $row['aux_idesc'] == 56  ||
                    $row['aux_idesc'] == 58 || $row['aux_idesc'] == 61  || $row['aux_idesc'] == 63  || $row['aux_idesc'] == 67  ||
                    $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72  || $row['aux_idesc'] == 76  ||
                    $row['aux_idesc'] == 79 || $row['aux_idesc'] == 98  || $row['aux_idesc'] == 101  || $row['aux_idesc'] == 117
                ) {

                    if ($row['aux_idesc'] == 1) {
                        $cont = 0;
                        $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                    } else if ($row['aux_idesc'] == 61) {
                        $cont = 0;
                        $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                    } else if ($row['aux_idesc'] == 79) {
                        $cont = 0;
                        $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OTROS RIESGOS VINCULADOS A LA ACTIVIDAD
    
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                    } else if ($row['aux_idesc'] == 117) {
                        $cont = 0;
                        $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OBSERVACIONES NO RELEVANTES EN TERMINOS DE RIESGO PARA TODAS LAS FUNCIONES
    
    
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                    } else {
                        $cont = 0;
                        $html .= '
                                    <div class="form-row ">
                                        <div class="col-md-9">
                                            <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                        </div>
                                        <div class="col-md-3 form-row">
                                           
                                       
                                        </div>
                                    </div>
                                    <hr>
                                ';
                    }
                } else {

                    if ($row['aux_idesc'] == 44) {
                        $html .= '
                        <div class="form-row">
                        <div class="col-md-0 mr-2">
                        <p class="text-justify"> </p>
                        </div>
                            <div class="col-md-9">
                                <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                            </div>
                            <div class="col-md-2 form-row">
                                     
                            </div>
                        </div>
                        <hr>
                    ';
                    } else {

                        $cont++;
                        $html .= '
                        <div class="form-row">
                            <div class="col-md-0 mr-2">
                                <p class="text-justify"> <b>' . $cont . '</b> </p>
                            </div>
                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>
                            <div class="col-md-12 form-row" style="display: flex;flex-direction: column;">';

                        //
                        $html .= ' <div style="display: flex;"> ';

                        foreach ($opciones as $opcion) {

                            if ($opcion['id'] == 1  || $opcion['id'] == 2 || $opcion['id'] == 3) {
                                # code...

                                $html .= '  
                                    <div class=" ml-5 ">
                                        <label class="ckbox">
                                            <input type="checkbox" class="opcionAnexo_6A_2_idesx"  name="opcionAnexo_6A_2_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)" >
                                            <span>    ' . $opcion['nombre'] . '  </span>
                                        </label>
                                    </div>';
                            }
                        }

                        $html .= ' </div> ';

                        $html .=   ' </div>
                        </div>
                        <hr>';
                    }
                }
            }
        }

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_detalle_anexo_07_parte1":

        $tipos_anexo = $_POST["tipo_anexo"];
        $datos = $solicitud->get_auxiliar('2', $tipos_anexo);

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            ['id' => 2, 'nombre' => 'No Cumple'],
            ['id' => 3, 'nombre' => 'No Aplica']
        ];

        $opciones_observaciones = [
            ['id' => 1, 'nombre' => 'Si'],
            ['id' => 2, 'nombre' => 'No'],
            // ['id' => 2, 'nombre' => 'No Corresponde']
        ];
        //    <div class="col-md-0">'  . convertir_a_letras($cont) . '</div>

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';
        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 19 ||
                $row['aux_idesc'] == 34  || $row['aux_idesc'] == 38  || $row['aux_idesc'] == 42  ||
                $row['aux_idesc'] == 48 || $row['aux_idesc'] == 53  || $row['aux_idesc'] == 56  ||
                $row['aux_idesc'] == 58 || $row['aux_idesc'] == 61  || $row['aux_idesc'] == 63  || $row['aux_idesc'] == 67  ||
                $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72  || $row['aux_idesc'] == 76  ||
                $row['aux_idesc'] == 79 || $row['aux_idesc'] == 98  || $row['aux_idesc'] == 101
            ) {

                if ($row['aux_idesc'] == 1) {
                    $cont = 0;
                    $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                }

                if ($row['aux_idesc'] == 61) {
                    $cont = 0;
                    $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                }

                if ($row['aux_idesc'] == 79) {
                    $cont = 0;
                    $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OTROS RIESGOS VINCULADOS A LA ACTIVIDAD
    
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                }

                $cont = 0;
                $html .= '
                                <div class="form-row ">
                                    <div class="col-md-9">
                                        <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                    </div>
                                    <div class="col-md-3 form-row">
                                       
                                   
                                    </div>
                                </div>
                                <hr>
                            ';
            } else {

                if ($row['aux_idesc'] != 134) {
                    $cont++;
                    $html .= '
                        <div class="form-row">
                            <div class="col-md-0 mr-2">
                                <p class="text-justify"> <b>' . $cont . '</b> </p>
                            </div>
                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>
                            <div class="col-md-3 form-row">';


                    foreach ($opciones as $opcion) {
                        $html .= '  
                                    <div class=" ml-5 ">
                                        <label class="ckbox" >
                                            <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)" >
                                            <span>' . $opcion['nombre'] . ' </span>
                                         </label>
                                    </div>             
                                    ';
                    }

                    $html .=   ' </div>
                        </div>
                        <hr>';
    
                  
                }else{
                    $html .= '
                    <div class="form-row">
                        <div class="col-md-0 mr-2">
                            <p class="text-justify"> <b>' . $cont . '</b> </p>
                        </div>
                        <div class="">
                            <label for="opcionAnexo_7A_1_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label" style="font-size: 15px;font-weight: bold;" >' . $row['aux_desc1'] . '</label>
                            <textarea class="form-control" name="opcionAnexo_7A_1_idesx_textArea[' . $row['aux_idesc'] . ']"  id="opcionAnexo_7A_1_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                        </div>
                     
                    </div>';
                }
            }
        }

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_detalle_anexo_07_parte2":

        //OBSERVACIÓN SUBSANABLE
        $tipos_anexo = $_POST["tipo_anexo"];
        $datos = $solicitud->get_auxiliar('3', $tipos_anexo);

        // $componentes = $solicitud->get_anexo_04_componentes();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            ['id' => 2, 'nombre' => 'No Cumple']
        ];
        //    <div class="col-md-0">'  . convertir_a_letras($cont) . '</div>

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';

        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 20 ||
                $row['aux_idesc'] == 41 || $row['aux_idesc'] == 44 || $row['aux_idesc'] == 50
                || $row['aux_idesc'] == 52 || $row['aux_idesc'] == 57 || $row['aux_idesc'] == 60
                || $row['aux_idesc'] == 64 || $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72 || $row['aux_idesc'] == 78
                || $row['aux_idesc'] == 81 || $row['aux_idesc'] == 86 || $row['aux_idesc'] == 90
                || $row['aux_idesc'] == 95 || $row['aux_idesc'] == 115 || $row['aux_idesc'] == 118
       
            ) {

                if ($row['aux_idesc'] == 1) {
                    $cont = 0;
                    $html .= '
                                        <div class="form-row border-top border-bottom">
                                            <div class="col-md-9">
                                                <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                            </div>
                                        </div>
                                        <hr>
                                    ';
                } else

                if ($row['aux_idesc'] == 70) {
                    $cont = 0;
                    $html .= '
                                        <div class="form-row border-top border-bottom">
                                            <div class="col-md-9">
                                                <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    ';
                } if ($row['aux_idesc'] == 95) {
                
                    $cont = 0;
                    $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;">
                                            OTROS RIESGOS VINCULADOS A LA ACTIVIDAD, APLICABLE PARA TODAS LAS FUNCIONES
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    ';

                }else {

                    $cont = 0;
                    $html .= '
                                    <div class="form-row ">
                                        <div class="col-md-9">
                                            <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                        </div>
                                        <div class="col-md-3 form-row">
                                           
                                       
                                        </div>
                                    </div>
                                    <hr>
                                ';
                }
            } else {

                $cont++;
                if ($row['aux_idesc'] != 136) {
                    
                    $html .= '
                                <div class="form-row">
                                    <div class="col-md-0 mr-2">
                                        <p class="text-justify"> <b>' . $cont . '</b> </p>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                                    </div>
                                    <div class="col-md-3 form-row">';

                    foreach ($opciones as $opcion) {
                        $html .= '
                        
                                            <div class=" ml-5 ">
                                                <label class="ckbox" >
                                                    <input type="checkbox" class="opcionAnexo_7A_2_idesx" name="opcionAnexo_7A_2_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)">
                                                    <span>' . $opcion['nombre'] . ' </span>
                                                    
                                                </label>
                                            </div>
                                    
                                            ';
                    }

                    $html .=   ' </div>';

                    $html .=
                        '<div class="">
                            <label for="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label">En:</label>
                            <textarea class="form-control" name="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']"  id="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                        </div>';
                    $html .=    '</div>
                                <hr>
                            ';
         
                }else{
                    $html .= '
                    <div class="form-row">
                        <div class="col-md-0 mr-2">
                            <p class="text-justify"> <b>' . $cont . '</b> </p>
                        </div>
                        <div class="">
                            <label for="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label" style="font-size: 15px;font-weight: bold;" >' . $row['aux_desc1'] . '</label>
                            <textarea class="form-control" name="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']"  id="opcionAnexo_7A_2_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                        </div>
                     
                    </div>';
                }

            }
        }

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "mostrar_detalle_anexo_09_parte1":

        $tipos_anexo = $_POST["tipo_anexo"];
        $datos = $solicitud->get_auxiliar('4', $tipos_anexo);

        $opciones = [
            ['id' => 1, 'nombre' => 'Si'],

        ];

        $opciones_2 = [
            ['id' => 1, 'nombre' => 'Si'],
            ['id' => 1, 'nombre' => 'No'],
        ];

        $opciones_3 = [
            ['id' => 1, 'nombre' => 'Nivel de riesgo alto'],
            ['id' => 1, 'nombre' => 'Nivel de riesgo muy alto.'],
        ];

        //    <div class="col-md-0">'  . convertir_a_letras($cont) . '</div>

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';
        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 1  || $row['aux_idesc'] == 9  || $row['aux_idesc'] == 12 || $row['aux_idesc'] == 37
            ) {

                // esto es para un cambio de estilo un poco mas notable
                if ($row['aux_idesc'] == 12) {
                    $cont = 0;
                    $html .= '
                                    <div class="form-row border-top border-bottom">
                                        <div class="col-md-9">
                                            <p class="text-justify " style="font-size: 18px;font-weight: bold;"> VI.- VERIFICACIÓN DEL CUMPLIMIENTO DE LAS CONDICIONES DE SEGURIDAD    
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                ';
                }

                // esto es para un cambio de estilo un poco notable
                $cont = 0;
                $html .= '
                                <div class="form-row ">
                                    <div class="col-md-11">
                                        <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                                    </div>
                                    <div class="col-md-3 form-row">
                          
                                    </div>
                                </div>
                                <hr>
                            ';
            } else {

                $cont++;
                // if ($row['aux_idesc'] >= 2 && $row['aux_idesc'] <= 8) {

                if ($row['aux_idesc'] == 6) {
                    $html .= '

                        <div class="form-row">
                        
                            <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>' . $cont . '</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>
                            </div>

                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>

                            <div class="col-md-3 pl-5">
                            
                            <label for="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" >
                                <input type="date" class="opcionAnexo_9_idesx form-control mb-2" name="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" value="" id="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" >
                            </label>

                            </div>
                        </div><hr>';
                } else if ($row['aux_idesc'] == 7) {

                    $html .= '

                        <div class="form-row">
                        
                            <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>' . $cont . '</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>
                            </div>

                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>

                            <div class="col-md-3 form-row">';

                    foreach ($opciones_2 as $opcion) {
                        $html .= '  
                                            <div class=" ml-5 ">
                                                <label class="ckbox" >
                                                    <input type="checkbox" class="opcionAnexo_9_idesx" name="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" >
                                                    <span>' . $opcion['nombre'] . ' </span>
                                                </label>
                                            </div>             
                                        ';
                    }

                    $html .=
                        '</div>
                        </div>
                        <hr>';
                } else
                if ($row['aux_idesc'] == 10) {
                    $html .= '

                        <div class="form-row">
                        
                            <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>' . $cont . '</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>
                            </div>

                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>

                            <div class="col-md-3 form-row">';

                    foreach ($opciones_3 as $opcion) {
                        $html .= '  
                                            <div class=" ml-5 ">
                                                <label class="ckbox" >
                                                    <input type="checkbox" class="opcionAnexo_9_idesx" name="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" >
                                                    <span>' . $opcion['nombre'] . ' </span>
                                                </label>
                                            </div>             
                                        ';
                    }

                    $html .=                        '
                            </div>';
                    $html .=
                        '<div class="d-flex flex-column form-group">
                            <label for="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']"> Indicar las características del Establecimiento Objeto de Inspección que hacen que su
                            nivel de riesgo se incremente:  </label>
                            <textarea class="form-control" name="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']" id="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']"  rows="3"></textarea>
                            ';
                    $html .= '
                            </div>';
                    $html .= '</div>
                                <hr>';
                } else
                if ($row['aux_idesc'] == 11) {
                    $html .= '

                        <div class="form-row">
                        
                            <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>' . $cont . '</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>
                            </div>

                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>

                        <div class="col-md-9 form-row">';

                    foreach ($opciones as $opcion) {
                        $html .= '  
                            <div class=" ml-5">
                                <label class="ckbox" >
                                    <input type="checkbox" class="opcionAnexo_9_idesx" name="opcionAnexo_9_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '"  >
                                    <span>' . $opcion['nombre'] . ' </span>
                                </label>
                            </div>             
                                        ';
                    }

                    $html .= '
                            </div>';

                    $html .=
                        '<div class="d-flex flex-column form-group pl-5">
                            <label for="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']"> 
                                Señalar a continuación las causas de la falta de
                                implementación según lo establecido en el numeral 1.2.9 del Manual de Ejecución de
                                Inspección Técnica de Seguridad en Edificaciones:
                            </label>
                            <textarea class="form-control" name="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']" id="opcionAnexo_9_idesx_textArea[' . $row['aux_idesc'] . ']" rows="3"></textarea>
                            ';
                    $html .= '
                            </div>';
                    $html .= '</div>
                                <hr>';
                } else {

                    if ($row['aux_idesc'] <= 33) {

                        if ($row['aux_idesc'] >= 17 and $row['aux_idesc'] <= 18) {

                            $html .= '
                            <div class="form-row">

                                <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>*</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>

                                </div>

                                <div class="">';

                            foreach ($opciones as $opcion) {
                                $html .= '  
                                                    <div class="  ">
                                                        <label class="ckbox" >
                                                            <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '"  >
                                                            <span>(' . $opcion['nombre'] . ')</span>
                                                        </label>
                                                    </div>             
                                                ';
                            }

                            $html .=   ' </div>';

                            $html .= '<div class="col-md-10">
                                    <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                                </div>
                                </div>';

                            if ($row['aux_idesc'] == 18) {
                                $html .=
                                    '<div class="ml-5">
                                        <label for="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label">En:</label>
                                        <textarea class="form-control" name="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']"  id="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                                    </div>
                                    <hr>';
                            }
                        } else if ($row['aux_idesc'] >= 19 and $row['aux_idesc'] <= 22) {
                            $html .= '
                            <div class="form-row">

                                <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>*</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>

                                </div>

                                <div class="">';

                            foreach ($opciones as $opcion) {
                                $html .= '  
                                                    <div class="  ">
                                                        <label class="ckbox" >
                                                            <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" >
                                                            <span>(' . $opcion['nombre'] . ')</span>
                                                        </label>
                                                    </div>             
                                                ';
                            }

                            $html .=   ' </div>';

                            $html .= '<div class="col-md-10">
                                    <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                                </div>
                                </div>';

                            if ($row['aux_idesc'] == 22) {
                                $html .=
                                    '<div class="ml-5">
                                            <label for="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label">En:</label>
                                            <textarea class="form-control" name="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" id="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                                        </div>
                                        <hr>';
                            }
                        } else {

                            $html .= '
                         
                            <div class="form-row">
                                <div class="col-md-0 mr-2">
                                    <!-- <p class="text-justify"> <b>' . $cont . '</b> </p> -->
                                    <p class="text-justify"> <b> * </b> </p>
                                </div>';


                            $html .= '     <div class="">';

                            foreach ($opciones as $opcion) {
                                $html .= '  
                                                <div class=" ">
                                                    <label class="ckbox" >
                                                        <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" onclick="uncheckOther(this)" >
                                                        <span>(' . $opcion['nombre'] . ')</span>
                                                    </label>
                                                </div>             
                                            ';
                            }

                            $html .=   ' </div>';


                            $html .= '    
                                <div class="col-md-10">
                                    <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                                </div>';

                            $html .=
                                '<div class="ml-5">
                                    <label for="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" class="form-label">En:</label>
                                    <textarea class="form-control" name="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" id="opcionAnexo_7A_idesx_textArea[' . $row['aux_idesc'] . ']" rows="2"  cols="80"></textarea>
                                </div>';

                            $html .=    '</div>
                                <hr>';
                        }
                    } else if ($row['aux_idesc'] == 34) {

                        $html .= '
                        
                            <div class="form-row">

                                <div class="col-md-0 mr-2">
                                <!-- <p class="text-justify"> <b>*</b> </p> -->
                                <p class="text-justify"> <b> * </b> </p>

                                </div>

                                <div class="">';

                        foreach ($opciones as $opcion) {
                            $html .= '  
                                                    <div class="  ">
                                                        <label class="ckbox" for="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" >
                                                            <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" id="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" >
                                                            <span>(' . $opcion['nombre'] . ') </span>
                                                        </label>
                                                    </div>             
                                                ';
                        }

                        $html .=   ' </div>';

                        $html .= '<div class="col-md-10">
                                    <p class="text-justify ' . (($row['aux_idesc'] == 34) ? 'font-weight-bold' : '') . '">' . $row['aux_desc1'] . '</p>
                                 </div>
                            </div>
                            <hr>
                            ';
                    } else if ($row['aux_idesc'] >= 35 && $row['aux_idesc'] <= 36) {

                        $html .= '
                        
                        <div class="form-row">
                            <div class="">
                                <p class="text-justify ' . (($row['aux_idesc'] == 35) ? 'font-weight-bold' : '') . '"> 
                                ' . (($row['aux_idesc'] == 35) ? '
                                        <div clas="form-control">
                                            <label for="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']">' . $row['aux_desc1'] . '</label>
                                            <input type="number" class="form-control" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" placeholder="numero de dias">
                                        </div>         
                                ' :  $row['aux_desc1']) . '
                               
                                </p>
                            </div>
                        </div>';

                        if ($row['aux_idesc'] == 36) {
                            $html .= '     <hr>';
                        }

                        //// podria continuar

                    } else if ($row['aux_idesc'] == 38) {
                        $html .= '
                        
                        <div class="form-row">

                            <div class="col-md-0 mr-2">
                            <!-- <p class="text-justify"> <b>*</b> </p> -->
                            <p class="text-justify"> <b> * </b> </p>

                            </div>

                            <div class="">';

                        foreach ($opciones as $opcion) {
                            $html .= '  
                                                <div class="  ">
                                                    <label class="ckbox" for="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" >
                                                        <input type="checkbox" class="opcionAnexo_7A_1_idesx" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '" id="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" >
                                                        <span>(' . $opcion['nombre'] . ') </span>
                                                    </label>
                                                </div>             
                                            ';
                        }

                        $html .=   ' </div>';

                        $html .= '<div class="col-md-10">
                                <p class="text-justify ' . (($row['aux_idesc'] == 38) ? 'font-weight-bold' : '') . '">' . $row['aux_desc1'] . '</p>
                             </div>
                        </div>
                        <hr>
                        ';
                    } else {

                        $html .= '    ' . (($row['aux_idesc'] == 39) ? '
                        <div class="form-control" style="width: 400px;">
                            <label for="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']">' . $row['aux_desc1'] . '</label>
                            <input type="number" class="form-control" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" placeholder="numero de dias">
                        </div>         
                ' :  "") . '';

                        $html .= '    ' . (($row['aux_idesc'] == 40) ? '
                <div class="form-control" style="width: 400px;">
                    <label for="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']">' . $row['aux_desc1'] . '</label>
                    <input type="date" class="form-control" name="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_7A_idesx[' . $row['aux_idesc'] . ']" placeholder="numero de dias">
                </div>         
                ' :  "") . '';



                        if ($row['aux_idesc'] == 40) {
                            $html .= '     <hr>';
                        }
                    }
                }
            }
        }

        // resto de la informacion




        // resto
        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "guardar_detalle":

        if (isset($_POST['opcionAnexo_2_idesx']) && is_array($_POST['opcionAnexo_2_idesx'])) {
            // Inicializa los arrays para almacenar descripcion_id y opcion_id
            $descripcionIds = [];
            $opcionIds = [];

            // Itera a través de las respuestas
            foreach ($_POST['opcionAnexo_2_idesx'] as $opcionAnexo_2_idesx => $opcion_id) {
                // Verifica si la respuesta está marcada antes de procesar
                if (!empty($opcion_id)) {
                    // Almacena las claves en $descripcionIds y los valores en $opcionIds
                    $descripcionIds[] = $opcionAnexo_2_idesx;
                    $opcionIds[] = $opcion_id;
                }
            }

            // Verifica si se recopilaron respuestas antes de procesar
            if (!empty($descripcionIds) && !empty($opcionIds)) {
                // Convierte los arrays en cadenas y almacénalos en la base de datos
                $descripcionIdsString = "{" . implode(",", $descripcionIds) . "}";
                $opcionIdsString = "{" . implode(",", $opcionIds) . "}";


                if (isset($_POST["desoli_id"])) {

                    $solicitud->update_detalle(
                        $descripcionIdsString,
                        $opcionIdsString,
                        $_POST["desoli_id"],
                    );
                } else {

                    $solicitud->insert_detalle_anexo_2(
                        $_SESSION['soit_id'],
                        null,
                        $descripcionIdsString,
                        $opcionIdsString,
                        "2",
                        "1",
                        null
                    );


                    $_SESSION['opcionAnexo_2_idesx'] =  $_SESSION['opcionAnexo_1_idesx'];

                    $solicitud->insert_estado_solicitud(
                        $_SESSION['opcionAnexo_1_idesx'],
                        $_SESSION['opcionAnexo_2_idesx'],
                        null,
                        null,
                        '0'
                    );
                }
            } else {
                echo "No se recibieron respuestas.";
            }
        }

        if (isset($_POST['opcionAnexo_3_idesx'])) {
            // Inicializar los arrays para almacenar descripcion_id y opcion_id
            $descripcionIds = [];
            $opcionIds = [];

            foreach ($_POST['opcionAnexo_3_idesx'] as $opcionAnexo_3_idesx => $opcion_id) {
                if (!empty($opcion_id)) {
                    // Almacenar las claves en $descripcionIds y los valores en $opcionIds
                    $descripcionIds[] = $opcionAnexo_3_idesx;
                    $opcionIds[] = $opcion_id;
                }
            }

            // Verificar si se recopilaron respuestas antes de procesar
            if (!empty($descripcionIds) && !empty($opcionIds)) {
                // Convertir los arrays en cadenas y almacenarlos en la base de datos
                $descripcionIdsString = "{" . implode(",", $descripcionIds) . "}";
                $opcionIdsString = "{" . implode(",", $opcionIds) . "}";

                if (isset($_POST["desoli_id"])) {

                    $solicitud->update_detalle(
                        $descripcionIdsString,
                        $opcionIdsString,
                        $_POST["desoli_id"],
                    );
                } else {

                    $solicitud->insert_detalle_anexo_2(
                        $_SESSION['soit_id'],
                        null,
                        $descripcionIdsString,
                        $opcionIdsString,
                        "3",
                        "1",
                        null
                    );

                    $_SESSION['opcionAnexo_3_idesx'] =  $_SESSION['opcionAnexo_2_idesx'];

                    $solicitud->insert_estado_solicitud(
                        $_SESSION['soit_id'],
                        $_SESSION['opcionAnexo_2_idesx'],
                        $_SESSION['opcionAnexo_3_idesx'],
                        null,
                        '0'
                    );
                }
            } else {
                echo 'No se ha seleccionado ninguna opción.';
            }
        }

        break;
    case "guardar_anexo04":

        //$_SESSION['soit_id'];  va hacer uno para este ejemplo 101

        if (isset($_POST["decla_id"])) {

            $solicitud->update_declaracion_anexo_4(

                $_POST['requiereLicencia'],
                //se valida cuando los input number no se ingresen se conviertan a 0 por defecto
                $_POST['capacidadEstablecimiento'],
                $_POST['edificacionConstruida'],
                $_POST['giroAntiguedad'],

                $_POST['areaTerreno'],
                $_POST['areaTechadaPiso1'],
                $_POST['areaTechadaPiso2'],
                $_POST['areaTechadaPiso3'],
                $_POST['areaTechadaPiso4'],
                $_POST['otrosPisos'],
                $_POST['areaTechadaTotal'],

                //12

                //vista 2 table
                $_POST['decla_edifi1'],
                $_POST['decla_edifi2'],
                $_POST['decla_edifi3'],
                $_POST['decla_edifi4'],  //4   //16

                // id de la tabla 4
                $_POST["decla_id"],

                //
                $_POST['pqs'],
                $_POST['co2'],
                $_POST['ack'],
                $_POST['h2o'],  //4   //16
                $_POST['otro_quimicos']

            );

            $declaracionIdInsertado =   $_POST["decla_id"];
        } else {
            $resultadoInsercion_declaracion =    $solicitud->insert_anexo_04(
                // vista 1
                $_POST['requiereLicencia'],

                //se valida cuando los input number no se ingresen se conviertan a 0 por defecto
                ($_POST['capacidadEstablecimiento'] = intval($_POST['capacidadEstablecimiento'])),
                ($_POST['edificacionConstruida'] = intval($_POST['edificacionConstruida'])),
                ($_POST['giroAntiguedad']  = intval($_POST['giroAntiguedad'])),
                //
                ($_POST['areaTerreno']  = ($_POST['areaTerreno'])),
                ($_POST['areaTechadaPiso1'] = ($_POST['areaTechadaPiso1'])),
                ($_POST['areaTechadaPiso2'] = ($_POST['areaTechadaPiso2'])),
                ($_POST['areaTechadaPiso3'] = ($_POST['areaTechadaPiso3'])),
                ($_POST['areaTechadaPiso4'] = ($_POST['areaTechadaPiso4'])),
                ($_POST['otrosPisos'] = ($_POST['otrosPisos'])),
                ($_POST['areaTechadaTotal'] = ($_POST['areaTechadaTotal'])),
                ///12

                //vista 2 table

                $_POST['decla_edifi1'],
                $_POST['decla_edifi2'],
                $_POST['decla_edifi3'],
                $_POST['decla_edifi4'],  //4   //16
                $_SESSION['opcionAnexo_1_idesx'],
                //
                $_POST['pqs'],
                $_POST['co2'],
                $_POST['ack'],
                $_POST['h2o'],  //4   //16
                $_POST['otro_quimicos']

            );

            $declaracionIdInsertado = $resultadoInsercion_declaracion[0]['decla_id'];
        }

        if (isset($declaracionIdInsertado)) {
            if (isset($_POST['opcionAnexo_4_idesx']) && is_array($_POST['opcionAnexo_4_idesx'])) {
                // Inicializa los arrays para almacenar descripcion_id y opcion_id
                $descripcionIds = [];
                $opcionIds = [];

                // Itera a través de las respuestas
                foreach ($_POST['opcionAnexo_4_idesx'] as $opcionAnexo_4_idesx => $opcion_id) {
                    // Verifica si la respuesta está marcada antes de procesar
                    if (!empty($opcion_id)) {

                        // Almacena las claves en $descripcionIds y los valores en $opcionIds
                        $descripcionIds[] = $opcionAnexo_4_idesx;
                        $opcionIds[] = $opcion_id;
                    }
                }

                // Verifica si se recopilaron respuestas antes de procesar
                if (!empty($descripcionIds) && !empty($opcionIds)) {

                    $descripcionIdsString = "{" . implode(",", $descripcionIds) . "}";

                    $opcionIdsString = "{" . implode(",", $opcionIds) . "}";

                    if (isset($_POST["desoli_id"])) {

                        $solicitud->update_detalle(
                            $descripcionIdsString,
                            $opcionIdsString,
                            $_POST["desoli_id"],
                        );
                    } else {
                        // $solicitud->insert_detalle_anexo(

                        //     $_SESSION['opcionAnexo_1_idesx'],
                        //     $descripcionIdsString,
                        //     $opcionIdsString,
                        //     "4",
                        // );

                        $solicitud->insert_detalle_anexo_2(
                            $_SESSION['soit_id'],
                            null,
                            $descripcionIdsString,
                            $opcionIdsString,
                            "4",
                            "1",
                            null
                        );

                        $_SESSION['opcionAnexo_4_idesx'] =  $_SESSION['opcionAnexo_3_idesx'];

                        $solicitud->insert_estado_solicitud(
                            $_SESSION['opcionAnexo_1_idesx'],
                            $_SESSION['opcionAnexo_2_idesx'],
                            $_SESSION['opcionAnexo_3_idesx'],
                            $_SESSION['opcionAnexo_4_idesx'],
                            '1'
                        );
                    }

                    if (
                        isset($_SESSION['opcionAnexo_1_idesx']) && isset($_SESSION['opcionAnexo_2_idesx'])

                        && isset($_SESSION['opcionAnexo_3_idesx']) && isset($_SESSION['opcionAnexo_4_idesx'])
                    ) {
                        // // Eliminar todas las variables de sesión
                        // session_unset($_SESSION['soit_id']);
                        // session_unset($_SESSION['opcionAnexo_2_idesx']);
                        // session_unset($_SESSION['opcionAnexo_3_idesx']);
                        // session_unset($_SESSION['opcionAnexo_4_idesx']);


                        // Destruir la sesión
                        // session_destroy();

                        exit();
                    }
                } else {
                    echo "No se recibieron respuestas.";
                }
            } else {
                echo "No se recibieron respuestas.";
            }
        }

        break;

    case "guardar_anexo_6_7_9":

        // algunos de estos campos no existen en algunos de los anexos
        // 6 ,7 y 9  se tienen que crear para poder insertarlos, como nulos

        if (isset($_POST["info_id"])) {
        } else {

            if (!isset($_POST['antiCon'])) {
                $_POST['antiCon'] = null;
            }

            if (!isset($_POST['antiGiro'])) {
                $_POST['antiGiro'] = null;
            }

            if (!isset($_POST['veri_1_6'])) {
                $_POST['veri_1_6'] = null;
            }

            if (!isset($_POST['veri_2_6'])) {
                $_POST['veri_2_6'] = null;
            }

            if (!isset($_POST['veri_1_7'])) {
                $_POST['veri_1_7'] = null;
            }

            //falta las post del anexo 9
            $resultadoInsercion_inspeccion =  $solicitud->insert_informe_inspector(
                $_POST['grupoItse_insp'],  // $info_tipoitse,                
                $_POST['fecha_insp'], // $info_fecha,
                $_POST['hora_inicio'],   // $info_hinicio,                        
                $_POST['hora_fin'],   // $info_hfin,
                $_POST['antiCon'],  // $info_anticon,
                $_POST['antiGiro'], // $info_antigiro,
                $_POST['veri_1_6'], // $info_veri_1_6,
                $_POST['veri_2_6'], // $info_veri_2_6,
                $_POST['veri_1_7'], // $info_veri_1_7
            );

            $inspeccionIdInsertado = $resultadoInsercion_inspeccion[0]['info_id'];
        }

        if (isset($inspeccionIdInsertado)) {

            if (isset($_POST['opcionAnexo_6A_idesx']) && is_array($_POST['opcionAnexo_6A_idesx'])) {

                // Inicializa los arrays para almacenar descripcion_id y opcion_id
                $descripcionIds = [];
                $opcionIds = [];

                // Itera a través de las respuestas
                foreach ($_POST['opcionAnexo_6A_idesx'] as $opcionAnexo_6A_idesx => $opcion_id) {
                    // Verifica si la respuesta está marcada antes de procesar
                    if (!empty($opcion_id)) {

                        // Almacena las claves en $descripcionIds y los valores en $opcionIds
                        $descripcionIds[] = $opcionAnexo_6A_idesx;
                        $opcionIds[] = $opcion_id;
                    }
                }

                // Verifica si se recopilaron respuestas antes de procesar
                if (!empty($descripcionIds) && !empty($opcionIds)) {

                    $descripcionIdsString = "{" . implode(",", $descripcionIds) . "}";

                    $opcionIdsString = "{" . implode(",", $opcionIds) . "}";

                    $textIdsString = null;

                    if (isset($_POST["info_id"])) { //esto es para actualizar

                        $solicitud->update_detalle(
                            $descripcionIdsString,
                            $opcionIdsString,
                            $_POST["info_id"],
                        );
                    } else { //esto es para insertar

                        $solicitud->insert_detalle_anexo_2(
                            null,
                            $inspeccionIdInsertado,
                            $descripcionIdsString,
                            $opcionIdsString,
                            "6A_1",
                            "2",
                            $textIdsString
                        );
                    }
                } else {
                    echo "No se recibieron respuestas.";
                }
            } else {
                echo "No se recibieron respuestas.";
            }

            // para el anexo 7
            if (isset($_POST['opcionAnexo_7A_idesx']) && is_array($_POST['opcionAnexo_7A_idesx'])) {

                // Inicializa los arrays para almacenar descripcion_id y opcion_id
                $descripcionIds = [];
                $opcionIds = [];
                $textIds = [];

                // Itera a través de las respuestas
                foreach ($_POST['opcionAnexo_7A_idesx'] as $opcionAnexo_7A_idesx => $opcion_id) {
                    // Verifica si la respuesta está marcada antes de procesar
                    if (!empty($opcion_id)) {

                        // Almacena las claves en $descripcionIds y los valores en $opcionIds
                        $descripcionIds[] = $opcionAnexo_7A_idesx;
                        $opcionIds[] = $opcion_id;
                    }
                }

                foreach ($_POST['opcionAnexo_7A_idesx_textArea'] as $text_id) {
                    // Verifica si la respuesta está marcada antes de procesar
                    if (!empty($text_id)) {
                        // Hacer algo con la opción seleccionada, por ejemplo, imprimirlo
                        $textIds[] = htmlspecialchars($text_id);
                    }
                }
                // Verifica si se recopilaron respuestas antes de procesar
                if (!empty($descripcionIds) && !empty($opcionIds) && !empty($textIds)) {

                    $descripcionIdsString = "{" . implode(",", $descripcionIds) . "}";

                    $opcionIdsString = "{" . implode(",", $opcionIds) . "}";

                    $textIdsString = "{" . implode(",", $textIds) . "}";

                    if (isset($_POST["info_id"])) { //esto es para actualizar

                        $solicitud->update_detalle(
                            $descripcionIdsString,
                            $opcionIdsString,
                            $_POST["info_id"],
                        );
                    } else { //esto es para insertar


                        $solicitud->insert_detalle_anexo_2(
                            null,
                            $inspeccionIdInsertado,
                            $descripcionIdsString,
                            $opcionIdsString,
                            "7A_1",
                            "2",
                            $textIdsString
                        );
                    }
                } else {

                    echo "No se recibieron respuestas.";
                }
            } else {

                echo "No se recibieron respuestas.";
            }
        }


        break;

        ///////////////////////////////////////////////////////////////////////////////////

    case "listar_home_asesor_tecnico":
        $datos =  $solicitud->get_solicitud_limit_10_usuHomeAsesorTecnico($_SESSION["usuario_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["soit_numexpe"];
            $sub_array[] = $row["soli_numdocident"];
            $sub_array[] = $row["soli_nombre"] . " " . $row["soli_apep"] . " " . $row["soli_apem"];
            $sub_array[] = $row["esta_ruc"];
            $sub_array[] = $row["fecha_registro"];

            // Identificador único para cada fila
            $uniqueId = uniqid();
            $sub_array[] = '

                    <div class="boton-container">
                        <div class="btn-principal-container">
                            <button id="botonPrincipal_' . $uniqueId . '"  class="btn btn-outline-warning btn-icon" onclick="mostrarSubbotones(\'' . $uniqueId . '\')">
                                <div><i class="fa fa-edit"></i></div>
                            </button>
                        </div>

                        <div id="subbotones_' . $uniqueId . '" class="subbotones-container">
                            <a href="http://localhost/Defensa_Civil/view/UsuMntSolicitud/?soit_id=' . $row["soit_id"] . '" class="btn btn-secondary subboton">A1</a>
                            <a href="http://localhost/Defensa_Civil/view/UsuMntDetalle2/?soit_id=' . $row["soit_id"] . '&soit_funcion=' . $row["soit_funcion"] . '" class="btn btn-secondary subboton">A2</a>
                            <a href="http://localhost/Defensa_Civil/view/UsuMntDetalle3/?soit_id=' . $row["soit_id"] . '&soit_funcion=' . $row["soit_funcion"] . '" class="btn btn-secondary subboton">A3</a>
                            <a href="http://localhost/Defensa_Civil/view/UsuMntDetalle4/?soit_id=' . $row["soit_id"] . '" class="btn btn-secondary subboton">A4</a>
                        </div>
                    </div>';

            // $sub_array[] = '<button type="button" onClick="editar(' . $row["soit_id"] . ');"  id="' . $row["soit_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["soit_id"] . ');"  id="' . $row["soit_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';

            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "verificar_estado_solicitud":

        $datos =  $solicitud->get_estado_solicitud($_SESSION["usuario_id"]);
        $html = '';
        $valor = 0;

        // Accede al valor de soit_id desde el resultado
        $soit_id = $datos['soit_id'];
        $estado_se2 = $datos['estado_se2'];
        $estado_se3 = $datos['estado_se3'];
        $estado_se4 = $datos['estado_se4'];
        $funcion = $datos['soit_funcion'];

        if (!empty($soit_id) && empty($estado_se2) && empty($estado_se3) && empty($estado_se4)) {
            $_SESSION['opcionAnexo_1_idesx'] = $soit_id;
            $_SESSION['grupoFuncion'] =  $funcion;
            $valor = 2;
        }

        if (!empty($estado_se2) && !empty($soit_id) && empty($estado_se3) && empty($estado_se4)) {
            $_SESSION['opcionAnexo_2_idesx'] = $estado_se2;
            $_SESSION['opcionAnexo_1_idesx'] = $soit_id;
            $valor = 3;
        }

        if (!empty($estado_se3) && !empty($estado_se2) && !empty($soit_id) && empty($estado_se4)) {
            $_SESSION['opcionAnexo_3_idesx'] = $estado_se3;
            $_SESSION['opcionAnexo_2_idesx'] = $estado_se2;
            $_SESSION['opcionAnexo_1_idesx'] = $soit_id;
            $valor = 4;
        }

        if (!empty($estado_se4) && !empty($estado_se3) && !empty($estado_se2) && !empty($soit_id)) {
            $valor = 1;
            // // Eliminar todas las variables de sesión
            unset($_SESSION['opcionAnexo_3_idesx']);
            unset($_SESSION['opcionAnexo_2_idesx']);
            unset($_SESSION['opcionAnexo_1_idesx']);


            // // Destruir la sesión
            // session_destroy();
            // exit();
        }

        header('Content-Type: application/json');

        echo json_encode(['html' => $html, 'valor' => $valor]);

        break;


    case "visualizar_detalle_id_parte1":

        //DEBOLUCION DE LA TABLA DETALLE

        $soit_id = $_POST['soit_id'];
        $tipo_anexo = '2'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal
        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        // DEVOLUCION DEL ANEXO 2 tabla _TB
        $datos = $solicitud->get_anexo_02();
        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple']
        ];

        $htmlContenedor = ''; // Declarar la variable fuera del bucle
        $cont = 0;

        //  for ($i = 1; $i <= 8; $i++) {
        $i = $_POST["soit_funcion"];

        $array_salud = filtrarAnexo_2($datos, $i);
        $htmlArray = array();
        $html = '';

        $html .= '<input type="hidden" name="desoli_id" id="desoli_id" value="' . $datos_anexo1['desoli_id'] . '">';

        foreach ($array_salud as $row) {

            if (
                $row['aux_idesc'] == 1 || $row['aux_idesc'] == 10  ||  $row['aux_idesc'] == 15
                ||  $row['aux_idesc'] == 20 || $row['aux_idesc'] ==  25 ||  $row['aux_idesc'] == 29
                ||  $row['aux_idesc'] == 35 || $row['aux_idesc'] ==  42
            ) {
                $html .= '
                    <div class="form-row pb-4">
                        <h5 class="col-md-1">' .  $i . '</h5 >
                        <div class="col-md-9">
                            <h5 class="text-justify">' . $row['aux_desc1'] . ' </h5>
                            
                        </div>
                        <div class="col-md-2">
                            <div class="">
                              
                            </div>
                        </div>
                    </div>
                ';
            } else {

                $cont++;

                if (!empty($datos_anexo1) && isset($datos_anexo1['aux_idesc'])) {
                    $aux_idesc_array = $datos_anexo1['aux_idesc'];
                    $valores = explode(',', trim($aux_idesc_array, '{}'));

                    $html .= '<div class="form-row">';
                    $html .= '<div class="col-md-1">' . $i . '.'  . $cont . '</div>';
                    $html .= '<div class="col-md-9">';
                    $html .= '<p class="text-justify">' . $row['aux_desc1'] . ' </p>';
                    $html .= '</div>';
                    $html .= '<div class="col-md-2">';
                    $html .= '<div class="ckbox ml-3">';

                    $html .= '<label class="form-check-label " for="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']">                 
                            <input name="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" class="opcionAnexo_2_idesx_parte1 form-check-input m-0 ml-5" type="checkbox" value="1" ' . (in_array($row['aux_idesc'], $valores) ? 'checked' : '') . ' disabled>
                            <span>Si Cumple</span></label>';

                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                } else {
                    // Si no hay valores en $datos_tb_detalle, se puede agregar un mensaje o manejo de caso vacío
                    $html .= '<p>No hay datos disponibles.</p>';
                }
            }
        }

        $cont = 0;
        // Envolver todos los bloques en un contenedor y concatenar en cada iteración
        // $htmlContenedor .= '<div class="p-3" id="contenidoAnexo_2_' . $i . '" >' . implode('', $htmlArray) . '</div>';
        $htmlContenedor .= '<div class="p-3" id="parte_1_Anexo_02">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "visualizar_detalle_id_parte2":

        $soit_id = $_POST['soit_id'];

        $tipo_anexo = '2'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal

        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        $datos = $solicitud->get_anexo_02_aux_tipocod_9_aux_idesc_46_47_48();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple']
        ];

        $htmlContenedor = ''; // Declarar la variable fuera del bucle
        $cont = 0;

        $html = '';

        $html .= '<input type="hidden" name="desoli_id" id="desoli_id" value="' . $datos_anexo1['desoli_id'] . '">';

        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 46
            ) {
                // ingrese siempre cuando el $i = 0 
                $html .= '
                <hr>
                    <div class=" pb-3 text-center   font-weight-bold d-flex align-items-center justify-content-center">
                    <p class="">
                        ' . $row['aux_desc1'] . '
                    </p>
                </div>
                        ';
            } else {
                $cont++;

                if (!empty($datos_anexo1) && isset($datos_anexo1['aux_idesc'])) {

                    $aux_idesc_array = $datos_anexo1['aux_idesc'];
                    $valores = explode(',', trim($aux_idesc_array, '{}'));

                    $html .= '<div class="form-row">';
                    $html .= '<div class="col-md-1">' . $cont . '</div>';
                    $html .= '<div class="col-md-9">';
                    $html .= '<p class="text-justify">' . $row['aux_desc1'] . ' </p>';
                    $html .= '</div>';
                    $html .= '<div class="col-md-2">';
                    $html .= '<div class="ckbox ml-3">';

                    $html .= '<label class="form-check-label" for="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']">
                    <input name="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" id="opcionAnexo_2_idesx[' . $row['aux_idesc'] . ']" class="form-check-input ml-5" type="checkbox" value="1" ' . (in_array($row['aux_idesc'], $valores) ? 'checked' : '') . ' disabled>
                    <span>Si Cumple </span>
                    
                    </label>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                } else {
                    // Si no hay valores en $datos_tb_detalle, se puede agregar un mensaje o manejo de caso vacío
                    $html .= '<p>No hay datos disponibles.</p>';
                }
            }

            // Almacenar la respuesta HTML en el array

        }
        $cont = 0;

        // envolver el bloue e nun html
        $htmlContenedor .= '<div class="p-3" id="parte_2_Anexo_02">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;


    case "visualizar_solicitud_id_parte1":

        $soit_id = $_POST['soit_id'];
        $tipo_anexo = '2'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal
        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        $html = '';

        $htmlContenedor = '';

        $html .=
            '
            <input type="hidden" name="soit_id" id="soit_id" value="' . $datos_anexo1['soit_id'] . '">
            <input type="hidden" name="esta_id" id="esta_id" value="' . $datos_anexo1['esta_id']  . '">
            <input type="hidden" name="soli_id" id="soli_id" value="' . $datos_anexo1['soli_id']  . '">
            ';

        // START RADIO TIPO_ITSE
        $html .=  '
        <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >I.- INFORMACION GENERAL </h6>
        <hr>
        
        <div class=" text-center font-weight-bold">
            <p>I.1.- TIPO DE ITSE</p>
        </div>
        
        <div class= "d-flex flex-wrap align-items-center justify-content-between">';

        $datos_comp = $solicitud->get_componentes('1', '1');

        // TIPO DE ITSE
        foreach ($datos_comp as $row_comp) {

            $html .= '<div class=" ">
                 <label class="rdiobox" for="radio_itse' . $row_comp['comp_idesc'] . '">

                 <input class="" type="radio" name="grupoItse" id="radio_itse' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '" ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soit_tipoitse'])) ? 'checked' : '') . ' disabled>
                 <span>   ' . $row_comp['comp_desc'] . '   </span>            
                 
                 </label>
                 </div>';
        }

        $html .=  '</div>
        <hr>
        '; //END RADIO TIPO_ITSE

        // START TITULO FUNCION
        $html .= '<div class=" text-center font-weight-bold">
        <p>I.3.- FUNCION</p>
        </div>';  // END TITULO FUNCION

        // START RADIO FUNCION
        $html .= '<div class="d-flex flex-wrap align-items-center justify-content-between">';
        $datos_comp = $solicitud->get_componentes('2', 'G');

        foreach ($datos_comp as $row_comp) {

            $html .= '<div class="">
            <label class="rdiobox" for="radio_fun' . $row_comp['comp_idesc'] . '">   

            <input class="" type="radio" name="grupoFuncion" id="radio_fun' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '" ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soit_funcion'])) ? 'checked' : '') . ' disabled>
            <span class="mr-5">    ' . $row_comp['comp_desc'] . '     </span>
            
            </label>
          </div>';
        }
        $html .= '</div>
        <hr>';    // END RADIO FUNCION

        // START TITULO CLASIFICACION RIESGO
        $html .=  '<div class="text-center font-weight-bold">
        <p>I.4.- CLASIFICACIÓN DEL NIVEL DE RIESGO</p>
        </div>';  // END CLASIFICACION RIESGO

        // START RADIO CLASIFICACION RIESGO
        $html .= '<div class=" d-flex flex-wrap align-items-center justify-content-between">';

        $datos_comp = $solicitud->get_componentes('3', '1');

        foreach ($datos_comp as $row_comp) {
            $html .=
                '<div class="form-check  mb-2">
                    <label class="rdiobox" for="radio_riesgo' . $row_comp['comp_idesc'] . '">  
                    <input class="" style="margin-left: 5px;" type="radio" name="grupoRiesgo" id="radio_riesgo' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '" ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soit_clasiriesgo'])) ? 'checked' : '') . ' disabled>

                    <span class="mr-5">    ' . $row_comp['comp_desc'] . '     </span>

                    </label>
                </div>';
        }

        $html .=  '</div>  <hr>';    // END RADIO CLASIFICACION RIESGO

        //////////////////////////////////////////////////////////////

        $html .= '
        <!-- FECHA DE EXPEDIENTE-->
        
        <div class="">

            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="organoEjecu" class="form-label">ORGANO EJECUTANTE:</label>
                    <input type="text" class="form-control" id="organoEjecu" name="organoEjecu" value="' . $datos_anexo1['soit_organo'] . '" placeholder="Ingrese organo" disabled >
                </div>

                <div class="form-group col-md-3">
                    <label for="numeroExpediente" class="form-label">Nº EXPEDIENTE:</label>
                    <input type="number" class="form-control" id="numeroExpediente" name="numeroExpe" value="' . $datos_anexo1['soit_numexpe'] . '" placeholder="Ingrese expediente" required>
                </div>

                <div class="form-group col-md-3">
                    <label for="fechaDiliItse" class="form-label">FECHA DILIGENCIA ITSE:</label>
                    <input type="date" class="form-control" id="fechaDiliItse" name="fechaDiliItse" value="' . $datos_anexo1['soit_fechaproitse'] . '" >
                </div>

                <div class="form-group col-md-3">
                    <label for="fechaDiliEcse" class="form-label">FECHA DILIGENCIA ECSE:</label>
                    <input type="date" class="form-control" id="fechaDiliEcse" name="fechaDiliEcse"  value="' . $datos_anexo1['soit_fechaproecse'] . '">
                </div>

            </div>

        </div>   <hr>';

        /////////////////////////////////////////////////////////////////

        $html .= ' 
      
        <div id="datos_solicitante" class="datos_solicitante">
        
        <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >II.- DATOS DEL SOLICITANTE</h6>
        <hr>
        ';

        $html .=
            '<div class="">';

        $datos_comp = $solicitud->get_componentes('4', '1');

        foreach ($datos_comp as $row_comp) {
            $html .= '  
                <div class="form-check mb-2">
                    <label class="rdiobox" for="tipoSolicitante' . $row_comp['comp_idesc'] . '">
                    <input class=" ml-1" type="radio" name="tipoSolicitante" id="tipoSolicitante' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '"  ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soli_tipo'])) ? 'checked' : '') . '  require disabled>

                    <span class="mr-5">    ' . $row_comp['comp_desc'] . '     </span>
                    </label>
                </div>';
        }

        $html .=
            '</div>
            <hr>';

        /////////////////////////////////////////////////////////////////


        $html .=
            '<div class=" ">
                <div class="form-row">';

        $html .=
            '<div class="form-group col-md-4">
                            <label for="apepSoli" class="form-label">APELLIDOS:</label>
                            <div class="d-flex align-items-center">
                                <input type="text" name="apepSoli" class="form-control form-control " id="apepSoli" placeholder="Apellido Paterno" value="' . $datos_anexo1['soli_apep'] . '">
                                <input type="text" name="apemSoli" class="form-control form-control " id="apemSoli" placeholder="Apellido Materno" value="' . $datos_anexo1['soli_apem'] . '">
                            </div>
                        </div>';

        $html .=
            '<div class="form-group  col-md-4">
                        <label for="nombreSoli" class="form-label ">NOMBRE:</label>
                        <input type="text" name="nombreSoli" class="form-control " id="nombreSoli" placeholder="Ingrese su nombre" value="' . $datos_anexo1['soli_nombre'] . '">
                        </div>';

        $html .= '
                <div class="form-group col-md-4">
                    <p for="tipoDocSolicitante" class="form-label">TIPO DE DOCUMENTO</p>

                    <div class="row ">';

        $datos_comp = $solicitud->get_componentes('6', '1');

        foreach ($datos_comp as $row_comp) {
            $html .= '
                        <div class="col-md-4 ">
                            <div class="form-check ">
                                <label class="rdiobox" for="tipoDocSolicitante' . $row_comp['comp_idesc'] . '" >
                                <input class=" " type="radio" name="tipoDocSolicitante" id="tipoDocSolicitante' . $row_comp['comp_idesc'] . '" value="' . $row_comp['comp_idesc'] . '"  ' . (in_array($row_comp['comp_idesc'], array($datos_anexo1['soli_tipodoident'])) ? 'checked' : '') . ' disabled>

                                <span class="">' . $row_comp['comp_desc'] . '     </span>
                                
                                </label>
                            </div>
                        </div>';
        }

        $html .= '    
                    </div>
                </div>';


        $html .= '

                <div class="form-group col-md-4">

                    <label for="dniSoli" class="form-label ">DNI - C.E:</label>

                    <input type="number" style="font-size: 16px;" name="dniSoli" class="form-control" id="dniSoli" placeholder="Ingrese DNI" value="' . $datos_anexo1['soli_numdocident'] . '">

                </div>';

        $html .= '

                <div class="form-group col-md-4">
                    <label for="domicilioSoli" class="form-label">DOMICILIO:</label>

                    <input type="text" style="font-size: 16px;" name="domicilioSoli" class="form-control" id="domicilioSoli" placeholder="Ingrese domicilio" value="' . $datos_anexo1['soli_domocilio'] . '">

                </div>';


        $html .= '

                <div class="form-group col-md-4">

                    <label for="telefonoSoli" class="form-label ">TELEFONO</label>
                    <input type="number" style="font-size: 16px;" name="telefonoSoli" class="form-control " id="telefonoSoli" placeholder="Telefono" value="' . $datos_anexo1['soli_telefono'] . '">

                </div>';


        $html .= '
                <div class="form-group col-md-4">
                    <label for="emailSoli" class="form-label ">CORREO ELECTRONICO:</label>

                    <input type="email" style="font-size: 16px;" name="emailSoli" class="form-control " id="emailSoli" placeholder="Ingrese su correo electrónico" value="' . $datos_anexo1['soli_correo'] . '">

                </div>';

        $html .= '
                </div>';
        $html .=
            '</div>';

        $html .= '
        </div>
        <hr>';

        ///////////////////////////////////////////////////////////////////////////////

        $html .= ' 
        <div id="datos_objetos_inspeccion" class="datos_objetos_inspeccion">
        <h6 style="color: #31708f; border-bottom: 2px solid #31708f;"  >III.- DATOS DEL OBJETO DE INSPECCIÓN</h6>
        <hr>
         
            <div class="">

                <div class="form-row" id="infoAnexo1">';

        $html .= '
                    <div class="form-group  col-md-4">
                        <label for="razonSocial" class="form-label">RAZÓN SOCIAL:</label>

                        <input type="text" style="font-size: 16px;" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" value="' . $datos_anexo1['esta_razsocial'] . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ruc" class="form-label">RUC:</label>

                        <input type="text" style="font-size: 16px;" class="form-control " name="ruc" id="ruc" placeholder="RUC" value="' . $datos_anexo1['esta_ruc'] . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nombreComer" class="form-label">NOMBRE COMERCIAL:</label>

                        <input type="text" style="font-size: 16px;" class="form-control " name="nombreComer" id="nombreComer" placeholder="Nombre Comercial" value="' . $datos_anexo1['esta_nomcomer'] . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="telefonoComer" class="form-label ">TELEFONO</label>

                        <input type="number" style="font-size: 16px;" class="form-control " name="telefonoComer" id="telefonoComer" placeholder="Telefono" value="' . $datos_anexo1['esta_tel'] . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="direccionComer" class="form-label">DIRECCIÓN/UBICACIÓN:</label>

                        <input type="text" style="font-size: 16px;" class="form-control" name="direccionComer" id="direccionComer" placeholder="Dirección/Ubicación" value="' . $datos_anexo1['esta_direccion'] . '">

                    </div>

                    <div class="form-group col-md-4">
                        <label for="referenciaComer" class="form-label">REFERENCIA DE DIRECCION:</label>

                        <input type="text" style="font-size: 16px;" class="form-control" name="referenciaComer" id="referenciaComer" placeholder="Referencia de Direccion" value="' . $datos_anexo1['esta_referencia'] . '">

                    </div>

                    <div class="form-group col-md-4">
                        <label for="localidadComer" class="form-label">LOCALIDAD: </label>
                        <input type="text" style="font-size: 16px;" class="form-control" name="localidadComer" id="localidadComer" placeholder="Referencia de Localidad" value="' . $datos_anexo1['esta_localidad'] . '">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="horaAten" class="form-label">HORARIO DE ATENCIÓN:</label>
                        <input type="text" style="font-size: 16px;" name="horaAten" style="width: 100%;" class="form-control " id="horaAten" placeholder="Horario de Atención" value="' . $datos_anexo1['esta_horarioaten'] . '">
                    </div> 
                       

                    <div class="form-group col-md-4">
                        <label for="areaTotal" class="form-label">AREA OCUPADA TOTAL (M2):</label>
                        <input type="text" style="font-size: 16px;" step="any" name="areaTotal" style="width: 100%;" class="form-control" id="areaTotal"  value="' . $datos_anexo1['esta_areatotal'] . '"  placeholder="Area ocupada total">
                    </div>
     
                    <div class="form-group col-md-4">
                        <label for="numPisos" class="form-label">N° DE PISOS DEL EDIFICIO</label>
                        <input type="text" style="font-size: 16px;" name="numPisos" style="width: 100%;" class="form-control " id="numPisos"  value="' . $datos_anexo1['esta_numpisos'] . '"  placeholder="Número de pisos de la edificación">
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="pisoUbi" class="form-label">PISO OBJETO DE INSPECCION</label>
                        <input type="text" style="font-size: 16px;" name="pisoUbi" style="width: 100%;" class="form-control " id="pisoUbi"  value="' . $datos_anexo1['esta_pisoubi'] . '" placeholder="Piso objeto de inspeccion">
                    </div>';

        $html .= '
                </div>

            </div>

        </div>
        <hr>
        ';

        /////////////////////////////////////////////////////////////////////////////////////

        $htmlContenedor .= '<div class="" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);
        break;

    case "visualizar_solicitud_id_parte2":


        break;


    case "visualizar_detalle_anexo3":

        $datos = $solicitud->get_anexo_03_aux_tipocod_9_aux_idesc_49();

        $htmlContenedor = ''; // Declarar la variable fuera del bucle

        $html = '';

        $html .=
            '<div class="p-3" id="">
                        <div class="form-row p-3">
                    <div class="col-md-9">
                        <p class="text-justify"><b>' . $datos[0]['aux_desc1'] . '</b> <br>
                            ' . $datos[1]['aux_desc1'] . ':</p>
                    </div>
            <div class="col-md-3">';

        $soit_id = $_POST["soit_id"];
        $tipo_anexo = '3'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal
        $datos_anexo1 = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        $html .= '<input type="hidden" name="desoli_id" id="desoli_id" value="' . $datos_anexo1['desoli_id'] . '">';


        if (!empty($datos_anexo1) && isset($datos_anexo1['comp_idesc'])) {
            $aux_idesc_array = $datos_anexo1['comp_idesc'];
            $valor = explode(',', trim($aux_idesc_array, '{}'));

            $html .=  '<div class="form-col" style="margin-left: 110px;">
                                    <div>
                                        <label class="rdiobox" for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_1"  >
                                        <input type="radio" class="" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_1" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="1" style="margin-left: 32px;" ' . ($valor[0] == 1 ? ' checked' : '') . ' disabled>

                                        <span>  Bajo</span> 
                                        </label>
                                    </div>
                                </div>';

            $html .=  '<div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox"  for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_2"  >
                                <input  type="radio" class="" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_2" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="2" style="margin-left: 32px;" ' . ($valor[0] == 2 ? ' checked' : '') . ' disabled>

                                <span>  Medio</span> 
                                
                                </label>
                            </div>
                        </div>';

            $html .=  '<div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox"  for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_3"  >
                                 <input type="radio" class="" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_3" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="3" style="margin-left: 32px;" ' . ($valor[0] == 3 ? ' checked' : '') . ' disabled>

                                  <span>Alto</span>

                                </label>
                            </div>
                        </div>';


            $html .=  '<div class="form-col" style="margin-left: 110px;">
                            <div>
                                <label class="rdiobox" class="" for="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_4" >
                                <input  type="radio" class="" id="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']_4" name="opcionAnexo_3_idesx[' . $datos[1]['aux_idesc'] . ']" value="4" style="margin-left: 32px;" ' . ($valor[0] == 4 ? ' checked' : '') . ' disabled>
                                <span>Muy Alto</span> </label>
                            </div>
                        </div>';
        }

        $html .= '  </div>
                </div>
            </div>';

        $cont = 0;

        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');
        // Enviar una única respuesta JSON al cliente con el contenedor que envuelve todos los bloques HTML
        echo json_encode(['html' => $htmlContenedor]);

        break;

        //////////////////////////////////////// - ESPACIO- /////////////////////

    case "visualizar_anexo4_parte_1":

        $soit_id = $_POST["soit_id"];

        $tipo_anexo = '4'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal

        $datos = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        $htmlContenedor = ''; // Declarar la variable fuera del bucle

        $html = '';

        $html .= '<input type="hidden" name="decla_id" id="decla_id" value="' . $datos['decla_id'] . '">';
        $datos_comp = $solicitud->get_componentes('5', '4');


        if ($datos) {
            $html .= ' 
        

        <h5>ANEXO 4
        DECLARACIÓN JURADA DE CUMPLIMIENTO DE LAS CONDICIONES DE
        SEGURIDAD EN LA EDIFICACIÓN
        </h5>
        
        <div class="form-group p-3 ">

       <p>I.- Datos del Establecimiento Objeto de Inspección.
       
       </p>';

            foreach ($datos_comp as $row_comp) {

                $html .= ' 
                    <div class="row form-group pl-3">
                    <div class="">
                        <label class="ckbox">
                            <input type="checkbox" name="requiereLicencia" id="requiereLicencia' . $row_comp['comp_idesc'] . '" onclick="uncheckOther_licencia(this)"  value="' . $row_comp['comp_idesc'] . '" onclick="uncheckOther(this)"  ' . (in_array($row_comp['comp_idesc'], array($datos['decla_funciona'])) ? 'checked' : '') . '  disabled ><span>
                            ' . $row_comp['comp_desc'] . '   
                            </span>
                        </label>
                    </div>
                    </div>';
            }

            $html .= '<div>

           <div class="form-inline">
               <label for="capacidadEstablecimiento" class="mr-2">I.4.- La capacidad del establecimiento es de:</label>
               <input type="text" value="' . $datos["decla_capaci"] . '" name="capacidadEstablecimiento" class="form-control form-control-sm col-sm-1 mr-2 validar-numero-positivo" id="capacidadEstablecimiento" placeholder="N" disabled>
               <p class="mb-0">personas (aforo), cumpliendo con lo señalado en el Reglamento Nacional de Edificaciones RNE.</p>
           </div>

           <div class="form-inline">
               <label for="edificacionConstruida" class="mr-2">I.5.- La edificación fue construida hace</label>
               <input type="text" value="' . $datos["decla_edifianti"] . '"  name="edificacionConstruida" class="form-control form-control-sm col-sm-1 mr-2 validar-numero-positivo" id="edificacionConstruida" placeholder="N" disabled>
               <p class="mb-0">años.</p>
           </div>



       </div>

       <br>

       <div>

           <h6> I.6.- Declaro que mi Establecimiento Objeto de Inspección, tiene las siguientes áreas:</h6>


           <div class="container mt-4">

               <div class="mb-3 form-inline">
                   <label for="areaTerreno" class="form-label mr-5">Área de Terreno (m²): </label>
                   <input type="number" step="any" value="' . $datos["decla_areaterre"] . '"  name="areaTerreno" class="form-control form-control-sm col-sm-2 ml-4 " id="areaTerreno" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaTechadaPiso1" class="form-label mr-4">Área Techada por Piso 1 (m²): </label>
                   <input type="number" step="any" value="' . $datos["decla_areapiso1"] . '" name="areaTechadaPiso1" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso1" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaTechadaPiso2" class="form-label mr-4">Área Techada por Piso 2 (m²): </label>
                   <input type="number" step="any"  value="' . $datos["decla_areapiso2"] . '" name="areaTechadaPiso2" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso2" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaTechadaPiso3" class="form-label mr-4">Área Techada por Piso 3 (m²):</label>
                   <input type="number" step="any" value="' . $datos["decla_areapiso3"] . '"  name="areaTechadaPiso3" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso3" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaTechadaPiso4" class="form-label mr-4">Área Techada por Piso 4 (m²):</label>
                   <input type="number" step="any" value="' . $datos["decla_areapiso4"] . '" name="areaTechadaPiso4" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso4" disabled>
               </div>


               <div class="mb-3">
                   <label for="otrosPisos" class="form-label">Otros Pisos (m²):</label>
                   <input type="text" name="otrosPisos" value="' . $datos["decla_areaotrospisos"] . '" class="form-control form-control-sm col-sm-4 " id="otrosPisos" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaTechadaTotal" class="form-label mr-5">Área Techada Total (m²):</label>
                   <input type="number" step="any" value="' . $datos["decla_areatechatotal"] . '" name="areaTechadaTotal" class="form-control form-control-sm col-sm-2 " id="areaTechadaTotal" disabled>
               </div>

               <div class="mb-3 form-inline">
                   <label for="areaOcupadaTotal" class="form-label mr-5">Área Ocupada Total (m²):</label>
                   <input type="number" step="any" value="' . $datos["esta_areatotal"] . '" name="areaOcupadaTotal" class="form-control form-control-sm col-sm-2 " id="areaOcupadaTotal" readonly>
               </div>


           </div>


        </div>';


            $html .= '<div class=" p-3">
                        <table class="table table-bordered " width="100%">
                <thead>
                    <tr>

                        <th scope="col" class="wd-5p">N°</th>
                        <th scope="col">LA EDIFICACIÓN</th>
                        <th scope="col" class="wd-15p"></th>
                        <th scope="col" class="wd-20p"></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>No se encuentra en proceso de construcción según lo establecido en el artículo único de
                            la Norma G.040 Definiciones del Reglamento Nacional de Edificaciones</td>

                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi1" value="1" onclick="uncheckOther_edifi1(this)" ' . ($datos['decla_edifi1'] == 1 ? ' checked' : '') . ' disabled><span>Si Corresponde</span>
                            </label>

                        </td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi1" value="2" onclick="uncheckOther_edifi1(this)" ' . ($datos['decla_edifi1'] == 2 ? ' checked' : '') . ' disabled><span>No Corresponde</span>
                            </label>
                        </td>

                    </tr>
                    <tr>
                        <!--  -->
                        <th scope="row">2</th>
                        <td>Cuenta con servicios de agua, electricidad, y los que resulten esenciales para el
                            desarrollo de sus actividades, debidamente instalados e implementados.</td>

                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi2" value="1" onclick="uncheckOther_edifi2(this)" ' . ($datos['decla_edifi2'] == 1 ? ' checked' : '') . ' disabled><span>Si Corresponde</span>
                            </label>

                        </td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi2" value="2" onclick="uncheckOther_edifi2(this)" ' . ($datos['decla_edifi2'] == 2 ? ' checked' : '') . ' disabled><span>No Corresponde</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <!-- decla_edifi3 -->
                        <th scope="row">3</th>
                        <td>Cuenta con mobiliario básico e instalado para el desarrollo de la actividad.</td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi3" value="1" onclick="uncheckOther_edifi3(this)" ' . ($datos['decla_edifi3'] == 1 ? ' checked' : '') . ' disabled><span>Si Corresponde</span>
                            </label>

                        </td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi3" value="2" onclick="uncheckOther_edifi3(this)" ' . ($datos['decla_edifi3'] == 2 ? ' checked' : '') . ' disabled><span>No Corresponde</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <!--  -->
                        <th scope="row">4</th>
                        <td>Tiene los equipos o artefactos debidamente instalados o ubicados, respectivamente, en
                            los lugares de uso habitual o permanente.</td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi4" value="1" onclick="uncheckOther_edifi4(this)" ' . ($datos['decla_edifi4'] == 1 ? ' checked' : '') . ' disabled><span>Si Corresponde</span>
                            </label>

                        </td>
                        <td>
                            <label class="ckbox">
                                <input type="checkbox" name="decla_edifi4" value="2" onclick="uncheckOther_edifi4(this)" ' . ($datos['decla_edifi4'] == 2 ? ' checked' : '') . ' disabled><span>No Corresponde</span>
                            </label>
                        </td>
                    </tr>

                    <!-- Puedes agregar más filas según sea necesario -->
                </tbody>
                        </table>
                    </div> ';
        }

        $htmlContenedor .= '<div class="p-3" id="">' . $html . '</div>';

        header('Content-Type: application/json');

        echo json_encode(['html' => $htmlContenedor]);

        break;

    case "visualizar_anexo4_parte_2":

        $soit_id = $_POST["soit_id"];

        // $soit_id = $_POST["soit_id"];
        $tipo_anexo = '4'; /// opcional, el anexo 1 , no tiene detalle, tiene una tabla personal
        $datos_tb_detalle = $solicitud->obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $_SESSION["usuario_id"]);

        //////////////////////////////////////////////////
        $datos = $solicitud->get_anexo_04();

        $opciones = [
            ['id' => 1, 'nombre' => 'Si Cumple'],
            ['id' => 2, 'nombre' => 'No Corresponde']
        ];

        $cont = 0;
        $htmlContenedor =  '';
        $html = '';

        $html .= '<input type="hidden" name="desoli_id" id="desoli_id" value="' . $datos_tb_detalle['desoli_id'] . '">';

        foreach ($datos as $row) {

            if (
                $row['aux_idesc'] == 1  || $row['aux_idesc'] == 11  || $row['aux_idesc'] == 19 ||
                $row['aux_idesc'] == 34  || $row['aux_idesc'] == 38  || $row['aux_idesc'] == 42  ||
                $row['aux_idesc'] == 48 || $row['aux_idesc'] == 53  || $row['aux_idesc'] == 56  ||
                $row['aux_idesc'] == 58 || $row['aux_idesc'] == 61  || $row['aux_idesc'] == 63  || $row['aux_idesc'] == 67  ||
                $row['aux_idesc'] == 70 || $row['aux_idesc'] == 72  || $row['aux_idesc'] == 76  ||
                $row['aux_idesc'] == 79 || $row['aux_idesc'] == 98  || $row['aux_idesc'] == 101
            ) {

                if ($row['aux_idesc'] == 1) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE INCENDIO </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                if ($row['aux_idesc'] == 61) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> RIESGO DE COLAPSO
                                        des
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                if ($row['aux_idesc'] == 79) {
                    $cont = 0;
                    $html .= '
                                <div class="form-row border-top border-bottom">
                                    <div class="col-md-9">
                                        <p class="text-justify " style="font-size: 18px;font-weight: bold;"> OTROS RIESGOS VINCULADOS A LA ACTIVIDAD

                                        </p>
                                    </div>
                                </div>
                                <hr>
                            ';
                }

                $cont = 0;
                $html .= '
                <div class="form-row ">
                    <div class="col-md-9">
                        <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                    </div>
                    <div class="col-md-3 form-row">
                        
                    
                    </div>
                </div>
                <hr>
                        ';
            } else {

                if ($row['aux_idesc'] == 44) {
                    $html .= '
                    <div class="form-row">
                    <div class="col-md-0 mr-2">
                    <p class="text-justify"> </p>
                    </div>
                        <div class="col-md-9">
                            <p class="text-justify" style="font-size: 15px;font-weight: bold;">' . $row['aux_desc1'] . ' </p>
                        </div>
                        <div class="col-md-2 form-row">
                           
                       
                        </div>
                    </div>
                    <hr>
                ';
                } else {


                    $cont++;

                    $html .= '
    
                        <div class="form-row">
                            <div class="col-md-0 mr-2">
                                <p class="text-justify"> <b>' . $cont . '</b> </p>
                            </div>
                            <div class="col-md-10">
                                <p class="text-justify">' . $row['aux_desc1'] . ' </p>
                            </div>
                            <div class="col-md-6 form-row " > ';


                    if ($row['aux_idesc'] == 20) {
                        $html .= '     <div class="pb-3" style="width: 100%;display: flex;justify-content: center;">

                                <table border="1"   style="width: 80%" >
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Polvo Químico Seco - PQS</td>      
                                            <td><input class="form-control form-control-sm" value="' . $datos_tb_detalle['decla_pqs'] . '" type="text" name="pqs" id="pqs" readonly></td>
                           
                                        <tr>
                                            <td>Gas Carbónico – CO2</td>
                                            <td><input class="form-control form-control-sm" value="' . $datos_tb_detalle['decla_co2'] . '" type="text" name="co2" id="co2" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Acetato de Potasio</td>
                                            <td><input class="form-control form-control-sm" value="' . $datos_tb_detalle['decla_ack'] . '" type="text" name="ack" id="ack" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Agua Presurizada:</td>
                                            <td><input class="form-control form-control-sm" value="' . $datos_tb_detalle['decla_h2o'] . '" type="text" name="h2o" id="h2o" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Otros: </td>
                                            <td><input class="form-control form-control-sm" value="' . $datos_tb_detalle['decla_otrosquimi'] . '" type="text" name="otro_quimicos" id="otro_quimicos" readonly></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

                            </div>    ';
                    }



                    foreach ($opciones as $opcion) {
                        if (isset($datos_tb_detalle['comp_idesc']) && isset($datos_tb_detalle['aux_idesc'])) {
                            $aux_comp_array = $datos_tb_detalle['comp_idesc'];
                            $valores_comp = explode(',', trim($aux_comp_array, '{}'));
                            //
                            $aux_idesc_array = $datos_tb_detalle['aux_idesc'];
                            $valores_idesc = explode(',', trim($aux_idesc_array, '{}'));
                            //
                            if ($opcion['id'] == '1') {

                                $html .= '
                       
                                        <div class=" ml-5 ">
                                            <label class="ckbox" >
                                                <input type="checkbox" 
                                                 name="opcionAnexo_4_idesx[' . $row['aux_idesc'] . ']" value="' . $opcion['id'] . '"  ' . ((in_array($opcion['id'], $valores_comp) && in_array($row['aux_idesc'], $valores_idesc))  ? 'checked' : '') . ' disabled>
                                                <span> ' . $opcion['nombre'] . ' </span>
                                            </label>
                                        </div>
                                        ';
                            } else {

                                if ($opcion['id'] == '2') {
                                    $html .= '
                       
                                        <div class=" ml-5 " name="opcionAnexo_4_add[' . $row['aux_idesc'] . ']">
                                            <label class="ckbox" >
                                                <input type="checkbox"  value="' . $opcion['id'] . '"  ' . ((in_array($opcion['id'], ['2']) && in_array($row['aux_idesc'], $valores_idesc))  ? '' : 'checked') . ' disabled >
                                                <span> ' . $opcion['nombre'] . ' </span>
                                            </label>
                                        </div>
                                        ';
                                }
                            }
                        } else {
                        }
                    }

                    $html .=   ' </div>
                        </div>
                        <hr>';
                }
            }
        }

        $htmlContenedor .= '<div class="p-5" id="">' . $html . '</div>';

        header('Content-Type: application/json');

        echo json_encode(['html' => $htmlContenedor]);
        break;

    case "editar_detalle":

        break;
}




///////////////

// $aux_idesc_array = $datos_soit[0]['aux_idesc'];


/*------------- FILTRO ANEXO 2 ------------*/
function filtrarAnexo_2($categorias, $valor)
{
    return array_filter($categorias, function ($categoria) use ($valor) {
        return $categoria['aux_tipocod'] == $valor;
    });
}



// si escribo condigo de php fuera del swicth ni funciona
// $soit_id = '153';  // de forma estatica

// $datos_tb_detalle = $solicitud->get_anexo_detalle_id($soit_id, '3');

// if (!empty($datos_tb_detalle) && isset($datos_tb_detalle[0]['comp_id'])) {
//     $aux_idesc_array = $datos_tb_detalle[0]['comp_id'];
//     $valor = explode(',', trim($aux_idesc_array, '{}'));
//     echo  $valor[0];
// }


/*------------- FILTRO COMPONENTES ------------*/
function filtrarComponentes($categorias, $valor)
{
    return array_filter($categorias, function ($categoria) use ($valor) {
        return $categoria['comp_id'] == $valor;
    });
}

// $soit_id = 151;

// $datos_tb_detalle = $solicitud->get_anexo_detalle_4_id_soit_id($soit_id);


// if (!empty($datos_tb_detalle) && isset($datos_tb_detalle['comp_id'])) {
//     $aux_idesc_array = $datos_tb_detalle['comp_id'];
//     $valores = explode(',', trim($aux_idesc_array, '{}'));
//    print_r($valores);
// }

// $soit_id = '151'; // Obtén el valor de soit_id

// $datos_soit = $solicitud->get_anexo_detalle_id($soit_id, '2');
// $valor_caracter_varying = $datos_soit[0]['aux_idesc'];

// $grupoFuncion = '3'; // Obtén el valor de soit_id

// $datos_funcion = $solicitud->get_anexo_02_buscada($grupoFuncion);





// // Eliminar las llaves y dividir la cadena en un array usando la coma como delimitador
// $valores = explode(',', trim($valor_caracter_varying, '{}'));

// // Iterar sobre los valores
// foreach ($valores as $valor) {
//     echo $valor . "<br>"; // Puedes hacer algo con cada valor aquí
// }
