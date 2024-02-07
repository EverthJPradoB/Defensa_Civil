
//container_anexo03
$(document).ready(function () {

    var soit_id = getUrlParameter('soit_id');

    var soit_funcion = getUrlParameter('soit_funcion');

    anexo03(soit_id, soit_funcion);

    $("#detalle_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
        if (!validarSeleccion()) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Debes seleccionar al menos una opción.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        } else {
            guardar_detalle(e, soit_id);
        }

        // guardar_detalle(e);
    });

});

function anexo03(soit_id, soit_funcion) {

    $.post("../../controllers/solicitud.php?op=visualizar_detalle_anexo3", { soit_id: soit_id, soit_funcion: soit_funcion }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo03").html(data.html);

            configurarRadios_querySelectorAll("input[name^='opcionAnexo_3_idesx']");


        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');
}


function guardar_detalle(e, soit_id) {

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
                        // confirmButtonText: 'Aceptar',
                        timer: 2000,
                        didClose: () => {
                            // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuMntDetalle3/?soit_id=" + soit_id;
                        }
                    });
                }
            });
        }
    });

}

function habilitarEdicion() {

    let elementos = $("input[name^='opcionAnexo_3_idesx']");
    elementos.each(function (index, elemento) {
        $(elemento).prop('disabled', false); // Wrap elemento with $() to create a jQuery object
    });
    $('#contentBtnSubmit').show();

}

function validarSeleccion() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='opcionAnexo_3_idesx']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function configurarRadios_querySelectorAll(selector) {

    var radios = document.querySelectorAll(selector);

    // Encontrar el radio seleccionado actualmente
    var radioSeleccionado = Array.from(radios).find(radio => radio.checked);
    // Aplicar clase CSS al radio seleccionado
    var labelSeleccionado = radioSeleccionado ? obtenerLabelDelRadio(radioSeleccionado) : null;

    labelSeleccionado.classList.add('radio-seleccionado');

    console.log(radioSeleccionado);
    // Deshabilitar todos los radios excepto el seleccionado
    radios.forEach(function (radio) {
        radio.disabled = radio !== radioSeleccionado;
    });

}


function obtenerLabelDelRadio(radio) {
    if (radio) {
        var padre = radio.parentNode;
        while (padre) {
            if (padre.tagName === 'LABEL') {
                return padre;
            }
            padre = padre.parentNode;
        }
    }
    return null;
}