-- Volcando estructura para procedimiento empresa_alta
DROP PROCEDURE IF EXISTS empresa_alta;
DELIMITER //
CREATE  PROCEDURE empresa_alta(IN pi_empresa VARCHAR(255), 
											IN pi_nombre_corto VARCHAR(255), 
											IN pi_razon_social VARCHAR(255), 
											IN pi_nit INT, 
											IN pi_direccion TEXT, 
											IN pi_telefono1 VARCHAR(32), 
											IN pi_telefono2 VARCHAR(32),
										    IN pi_telefono3 VARCHAR(32),
											IN pi_fk_id_departamento INT, 
										    IN pi_fk_id_municipio INT,
										    IN	pi_fk_id_tipo_actividad INT(11) ,
											IN	pi_fk_id_tipo_formato_factura INT(11),
											IN	pi_fk_tipo_empresa INT(11) ,
											IN	pi_fk_tipo_razon_social INT(11) ,											
											IN	pi_fk_id_usuario INT(11) ,											
											IN	pi_transaccion_creacion INT(11) ,
											IN	pi_transaccion_modificacion INT(11),
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
	
	SET nombre_proceso ='empresa_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      INSERT INTO empresa (empresa ,
						   nombre_corto , 
							razon_social ,
							nit ,
							direccion ,
							telefono1 ,
							telefono2,
							telefono3 ,
							fk_id_departamento ,
							fk_id_municipio ,
							fk_id_tipo_actividad ,
							fk_id_tipo_formato_factura ,
							fk_tipo_empresa ,
							fk_tipo_razon_social ,
							fecha_transaccion ,
							fk_id_usuario ,
							estado_registro ,
							transaccion_creacion ,
							transaccion_modificacion)	
							VALUES
							(
							pi_empresa , 
							pi_nombre_corto , 
							pi_razon_social , 
						    pi_nit , 
							pi_direccion , 
							pi_telefono1 , 
							pi_telefono2 ,
						    pi_telefono3 ,
							pi_fk_id_departamento , 
							pi_fk_id_municipio ,
							pi_fk_id_tipo_actividad  ,
							pi_fk_id_tipo_formato_factura  ,
							pi_fk_tipo_empresa ,
							pi_fk_tipo_razon_social  ,
							current_timestamp(), 
							pi_fk_id_usuario  ,
							'A', 
							pi_transaccion_creacion  ,
							pi_transaccion_modificacion                 
        );
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
      
	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;


-- modificacion empresa
DROP PROCEDURE IF EXISTS empresa_modif;
DELIMITER //
CREATE  PROCEDURE empresa_modif(IN pi_pk_id_empresa INT(11),
                                 IN pi_empresa VARCHAR(255), 
											IN pi_nombre_corto VARCHAR(255), 
											IN pi_razon_social VARCHAR(255), 
											IN pi_nit INT, 
											IN pi_direccion TEXT, 
											IN pi_telefono1 VARCHAR(32), 
											IN pi_telefono2 VARCHAR(32),
										    IN pi_telefono3 VARCHAR(32),
											IN pi_fk_id_departamento INT, 
										    IN pi_fk_id_municipio INT,
										    IN	pi_fk_id_tipo_actividad INT(11) ,
											IN	pi_fk_id_tipo_formato_factura INT(11),
											IN	pi_fk_tipo_empresa INT(11) ,
											IN	pi_fk_tipo_razon_social INT(11) ,											
											IN	pi_fk_id_usuario INT(11) ,																					
											IN	pi_transaccion_modificacion INT(11),
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
	
	SET nombre_proceso ='empresa_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update empresa set empresa=pi_empresa ,
							nombre_corto =pi_nombre_corto ,
							razon_social =pi_razon_social,
							nit=pi_nit ,
							direccion =pi_direccion,
							telefono1=pi_telefono1 ,
							telefono2=pi_telefono2,
							telefono3 = pi_telefono3,
							fk_id_departamento =pi_fk_id_departamento,
							fk_id_municipio = pi_fk_id_municipio,
							fk_id_tipo_actividad=pi_fk_id_tipo_actividad ,
							fk_id_tipo_formato_factura=pi_fk_id_tipo_formato_factura ,
							fk_tipo_empresa =pi_fk_tipo_empresa,
							fk_tipo_razon_social=pi_fk_tipo_razon_social ,
							fecha_transaccion =current_timestamp(), 
							fk_id_usuario =pi_fk_id_usuario ,
							estado_registro=	'A',
							transaccion_modificacion=	pi_transaccion_modificacion	
				where pk_id_empresa= pi_pk_id_empresa;			
			
      SET po_resultado = pi_pk_id_empresa;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);    
	
END//
DELIMITER ;



-- baja empresa
DROP PROCEDURE IF EXISTS empresa_baja;
DELIMITER //
CREATE  PROCEDURE empresa_baja(IN pi_pk_id_empresa INT(11),                                 
											IN	pi_fk_id_usuario INT(11) ,											
											IN	pi_transaccion_modificacion INT(11),
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
	
	SET nombre_proceso ='empresa_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update empresa set 
							fecha_transaccion = current_timestamp(),
							fk_id_usuario = pi_fk_id_usuario ,
							estado_registro=	'E',
							transaccion_modificacion=	pi_transaccion_modificacion	
				where pk_id_empresa= pi_pk_id_empresa;			
			
      SET po_resultado = pi_pk_id_empresa;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

    CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	    

END//
DELIMITER ;

