
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `archivo_alta`;
DELIMITER //
CREATE  PROCEDURE `archivo_alta`(
										`nombre` VARCHAR(255) ,
										`extension` VARCHAR(32),
										`bytes` DECIMAL(15,5) ,
										`ruta` VARCHAR(255) ,
										`ruta2` VARCHAR(255) ,
										`fk_id_tipo_archivo` INT(11) ,
										
										`usuario_transaccion` INT(11),
										
										`transaccion_creacion` INT(11) ,
										`transaccion_modificacion` INT(11) ,
										`fk_id_empresa` INT(11),
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
	
	SET nombre_proceso ='archivo_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO archivo (
										`nombre`  ,
										`extension` ,
										`bytes`  ,
										`ruta`  ,
										`ruta2`  ,
										`fk_id_tipo_archivo`  ,
										`fecha_transaccion`  ,
										`usuario_transaccion` ,
										`estado_registro`  ,
										`transaccion_creacion`  ,
										`transaccion_modificacion`  ,
										`fk_id_empresa`
                                )	
										VALUES
										(
										`nombre`  ,
										`extension` ,
										`bytes`  ,
										`ruta`  ,
										`ruta2`  ,
										`fk_id_tipo_archivo`  ,
										current_timestamp()  ,
										`usuario_transaccion` ,
										'A'  ,
										`transaccion_creacion`  ,
										`transaccion_modificacion`  ,
										`fk_id_empresa`                
							);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `archivo_modif`;
DELIMITER //
CREATE  PROCEDURE `archivo_modif`( `pk_id_archivo` INT(11) ,
									`nombre` VARCHAR(255) ,
									`extension` VARCHAR(32) ,
									`bytes` DECIMAL(15,5),
									`ruta` VARCHAR(255) ,
									`ruta2` VARCHAR(255) ,
									`fk_id_tipo_archivo` INT(11) ,
									
									`usuario_transaccion` INT(11) ,
									
									`transaccion_modificacion` INT(11) ,
									`fk_id_empresa` INT(11),												
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
	
	SET nombre_proceso ='archivo_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update archivo set        `nombre` =  `pi_nombre` ,
										`extension` = `pi_extension`,
										`bytes`  = `pi_bytes`,
										`ruta`  = `pi_ruta`,
										`ruta2`  = `pi_ruta2`,
										`fk_id_tipo_archivo` = `pi_fk_id_tipo_archivo` ,
										`fecha_transaccion` = current_timestamp() ,
										`usuario_transaccion` = `pi_usuario_transaccion`,
										`estado_registro` ='A' ,
										
										`transaccion_modificacion` = `pi_transaccion_modificacion` ,
										`fk_id_empresa` = `pi_fk_id_empresa` 
					where `pk_id_archivo`=`pi_pk_id_archivo`;			
									 
	      
      SET po_resultado = `pi_pk_id_archivo`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `archivo_baja`;
DELIMITER //
CREATE  PROCEDURE `archivo_baja`( `pi_pk_id_archivo` INT(11),                                 
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
	
	SET nombre_proceso ='archivo_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update archivo set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_archivo`=`pi_pk_id_archivo`;			
									 
	      
      SET po_resultado = `pi_pk_id_archivo`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

