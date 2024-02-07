<?php
class Inspector extends Conectar
{

   public function get_solicitud_limit_10_inspSolicitudHome()
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
		-- where soit.usuario_id = ?
      ORDER BY
        soit.soit_fechareg ASC
      LIMIT 10";

        $sql = $conectar->prepare($sql);
        // $sql->bindValue(1, $usuario_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
        
    }

}