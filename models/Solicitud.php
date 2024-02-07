<?php

class Solicitud extends Conectar
{

    public function insert_solicitud(
        $grupoItse,
        $grupoFuncion,
        $grupoRiesgo,
        $organoEjecu,
        $numeroExpe,
        $fechaDiliItse,
        $fechaDiliEcse,
        $soliIdInsertado,
        $estaIdInsertado,
        $usuario_id
    ) {

        $fechaActual = date('Y-m-d H:i:s');

        $conectar = parent::conexion();
        parent::set_names(); //  "../../public/1.png" esta imagen seria el certiifcado por defecto para todos
        $sql = "INSERT INTO sc_gitse3.tb_solicitud_itse(
            soit_tipoitse, soit_funcion, soit_clasiriesgo, soit_organo, soit_numexpe, 
            soit_fechaproitse, soit_fechaproecse, soli_id, esta_id, soit_fechareg, usuario_id, estado)
                    VALUES ( ?, ?, ?, ?, ?, ?, ?, ? , ? , NOW() , ? , 'A') RETURNING soit_id;";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $grupoItse);
        $sql->bindValue(2, $grupoFuncion);
        $sql->bindValue(3, $grupoRiesgo);
        $sql->bindValue(4, $organoEjecu);
        $sql->bindValue(5, $numeroExpe);
        $sql->bindValue(6, $fechaDiliItse);
        $sql->bindValue(7, $fechaDiliEcse);
        $sql->bindValue(8, $soliIdInsertado);
        $sql->bindValue(9, $estaIdInsertado);
        $sql->bindValue(10, $usuario_id);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_informacion_general_anexo_01(
        $grupoItse,
        $grupoFuncion,
        $grupoRiesgo,
        // $organoEjecu,
        $numeroExpe,
        $fechaDiliItse,
        $fechaDiliEcse,
        $soliIdInsertado,
        $estaIdInsertado,
        $usuario_id,
        $soit_id
    ) {
        $conectar = parent::conexion();
        parent::set_names(); //  "../../public/1.png" esta imagen seria el certiifcado por defecto para todos

        // $sql = "UPDATE sc_gitse3.tb_solicitud_itse SET  
        // soit_tipoitse=?, soit_funcion=?, soit_clasiriesgo=?,  soit_numexpe=?, 
        // soit_fechaproitse=?, soit_fechaproecse=?, soli_id=?, esta_id=?
        // usuario_id=? WHERE soit_id=?";

        $sql =
            "UPDATE sc_gitse3.tb_solicitud_itse SET  
            soit_tipoitse=? , soit_funcion=?, soit_clasiriesgo=?  ,
            soit_numexpe=? ,  soit_fechaproitse=?, soit_fechaproecse=?,
            soli_id=?, esta_id=?, usuario_id=?
            WHERE soit_id=?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $grupoItse);
        $sql->bindValue(2, $grupoFuncion);
        $sql->bindValue(3, $grupoRiesgo);
        $sql->bindValue(4, $numeroExpe);
        $sql->bindValue(5, $fechaDiliItse);
        $sql->bindValue(6, $fechaDiliEcse);
        $sql->bindValue(7, $soliIdInsertado);
        $sql->bindValue(8, $estaIdInsertado);
        $sql->bindValue(9, $usuario_id);
        $sql->bindValue(10, $soit_id);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    // "
    // UPDATE sc_gitse3.tb_solicitante
    // SET  soli_tipo=?, soli_apep=?, soli_apem=?, soli_nombre=?, soli_tipodoident=?, 
    // soli_numdocident=?, soli_domocilio=?, soli_correo=?, soli_telefono=?
    // WHERE soli_id=?;
    // "

