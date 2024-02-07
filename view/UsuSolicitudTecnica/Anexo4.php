<?php

require_once("../../config/conexion.php");

if (isset($_SESSION["usuario_id"])) {
    // if (true) {
 
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

        <style>
            /* En tu archivo CSS */
            /* En tu archivo CSS */
            /* En tu archivo CSS */
            .overflow-column {
                max-width: 300px;
                /* Ajusta este valor según tus necesidades */
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }

            .multiline-cell {
                white-space: normal !important;
                word-wrap: break-word;
                text-align: justify;

            }

            form {
                color: black;

            }

            .border-top {
                border-top: 2px solid #000000;
            }

            .border-left {
                border-left: 2px solid #000000;
            }

            .border-right {
                border-right: 2px solid #000000;
            }

            .border-bottom {
                border-bottom: 2px solid #000000;
            }

            .border-bottom-left-right {
                border-bottom: 2px solid #000000;
                border-left: 2px solid #000000;
                border-right: 2px solid #000000;
            }

            .border-left-right {
                border-left: 2px solid #000000;
                border-right: 2px solid #000000;
            }

            .border-top-left-right {
                border-top: 2px solid #ff0000;
                border-left: 2px solid #ff0000;
                border-right: 2px solid #ff0000;
            }

            .border-total {
                border: 2px solid #000000;
            }


            /* Ajustes específicos para tu aplicación */
            .tab-content {
                display: none;
                margin-top: 20px;
            }

            .tab-content.active {
                display: block;
            }
        </style>

        <?php
        require_once("../html/MainMenu.php");
        ?>
        <?php
        require_once("../html/MainHeader.php");
        ?>

        <div class="br-mainpanel pb-5">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Inicio</a>

                </nav>
            </div>
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Inicio</h4>
                <p class="mg-b-0">Solicitud ITSEN</p>
            </div>

            <div class="br-pagebody mg-t-5 pd-x-30 table-responsive">

                <div class="card pd-0 bd-0 shadow-base">

                    <?php

                    if (
                        isset($_SESSION["opcionAnexo_1_idesx"]) &&  isset($_SESSION["opcionAnexo_2_idesx"]) &&
                        isset($_SESSION["opcionAnexo_3_idesx"])      
                    ) { ?>

                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="nav-item">
                                <button type="button" class="btn btn-primary active mr-1 " id="tab1Btn" onclick="showTab('tab1')">I.- INFORMACION PRINCIPAL </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="btn" id="tab2Btn" onclick="showTab('tab2')">II.- TABLA EDIFICACION</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="btn" id="tab3Btn" onclick="showTab('tab3')">III.- CUMPLIMIENTO DE CONDICIONES DE SEGURIDAD</button>
                            </li>
                        </ul>

                        <form id="detalle_form" method="post">

                            <div id="tab1" class="tab-content mt-0 active ">

                                <?php
                                require_once("../html/solicitud/Anexos/Anexo04/index.php");

                                ?>

                            </div>

                            <div id="tab2" class="tab-content mt-0">

                                <?php
                                require_once("../html/solicitud/Anexos/Anexo04/table.php");
                                ?>

                                <!-- <input type="submit" value="enviar"> -->
                            </div>

                            <div id="tab3" class="tab-content mt-0">

                                <?php
                                require_once("../html/solicitud/Detalles/detalleAnexo4/index.php");
                                ?>
                                <button type="submit" class="btn btn-primary float-right">Enviar</button>

                            </div>

                        </form>

                    <?php } else {     ?>

                        <div class="alert alert-warning" role="alert">
                            <h5 class="alert-heading">¡Atención!</h5>
                            <p>Registre los Anteriores Anexos</p>
                        </div>
                    <?php }   ?>

                </div>
            </div>

        </div>

        <?php
        require_once("../html/MainJs.php");
        ?>

        <script type="text/javascript" src="UsuSolicitudAnexo4.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- script tabs -->
        <script>
            function showTab(tabId) {
                // Oculta todas las pestañas
                const tabs = document.querySelectorAll('.tab-content');
                tabs.forEach(tab => tab.classList.remove('active'));

                // Desactiva todos los botones de pestañas
                const tabButtons = document.querySelectorAll('.nav-item button');
                tabButtons.forEach(button => {
                    button.classList.remove('active');
                    button.classList.remove('btn-primary');
                });

                // Muestra la pestaña seleccionada y activa el botón correspondiente
                const selectedTab = document.getElementById(tabId);
                const selectedTabButton = document.getElementById(tabId + 'Btn');
                if (selectedTab && selectedTabButton) {
                    selectedTab.classList.add('active');
                    selectedTabButton.classList.add('active', 'btn-primary');
                }
            }
        </script>


        <!-- script requiereLicencia -->
        <script>
            function uncheckOther(checkbox) {
                var checkboxes = document.getElementsByName(checkbox.name);

                checkboxes.forEach(function(currentCheckbox) {
                    if (currentCheckbox !== checkbox) {
                        currentCheckbox.checked = false;
                    }
                });
            }
        </script>



    </body>

    </html>

<?php

} else {

    //si no a iniciado session se redirecciona a la ventana principal
    header("Location:" . Conectar::ruta() . "view/404/");
}

?>