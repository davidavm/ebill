-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS rubro_alta;
DELIMITER //
CREATE  PROCEDURE rubro_alta( pi_rubro                       VARCHAR(255),
                                pi_descripcion                 TEXT,
                                
                                pi_usuario_transaccion         INT,
                                
                                pi_transaccion_creacion        INT,
                                pi_transaccion_modificacion    INT,
                                pi_fk_id_empresa               INT,
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
	
	SET nombre_proceso ='rubro_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO rubro (rubro                       ,
                                descripcion                 ,
                                fecha_transaccion                   ,
                                usuario_transaccion         ,
                                estado_registro             ,
                                transaccion_creacion        ,
                                transaccion_modificacion    ,
                                fk_id_empresa)	
                                VALUES
                                (
                                pi_rubro                       ,
                                pi_descripcion                 ,
                                current_timestamp()                   ,
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
DROP PROCEDURE IF EXISTS rubro_modif;
DELIMITER //
CREATE  PROCEDURE rubro_modif( pi_pk_id_rubro                 INT             ,
                                pi_rubro                       VARCHAR(255),
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
   
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='rubro_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update rubro set      
                                rubro   = pi_rubro                    ,
                                descripcion    = pi_descripcion              ,
                                fecha_transaccion   = current_timestamp()               ,
                                usuario_transaccion    = pi_usuario_transaccion      ,
                                estado_registro   = 'A'         ,
                                
                                transaccion_modificacion  = pi_transaccion_modificacion  ,
                                fk_id_empresa = pi_fk_id_empresa
		where pk_id_rubro=pi_pk_id_rubro;			
									 
	      
      SET po_resultado = pi_pk_id_rubro;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS rubro_baja;
DELIMITER //
CREATE  PROCEDURE rubro_baja( pi_pk_id_rubro INT(11),                                 
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
	
	SET nombre_proceso ='rubro_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update rubro set fecha_transaccion = current_timestamp(),
                    usuario_transaccion =pi_usuario_transaccion ,
                    estado_registro ='E',
                    transaccion_modificacion  =pi_transaccion_modificacion,
                    fk_id_empresa=pi_fk_id_empresa 	
            where pk_id_rubro=pi_pk_id_rubro;			
									 
	      
      SET po_resultado = pi_pk_id_rubro;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



