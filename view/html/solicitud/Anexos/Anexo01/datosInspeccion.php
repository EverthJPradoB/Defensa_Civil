 <!-- DATOS OBJETO DE INSPECCION -->
 <div id="datos_objetos_inspeccion" class="datos_objetos_inspeccion">

     <br>
     <div class=" p-3">

         <div class="form-row">

             <div class="form-group  col-md-4">
                 <label for="razonSocial" class="form-label">RAZÓN SOCIAL:</label>

                 <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" require>
             </div>

             <div class="form-group col-md-4">
                 <label for="ruc" class="form-label">RUC:</label>

                 <input type="text" class="form-control " name="ruc" id="ruc" placeholder="RUC" require>
             </div>

             <div class="form-group col-md-4">
                 <label for="nombreComer" class="form-label">NOMBRE COMERCIAL:</label>

                 <input type="text" class="form-control " name="nombreComer" id="nombreComer" placeholder="Nombre Comercial">
             </div>

             <div class="form-group col-md-4">
                 <label for="telefonoComer" class="form-label ">TELEFONO</label>

                 <input type="number" class="form-control " name="telefonoComer" id="telefonoComer" placeholder="Telefono" >
             </div>

             <div class="form-group col-md-4">
                 <label for="direccionComer" class="form-label">DIRECCIÓN/UBICACIÓN:</label>

                 <input type="text" class="form-control" name="direccionComer" id="direccionComer" placeholder="Dirección/Ubicación">

             </div>

             <div class="form-group col-md-4">
                 <label for="referenciaComer" class="form-label">REFERENCIA DE DIRECCION:</label>

                 <input type="text" class="form-control" name="referenciaComer" id="referenciaComer" placeholder="Referencia de Direccion">

             </div>

             <div class="form-group col-md-3">
                 <label for="localidadComer" class="form-label">LOCALIDAD: </label>
                 <input type="text" class="form-control" name="localidadComer" id="localidadComer" placeholder="Referencia de Localidad">
             </div>

             <div class="form-group col-md-3">
                 <label for="distritoComer" class="form-label">DISTRITO: </label>
                 <select class="form-control select2" style="width:100%" name="distritoComer" id="distritoComer" data-placeholder="Seleccione">
                     <option label="Seleccione"></option>
                 </select>
             </div>

             <div class="form-group col-md-3">
                 <label for="provinciaComer" class="form-label">PROVINCIA: </label>

                 <input type="text" name="" value="CHICLAYO" class="form-control " id="provinciaComer" placeholder="Ingrese la provincia" readonly>

             </div>

             <div class="form-group col-md-3">
                 <label for="departamentoComer" class="form-label">DEPARTAMENTO: </label>
                 <input type="text" name="" value="LAMBAYEQUE" class="form-control " id="departamentoComer" placeholder="Ingrese el departamento" readonly>
             </div>

             <div class="form-group col-md-3">
                 <label for="horaAten" class="form-label">HORARIO DE ATENCIÓN:</label>
                 <input type="text" name="horaAten" style="width: 100%;" class="form-control " id="horaAten" placeholder="Horario de Atención">
             </div>

             <!-- FALTA VALIDAR EN EL JS -->

             <div class="form-group col-md-3">
                 <label for="areaTotal" class="form-label">AREA OCUPADA TOTAL (M2):</label>
                 <input type="text" step="0.01" name="areaTotal" style="width: 100%;" class="form-control " id="areaTotal" placeholder="Area ocupada total">
             </div>
  
             <div class="form-group col-md-3">
                 <label for="numPisos" class="form-label">N° DE PISOS DEL EDIFICIO</label>
                 <input type="text" name="numPisos" style="width: 100%;" class="form-control " id="numPisos" placeholder="Número de pisos de la edificación">
             </div>

             <div class="form-group col-md-3">
                 <label for="pisoUbi" class="form-label">PISO OBJETO DE INSPECCION</label>
                 <input type="text" name="pisoUbi" style="width: 100%;" class="form-control " id="pisoUbi" placeholder="Piso objeto de inspeccion">
             </div>

             <!-- END -->             
             <div class="form-group col-md-12">
                 <label for="giroComer" class="form-label">GIRO O ACTIVIDAD QUE REALIZA:</label>
                 <select class="form-select select2 form-row" style="width:100%" name="giroComer[]" id="giroComer" data-placeholder="Seleccione" multiple ></select>
             </div>

         </div>

     </div>

 </div>