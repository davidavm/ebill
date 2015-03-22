
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `tipo_compra_alta`;
DELIMITER //
CREATE  PROCEDURE `tipo_compra_alta`(`pi_fk_id_opcion_tipo_compra` INT(11) ,
										`pi_cantidad_dias` INT(11) ,
										
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
	
	SET nombre_proceso ='tipo_compra_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO tipo_compra (
								`fk_id_opcion_tipo_compra`  ,
								`cantidad_dias` ,
								`fecha_transaccion` ,
								`usuario_transaccion`  ,
								`estado_registro`  ,
								`transaccion_creacion`  ,
								`transaccion_modificacion` ,
								`fk_id_empresa` 
                                )	
							VALUES
							(
								`pi_fk_id_opcion_tipo_compra`  ,
								`pi_cantidad_dias` ,
								current_timestamp() ,
								`pi_usuario_transaccion`  ,
								'A'  ,
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
DROP PROCEDURE IF EXISTS `tipo_compra_modif`;
DELIMITER //
CREATE  PROCEDURE `tipo_compra_modif`( 	`pi_pk_id_tipo_compra` INT(11) ,
										`pi_fk_id_opcion_tipo_compra` INT(11) ,
										`pi_cantidad_dias` INT(11) ,
										
										`pi_usuario_transaccion` INT(11) ,
										
										`pi_transaccion_modificacion` INT(11) ,
										`pi_fk_id_empresa` INT(11) ,												
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
	
	SET nombre_proceso ='tipo_compra_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update tipo_compra set  `fk_id_opcion_tipo_compra`  = `pi_fk_id_opcion_tipo_compra` ,
										`cantidad_dias`  = `pi_cantidad_dias`,
										`fecha_transaccion`  = current_timestamp(),
										`usuario_transaccion` = `pi_usuario_transaccion`  ,
										`estado_registro`  = 'A',
										
										`transaccion_modificacion` = `pi_transaccion_modificacion`,
										`fk_id_empresa` = 	`pi_fk_id_empresa` 
					where `pk_id_tipo_compra`=`pi_pk_id_tipo_compra`;			
									 
	      
      SET po_resultado = `pi_pk_id_tipo_compra`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `tipo_compra_baja`;
DELIMITER //
CREATE  PROCEDURE `tipo_compra_baja`( `pi_pk_id_tipo_compra` INT(11),                                 
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
	
	SET nombre_proceso ='tipo_compra_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update tipo_compra set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_tipo_compra`=`pi_pk_id_tipo_compra`;			
									 
	      
      SET po_resultado = `pi_pk_id_tipo_compra`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



