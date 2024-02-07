/* INSERT TIPO DE ITSE*/
INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '1', 'ITSE POSTERIOR AL INICIO DE ACTIVIDADES');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '2', 'ITSE PREVIA AL INICIO DE ACTIVIDADES');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '3', 'ECSE HASTA 3000 PERSONAS');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '4', 'ECSE MAYOR A 3000 PERSONAS');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '5', 'ITSE POSTERIOR');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('TIPOITSE', '6', 'ITSE PREVIA');

/* INSERT FUNCIONES*/
INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '1', 'ALMACEN');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '2', 'COMERCIO');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '3', 'EDUCACION');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '4', 'ENCUENTRO');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '5', 'HOSPEDAJE');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '6', 'INDUSTRIAL');
	/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '7', 'OFICINAS ADMINISTRATIVAS');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('FUNCION', '8', 'SALUD');

/* CLASI RIESGO FUNCIONES*/
INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('CLASIRIESGO', '1', 'ITSE Riesgo bajo');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('CLASIRIESGO', '2', 'ITSE Riesgo medio');
/* --------------------------------------------------------------------- */
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('CLASIRIESGO', '3', 'ITSE Riesgo alto');
/* --------------------------------------------------------------------- */	
	INSERT INTO sc_gitse3.tb_auxiliar(aux_tabla, aux_codigo, aux_desc)
	VALUES ('CLASIRIESGO', '4', 'ITSE Riesgo muy alto');



/*SELECT FROM*/
select * from sc_gitse3.tb_auxiliar


/* cambiar de tipo de dato a auna columna
ALTER TABLE mi_tabla
ALTER COLUMN mi_columna TYPE character varying(50);
*/
	