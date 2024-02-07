$(document).ready(function () {

    anexo02_parte_1();

    anexo02_parte_2();

    $("#detalle_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
        e.preventDefault();
        if (!validarSeleccion_general()) {
         
            Swal.fire({
                title: 'Error!',
                text: 'Debes seleccionar al menos una opción según el tipo de función.',
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
                guardar_detalle(e);
            }
            
        }

        // guardar_detalle(e);
    });

});

function anexo02_parte_1() {
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_02_parte_1", { accion: 'mostrar_anexo_02_parte_1' }, function (data) {

        if (data.html) {

            $("#container_anexo02_parte_1").html(data.html);

            // var checkboxes = $("input[name^='opcionAnexo_2_idesx']");
            // todos los los input tienen el class opcionAnexo_2_idesx_parte1
            // por eso se filtra a traves de este y no del name
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

            alert("No se recibió HTML del servidor.");

        }

    }, 'json');



}

function anexo02_parte_2() {


    $.post("../../controllers/solicitud.php?op=mostrar_anexo_02_parte_2", { accion: 'mostrar_anexo_02_parte_2' }, function (data) {


        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo02_parte_2").html(data.html);



        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');
}

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
function guardar_detalle(e) {

    // e.preventDefault();

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
            for (var pair of formData.entries()) {
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
                        text: 'Se Registró Correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                        didClose: () => {
                            // Este bloque de código se ejecutará cuando el temporizador del SweetAlert finalice
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/Anexo2.php";
                        }
                    });
                }
            });
        }
    });
    ////////////////////////////
    // e.preventDefault();
    // var formData = new FormData($("#detalle_form")[0]);

    // $.ajax({
    //     url: "../../controllers/solicitud.php?op=guardar_detalle",
    //     type: "POST",
    //     data: formData,
    //     contentType: false,
    //     processData: false,
    //     success: function (data) {

    //         Swal.fire({
    //             title: 'Correcto!',
    //             text: 'Se Registró Correctamente',
    //             icon: 'success',
    //             confirmButtonText: 'Aceptar'
    //         });

    //         //// limpia los inputs despues de enviar correctamente
    //         $("input[name^='opcionAnexo_2_idesx']").prop('checked', false);

    //     },

    // });
}

// -------------- ANEXO 02 ---------------  END


/*------------------------------------------------------------*/


// -------------- ANEXO 03 --------------- START



// -------------- ANEXO 03 ---------------  END


// select * from sc_gitse3.tb_solicitud_itse where soit_id > '50'

// select * from sc_gitse3.tb_solicitante where soli_id > '57'

// select * from sc_gitse3.tb_establecimiento where esta_id > '43'

// select * from sc_gitse3.tb_documento where soit_id > '3'