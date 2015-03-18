DROP  TABLE IF EXISTS `aud_log_procesos`;
-- Volcando estructura para tabla aud_log_procesos
CREATE TABLE `aud_log_procesos` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proceso` text NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `comentario` text,
  `cantidad` int(11) DEFAULT NULL,
  `correcto` varchar(1) DEFAULT NULL,
  `usuario` text,
  `ip` text,
  `param` text,
  `param_value` text,
  `package` text,
  `operacion` text,
  `sql` text,
  `sql_data` text,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de registro de logs';


-- Volcando estructura para procedimiento audit_insert
DELIMITER //
DROP  PROCEDURE IF EXISTS `audit_insert`;
CREATE PROCEDURE `audit_insert`(IN `v_nombre_proceso` TEXT, IN `v_fecha_inicio` DATETIME, OUT `po_resultado` INT)
BEGIN
  	DECLARE v_id INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
	END;
    
    START TRANSACTION;
     INSERT INTO aud_log_procesos
      (nombre_proceso,
       fecha_inicio       
       )
    VALUES
      (
       v_nombre_proceso,
       v_fecha_inicio
		 );
		          
      SET po_resultado = LAST_INSERT_ID();
      COMMIT;          
END//
DELIMITER ;


-- Volcando estructura para procedimiento audit_update
DELIMITER //
DROP  PROCEDURE IF EXISTS `audit_update`;
CREATE PROCEDURE `audit_update`(IN `v_id_log` INT, IN `v_fecha_fin` DATETIME, IN `v_comentario` TEXT, IN `v_cant_reg` INT, IN `v_correcto` VARCHAR(50), OUT `po_resultado` INT)
BEGIN
 	DECLARE v_id INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
	END;
    
    START TRANSACTION;
    
    update aud_log_procesos
       set fecha_fin    = v_fecha_fin,
           comentario = v_comentario,
           cantidad   = v_cant_reg,
           correcto   = v_correcto
     where id_log = v_id_log;
    commit;
    
    SET po_resultado = 0;
    
END//
DELIMITER ;


-- Volcando estructura para procedimiento empresa_alta
DROP PROCEDURE IF EXISTS `empresa_alta`;
DELIMITER //
CREATE  PROCEDURE `empresa_alta`(IN `pi_empresa` VARCHAR(255), 
											IN `pi_nombre_corto` VARCHAR(255), 
											IN `pi_razon_social` VARCHAR(255), 
											IN `pi_nit` INT, 
											IN `pi_direccion` TEXT, 
											IN `pi_telefono1` VARCHAR(32), 
											IN `pi_telefono2` VARCHAR(32),
										    IN `pi_telefono3` VARCHAR(32),
											IN `pi_fk_id_departamento` INT, 
										    IN `pi_fk_id_municipio` INT,
										    IN	`pi_fk_id_tipo_actividad` INT(11) ,
											IN	`pi_fk_id_tipo_formato_factura` INT(11),
											IN	`pi_fk_tipo_empresa` INT(11) ,
											IN	`pi_fk_tipo_razon_social` INT(11) ,											
											IN	`pi_fk_id_usuario` INT(11) ,											
											IN	`pi_transaccion_creacion` INT(11) ,
											IN	`pi_transaccion_modificacion` INT(11),
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
	
	SET nombre_proceso ='empresa_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO empresa (`empresa` ,
						   `nombre_corto` , 
							`razon_social` ,
							`nit` ,
							`direccion` ,
							`telefono1` ,
							`telefono2`,
							`telefono3` ,
							`fk_id_departamento` ,
							`fk_id_municipio` ,
							`fk_id_tipo_actividad` ,
							`fk_id_tipo_formato_factura` ,
							`fk_tipo_empresa` ,
							`fk_tipo_razon_social` ,
							`fecha_transaccion` ,
							`fk_id_usuario` ,
							`estado_registro` ,
							`transaccion_creacion` ,
							`transaccion_modificacion`)	
							VALUES
							(
							`pi_empresa` , 
							`pi_nombre_corto` , 
							`pi_razon_social` , 
						    `pi_nit` , 
							`pi_direccion` , 
							`pi_telefono1` , 
							`pi_telefono2` ,
						    `pi_telefono3` ,
							`pi_fk_id_departamento` , 
							`pi_fk_id_municipio` ,
							`pi_fk_id_tipo_actividad`  ,
							`pi_fk_id_tipo_formato_factura`  ,
							`pi_fk_tipo_empresa` ,
							`pi_fk_tipo_razon_social`  ,
							current_timestamp(), 
							`pi_fk_id_usuario`  ,
							'A', 
							`pi_transaccion_creacion`  ,
							`pi_transaccion_modificacion`                 
        );
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
      
	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


-- modificacion empresa
DROP PROCEDURE IF EXISTS `empresa_modif`;
DELIMITER //
CREATE  PROCEDURE `empresa_modif`(IN `pi_pk_id_empresa` INT(11),
                                 IN `pi_empresa` VARCHAR(255), 
											IN `pi_nombre_corto` VARCHAR(255), 
											IN `pi_razon_social` VARCHAR(255), 
											IN `pi_nit` INT, 
											IN `pi_direccion` TEXT, 
											IN `pi_telefono1` VARCHAR(32), 
											IN `pi_telefono2` VARCHAR(32),
										    IN `pi_telefono3` VARCHAR(32),
											IN `pi_fk_id_departamento` INT, 
										    IN `pi_fk_id_municipio` INT,
										    IN	`pi_fk_id_tipo_actividad` INT(11) ,
											IN	`pi_fk_id_tipo_formato_factura` INT(11),
											IN	`pi_fk_tipo_empresa` INT(11) ,
											IN	`pi_fk_tipo_razon_social` INT(11) ,											
											IN	`pi_fk_id_usuario` INT(11) ,																					
											IN	`pi_transaccion_modificacion` INT(11),
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
	
	SET nombre_proceso ='empresa_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update empresa set `empresa`=`pi_empresa` ,
							`nombre_corto` =`pi_nombre_corto` ,
							`razon_social` =`pi_razon_social`,
							`nit`=`pi_nit` ,
							`direccion` =`pi_direccion`,
							`telefono1`=`pi_telefono1` ,
							`telefono2`=`pi_telefono2`,
							`telefono3` = `pi_telefono3`,
							`fk_id_departamento` =`pi_fk_id_departamento`,
							`fk_id_municipio` = `pi_fk_id_municipio`,
							`fk_id_tipo_actividad`=`pi_fk_id_tipo_actividad` ,
							`fk_id_tipo_formato_factura`=`pi_fk_id_tipo_formato_factura` ,
							`fk_tipo_empresa` =`pi_fk_tipo_empresa`,
							`fk_tipo_razon_social`=`pi_fk_tipo_razon_social` ,
							`fecha_transaccion` =current_timestamp(), 
							`fk_id_usuario` =`pi_fk_id_usuario` ,
							`estado_registro`=	'A',
							`transaccion_modificacion`=	`pi_transaccion_modificacion`	
				where `pk_id_empresa`= `pi_pk_id_empresa`;			
			
      SET po_resultado = `pi_pk_id_empresa`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);    
	
END//
DELIMITER ;



-- baja empresa
DROP PROCEDURE IF EXISTS `empresa_baja`;
DELIMITER //
CREATE  PROCEDURE `empresa_baja`(IN `pi_pk_id_empresa` INT(11),                                 
											IN	`pi_fk_id_usuario` INT(11) ,											
											IN	`pi_transaccion_modificacion` INT(11),
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
	
	SET nombre_proceso ='empresa_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update empresa set 
							`fecha_transaccion` = current_timestamp(),
							`fk_id_usuario` = `pi_fk_id_usuario` ,
							`estado_registro`=	'E',
							`transaccion_modificacion`=	`pi_transaccion_modificacion`	
				where `pk_id_empresa`= `pi_pk_id_empresa`;			
			
      SET po_resultado = `pi_pk_id_empresa`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS `usuario_alta`;
DELIMITER //
CREATE  PROCEDURE `usuario_alta`( `pi_usuario` VARCHAR(255) ,
											`pi_llave` VARCHAR(255) ,
											`pi_fk_id_persona` INT(11) ,
											`pi_cnf_base` VARCHAR(32) ,											
											`pi_usuario_transaccion` INT(11) ,											
											`pi_transaccion_creacion` INT(11) ,
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
	
	SET nombre_proceso ='usuario_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO usuario (`usuario`  ,
									`llave`  ,
									`fk_id_persona` ,
									`cnf_base`  ,
									`fecha_transaccion`  ,
									`usuario_transaccion`  ,
									`estado_registro`  ,
									`transaccion_creacion`  ,
									`transaccion_modificacion`  ,
									`fk_id_empresa`)	
									VALUES
									(
									`pi_usuario`  ,
									`pi_llave`  ,
									`pi_fk_id_persona`  ,
									`pi_cnf_base` ,
									current_timestamp(), 
									`pi_usuario_transaccion`  ,
									'A', 
									`pi_transaccion_creacion` ,
									`pi_transaccion_modificacion` ,
									`pi_fk_id_empresa`                
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS `usuario_modif`;
DELIMITER //
CREATE  PROCEDURE `usuario_modif`( `pk_id_usuario` INT(11),
                                 `pi_usuario` VARCHAR(255) ,
											`pi_llave` VARCHAR(255) ,
											`pi_fk_id_persona` INT(11) ,
											`pi_cnf_base` VARCHAR(32) ,											
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
	
	SET nombre_proceso ='usuario_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set `usuario`  =`pi_usuario`,
									`llave`  = `pi_llave`,
									`fk_id_persona`=`pi_fk_id_persona` ,
									`cnf_base` =`pi_cnf_base` ,
									`fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='A',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `id_usuario`=`pk_id_usuario`;			
									 
	      
      SET po_resultado = `pk_id_usuario`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS `usuario_baja`;
