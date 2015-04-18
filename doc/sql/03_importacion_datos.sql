-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS importacion_datos_alta;
DELIMITER //
CREATE  PROCEDURE importacion_datos_alta(   pi_registros_leidos                INT,
                                            pi_registros_ingresados            INT,
                                            pi_registros_error                 INT,
                                            pi_mensaje_carga                   VARCHAR(255),
                                            pi_fk_id_tipo_importacion_datos    INT,
                                            pi_fk_id_archivo                   INT,
                                            
                                            pi_usuario_transaccion             INT,
                                           
                                            pi_transaccion_creacion            INT,
                                            pi_transaccion_modificacion        INT,
                                            pi_fk_id_empresa                   INT,
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
	
	SET nombre_proceso ='importacion_datos_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO importacion_datos (registros_leidos                ,
                                            registros_ingresados            ,
                                            registros_error                 ,
                                            mensaje_carga                   ,
                                            fk_id_tipo_importacion_datos    ,
                                            fk_id_archivo                   ,
                                            fecha_transaccion                      ,
                                            usuario_transaccion             ,
                                            estado_registro                 ,
                                            transaccion_creacion            ,
                                            transaccion_modificacion        ,
                                            fk_id_empresa )	
                                        VALUES
                                        (
                                            pi_registros_leidos                ,
                                            pi_registros_ingresados            ,
                                            pi_registros_error                 ,
                                            pi_mensaje_carga                   ,
                                            pi_fk_id_tipo_importacion_datos    ,
                                            pi_fk_id_archivo                   ,
                                            current_timestamp()                      ,
                                            pi_usuario_transaccion             ,
                                            'A'                 ,
                                            pi_transaccion_creacion            ,
                                            pi_transaccion_modificacion        ,
                                            pi_fk_id_empresa            
                        );

SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS importacion_datos_modif;
DELIMITER //
CREATE  PROCEDURE importacion_datos_modif(pk_id_importacion               INT             ,
                                        registros_leidos                INT,
                                        registros_ingresados            INT,
                                        registros_error                 INT,
                                        mensaje_carga                   VARCHAR(255),
                                        fk_id_tipo_importacion_datos    INT,
                                        fk_id_archivo                   INT,
                                        fecha_transaccion               DATETIME         ,
                                        usuario_transaccion             INT,
                                        estado_registro                 VARCHAR(32),
                                        transaccion_creacion            INT,
                                        transaccion_modificacion        INT,
                                        fk_id_empresa                   INT,
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
	
	SET nombre_proceso ='importacion_datos_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update importacion_datos set     
                    pk_id_importacion = pi_pk_id_importacion                           ,
                    registros_leidos   = pi_registros_leidos              ,
                    registros_ingresados    = pi_registros_ingresados         ,
                    registros_error   = pi_registros_error               ,
                    mensaje_carga  = pi_mensaje_carga                  ,
                    fk_id_tipo_importacion_datos  = pi_fk_id_tipo_importacion_datos   ,
                    fk_id_archivo  = pi_fk_id_archivo                  ,
                    fecha_transaccion   = current_timestamp()                     ,
                    usuario_transaccion  = pi_usuario_transaccion           ,
                    estado_registro    = 'A'             ,
                    
                    transaccion_modificacion  = pi_transaccion_modificacion       ,
                    fk_id_empresa  = pi_fk_id_empresa
    where pk_id_importacion = pi_pk_id_importacion;			


      SET po_resultado = pi_pk_id_importacion;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS importacion_datos_baja;
DELIMITER //
CREATE  PROCEDURE importacion_datos_baja( pi_pk_id_importacion INT(11),                                 
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
	
	SET nombre_proceso ='importacion_datos_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update importacion_datos set fecha_transaccion = current_timestamp(),
                    usuario_transaccion =pi_usuario_transaccion ,
                    estado_registro ='E',
                    transaccion_modificacion  =pi_transaccion_modificacion,
                    fk_id_empresa=pi_fk_id_empresa 	
      where pk_id_importacion=pi_pk_id_importacion;			


      SET po_resultado = pi_pk_id_importacion;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




