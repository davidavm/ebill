
-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS `cliente_frecuencia_alta`;

CREATE  PROCEDURE `cliente_frecuencia_alta`(pi_razon_social                VARCHAR(255),
                                            pi_nit                         VARCHAR(255),
                                            pi_categoria                   VARCHAR(255),
                                            pi_fecha_ingreso               DATETIME         ,
                                            pi_fk_id_categoria             INT,
                                            pi_fk_id_cliente               INT              ,
                                           
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
	
	SET nombre_proceso ='cliente_frecuencia_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO cliente_frecuencia (razon_social               ,
                                            nit                        ,
                                            categoria                  ,
                                            fecha_ingreso                        ,
                                            fk_id_categoria             ,
                                            fk_id_cliente                             ,
                                            fecha_transaccion                    ,
                                            usuario_transaccion         ,
                                            estado_registro            ,
                                            transaccion_creacion        ,
                                            transaccion_modificacion    ,
                                            fk_id_empresa )	
                        VALUES
                        (
                            pi_razon_social               ,
                            pi_nit                        ,
                            pi_categoria                  ,
                            pi_fecha_ingreso                        ,
                            pi_fk_id_categoria             ,
                            pi_fk_id_cliente                             ,
                            current_timestamp()                    ,
                            pi_usuario_transaccion         ,
                            'A'            ,
                            pi_transaccion_creacion        ,
                            pi_transaccion_modificacion    ,
                            pi_fk_id_empresa              
                );

SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END;


-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS `cliente_frecuencia_modif`;

CREATE  PROCEDURE `cliente_frecuencia_modif`( pi_pk_id_frecuencia_cliente    INT             ,
                                            pi_razon_social                VARCHAR(255),
                                            pi_nit                         VARCHAR(255),
                                            pi_categoria                   VARCHAR(255),
                                            pi_fecha_ingreso               DATETIME        ,
                                            pi_fk_id_categoria             INT,
                                            pi_fk_id_cliente               INT             ,
                                            
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
	
	SET nombre_proceso ='cliente_frecuencia_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update cliente_frecuencia set  
                                            razon_social = pi_razon_social               ,
                                            nit     = pi_nit                    ,
                                            categoria     = pi_categoria               ,
                                            fecha_ingreso = pi_fecha_ingreso                       ,
                                            fk_id_categoria  = pi_fk_id_categoria            ,
                                            fk_id_cliente    = pi_fk_id_cliente                         ,
                                            fecha_transaccion   = current_timestamp()                ,
                                            usuario_transaccion  = pi_usuario_transaccion       ,
                                            estado_registro  ='A'           ,
                                           
                                            transaccion_modificacion  = pi_transaccion_modificacion  ,
                                            fk_id_empresa  = pi_fk_id_empresa
    where `pk_id_cliente_frecuencia`=`pi_pk_id_cliente_frecuencia`;			


      SET po_resultado = `pi_pk_id_cliente_frecuencia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `cliente_frecuencia_baja`;
DELIMITER //
CREATE  PROCEDURE `cliente_frecuencia_baja`( `pi_pk_id_cliente_frecuencia` INT(11),                                 
                                `pi_usuario_transaccion` INT(11) ,											
                                `pi_transaccion_modificacion` INT(11) ,
                                `pi_fk_id_empresa` INT(11),
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
	
	SET nombre_proceso ='cliente_frecuencia_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update cliente_frecuencia set `fecha_transaccion` = current_timestamp(),
                    `usuario_transaccion` =`pi_usuario_transaccion` ,
                    `estado_registro` ='E',
                    `transaccion_modificacion`  =`pi_transaccion_modificacion`,
                    `fk_id_empresa`=`pi_fk_id_empresa` 	
      where `pk_id_cliente_frecuencia`=`pi_pk_id_cliente_frecuencia`;			


      SET po_resultado = `pi_pk_id_cliente_frecuencia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



