-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS movimiento_alta;
DELIMITER //
CREATE  PROCEDURE movimiento_alta( `pi_cantidad` DECIMAL(15,5) ,
									`pi_costo_unitario` DECIMAL(15,5) ,
									`pi_precio_unitario` DECIMAL(15,5) ,
									`pi_fk_id_tipo_movimiento` INT(11) ,
									`pi_fk_id_sistema_valoracion_inventario` INT(11) ,
									`pi_fk_id_almacen` INT(11) ,
									`pi_fk_id_item` INT(11) ,
									`pi_fk_id_motivo_movimiento` INT(11) ,
									`pi_fk_id_factura` INT(11) ,
									`pi_fk_id_compra` INT(11) ,
									
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
	
	SET nombre_proceso ='movimiento_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

		  INSERT INTO movimiento (`cantidad` ,
									`costo_unitario`  ,
									`precio_unitario`  ,
									`fk_id_tipo_movimiento`  ,
									`fk_id_sistema_valoracion_inventario`  ,
									`fk_id_almacen`  ,
									`fk_id_item`  ,
									`fk_id_motivo_movimiento` ,
									`fk_id_factura` ,
									`fk_id_compra` ,
									`fecha_transaccion` ,
									`usuario_transaccion`  ,
									`estado_registro` ,
									`transaccion_creacion`  ,
									`transaccion_modificacion` ,
									`fk_id_empresa` )	
									VALUES
									(
									`pi_cantidad` ,
									`pi_costo_unitario`  ,
									`pi_precio_unitario`  ,
									`pi_fk_id_tipo_movimiento`  ,
									`pi_fk_id_sistema_valoracion_inventario`  ,
									`pi_fk_id_almacen`  ,
									`pi_fk_id_item`  ,
									`pi_fk_id_motivo_movimiento` ,
									`pi_fk_id_factura` ,
									`pi_fk_id_compra` ,
									current_timestamp() ,
									`pi_usuario_transaccion`  ,
									'A',
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
DROP PROCEDURE IF EXISTS movimiento_modif;
DELIMITER //
CREATE  PROCEDURE movimiento_modif(   `pi_pk_id_movimiento` INT(11),
									 `pi_cantidad` DECIMAL(15,5) ,
										`pi_costo_unitario` DECIMAL(15,5) ,
										`pi_precio_unitario` DECIMAL(15,5) ,
										`pi_fk_id_tipo_movimiento` INT(11) ,
										`pi_fk_id_sistema_valoracion_inventario` INT(11) ,
										`pi_fk_id_almacen` INT(11) ,
										`pi_fk_id_item` INT(11) ,
										`pi_fk_id_motivo_movimiento` INT(11) ,
										`pi_fk_id_factura` INT(11) ,
										`pi_fk_id_compra` INT(11) ,
										
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
	
	SET nombre_proceso ='movimiento_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update movimiento set `cantidad` =`pi_cantidad`,
									`costo_unitario`= `pi_costo_unitario`  ,
									`precio_unitario` = `pi_precio_unitario` ,
									`fk_id_tipo_movimiento` = `pi_fk_id_tipo_movimiento` ,
									`fk_id_sistema_valoracion_inventario` = `pi_fk_id_sistema_valoracion_inventario` ,
									`fk_id_almacen` = `pi_fk_id_almacen` ,
									`fk_id_item` = `pi_fk_id_item` ,
									`fk_id_motivo_movimiento` =`pi_fk_id_motivo_movimiento`,
									`fk_id_factura` = `pi_fk_id_factura`,
									`fk_id_compra` = `pi_fk_id_compra` ,
									`fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` = `pi_usuario_transaccion` ,
									`estado_registro`='A' ,
									
									`transaccion_modificacion`= `pi_transaccion_modificacion` ,
									`fk_id_empresa` = `pi_fk_id_empresa`
					where pk_id_movimiento=`pi_pk_id_movimiento` ;			
									 
	      
      SET po_resultado = pi_pk_id_movimiento;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS movimiento_baja;
DELIMITER //
CREATE  PROCEDURE movimiento_baja( pi_pk_id_movimiento INT(11),                                 
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
	
	SET nombre_proceso ='movimiento_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update movimiento set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_movimiento=pi_pk_id_movimiento;			
									 
	      
      SET po_resultado = pi_pk_id_movimiento;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;
