<?php
// ... otras partes de tu código PHP ...

function informe()
{

  // START TITULO INFO_GENERAL
  echo '<div class=" text-center font-weight-bold">';
  echo '<p></p>';
  echo '</div>';  // END TITULO INFO_GENERAL
  echo '<br>';
  echo '<div  class= "" >';
  // START TITULO TIPO_ITSE
  echo ' <div class=" text-center font-weight-bold">';
  echo ' <p>I.1.- TIPO DE ITSE</p>';
  echo '</div>'; // END TITULO TIPO_ITSE

  // START RADIO TIPO_ITSE
  echo '<div class="p-2 d-flex flex-wrap align-items-center justify-content-between">';

  tipoItse(1); // contenido_tipo_itse

  echo '</div>'; //END RADIO TIPO_ITSE

  echo '<hr>';

  // START TITULO FUNCION
  echo '<div class=" p-2 text-center font-weight-bold">';
  echo '<p>I.3.- FUNCION</p>';
  echo ' </div>';  // END TITULO FUNCION


  // START RADIO FUNCION
  echo '<div class=" p-2 d-flex flex-wrap align-items-center justify-content-between">';
  tipoFuncion(1);
  echo '</div>';    // END RADIO FUNCION

  echo '<hr>';

  // START TITULO CLASIFICACION RIESGO
  echo '<div class=" p-2 text-center font-weight-bold">';
  echo '<p>I.4.- CLASIFICACIÓN DEL NIVEL DE RIESGO</p>';
  echo ' </div>';  // END CLASIFICACION RIESGO

  // START RADIO CLASIFICACION RIESGO
  echo '<div class=" p-2 d-flex flex-wrap align-items-center justify-content-between">';
  clasiRiesgo();
  echo '</div>';    // END RADIO CLASIFICACION RIESGO

  echo ' <br>';

  organo_numexpe_fecha_hinicio_hfin();

  echo '</div>';

}

function tipoItse($a)
{

  if ($a == 1) {
    echo '   <div class="form-check mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse1" value="1" >';
    echo '       <label class="form-check-label custom-radio-label " for="radio_itse1">';
    echo '         ITSE POSTERIOR AL INICIO DE ACTIVIDADE';
    echo '       </label>';
    echo '   </div>';

    echo '   <div class="form-check  form-check-inline  mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse2" value="2" >';
    echo '       <label class="form-check-label custom-radio-label" for="radio_itse2">';
    echo '      ITSE PREVIA AL INICIO DE ACTIVIDADES';
    echo '       </label>';
    echo '   </div>';

    echo '   <div class="form-check mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse5" value="3">';
    echo '       <label class="form-check-label custom-radio-label " for="radio_itse5">';
    echo '         ITSE POSTERIOR';
    echo '       </label>';
    echo '   </div>';

    echo '   <div class="form-check mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse6" value="4">';
    echo '       <label class="form-check-label custom-radio-label" for="radio_itse6">';
    echo '           ITSE PREVIA';
    echo '       </label>';
    echo '   </div>';

    echo '   <div class="form-check mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse3" value="5">';
    echo '       <label class="form-check-label custom-radio-label " for="radio_itse3">';
    echo '           ECSE HASTA 3000 PERSONAS';
    echo '       </label>';
    echo '   </div>';

    echo '   <div class="form-check mb-2">';
    echo '       <input class="form-check-input ml-1" type="radio" name="grupoItse" id="radio_itse4" value="6">';
    echo '       <label class="form-check-label custom-radio-label" for="radio_itse4">';
    echo '           ECSE MAYOR A 3000 PERSONAS';
    echo '       </label>';
    echo '   </div>';
  }

  if ($a == 2) {
  }

  if ($a == 3) {
  }
}

function tipoFuncion($f)
{

  if ($f = 1) {

    echo '<div class="form-check mb-2">
    <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun1" value="1">
    <label class="form-check-label" for="radio_fun1">ALMACEN</label>
  </div>';


    echo '<div class="form-check  mb-2">
  <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun2" value="2">
  <label class="form-check-label" for="radio_fun2">COMERCION</label>
</div>';

    echo '<div class="form-check  mb-2">
<input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun3" value="3">
<label class="form-check-label" for="radio_fun3">EDUCACION</label>
</div>';

    echo '<div class="form-check mb-2">
<input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun4" value="4">
<label class="form-check-label" for="radio_fun4">ENCUENTRO</label>
</div>';

    echo '<div class="form-check mb-2">
<input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun5" value="5">
<label class="form-check-label" for="radio_fun5">HOSPEDAJE</label>
</div>';

    echo '<div class="form-check  mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun6" value="6">
        <label class="form-check-label" for="radio_fun6">INDUSTRIAL</label>
      </div>';

    echo '<div class="form-check  mb-2">
      <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun7" value="7">
      <label class="form-check-label" for="radio_fun7">OFICINAS ADMINISTRATIVAS</label>
    </div>';

    echo '<div class="form-check  mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoFuncion" id="radio_fun8" value="8" >
        <label class="form-check-label" for="radio_fun8">SALUD</label>
      </div>';
  }

  // if ($f) {
  //     # code...
  // }

  // if ($f) {
  //     # code...
  // }

}


function clasiRiesgo()
{

  echo '<div class="form-check  mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoRiesgo" id="radio_riesgo1" value="1" >
        <label class="form-check-label" for="radio_riesgo1">ITSE Riesgo bajo</label>
      </div>';

  echo '<div class="form-check  mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoRiesgo" id="radio_riesgo2" value="2">
        <label class="form-check-label" for="radio_riesgo2">ITSE Riesgo medio</label>
      </div>';

  echo '<div class="form-check mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoRiesgo" id="radio_riesgo3" value="3">
        <label class="form-check-label" for="radio_riesgo3">ITSE Riesgo alto</label>
      </div>';

  echo '<div class="form-check  mb-2">
        <input class="form-check-input" style="margin-left: 5px;" type="radio" name="grupoRiesgo" id="radio_riesgo4" value="4">
        <label class="form-check-label" for="radio_riesgo4">ITSE Riesgo muy alto</label>
      </div>';
}

function organo_numexpe_fecha_hinicio_hfin()
{



  echo '
<!-- FECHA DE EXPEDIENTE-->
<div class=" p-2">
    <div class="form-row">
';
  echo '   
<div class="form-group col-md-3">
    <label for="organoEjecu" class="form-label">ORGANO EJECUTANTE:</label>
    <input type="text" class="form-control" id="organoEjecu" name="organoEjecu" value="Municipalidad Provincial de Chiclayo" placeholder="Ingrese organo" >
</div>';

  echo '    <!-- NUMERO DE EXPEDIENTE-->
<div class="form-group col-md-3">
    <label for="numeroExpediente" class="form-label">Nº EXPEDIENTE:</label>
    <input type="number" class="form-control" id="numeroExpediente" name="numeroExpe" placeholder="Ingrese expediente" >
</div>';
  // Primer bloque
  echo '
    <div class="form-group col-md-3">
        <label for="fechaDiliItse" class="form-label">FECHA DILIGENCIA ITSE:</label>
        <input type="date" class="form-control" id="fechaDiliItse" name="fechaDiliItse" >
    </div>
';

  echo '
<div class="form-group col-md-3">
    <label for="fechaDiliEcse" class="form-label">FECHA DILIGENCIA ECSE:</label>
    <input type="date" class="form-control" id="fechaDiliEcse" name="fechaDiliEcse" >
</div>
';


  echo '
    </div>
</div>
';
}
