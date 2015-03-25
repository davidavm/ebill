
-- Volcando estructura para procedimiento bancarizacion_alta
DROP PROCEDURE IF EXISTS `bancarizacion_alta`;
DELIMITER //
CREATE  PROCEDURE `bancarizacion_alta`(	
									`pi_fk_id_tipo_bancarizacion` INT(11) ,
									`pi_periodo` VARCHAR(32) ,
									`pi_fk_id_modalidad_transaccion` INT(11) ,
									`fecha_fact_dui_fecha_doc` DATETIME,
									`pi_fk_id_tipo_transaccion` INT(11) ,
									`pi_nit_proveedor` VARCHAR(255) ,
									`pi_razon_social_proveedor` VARCHAR(255) ,
									`pi_numero_fact_dui_numero_doc` INT(11) ,
									`pi_monto_fact_dui_monto_doc` DECIMAL(15,5) ,
									`pi_nro_aut_fact_dui_documento` INT(11) ,
									`pi_numero_cuenta_doc_pago` INT(11) ,
									`pi_monto_pagado_doc_pago` DECIMAL(15,5) ,
									`pi_monto_acumulado` DECIMAL(15,5) ,
									`pi_fk_id_nit_entidad_financiera` INT(11) ,
									`pi_numero_documento_pago` INT(11) ,
									`pi_fecha_documento_pago` DATETIME,
									`pi_fk_id_tipo_documento` INT(11) ,
									
									`pi_usuario_transaccion` INT(11) ,
									
									`pi_transaccion_creacion` INT(11) ,
									`pi_transaccion_modificacion` INT(11) ,
									`pi_fk_id_empresa` INT(11),
									OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES',    v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='bancarizacion_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
					INSERT INTO bancarizacion (
									`fk_id_tipo_bancarizacion` ,
									`periodo`,
									`fk_id_modalidad_transaccion` ,
									`fecha_fact_dui_fecha_doc` ,
									`fk_id_tipo_transaccion` ,
									`nit_proveedor` ,
									`razon_social_proveedor` ,
									`numero_fact_dui_numero_doc`  ,
									`monto_fact_dui_monto_doc` ,
									`nro_aut_fact_dui_documento` ,
									`numero_cuenta_doc_pago`  ,
									`monto_pagado_doc_pago`  ,
									`monto_acumulado` ,
									`fk_id_nit_entidad_financiera`  ,
									`numero_documento_pago`  ,
									`fecha_documento_pago` ,
									`fk_id_tipo_documento` ,
									`fecha_transaccion` ,
									`usuario_transaccion`  ,
									`estado_registro` ,
									`transaccion_creacion`  ,
									`transaccion_modificacion`  ,
									`fk_id_empresa`
									)	
									VALUES
										(
										`pi_fk_id_tipo_bancarizacion` ,
										`pi_periodo`,
										`pi_fk_id_modalidad_transaccion` ,
										`pi_fecha_fact_dui_fecha_doc` ,
										`pi_fk_id_tipo_transaccion` ,
										`pi_nit_proveedor` ,
										`pi_razon_social_proveedor` ,
										`pi_numero_fact_dui_numero_doc`  ,
										`pi_monto_fact_dui_monto_doc` ,
										`pi_nro_aut_fact_dui_documento` ,
										`pi_numero_cuenta_doc_pago`  ,
										`pi_monto_pagado_doc_pago`  ,
										`pi_monto_acumulado` ,
										`pi_fk_id_nit_entidad_financiera`  ,
										`pi_numero_documento_pago`  ,
										`pi_fecha_documento_pago` ,
										`pi_fk_id_tipo_documento` ,
										current_timestamp() ,
										`pi_usuario_transaccion`  ,
										'A' ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion`  ,
										`pi_fk_id_empresa`          
										);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;




-- Volcando estructura para procedimiento bancarizacion_modif
DROP PROCEDURE IF EXISTS `bancarizacion_modif`;
DELIMITER //
CREATE  PROCEDURE `bancarizacion_modif`(`pi_pk_id_bancarizacion` INT(11) ,
									`pi_fk_id_tipo_bancarizacion` INT(11) ,
									`pi_periodo` VARCHAR(32) ,
									`pi_fk_id_modalidad_transaccion` INT(11) ,
									`fecha_fact_dui_fecha_doc` DATETIME,
									`pi_fk_id_tipo_transaccion` INT(11) ,
									`pi_nit_proveedor` VARCHAR(255) ,
									`pi_razon_social_proveedor` VARCHAR(255) ,
									`pi_numero_fact_dui_numero_doc` INT(11) ,
									`pi_monto_fact_dui_monto_doc` DECIMAL(15,5) ,
									`pi_nro_aut_fact_dui_documento` INT(11) ,
									`pi_numero_cuenta_doc_pago` INT(11) ,
									`pi_monto_pagado_doc_pago` DECIMAL(15,5) ,
									`pi_monto_acumulado` DECIMAL(15,5) ,
									`pi_fk_id_nit_entidad_financiera` INT(11) ,
									`pi_numero_documento_pago` INT(11) ,
									`pi_fecha_documento_pago` DATETIME,
									`pi_fk_id_tipo_documento` INT(11) ,
									
									`pi_usuario_transaccion` INT(11) ,
									
									`pi_transaccion_creacion` INT(11) ,
									`pi_transaccion_modificacion` INT(11) ,
									`pi_fk_id_empresa` INT(11),							
									OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
   
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='bancarizacion_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update bancarizacion set   
										`fk_id_tipo_bancarizacion` = `pi_fk_id_tipo_bancarizacion`,
										`periodo`= `pi_periodo`,
										`fk_id_modalidad_transaccion` = `pi_fk_id_modalidad_transaccion`,
										`fecha_fact_dui_fecha_doc` = `pi_fecha_fact_dui_fecha_doc`,
										`fk_id_tipo_transaccion` = `pi_fk_id_tipo_transaccion`,
										`nit_proveedor` = `pi_nit_proveedor`,
										`razon_social_proveedor` = `pi_razon_social_proveedor` ,
										`numero_fact_dui_numero_doc`  = `pi_numero_fact_dui_numero_doc`,
										`monto_fact_dui_monto_doc` = `pi_monto_fact_dui_monto_doc`,
										`nro_aut_fact_dui_documento` = `pi_nro_aut_fact_dui_documento`,
										`numero_cuenta_doc_pago`  = `pi_numero_cuenta_doc_pago`,
										`monto_pagado_doc_pago`  = `pi_monto_pagado_doc_pago`,
										`monto_acumulado` = `pi_monto_acumulado`,
										`fk_id_nit_entidad_financiera` = `pi_fk_id_nit_entidad_financiera` ,
										`numero_documento_pago`  = `pi_numero_documento_pago`,
										`fecha_documento_pago` = `pi_fecha_documento_pago`,
										`fk_id_tipo_documento` = `pi_fk_id_tipo_documento`,
										`fecha_transaccion` = current_timestamp(),
										`usuario_transaccion`  = `pi_usuario_transaccion`,
										`estado_registro` ='A',
										
										`transaccion_modificacion`  = `pi_transaccion_modificacion` ,
										`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_bancarizacion`=`pi_pk_id_bancarizacion`;			
									 
	      
      SET po_resultado = `pi_pk_id_bancarizacion`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento bancarizacion_baja
DROP PROCEDURE IF EXISTS `bancarizacion_baja`;
DELIMITER //
CREATE  PROCEDURE `usuario_permiso_baja`( `pi_pk_id_bancarizacion` INT(11),                                 
											`pi_usuario_transaccion` INT(11) ,											
											`pi_transaccion_modificacion` INT(11),
                                            `pi_fk_id_empresa` INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='bancarizacion_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update bancarizacion set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
                                    `fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_bancarizacion`=`pi_pk_id_bancarizacion`;			
									 
	      
      SET po_resultado = `pi_pk_id_bancarizacion`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


