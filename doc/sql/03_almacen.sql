
-- Volcando estructura para procedimiento almacen_alta
DROP PROCEDURE IF EXISTS almacen_alta;
DELIMITER //
CREATE  PROCEDURE almacen_alta( pi_cod_almacen VARCHAR(255) ,
											pi_almacen VARCHAR(255) ,
											pi_descripcion TEXT ,
											pi_fk_id_grupo INT(11) ,
											pi_fk_id_sistema_valoracion_inventario INT(11) ,
											
											pi_usuario_transaccion INT(11) ,
											
											pi_transaccion_creacion INT(11),
											pi_transaccion_modificacion INT(11) ,
											pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
        DECLARE v_id INT;
        DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
        DECLARE vf_id_grupo int;

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
	
	SET nombre_proceso ='almacen_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;
      
        if pi_fk_id_grupo= -1 then
        set vf_id_grupo = null;
        else
        set vf_id_grupo = pi_fk_id_grupo;
        end if; 

      INSERT INTO almacen (cod_almacen  ,
											almacen  ,
											descripcion  ,
											fk_id_grupo  ,
											fk_id_sistema_valoracion_inventario  ,
											fecha_transaccion,
											usuario_transaccion  ,
											estado_registro,
											transaccion_creacion ,
											transaccion_modificacion,
											fk_id_empresa )	
									VALUES
									(
									    pi_cod_almacen  ,
											pi_almacen  ,
											pi_descripcion  ,
											vf_id_grupo  ,
											pi_fk_id_sistema_valoracion_inventario  ,
											current_timestamp(),
											pi_usuario_transaccion  ,
											 'A',
											pi_transaccion_creacion ,
											pi_transaccion_modificacion,
											pi_fk_id_empresa             
		        					);

      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END//
DELIMITER ;

-- Volcando estructura para procedimiento almacen_modif
DROP PROCEDURE IF EXISTS almacen_modif;
DELIMITER //
CREATE  PROCEDURE almacen_modif(	pi_pk_id_almacen INT(11) ,
												pi_cod_almacen VARCHAR(255) ,
												pi_almacen VARCHAR(255) ,
												pi_descripcion TEXT ,
												pi_fk_id_grupo INT(11) ,
												pi_fk_id_sistema_valoracion_inventario INT(11) ,
												
												pi_usuario_transaccion INT(11) ,
												
												pi_transaccion_modificacion INT(11) ,
												pi_fk_id_empresa INT(11),
											OUT po_resultado INT)
BEGIN
	DECLARE v_id INT;
    DECLARE v_res INT;
	DECLARE v_cant_reg INT default 0;
	DECLARE nombre_proceso VARCHAR(250);
        DECLARE vf_id_grupo int;
	
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
		CALL audit_update(v_res, current_timestamp(), 'ERROR: PROCESO TERMINO CON ERRORES', v_cant_reg, 'N', @resultado);
	END;
	
	SET nombre_proceso ='almacen_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

        if pi_fk_id_grupo= -1 then
        set vf_id_grupo = null;
        else
        set vf_id_grupo = pi_fk_id_grupo;
        end if; 

      update almacen set         
												cod_almacen = pi_cod_almacen ,
												almacen =pi_almacen ,
												descripcion = pi_descripcion ,
												fk_id_grupo = vf_id_grupo,
												fk_id_sistema_valoracion_inventario = pi_fk_id_sistema_valoracion_inventario ,
												fecha_transaccion = current_timestamp() ,
												usuario_transaccion= pi_usuario_transaccion ,
												estado_registro ='A' ,
												
												transaccion_modificacion =	pi_transaccion_modificacion ,
												fk_id_empresa = pi_fk_id_empresa
					where pk_id_almacen=pi_pk_id_almacen;			
									 
	      
      SET po_resultado = pi_pk_id_almacen;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento almacen_baja
DROP PROCEDURE IF EXISTS almacen_baja;
DELIMITER //
CREATE  PROCEDURE almacen_baja( pi_pk_id_almacen INT(11),                                 
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
	
	SET nombre_proceso ='almacen_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update almacen set 
									fecha_transaccion = current_timestamp(),
									usuario_transaccion =pi_usuario_transaccion ,
									estado_registro ='E',
									transaccion_modificacion  =pi_transaccion_modificacion,
									fk_id_empresa=pi_fk_id_empresa 	
					where pk_id_almacen=pi_pk_id_almacen;			
									 
	      
      SET po_resultado = pi_pk_id_almacen;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;

