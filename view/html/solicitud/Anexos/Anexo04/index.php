<div class=" p-3">
    <h5>ANEXO 4
        DECLARACIÓN JURADA DE CUMPLIMIENTO DE LAS CONDICIONES DE
        SEGURIDAD EN LA EDIFICACIÓN
    </h5>

    <div class="form-group p-3 ">

        <p>I.- Datos del Establecimiento Objeto de Inspección.
        </p>

        <div class="row form-group pl-3">
            <div class="">
                <label class="ckbox">
                    <input type="checkbox" name="requiereLicencia" value="1" onclick="uncheckOther(this)"><span>Requiere Licencia de Funcionamiento</span>
                </label>
            </div>

            <div class="ml-5">
                <label class="ckbox">
                    <input type="checkbox" name="requiereLicencia" value="2" onclick="uncheckOther(this)"><span>No requiere Licencia de Funcionamiento</span>
                </label>
            </div>

        </div>

        <div>

            <div class="form-inline">
                <label for="capacidadEstablecimiento" class="mr-2">I.4.- La capacidad del establecimiento es de:</label>
                <input type="text" value="0" name="capacidadEstablecimiento" class="form-control form-control-sm col-sm-1 mr-2 validar-numero-positivo" id="capacidadEstablecimiento" placeholder="N">
                <p class="mb-0">personas (aforo), cumpliendo con lo señalado en el Reglamento Nacional de Edificaciones RNE.</p>
            </div>

            <div class="form-inline">
                <label for="edificacionConstruida" class="mr-2">I.5.- La edificación fue construida hace</label>
                <input type="text" value="0"  name="edificacionConstruida" class="form-control form-control-sm col-sm-1 mr-2 validar-numero-positivo" id="edificacionConstruida" placeholder="N">
                <p class="mb-0">años.</p>
            </div>

            <div class="form-inline">
                <label for="giroAntiguedad" class="mr-2">I.5.- El giro o actividad que se desarrolla en la edificación tiene una antigüedad de</label>
                <input type="text" value="0" name="giroAntiguedad" class="form-control form-control-sm col-sm-1 mr-2 validar-numero-positivo" id="giroAntiguedad" placeholder="N">
                <p class="mb-0">años.</p>
            </div>

        </div>

        <br>

        <div>

            <h6> I.6.- Declaro que mi Establecimiento Objeto de Inspección, tiene las siguientes áreas:</h6>


            <div class="container mt-4">

                <div class="mb-3 form-inline">
                    <label for="areaTerreno" class="form-label mr-5">Área de Terreno (m²): </label>
                    <input type="number" step="any" value="0.0" name="areaTerreno" class="form-control form-control-sm col-sm-2 ml-4 " id="areaTerreno">
                </div>

                <div class="mb-3 form-inline">
                    <label for="areaTechadaPiso1" class="form-label mr-4">Área Techada por Piso 1 (m²): </label>
                    <input type="number" step="any" value="0.0" name="areaTechadaPiso1" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso1">
                </div>

                <div class="mb-3 form-inline">
                    <label for="areaTechadaPiso2" class="form-label mr-4">Área Techada por Piso 2 (m²): </label>
                    <input type="number" step="any" value="0.0" name="areaTechadaPiso2" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso2">
                </div>

                <div class="mb-3 form-inline">
                    <label for="areaTechadaPiso3" class="form-label mr-4">Área Techada por Piso 3 (m²):</label>
                    <input type="number" step="any" value="0.0"name="areaTechadaPiso3" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso3">
                </div>

                <div class="mb-3 form-inline">
                    <label for="areaTechadaPiso4" class="form-label mr-4">Área Techada por Piso 4 (m²):</label>
                    <input type="number" step="any" value="0.0" name="areaTechadaPiso4" class="form-control form-control-sm col-sm-2 " id="areaTechadaPiso4">
                </div>


                <div class="mb-3">
                    <label for="otrosPisos" class="form-label">Otros Pisos (m²):</label>
                    <input type="text" name="otrosPisos" class="form-control form-control-sm col-sm-4 " id="otrosPisos">
                </div>

                <div class="mb-3 form-inline">
                    <label for="areaTechadaTotal" class="form-label mr-5">Área Techada Total (m²):</label>
                    <input type="number" step="any" value="0.0" name="areaTechadaTotal" class="form-control form-control-sm col-sm-2 " id="areaTechadaTotal">
                </div>

    

            </div>


        </div>

        <!-- <table class="table table-bordered " width="100%">
            <thead>
                <tr>

                    <th scope="col" class="wd-5p">N°</th>
                    <th scope="col">LA EDIFICACIÓN</th>
                    <th scope="col" class="wd-15p"></th>
                    <th scope="col" class="wd-15p"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>No se encuentra en proceso de construcción según lo establecido en el artículo único de
                        la Norma G.040 Definiciones del Reglamento Nacional de Edificaciones</td>
                    <td><label for=""> <input type="checkbox" name="" id="">si Cumple</label></td>
                    <td><label for=""> <input type="checkbox" name="" id="">No Cumple</label></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Cuenta con servicios de agua, electricidad, y los que resulten esenciales para el
                        desarrollo de sus actividades, debidamente instalados e implementados.</td>
                    <td><label for=""> <input type="checkbox" name="" id="">si Cumple</label></td>
                    <td><label for=""> <input type="checkbox" name="" id="">No Cumple</label></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Cuenta con mobiliario básico e instalado para el desarrollo de la actividad.</td>
                    <td><label for=""> <input type="checkbox" name="" id="">si Cumple</label></td>
                    <td><label for=""> <input type="checkbox" name="" id="">No Cumple</label></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Tiene los equipos o artefactos debidamente instalados o ubicados, respectivamente, en
                        los lugares de uso habitual o permanente.</td>
                    <td><label for=""> <input type="checkbox" name="" id="">si Cumple</label></td>
                    <td><label for=""> <input type="checkbox" name="" id="">No Cumple</label></td>
                </tr>

     
            </tbody>
        </table> -->

    </div>

</div>