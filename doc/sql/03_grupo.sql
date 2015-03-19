
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `grupo_alta`;
DELIMITER //
CREATE  PROCEDURE `grupo_alta`( `pi_fk_id_grupo_padre` INT(11) ,
											`pi_grupo` VARCHAR(255) ,
											`pi_descripcion` TEXT ,
											`pi_fk_id_tipo_grupo` INT(11) ,
											`pi_usuario_transaccion` INT(11) ,							
											`pi_transaccion_creacion` INT(11) ,
											`pi_transaccion_modificacion` INT(11),
											`pi_fk_id_empresa` INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	DECLARE vf_id_grupo_padre int;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES',    v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='grupo_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

    if `pi_fk_id_grupo_padre`= -1 then
    set vf_id_grupo_padre = null;
    else
    set vf_id_grupo_padre = `pi_fk_id_grupo_padre`;
    end if; 
    
      INSERT INTO grupo (`fk_id_grupo_padre`  ,
											`grupo` ,
											`descripcion`  ,
											`fk_id_tipo_grupo`  ,
											`fecha_transaccion`  ,
											`usuario_transaccion`  ,
											`estado_registro`  ,
											`transaccion_creacion`  ,
											`transaccion_modificacion`,
											`fk_id_empresa`)	
									VALUES
									(
									     `vf_id_grupo_padre` ,
											`pi_grupo`  ,
											`pi_descripcion`  ,
											`pi_fk_id_tipo_grupo`  ,
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

END//
DELIMITER ;


-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `grupo_modif`;
DELIMITER //
CREATE  PROCEDURE `grupo_modif`( `pi_pk_id_grupo` INT(11) ,
											`pi_fk_id_grupo_padre` INT(11) ,
											`pi_grupo` VARCHAR(255) ,
											`pi_descripcion` TEXT ,
											`pi_fk_id_tipo_grupo` INT(11) ,
											
											`pi_usuario_transaccion` INT(11) ,
											
											`pi_transaccion_modificacion` INT(11) ,
											`pi_fk_id_empresa` INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
   DECLARE vf_id_grupo_padre int;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='grupo_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

   if `pi_fk_id_grupo_padre`= -1 then
    set vf_id_grupo_padre = null;
    else
    set vf_id_grupo_padre = `pi_fk_id_grupo_padre`;
    end if; 
    
      update grupo set           `pk_id_grupo` =`pi_pk_id_grupo` ,
											`fk_id_grupo_padre` =vf_id_grupo_padre ,
											`grupo` =`pi_grupo` ,
											`descripcion`=`pi_descripcion`  ,
											`fk_id_tipo_grupo` = `pi_fk_id_tipo_grupo` ,
											`fecha_transaccion` = current_timestamp()  ,
											`usuario_transaccion` = `pi_usuario_transaccion` ,
											`estado_registro`= 'A'  ,
											
											`transaccion_modificacion`= `pi_transaccion_modificacion`  ,
											`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_grupo`=`pi_pk_id_grupo`;			
									 
	      
      SET po_resultado = `pi_pk_id_grupo`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `grupo_baja`;
DELIMITER //
CREATE  PROCEDURE `grupo_baja`( `pk_id_grupo` INT(11),                                 
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
	
	SET nombre_proceso ='grupo_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update grupo set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_grupo`=`pi_pk_id_grupo`;			
									 
	      
      SET po_resultado = `pi_pk_id_grupo`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


