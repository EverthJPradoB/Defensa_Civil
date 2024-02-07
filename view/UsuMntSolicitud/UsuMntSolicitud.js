$(document).ready(function () {

    $('#giroComer').select2();

    var soit_id = getUrlParameter('soit_id');

    visualizar_parte1(soit_id);
    // visualizar_parte2(soit_id);

    let botonAbilitarEdicion = document.getElementById("editaInputsEnable");

    botonAbilitarEdicion.addEventListener("click", function (e) {
        enabled();
    });

    let botonDesabilitarEdicion = document.getElementById("editaInputsDisable");

    botonDesabilitarEdicion.addEventListener("click", function (e) {

        disabled();
    });

    $("#solicitud_form").on("submit", function (e) {
        guardar(e, soit_id);
    });

});

function visualizar_parte1(soit_id) {

    $.post("../../controllers/solicitud.php?op=visualizar_solicitud_id_parte1", { soit_id: soit_id }, function (data) {

        // Manejar la respuesta del servidor
        if (data.html) {

            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#infoGeneral").html(data.html);

            var content =
                '<div class="form-group col-md-4"  >' +
                '<label for="distritoComer" class="form-label">DISTRITO: </label>' +
                '<select class="form-control select2" style="width:100%" name="distritoComer" id="distritoComer" data-placeholder="Seleccione">' +
                '<option label="Seleccione"></option>' +
                '</select>' +
                '</div>';

            $("#infoAnexo1").append(content);

            var content1 =
                '<div class="form-group col-md-12">' +
                '<label for="giroComer" class="form-label">GIRO O ACTIVIDAD QUE REALIZA:</label>' +
                '<select class="form-select select2 form-row" style="width:100%" name="giroComer[]" id="giroComer" data-placeholder="Seleccione" multiple ></select>' +
                '</div>';

            $("#infoAnexo1").append(content1);

            $('#distritoComer').select2();

            $('#giroComer').select2();

            combo_distritos(soit_id);
            combo_giros(soit_id)
            disabled();

            color_white_input_readonly();

        } else {

            alert("No se recibió HTML del servidor.");

        }

    }, 'json');

}

function editar(soit_id) {

    $.post("../../controllers/solicitud.php?op=visualizar_solicitud_id_parte2", { soit_id: soit_id }, function (data) {
        // data ahora es un objeto JSON que contiene las claves y valores de tu solicitud

        console.log(data);
        // solicitud__anexo__
        $("#soit_id").val(data.soit_id);

        $("input[name='grupoItse'][value='" + data.soit_tipoitse + "']").prop({
            checked: true,
        });

        $("input[name='grupoFuncion'][value='" + data.soit_funcion + "']").prop({
            checked: true,
        });

        $("input[name='grupoRiesgo'][value='" + data.soit_clasiriesgo + "']").prop({
            checked: true,
        });

        $("#organoEjecu").val(data.soit_organo);

        $("#numeroExpediente").val(data.soit_numexpe);

        $("#fechaDiliItse").val(data.soit_fechaproitse).prop("readonly", true);

        $("#fechaDiliEcse").val(data.soit_fechaproecse).prop("readonly", true);


        // solicitante
        $("#soli_id").val(data.soli_id).prop("readonly", true);

        $("input[name='tipoSolicitante'][value='" + data.soli_tipo + "']").prop({
            checked: true,
            disabled: true
        });

        $("#apepSoli").val(data.soli_apep).prop("readonly", true);

        $("#apemSoli").val(data.soli_apem).prop("readonly", true);

        $("#nombreSoli").val(data.soli_nombre).prop("readonly", true);


        $("input[name='tipoDocSolicitante'][value='" + data.soli_tipodoident + "']").prop({
            checked: true,
            disabled: true
        });

        $("#dniSoli").val(data.soli_numdocident).prop("readonly", true);

        $("#domicilioSoli").val(data.soli_domocilio).prop("readonly", true);

        $("#telefonoSoli").val(data.soli_telefono).prop("readonly", true);

        $("#emailSoli").val(data.soli_correo).prop("readonly", true);


        // establecimiento
        $("#esta_id").val(data.esta_id).prop("readonly", true);

        $("#razonSocial").val(data.esta_razsocial).prop("readonly", true);

        $("#ruc").val(data.esta_ruc).prop("readonly", true);

        $("#nombreComer").val(data.esta_nomcomer).prop("readonly", true);

        $("#telefonoComer").val(data.esta_tel).prop("readonly", true);

        $("#direccionComer").val(data.esta_direccion).prop("readonly", true);

        $("#referenciaComer").val(data.esta_referencia).prop("readonly", true);

        $("#localidadComer").val(data.esta_localidad).prop("readonly", true);

        $("#horaAten").val(data.esta_horarioaten).prop("readonly", true);

        $("#horaAten").val(data.esta_horarioaten).prop("readonly", true);

        $("#distritoComer").val(data.ubig_id).trigger("change.select2");

        var cadenaOriginal = data.esta_giro;

        // Remover los corchetes y dividir por la coma
        var numerosArray = cadenaOriginal.slice(1, -1).split(',');

        // Convertir los elementos a números (si es necesario)
        numerosArray = numerosArray.map(function (numero) {
            return parseInt(numero, 10);
        });

        // Crear un nuevo array utilizando el constructor Array
        var miArray = new Array(...numerosArray);



        // Establecer el valor y activar el evento change
        $("#giroComer").val(miArray).trigger("change.select2");

    }, 'json');

}

