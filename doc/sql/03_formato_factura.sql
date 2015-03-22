
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `formato_factura_alta`;
DELIMITER //
CREATE  PROCEDURE `formato_factura_alta`(`pi_fk_id_tipo_impresion` INT(11) ,
										`pi_fk_id_tipo_facturacion` INT(11) ,
										`pi_fk_id_tamanio_impresion` INT(11) ,
										`pi_fk_id_frase_titulo` INT(11) ,
										`pi_fk_id_sucursal` INT(11) ,
										`pi_fk_id_frase_subtitulo` INT(11) ,
										`pi_fk_frase_pie_pagina` INT(11) ,
										
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
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES',    v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='formato_factura_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO formato_factura (`fk_id_tipo_impresion`  ,
										`fk_id_tipo_facturacion`  ,
										`fk_id_tamanio_impresion`  ,
										`fk_id_frase_titulo`  ,
										`fk_id_sucursal`  ,
										`fk_id_frase_subtitulo` ,
										`fk_frase_pie_pagina`  ,
										`fecha_transaccion` ,
										`usuario_transaccion`  ,
										`estado_registro`  ,
										`transaccion_creacion`  ,
										`transaccion_modificacion`  ,
										`fk_id_empresa` )	
									VALUES
									(
								        `pi_fk_id_tipo_impresion`  ,
										`pi_fk_id_tipo_facturacion`  ,
										`pi_fk_id_tamanio_impresion`  ,
										`pi_fk_id_frase_titulo`  ,
										`pi_fk_id_sucursal`  ,
										`pi_fk_id_frase_subtitulo` ,
										`pi_fk_frase_pie_pagina`  ,
										current_timestamp() ,
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
DROP PROCEDURE IF EXISTS `formato_factura_modif`;
DELIMITER //
CREATE  PROCEDURE `formato_factura_modif`( `pk_id_formato_factura` INT(11),
										    `fk_id_tipo_impresion` INT(11) ,
											`fk_id_tipo_facturacion` INT(11) ,
											`fk_id_tamanio_impresion` INT(11) ,
											`fk_id_frase_titulo` INT(11) ,
											`fk_id_sucursal` INT(11) ,
											`fk_id_frase_subtitulo` INT(11) ,
											`fk_frase_pie_pagina` INT(11) ,
											
											`usuario_transaccion` INT(11) ,
											
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
	
	SET nombre_proceso ='formato_factura_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update formato_factura set    `fk_id_tipo_impresion` = `pi_fk_id_tipo_impresion` ,
									`fk_id_tipo_facturacion` = `pi_fk_id_tipo_facturacion` ,
									`fk_id_tamanio_impresion`  = `pi_fk_id_tamanio_impresion`,
									`fk_id_frase_titulo`  = `pi_fk_id_frase_titulo`,
									`fk_id_sucursal` = `pi_fk_id_sucursal` ,
									`fk_id_frase_subtitulo` = `pi_fk_id_frase_subtitulo`  ,
									`fk_frase_pie_pagina`  = `pi_fk_frase_pie_pagina`,
									`fecha_transaccion`  = current_timestamp(),
									`usuario_transaccion` = `pi_usuario_transaccion`,
									`estado_registro` = 'A' ,									
									`transaccion_modificacion` = `pi_transaccion_modificacion`,
									`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_formato_factura`=`pi_pk_id_formato_factura`;			
									 
	      
      SET po_resultado = `pi_pk_id_formato_factura`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `formato_factura_baja`;
DELIMITER //
CREATE  PROCEDURE `formato_factura_baja`( `pi_pk_id_formato_factura` INT(11),                                 
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
	
	SET nombre_proceso ='formato_factura_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update formato_factura set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_formato_factura`=`pi_pk_id_formato_factura`;			
									 
	      
      SET po_resultado = `pi_pk_id_formato_factura`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


