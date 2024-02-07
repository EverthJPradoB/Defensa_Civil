<?php

try {
    if (
        isset($_POST["grupoItse"]) && isset($_POST["grupoFuncion"]) && isset($_POST["grupoRiesgo"]) &&

        isset($_POST["organoEjecu"]) && isset($_POST["numeroExpe"])
        && isset($_POST["fechaDiliItse"]) && isset($_POST["fechaDiliEcse"]) // INFO GENERAL

        && isset($_POST["tipoSolicitante"]) && isset($_POST["apepSoli"]) && isset($_POST["apemSoli"])
        && isset($_POST["nombreSoli"]) &&      isset($_POST["tipoDocSolicitante"])    && isset($_POST["dniSoli"]) && isset($_POST["domicilioSoli"])
        && isset($_POST["telefonoSoli"])  && isset($_POST["emailSoli"]) // DATOS SOLICITANTE

        && isset($_POST["razonSocial"]) && isset($_POST["ruc"]) && isset($_POST["nombreComer"])
        && isset($_POST["telefonoComer"]) && isset($_POST["direccionComer"]) && isset($_POST["referenciaComer"])
        && isset($_POST["localidadComer"])  && isset($_POST["distritoComer"])
        // && isset($_POST["provinciaComer"]) && isset($_POST["departamentoComer"])
        && isset($_POST["horaAten"]) // OBJETO INSPECCION

        // //////// DETALLEEEEE

        && (

            isset($_POST["docuPostRecibo"]) || isset($_POST["docuPostDj"]) //--- ITSE POSTERIOR AL INICIO DE ACTIVIDADES

            //--- Para ITSE PREVIA AL INICIO DE ACTIVIDADES:
            || isset($_POST["docuCroq"])
            || isset($_POST["docuPrePlanoArq"])
            || isset($_POST["docuPrePlanoDis"]) || isset($_POST["docuPreCerti"])
            || isset($_POST["docuPrePlan"]) || isset($_POST["docuPreMem"])
            || isset($_POST["docuPreNoExi"])
            || isset($_POST["docuDesc1"]) //--- Para ITSE PREVIA AL INICIO DE ACTIVIDADES:

            // //- Para RENOVACIÓN DEL CERTIFICADO DE ITSE -ITSE POSTERIO - ITSE PREVIA
            || isset($_POST["docuRenoRecibo"]) || isset($_POST["docuRenoDj"])
            || isset($_POST["docuDesc2"]) //- Para RENOVACIÓN DEL CERTIFICADO DE ITSE -ITSE POSTERIO - ITSE PREVIA
            //ECSE HASTA 3000 PERSONAS


            || isset($_POST["DocuEcseDjSus"])
            || isset($_POST["DocuEcseCroq"])
            || isset($_POST["DocuEcsePlanoArq"]) || isset($_POST["DocuEcseMem"])
            || isset($_POST["DocuEcseProto"]) || isset($_POST["DocuEcseConst"])
            || isset($_POST["DocuEcsePlanEven"])
            || isset($_POST["DocuEcseDjInst"])
            || isset($_POST["DocuEcseCaso"])
            || isset($_POST["DocuEcseCerti"])
            || isset($_POST["docuDesc3"])

            //
            || isset($_POST["DocuEcseHoraIni"])
            || isset($_POST["DocuEcseFechaIni"])


            || isset($_POST["DocuEcseHoraFin"])
            || isset($_POST["DocuEcseFechaFin"])

            || isset($_POST["docuDesc4"])

        )

    ) {
        // Obtener el valor seleccionado

        echo "<h1> I. INFORMACION GENERAL    </h1>";

        // Tipo_Itse 
        $opcionTipoItse = $_POST["grupoItse"];
        echo "Opción Tipo de Itse: " . $opcionTipoItse;

        echo "<br>";
        // Tipo_Itse 
        $opcionTipoFuncion = $_POST["grupoFuncion"];
        echo "Opción Tipo de Funcion: " . $opcionTipoFuncion;

        echo "<br>";
        // Tipo_Riesgo
        $opcionTipoRiesgo = $_POST["grupoRiesgo"];
        echo "Opción Tipo de Riesgo: " . $opcionTipoRiesgo;

        echo "<br>";
        // Tipo_Itse 
        $organoEjecu = $_POST["organoEjecu"];
        echo "Opción organoEjecu: " . $organoEjecu;

        echo "<br>";
        // Tipo_Itse 
        $numeroExpe = $_POST["numeroExpe"];
        echo "Opción numeroExpe: " . $numeroExpe;


        echo "<br>";
        // Tipo_Riesgo
      
        $fechaDiliItse = $_POST['fechaDiliItse'] ?? null;
        echo "Opción fechaDiliItse: " . $fechaDiliItse;

        echo "<br>";
        // Tipo_Riesgo
        $fechaDiliEcse = $_POST["fechaDiliEcse"] ?? null;
        echo "Opción fechaDiliEcse: " . $fechaDiliEcse;


        echo "<h1>  II. DATOS DEL SOLICITANTE    </h1>";

        echo "tipoSolicitante: " . $_POST["tipoSolicitante"] . "<br>";

        echo "apepSoli: " . $_POST["apepSoli"] . "<br>";
        echo "apemSoli: " . $_POST["apemSoli"] . "<br>";
        echo "nombreSoli: " . $_POST["nombreSoli"] . "<br>";

        echo "tipoDocSolicitante: " . $_POST["tipoDocSolicitante"] . "<br>";

        echo "dniSoli: " . $_POST["dniSoli"] . "<br>";
        echo "domicilioSoli: " . $_POST["domicilioSoli"] . "<br>";
        echo "telefonoSoli: " . $_POST["telefonoSoli"] . "<br>";
        echo "emailSoli: " . $_POST["emailSoli"] . "<br>";

        // /////////////////////  

        echo "<h1> III.- DATOS DEL OBJETO DE INSPECCIÓN: </h1>";

        echo "razonSocial: " . $_POST["razonSocial"] . "<br>";
        echo "ruc: " . $_POST["ruc"] . "<br>";
        echo "nombreComer: " . $_POST["nombreComer"] . "<br>";
        echo "telefonoComer: " . $_POST["telefonoComer"] . "<br>";
        echo "direccionComer: " . $_POST["direccionComer"] . "<br>";
        echo "referenciaComer: " . $_POST["referenciaComer"] . "<br>";
        echo "localidadComer: " . $_POST["localidadComer"] . "<br>";
        echo "distritoComer: " . $_POST["distritoComer"] . "<br>";
        // echo "provinciaComer: " . $_POST["provinciaComer"] . "<br>";
        // echo "departamentoComer: " . $_POST["departamentoComer"] . "<br>";
        echo "horaAten: " . $_POST["horaAten"] . "<br>";

        ////////////// DETALE

        // para ITSE POSTERIOR AL INICIO DE ACTIVIDADES

        echo "<h1> ITSE POSTERIOR AL INICIO DE ACTIVIDADES </h1>";

        $docuPostRecibo = $_POST["docuPostRecibo"] ?? '0';
        echo "<br> docuPostRecibo seleccionado: $docuPostRecibo <br>";

        $docuPostDj = $_POST["docuPostDj"] ?? '0';
        echo "docuPostDj seleccionado: $docuPostDj <br>";

        // Para 
        echo "<h1>ITSE PREVIA AL INICIO DE ACTIVIDADES</h1>";

        $_POST['docuCroq'] = $_POST['docuCroq'] ?? '0';
        echo "docuCroq: " . $_POST["docuCroq"] . "<br>";

        $_POST['docuPrePlanoArq'] = $_POST['docuPrePlanoArq'] ?? '0';
        echo "docuPrePlanoArq: " . $_POST["docuPrePlanoArq"] . "<br>";

        $_POST['docuPrePlanoDis'] = $_POST['docuPrePlanoDis'] ?? '0';
        echo "docuPrePlanoDis: " . $_POST["docuPrePlanoDis"] . "<br>";

        $_POST['docuPreCerti'] = $_POST['docuPreCerti'] ?? '0';
        echo "docuPreCerti: " . $_POST["docuPreCerti"] . "<br>";

        $_POST['docuPrePlan'] = $_POST['docuPrePlan'] ?? '0';
        echo "docuPrePlan: " . $_POST["docuPrePlan"] . "<br>";

        $_POST['docuPreMem'] = $_POST['docuPreMem'] ?? '0';
        echo "docuPreMem: " . $_POST["docuPreMem"] . "<br>";

        $_POST['docuPreNoExi'] = $_POST['docuPreNoExi'] ?? '0';
        echo "docuPreNoExi: " . $_POST["docuPreNoExi"] . "<br>";

        $_POST['docuDesc1'] = $_POST['docuDesc1'] ?? '-';
        echo "docuDesc1: " . $_POST["docuDesc1"] . "<br>";


        echo "<h1>RENOVACIÓN DEL CERTIFICADO DE ITSE ( ) </h1>";
        // //- Para RENOVACIÓN DEL CERTIFICADO DE ITSE -ITSE POSTERIO - ITSE PREVIA


        $_POST['docuRenoRecibo'] = $_POST['docuRenoRecibo'] ?? '0';
        echo "docuRenoRecibo: " . $_POST["docuRenoRecibo"] . "<br>";

        $_POST['docuRenoDj'] = $_POST['docuRenoDj'] ?? '0';
        echo "docuRenoDj: " . $_POST["docuRenoDj"] . "<br>";

        $_POST['docuDesc2'] = $_POST['docuDesc2'] ?? '-';
        echo "docuDesc2: " . $_POST["docuDesc2"] . "<br>";

        // Para 
        echo "<h1>ECSE HASTA 3000 PERSONAS </h1>";

        $_POST['DocuEcseDjSus'] = $_POST['DocuEcseDjSus'] ?? '0';
        $_POST['DocuEcseCroq'] = $_POST['DocuEcseCroq'] ?? '0';
        $_POST['DocuEcsePlanoArq'] = $_POST['DocuEcsePlanoArq'] ?? '0';
        $_POST['DocuEcseMem'] = $_POST['DocuEcseMem'] ?? '0';
        $_POST['DocuEcseProto'] = $_POST['DocuEcseProto'] ?? '0';
        $_POST['DocuEcseConst'] = $_POST['DocuEcseConst'] ?? '0';
        $_POST['DocuEcsePlanEven'] = $_POST['DocuEcsePlanEven'] ?? '0';
        $_POST['DocuEcseDjInst'] = $_POST['DocuEcseDjInst'] ?? '0';
        $_POST['DocuEcseCaso'] = $_POST['DocuEcseCaso'] ?? '0';
        $_POST['DocuEcseCerti'] = $_POST['DocuEcseCerti'] ?? '0';
        $_POST['docuDesc3'] = $_POST['docuDesc3'] ?? '-';

        $_POST['DocuEcseHoraIni'] = $_POST['DocuEcseHoraIni'] ?? '';
        $_POST['DocuEcseFechaIni'] = $_POST['DocuEcseFechaIni'] ?? '';

        $_POST['DocuEcseHoraFin'] = $_POST['DocuEcseHoraFin'] ?? '';
        $_POST['DocuEcseFechaFin'] = $_POST['DocuEcseFechaFin'] ?? '';

        $_POST['docuDesc4'] = $_POST['docuDesc4'] ?? '-';

        // Imprimiendo los valores
        echo "DocuEcseDjSus: " . $_POST["DocuEcseDjSus"] . "<br>";
        echo "DocuEcseCroq: " . $_POST["DocuEcseCroq"] . "<br>";
        echo "DocuEcsePlanoArq: " . $_POST["DocuEcsePlanoArq"] . "<br>";
        echo "DocuEcseMem: " . $_POST["DocuEcseMem"] . "<br>";
        echo "DocuEcseProto: " . $_POST["DocuEcseProto"] . "<br>";
        echo "DocuEcseConst: " . $_POST["DocuEcseConst"] . "<br>";
        echo "DocuEcsePlanEven: " . $_POST["DocuEcsePlanEven"] . "<br>";
        echo "DocuEcseDjInst: " . $_POST["DocuEcseDjInst"] . "<br>";
        echo "DocuEcseCaso: " . $_POST["DocuEcseCaso"] . "<br>";
        echo "DocuEcseCerti: " . $_POST["DocuEcseCerti"] . "<br>";
        echo "docuDesc3: " . $_POST["docuDesc3"] . "<br>";

        echo "DocuEcseHoraIni: " . $_POST["DocuEcseHoraIni"] . "<br>";
        echo "DocuEcseFechaIni: " . $_POST["DocuEcseFechaIni"] . "<br>";

        echo "DocuEcseHoraFin: " . $_POST["DocuEcseHoraFin"] . "<br>";
        echo "DocuEcseFechaFin: " . $_POST["DocuEcseFechaFin"] . "<br>";

        echo "docuDesc4: " . $_POST["docuDesc4"] . "<br>";
    } else {

        echo "Por favor, selecciona una opción.";
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
