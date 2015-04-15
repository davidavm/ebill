DROP PROCEDURE IF EXISTS `sucursal_baja`;
DELIMITER //
CREATE   PROCEDURE `sucursal_baja`(
        `pi_pk_id_sucursal` INT(11),
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

	SET nombre_proceso ='sucursal_baja';

	START TRANSACTION;

	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;

      update sucursal set `fecha_transaccion` = current_timestamp(),
									`usuario_transaccion` =`pi_usuario_transaccion` ,
									`estado_registro` ='E',
									`transaccion_modificacion`  =`pi_transaccion_modificacion`,
									`fk_id_empresa`=`pi_fk_id_empresa`
					where `pk_id_sucursal`=`pi_pk_id_sucursal`;


      SET po_resultado = `pi_pk_id_sucursal`;
	  SET v_cant_reg = ROW_COUNT();

      COMMIT;

	  CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END //
DELIMITER ;

#
# Definition for the `sucursal_alta` procedure :
#

DROP PROCEDURE IF EXISTS `sucursal_alta`;
DELIMITER //
CREATE   PROCEDURE `sucursal_alta`(
        `pi_sucursal` VARCHAR(255),
        `pi_numero` INT(11) ,
        `pi_direccion` TEXT ,
        `pi_telefono1` VARCHAR(32) ,
        `pi_telefono2` VARCHAR(32) ,
        `pi_telefono3` VARCHAR(32) ,
        `pi_usuario_transaccion` INT(11),
        `pi_transaccion_creacion` INT(11) ,
        `pi_transaccion_modificacion` INT(11) ,
        `pi_fk_id_empresa` INT(11),
        OUT po_resultado INT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
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

	SET nombre_proceso ='sucursal_alta';

	START TRANSACTION;

	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;



      INSERT INTO sucursal (`sucursal` ,
									`numero`  ,
									`direccion`  ,
									`telefono1`  ,
									`telefono2`  ,
									`telefono3`  ,
									`fecha_transaccion`  ,
									`usuario_transaccion` ,
									`estado_registro` ,
									`transaccion_creacion` ,
									`transaccion_modificacion`  ,
									`fk_id_empresa`)
									VALUES
									(
								    `pi_sucursal` ,
									`pi_numero`  ,
									`pi_direccion`  ,
									`pi_telefono1`  ,
									`pi_telefono2`  ,
									`pi_telefono3`  ,
									current_timestamp()  ,
									`pi_usuario_transaccion` ,
									'A' ,
									`pi_transaccion_creacion` ,
									`pi_transaccion_modificacion`  ,
									`pi_fk_id_empresa`
		        					);

      SET po_resultado = LAST_INSERT_ID();
	  SET v_cant_reg = ROW_COUNT();

      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END //
DELIMITER ;

#
# Definition for the `sucursal_modif` procedure :
#

DROP PROCEDURE IF EXISTS `sucursal_modif`;
DELIMITER //
CREATE   PROCEDURE `sucursal_modif`(
        IN `pi_pk_id_sucursal` INTEGER(11),
        IN `pi_sucursal` VARCHAR(255),
        IN `pi_numero` INTEGER(11),
        IN `pi_direccion` TEXT,
        IN `pi_telefono1` VARCHAR(32),
        IN `pi_telefono2` VARCHAR(32),
        IN `pi_telefono3` VARCHAR(32),
        IN `pi_usuario_transaccion` INTEGER(11),
        IN `pi_transaccion_modificacion` INTEGER(11),
        IN `pi_fk_id_empresa` INTEGER(11),
        OUT po_resultado INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
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

	SET nombre_proceso ='sucursal_alta';

	START TRANSACTION;

	-- REGISTRO DE LOG
	CALL audit_insert(nombre_proceso, current_timestamp(), @resultado);
	SELECT @resultado INTO v_res;


      update sucursal set         `sucursal` = `pi_sucursal` ,
								`numero` = `pi_numero`,
								`direccion` = `pi_direccion`,
								`telefono1` = `pi_telefono1`,
								`telefono2` = `pi_telefono2`,
								`telefono3` = `pi_telefono3`,
								`fecha_transaccion` = current_timestamp() ,
								`usuario_transaccion` = `pi_usuario_transaccion`,
								`estado_registro` = 'A',
								`transaccion_modificacion` = `pi_transaccion_modificacion`,
								`fk_id_empresa` = `pi_fk_id_empresa`
					where `pk_id_sucursal`=`pi_pk_id_sucursal`;


      SET po_resultado = `pi_pk_id_sucursal`;
	  SET v_cant_reg = ROW_COUNT();

      COMMIT;

      CALL audit_update(v_res, current_timestamp(), 'OK: PROCESO TERMINO CORRECTAMENTE', v_cant_reg, 'S', @resultado);

END //
DELIMITER ;