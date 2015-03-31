
-- Volcando estructura para procedimiento permiso_alta
DROP PROCEDURE IF EXISTS `permiso_alta`;
DELIMITER //
CREATE  PROCEDURE `permiso_alta`(	
									`pi_permiso` VARCHAR(255) ,
									
									`pi_descripcion` VARCHAR(255) ,
									`pi_usuario_transaccion` INT(11) ,
									
									`pi_transaccion_creacion` INT(11) ,
									`pi_transaccion_modificacion` INT(11) ,
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
	
	SET nombre_proceso ='permiso_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
					INSERT INTO permiso (
									`permiso` ,
									`fecha_transaccion` ,
									`descripcion` ,
									`usuario_transaccion`  ,
									`estado_registro`  ,
									`transaccion_creacion`  ,
									`transaccion_modificacion` 
									)	
									VALUES
										(
										`pi_permiso` ,
										current_timestamp(),
										`pi_descripcion` ,
										`pi_usuario_transaccion`  ,
										'A'  ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion`              
							);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento permiso_modif
DROP PROCEDURE IF EXISTS `permiso_modif`;
DELIMITER //
CREATE  PROCEDURE `permiso_modif`(`pi_pk_id_permiso` INT(11),
									`pi_permiso` VARCHAR(255) ,
									
									`pi_descripcion` VARCHAR(255) ,
									`pi_usuario_transaccion` INT(11) ,
									
									`pi_transaccion_modificacion` INT(11),								
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
	
	SET nombre_proceso ='permiso_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update permiso set   
									`permiso`  = `pi_permiso` ,
									`fecha_transaccion`  = current_timestamp(),
									`descripcion` = `pi_descripcion` ,
									`usuario_transaccion` = `pi_usuario_transaccion`,
									`estado_registro` ='A',
									`transaccion_creacion` = `pi_transaccion_creacion` ,
									`transaccion_modificacion` = `pi_transaccion_modificacion` 
					where `pk_id_permiso`=`pi_pk_id_permiso`;			
									 
	      
      SET po_resultado = `pi_pk_id_permiso`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento permiso_baja
DROP PROCEDURE IF EXISTS `permiso_baja`;
DELIMITER //
CREATE  PROCEDURE `permiso_baja`( `pi_pk_id_permiso` INT(11),                                 
											`pi_usuario_transaccion` INT(11) ,											
											`pi_transaccion_modificacion` INT(11),
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
	
	SET nombre_proceso ='permiso_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update permiso set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`
					where `pk_id_permiso`=`pi_pk_id_permiso`;			
									 
	      
      SET po_resultado = `pi_pk_id_permiso`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;