-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS usuario_alta;
DELIMITER //
CREATE  PROCEDURE usuario_alta( pi_usuario VARCHAR(255) ,
											pi_llave VARCHAR(255) ,
											pi_fk_id_persona INT(11) ,
											pi_cnf_base VARCHAR(32) ,											
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
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='usuario_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO usuario (usuario  ,
									llave  ,
									fk_id_persona ,
									cnf_base  ,
									fecha_transaccion  ,
									usuario_transaccion  ,
									estado_registro  ,
									transaccion_creacion  ,
									transaccion_modificacion  ,
									fk_id_empresa)	
									VALUES
									(
									pi_usuario  ,
									pi_llave  ,
									pi_fk_id_persona  ,
									pi_cnf_base ,
									current_timestamp(), 
									pi_usuario_transaccion  ,
									'A', 
									pi_transaccion_creacion ,
									pi_transaccion_modificacion ,
									pi_fk_id_empresa                
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS usuario_modif;
DELIMITER //
CREATE  PROCEDURE usuario_modif( pk_id_usuario INT(11),
                                 pi_usuario VARCHAR(255) ,
											pi_llave VARCHAR(255) ,
											pi_fk_id_persona INT(11) ,
											pi_cnf_base VARCHAR(32) ,											
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
	
	SET nombre_proceso ='usuario_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set usuario  =pi_usuario,
									llave  = pi_llave,
									fk_id_persona=pi_fk_id_persona ,
									cnf_base =pi_cnf_base ,
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='A',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where id_usuario=pk_id_usuario;			
									 
	      
      SET po_resultado = pk_id_usuario;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS usuario_baja;
DELIMITER //
CREATE  PROCEDURE usuario_baja( pk_id_usuario INT(11),                                 
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
	
	SET nombre_proceso ='usuario_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where id_usuario=pk_id_usuario;			
									 
	      
      SET po_resultado = pk_id_usuario;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;
