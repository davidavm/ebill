
-- Volcando estructura para procedimiento grupo_alta
DROP PROCEDURE IF EXISTS `licencia_historia_alta`;
DELIMITER //
CREATE  PROCEDURE `licencia_historia_alta`( pk_id_licencia                INT,
                                            pi_licencia                      VARCHAR(255),
                                            pi_codigo_contrato               VARCHAR(255),
                                            pi_fecha_inicio_servicio         DATE           ,
                                            pi_fecha_fin_servicio            DATE            ,

                                            pi_fk_tipo_servicio_sistema      INT,
                                            pi_fk_tipo_contrato_sistema      INT,
                                            pi_fk_tiempo_servicio_sistema    INT,
                                            pi_fk_paquete_sistema            INT,
                                            pi_usuario_transaccion           INT,

                                            pi_transaccion_creacion          INT,
                                            pi_transaccion_modificacion      INT,
                                            pi_fk_id_empresa                 INT,
                                            pi_fecha_inicio                  DATETIME      ,
                                            pi_fecha_fin                     DATETIME,
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
	
	SET nombre_proceso ='licencia_historia_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO licencia_historia (pk_id_licencia				  ,
								    licencia                      ,
									codigo_contrato               ,
									fecha_inicio_servicio         ,
									fecha_fin_servicio            ,
									fecha_transaccion             ,
									fk_tipo_servicio_sistema      ,
									fk_tipo_contrato_sistema      ,
									fk_tiempo_servicio_sistema    ,
									fk_paquete_sistema            ,
									usuario_transaccion           ,
									estado_registro               ,
									transaccion_creacion          ,
									transaccion_modificacion      ,
									fk_id_empresa                 ,
									fecha_inicio                  ,
									fecha_fin                     )	
									VALUES
									(pi_pk_id_licencia					,
								    pi_licencia                      ,
									pi_codigo_contrato               ,
									pi_fecha_inicio_servicio         ,
									pi_fecha_fin_servicio            ,
									current_timestamp()		      ,
									pi_fk_tipo_servicio_sistema      ,
									pi_fk_tipo_contrato_sistema      ,
									pi_fk_tiempo_servicio_sistema    ,
									pi_fk_paquete_sistema            ,
									pi_usuario_transaccion           ,
									'A'               ,
									pi_transaccion_creacion          ,
									pi_transaccion_modificacion      ,
									pi_fk_id_empresa                 ,
									pi_fecha_inicio                  ,
									pi_fecha_fin                
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;


-- Volcando estructura para procedimiento grupo_modif
DROP PROCEDURE IF EXISTS `licencia_historia_modif`;
DELIMITER //
CREATE  PROCEDURE `licencia_historia_modif`(  pi_pk_id_licencia_historia       INT             ,
                                            pi_pk_id_licencia                INT,
                                            pi_licencia                      VARCHAR(255),
                                            pi_codigo_contrato               VARCHAR(255),
                                            pi_fecha_inicio_servicio         DATE            ,
                                            pi_fecha_fin_servicio            DATE           ,

                                            pi_fk_tipo_servicio_sistema      INT,
                                            pi_fk_tipo_contrato_sistema      INT,
                                            pi_fk_tiempo_servicio_sistema    INT,
                                            pi_fk_paquete_sistema            INT,
                                            pi_usuario_transaccion           INT,

                                            pi_transaccion_modificacion      INT,
                                            pi_fk_id_empresa                 INT,
                                            pi_fecha_inicio                  DATETIME      ,
                                            pi_fecha_fin                     DATETIME ,
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
	
	SET nombre_proceso ='licencia_historia_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
        update licencia_historia set      
                pk_id_licencia = pi_pk_id_licencia                ,
                licencia = pi_licencia                      ,
                codigo_contrato = pi_codigo_contrato               ,
                fecha_inicio_servicio = pi_fecha_inicio_servicio         ,
                fecha_fin_servicio = pi_fecha_fin_servicio            ,
                fecha_transaccion    = current_timestamp()         ,
                fk_tipo_servicio_sistema   = pi_fk_tipo_servicio_sistema    ,
                fk_tipo_contrato_sistema = pi_fk_tipo_contrato_sistema      ,
                fk_tiempo_servicio_sistema = pi_fk_tiempo_servicio_sistema    ,
                fk_paquete_sistema = pi_fk_paquete_sistema            ,
                usuario_transaccion  = pi_usuario_transaccion           ,
                estado_registro   = 'A'            ,											
                transaccion_modificacion = pi_transaccion_modificacion      ,
                fk_id_empresa = pi_fk_id_empresa                 ,
                fecha_inicio = pi_fecha_inicio                        ,
                fecha_fin = pi_fecha_fin 
where `pk_id_licencia_historia`=`pi_pk_id_licencia_historia`;			

	      
      SET po_resultado = `pi_pk_id_licencia_historia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `licencia_historia_baja`;
DELIMITER //
CREATE  PROCEDURE `licencia_historia_baja`( `pi_pk_id_licencia_historia` INT(11),                                 
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
	
	SET nombre_proceso ='licencia_historia_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update licencia_historia set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa` 	
					where `pk_id_licencia_historia`=`pi_pk_id_licencia_historia`;			
									 
	      
      SET po_resultado = `pi_pk_id_licencia_historia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `licencia_historia_baja_hsto`;
DELIMITER //
CREATE  PROCEDURE `licencia_historia_baja_hsto`( `pi_pk_id_licencia_historia` INT(11),                                 
                                                `pi_usuario_transaccion` INT(11) ,											
                                                `pi_transaccion_modificacion` INT(11) ,
                                                `pi_fk_id_empresa` INT(11),                                                
                                                 pi_fecha_fin       DATETIME ,
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
	
	SET nombre_proceso ='licencia_historia_baja_hsto';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update licencia_historia set `fecha_transaccion` = current_timestamp(),
                                    `usuario_transaccion` =`pi_usuario_transaccion` ,
                                    `estado_registro` ='E',
                                    `transaccion_modificacion`  =`pi_transaccion_modificacion`,
                                    `fk_id_empresa`=`pi_fk_id_empresa`,                                    
                                     fecha_fin = pi_fecha_fin
                        where `pk_id_licencia_historia`=`pi_pk_id_licencia_historia`;			

	      
      SET po_resultado = `pi_pk_id_licencia_historia`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

