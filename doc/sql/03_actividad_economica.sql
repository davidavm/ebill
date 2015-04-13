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
# Definition for the `actividad_economica_alta` procedure : 
#

DROP PROCEDURE IF EXISTS `actividad_economica_alta`;

CREATE   PROCEDURE `actividad_economica_alta`(
        IN `pi_actividad_economica` VARCHAR(256),
        IN `pi_fk_id_clasificacion_tipo_actividad` INTEGER(11),
        IN `pi_usuario_transaccion` INTEGER(11),
        IN `pi_transaccion_creacion` INTEGER(11),
        IN `pi_transaccion_modificacion` INTEGER(11),
        IN `pi_fk_id_empresa` INTEGER(11),
        OUT po_resultado INTEGER
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
	
	SET nombre_proceso ='actividad_economica_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO actividad_economica (`actividad_economica`  ,
											`fk_id_clasificacion_tipo_actividad`  ,
											`fecha_transaccion` ,
											`usuario_transaccion`  ,
											`estado_registro` ,
											`transaccion_creacion`  ,
											`transaccion_modificacion` ,
											`fk_id_empresa`  )	
									VALUES
									(
								            `pi_actividad_economica`  ,
											`pi_fk_id_clasificacion_tipo_actividad`  ,
											current_timestamp() ,
											`pi_usuario_transaccion`  ,
											'A' ,
											`pi_transaccion_creacion`  ,
											`pi_transaccion_modificacion` ,
											`pi_fk_id_empresa`               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END;

#
# Definition for the `actividad_economica_baja` procedure : 
#

DROP PROCEDURE IF EXISTS `actividad_economica_baja`;

CREATE   PROCEDURE `actividad_economica_baja`(
        `pi_pk_id_actividad_economica` INT(11),
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
	
	SET nombre_proceso ='actividad_economica_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update actividad_economica set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_actividad_economica`=`pi_pk_id_actividad_economica`;			
									 
	      
      SET po_resultado = `pi_pk_id_actividad_economica`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END;

#
# Definition for the `actividad_economica_modif` procedure : 
#

DROP PROCEDURE IF EXISTS `actividad_economica_modif`;

CREATE   PROCEDURE `actividad_economica_modif`(
        IN `pi_pk_id_actividad_economica` INTEGER(11),
        IN `pi_actividad_economica` VARCHAR(256),
        IN `pi_fk_id_clasificacion_tipo_actividad` INTEGER(11),
        IN `pi_usuario_transaccion` INTEGER(11),
        IN `pi_transaccion_modificacion` INTEGER(11),
        IN `pi_fk_id_empresa` INTEGER(11),
        OUT po_resultado INTEGER
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
	
	SET nombre_proceso ='actividad_economica_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update actividad_economica set    `pk_id_actividad_economica` = `pi_pk_id_actividad_economica`,
												`actividad_economica` = `pi_actividad_economica`,
												`fk_id_clasificacion_tipo_actividad`  = `pi_fk_id_clasificacion_tipo_actividad`,
												`fecha_transaccion`  = current_timestamp(),
												`usuario_transaccion` = `pi_usuario_transaccion`,
												`estado_registro`  ='A',
												
												`transaccion_modificacion`  = `pi_transaccion_modificacion` ,
												`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_actividad_economica`=`pi_pk_id_actividad_economica`;			
									 
	      
      SET po_resultado = `pi_pk_id_actividad_economica`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;