
//container_anexo03
$(document).ready(function () {

    anexo03();

    $("#detalle_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
        if (!validarSeleccion()) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Debe seleccionar una opción.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        } else {
            guardar_detalle(e);
        }

        // guardar_detalle(e);
    });

});

function anexo03() {
    console.log("anexo03");
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_03", { accion: 'mostrar_anexo_03' }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo03").html(data.html);
        
           
        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');
}


function guardar_detalle(e) {
    e.preventDefault();

    Swal.fire({
        title: "¿Está seguro de enviar los datos?",
        text: "Por favor, verifique la información por seguridad.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData($("#detalle_form")[0]);

            console.log(formData);
            $.ajax({
                url: "../../controllers/solicitud.php?op=guardar_detalle",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // Operación exitosa
                    Swal.fire({
                        title: 'Correcto!',
                        text: 'Se Registró Correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                        didClose: () => {
                            // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/Anexo3.php";
                        }
                    });
                }
            });
        }
    });

}

function validarSeleccion() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='opcionAnexo_3_idesx']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;
}
