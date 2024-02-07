$(document).ready(function () {

    var soit_id = getUrlParameter('soit_id');

    var soit_funcion = getUrlParameter('soit_funcion');

    anexo02_parte_1(soit_id, soit_funcion);

    // anexo02_parte_2(soit_id, soit_funcion);

    $("#detalle_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
        e.preventDefault();
        if (!validarSeleccion_general()) {
            // e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Por favor, seleccione los campos respectivos.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        } else {

            if (!validarSeleccion_funcion()) {
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor, seleccione una función antes de continuar.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });

            } else {

                editar_detalle(e, soit_id, soit_funcion);

            }
        }
    });

});

function anexo02_parte_1(soit_id, soit_funcion) {

    $.post("../../controllers/solicitud.php?op=visualizar_detalle_id_parte1", { soit_id: soit_id, soit_funcion: soit_funcion }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo02_parte_1").html(data.html);

            /// PERMITIR QUE SOLO UN CHECK-BOX DE LAS FUNCIONES SEA SELECCIONADA
            var radioCheckboxes = $(".opcionAnexo_2_idesx_parte1");
            radioCheckboxes.each(function (index, checkbox) {
                $(checkbox).on('change', function () {
                    // Desmarca todos los demás checkboxes dentro del grupo
                    radioCheckboxes.each(function (otherIndex, otherCheckbox) {
                        if (otherCheckbox !== checkbox) {
                            $(otherCheckbox).prop('checked', false);
                        }
                    });
                });
            });

        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');

    $.post("../../controllers/solicitud.php?op=visualizar_detalle_id_parte2", { soit_id: soit_id, soit_funcion: soit_funcion }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo02_parte_2").html(data.html);

            configurarRadios_querySelectorAll("input[name^='opcionAnexo_2_idesx']");


        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');

}

function editar_detalle(e, soit_id, soit_funcion) {

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

            // Obtener todas las entradas en FormData
            var formDataEntries = formData.entries();

            // Iterar a través de las entradas e imprimir en la consola
            for (var pair of formDataEntries) {
                console.log(pair[0] + ', ' + pair[1]);
            }

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
                        text: 'Se Actualizo Correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                        didClose: () => {
                            // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuMntDetalle2/?soit_id=" + soit_id + "&soit_funcion=" + soit_funcion;
                        }
                    });
                }
            });
        }
    });
}


function habilitarEdicion(tipo) {

    if (tipo == 'enable') {
        let elementos = $("input[name^='opcionAnexo_2_idesx']");
        elementos.each(function (index, elemento) {
            $(elemento).prop('disabled', false); // Wrap elemento with $() to create a jQuery object
        });
        $('#contentBtnSubmit').show();
    } else if (tipo == 'disable') {
        let elementos = $("input[name^='opcionAnexo_2_idesx']");
        elementos.each(function (index, elemento) {
            $(elemento).prop('disabled', true); // Wrap elemento with $() to create a jQuery object
        });
        $('#contentBtnSubmit').hide();

    } else {
        alert("No Manipule el documeto")
    }

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

///
function validarSeleccion_general() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='opcionAnexo_2_idesx']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;
}

// que una FUNCION sea selecionada obligatoriamente
function validarSeleccion_funcion() {
    var radioCheckboxes = $(".opcionAnexo_2_idesx_parte1");

    // Verificar si al menos uno está seleccionado
    return radioCheckboxes.is(":checked");

}

/////////////////////////////////////

function configurarRadios_querySelectorAll(selector) {

    var checkboxes = document.querySelectorAll(selector);

    // Encontrar todos los checkboxes seleccionados actualmente
    var checkboxesSeleccionados = Array.from(checkboxes).filter(checkbox => checkbox.checked);

    // Aplicar clase CSS a los checkboxes seleccionados
    checkboxesSeleccionados.forEach(function (checkbox) {

        var labelSeleccionado = obtenerLabelDelCheckbox(checkbox);
        if (labelSeleccionado) {

            labelSeleccionado.classList.add('check-seleccionado');
            // checkbox.disabled = true;
        }
    });

    // Deshabilitar todos los checkboxes excepto los seleccionados
    // checkboxes.forEach(function (checkbox) {
    //     checkbox.disabled = !checkboxesSeleccionados.includes(checkbox);
    // });

}

function obtenerLabelDelCheckbox(radio) {
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