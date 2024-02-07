
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title>Página con Modal de Advertencia</title>
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="advertenciaModalLabel">¡Advertencia!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Esta es una advertencia importante. Asegúrate de leerla antes de continuar.</p>
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

<!-- Script para mostrar el modal al cargar la página -->
<script>
$(document).ready(function() {
  $('#advertenciaModal').modal('show');
});
</script>

</body>
</html>
