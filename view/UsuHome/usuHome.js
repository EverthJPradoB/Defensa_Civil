
// var usu_id = $('#usu_idx').val();

$(document).ready(function () {
    muestra_modal();
    // $.post("../../controllers/usuario.php?op=total", { usu_id: usu_id }, function (data) {
    //     data = JSON.parse(data);
    //     $('#lbltotal').html(data.total);
    //     console.log(data);
    // });



    $('#solicitud_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controllers/solicitud.php?op=listar_home_asesor_tecnico",
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });


});
function muestra_modal() {
    $.post("../../controllers/solicitud.php?op=verificar_estado_solicitud", { accion: 'verificar_estado_solicitud' }, function (data) {
        // Manejar la respuesta del servidor
        // alert(data);
        if (data.valor) {


            // Acceder al valor enviado desde el servidor
            var valorRecibido = data.valor;

            // alert(valorRecibido)

            // Condición para verificar el valor y pintar HTML específico
            if (valorRecibido == 2 || valorRecibido == 3 || valorRecibido == 4) {

                let tipo = "advertencia";
                let mensaje = "El proceso de la solicitud se encuentra en el Anexo <b>" + valorRecibido + "</b>. ¡Por favor, completa la secuencia para continuar!";
                let enlace = "http://localhost/Defensa_Civil/view/UsuSolicitudTecnica/Anexo" + valorRecibido + ".php";
                let modalHTML = generarModalAdvertencia(tipo, mensaje, enlace);


                // Inserta el HTML del nuevo modal al final del body
                document.body.insertAdjacentHTML('beforeend', modalHTML);

                // Muestra el nuevo modal
                $('#advertenciaModal').modal();

            }
        } else {
            // Manejar el caso en que no se reciba HTML
            alert("No se recibió valor del servidor.");
        }
    }, 'json');
}


function generarModalAdvertencia(tipo, mensaje, enlace) {
    return `

    <div class="modal fade" id="advertenciaModal" tabindex="-1" aria-labelledby="${tipo}ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-warning"> <!-- Agregar la clase bg-warning para el fondo amarillo -->
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="advertenciaModalLabel">¡Advertencia!</h5> <!-- Cambiar el color del texto a oscuro -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                        <p class="text-dark">${mensaje}</p>
                        <a href="${enlace}">Click para continuar</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>`;
}

function generarModalExito() {
    return `

    <div class="modal fade" id="exitoModal" tabindex="-1" aria-labelledby="exitoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-success"> <!-- Agregar la clase bg-success para el fondo verde -->
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exitoModalLabel">¡Éxito!</h5> <!-- Cambiar el color del texto a blanco -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p class="text-white">Operación completada con éxito.</p> <!-- Cambiar el color del texto a blanco -->
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>`;
}


function visualizar(soit_id) {
    $.post("../../controllers/curso.php?op=mostrar", { cur_id: cur_id }, function (data) {
        data = JSON.parse(data);
        $('#cur_id').val(data.cur_id);
  
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}