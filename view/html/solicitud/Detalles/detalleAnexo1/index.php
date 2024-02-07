<div class=" p-2 ">

    <div class="form-row " >
        <!-- ORGANO EJECUTANTE 1 -->

        <!-- // ITSE POSTERIOR AL INICIO DE ACTIVIDADES ( ) -->
        <div class="itse_post_activi" style="display: none;">
        
            <div class="form-group pl-1">
                <h1 style="font-size: 18px;"> ITSE POSTERIOR AL INICIO DE ACTIVIDADES
                </h1>
            </div>

            <div class=" ">
                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="post_activi" id="docuPostRecibo" value="1">
                    <label class="form-check-label custom-radio-label " for="docuPostRecibo">
                        a) Recibo de pago
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="post_activi" id="docuPostDj" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPostDj">
                        b) Declaración Jurada de Cumplimiento de Condiciones de Seguridad en la Edificación
                    </label>
                </div>

            </div>
        </div>

        <!-- //ITSE PREVIA AL INICIO DE ACTIVIDADES ( ) -->
        <div class="itse_pre_activi" style="display: none;">
            <div class="form-group pl-1">
                <h1 style="font-size: 18px;"> ITSE PREVIA AL INICIO DE ACTIVIDADES
                </h1>
            </div>

            <div class="">
                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuCroq" value="1">
                    <label class="form-check-label custom-radio-label" for="docuCroq">
                        a) Croquis de ubicación.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPrePlanoArq" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPrePlanoArq">
                        b) Plano de arquitectura de la distribución existente y detalle de cálculo de aforo.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPrePlanoDis" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPrePlanoDis">
                        c) Plano de distribucion de Tableros Electricos, Diagramas Unifilares y Cuadro de cargas
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPreCerti" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPreCerti">
                        d) Certificado vigente de medicion de resistencia del sistema de puesta a Tierra
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPrePlan" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPrePlan">
                        e) Plan de Seguridad del Objeto de Inspección
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPreMem" value="1">
                    <label class="form-check-label custom-radio-label" for="docuPreMem">
                        f) Memoria o protocolos de pruebas de operatividad y/o mantenimiento de los
                        equipos de seguridad y proteccion contra incendio.
                </div>

                <div class="form-check ">
                    <input class="form-check-input ml-1" type="checkbox" name="pre_activi" id="docuPreNoExi" value="1">
                    <label class="form-check-label custom-radio-label mb-2" for="docuPreNoExi">
                        g) No son exigibles el croquis ni planos a que se refieren los literales a), b) y
                        c) precedente en el caso de edificaciones que cuentan conformidad de obra y
                        no han sufrido modificaciones, siempre que se trate de documentos que
                        fueron presentados a la Municipalidad durante los cinco (5) años anteriores
                        inmediatos, de conformidad con lo establecido en el artículo 46 del Texto
                        Único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo
                        General
                    </label>

                    <div class="form-colum  pl-4">
                        <label for="docuDesc1" class=" form-label">Detalle o descripción de documentos presentados:

                        </label>
                        <textarea class="form-control" id="docuDesc1" name="docuDesc1" rows="3">-</textarea>
                    </div>

                </div>

            </div>


        </div>


        <!-- //RENOVACIÓN DEL CERTIFICADO DE ITSE ( ) -->
        <div class="p-3 itse_renova_certi"  style="display: none;">
            <div class="form-group pl-1">
                <h1 style="font-size: 18px;"> RENOVACIÓN DEL CERTIFICADO DE ITSE
                </h1>
            </div>
            <div>
                <div class="form-row pl-1  ">

                    <div class="form-group pl-3 col-md-6">
                        <h1 style="font-size: 18px;"> ITSE POSTERIOR

                        </h1>
                    </div>

                    <div class="form-group pl-3 col-md-6">
                        <h1 style="font-size: 18px;">ITSE PREVIA
                        </h1>
                    </div>

                </div>

                <div class="form-colum">
                    <div class="">
                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="itse_renova" id="docuRenoRecibo" value="1">
                            <label class="form-check-label custom-radio-label " for="docuRenoRecibo">
                                a) Recibo de pago
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="itse_renova" id="docuRenoDj" value="1">
                            <label class="form-check-label custom-radio-label" for="docuRenoDj">
                                b) Declaración Jurada en la que el administrado manifiesta que mantiene las Condiciones de Seguridad que
                                sustentaron el otorgamiento del Certificado de ITSE </label>
                        </div>

                        <div class="form-group ml-4">

                            <label class="form-label custom-radio-label" for="docuDesc2">
                                Detalle o descripción de documentos presentados:
                            </label>

                            <textarea class="form-control" name="docuDesc2" id="docuDesc2" rows="3">-</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- ECSE -->
        <div  class="p-3 itse_hasta_mayor_3000"  style="display: none;">
            <div class="form-row pl-2 ">

                <div class="form-group pl-1 col-md-6">
                    <h1 style="font-size: 18px;"> ECSE HASTA 3000 PERSONAS
                    </h1>
                </div>

                <div class="form-group pl-1 col-md-6">
                    <h1 style="font-size: 18px;"> ECSE MAYOR A 3000 PERSONAS
                    </h1>
                </div>

            </div>
            <div class="form-colum  ">

                <div class="">

                    <div class=" ">
                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseDjSus" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseDjSus">
                                a) Declaración Jurada suscrita por el solicitante; en el caso de persona jurídica o de
                                persona natural que actúe mediante representación, el representante legal o apoderado
                                debe consignar los datos registrales de su poder y señalar que se encuentra vigente

                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseCroq" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseCroq">
                                b) Croquis de ubicación del lugar o recinto donde se tiene previsto realizar el Espectáculo.
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcsePlanoArq" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcsePlanoArq">
                                c) Plano de la arquitectura indicando la distribución del escenario, mobiliario y otros, así
                                como el cálculo de aforo </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseMem" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseMem">
                                d) Memoria Descriptiva, incluyendo un resumen de la programación de actividades, del
                                proceso de montaje o acondicionamiento de las estructuras; instalaciones eléctricas,
                                instalaciones de seguridad y protección contra incendios y mobiliario. </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseProto" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseProto">
                                e) Protocolo de medición del sistema de puesta a tierra con vigencia no menor a un (1) año,
                                en caso haga uso de instalaciones eléctricas </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseConst" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseConst">
                                f) Constancia de operatividad y mantenimiento de extintores, firmado por la empresa
                                responsable. </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcsePlanEven" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcsePlanEven">
                                g) Plan de Seguridad para el Evento, que incluya el Plano de señalización, rutas de
                                evacuación y ubicación de zonas seguras para los asistentes al evento
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseDjInst" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseDjInst">
                                h) Declaración Jurada de instalación segura del sistema de gas licuado de petróleo (GLP),
                                en caso corresponda.
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseCaso" value="1">
                            <label class="form-check-label custom-radio-label" for="DocuEcseCaso">
                                i) En caso de uso de juegos mecánicos y/o electromecánicos, memoria descriptiva de
                                seguridad de la instalación de las estructuras e instalaciones eléctricas.

                        </div>
                        <div class="form-check mb-2 ">
                            <input class="form-check-input ml-1" type="checkbox" name="hasta_mayor_3000" id="DocuEcseCerti" value="1">
                            <label class="form-check-label custom-radio-label mb-2" for="DocuEcseCerti">
                                j) Certificado de ITSE, si se trata de un establecimiento o recinto, en caso no lo haya
                                expedido el mismo Órgano Ejecutante. En caso contrario, se debe consignar la numeración
                                del mismo en el formato de solicitud.</label>

                            <div class="form-colum pl-4">

                                <label for="docuDesc3" class="form-label">Detalle o descripción de documentos presentados:</label>
                                <textarea class="form-control" name="docuDesc3" id="docuDesc3" rows="3">-</textarea>
                            </div>
                        </div>


                        <div class="row pl-4">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="DocuEcseHoraIni" class="form-label">HORA INICIO:</label>
                                        <input type="time" class="form-control" id="DocuEcseHoraIni" name="DocuEcseHoraIni" require>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="DocuEcseFechaIni" class="form-label">FECHA INICIO:</label>
                                        <input type="date" class="form-control" id="DocuEcseFechaIni" name="DocuEcseFechaIni" require>
                                    </div>
                                </div>
                            </div>

                   
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="DocuEcseHoraFin" class="form-label">HORA FIN:</label>
                                        <input type="time" class="form-control" id="DocuEcseHoraFin" name="DocuEcseHoraFin" require>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="DocuEcseFechaFin" class="form-label">FECHA FIN:</label>
                                        <input type="date" class="form-control" id="DocuEcseFechaFin" name="DocuEcseFechaFin" require>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group ml-4">

                            <label for="docuDesc4" class="form-label custom-radio-label">
                                Detalle o descripción de documentos presentados:
                            </label>

                            <textarea class="form-control" id="docuDesc4" name="docuDesc4" rows="3">-</textarea>
                        </div>

                    </div>
                </div>

            </div>
        </div> 
        
    </div>


</div>