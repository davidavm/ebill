-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS compra_alta;
DELIMITER //
CREATE  PROCEDURE compra_alta( `nit` VARCHAR(255) ,
								`razon_social` VARCHAR(255) ,
								`numero_factura` VARCHAR(255) ,
								`numero_autorizacion` VARCHAR(255) ,
								`fecha_compra` DATETIME ,
								`monto` DECIMAL(15,5) ,
								`descuentos` DECIMAL(15,5) ,
								`fk_id_formato_dato_descuento` INT(11) ,
								`recargos` DECIMAL(15,5) ,
								`fk_id_formato_dato_recargo` INT(11) ,
								`ice` DECIMAL(15,5) ,
								`excentos` CHAR(10) ,
								`codigo_control` VARCHAR(255) ,
								`sujeto_credito_fiscal` DECIMAL(15,5) ,
								`precio_unitario` DECIMAL(15,5) ,
								`detalle` TEXT ,
								`unidad` VARCHAR(255) ,
								`fk_id_dato_entrada_buscar_unidad` INT(11) ,
								`centro_costo` CHAR(10) ,
								`fk_id_dato_entrada_buscar_centro_costo` INT(11) ,
								`fk_id_tipo_compra` INT(11) ,
								`cantidad_dias` INT(11) ,
								
								`usuario_transaccion` INT(11) ,
								
								`transaccion_creacion` INT(11) ,
								`transaccion_modificacion` INT(11) ,
								`fk_id_empresa` INT(11),
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
	
	SET nombre_proceso ='compra_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

		  INSERT INTO compra (`nit`  ,
								`razon_social`  ,
								`numero_factura` ,
								`numero_autorizacion` ,
								`fecha_compra`  ,
								`monto` ,
								`descuentos`  ,
								`fk_id_formato_dato_descuento`  ,
								`recargos`  ,
								`fk_id_formato_dato_recargo`  ,
								`ice`  ,
								`excentos` ,
								`codigo_control`  ,
								`sujeto_credito_fiscal`  ,
								`precio_unitario`  ,
								`detalle`  ,
								`unidad`  ,
								`fk_id_dato_entrada_buscar_unidad` ,
								`centro_costo` ,
								`fk_id_dato_entrada_buscar_centro_costo` ,
								`fk_id_tipo_compra` ,
								`cantidad_dias`  ,
								`fecha_transaccion`  ,
								`usuario_transaccion`  ,
								`estado_registro` ,
								`transaccion_creacion`  ,
								`transaccion_modificacion` ,
								`fk_id_empresa`  )	
								VALUES
									(
									`pi_nit`  ,
									`pi_razon_social`  ,
									`pi_numero_factura` ,
									`pi_numero_autorizacion` ,
									`pi_fecha_compra`  ,
									`pi_monto` ,
									`pi_descuentos`  ,
									`pi_fk_id_formato_dato_descuento`  ,
									`pi_recargos`  ,
									`pi_fk_id_formato_dato_recargo`  ,
									`pi_ice`  ,
									`pi_excentos` ,
									`pi_codigo_control`  ,
									`pi_sujeto_credito_fiscal`  ,
									`pi_precio_unitario`  ,
									`pi_detalle`  ,
									`pi_unidad`  ,
									`pi_fk_id_dato_entrada_buscar_unidad` ,
									`pi_centro_costo` ,
									`pi_fk_id_dato_entrada_buscar_centro_costo` ,
									`pi_fk_id_tipo_compra` ,
									`pi_cantidad_dias`  ,
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

END//
DELIMITER ;





-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS compra_modif;
DELIMITER //
CREATE  PROCEDURE compra_modif(   `pi_pk_id_compra` INT(11),
									 `pi_nit` VARCHAR(255) ,
									`pi_razon_social` VARCHAR(255) ,
									`pi_numero_factura` VARCHAR(255) ,
									`pi_numero_autorizacion` VARCHAR(255) ,
									`pi_fecha_compra` DATETIME ,
									`pi_monto` DECIMAL(15,5) ,
									`pi_descuentos` DECIMAL(15,5) ,
									`pi_fk_id_formato_dato_descuento` INT(11) ,
									`pi_recargos` DECIMAL(15,5) ,
									`pi_fk_id_formato_dato_recargo` INT(11) ,
									`pi_ice` DECIMAL(15,5) ,
									`pi_excentos` CHAR(10) ,
									`pi_codigo_control` VARCHAR(255) ,
									`pi_sujeto_credito_fiscal` DECIMAL(15,5) ,
									`pi_precio_unitario` DECIMAL(15,5) ,
									`pi_detalle` TEXT ,
									`pi_unidad` VARCHAR(255) ,
									`pi_fk_id_dato_entrada_buscar_unidad` INT(11) ,
									`pi_centro_costo` CHAR(10) ,
									`pi_fk_id_dato_entrada_buscar_centro_costo` INT(11) ,
									`pi_fk_id_tipo_compra` INT(11) ,
									`pi_cantidad_dias` INT(11) ,
									
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
	
	SET nombre_proceso ='compra_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update compra set `nit` = `pi_nit` ,
								`razon_social` = `pi_razon_social` ,
								`numero_factura` = `pi_numero_factura` ,
								`numero_autorizacion` = `pi_numero_autorizacion` ,
								`fecha_compra` = `pi_fecha_compra` ,
								`monto` = `pi_monto` ,
								`descuentos` = `pi_descuentos` ,
								`fk_id_formato_dato_descuento` = `pi_fk_id_formato_dato_descuento` ,
								`recargos` = `pi_recargos` ,
								`fk_id_formato_dato_recargo` = `pi_fk_id_formato_dato_recargo` ,
								`ice` = `pi_ice` ,
								`excentos` = `pi_excentos`,
								`codigo_control` = `pi_codigo_control` ,
								`sujeto_credito_fiscal` = `pi_sujeto_credito_fiscal` ,
								`precio_unitario` = `pi_precio_unitario` ,
								`detalle` = `pi_detalle` ,
								`unidad` = `pi_unidad`  ,
								`fk_id_dato_entrada_buscar_unidad` = `pi_fk_id_dato_entrada_buscar_unidad`,
								`centro_costo` = `pi_centro_costo` ,
								`fk_id_dato_entrada_buscar_centro_costo` = `pi_fk_id_dato_entrada_buscar_centro_costo`,
								`fk_id_tipo_compra` = `pi_fk_id_tipo_compra`,
								`cantidad_dias` = `pi_cantidad_dias` ,
								`fecha_transaccion` = current_timestamp() ,
								`usuario_transaccion` = `pi_usuario_transaccion` ,
								`estado_registro` = 'A',
								
								`transaccion_modificacion` = `pi_transaccion_modificacion`,
								`fk_id_empresa` = `pi_fk_id_empresa`
					where pk_id_compra=`pi_pk_id_compra` ;			
									 
	      
      SET po_resultado = pi_pk_id_compra;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS compra_baja;
DELIMITER //
CREATE  PROCEDURE compra_baja( pi_pk_id_compra INT(11),                                 
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
	
	SET nombre_proceso ='compra_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update compra set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_compra=pi_pk_id_compra;			
									 
	      
      SET po_resultado = pi_pk_id_compra;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

