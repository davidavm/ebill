# SQL Manager 2010 for MySQL 4.5.0.9
# ---------------------------------------
# Host     : WIN-9LDUPO4KHR7
# Port     : 3306
# Database : ebil


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

#
# Definition for the `dosificacion_alta` procedure : 
#

DROP PROCEDURE IF EXISTS `dosificacion_alta`;

CREATE   PROCEDURE `dosificacion_alta`(
        `pi_fk_id_sucursal` INT(11) ,
        `pi_fk_id_actividad_economica` INT(11) ,
        `pi_numero_correlativo` VARCHAR(128) ,
        `pi_fecha_limite_emision` DATETIME ,
        `pi_fecha_ingreso` DATETIME ,
        `pi_numero_autorizacion` INT(11) ,
        `pi_usuario_transaccion` INT(11) ,
        `pi_transaccion_creacion` INT(11) ,
        `pi_transaccion_modificacion` INT(11) ,
        `pi_fk_id_empresa` INT(11),
        OUT po_resultado INT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
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
	
	SET nombre_proceso ='dosificacion_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO dosificacion (`fk_id_sucursal`  ,
										`fk_id_actividad_economica` ,
										`numero_correlativo`  ,
										`fecha_limite_emision`  ,
										`fecha_ingreso`  ,
										`numero_autorizacion`  ,
										`fecha_transaccion`  ,
										`usuario_transaccion`  ,
										`estado_registro`  ,
										`transaccion_creacion`  ,
										`transaccion_modificacion`  ,
										`fk_id_empresa` )	
									VALUES
									(
								    `pi_fk_id_sucursal`  ,
										`pi_fk_id_actividad_economica` ,
										`pi_numero_correlativo`  ,
										`pi_fecha_limite_emision`  ,
										`pi_fecha_ingreso`  ,
										`pi_numero_autorizacion`  ,
										current_timestamp()  ,
										`pi_usuario_transaccion`  ,
										'A'  ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion`  ,
										`pi_fk_id_empresa`               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END;

#
# Definition for the `dosificacion_baja` procedure : 
#

DROP PROCEDURE IF EXISTS `dosificacion_baja`;

CREATE   PROCEDURE `dosificacion_baja`(
        `pi_pk_id_dosificacion` INT(11),
        `pi_usuario_transaccion` INT(11) ,
        `pi_transaccion_modificacion` INT(11) ,
        `pi_fk_id_empresa` INT(11),
        OUT po_resultado INT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
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
	
	SET nombre_proceso ='dosificacion_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update dosificacion set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_dosificacion`=`pi_pk_id_dosificacion`;			
									 
	      
      SET po_resultado = `pi_pk_id_dosificacion`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END;

#
# Definition for the `dosificacion_modif` procedure : 
#

DROP PROCEDURE IF EXISTS `dosificacion_modif`;

CREATE   PROCEDURE `dosificacion_modif`(
        `pi_pk_id_dosificacion` INT(11) ,
        `pi_fk_id_sucursal` INT(11) ,
        `pi_fk_id_actividad_economica` INT(11) ,
        `pi_numero_correlativo` VARCHAR(128) ,
        `pi_fecha_limite_emision` DATETIME ,
        `pi_fecha_ingreso` DATETIME ,
        `pi_numero_autorizacion` INT(11) ,
        `pi_usuario_transaccion` INT(11) ,
        `pi_transaccion_modificacion` INT(11) ,
        `pi_fk_id_empresa` INT(11),
        OUT po_resultado INT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
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
	
	SET nombre_proceso ='dosificacion_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update dosificacion set     `fk_id_sucursal` = `pi_fk_id_sucursal` ,
										`fk_id_actividad_economica` = `pi_fk_id_actividad_economica`,
										`numero_correlativo` =`pi_numero_correlativo`,
										`fecha_limite_emision` =`pi_fecha_limite_emision`,
										`fecha_ingreso` = `pi_fecha_ingreso` ,
										`numero_autorizacion` =`pi_numero_autorizacion`,
										`fecha_transaccion` = current_timestamp(),
										`usuario_transaccion` =`pi_usuario_transaccion`,
										`estado_registro` ='A',
										
										`transaccion_modificacion` =`pi_transaccion_modificacion`,
										`fk_id_empresa`  = `pi_fk_id_empresa`
					where `pk_id_dosificacion`=`pi_pk_id_dosificacion`;			
									 
	      
      SET po_resultado = `pi_pk_id_dosificacion`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;