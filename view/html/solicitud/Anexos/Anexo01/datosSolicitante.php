<!-- DATOS DEL SOLICITANTE-->
<div id="datos_solicitante" class="datos_solicitante">

    <!-- <div class=" p-2  text-center font-weight-bold" style="font-size: 15px;">II. DATOS DEL SOLICITANTE</div> -->
   
    <div class="p-2">

        <div class="form-check mb-2">
            <input class="form-check-input ml-1" type="radio" name="tipoSolicitante" id="propietario" value="1" require>
            <label class="form-check-label custom-radio-label" for="propietario">
                PROPIETARIO
            </label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input ml-1" type="radio" name="tipoSolicitante" id="repreLegal" value="2">
            <label class="form-check-label custom-radio-label" for="repreLegal">
                REPRESENTANTE LEGAL
            </label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input ml-1" type="radio" name="tipoSolicitante" id="conductorAdmin" value="3">
            <label class="form-check-label custom-radio-label" for="conductorAdmin">
                CONDUCTOR / ADMINISTRADOR
            </label>
        </div>

    </div>

    <div class=" p-3">


        <div class="form-row">



            <div class="form-group col-md-4">
                <label for="apepSoli" class="form-label">APELLIDOS:</label>
                <!-- <div class="col-md-8"> -->
                <div class="d-flex align-items-center">
                    <!-- class="form-control form-control-sm mr-2" -->
                    <input type="text" name="apepSoli" class="form-control form-control " id="apepSoli" placeholder="Apellido Paterno">
                    <input type="text" name="apemSoli" class="form-control form-control " id="apemSoli" placeholder="Apellido Materno">
                </div>
                <!-- </div> -->
            </div>

            <div class="form-group  col-md-4">
                <label for="nombreSoli" class="form-label ">NOMBRE:</label>
                <input type="text" name="nombreSoli" class="form-control " id="nombreSoli" placeholder="Ingrese su nombre">
            </div>


            <div class="form-group col-md-4">
                <p for="tipoDocSolicitante" class="form-label">TIPO DE DOCUMENTO</p>

                <div class="row ">
                    <div class="col-md-4 ">
                        <div class="form-check ">
                            <input class="form-check-input ml-1" type="radio" name="tipoDocSolicitante" id="tipoDocSolicitanteDNI" value="1" require>
                            <label class="form-check-label custom-radio-label" for="tipoDocSolicitanteDNI">DNI</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check ">
                            <input class="form-check-input ml-1" type="radio" name="tipoDocSolicitante" id="tipoDocSolicitanteCE" value="2">
                            <label class="form-check-label custom-radio-label" for="tipoDocSolicitanteCE">CARNET DE EXTRANJERIA</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="dniSoli" class="form-label ">DNI - C.E:</label>

                <input type="number" name="dniSoli" class="form-control" id="dniSoli" placeholder="Ingrese DNI" >

            </div>

            <div class="form-group col-md-4">
                <label for="domicilioSoli" class="form-label">DOMICILIO:</label>

                <input type="text" name="domicilioSoli" class="form-control" id="domicilioSoli" placeholder="Ingrese expediente" >

            </div>

            <div class="form-group col-md-4">
                <label for="telefonoSoli" class="form-label ">TELEFONO</label>
                <input type="number" name="telefonoSoli" class="form-control " id="telefonoSoli" placeholder="Telefono" >
            </div>

            <div class="form-group col-md-4">
                <label for="emailSoli" class="form-label ">CORREO ELECTRONICO:</label>

                <input type="email" name="emailSoli" class="form-control " id="emailSoli" placeholder="Ingrese su correo electrónico" >

            </div>

        </div>


    </div>
</div>