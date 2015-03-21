-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS item_alta;
DELIMITER //
CREATE  PROCEDURE item_alta( `pi_codigo_item` VARCHAR(255) ,
							`pi_codigo_fabrica` VARCHAR(255) ,
							`pi_descripcion` VARCHAR(255) ,
							`pi_caracteristicas_especiales` VARCHAR(255) ,
							`pi_fk_id_unidad_medida` INT(11) ,
							`pi_cantidad` DECIMAL(15,5) ,
							`pi_costo_unitario` DECIMAL(15,5) ,
							`pi_precio_unitario` DECIMAL(15,5) ,
							`pi_fecha_vencimiento` DATETIME ,
							`pi_saldo_minimo` DECIMAL(15,5) ,
							`pi_fk_id_proveedor` INT(11) ,
							`pi_fk_id_archivo_imagen` INT(11) ,
							
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
	
	SET nombre_proceso ='item_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

		  INSERT INTO item (`codigo_item`  ,
								`codigo_fabrica`  ,
								`descripcion`  ,
								`caracteristicas_especiales`  ,
								`fk_id_unidad_medida`  ,
								`cantidad`  ,
								`costo_unitario`  ,
								`precio_unitario`  ,
								`fecha_vencimiento`  ,
								`saldo_minimo`  ,
								`fk_id_proveedor`,
								`fk_id_archivo_imagen`  ,
								`fecha_transaccion`  ,
								`usuario_transaccion` ,
								`estado_registro`  ,
								`transaccion_creacion`  ,
								`transaccion_modificacion`  ,
								`fk_id_empresa` )	
									VALUES
									(
									`pi_codigo_item`  ,
									`pi_codigo_fabrica`  ,
									`pi_descripcion`  ,
									`pi_caracteristicas_especiales`  ,
									`pi_fk_id_unidad_medida`  ,
									`pi_cantidad`  ,
									`pi_costo_unitario`  ,
									`pi_precio_unitario`  ,
									`pi_fecha_vencimiento`  ,
									`pi_saldo_minimo`  ,
									`pi_fk_id_proveedor`,
									`pi_fk_id_archivo_imagen`  ,
									current_timestamp()  ,
									`pi_usuario_transaccion` ,
									'A' ,
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




-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS item_modif;
DELIMITER //
CREATE  PROCEDURE item_modif(   `pi_pk_id_item` INT(11),
                                 `pi_codigo_item` VARCHAR(255) ,
								`pi_codigo_fabrica` VARCHAR(255) ,
								`pi_descripcion` VARCHAR(255) ,
								`pi_caracteristicas_especiales` VARCHAR(255) ,
								`pi_fk_id_unidad_medida` INT(11) ,
								`pi_cantidad` DECIMAL(15,5) ,
								`pi_costo_unitario` DECIMAL(15,5) ,
								`pi_precio_unitario` DECIMAL(15,5) ,
								`pi_fecha_vencimiento` DATETIME ,
								`pi_saldo_minimo` DECIMAL(15,5) ,
								`pi_fk_id_proveedor` INT(11) ,
								`pi_fk_id_archivo_imagen` INT(11) ,
								
								`pi_usuario_transaccion` INT(11) ,
								
								-- `pi_transaccion_creacion` INT(11) ,
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
	
	SET nombre_proceso ='item_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update item set `codigo_item` = `pi_codigo_item` ,
								`codigo_fabrica` = `pi_codigo_fabrica` ,
								`descripcion` = `pi_descripcion` ,
								`caracteristicas_especiales` = `pi_caracteristicas_especiales` ,
								`fk_id_unidad_medida` = `pi_fk_id_unidad_medida` ,
								`cantidad` = `pi_cantidad` ,
								`costo_unitario` = `pi_costo_unitario` ,
								`precio_unitario`  = `pi_precio_unitario`,
								`fecha_vencimiento` = `pi_fecha_vencimiento` ,
								`saldo_minimo` = `pi_saldo_minimo` ,
								`fk_id_proveedor`= `pi_fk_id_proveedor`,
								`fk_id_archivo_imagen` = `pi_fk_id_archivo_imagen` ,
								`fecha_transaccion` = `pi_fecha_transaccion` ,
								`usuario_transaccion`=`pi_usuario_transaccion` ,
								`estado_registro`='A'  ,
								
								`transaccion_modificacion` = `pi_transaccion_modificacion` ,
								`fk_id_empresa`	= `pi_fk_id_empresa`
					where pk_id_item=`pi_pk_id_item` ;			
									 
	      
      SET po_resultado = pk_id_item;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS item_baja;
DELIMITER //
CREATE  PROCEDURE item_baja( pk_id_item INT(11),                                 
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
	
	SET nombre_proceso ='item_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update item set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_item=pi_pk_id_item;			
									 
	      
      SET po_resultado = pi_pk_id_item;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

