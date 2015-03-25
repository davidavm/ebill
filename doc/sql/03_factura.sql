
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `factura_alta`;
DELIMITER //
CREATE  PROCEDURE `factura_alta`( pi_pk_id_factura int(11),                                               
pi_fk_id_sucursal int(11),
pi_numero_factura int(11),                                             
pi_numero_autorizacion int(11),                                         
pi_llave_dosificacion text,                                             
pi_fecha_limite_emision date,                                           
pi_fecha_factura datetime,                                              
pi_nit varchar(255),                                                    
pi_categoria varchar(255),                                              
pi_razon_social varchar(255),                                           
pi_descuento decimal(15,5),                                             
pi_fk_id_formato_dato_descuento int(11),                                
pi_recargo decimal(15,5),                                               
pi_fk_id_formato_dato_recargo int(11),                                  
pi_ice decimal(15,5),                                                   
pi_excentos decimal(15,5),                                              
pi_fk_id_opcion_tipo_venta int(11),                                     
pi_cantidad_dias int(11),                                               
pi_codigo_control char(10),                                             
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
pi_fk_id_empresa int(11),                                               
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
	
	SET nombre_proceso ='factura_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO factura (pk_id_factura,                                                          
fk_id_sucursal,    
numero_factura,                                                     
numero_autorizacion,                                                    
llave_dosificacion,                                                     
fecha_limite_emision,                                                   
fecha_factura,                                                          
nit,                                                                    
categoria,                                                              
razon_social,                                                           
descuento,                                                              
fk_id_formato_dato_descuento,                                           
recargo,                                                                
fk_id_formato_dato_recargo,                                             
ice,                                                                    
excentos,                                                               
fk_id_opcion_tipo_venta,                                                
cantidad_dias,                                                          
codigo_control,                                                         
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
transaccion_modificacion,                                               
fk_id_empresa )	
									VALUES
									(
								    pi_pk_id_factura,                                                       
pi_fk_id_sucursal,    
pi_numero_factura,                                                  
pi_numero_autorizacion,                                                 
pi_llave_dosificacion,                                                  
pi_fecha_limite_emision,                                                
pi_fecha_factura,                                                       
pi_nit,                                                                 
pi_categoria,                                                           
pi_razon_social,                                                        
pi_descuento,                                                           
pi_fk_id_formato_dato_descuento,                                        
pi_recargo,                                                             
pi_fk_id_formato_dato_recargo,                                          
pi_ice,                                                                 
pi_excentos,                                                            
pi_fk_id_opcion_tipo_venta,                                             
pi_cantidad_dias,                                                       
pi_codigo_control,                                                      
pi_cantidad,                                                            
pi_unidad,                                                              
pi_fk_id_dato_entrada_buscar_unidad,                                    
pi_detalle,                                                             
pi_precio_unitario,                                                     
pi_total,                                                               
pi_sujeto_descuento_fiscal,                                             
pi_estado_registro,                                                     
 
										current_timestamp()  ,
										`pi_usuario_transaccion`  ,
										'A'  ,
										`pi_transaccion_creacion`  ,
										`pi_transaccion_modificacion` ,
                                                                                 pi_fk_id_empresa
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `factura_modif`;
DELIMITER //
CREATE  PROCEDURE `factura_modif`( pi_pk_id_factura int(11),                                               
pi_fk_id_sucursal int(11),  
pi_numero_factura int(11),                                             
pi_numero_autorizacion int(11),                                          
pi_llave_dosificacion text,                                             
pi_fecha_limite_emision date,                                           
pi_fecha_factura datetime,                                              
pi_nit varchar(255),                                                    
pi_categoria varchar(255),                                              
pi_razon_social varchar(255),                                           
pi_descuento decimal(15,5),                                             
pi_fk_id_formato_dato_descuento int(11),                                
pi_recargo decimal(15,5),                                               
pi_fk_id_formato_dato_recargo int(11),                                  
pi_ice decimal(15,5),                                                   
pi_excentos decimal(15,5),                                              
pi_fk_id_opcion_tipo_venta int(11),                                     
pi_cantidad_dias int(11),                                               
pi_codigo_control char(10),                                             
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
pi_fk_id_empresa int(11),                                               
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
	
	SET nombre_proceso ='factura_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update factura set                                                        fk_id_sucursal = pi_fk_id_sucursal,          
                                                                                numero_factura = pi_numero_factura,
                                                                                numero_autorizacion = pi_numero_autorizacion,                                                                                                           
                                                                                llave_dosificacion = pi_llave_dosificacion,                             
                                                                                fecha_limite_emision = pi_fecha_limite_emision,                         
                                                                                fecha_factura = pi_fecha_factura,                                       
                                                                                nit = pi_nit,                                                           
                                                                                categoria = pi_categoria,                                               
                                                                                razon_social = pi_razon_social,                                         
                                                                                descuento = pi_descuento,                                               
                                                                                fk_id_formato_dato_descuento = pi_fk_id_formato_dato_descuento,         
                                                                                recargo = pi_recargo,                                                   
                                                                                fk_id_formato_dato_recargo = pi_fk_id_formato_dato_recargo,             
                                                                                ice = pi_ice,                                                           
                                                                                excentos = pi_excentos,                                                 
                                                                                fk_id_opcion_tipo_venta = pi_fk_id_opcion_tipo_venta,                   
                                                                                cantidad_dias = pi_cantidad_dias,                                       
                                                                                codigo_control = pi_codigo_control,                                     
                                                                                cantidad = pi_cantidad,                                                 
                                                                                unidad = pi_unidad,                                                     
                                                                                fk_id_dato_entrada_buscar_unidad = pi_fk_id_dato_entrada_buscar_unidad, 
                                                                                detalle = pi_detalle,                                                   
                                                                                precio_unitario = pi_precio_unitario,                                   
                                                                                total = pi_total,                                                       
                                                                                sujeto_descuento_fiscal = pi_sujeto_descuento_fiscal,                   
                                                                                estado_registro = pi_estado_registro,                                   
                                                                                fk_id_empresa = pi_fk_id_empresa,
										`fecha_transaccion` = current_timestamp(),
										`usuario_transaccion` =`pi_usuario_transaccion`,
										`estado_registro` ='A',
										
										`transaccion_modificacion` =`pi_transaccion_modificacion`
					where `pk_id_factura`=`pi_pk_id_factura`;			
									 
	      
      SET po_resultado = `pi_pk_id_factura`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;




-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `factura_baja`;
DELIMITER //
CREATE  PROCEDURE `factura_baja`( `pi_pk_id_factura` INT(11),                                 
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
	
	SET nombre_proceso ='factura_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update factura set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_factura`=`pi_pk_id_factura`;			
									 
	      
      SET po_resultado = `pi_pk_id_factura`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


