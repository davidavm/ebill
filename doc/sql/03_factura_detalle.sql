
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `factura_detalle_alta`;
DELIMITER //
CREATE  PROCEDURE `factura_detalle_alta`(pi_pk_id_factura_detalle int(11),                                       
pi_fk_id_factura int(11),                                               
pi_fk_id_empresa int(11),                                               
pi_descuento decimal(15,5),                                             
pi_fk_id_formato_dato_descuento int(11),                                
pi_recargo decimal(15,5),                                               
pi_fk_id_formato_dato_recargo int(11), 
pi_fk_id_item int(11),                                  
pi_ice decimal(15,5),                                                   
pi_excentos decimal(15,5),                                              
pi_cantidad decimal(15,5),                                              
pi_unidad varchar(255),                                                 
pi_fk_id_dato_entrada_buscar_unidad int(11),                            
pi_detalle text,                                                        
pi_precio_unitario decimal(15,5),                                       
pi_total char(10),                                                      
pi_sujeto_descuento_fiscal decimal(15,5),                               
pi_fecha_transaccion datetime,                                          
pi_usuario_transaccion int(11),                                         
pi_estado_registro varchar(32),                                         
pi_transaccion_creacion int(11),                                        
pi_transaccion_modificacion int(11),                                    
OUT po_resultado INT )
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
	
	SET nombre_proceso ='factura_detalle_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO factura_detalle (pk_id_factura_detalle,                                                  
fk_id_factura,                                                          
fk_id_empresa,                                                          
descuento,                                                              
fk_id_formato_dato_descuento,                                           
recargo,                                                                
fk_id_formato_dato_recargo,
fk_id_item,                                             
ice,                                                                    
excentos,                                                               
cantidad,                                                               
unidad,                                                                 
fk_id_dato_entrada_buscar_unidad,                                       
detalle,                                                                
precio_unitario,                                                        
total,                                                                  
sujeto_descuento_fiscal,                                                
fecha_transaccion,                                                      
usuario_transaccion,                                                    
estado_registro,                                                        
transaccion_creacion,                                                   
transaccion_modificacion )	
									VALUES
									(
								pi_pk_id_factura_detalle,                                               
pi_fk_id_factura,                                                       
pi_fk_id_empresa,                                                       
pi_descuento,                                                           
pi_fk_id_formato_dato_descuento,                                        
pi_recargo,                                                             
pi_fk_id_formato_dato_recargo,   
pi_fk_id_item,                                       
pi_ice,                                                                 
pi_excentos,                                                            
pi_cantidad,                                                            
pi_unidad,                                                              
pi_fk_id_dato_entrada_buscar_unidad,                                    
pi_detalle,                                                             
pi_precio_unitario,                                                     
pi_total,                                                               
pi_sujeto_descuento_fiscal,   
										current_timestamp()  ,
										`pi_usuario_transaccion`  ,
										'A'  ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion` 
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `factura_detalle_modif`;
DELIMITER //
CREATE  PROCEDURE `factura_detalle_modif`( pi_pk_id_factura_detalle int(11),                                       
pi_fk_id_factura int(11),                                               
pi_fk_id_empresa int(11),                                               
pi_descuento decimal(15,5),                                             
pi_fk_id_formato_dato_descuento int(11),                                
pi_recargo decimal(15,5),                                               
pi_fk_id_formato_dato_recargo int(11),  
pi_fk_id_item int(11),                                    
pi_ice decimal(15,5),                                                   
pi_excentos decimal(15,5),                                              
pi_cantidad decimal(15,5),                                              
pi_unidad varchar(255),                                                 
pi_fk_id_dato_entrada_buscar_unidad int(11),                            
pi_detalle text,                                                        
pi_precio_unitario decimal(15,5),                                       
pi_total char(10),                                                      
pi_sujeto_descuento_fiscal decimal(15,5),                               
pi_fecha_transaccion datetime,                                          
pi_usuario_transaccion int(11),                                         
pi_estado_registro varchar(32),                                         
pi_transaccion_creacion int(11),                                        
pi_transaccion_modificacion int(11),                                    
OUT po_resultado INT )
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
	
	SET nombre_proceso ='factura_detalle_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update factura_detalle set                                                       fk_id_factura = pi_fk_id_factura,                                       
fk_id_empresa = pi_fk_id_empresa,                                       
descuento = pi_descuento,                                               
fk_id_formato_dato_descuento = pi_fk_id_formato_dato_descuento,         
recargo = pi_recargo,                                                   
fk_id_formato_dato_recargo = pi_fk_id_formato_dato_recargo,     
fk_id_item=pi_fk_id_item,        
ice = pi_ice,                                                           
excentos = pi_excentos,                                                 
cantidad = pi_cantidad,                                                 
unidad = pi_unidad,                                                     
fk_id_dato_entrada_buscar_unidad = pi_fk_id_dato_entrada_buscar_unidad, 
detalle = pi_detalle,                                                   
precio_unitario = pi_precio_unitario,                                   
total = pi_total,                                                       
sujeto_descuento_fiscal = pi_sujeto_descuento_fiscal,                       
                                                                                fk_id_empresa = pi_fk_id_empresa,
										`fecha_transaccion` = current_timestamp(),
										`usuario_transaccion` =`pi_usuario_transaccion`,
										`estado_registro` ='A',
										
										`transaccion_modificacion` =`pi_transaccion_modificacion`
					where `pk_id_factura_detalle`=`pi_pk_id_factura_detalle`;			
									 
	      
      SET po_resultado = `pi_pk_id_factura_detalle`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `factura_detalle_baja`;
DELIMITER //
CREATE  PROCEDURE `factura_detalle_baja`( `pi_pk_id_factura_detalle` INT(11),                                 
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
	
	SET nombre_proceso ='factura_detalle_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update factura_detalle set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_factura_detalle`=`pi_pk_id_factura_detalle`;			
									 
	      
      SET po_resultado = `pi_pk_id_factura_detalle`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


