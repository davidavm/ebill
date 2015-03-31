
-- Volcando estructura para procedimiento rol_alta
DROP PROCEDURE IF EXISTS usuario_rol_alta;
DELIMITER //
CREATE  PROCEDURE usuario_rol_alta(
									pi_fk_id_usuario INT(11) ,
									pi_fk_id_rol INT(11) ,
									
									pi_usuario_transaccion INT(11) ,
									
									pi_transaccion_creacion INT(11) ,
									pi_transaccion_modificacion INT(11) ,
									pi_fk_id_empresa INT(11),
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
	
	SET nombre_proceso ='usuario_rol_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
					INSERT INTO usuario_rol (
									fk_id_usuario  ,
									fk_id_rol  ,
									fecha_transaccion ,
									usuario_transaccion ,
									estado_registro  ,
									transaccion_creacion  ,
									transaccion_modificacion  ,
									fk_id_empresa 
									)	
									VALUES
										(
										pi_fk_id_usuario  ,
										pi_fk_id_rol  ,
										current_timestamp() ,
										pi_usuario_transaccion ,
										'A'  ,
										pi_transaccion_creacion  ,
										pi_transaccion_modificacion  ,
										pi_fk_id_empresa                
							);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento rol_modif
DROP PROCEDURE IF EXISTS usuario_rol_modif;
DELIMITER //
CREATE  PROCEDURE usuario_rol_modif( pk_id_usuario_rol INT(11) ,
									pi_fk_id_usuario INT(11) ,
									pi_fk_id_rol INT(11) ,
									
									pi_usuario_transaccion INT(11) ,
									
									pi_transaccion_modificacion INT(11) ,
									pi_fk_id_empresa INT(11),											
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
	
	SET nombre_proceso ='usuario_rol_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update usuario_rol set    fk_id_usuario =  pi_fk_id_usuario ,
										fk_id_rol = pi_fk_id_rol ,
										fecha_transaccion = current_timestamp(),
										usuario_transaccion = pi_usuario_transaccion,
										estado_registro  ='A',
										transaccion_creacion = pi_transaccion_creacion ,
										transaccion_modificacion  = pi_transaccion_modificacion ,
										fk_id_empresa = pi_fk_id_empresa 
					where pk_id_usuario_rol=pi_pk_id_usuario_rol;			
									 
	      
      SET po_resultado = pi_pk_id_usuario_rol;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento rol_baja
DROP PROCEDURE IF EXISTS usuario_rol_baja;
DELIMITER //
CREATE  PROCEDURE usuario_rol_baja( pi_pk_id_usuario_rol INT(11),                                 
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11),
                                            pi_fk_id_empresa INT(11),	
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
	
	SET nombre_proceso ='usuario_rol_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario_rol set fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa = pi_fk_id_empresa 
					where pk_id_usuario_rol=pi_pk_id_usuario_rol;			
									 
	      
      SET po_resultado = pi_pk_id_usuario_rol;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

