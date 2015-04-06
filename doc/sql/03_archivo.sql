
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS archivo_alta;
DELIMITER //
CREATE  PROCEDURE archivo_alta(
                                pi_nombre VARCHAR(255) ,
                                pi_extension VARCHAR(32),
                                pi_bytes DECIMAL(15,5) ,
                                pi_mime VARCHAR(255) ,
                                pi_ruta VARCHAR(255) ,
                                pi_ruta2 VARCHAR(255) ,
                                pi_fk_id_tipo_archivo INT(11) ,

                                pi_usuario_transaccion INT(11),

                                pi_transaccion_creacion INT(11) ,
                                pi_transaccion_modificacion INT(11) ,
                                pi_fk_id_empresa INT(11),
                                        OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='archivo_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO archivo (
										nombre  ,
										extension ,
										bytes  ,
                                                                                mime,
										ruta  ,
										ruta2  ,
										fk_id_tipo_archivo  ,
										fecha_transaccion  ,
										usuario_transaccion ,
										estado_registro  ,
										transaccion_creacion  ,
										transaccion_modificacion  ,
										fk_id_empresa
                                )	
										VALUES
										(
										pi_nombre  ,
										pi_extension ,
										pi_bytes  ,
                                                                                pi_mime,
										pi_ruta  ,
										pi_ruta2  ,
										pi_fk_id_tipo_archivo  ,
										current_timestamp()  ,
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



-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS archivo_modif;
DELIMITER //
CREATE  PROCEDURE archivo_modif( pi_pk_id_archivo INT(11) ,
                                    pi_nombre VARCHAR(255) ,
                                    pi_extension VARCHAR(32) ,
                                    pi_bytes DECIMAL(15,5),
                                    pi_mime VARCHAR(255) ,
                                    pi_ruta VARCHAR(255) ,
                                    pi_uta2 VARCHAR(255) ,
                                    pi_fk_id_tipo_archivo INT(11) ,

                                    pi_usuario_transaccion INT(11) ,

                                    pi_transaccion_modificacion INT(11) ,
                                    pi_fk_id_empresa INT(11),												
                                    OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);

        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
   
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='archivo_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
			  update archivo set        nombre =  pi_nombre ,
										extension = pi_extension,
										bytes  = pi_bytes,
                                                                                mime = pi_mime,
										ruta  = pi_ruta,
										ruta2  = pi_ruta2,
										fk_id_tipo_archivo = pi_fk_id_tipo_archivo ,
										fecha_transaccion = current_timestamp() ,
										usuario_transaccion = pi_usuario_transaccion,
										estado_registro ='A' ,
										
										transaccion_modificacion = pi_transaccion_modificacion ,
										fk_id_empresa = pi_fk_id_empresa 
					where pk_id_archivo=pi_pk_id_archivo;			
									 
	      
      SET po_resultado = pi_pk_id_archivo;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS archivo_baja;
DELIMITER //
CREATE  PROCEDURE archivo_baja( pi_pk_id_archivo INT(11),                                 
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11) ,
											pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);

        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='archivo_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update archivo set fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_archivo=pi_pk_id_archivo;			
									 
	      
      SET po_resultado = pi_pk_id_archivo;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	
END//
DELIMITER ;

