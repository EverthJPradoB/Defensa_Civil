$(document).ready(function () {
    anexo04_div();
    $("#detalle_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
        e.preventDefault();
        if (!validarSeleccionRequerimiento()) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor, seleccione el tipo de licencia',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        } else {
            if (!validarCamposPosotivos()) {
                // e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Ingrese los Datos Correcto.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                if (!validarTabla()) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Por favor, asegúrate de marcar todas las opciones en la tabla antes de continuar.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                } else {

                    if (!validarSeleccion()) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Por favor, seleccione al menos una opción de la lista para continuar.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }else{
                        guardar(e);

                    }
                }

            }
        }
    });

});

function anexo04_div() {

    console.log("anexo03");
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_04", { accion: 'mostrar_anexo_04' }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo04").html(data.html);

            $("input[name='opcionAnexo_4_idesx[20]']").on('change', function () {
                validarTablaQuimico();
            });

            // Llamar a validarTablaQuimico inicialmente
            disabledQuimico();
        
        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');


}

function guardar(e) {
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
                url: "../../controllers/solicitud.php?op=guardar_anexo04",
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
                        // confirmButtonText: 'Aceptar',
                        // timer: 2000,
                        // didClose: () => {
                        //     // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                        //     window.location.href = "http://localhost/Defensa_Civil/view/UsuHome/";
                        // }
                    });
                }
            });
        }
    });

}

function validarSeleccionRequerimiento() {
    var checkboxes = document.getElementsByName("requiereLicencia");
    var alMenosUnoSeleccionado = Array.from(checkboxes).some(checkbox => checkbox.checked);

    return alMenosUnoSeleccionado;
}

function validarSeleccion() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='opcionAnexo_4_idesx']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;
}


function validarTabla() {
    var checkboxes = $("input[type='checkbox'][name^='decla_edifi']");

    // Verificar que en cada fila solo haya un checkbox marcado
    var filasValidas = true;

    checkboxes.each(function (index, checkbox) {
        var filaCheckboxes = checkboxes.filter('[name="' + $(checkbox).attr('name') + '"]:checked');
        if (filaCheckboxes.length !== 1) {
            filasValidas = false;
            return false; // Terminar el bucle si se encuentra una fila inválida
        }
    });

    return filasValidas;
}




function validarCamposPosotivos() {
    var camposValidos = true;

    $(".validar-numero-positivo").each(function () {
        var input = $(this);

        // Obtener el valor del campo
        var valor = input.val();

        // Validar si el valor es un número entero y mayor o igual a cero
        if (!/^\d+$/.test(valor) || parseFloat(valor) < 0.0 || parseInt(valor) < 0) {
            camposValidos = false;
            return false;
        }
    });

    return camposValidos;
}

function validarTablaQuimico() {

    var inputQuimico = $("input[name='opcionAnexo_4_idesx[20]']");

    var inputQuimicoChecked = inputQuimico.is(":checked");

    if (inputQuimicoChecked) {
        enabledQuimico();
    } else {
        disabledQuimico();
    }

}

function enabledQuimico() {
    $("#pqs").prop('readonly', false);
    $("#co2").prop('readonly', false);
    $("#ack").prop('readonly', false);
    $("#h2o").prop('readonly', false);
    $("#otro_quimicos").prop('readonly', false);
}

function disabledQuimico() {
    $("#pqs").prop('readonly', true);
    $("#co2").prop('readonly', true);
    $("#ack").prop('readonly', true);
    $("#h2o").prop('readonly', true);
    $("#otro_quimicos").prop('readonly', true);
}