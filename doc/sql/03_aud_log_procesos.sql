DROP  TABLE IF EXISTS aud_log_procesos;
-- Volcando estructura para tabla aud_log_procesos
CREATE TABLE aud_log_procesos (
  id_log int(11) NOT NULL AUTO_INCREMENT,
  nombre_proceso text NOT NULL,
  fecha_inicio datetime DEFAULT NULL,
  fecha_fin datetime DEFAULT NULL,
  comentario text,
  cantidad int(11) DEFAULT NULL,
  correcto varchar(1) DEFAULT NULL,
  usuario text,
  ip text,
  param text,
  param_value text,
  package text,
  operacion text,
  sql text,
  sql_data text,
  PRIMARY KEY (id_log)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabla de registro de logs';


-- Volcando estructura para procedimiento audit_insert
DELIMITER //
DROP  PROCEDURE IF EXISTS audit_insert;
CREATE PROCEDURE audit_insert(IN v_nombre_proceso TEXT, IN v_fecha_inicio DATETIME, OUT po_resultado INT)
BEGIN
  	DECLARE v_id INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
	END;
    
    START TRANSACTION;
     INSERT INTO aud_log_procesos
      (nombre_proceso,
       fecha_inicio       
       )
    VALUES
      (
       v_nombre_proceso,
       v_fecha_inicio
		 );
		          
      SET po_resultado = LAST_INSERT_ID();
      COMMIT;          
END//
DELIMITER ;


-- Volcando estructura para procedimiento audit_update
DELIMITER //
DROP  PROCEDURE IF EXISTS audit_update;
CREATE PROCEDURE audit_update(IN v_id_log INT, IN v_fecha_fin DATETIME, IN v_comentario TEXT, IN v_cant_reg INT, IN v_correcto VARCHAR(50), OUT po_resultado INT)
BEGIN
 	DECLARE v_id INT;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION	
    BEGIN		
		ROLLBACK;
		SET po_resultado = -1;
	END;
    
    START TRANSACTION;
    
    update aud_log_procesos
       set fecha_fin    = v_fecha_fin,
           comentario = v_comentario,
           cantidad   = v_cant_reg,
           correcto   = v_correcto
     where id_log = v_id_log;
    commit;
    
    SET po_resultado = 0;
    
END//
DELIMITER ;


