$(document).ready(function () {
    // var soit_id = getUrlParameter('soit_id');

    tipo_anexo = '9';

    visualizar(tipo_anexo);

    visualizar_detalle_parte1(tipo_anexo);

    // visualizar_detalle_parte2(tipo_anexo);

    $("#solicitud_9_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box

        e.preventDefault();

        var grupoItse_insp  = "grupoItse_insp";

        if (!validarSeleccion_RadioInput(grupoItse_insp)) {

            Swal.fire({
                title: 'Incompleto!',
                text: 'SELECCIONE UN TIPO DE ITSE',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });

        } else {
            var fecha_insp = "fecha_insp";
            if (!validarFecha_HoraVacia(fecha_insp)) {

                Swal.fire({
                    title: 'Incompleto!',
                    text: 'INGRESE LA FECHA DE INSPECCION',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });

            } else {

                var hora_inicio = "hora_inicio";
                var hora_fin = "hora_fin";

                if (!validarFecha_HoraVacia(hora_inicio) || !validarFecha_HoraVacia(hora_fin)) {

                    Swal.fire({
                        title: 'Incompleto!',
                        text: 'INGRESE CORRECTAMENTE EL HORARIO DE INSPECCION',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });

                } else {
                    var claseCheckboxEspecifica_1 = "opcionAnexo_6A_1_idesx";

                    // if (!validar_lista_completa(claseCheckboxEspecifica_1)) {
                    //     // if (false) {
                    //     Swal.fire({
                    //         title: 'Incompleto!',
                    //         text: 'EVALUACIÓN DEL RIESGO Y CONDICIONES DE SEGURIDAD EN LA EDIFICACIÓN incompleto',
                    //         icon: 'error',
                    //         confirmButtonText: 'Aceptar'
                    //     });
                    // }
                    // else {

                        var claseCheckboxEspecifica_2 = "opcionAnexo_6A_2_idesx";

                        // if (!validar_lista_completa(claseCheckboxEspecifica_2)) {
                        //     // if (false) {
                        //     Swal.fire({
                        //         title: 'Incompleto!',
                        //         text: 'OBSERVACIÓN SUBSANABLE',
                        //         icon: 'error',
                        //         confirmButtonText: 'Aceptar'
                        //     });
                        // } else {
                            guardar_6_7_9(e);

                        //}
                  //  }
                }
            }
        }
    });

});

function visualizar(tipo_anexo) {

    $.post("../../controllers/solicitud.php?op=mostrar_anexo_06_07_09", { tipo_anexo: tipo_anexo }, function (data) {
        // Manejar la respuesta del servidor
        if (data.html) {

            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#anexo9_tipoItse").html(data.html);

            var content =
                '<label for="distritoComer" class="form-label">DISTRITO: </label>' +
                '<select class="form-control select2" style="width:100%" name="distritoComer" id="distritoComer" data-placeholder="Seleccione" disabled>' +
                '<option label="Seleccione"></option>' +
                '</select>';

            $("#div_form_distrito").append(content);
            //
            var content1 =
                '<label for="giroComer" class="form-label">GIRO O ACTIVIDAD QUE REALIZA:</label>' +
                '<select class="form-select select2 form-row" style="width:100%" name="giroComer[]" id="giroComer" data-placeholder="Seleccione" multiple disabled></select>';

            $("#div_form_giro").append(content1);

            $('#distritoComer').select2();
            $('#giroComer').select2();

            combo_distritos(169);
            combo_giros(169)

            // FUNCION
            configurarRadios('grupoFuncion');

            // SOLICITANTE
            configurarRadios('tipoSolicitante');

            color_white_input_readonly();

        } else {
            alert("No se recibió HTML del servidor.");
        }

    }, 'json');

}

function visualizar_detalle_parte1(tipo_anexo) {

    $.post("../../controllers/solicitud.php?op=mostrar_detalle_anexo_09_parte1", { tipo_anexo: tipo_anexo }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {

            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo09").html(data.html);

        } else {
            alert("No se recibió HTML del servidor.");
        }

    }, 'json');

}

function visualizar_detalle_parte2(tipo_anexo) {

    $.post("../../controllers/solicitud.php?op=mostrar_detalle_anexo_06_parte2", { tipo_anexo: tipo_anexo }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {

            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_detalle_anexo06_parte2").html(data.html);


        } else {
            alert("No se recibió HTML del servidor.");
        }

    }, 'json');

}

function combo_distritos(soit_id) {
    $.post("../../controllers/solicitud.php?op=combo_distrito_checked", { soit_id: soit_id }, function (data) {

        $('#distritoComer').html(data);
    });
}

function combo_giros(soit_id) {

    $.post("../../controllers/solicitud.php?op=combo_giro_checked", { soit_id: soit_id }, function (data) {

        $('#giroComer').html(data);
    });

}

function configurarRadios(nombreGrupo) {

    var radios = document.getElementsByName(nombreGrupo);

    // Encontrar el radio seleccionado actualmente
    var radioSeleccionado = Array.from(radios).find(radio => radio.checked);

    // Deshabilitar todos los radios excepto el seleccionado
    radios.forEach(function (radio) {
        radio.disabled = radio !== radioSeleccionado;
    });

}

function guardar_6_7_9(e) {

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
            var formData = new FormData($("#solicitud_6_form")[0]);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
            $.ajax({
                url: "../../controllers/solicitud.php?op=guardar_anexo_6_7_9",
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
                        // didClose: () => {
                        //     // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                        //     window.location.href = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/index.php";
                        // }
                    });
                }
            });
        }
    });

}

function color_white_input_readonly() {

    const inputs = document.querySelectorAll('input[readonly]');

    inputs.forEach(input => {
        input.style.backgroundColor = "white";
    });
}

function validar_lista_completa(claseCheckbox) {
    // var checkboxes = $(".opcionAnexo_6A_1_idesx");
    var checkboxes = $("." + claseCheckbox);

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

function validarSeleccion_RadioInput(Campo_id) {
    var checkboxes = document.getElementsByName(Campo_id);
    var alMenosUnoSeleccionado = Array.from(checkboxes).some(checkbox => checkbox.checked);

    return alMenosUnoSeleccionado;
}

function validarFecha_HoraVacia(campoId) {
    // Obtener el valor del campo de fecha
    var campo = document.getElementById(campoId);
    var valorCampo = campo.value;

    // Retornar true si el campo no está vacío, false si está vacío
    return valorCampo !== '';
}

