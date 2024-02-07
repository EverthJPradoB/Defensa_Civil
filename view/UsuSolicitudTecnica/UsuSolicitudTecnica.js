$(document).ready(function () {

    $('#distritoComer').select2();

    combo_distritos();

     $('#giroComer').select2();

    combo_giros();


    var inputs_text_Formulario = [
        "#organoEjecu", "#numeroExpediente", "#apepSoli",
        "#apemSoli", "#nombreSoli", "#dniSoli", "#domicilioSoli",
        "#telefonoSoli", "#emailSoli", "#razonSocial", "#ruc", "#nombreComer",
        "#telefonoComer", "#direccionComer", "#referenciaComer", "#localidadComer",
        "#areaTotal", "#numPisos" ,"#pisoUbi"

    ];

    var array_telefonos_Formulario = [
        "#telefonoSoli",
        "#telefonoComer"
    ];
    
    $("#solicitud_form").on("submit", function (e) {
        // validar que se a selecionado almenos un check box
 
        e.preventDefault();
        if (!validarFormulario_radio() || !validarFormulario_vacio(inputs_text_Formulario) ) {
            
            Swal.fire({
                title: 'Error!',
                text: 'Por favor, complete todos los campos requeridos',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });

        } else {

            if (!validarCorreoElectronico($("#emailSoli").val()) ) {
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor, Ingrese Correctamente el Correo Electronico',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });

            } else if (!validarFormulario_telefonos(array_telefonos_Formulario)) {
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Por favor, Los Numeros telefonicos Tienen 9 digitos',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });

            }else{
        
               guardar(e)
            
            }

        }

    });

});

function validarFormulario_radio() {
    
    if (!validarGupoFuncion()) {
        // Devuelve false si la condición específica no se cumple
        return false;
    }
    if (!validarGrupoItse()) {
        // Devuelve false si la condición específica no se cumple
        return false;
    }

    if (!validarGrupoRiesgo()) {
        // Devuelve false si la condición específica no se cumple
        return false;
    }

    if (!validarTipoRepresentante()) {
        // Devuelve false si la condición específica no se cumple
        return false;
    }
    if (!validarTipoDocSolicitante()) {
        // Devuelve false si la condición específica no se cumple
        return false;
    }

    return true;
}

function anexo03() {
    console.log("anexo03");
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_03", { accion: 'mostrar_anexo_03' }, function (data) {


        console.log("data: ".data);
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

function anexo04_div() {

    console.log("anexo03");
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_04", { accion: 'mostrar_anexo_04' }, function (data) {

        console.log("data: ".data);
        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo04").html(data.html);


            var inputs = document.querySelectorAll('input[name^="anexo_04_idesx["]');
            var selectedInput = document.querySelector('input[name^="anexo_04_idesx["]:checked');

            cont = 0;
            inputs.forEach(function (radio) {
                radio.addEventListener('change', function () {

                    // console.log(radio);

                    // // Verifica si la opción ya estaba seleccionada         
                    // if (cont == 1) {

                    //     radio.checked = false;
                    //     cont = 0;
                    // } else {

                    //     radio.checked = true;
                    //     cont = 1;
                    // }
                });
            });

        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }

    }, 'json');

}

// -------------- ANEXO 01 --------------- START
function combo_distritos() {
    $.post("../../controllers/solicitud.php?op=combo_distrito", function (data) {
        $('#distritoComer').html(data);
    });
}

function combo_giros() {
    $.post("../../controllers/solicitud.php?op=combo_giro", function (data) {

        $('#giroComer').html(data);
    });
}

function guardar(e) {

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

            console.log(formData);
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
                            window.location.href = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/index.php";
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

function anexo02_parte_1() {
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_02_parte_1", { accion: 'mostrar_anexo_02_parte_1' }, function (data) {


        console.log(data);
        // Manejar la respuesta del servidor
        if (data.html) {
            // Pegar el HTML directamente en el div con ID form_anexo_04
            $("#container_anexo02_parte_1").html(data.html);



        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió HTML del servidor.");
        }
    }, 'json');
}

