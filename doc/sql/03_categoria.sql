-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS categoria_alta;
DELIMITER //
CREATE  PROCEDURE categoria_alta( pi_categoria   VARCHAR(255),
                                    pi_descripcion                 TEXT,
                                    
                                    pi_usuario_transaccion         INT,
                                    
                                    pi_transaccion_creacion        INT,
                                    pi_transaccion_modificacion    INT,
                                    pi_fk_id_empresa INT,
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
	
	SET nombre_proceso ='categoria_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO categoria (categoria   ,
                                    descripcion                 ,
                                    fecha_transaccion            ,
                                    usuario_transaccion         ,
                                    estado_registro             ,
                                    transaccion_creacion        ,
                                    transaccion_modificacion    ,
                                    fk_id_empresa )	
                                    VALUES
                                    (
                                    pi_categoria   ,
                                    pi_descripcion                 ,
                                    current_timestamp()            ,
                                    pi_usuario_transaccion         ,
                                    'A'             ,
                                    pi_transaccion_creacion        ,
                                    pi_transaccion_modificacion    ,
                                    pi_fk_id_empresa              
                            );
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS categoria_modif;
DELIMITER //
CREATE  PROCEDURE categoria_modif(    pi_pk_id_categoria             INT             ,
                                        pi_categoria                   VARCHAR(255),
                                        pi_descripcion                 TEXT,
                                        
                                        pi_usuario_transaccion         INT,
                                       
                                        pi_transaccion_modificacion    INT,
                                        pi_fk_id_empresa               INT,
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
	
	SET nombre_proceso ='categoria_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update categoria set             
                            categoria  = pi_categoria                 ,
                            descripcion    = pi_descripcion              ,
                            fecha_transaccion  = current_timestamp()                 ,
                            usuario_transaccion  = pi_usuario_transaccion        ,
                            estado_registro  ='A'           ,
                            transaccion_modificacion  = pi_transaccion_modificacion  ,
                            fk_id_empresa =pi_fk_id_empresa
where pk_id_categoria=pi_pk_id_categoria;			

	      
      SET po_resultado = pi_pk_id_categoria;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS categoria_baja;
DELIMITER //
CREATE  PROCEDURE categoria_baja( pi_pk_id_categoria INT(11),                                 
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
	
	SET nombre_proceso ='categoria_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update categoria set fecha_transaccion = current_timestamp(),
                        usuario_transaccion =pi_usuario_transaccion ,
                        estado_registro ='E',
                        transaccion_modificacion  =pi_transaccion_modificacion,
                        fk_id_empresa=pi_fk_id_empresa 	
where pk_id_categoria=pi_pk_id_categoria;			
									 
	      
      SET po_resultado = pi_pk_id_categoria;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


