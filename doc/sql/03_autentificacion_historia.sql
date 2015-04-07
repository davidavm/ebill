
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `autentificacion_historia_alta`;
DELIMITER //
CREATE  PROCEDURE `autentificacion_historia_alta`( 
													pi_ip_cliente                        VARCHAR(255),
													pi_host_cliente                      CHAR(10),
													pi_ip_servidor                       VARCHAR(255),
													pi_host_servidor                     CHAR(10),
													pi_puerto_servidor                   INT,
													pi_navegador                         VARCHAR(255),
													pi_varios                            VARCHAR(255),
													pi_fk_estado_autentificacion         INT,
													pi_fk_id_usuario                     INT,
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
	
	SET nombre_proceso ='autentificacion_historia_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO autentificacion_historia (fecha_autentificacion              ,
													ip_cliente                        ,
													host_cliente                      ,
													ip_servidor                       ,
													host_servidor                     ,
													puerto_servidor                   ,
													navegador                         ,
													varios                            ,
													fk_estado_autentificacion         ,
													fk_id_usuario                     ,
													fk_id_empresa )	
												VALUES
												(
												current_timestamp() ,
												pi_ip_cliente                        ,
												pi_host_cliente                      ,
												pi_ip_servidor                       ,
												pi_host_servidor                     ,
												pi_puerto_servidor                   ,
												pi_navegador                         ,
												pi_varios                            ,
												pi_fk_estado_autentificacion         ,
												pi_fk_id_usuario                     ,
												pi_fk_id_empresa              
												);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `autentificacion_historia_modif`;
DELIMITER //
CREATE  PROCEDURE `autentificacion_historia_modif`(  pi_pk_id_autentificacion_historia    INT             ,
													
													pi_ip_cliente                        VARCHAR(255),
													pi_host_cliente                      CHAR(10),
													pi_ip_servidor                       VARCHAR(255),
													pi_host_servidor                     CHAR(10),
													pi_puerto_servidor                   INT,
													pi_navegador                         VARCHAR(255),
													pi_varios                            VARCHAR(255),
													pi_fk_estado_autentificacion         INT,
													pi_fk_id_usuario                     INT,
													pi_fk_id_empresa                     INT,
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
	
	SET nombre_proceso ='autentificacion_historia_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update autentificacion_historia set           fecha_autentificacion = current_timestamp()              ,
													ip_cliente = pi_ip_cliente                       ,
													host_cliente = pi_host_cliente                      ,
													ip_servidor = pi_ip_servidor                       ,
													host_servidor = pi_host_servidor                     ,
													puerto_servidor = pi_puerto_servidor                   ,
													navegador   = pi_navegador                      ,
													varios = pi_varios                            ,
													fk_estado_autentificacion = pi_fk_estado_autentificacion         ,
													fk_id_usuario  = pi_fk_id_usuario                    ,
													fk_id_empresa = pi_fk_id_empresa
					where `pk_id_autentificacion_historia`=`pi_pk_id_autentificacion_historia`;			
									 
	      
      SET po_resultado = `pi_pk_id_autentificacion_historia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `autentificacion_historia_baja`;
DELIMITER //
CREATE  PROCEDURE `autentificacion_historia_baja`( `pi_pk_id_autentificacion_historia` INT(11),                                 
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
	
	SET nombre_proceso ='autentificacion_historia_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update autentificacion_historia set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_autentificacion_historia`=`pi_pk_id_autentificacion_historia`;			
									 
	      
      SET po_resultado = `pi_pk_id_autentificacion_historia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



