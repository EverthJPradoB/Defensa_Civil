<?php
require_once("../../config/conexion.php");

//if (isset($_SESSION["usu_id"])) {
if (isset($_SESSION["usuario_id"])) {

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <?php
        require_once("../html/MainHead.php");
        ?>

        <title>Empresa::Home</title>
    </head>

    <body>

        <?php
        require_once("../html/MainMenu.php");
        ?>
        <?php
        require_once("../html/MainHeader.php");
        ?>

        <style>
            .boton-container {
                position: relative;
            }

            .btn-principal-container {
                position: relative;
            }

            .subbotones-container {
                display: none;
                position: absolute;
                top: 100%;
                /* Mueve los subbotones justo debajo del botón principal */
                left: 0;
                background-color: #f9f9f9;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                border-radius: 5px;
                padding: 10px;
                z-index: 1;
                /* Asegura que los subbotones estén sobre el resto del contenido */
            }

            .subboton {
                display: block;
                padding: 5px 10px;
                margin-bottom: 5px;
                text-align: center;
                cursor: pointer;
            }
        </style>


        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Inicio</a>

                </nav>
            </div>
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Inicio</h4>
                <p class="mg-b-0">Dashboard</p>
            </div>

            <!-- Contenido del Proyecto -->
            <div class="br-pagebody mg-t-5 pd-x-30">
                <!-- Resumen e total de Cursos -->
                <div class="row row-sm">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-teal rounded overflow-hidden">
                            <div class="pd-25 d-flex align-items-center">
                                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Today's Visits</p>
                                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotal"></p>
                                    <span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- col-3 -->
                </div>

                <!-- Resumen top 10 de Cursos -->
                <div class="row row-sm mg-t-20">
                    <div class="col-12">
                        <div class="card pd-0 bd-0 shadow-base">
                            <div class="pd-x-30 pd-t-30 pd-b-15">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Top Ultimos Cursos</h6>
                                        <p class="mg-b-0">Aqui podra vizualizar los ultimos 10 registros</p>
                                    </div>

                                </div><!-- d-flex -->
                            </div>
                            <div class="pd-x-15 pd-b-15">

                                <div class="table-wrapper">
                                    <table id="solicitud_data" class="table display responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">Nº de expediente</th>
                                                <th class="wd-20p">DNI- CE</th>
                                                <th class="wd-15p">Nombre del representate</th>
                                                <th class="wd-15p">RUC N</th>
                                                <th class="wd-10p">Fecha de Registro</th>
                                                <th class="wd-10p"></th>
                                                <th class="wd-10p"></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- card -->
                    </div>
                </div>
            </div>
        </div>






        <?php
        require_once("../html/MainJs.php");
        ?>


        <script type="text/javascript" src="usuHome.js"></script>



        <script>
            function mostrarSubbotones(uniqueId) {
                var subbotones = document.getElementById("subbotones_" + uniqueId);
                subbotones.style.display = (subbotones.style.display === "block") ? "none" : "block";
            }

            function accionSubboton(numero) {
                alert("Se presionó el Subboton " + numero);
            }

            // Cerrar subbotones al hacer clic fuera de ellos
            document.addEventListener("click", function(event) {
                var subbotonesContainers = document.querySelectorAll(".subbotones-container");

                subbotonesContainers.forEach(function(subbotones) {
                    if (event.target.closest('.boton-container') === null) {
                        subbotones.style.display = "none";
                    }
                });
            });
        </script>

    </body>

    </html>
<?php
} else {

    //si no a iniciado session se redirecciona a la ventana principal
     header("Location:" . Conectar::ruta() . "view/404/");
}


?>