-- Volcando estructura para procedimiento usuario_alta
DROP PROCEDURE IF EXISTS proveedor_alta;
DELIMITER //
CREATE  PROCEDURE proveedor_alta( pi_codigo VARCHAR(255) ,
									pi_nit VARCHAR(255) ,
									pi_razon_social VARCHAR(255) ,
									pi_direccion VARCHAR(255) ,
									pi_telefono1 VARCHAR(255) ,
									pi_telefono2 VARCHAR(255) ,
									pi_telefono3 VARCHAR(255) ,
									pi_contacto VARCHAR(255) ,
									pi_fk_id_rubro INT(11) ,
									pi_fk_id_departamento INT(11) ,
                                                                        pi_fk_id_municipio INT(11) ,
									pi_fecha1 DATETIME ,
									pi_fecha2 DATETIME ,
									pi_texto1 VARCHAR(255) ,
									pi_texto2 VARCHAR(255) ,
									pi_usuario_transaccion INT(11) ,
									pi_transaccion_creacion INT(11) ,
									pi_transaccion_modificacion INT(11) ,
									pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
        DECLARE vf_fk_id_rubro INT;
        DECLARE vf_fk_id_departamento INT;
        DECLARE vf_fk_id_municipio INT;
	
        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='proveedor_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

        if pi_fk_id_rubro = -1 then set vf_fk_id_rubro = null;
        else set vf_fk_id_rubro = pi_fk_id_rubro; end if; 

        if pi_fk_id_departamento = -1 then set vf_fk_id_departamento = null;
        else set vf_fk_id_departamento = pi_fk_id_departamento; end if; 

        if pi_fk_id_municipio = -1 then set vf_fk_id_municipio = null;
        else set vf_fk_id_municipio = pi_fk_id_municipio; end if; 

      INSERT INTO proveedor (codigo  ,
									nit  ,
									razon_social  ,
									direccion  ,
									telefono1  ,
									telefono2  ,
									telefono3  ,
									contacto  ,
									fk_id_rubro  ,
									fk_id_departamento ,
                                                                        fk_id_municipio  ,
									fecha1  ,
									fecha2  ,
									texto1  ,
									texto2  ,
									fecha_transaccion ,
									usuario_transaccion  ,
									estado_registro  ,
									transaccion_creacion  ,
									transaccion_modificacion  ,
									fk_id_empresa)	
									VALUES
									(
									pi_codigo  ,
									pi_nit  ,
									pi_razon_social  ,
									pi_direccion  ,
									pi_telefono1  ,
									pi_telefono2  ,
									pi_telefono3  ,
									pi_contacto  ,
									vf_fk_id_rubro  ,
									vf_fk_id_departamento ,
                                                                        vf_fk_id_municipio  ,
									pi_fecha1  ,
									pi_fecha2  ,
									pi_texto1  ,
									pi_texto2  ,
									current_timestamp() ,
									pi_usuario_transaccion  ,
									'A'  ,
									pi_transaccion_creacion  ,
									pi_transaccion_modificacion  ,
									pi_fk_id_empresa               
		        					);
	      
      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;



-- Volcando estructura para procedimiento usuario_modif
DROP PROCEDURE IF EXISTS proveedor_modif;
DELIMITER //
CREATE  PROCEDURE proveedor_modif( pi_pk_id_proveedor INT(11),
                                 pi_codigo VARCHAR(255) ,
									pi_nit VARCHAR(255) ,
									pi_razon_social VARCHAR(255) ,
									pi_direccion VARCHAR(255) ,
									pi_telefono1 VARCHAR(255) ,
									pi_telefono2 VARCHAR(255) ,
									pi_telefono3 VARCHAR(255) ,
									pi_contacto VARCHAR(255) ,
									pi_fk_id_rubro INT(11) ,
									pi_fk_id_departamento  INT(11),
                                                                        pi_fk_id_municipio  INT(11) ,
									pi_fecha1 DATETIME ,
									pi_fecha2 DATETIME ,
									pi_texto1 VARCHAR(255) ,
									pi_texto2 VARCHAR(255) ,
									pi_usuario_transaccion INT(11) ,
									pi_transaccion_modificacion INT(11) ,
									pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
        DECLARE vf_fk_id_rubro INT;
        DECLARE vf_fk_id_departamento INT;
        DECLARE vf_fk_id_municipio INT;
	
        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='proveedor_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

        if pi_fk_id_rubro = -1 then set vf_fk_id_rubro = null;
        else set vf_fk_id_rubro = pi_fk_id_rubro; end if; 

        if pi_fk_id_departamento = -1 then set vf_fk_id_departamento = null;
        else set vf_fk_id_departamento = pi_fk_id_departamento; end if; 

        if pi_fk_id_municipio = -1 then set vf_fk_id_municipio = null;
        else set vf_fk_id_municipio = pi_fk_id_municipio; end if; 

      update proveedor set codigo=pi_codigo  ,
									nit = pi_nit ,
									razon_social=pi_razon_social  ,
									direccion = pi_direccion ,
									telefono1 = pi_telefono1 ,
									telefono2 = pi_telefono2 ,
									telefono3 = pi_telefono3  ,
									contacto = pi_contacto ,
									fk_id_rubro = vf_fk_id_rubro ,
									fk_id_departamento = vf_fk_id_departamento ,
                                                                        fk_id_municipio = vf_fk_id_municipio ,
									fecha1 = pi_fecha1  ,
									fecha2 = pi_fecha2 ,
									texto1 = pi_texto1 ,
									texto2 = pi_texto2 ,
									fecha_transaccion=current_timestamp() ,
									usuario_transaccion = pi_usuario_transaccion ,
									estado_registro ='A' ,									
									transaccion_modificacion = pi_transaccion_modificacion ,
									fk_id_empresa = pi_fk_id_empresa 	
					where pk_id_proveedor=pi_pk_id_proveedor;			
									 
	      
      SET po_resultado = pi_pk_id_proveedor;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

-- Volcando estructura para procedimiento usuario_baja
DROP PROCEDURE IF EXISTS proveedor_baja;
DELIMITER //
CREATE  PROCEDURE proveedor_baja( pi_pk_id_proveedor INT(11),                                 
											pi_usuario_transaccion INT(11) ,											
											pi_transaccion_modificacion INT(11) ,
											pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
	
        DECLARE code VARCHAR(5) DEFAULT '00000';
        DECLARE msg TEXT;
        DECLARE result TEXT;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
                GET DIAGNOSTICS CONDITION 1
                code = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
		SET po_resultado = -1;
		SET result = CONCAT('ERROR: PROCESO TERMINO CON ERRORES code: ',code,' msg: ',msg);
		CALL audit_update(v_res, current_timestamp(),result , v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='proveedor_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update proveedor set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_proveedor=pi_pk_id_proveedor;			
									 
	      
      SET po_resultado = pi_pk_id_proveedor;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;
