<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Página con Modales</title>
</head>

<body>

    <!-- Contenido de la página -->
    <div class="container mt-5">
        <h1>Bienvenido a mi página</h1>
        <!-- Otro contenido de la página -->
    </div>

    <!-- Modal de advertencia -->

    <div class="modal fade" id="advertenciaModal" tabindex="-1" aria-labelledby="advertenciaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-warning"> <!-- Agregar la clase bg-warning para el fondo amarillo -->
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="advertenciaModalLabel">¡Advertencia!</h5> <!-- Cambiar el color del texto a oscuro -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-dark">El proceso de la solicitud se encuentra en el Anexo <b>2</b>. ¡Por favor, completa la secuencia para continuar!</p>
                    <a href="http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/Anexo2.php">Click para continuar</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="exitoModal" tabindex="-1" aria-labelledby="exitoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-success"> <!-- Agregar la clase bg-success para el fondo verde -->
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exitoModalLabel">¡Éxito!</h5> <!-- Cambiar el color del texto a blanco -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-white">Operación completada con éxito.</p> <!-- Cambiar el color del texto a blanco -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Scripts para mostrar los modales al cargar la página -->
    <script>
        $(document).ready(function() {
            // Muestra el modal de advertencia
            $('#advertenciaModal').modal('show');

            // También puedes mostrar el modal de éxito después de un tiempo
            setTimeout(function() {
                $('#exitoModal').modal('show');
            }, 3000); // Muestra el modal de éxito después de 3 segundos (ajusta según tus necesidades)
        });
    </script>

</body>

</html>