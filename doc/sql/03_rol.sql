
-- Volcando estructura para procedimiento rol_alta
DROP PROCEDURE IF EXISTS `rol_alta`;
DELIMITER //
CREATE  PROCEDURE `rol_alta`(
									`pi_rol` VARCHAR(128) ,
									`pi_descripcion` VARCHAR(255) ,
									
									`pi_usuario_transaccion` INT(11) ,
									
									`pi_transaccion_creacion` INT(11) ,
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
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES',    v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='rol_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
					INSERT INTO rol (
									`rol` ,
									`descripcion`  ,
									`fecha_transaccion`  ,
									`usuario_transaccion`  ,
									`estado_registro` ,
									`transaccion_creacion`  ,
									`transaccion_modificacion`
									)	
									VALUES
										(
										`pi_rol` ,
										`pi_descripcion`  ,
										current_timestamp()  ,
										`pi_usuario_transaccion`  ,
										'A' ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion`                
							);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



 Volcando estructura para procedimiento rol_modif
DROP PROCEDURE IF EXISTS `rol_modif`;
DELIMITER //
CREATE  PROCEDURE `rol_modif`( `pi_pk_id_rol` INT(11) ,
								`pi_rol` VARCHAR(128) ,
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
	
	SET nombre_proceso ='rol_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update rol set       `rol`  = `pi_rol`,
								`descripcion`  = `pi_descripcion`,
								`fecha_transaccion` = current_timestamp(),
								`usuario_transaccion` = `pi_usuario_transaccion`,
								`estado_registro`  ='A',
								
								`transaccion_modificacion`= `pi_transaccion_modificacion`
					where `pk_id_rol`=`pi_pk_id_rol`;			
									 
	      
      SET po_resultado = `pi_pk_id_rol`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento rol_baja
DROP PROCEDURE IF EXISTS `rol_baja`;
DELIMITER //
CREATE  PROCEDURE `rol_baja`( `pi_pk_id_rol` INT(11),                                 
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
	
	SET nombre_proceso ='rol_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update rol set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`
									
					where `pk_id_rol`=`pi_pk_id_rol`;			
									 
	      
      SET po_resultado = `pi_pk_id_rol`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;
