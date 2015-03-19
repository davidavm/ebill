-- Volcando estructura para procedimiento persona_alta
DROP PROCEDURE IF EXISTS persona_alta;
DELIMITER //
CREATE  PROCEDURE persona_alta(  pi_nombres VARCHAR(255) ,
												pi_apellido_paterno VARCHAR(255),
												pi_apellido_materno VARCHAR(255) ,
												pi_fk_tipo_documento_identidad INT(11) ,
												pi_numero_identidad VARCHAR(255) ,
												pi_fk_departamento_expedicion_doc INT(11) ,												
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
	
	SET nombre_proceso ='persona_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO persona ( nombres ,
									apellido_paterno ,
									apellido_materno  ,
									fk_tipo_documento_identidad  ,
									numero_identidad  ,
									fk_departamento_expedicion_doc ,
									fecha_transaccion  ,
									usuario_transaccion  ,
									estado_registro  ,
									transaccion_creacion  ,
									transaccion_modificacion  ,
									fk_id_empresa)	
									VALUES
									(
									pi_nombres  ,
									pi_apellido_paterno ,
									pi_apellido_materno  ,
									pi_fk_tipo_documento_identidad  ,
									pi_numero_identidad  ,
									pi_fk_departamento_expedicion_doc,
									current_timestamp(),
									pi_usuario_transaccion  ,									
									pi_transaccion_creacion  ,
									pi_transaccion_modificacion ,
									pi_fk_id_empresa               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

-- modificacion persona
DROP PROCEDURE IF EXISTS persona_modif;
DELIMITER //
CREATE  PROCEDURE persona_modif(  pk_id_persona INT(11),
												pi_nombres VARCHAR(255) ,
												pi_apellido_paterno VARCHAR(255),
												pi_apellido_materno VARCHAR(255) ,
												pi_fk_tipo_documento_identidad INT(11) ,
												pi_numero_identidad VARCHAR(255) ,
												pi_fk_departamento_expedicion_doc INT(11) ,												
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
	
	SET nombre_proceso ='persona_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update persona 
							  set nombres =pi_nombres,
									apellido_paterno =pi_apellido_paterno,
									apellido_materno = pi_apellido_materno ,
									fk_tipo_documento_identidad  =pi_fk_tipo_documento_identidad,
									numero_identidad = pi_numero_identidad,
									fk_departamento_expedicion_doc =pi_fk_departamento_expedicion_doc ,
									fecha_transaccion  =current_timestamp(),
									usuario_transaccion  =pi_usuario_transaccion ,
									estado_registro  ='A',
									transaccion_modificacion = 	pi_transaccion_modificacion  ,
									fk_id_empresa = pi_fk_id_empresa 
	 where pk_id_persona = pi_pk_id_persona;
	      
    SET po_resultado = pi_pk_id_persona;
	 SET v_cant_reg = ROW_COUNT();
	  
    COMMIT;

    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END//
DELIMITER ;


-- baja presona

DROP PROCEDURE IF EXISTS persona_baja;
DELIMITER //
CREATE  PROCEDURE persona_baja(   pk_id_persona INT(11),																							
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
	
	SET nombre_proceso ='persona_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update persona 
							  set fecha_transaccion  =current_timestamp(),
									usuario_transaccion  =pi_usuario_transaccion ,
									estado_registro  ='E',
									transaccion_modificacion = 	pi_transaccion_modificacion  ,
									fk_id_empresa = pi_fk_id_empresa 
	 where pk_id_persona = pi_pk_id_persona;
	      
    SET po_resultado = pi_pk_id_persona;
	 SET v_cant_reg = ROW_COUNT();
	  
    COMMIT;
	  
    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END//
DELIMITER ;