DELIMITER //
CREATE  PROCEDURE `usuario_baja`( `pk_id_usuario` INT(11),                                 
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
	
	SET nombre_proceso ='usuario_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL `audit_insert`(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update usuario set 
									`fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `id_usuario`=`pk_id_usuario`;			
									 
	      
      SET po_resultado = `pk_id_usuario`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


-- Volcando estructura para procedimiento persona_alta
DROP PROCEDURE IF EXISTS `persona_alta`;
DELIMITER //
CREATE  PROCEDURE `persona_alta`(  `pi_nombres` VARCHAR(255) ,
												`pi_apellido_paterno` VARCHAR(255),
												`pi_apellido_materno` VARCHAR(255) ,
												`pi_fk_tipo_documento_identidad` INT(11) ,
												`pi_numero_identidad` VARCHAR(255) ,
												`pi_fk_departamento_expedicion_doc` INT(11) ,												
												`pi_usuario_transaccion` INT(11) ,												
												`pi_transaccion_creacion` INT(11) ,
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
	
	SET nombre_proceso ='persona_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO persona ( `nombres` ,
									`apellido_paterno` ,
									`apellido_materno`  ,
									`fk_tipo_documento_identidad`  ,
									`numero_identidad`  ,
									`fk_departamento_expedicion_doc` ,
									`fecha_transaccion`  ,
									`usuario_transaccion`  ,
									`estado_registro`  ,
									`transaccion_creacion`  ,
									`transaccion_modificacion`  ,
									`fk_id_empresa`)	
									VALUES
									(
									`pi_nombres`  ,
									`pi_apellido_paterno` ,
									`pi_apellido_materno`  ,
									`pi_fk_tipo_documento_identidad`  ,
									`pi_numero_identidad`  ,
									`pi_fk_departamento_expedicion_doc`,
									current_timestamp(),
									`pi_usuario_transaccion`  ,									
									`pi_transaccion_creacion`  ,
									`pi_transaccion_modificacion` ,
									`pi_fk_id_empresa`               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- modificacion persona
DROP PROCEDURE IF EXISTS `persona_modif`;
DELIMITER //
CREATE  PROCEDURE `persona_modif`(  `pk_id_persona` INT(11),
												`pi_nombres` VARCHAR(255) ,
												`pi_apellido_paterno` VARCHAR(255),
												`pi_apellido_materno` VARCHAR(255) ,
												`pi_fk_tipo_documento_identidad` INT(11) ,
												`pi_numero_identidad` VARCHAR(255) ,
												`pi_fk_departamento_expedicion_doc` INT(11) ,												
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
	
	SET nombre_proceso ='persona_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update persona 
							  set `nombres` =`pi_nombres`,
									`apellido_paterno` =`pi_apellido_paterno`,
									`apellido_materno` = `pi_apellido_materno` ,
									`fk_tipo_documento_identidad`  =`pi_fk_tipo_documento_identidad`,
									`numero_identidad` = `pi_numero_identidad`,
									`fk_departamento_expedicion_doc` =`pi_fk_departamento_expedicion_doc` ,
									`fecha_transaccion`  =current_timestamp(),
									`usuario_transaccion`  =`pi_usuario_transaccion` ,
									`estado_registro`  ='A',
									`transaccion_modificacion` = 	`pi_transaccion_modificacion`  ,
									`fk_id_empresa` = `pi_fk_id_empresa` 
	 where pk_id_persona = pi_pk_id_persona;
	      
    SET po_resultado = pi_pk_id_persona;
	 SET v_cant_reg = ROW_COUNT();
	  
    COMMIT;

    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END//
DELIMITER ;


-- baja presona

DROP PROCEDURE IF EXISTS `persona_baja`;
DELIMITER //
CREATE  PROCEDURE `persona_baja`(   `pk_id_persona` INT(11),																							
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
	
	SET nombre_proceso ='persona_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update persona 
							  set `fecha_transaccion`  =current_timestamp(),
									`usuario_transaccion`  =`pi_usuario_transaccion` ,
									`estado_registro`  ='E',
									`transaccion_modificacion` = 	`pi_transaccion_modificacion`  ,
									`fk_id_empresa` = `pi_fk_id_empresa` 
	 where pk_id_persona = pi_pk_id_persona;
	      
    SET po_resultado = pi_pk_id_persona;
	 SET v_cant_reg = ROW_COUNT();
	  
    COMMIT;
	  
    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END//
DELIMITER ;

