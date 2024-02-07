<?php

require_once("../../config/conexion.php");

if (true) {

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
          
          .check-seleccionado {
                font-size: 18px;
                font-weight: bold;
                
            }

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

            button[type="submit"] {
                float: right;
                /* Mueve el botón a la derecha */
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


                    // si se ingresa el anexo 1 , recien se podra ingresar el anexo 2
                    if (

                        // isset($_SESSION["soit_id"])
                        true
                    ) { ?>

                        <!-- si se ingresa el anexo 1 , peor a un no se registra el anexo 2 -->

                        <?php if (
                            // !isset($_SESSION["opcionAnexo_2_idesx"])
                            true

                        ) { ?>
                            <form method="post" id="detalle_form">


                                <!-- <ul class="nav nav-tabs" id="myTabs">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" id="tab1Btn" onclick="showTab('tab1')">Anexo 2</button>
                                    </li>

                                </ul> -->

                                <div id="tab1" class="tab-content mt-0 active">

                                    <?php
                                    require_once("../html/solicitud/Detalles/detalleAnexo2/index.php");

                                    ?>


                                </div>

                                <div class="form-group" style="display: flex;justify-content: space-between;">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-warning" onclick="habilitarEdicion('enable')" id="editaInputsEnable">Habilitar Edición</button>
                                        <button type="button" class="btn btn-secondary" onclick="habilitarEdicion('disable')" id="editaInputsDisable">Desabilitar Edición</button>
                                    </div>

                                    <div id="contentBtnSubmit" style="display: none;">
                                        <button type="submit" class="btn btn-success" id="btnEnviar">Enviar</button>
                                    </div>

                                </div>
                            </form>

                        <?php  } else {   ?>

                            <!-- si se ingresa el anexo 1 , peor ya se registra el anexo 2 -->

                            <div class="alert alert-success" role="alert">
                                <h5 class="alert-heading">¡Proceso completado!</h5>
                                <p>Ya a sido Ingreado el Anexo 2 Correctamente</p>
                            </div>

                        <?php      }  ?>

                    <?php   } else {   ?>

                        <div class="alert alert-warning" role="alert">
                            <h5 class="alert-heading">¡Atención!</h5>
                            <p>Registre los Anteriores Anexos</p>
                        </div>

                    <?php    }  ?>


                </div>
            </div>

        </div>

        <?php
        require_once("../html/MainJs.php");
        ?>

        <script type="text/javascript" src="UsuMntDetalle2.js"></script>


    </body>

    </html>

<?php

} else {

    echo "Registre Primero el Anexo 1";
    //si no a iniciado session se redirecciona a la ventana principal
    // header("Location:" . Conectar::ruta() . "view/404/");
}

?>