    public function insert_solicitante(
        $tipoSolicitante,
        $apepSoli,
        $apemSoli,
        $nombreSoli,
        $tipoDocSolicitante,
        $dniSoli,
        $domicilioSoli,
        $telefonoSoli,
        $emailSoli
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_solicitante(
            soli_tipo, soli_apep, soli_apem, soli_nombre, soli_tipodoident, soli_numdocident, soli_domocilio, soli_correo, soli_telefono)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING soli_id;";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipoSolicitante);
        $sql->bindValue(2, $apepSoli);
        $sql->bindValue(3, $apemSoli);
        $sql->bindValue(4, $nombreSoli);
        $sql->bindValue(5, $tipoDocSolicitante);
        $sql->bindValue(6, $dniSoli);
        $sql->bindValue(7, $domicilioSoli);
        $sql->bindValue(8, $telefonoSoli);
        $sql->bindValue(9, $emailSoli);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_datos_solicitante_anexo_01(
        $tipoSolicitante,
        $apepSoli,
        $apemSoli,
        $nombreSoli,
        $tipoDocSolicitante,
        $dniSoli,
        $domicilioSoli,
        $telefonoSoli,
        $emailSoli,
        $soli_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_gitse3.tb_solicitante
        SET  soli_tipo=?, soli_apep=?, soli_apem=?, soli_nombre=?, soli_tipodoident=?, 
        soli_numdocident=?, soli_domocilio=?, soli_correo=?, soli_telefono=?
        WHERE soli_id=?;";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $tipoSolicitante);
        $sql->bindValue(2, $apepSoli);
        $sql->bindValue(3, $apemSoli);
        $sql->bindValue(4, $nombreSoli);
        $sql->bindValue(5, $tipoDocSolicitante);
        $sql->bindValue(6, $dniSoli);
        $sql->bindValue(7, $domicilioSoli);
        $sql->bindValue(8, $telefonoSoli);
        $sql->bindValue(9, $emailSoli);
        $sql->bindValue(10, $soli_id);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_objeto_inspeccion(
        $razonSocial,
        $ruc,
        $nombreComer,
        $telefonoComer,
        $direccionComer,
        $referenciaComer,
        $localidadComer,
        $horaAten,
        $giroIdsString,
        $distritoComer,
        //
        $esta_areatotal,
        $esta_numpisos,
        $esta_pisoubi

    ) {
        $conectar = parent::conexion();
        parent::set_names();

        // esta_areatotal, esta_numpisos, esta_pisoubi

        $sql = "INSERT INTO sc_gitse3.tb_establecimiento(
            esta_razsocial, esta_ruc, esta_nomcomer, esta_tel, esta_direccion, esta_referencia, esta_localidad, esta_horarioaten, esta_giro, ubig_id
            , esta_areatotal, esta_numpisos, esta_pisoubi )
            VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING esta_id";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $razonSocial);
        $sql->bindValue(2, $ruc);
        $sql->bindValue(3, $nombreComer);
        $sql->bindValue(4, $telefonoComer);
        $sql->bindValue(5, $direccionComer);
        $sql->bindValue(6, $referenciaComer);
        $sql->bindValue(7, $localidadComer);
        $sql->bindValue(8, $horaAten, PDO::PARAM_STR);
        $sql->bindValue(9, $giroIdsString);
        $sql->bindValue(10, $distritoComer);

        $sql->bindValue(11, $esta_areatotal);
        $sql->bindValue(12, $esta_numpisos);
        $sql->bindValue(13, $esta_pisoubi);


        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_objeto_inspeccion_anexo_01(

        $razonSocial,
        $ruc,
        $nombreComer,
        $telefonoComer,
        $direccionComer,
        $referenciaComer,
        $localidadComer,
        $horaAten,
        $giroIdsString,
        $distritoComer,

        $esta_areatotal,
        $esta_numpisos,
        $esta_pisoubi,

        $esta_id

    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_gitse3.tb_establecimiento
        SET esta_razsocial=?, esta_ruc=?, esta_nomcomer=?, esta_tel=?, esta_direccion=?, 
        esta_referencia=?, esta_localidad=?, esta_horarioaten=?, esta_giro=?, ubig_id=?,
        esta_areatotal=?, esta_numpisos=?, esta_pisoubi=?
        WHERE esta_id=?;";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $razonSocial);
        $sql->bindValue(2, $ruc);
        $sql->bindValue(3, $nombreComer);
        $sql->bindValue(4, $telefonoComer);
        $sql->bindValue(5, $direccionComer);
        $sql->bindValue(6, $referenciaComer);
        $sql->bindValue(7, $localidadComer);
        $sql->bindValue(8, $horaAten, PDO::PARAM_STR);
        $sql->bindValue(9, $giroIdsString);
        $sql->bindValue(10, $distritoComer);

        $sql->bindValue(11, $esta_areatotal);
        $sql->bindValue(12, $esta_numpisos);
        $sql->bindValue(13, $esta_pisoubi);

        $sql->bindValue(14, $esta_id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    
    //06
    public function insert_informe_inspector(
        $info_tipoitse,
        $info_fecha,
        $info_hinicio,
        $info_hfin,
        $info_anticon,
        $info_antigiro,
        $info_veri_1_6,
        $info_veri_2_6,
        $info_veri_1_7
    ) {

        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO sc_gitse3.tb_informe_inspector(
        info_tipoitse, info_fecha, 
        info_hinicio, info_hfin, 
        info_anticon_7, info_antigiro_7, 
        info_veri_1_6, info_veri_2_6, info_veri_1_7)
        VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING info_id;";
        
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $info_tipoitse);
        $sql->bindValue(2, $info_fecha);
        $sql->bindValue(3, $info_hinicio);
        $sql->bindValue(4, $info_hfin);
        $sql->bindValue(5, $info_anticon);
        $sql->bindValue(6, $info_antigiro);
        $sql->bindValue(7, $info_veri_1_6);
        $sql->bindValue(8, $info_veri_2_6);
        $sql->bindValue(9, $info_veri_1_7);
 
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function get_distrito()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT ubi_id , ds_nombre FROM sc_gitse3.tb_ubigeo where ubi_estado = '1';";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_giro()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT gico_id, gico_nombre, gico_estado, gico_created_at, gico_updated_at
        FROM sc_gitse3.tb_giro_comercial where gico_estado = 'A';";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_anexo_02()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
        FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '1'   order by aux_idesc::int  asc";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_anexo_02_aux_tipocod_9_aux_idesc_46_47_48()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
        FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '1' and  aux_idesc IN ('46','47','48') order by aux_idesc::int  asc";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_anexo_03_aux_tipocod_9_aux_idesc_49()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
        FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = '1' and  aux_idesc  IN ('49','50')  order by aux_idesc::int  asc";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_anexo_04()
    {
        $conectar = parent::conexion();
        parent::set_names();

        $valorBuscado = '4';

        $sql = "SELECT  aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1,  aux_tipoanexo
        FROM sc_gitse3.tb_auxiliar__ 
        WHERE aux_itemcod ='2' AND '$valorBuscado' = ANY(aux_tipoanexo)  
        ORDER BY aux_idesc::int ASC";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function get_auxiliar($aux_itemcod, $aux_tipoanexo)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT * FROM sc_gitse3.obtener_auxiliar_list(?,?);";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $aux_itemcod);
        $sql->bindValue(2, $aux_tipoanexo);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function get_anexo_04_componentes()
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT * from sc_gitse3.tb_componente where comp_id = 'CONDICIONES' and comp_valor in ('1')";

        $sql = $conectar->prepare($sql);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // INSERT TABLA DECLARACION (ANEXO04)

    public function insert_anexo_04(
        //	decla_funciona, decla_capaci, decla_edifianti, decla_giroanti, decla_areaterre,        5
        //decla_areapiso1, decla_areapiso2, decla_areapiso3, decla_areapiso4, decla_areaotrospisos,    5  
        //decla_areatechatotal, decla_areaocupatotal, decla_edifi1, decla_edifi2, decla_edifi3, decla_edifi4, soit_id) //7

        $decla_funciona,
        $decla_capaci,
        $decla_edifianti,
        $decla_giroanti,
        $decla_areaterre,  //5
        $decla_areapiso1,
        $decla_areapiso2,
        $decla_areapiso3,
        $decla_areapiso4,
        $decla_areaotrospisos, //  5    -- 10
        $decla_areatechatotal,

        $decla_edifi1,
        $decla_edifi2,
        $decla_edifi3,
        $decla_edifi4,
        $soit_id,
        //
        $pqs,
        $co2,
        $ack,
        $h2o,
        $otro_quimicos


    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_declaracion(
            decla_funciona, decla_capaci, decla_edifianti, decla_giroanti, decla_areaterre, decla_areapiso1, decla_areapiso2,
             decla_areapiso3, decla_areapiso4, decla_areaotrospisos, decla_areatechatotal, 
             decla_edifi1, decla_edifi2, decla_edifi3, decla_edifi4, soit_id, decla_pqs, 
             decla_co2, decla_ack, decla_h2o, decla_otrosquimi)
               VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING decla_id";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $decla_funciona);
        $sql->bindValue(2, $decla_capaci);
        $sql->bindValue(3, $decla_edifianti);
        $sql->bindValue(4, $decla_giroanti);
        $sql->bindValue(5, $decla_areaterre);
        $sql->bindValue(6, $decla_areapiso1);
        $sql->bindValue(7, $decla_areapiso2);
        $sql->bindValue(8, $decla_areapiso3);
        $sql->bindValue(9, $decla_areapiso4);
        $sql->bindValue(10, $decla_areaotrospisos);
        $sql->bindValue(11, $decla_areatechatotal);
        //
        //      $sql->bindValue(13, $soit_id);
        $sql->bindValue(12, $decla_edifi1);
        $sql->bindValue(13, $decla_edifi2);
        $sql->bindValue(14, $decla_edifi3);
        $sql->bindValue(15, $decla_edifi4);
        $sql->bindValue(16, $soit_id);
        //
        $sql->bindValue(17, $pqs);
        $sql->bindValue(18, $co2);
        $sql->bindValue(19, $ack);
        $sql->bindValue(20, $h2o);
        $sql->bindValue(21, $otro_quimicos);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // INSERT TABLA DOCUMENTO ---- IV.- DOCUMENTOS PRESENTADOS 

    public function insert_documento_ITSE_POSTERIOR(
        $docu_tipoitse,
        $soit_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_documento(
                docu_tipoitse, docu_recibopago, docu_djcumpli,soit_id)
                VALUES (?, '1', '1', ?);";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $docu_tipoitse);
        $sql->bindValue(2, $soit_id);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function insert_documento_ITSE_PREVIA(
        $docu_tipoitse,
        // $docu_croquis,
        // $docu_planoarq,
        // $docu_planodis,
        // $docu_certificado,
        // $docu_planseguridad,
        // $docu_memoria,
        // $docu_noexigibles,
        $docu_resodesc,
        $soit_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_documento(
            docu_tipoitse, --1
            docu_croquis, --2
            docu_planoarq, --3
            docu_planodis, --4
            docu_certificado, --5
            docu_planseguridad, --6
            docu_memoria, --7
            docu_noexigibles,--8 
            docu_resodesc,--9
            soit_id --10
            )
            VALUES (?, '1', '1', '1', '1', '1', '1', '1', ?,?); ";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $docu_tipoitse);
        $sql->bindValue(2, $docu_resodesc); // --9
        $sql->bindValue(3, $soit_id);  //--10
        // $sql->bindValue(2, $docu_croquis);
        // $sql->bindValue(3, $docu_planoarq);
        // $sql->bindValue(4, $docu_planodis);
        // $sql->bindValue(5, $docu_certificado);
        // $sql->bindValue(6, $docu_planseguridad);
        // $sql->bindValue(7, $docu_memoria);
        // $sql->bindValue(8, $docu_noexigibles);


        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function insert_documento_ITSE_RENOVACIÓN(
        $docu_tipoitse,
        // $docu_renorecibo,
        // $docu_renodj,
        $docu_renodesc,
        $soit_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_documento(
		
            docu_tipoitse,          
            docu_renorecibo,
            docu_renodj,
             
            docu_renodesc, 
            soit_id )
            
            VALUES (?, '1', '1', ?, ?);
        ";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $docu_tipoitse);
        // $sql->bindValue(2, $docu_renorecibo);
        // $sql->bindValue(3, $docu_renodj);
        $sql->bindValue(2, $docu_renodesc); //4
        $sql->bindValue(3, $soit_id); //5
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function insert_documento_ECSE_3000(
        $docu_tipoitse,
        $docu_ecsecertdesc, //11 
        $docu_ecsehorainicio,
        $docu_ecsefechainicio,
        $docu_ecsehorafin,
        $docu_ecsefechafin,
        $docu_ecsedesc, //5
        $soit_id
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_documento(
		
            docu_tipoitse,     --1
            
            docu_ecsedj,      --2
            docu_ecsecroquis,  --3
            docu_ecseplanoarq,  --4
            docu_ecsememoria,   --5
            docu_ecseprotoclo,  --6
            docu_ecsecostan,   --7
            docu_ecseplanseg,   -- 8
            docu_ecsedjinst,  --9
            docu_ecsejuego, --10
            docu_ecsecertitse,  --11

            docu_ecsecertdesc, --12
            docu_ecsehorainicio,  --13
            docu_ecsefechainicio, --14
            docu_ecsehorafin,  --15
            docu_ecsefechafin,  --16
            docu_ecsedesc, --17    
            soit_id  --18
            
            )
            
            VALUES (?, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', ?, ?, ?, ?, ?, ?, ?);";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $docu_tipoitse);


        $sql->bindValue(2, $docu_ecsecertdesc);
        $sql->bindValue(3, $docu_ecsehorainicio);
        $sql->bindValue(4, $docu_ecsefechainicio);
        $sql->bindValue(5, $docu_ecsehorafin);
        $sql->bindValue(6, $docu_ecsefechafin);
        $sql->bindValue(7, $docu_ecsedesc);
        $sql->bindValue(8, $soit_id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // INSERT TABLA DETALLE ANEXO  

    public function insert_detalle_anexo($soit_id, $aux_idesc, $comp_idesc, $tipo_anexo) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO sc_gitse3.tb_detalle_solicitud (soit_id, aux_idesc, comp_idesc, tipo_anexo) VALUES (?, ?, ?, ?)";
        $consulta = $conectar->prepare($sql);
    
        $consulta->bindValue(1, $soit_id, PDO::PARAM_INT);
        $consulta->bindValue(2, $aux_idesc, PDO::PARAM_STR);
        $consulta->bindValue(3, $comp_idesc, PDO::PARAM_STR);
        $consulta->bindValue(4, $tipo_anexo);
    
        $consulta->execute();
    }
    

    public function insert_detalle_anexo_text(

        $soit_id,
        $aux_idesc,
        $comp_idesc,
        $tipo_anexo,
        $desoli_text

    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_detalle_solicitud(
             soit_id, aux_idesc, comp_idesc, tipo_anexo ,desoli_text)
            VALUES ( ?, ?, ?, ?, ?);";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $soit_id);
        $sql->bindValue(2, $aux_idesc, PDO::PARAM_STR);
        $sql->bindValue(3, $comp_idesc, PDO::PARAM_STR);
        $sql->bindValue(4, $tipo_anexo);
        $sql->bindValue(5, $desoli_text);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function insert_detalle_anexo_2(

        $soit_id,
        $info_id,
        $aux_idesc,
        $comp_idesc,
        $tipo_anexo,
        $tipo_doc,
        $desoli_text
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_detalle_solicitud(
            soit_id, info_id, aux_idesc, comp_idesc, tipo_anexo, tipo_doc, desoli_text)
           VALUES ( ?, ?, ?, ?, ?, ?, ?);";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $soit_id);
        $sql->bindValue(2, $info_id);
        $sql->bindValue(3, $aux_idesc);
        $sql->bindValue(4, $comp_idesc);
        $sql->bindValue(5, $tipo_anexo);
        $sql->bindValue(6, $tipo_doc);
        $sql->bindValue(7, $desoli_text);
     
    
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    public function insert_detalle_anexo_text_tipDoc(

        $soit_id,
        $aux_idesc,
        $comp_idesc,
        $tipo_anexo,
        $desoli_text,
        $tipo_doc

    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_detalle_solicitud(
             soit_id, aux_idesc, comp_idesc, tipo_anexo ,desoli_text, tipo_doc)
            VALUES ( ?, ?, ?, ?, ?, ? );";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $soit_id);
        $sql->bindValue(2, $aux_idesc, PDO::PARAM_STR);
        $sql->bindValue(3, $comp_idesc, PDO::PARAM_STR);
        $sql->bindValue(4, $tipo_anexo);
        $sql->bindValue(5, $desoli_text);
        $sql->bindValue(6, $tipo_doc);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    // SELECT TABLA COMPONENTES---- en general

    public function get_componentes($comp_id, $comp_idesc)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT * FROM sc_gitse3.obtenerComponentes_compid_compidesc(?,?);";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $comp_id, PDO::PARAM_STR);
        $sql->bindValue(2, $comp_idesc, PDO::PARAM_STR);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function get_solicitud_limit_10_usuHomeAsesorTecnico($usuario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT soit.soit_id, soit.soit_funcion, soit.soit_numexpe,
        TO_CHAR(soit.soit_fechareg, 'YYYY-MM-DD HH24:MI:SS') AS fecha_registro,
        soli.soli_numdocident,
         soli.soli_apep,soli.soli_apem,soli.soli_nombre,
         esta.esta_ruc , soit.usuario_id
      FROM
        sc_gitse3.tb_solicitud_itse AS soit
        INNER JOIN sc_gitse3.tb_solicitante AS soli ON soit.soli_id = soli.soli_id
        inner join sc_gitse3.tb_establecimiento as esta ON soit.esta_id = esta.esta_id
		where soit.usuario_id = ?
      ORDER BY
        soit.soit_fechareg ASC
      LIMIT 10";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usuario_id);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }
    //	SET  estado_se1=?, estado_se2=?, estado_se3=?, estado_se4=?, estado_valor=?
    // WHERE soit_id = ?;


    public function update_detalle($aux_idesc, $comp_idesc, $desoli_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_gitse3.tb_detalle_solicitud
        SET aux_idesc =? , comp_idesc = ?
        where desoli_id = ?";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aux_idesc);
        $sql->bindValue(2, $comp_idesc);
        $sql->bindValue(3, $desoli_id);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function insert_estado_solicitud(
        $soit_id,
        $estado_se2,
        $estado_se3,
        $estado_se4,
        $estado_valor
    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO sc_gitse3.tb_estado(
            soit_id, estado_se2, estado_se3, estado_se4, estado_valor, fecha_crea)
           VALUES ( ?,  ?, ?, ?, ?, NOW()); ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $soit_id);
        $sql->bindValue(2, $estado_se2);
        $sql->bindValue(3, $estado_se3);
        $sql->bindValue(4, $estado_se4);
        $sql->bindValue(5, $estado_valor);

        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function update_estado_solicitud(

        $estado_se2,
        $estado_se3,
        $estado_se4,
        $estado_valor,
        $soit_id

    ) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE sc_gitse3.tb_estado
        SET   estado_se2=?, estado_se3=?, estado_se4=?, estado_valor=?
        WHERE soit_id = ?;";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $estado_se2);
        $sql->bindValue(2, $estado_se3);
        $sql->bindValue(3, $estado_se4);
        $sql->bindValue(4, $estado_valor);
        $sql->bindValue(5, $soit_id);

        // $sql->bindValue(2, $docu_recibopago);
        // $sql->bindValue(3, $docu_djcumpli);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    public function get_estado_solicitud($usuario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql =  "SELECT estado.estado_id, estado.soit_id, estado.estado_se2, estado.estado_se3, estado.estado_se4,
        estado.estado_valor, estado.fecha_crea, soit.soit_funcion, soit.usuario_id
        FROM sc_gitse3.tb_estado as estado
        INNER JOIN sc_gitse3.tb_solicitud_itse as soit ON soit.soit_id = estado.soit_id
        WHERE soit.usuario_id = ?
        ORDER BY estado.estado_id DESC
        LIMIT 1;
        ";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usuario_id);
        $sql->execute();

        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function get_solicitud_buscada($soit_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = " SELECT 
        -- solicitud itse 1/3
        soit.soit_id, soit.soit_tipoitse, soit.soit_funcion, soit.soit_clasiriesgo, soit.soit_organo, soit.soit_numexpe, 
        soit.soit_fechaproitse, soit.soit_fechaproecse, soit.soli_id, soit.esta_id,
					
	    -- solicitud itse 2/3    --- solicitante
         soli.soli_tipo, soli.soli_apep, soli.soli_apem, soli.soli_nombre, soli.soli_tipodoident, soli.soli_numdocident,
        soli.soli_domocilio, soli.soli_correo, soli.soli_telefono,
	 
        -- solicitud itse 3/3    --- establecimiento
        esta.esta_razsocial, esta.esta_ruc, esta.esta_nomcomer, esta.esta_tel, esta.esta_direccion, 
        esta.esta_referencia, esta.esta_localidad, esta.esta_horarioaten, esta.esta_giro, esta.ubig_id

         FROM sc_gitse3.tb_solicitud_itse as soit 
	
	      INNER JOIN sc_gitse3.tb_solicitante as soli ON soli.soli_id = soit.soli_id -- tabla solicitante
	
	    INNER JOIN sc_gitse3.tb_establecimiento as esta ON esta.esta_id = soit.esta_id -- tabla establecimiento

         WHERE soit.soit_id = ?";


        $sql = $conectar->prepare($sql);

        $sql->bindParam(1, $soit_id, PDO::PARAM_INT);
        $sql->execute();

        // Obtener los resultados
        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function get_tb_auxiliar_buscada($aux_itemcod, $aux_tipocod)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT aux_itemcod, aux_item, aux_tipocod, aux_tipo, aux_catacod, aux_cat, aux_idesc, aux_desc1, aux_desc2, aux_tipoanexo
        FROM sc_gitse3.tb_auxiliar__ where aux_itemcod = ? and  aux_tipocod = ? order by aux_idesc::int  asc";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aux_itemcod);
        $sql->bindValue(2, $aux_tipocod);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_anexo_detalle_id($soit_id, $tipo_anexo)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT desoli_id, soit_id, aux_idesc, comp_id, tipo_anexo
        FROM sc_gitse3.tb_detalle_solicitud where soit_id = ? and tipo_anexo = ? ;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $soit_id);
        $sql->bindValue(2, $tipo_anexo);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    // corregir , ue automaticamente tambien se ingrese el id y tambien el el tipo de anexo a devolber
    public function get_anexo_detalle_4_id_soit_id($soit_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_gitse3.obtener_declaracion_4_id_solicitud(?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $soit_id);

        $sql->execute();
        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function obtener_solicitud_general_anexos($soit_id, $tipo_anexo, $usuario_id)
    {

        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_gitse3.obtener_solicitud_general_anexos(?, ?, ?);";
        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $soit_id, PDO::PARAM_INT); // Assuming $soit_id is a bigint
        $sql->bindValue(2, $tipo_anexo, PDO::PARAM_STR); // Assuming $tipo_anexo is a varchar
        $sql->bindValue(3, $usuario_id, PDO::PARAM_INT); // Assuming $soit_id is a bigint

        $sql->execute();
        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function update_declaracion_anexo_4(

        $decla_funciona,
        $decla_capaci,
        $decla_edifianti,
        $decla_giroanti,

        $decla_areaterre,  //5
        $decla_areapiso1,
        $decla_areapiso2,
        $decla_areapiso3,
        $decla_areapiso4,
        $decla_areaotrospisos, //  5    -- 10
        $decla_areatechatotal,

        $decla_edifi1,
        $decla_edifi2,
        $decla_edifi3,
        $decla_edifi4,

        $decla_id,

        $pqs,
        $co2,
        $ack,
        $h2o,
        $otro_quimicos
    ) {

        //////////////
        $conectar = parent::conexion();
        parent::set_names();

        // $sql = "UPDATE sc_gitse3.tb_declaracion
        // SET  decla_funciona=?, decla_capaci=?, decla_edifianti=?, decla_giroanti=?, decla_areaterre=?,
        //  decla_areapiso1=?, decla_areapiso2=?, decla_areapiso3=?, decla_areapiso4=?, decla_areaotrospisos=?, 
        //  decla_areatechatotal=?, decla_areaocupatotal=?, decla_edifi1=?, decla_edifi2=?, decla_edifi3=?,
        //   decla_edifi4=? 

        // WHERE decla_id = ?;";

        $sql = "UPDATE sc_gitse3.tb_declaracion
        SET  decla_funciona=?, decla_capaci=?, decla_edifianti=?, decla_giroanti=? , decla_areaterre=? ,
        decla_areapiso1=? , decla_areapiso2=?, decla_areapiso3=?, decla_areapiso4=? , decla_areaotrospisos=? ,
        decla_areatechatotal=?, 
        decla_edifi1=?, decla_edifi2=?, decla_edifi3=?, decla_edifi4=? ,
        decla_pqs=?, decla_co2=?, decla_ack=?, decla_h2o=?, decla_otrosquimi=?
 

        WHERE decla_id = ?;";

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $decla_funciona, PDO::PARAM_STR);
        $sql->bindValue(2, $decla_capaci, PDO::PARAM_INT);
        $sql->bindValue(3, $decla_edifianti, PDO::PARAM_INT);
        $sql->bindValue(4, $decla_giroanti, PDO::PARAM_INT);

        $sql->bindValue(5, $decla_areaterre);
        $sql->bindValue(6, $decla_areapiso1);
        $sql->bindValue(7, $decla_areapiso2);
        $sql->bindValue(8, $decla_areapiso3);
        $sql->bindValue(9, $decla_areapiso4);
        $sql->bindValue(10, $decla_areaotrospisos);
        $sql->bindValue(11, $decla_areatechatotal);
        //
        $sql->bindValue(12, $decla_edifi1);
        $sql->bindValue(13, $decla_edifi2);
        $sql->bindValue(14, $decla_edifi3);
        $sql->bindValue(15, $decla_edifi4);

        //
        $sql->bindValue(16, $pqs, PDO::PARAM_STR);
        $sql->bindValue(17, $co2, PDO::PARAM_STR);
        $sql->bindValue(18, $ack, PDO::PARAM_STR);
        $sql->bindValue(19, $h2o, PDO::PARAM_STR);

        $sql->bindValue(20, $otro_quimicos, PDO::PARAM_STR);

        $sql->bindValue(21, $decla_id, PDO::PARAM_INT);
        $sql->execute();

        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

// Uso de la función mostrar_distritos
// $solicitud = new Solicitud();
// $solicitud->mostrar_distritos();