function anexo02_parte_2() {

    console.log("anexo2_parte_2");
    $.post("../../controllers/solicitud.php?op=mostrar_anexo_02_parte_2", { accion: 'mostrar_anexo_02_parte_2' }, function (data) {


        console.log("data: ".data);
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

function validarSeleccion() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='opcionAnexo_2_idesx']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;
}

function guardar_detalle(e) {

    e.preventDefault();
    var formData = new FormData($("#detalle_form")[0]);

    $.ajax({
        url: "../../controllers/solicitud.php?op=guardar_detalle",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registró Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });

            //// limpia los inputs despues de enviar correctamente
            $("input[name^='opcionAnexo_2_idesx']").prop('checked', false);

        },

    });
}

////////////////////////////////// VALIDACIONES INPUT

function validarGupoFuncion() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='grupoFuncion']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;    
}
function validarGrupoItse() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='grupoItse']");

    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");

    return alMenosUnoSeleccionado;    
}
function validarGrupoRiesgo() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='grupoRiesgo']");
    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");
    return alMenosUnoSeleccionado;
}
function validarTipoRepresentante() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='tipoSolicitante']");
    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");
    return alMenosUnoSeleccionado;
}
function validarTipoDocSolicitante() {
    // Obtén todos los checkboxes con nombres que contienen "opcionAnexo_2_idesx"
    var checkboxes = $("input[name^='tipoDocSolicitante']");
    // Verifica si al menos uno está seleccionado
    var alMenosUnoSeleccionado = checkboxes.is(":checked");
    return alMenosUnoSeleccionado;
}

////////////////////////////////////

function validarCorreoElectronico(correo) {
    
    const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return emailRegex.test(correo);
}

function validarNumerosEnteros(valor) {

    let numString = valor.toString();
    // Utiliza la función isNaN para verificar si el valor no es un número
    return !isNaN(parseFloat(valor)) && isFinite(valor);
}

function validarTelefono(telefono) {
    // Implementar lógica de validación de teléfonos
    // Retorna true si es válido, false si no lo es
    return telefono.length === 9 && /^\d+$/.test(telefono);
}

// function verificarTodosInputsLlenos(inputs) {

//     // Itera sobre el array de inputs
//     for (var i = 0; i < inputs.length; i++) {
//         // Obtén el valor de cada input
//         var valorDelInput = $(inputs[i]).val();

//         // Verifica si el valor del input está vacío
//         if (!valorDelInput || valorDelInput.trim() === "") {
//             // Devuelve false si al menos uno de los inputs está vacío
//             return false;
//         }
//     }

//    return true;

// }

function validarFormulario_vacio(inputs) {

    for (var i = 0; i < inputs.length; i++) {
        // Obtén el valor de cada input
        var valorDelInput = $(inputs[i]).val();

        // Verifica si el valor del input está vacío
        if (!valorDelInput || valorDelInput.trim() === "") {
            // Devuelve false si al menos uno de los inputs está vacío
            return false;
        }
      
    }
    // Si no se encontraron problemas, devuelve true
    return true;
}

function validarFormulario_telefonos(inputs) {

    for (var i = 0; i < inputs.length; i++) {
        // Obtén el valor de cada input
        var valorDelInput = $(inputs[i]).val();
            if (!validarTelefono(valorDelInput)) {
                return false;       
        }   
    }
    // Si no se encontraron problemas, devuelve true
    return true;
}



//   // Si el input es de tipo correo, verifica también el formato
//   if ($(inputs[i]).attr('type') === 'email') {
//     if (!validarCorreoElectronico(valorDelInput)) {
//         // Devuelve false si el formato del correo electrónico no es válido
//         return false;
//     }
// }

//     // numero de expediente
//     if ($(inputs[i]).attr('type') === 'number') {
//         if (!validarNumerosEnteros(valorDelInput)) {
//             return false;
//         }
        
//         //validar ue los telefonos tengan numero de 9 digitos


//     }
