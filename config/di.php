<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de SweetAlert con textarea en HTML</title>
    <!-- Incluye la biblioteca SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>




<script>
    // Código de SweetAlert
    Swal.fire({
        title: 'Ingrese una descripción: ¿Cuál es el motivo de la improcedencia?',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            style: 'height: 200px;' // Establece la altura del área de texto
        },
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (texto) => {
            // Aquí puedes realizar validaciones o procesar el texto ingresado
            // Por ejemplo, puedes enviarlo a través de una solicitud AJAX
            return new Promise((resolve) => {
                setTimeout(() => {
                    if (texto === 'texto inválido') {
                        Swal.showValidationMessage(
                            'Este texto no es válido'
                        )
                    }
                    resolve(texto); // Resuelve la promesa con el texto ingresado
                }, 1000)
            })
        },
        allowOutsideClick: false // Evita que el modal se cierre haciendo clic fuera de él
    }).then((result) => {
        if (result.isConfirmed) {
            const textoIngresado = result.value; // Obtiene el texto ingresado
            // Ahora puedes hacer lo que quieras con "textoIngresado"
            Swal.fire({
                title: 'Texto ingresado:',
                html: `Usted escribió: <strong>${textoIngresado}</strong>`
            });
            console.log("Texto ingresado:", textoIngresado);
        }
    });
</script>




<!-- <script>
    // Código de SweetAlert
    Swal.fire({
        title: 'Ingrese una descripción: ¿Cuál es el motivo de la improcedencia?',
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            style: 'height: 200px;' // Establece la altura del área de texto
        },
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: (texto) => {
            // Aquí puedes realizar validaciones o procesar el texto ingresado
            // Por ejemplo, puedes enviarlo a través de una solicitud AJAX
            return new Promise((resolve) => {
                setTimeout(() => {
                    if (texto === 'texto inválido') {
                        Swal.showValidationMessage(
                            'Este texto no es válido'
                        )
                    }
                    resolve(texto); // Resuelve la promesa con el texto ingresado
                }, 1000)
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            const textoIngresado = result.value; // Obtiene el texto ingresado
            // Ahora puedes hacer lo que quieras con "textoIngresado"
            Swal.fire({
                title: 'Texto ingresado:',
                html: `Usted escribió: <strong>${textoIngresado}</strong>`
            });
            console.log("Texto ingresado:", textoIngresado);
        }
    });
</script> -->


</body>

</html>