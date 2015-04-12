
-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS `vendedor_alta`;

CREATE  PROCEDURE `vendedor_alta`(pi_nombres                     CHAR(10),
                                    pi_primer_apellido             CHAR(10),
                                    pi_segundo_apellido            CHAR(10),
                                    pi_telefono1                   CHAR(10),
                                    pi_telefono2                   CHAR(10),
                                    pi_telefono3                   CHAR(10),
                                    pi_fk_id_cliente               INT,
                                    
                                    pi_usuario_transaccion         INT,
                                    
                                    pi_transaccion_creacion        INT,
                                    pi_transaccion_modificacion    INT,
                                    pi_fk_id_empresa  INT,
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
	
	SET nombre_proceso ='vendedor_alta';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      INSERT INTO vendedor (nombres                     ,
                            primer_apellido             ,
                            segundo_apellido            ,
                            telefono1                   ,
                            telefono2                   ,
                            telefono3                   ,
                            fk_id_cliente               ,
                            fecha_transaccion           ,
                            usuario_transaccion         ,
                            estado_registro             ,
                            transaccion_creacion        ,
                            transaccion_modificacion    ,
                            fk_id_empresa)	
                        VALUES
                        (
                            pi_nombres                     ,
                            pi_primer_apellido             ,
                            pi_segundo_apellido            ,
                            pi_telefono1                   ,
                            pi_telefono2                   ,
                            pi_telefono3                   ,
                            pi_fk_id_cliente               ,
                            current_timestamp()           ,
                            pi_usuario_transaccion         ,
                            'A'             ,
                            pi_transaccion_creacion        ,
                            pi_transaccion_modificacion    ,
                            pi_fk_id_empresa               
                        );

SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;
	  
      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);	    

END;


-- Volcando estructura para procedimiento 
DROP PROCEDURE IF EXISTS `vendedor_modif`;

CREATE  PROCEDURE `vendedor_modif`( pi_pk_id_vendedor              INT            ,
                                        pi_nombres                     CHAR(10),
                                        pi_primer_apellido             CHAR(10),
                                        pi_segundo_apellido            CHAR(10),
                                        pi_telefono1                   CHAR(10),
                                        pi_telefono2                   CHAR(10),
                                        pi_telefono3                   CHAR(10),
                                        pi_fk_id_cliente               INT,
                                        
                                        pi_usuario_transaccion         INT,
                                        
                                        pi_transaccion_modificacion    INT,
                                        pi_fk_id_empresa               INT,
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
	
	SET nombre_proceso ='vendedor_modif';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

  
    
      update vendedor set     
                    nombres  = pi_nombres                   ,
                    primer_apellido  = pi_primer_apellido            ,
                    segundo_apellido   = pi_segundo_apellido         ,
                    telefono1     = pi_telefono1              ,
                    telefono2    = pi_telefono2                ,
                    telefono3    = pi_telefono3                ,
                    fk_id_cliente  = pi_fk_id_cliente              ,
                    fecha_transaccion    = current_timestamp()        ,
                    usuario_transaccion   = pi_usuario_transaccion       ,
                    estado_registro ='A'            ,

                    transaccion_modificacion = pi_transaccion_modificacion   ,
                    fk_id_empresa = pi_fk_id_empresa
    where `pk_id_vendedor`=`pi_pk_id_vendedor`;			


      SET po_resultado = `pi_pk_id_vendedor`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



-- Volcando estructura para procedimiento grupo_baja
DROP PROCEDURE IF EXISTS `vendedor_baja`;
DELIMITER //
CREATE  PROCEDURE `vendedor_baja`( `pi_pk_id_vendedor` INT(11),                                 
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
	
	SET nombre_proceso ='vendedor_baja';
	
	START TRANSACTION;
          
	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update vendedor set `fecha_transaccion` = current_timestamp(),
                    `usuario_transaccion` =`pi_usuario_transaccion` ,
                    `estado_registro` ='E',
                    `transaccion_modificacion`  =`pi_transaccion_modificacion`,
                    `fk_id_empresa`=`pi_fk_id_empresa` 	
      where `pk_id_vendedor`=`pi_pk_id_vendedor`;			


      SET po_resultado = `pi_pk_id_vendedor`;
	  SET v_cant_reg = ROW_COUNT();
	  
      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);
	
END//
DELIMITER ;



