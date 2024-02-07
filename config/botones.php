<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón con Subbotones - Bootstrap</title>
    <!-- Incluye la biblioteca Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #subbotones {
            display: none;
            position: absolute;
            top: 40px; /* Puedes ajustar la posición según tus necesidades */
            left: 0;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            padding: 10px;
            z-index: 1; /* Asegura que los subbotones estén sobre el resto del contenido */
        }

        .subboton {
            display: block;
            padding: 5px 10px;
            margin-bottom: 5px;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="">
    <button id="botonPrincipal" class="btn btn-primary" onclick="mostrarSubbotones()"><div><i class="fa-brands fa-readme"></i></div></button>

    <div id="subbotones" class="p-2">
        <button class="btn btn-secondary subboton" onclick="accionSubboton(1)">A1</button>
        <button class="btn btn-secondary subboton" onclick="accionSubboton(2)">A2</button>
        <button class="btn btn-secondary subboton" onclick="accionSubboton(3)">A3</button>
        <button class="btn btn-secondary subboton" onclick="accionSubboton(4)">A4</button>
    </div>
</div>

<!-- Incluye la biblioteca Bootstrap JavaScript desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function mostrarSubbotones() {
        var subbotones = document.getElementById("subbotones");
        subbotones.style.display = (subbotones.style.display === "block") ? "none" : "block";
    }

    function accionSubboton(numero) {
        alert("Se presionó el Subboton " + numero);
    }

    // Cerrar subbotones al hacer clic fuera de ellos
    document.addEventListener("click", function(event) {
        var subbotones = document.getElementById("subbotones");
        var botonPrincipal = document.getElementById("botonPrincipal");

        if (event.target !== subbotones && event.target !== botonPrincipal) {
            subbotones.style.display = "none";
        }
    });
</script>
</body>
</html>
