<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Inspector.php");
/*TODO: Inicializando Clase */

$inspector = new Inspector();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
        /*TODO: Guardar y editar cuando se tenga el ID */

        /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $instructor->get_instructor_id($_POST["inst_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["inst_id"] = $row["inst_id"];
                $output["inst_nom"] = $row["inst_nom"];
                $output["inst_apep"] = $row["inst_apep"];
                $output["inst_apem"] = $row["inst_apem"];
                $output["inst_correo"] = $row["inst_correo"];
                $output["inst_sex"] = $row["inst_sex"];
                $output["inst_telf"] = $row["inst_telf"];
            }
            echo json_encode($output);
        }
        break;
        /*TODO: Eliminar segun ID */
    case "eliminar":
        $instructor->delete_instructor($_POST["inst_id"]);
        break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $instructor->get_instructor();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["inst_nom"];
            $sub_array[] = $row["inst_apep"];
            $sub_array[] = $row["inst_apem"];
            $sub_array[] = $row["inst_correo"];
            $sub_array[] = $row["inst_telf"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["inst_id"] . ');"  id="' . $row["inst_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["inst_id"] . ');"  id="' . $row["inst_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "combo":
        $datos = $instructor->get_instructor();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['inst_id'] . "'>" . $row['inst_nom'] . " " . $row['inst_apep'] . " " . $row['inst_apem'] . "</option>";
            }
            echo $html;
        }
        break;


    case "listar_home_inpsector":

        $datos =  $inspector->get_solicitud_limit_10_inspSolicitudHome();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["soit_numexpe"];
            $sub_array[] = $row["soli_numdocident"];
            $sub_array[] = $row["soli_nombre"] . " " . $row["soli_apep"] . " " . $row["soli_apem"];
            $sub_array[] = $row["esta_ruc"];
            $sub_array[] = $row["fecha_registro"];
            $sub_array[] = '  
           
            <div class="btn-principal-container">
                <button id="botonPrincipal" class="btn btn-outline-warning btn-icon" onclick="mostrarSubbotones()">
                <div><i class="fa fa-edit"></i>              
                  <a href="http://localhost/Defensa_Civil/view/UsuMntSolicitud/?soit_id=' . $row["soit_id"] . '">A6</a>
                </div>
                </button>
            </div>


           

                ';

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


}
