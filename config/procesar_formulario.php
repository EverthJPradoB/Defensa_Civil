<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['grupoInput']) && is_array($_POST['grupoInput'])) { 
        // Itera a través de las respuestas
        foreach ($_POST['grupoInput'] as $opcion_id) {
            // Verifica si la respuesta está marcada antes de procesar
            if (!empty($opcion_id)) {
                // Hacer algo con la opción seleccionada, por ejemplo, imprimirlo
                $variable = htmlspecialchars($opcion_id);
                echo "Opción seleccionada: " . $variable . "<br>";
            }
        }
    }
}

?>