function disabled() {

    $("#soit_id").prop("readonly", true);

    $("input[name='grupoItse']").prop({ disabled: true });

    $("input[name='grupoFuncion']").prop({ disabled: true });

    $("input[name='grupoRiesgo']").prop({ disabled: true });

    $("#organoEjecu").prop("readonly", true);

    $("#numeroExpediente").prop("readonly", true);

    ////////////////////////////////////////////////////


    $("#fechaDiliItse").prop("readonly", true);

    $("#fechaDiliEcse").prop("readonly", true);


    // solicitante
    $("#soli_id").prop("readonly", true);

    $("input[name='tipoSolicitante']").prop({
        disabled: true
    });

    $("#apepSoli").prop("readonly", true);

    $("#apemSoli").prop("readonly", true);

    $("#nombreSoli").prop("readonly", true);


    $("input[name='tipoDocSolicitante']").prop({
        disabled: true
    });

    $("#dniSoli").prop("readonly", true);

    $("#domicilioSoli").prop("readonly", true);

    $("#telefonoSoli").prop("readonly", true);

    $("#emailSoli").prop("readonly", true);


    // establecimiento
    $("#esta_id").prop("readonly", true);

    $("#razonSocial").prop("readonly", true);

    $("#ruc").prop("readonly", true);

    $("#nombreComer").prop("readonly", true);

    $("#telefonoComer").prop("readonly", true);

    $("#direccionComer").prop("readonly", true);

    $("#referenciaComer").prop("readonly", true);

    $("#localidadComer").prop("readonly", true);


    $("#areaTotal").prop("readonly", true);

    $("#numPisos").prop("readonly", true);

    $("#pisoUbi").prop("readonly", true);



    $("#horaAten").prop("readonly", true);

    $("#horaAten").prop("readonly", true);

    $("#distritoComer").prop("disabled", true);

    $("#giroComer").prop("disabled", true);

    $('#contentBtnSubmit').hide();

}

function enabled() {
    $("#soit_id").prop("readonly", false);

    $("input[name='grupoItse']").prop({ disabled: false });

    $("input[name='grupoFuncion']").prop({ disabled: false });

    $("input[name='grupoRiesgo']").prop({ disabled: false });

    $("#organoEjecu").prop("readonly", false);

    $("#numeroExpediente").prop("readonly", false);

    ////////////////////////////////////////////////////

    $("#fechaDiliItse").prop("readonly", false);

    $("#fechaDiliEcse").prop("readonly", false);

    // solicitante
    $("#soli_id").prop("readonly", false);

    $("input[name='tipoSolicitante']").prop({
        disabled: false
    });

    $("#apepSoli").prop("readonly", false);

    $("#apemSoli").prop("readonly", false);

    $("#nombreSoli").prop("readonly", false);

    $("input[name='tipoDocSolicitante']").prop({
        disabled: false
    });

    $("#dniSoli").prop("readonly", false);

    $("#domicilioSoli").prop("readonly", false);

    $("#telefonoSoli").prop("readonly", false);

    $("#emailSoli").prop("readonly", false);

    // establecimiento
    $("#esta_id").prop("readonly", false);

    $("#razonSocial").prop("readonly", false);

    $("#ruc").prop("readonly", false);

    $("#nombreComer").prop("readonly", false);

    $("#telefonoComer").prop("readonly", false);

    $("#direccionComer").prop("readonly", false);

    $("#referenciaComer").prop("readonly", false);

    $("#localidadComer").prop("readonly", false);

    $("#horaAten").prop("readonly", false);

    $("#horaAten").prop("readonly", false);
    //

    $("#areaTotal").prop("readonly", false);

    $("#numPisos").prop("readonly", false);

    $("#pisoUbi").prop("readonly", false);
    //


    $("#distritoComer").prop("disabled", false);

    $("#giroComer").prop("disabled", false);

    $('#contentBtnSubmit').show();
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

function habilitarEdicion() {
    // Habilitar la edición del campo de entrada con ID "ruc"
    $("#soli_id").prop("readonly", false);

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

function habilitarEdicion(accion) {
    if (accion === 'enable') {
        // Mostrar el botón "Enviar" cuando se habilita la edición
        $('#contentBtnSubmit').show();
    } else if (accion === 'disable') {
        // Ocultar el botón "Enviar" cuando se deshabilita la edición
        $('#contentBtnSubmit').hide();
    }
}

function guardar(e, soit_id) {
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
            var formData = new FormData($("#solicitud_form")[0]);

            var formDataObject = {};
            formData.forEach(function (value, key) {
                formDataObject[key] = value;
            });

            // Imprimir el objeto en la consola
            console.log(formDataObject);
            $.ajax({
                url: "../../controllers/solicitud.php?op=guardar",
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
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuMntSolicitud/?soit_id=" + soit_id;
                        }
                    });
                }
            });
        }
    });


    // e.preventDefault();
    // var formData = new FormData($("#solicitud_form")[0]);

    // $.ajax({
    //     url: "../../controllers/solicitud.php?op=guardar",
    //     type: "POST",
    //     data: formData,
    //     contentType: false,
    //     processData: false,
    //     success: function (data) {
    //         // Operación exitosa
    //         Swal.fire({
    //             title: 'Correcto!',
    //             text: 'Se Registró Correctamente',
    //             icon: 'success',
    //             confirmButtonText: 'Aceptar',
    //             timer: 2500
    //         });


    //     },

    // });
    // setTimeout(function () {
    //     window.location.href = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/index.php";
    // }, 2500); // 2000 milisegundos (2 segundos) de retraso, puedes ajustar según tus necesidades

}


function color_white_input_readonly() {

    const inputs = document.querySelectorAll('input[readonly]');

    inputs.forEach(input => {
        input.style.backgroundColor = "white";
    });
}