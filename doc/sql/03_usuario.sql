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
                                                                                        pi_fk_id_rol INT(11),
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
									password(pi_llave)  ,
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
      
    -- Ingresar rol
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
										po_resultado  ,
										pi_fk_id_rol  ,
										current_timestamp() ,
										pi_usuario_transaccion ,
										'A'  ,
										pi_transaccion_creacion  ,
										pi_transaccion_modificacion  ,
										pi_fk_id_empresa                
							);
      
      SET po_resultado = concat(po_resultado,'|',LAST_INSERT_ID());
      SET v_cant_reg = v_cant_reg + ROW_COUNT();	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS usuario_modif;
DELIMITER //
CREATE  PROCEDURE usuario_modif( pi_pk_id_usuario INT(11),
                                 pi_usuario VARCHAR(255) ,
											pi_llave VARCHAR(255) ,
											pi_fk_id_persona INT(11) ,
											pi_cnf_base VARCHAR(32) ,											
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11) ,
											pi_fk_id_empresa INT(11),
                                                                                        pi_fk_id_rol INT(11),
                                                                                        pi_pk_id_usuario_rol INT(11) ,
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
        DECLARE aux_llave VARCHAR(250);

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
	
	SET nombre_proceso ='usuario_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;
      -- obtener la llave para compararla y ver si se repitio
      SELECT llave 
      INTO aux_llave 
      FROM usuario 
      WHERE pk_id_usuario = pi_pk_id_usuario;

      if(aux_llave != pi_llave ) then  
      update usuario set usuario  =pi_usuario,
									llave  = password(pi_llave),
									fk_id_persona=pi_fk_id_persona ,
									cnf_base =pi_cnf_base ,
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='A',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_usuario=pi_pk_id_usuario;			
     else 
      update usuario set usuario  =pi_usuario,
									fk_id_persona=pi_fk_id_persona ,
									cnf_base =pi_cnf_base ,
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='A',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_usuario=pi_pk_id_usuario;	
     end if;
	      
      SET po_resultado = pi_pk_id_usuario;
	  SET v_cant_reg = ROW_COUNT();
      -- para datos de usuario_rol
			  update usuario_rol set    fk_id_usuario =  pi_pk_id_usuario ,
										fk_id_rol = pi_fk_id_rol ,
										fecha_transaccion = current_timestamp(),
										usuario_transaccion = pi_usuario_transaccion,
										estado_registro  ='A',
										transaccion_modificacion  = pi_transaccion_modificacion ,
										fk_id_empresa = pi_fk_id_empresa 
					where pk_id_usuario_rol=pi_pk_id_usuario_rol;	  

      SET po_resultado = concat(po_resultado,'|',pi_pk_id_usuario_rol);
	  SET v_cant_reg = v_cant_reg + ROW_COUNT();

      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS usuario_modif_pwd;
DELIMITER //
CREATE  PROCEDURE usuario_modif_pwd( pi_llave VARCHAR(255),
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11) ,
											pi_pk_id_usuario INT(11) ,
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
        DECLARE aux_llave VARCHAR(250);

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
	
	SET nombre_proceso ='usuario_modif_pwd';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set 						llave  = password(pi_llave),
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									transaccion_modificacion  =pi_transaccion_modificacion
					where pk_id_usuario = pi_pk_id_usuario;			
	      
      SET po_resultado = pi_pk_id_usuario;
	  SET v_cant_reg = ROW_COUNT();

      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS usuario_baja;
DELIMITER //
CREATE  PROCEDURE usuario_baja( pi_pk_id_usuario INT(11),                                 
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11) ,
											pi_fk_id_empresa INT(11),
                                                                                        pi_pk_id_usuario_rol INT(11),
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
	
	SET nombre_proceso ='usuario_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  = pi_transaccion_modificacion,
									fk_id_empresa= pi_fk_id_empresa 	
					where pk_id_usuario = pi_pk_id_usuario;			
									 
	      
      SET po_resultado = pi_pk_id_usuario;
	  SET v_cant_reg = ROW_COUNT();

      update usuario_rol set fecha_transaccion = current_timestamp(),
									usuario_transaccion = pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  = pi_transaccion_modificacion,
									fk_id_empresa = pi_fk_id_empresa 
					where pk_id_usuario_rol=pi_pk_id_usuario_rol;	

      SET po_resultado = concat(po_resultado,'|',pi_pk_id_usuario_rol);
      SET v_cant_reg = v_cant_reg + ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;
