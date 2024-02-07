
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera los datos del formulario
    $resultados = [];

    foreach ($_POST['opcion'] as $categoriaId => $opcionSeleccionada) {
        $resultados[] = "Categoría ID: $categoriaId, Opción ID: $opcionSeleccionada";
    }

    // Imprime los resultados
    echo "Resultados:\n" . implode("\n", $resultados);
} else {
    // Si la solicitud no es POST, maneja el caso según tus necesidades
    echo "Error: Método de solicitud no válido.";
}