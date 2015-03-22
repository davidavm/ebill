
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `actividad_economica_alta`;
DELIMITER //
CREATE  PROCEDURE `actividad_economica_alta`(`pi_actividad_economica` CHAR(10) ,
											`pi_fk_id_clasificacion_tipo_actividad` INT(11) ,
											
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
	
	SET nombre_proceso ='actividad_economica_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO actividad_economica (`actividad_economica`  ,
											`fk_id_clasificacion_tipo_actividad`  ,
											`fecha_transaccion` ,
											`usuario_transaccion`  ,
											`estado_registro` ,
											`transaccion_creacion`  ,
											`transaccion_modificacion` ,
											`fk_id_empresa`  )	
									VALUES
									(
								            `pi_actividad_economica`  ,
											`pi_fk_id_clasificacion_tipo_actividad`  ,
											current_timestamp() ,
											`pi_usuario_transaccion`  ,
											'A' ,
											`pi_transaccion_creacion`  ,
											`pi_transaccion_modificacion` ,
											`pi_fk_id_empresa`               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `actividad_economica_modif`;
DELIMITER //
CREATE  PROCEDURE `actividad_economica_modif`( `pi_pk_id_actividad_economica` INT(11) ,
												`pi_actividad_economica` CHAR(10) ,
												`pi_fk_id_clasificacion_tipo_actividad` INT(11) ,
												
												`pi_usuario_transaccion` INT(11),
												
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
	
	SET nombre_proceso ='actividad_economica_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update actividad_economica set    `pk_id_actividad_economica` = `pi_pk_id_actividad_economica`,
												`actividad_economica` = `pi_actividad_economica`,
												`fk_id_clasificacion_tipo_actividad`  = `pi_fk_id_clasificacion_tipo_actividad`,
												`fecha_transaccion`  = current_timestamp(),
												`usuario_transaccion` = `pi_usuario_transaccion`,
												`estado_registro`  ='A',
												
												`transaccion_modificacion`  = `pi_transaccion_modificacion` ,
												`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_actividad_economica`=`pi_pk_id_actividad_economica`;			
									 
	      
      SET po_resultado = `pi_pk_id_actividad_economica`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `actividad_economica_baja`;
DELIMITER //
CREATE  PROCEDURE `actividad_economica_baja`( `pi_pk_id_actividad_economica` INT(11),                                 
											`pi_usuario_transaccion` INT(11) ,											
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
	
	SET nombre_proceso ='actividad_economica_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update actividad_economica set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_actividad_economica`=`pi_pk_id_actividad_economica`;			
									 
	      
      SET po_resultado = `pi_pk_id_actividad_economica`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



