--
-- ER/Studio 8.0 SQL Code Generation
-- Company :      wallejlla
-- Project :      EBIL
-- Author :       wallejlla
--
-- Date Created : Friday, March 13, 2015 07:30:35
-- Target DBMS : MySQL 5.x
--

-- 
-- TABLE: actividad_economica 
--

CREATE TABLE actividad_economica(
    pk_id_actividad_economica             INT            AUTO_INCREMENT,
    actividad_economica                   CHAR(10),
    fk_id_clasificacion_tipo_actividad    INT,
    fecha_transaccion                     DATETIME       NOT NULL,
    usuario_transaccion                   INT,
    estado_registro                       VARCHAR(32),
    transaccion_creacion                  INT,
    transaccion_modificacion              INT,
    fk_id_empresa                         INT,
    PRIMARY KEY (pk_id_actividad_economica)
)ENGINE=INNODB
;



-- 
-- TABLE: almacen 
--

CREATE TABLE almacen(
    pk_id_almacen                          INT             AUTO_INCREMENT,
    cod_almacen                            VARCHAR(255),
    almacen                                VARCHAR(255),
    descripcion                            TEXT,
    fk_id_grupo                            INT,
    fk_id_sistema_valoracion_inventario    INT,
    fecha_transaccion                      DATETIME        NOT NULL,
    usuario_transaccion                    INT,
    estado_registro                        VARCHAR(32),
    transaccion_creacion                   INT,
    transaccion_modificacion               INT,
    fk_id_empresa                          INT,
    PRIMARY KEY (pk_id_almacen)
)ENGINE=INNODB
;



-- 
-- TABLE: archivo 
--

CREATE TABLE archivo(
    pk_id_archivo               INT               AUTO_INCREMENT,
    nombre                      VARCHAR(255),
    extension                   VARCHAR(32),
    bytes                       DECIMAL(15, 5)    NOT NULL,
    ruta                        VARCHAR(255),
    ruta2                       VARCHAR(255),
    fk_id_tipo_archivo          INT,
    fecha_transaccion           DATETIME          NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_archivo)
)ENGINE=INNODB
;



-- 
-- TABLE: bancarizacion 
--

CREATE TABLE bancarizacion(
    pk_id_bancarizacion             INT               AUTO_INCREMENT,
    fk_id_tipo_bancarizacion        INT,
    periodo                         VARCHAR(32),
    fk_id_modalidad_transaccion     INT,
    fecha_fact_dui_fecha_doc        DATETIME          NOT NULL,
    fk_id_tipo_transaccion          INT,
    nit_proveedor                   VARCHAR(255),
    razon_social_proveedor          VARCHAR(255),
    numero_fact_dui_numero_doc      INT,
    monto_fact_dui_monto_doc        DECIMAL(15, 5)    NOT NULL,
    nro_aut_fact_dui_documento      INT,
    numero_cuenta_doc_pago          INT,
    monto_pagado_doc_pago           DECIMAL(15, 5)    NOT NULL,
    monto_acumulado                 DECIMAL(15, 5)    NOT NULL,
    fk_id_nit_entidad_financiera    INT,
    numero_documento_pago           INT,
    fecha_documento_pago            DATETIME          NOT NULL,
    fk_id_tipo_documento            INT,
    fecha_transaccion               DATETIME          NOT NULL,
    usuario_transaccion             INT,
    estado_registro                 VARCHAR(32),
    transaccion_creacion            INT,
    transaccion_modificacion        INT,
    fk_id_empresa                   INT,
    PRIMARY KEY (pk_id_bancarizacion)
)ENGINE=INNODB
;



-- 
-- TABLE: campo_entrada 
--

CREATE TABLE campo_entrada(
    pk_id_campo_entrada            INT             AUTO_INCREMENT,
    campo_entrada                  VARCHAR(255),
    fk_id_entidad_campo_entrada    INT,
    fk_tipo_entrada_formulario     INT,
    fecha_transaccion              DATETIME        NOT NULL,
    usuario_transaccion            INT,
    estado_registro                VARCHAR(32),
    transaccion_creacion           INT,
    transaccion_modificacion       INT,
    fk_id_empresa                  INT,
    PRIMARY KEY (pk_id_campo_entrada)
)ENGINE=INNODB
;



-- 
-- TABLE: campo_formulario 
--

CREATE TABLE campo_formulario(
    pk_id_factura_campo         INT              AUTO_INCREMENT,
    fk_id_campo                 INT,
    usar                        DECIMAL(1, 0),
    visible                     DECIMAL(1, 0),
    requerido                   DECIMAL(1, 0),
    fk_tipo_campo               INT,
    numero_caracteres           INT,
    fk_id_tipo_entidad          INT,
    fecha_transaccion           DATETIME         NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_factura_campo)
)ENGINE=INNODB
;



-- 
-- TABLE: carga_datos 
--

CREATE TABLE carga_datos(
    pk_id_carga_datos           INT            AUTO_INCREMENT,
    cantidad_correctos          INT,
    cantidad_incorrectos        INT,
    fk_id_estado_carga_datos    INT,
    mensaje                     TEXT,
    fk_id_archivo               INT,
    fk_id_tipo_entidad          INT,
    fecha_transaccion           DATETIME       NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_carga_datos)
)ENGINE=INNODB
;



-- 
-- TABLE: catalogo 
--

CREATE TABLE catalogo(
    pk_id_catalogo              INT             AUTO_INCREMENT,
    descripcion                 VARCHAR(255),
    catalogo                    VARCHAR(255),
    negocio                     TEXT,
    orden                       INT,
    dependencia                 INT,
    fecha_transaccion           DATETIME        NOT NULL,
    comentario                  TEXT,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    cnf_base                    VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_catalogo)
)ENGINE=INNODB
;



-- 
-- TABLE: cliente 
--

CREATE TABLE cliente(
    pk_id_cliente                 INT             AUTO_INCREMENT,
    codigo                        VARCHAR(255),
    razon_social                  VARCHAR(255),
    nit                           VARCHAR(255),
    direccion                     VARCHAR(255),
    telefono1                     VARCHAR(255),
    telefono2                     VARCHAR(255),
    telefono3                     VARCHAR(255),
    contacto                      VARCHAR(255),
    fk_id_rubro                   INT,
    fk_id_categoria               INT,
    fk_id_vendedor                INT,
    fk_id_ubicacion_geografica    INT,
    fecha1                        DATETIME        NOT NULL,
    fecha2                        DATETIME        NOT NULL,
    texto1                        VARCHAR(255),
    texto2                        VARCHAR(100),
    fecha_transaccion             DATETIME        NOT NULL,
    usuario_transaccion           INT,
    estado_registro               VARCHAR(32),
    transaccion_creacion          INT,
    transaccion_modificacion      INT,
    fk_id_empresa                 INT,
    PRIMARY KEY (pk_id_cliente)
)ENGINE=INNODB
;



-- 
-- TABLE: compra 
--

CREATE TABLE compra(
    pk_id_compra                              INT               AUTO_INCREMENT,
    nit                                       VARCHAR(255),
    razon_social                              VARCHAR(255),
    numero_factura                            VARCHAR(255),
    numero_autorizacion                       VARCHAR(255),
    fecha_compra                              DATETIME          NOT NULL,
    monto                                     DECIMAL(15, 5)    NOT NULL,
    descuentos                                DECIMAL(15, 5)    NOT NULL,
    fk_id_formato_dato_descuento              INT,
    recargos                                  DECIMAL(15, 5)    NOT NULL,
    fk_id_formato_dato_recargo                INT,
    ice                                       DECIMAL(15, 5)    NOT NULL,
    excentos                                  CHAR(10),
    codigo_control                            VARCHAR(255),
    sujeto_credito_fiscal                     DECIMAL(15, 5)    NOT NULL,
    precio_unitario                           DECIMAL(15, 5)    NOT NULL,
    detalle                                   TEXT,
    unidad                                    VARCHAR(255),
    fk_id_dato_entrada_buscar_unidad          INT,
    centro_costo                              CHAR(10),
    fk_id_dato_entrada_buscar_centro_costo    INT,
    fk_id_tipo_compra                         INT,
    cantidad_dias                             INT,
    fecha_transaccion                         DATETIME          NOT NULL,
    usuario_transaccion                       INT,
    estado_registro                           VARCHAR(32),
    transaccion_creacion                      INT,
    transaccion_modificacion                  INT,
    fk_id_empresa                             INT,
    PRIMARY KEY (pk_id_compra)
)ENGINE=INNODB
;



-- 
-- TABLE: constante 
--

CREATE TABLE constante(
    pk_id_constante    VARCHAR(32)    NOT NULL,
    descripcion        VARCHAR(32)    NOT NULL,
    cnf_base           VARCHAR(32),
    fk_id_empresa      INT,
    PRIMARY KEY (pk_id_constante)
)ENGINE=INNODB
;



-- 
-- TABLE: dato_entrada_buscar 
--

CREATE TABLE dato_entrada_buscar(
    pk_id_dato_entrada_buscar    INT             AUTO_INCREMENT,
    dato_entrada_buscar          VARCHAR(255),
    fk_id_dato_entrada_buscar    INT,
    fecha_transaccion            DATETIME        NOT NULL,
    usuario_transaccion          INT,
    estado_registro              VARCHAR(32),
    transaccion_creacion         INT,
    transaccion_modificacion     INT,
    fk_id_empresa                INT,
    PRIMARY KEY (pk_id_dato_entrada_buscar)
)ENGINE=INNODB
;



-- 
-- TABLE: dosificacion 
--

CREATE TABLE dosificacion(
    pk_id_dosificacion           INT             AUTO_INCREMENT,
    fk_id_sucursal               INT,
    fk_id_actividad_economica    INT,
    numero_correlativo           VARCHAR(128),
    fecha_limite_emision         DATETIME        NOT NULL,
    fecha_ingreso                DATETIME        NOT NULL,
    numero_autorizacion          INT,
    fecha_transaccion            DATETIME        NOT NULL,
    usuario_transaccion          INT,
    estado_registro              VARCHAR(32),
    transaccion_creacion         INT,
    transaccion_modificacion     INT,
    fk_id_empresa                INT,
    PRIMARY KEY (pk_id_dosificacion)
)ENGINE=INNODB
;



-- 
-- TABLE: empresa 
--

CREATE TABLE empresa(
    pk_id_empresa                 INT             AUTO_INCREMENT,
    empresa                       VARCHAR(255),
    nombre_corto                  VARCHAR(255),
    razon_social                  VARCHAR(255),
    nit                           VARCHAR(64),
    direccion                     TEXT,
    telefono1                     VARCHAR(32),
    telefono2                     VARCHAR(32),
    telefono3                     VARCHAR(32),
    fk_id_departamento            INT,
    fk_id_municipio               INT,
    fk_id_tipo_actividad          INT,
    fk_id_tipo_formato_factura    INT,
    fk_tipo_empresa               INT,
    fk_tipo_razon_social          INT,
    fecha_transaccion             DATETIME        NOT NULL,
    fk_id_usuario                 INT,
    estado_registro               VARCHAR(32),
    transaccion_creacion          INT,
    transaccion_modificacion      INT,
    PRIMARY KEY (pk_id_empresa)
)ENGINE=INNODB
;



-- 
-- TABLE: factura 
--

CREATE TABLE factura(
    pk_id_factura                       INT               AUTO_INCREMENT,
    fk_id_sucursal                      INT,
    fecha_factura                       DATETIME          NOT NULL,
    nit                                 VARCHAR(255),
    categoria                           VARCHAR(255),
    razon_social                        VARCHAR(255),
    descuento                           DECIMAL(15, 5)    NOT NULL,
    fk_id_formato_dato_descuento        INT,
    recargo                             DECIMAL(15, 5)    NOT NULL,
    fk_id_formato_dato_recargo          INT,
    ice                                 DECIMAL(15, 5)    NOT NULL,
    excentos                            DECIMAL(15, 5)    NOT NULL,
    fk_id_opcion_tipo_venta             INT,
    cantidad_dias                       INT,
    codigo_control                      CHAR(10),
    cantidad                            DECIMAL(15, 5)    NOT NULL,
    unidad                              VARCHAR(255),
    fk_id_dato_entrada_buscar_unidad    INT,
    detalle                             TEXT,
    precio_unitario                     DECIMAL(15, 5)    NOT NULL,
    total                               CHAR(10),
    sujeto_descuento_fiscal             DECIMAL(15, 5)    NOT NULL,
    fecha_transaccion                   DATETIME          NOT NULL,
    usuario_transaccion                 INT,
    estado_registro                     VARCHAR(32),
    transaccion_creacion                INT,
    transaccion_modificacion            INT,
    fk_id_empresa                       INT,
    PRIMARY KEY (pk_id_factura)
)ENGINE=INNODB
;



-- 
-- TABLE: formato_factura 
--

CREATE TABLE formato_factura(
    pk_id_formato_factura       INT            AUTO_INCREMENT,
    fk_id_tipo_impresion        INT,
    fk_id_tipo_facturacion      INT,
    fk_id_tamanio_impresion     INT,
    fk_id_frase_titulo          INT,
    fk_id_sucursal              INT,
    fk_id_frase_subtitulo       INT,
    fk_frase_pie_pagina         INT,
    fecha_transaccion           DATETIME       NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_formato_factura)
)ENGINE=INNODB
;



-- 
-- TABLE: grupo 
--

CREATE TABLE grupo(
    pk_id_grupo                 INT             AUTO_INCREMENT,
    fk_id_grupo_padre           INT,
    grupo                       VARCHAR(255),
    descripcion                 TEXT,
    fk_id_tipo_grupo            INT,
    fecha_transaccion           DATETIME        NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_grupo)
)ENGINE=INNODB
;



-- 
-- TABLE: item 
--

CREATE TABLE item(
    pk_id_item                    INT               AUTO_INCREMENT,
    codigo_item                   VARCHAR(255),
    codigo_fabrica                VARCHAR(255),
    descripcion                   VARCHAR(255),
    caracteristicas_especiales    VARCHAR(255),
    fk_id_unidad_medida           INT,
    cantidad                      DECIMAL(15, 5),
    costo_unitario                DECIMAL(15, 5)    NOT NULL,
    precio_unitario               DECIMAL(15, 5)    NOT NULL,
    fecha_vencimiento             DATETIME          NOT NULL,
    saldo_minimo                  DECIMAL(15, 5)    NOT NULL,
    fk_id_proveedor               INT,
    fk_id_archivo_imagen          INT,
    fecha_transaccion             DATETIME          NOT NULL,
    usuario_transaccion           INT,
    estado_registro               VARCHAR(32),
    transaccion_creacion          INT,
    transaccion_modificacion      INT,
    fk_id_empresa                 INT,
    PRIMARY KEY (pk_id_item)
)ENGINE=INNODB
;



-- 
-- TABLE: menu 
--

CREATE TABLE menu(
    pk_id_menu                  INT             AUTO_INCREMENT,
    route                       VARCHAR(255)    NOT NULL,
    title                       VARCHAR(255),
    class_item                  VARCHAR(255),
    class_image                 VARCHAR(255),
    position                    INT,
    href                        VARCHAR(255),
    level                       INT,
    type                        VARCHAR(255),
    show_bread                  INT,
    fk_id_menu_father           INT,
    fecha_transaccion           DATETIME        NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_menu)
)ENGINE=INNODB
;



-- 
-- TABLE: movimiento 
--

CREATE TABLE movimiento(
    pk_id_movimiento                       INT               AUTO_INCREMENT,
    cantidad                               DECIMAL(15, 5)    NOT NULL,
    costo_unitario                         DECIMAL(15, 5)    NOT NULL,
    precio_unitario                        DECIMAL(15, 5)    NOT NULL,
    fk_id_tipo_movimiento                  INT,
    fk_id_sistema_valoracion_inventario    INT,
    fk_id_almacen                          INT,
    fk_id_item                             INT,
    fk_id_motivo_movimiento                INT,
    fk_id_factura                          INT,
    fk_id_compra                           INT,
    fecha_transaccion                      DATETIME          NOT NULL,
    usuario_transaccion                    INT,
    estado_registro                        VARCHAR(32),
    transaccion_creacion                   INT,
    transaccion_modificacion               INT,
    fk_id_empresa                          INT,
    PRIMARY KEY (pk_id_movimiento)
)ENGINE=INNODB
;



-- 
-- TABLE: permiso 
--

CREATE TABLE permiso(
    pk_id_permiso               INT             AUTO_INCREMENT,
    permiso                     VARCHAR(255)    NOT NULL,
    fecha_transaccion           DATETIME        NOT NULL,
    descripcion                 VARCHAR(255),
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32)     NOT NULL,
    transaccion_creacion        INT             NOT NULL,
    transaccion_modificacion    INT             NOT NULL,
    PRIMARY KEY (pk_id_permiso)
)ENGINE=INNODB
;



-- 
-- TABLE: persona 
--

CREATE TABLE persona(
    pk_id_persona                     INT             AUTO_INCREMENT,
    nombres                           VARCHAR(255)    NOT NULL,
    apellido_paterno                  VARCHAR(255)    NOT NULL,
    apellido_materno                  VARCHAR(255),
    fk_tipo_documento_identidad       INT,
    numero_identidad                  VARCHAR(255),
    fk_departamento_expedicion_doc    INT,
    fecha_transaccion                 DATETIME        NOT NULL,
    usuario_transaccion               INT,
    estado_registro                   VARCHAR(32),
    transaccion_creacion              INT,
    transaccion_modificacion          INT,
    fk_id_empresa                     INT,
    PRIMARY KEY (pk_id_persona)
)ENGINE=INNODB
;



-- 
-- TABLE: proveedor 
--

CREATE TABLE proveedor(
    pk_id_proveedor               INT             AUTO_INCREMENT,
    codigo                        VARCHAR(255),
    nit                           VARCHAR(255),
    razon_social                  VARCHAR(255),
    direccion                     VARCHAR(255),
    telefono1                     VARCHAR(255),
    telefono2                     VARCHAR(255),
    telefono3                     VARCHAR(255),
    contacto                      VARCHAR(255),
    fk_id_rubro                   INT,
    fk_id_ubicacion_geografica    INT,
    fecha1                        DATETIME        NOT NULL,
    fecha2                        DATETIME        NOT NULL,
    texto1                        VARCHAR(255),
    texto2                        VARCHAR(255),
    fecha_transaccion             DATETIME        NOT NULL,
    usuario_transaccion           INT,
    estado_registro               VARCHAR(32),
    transaccion_creacion          INT,
    transaccion_modificacion      INT,
    fk_id_empresa                 INT,
    PRIMARY KEY (pk_id_proveedor)
)ENGINE=INNODB
;



-- 
-- TABLE: rol 
--

CREATE TABLE rol(
    pk_id_rol                   INT             AUTO_INCREMENT,
    rol                         VARCHAR(128)    NOT NULL,
    descripcion                 VARCHAR(255),
    fecha_transaccion           DATETIME        NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    PRIMARY KEY (pk_id_rol)
)ENGINE=INNODB
;



-- 
-- TABLE: sucursal 
--

CREATE TABLE sucursal(
    pk_id_sucursal              INT             AUTO_INCREMENT,
    sucursal                    VARCHAR(255),
    razon_social                VARCHAR(255),
    numero                      INT,
    direccion                   TEXT,
    telefono1                   VARCHAR(32),
    teefono2                    VARCHAR(32),
    telefono3                   VARCHAR(32),
    fecha_transaccion           DATETIME        NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_sucursal)
)ENGINE=INNODB
;



-- 
-- TABLE: tipo_compra 
--

CREATE TABLE tipo_compra(
    pk_id_tipo_compra           INT            AUTO_INCREMENT,
    fk_id_opcion_tipo_compra    INT,
    cantidad_dias               INT,
    fecha_transaccion           DATETIME       NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_tipo_compra)
)ENGINE=INNODB
;



-- 
-- TABLE: transaccion_log 
--

CREATE TABLE transaccion_log(
    pk_id_transaccion_log    INT             AUTO_INCREMENT,
    fecha_transaccion        DATETIME        NOT NULL,
    ip_cliente               VARCHAR(128),
    ip_servidor              VARCHAR(128),
    navegador                VARCHAR(255),
    descripcion              VARCHAR(255),
    fk_id_usuario            INT,
    fk_id_empresa            INT,
    PRIMARY KEY (pk_id_transaccion_log)
)ENGINE=INNODB
;



-- 
-- TABLE: usuario 
--

CREATE TABLE usuario(
    pk_id_usuario               INT             AUTO_INCREMENT,
    usuario                     VARCHAR(255)    NOT NULL,
    llave                       VARCHAR(255)    NOT NULL,
    fk_id_persona               INT,
    cnf_base                    VARCHAR(32),
    fecha_transaccion           DATETIME        NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_usuario)
)ENGINE=INNODB
;



-- 
-- TABLE: usuario_permiso 
--

CREATE TABLE usuario_permiso(
    pk_id_usuario_permiso       INT            AUTO_INCREMENT,
    fecha_transaccion           DATETIME       NOT NULL,
    fk_id_usuario               INT,
    fk_id_permiso               INT,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_usuario_permiso)
)ENGINE=INNODB
;



-- 
-- TABLE: usuario_rol 
--

CREATE TABLE usuario_rol(
    pk_id_usuario_rol           INT            AUTO_INCREMENT,
    fk_id_usuario               INT,
    fk_id_rol                   INT,
    fecha_transaccion           DATETIME       NOT NULL,
    usuario_transaccion         INT,
    estado_registro             VARCHAR(32),
    transaccion_creacion        INT,
    transaccion_modificacion    INT,
    fk_id_empresa               INT,
    PRIMARY KEY (pk_id_usuario_rol)
)ENGINE=INNODB
;



-- 
-- TABLE: actividad_economica 
--

ALTER TABLE actividad_economica ADD CONSTRAINT Refusuario190 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE actividad_economica ADD CONSTRAINT Refconstante201 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE actividad_economica ADD CONSTRAINT Reftransaccion_log213 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE actividad_economica ADD CONSTRAINT Reftransaccion_log223 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE actividad_economica ADD CONSTRAINT Refempresa235 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE actividad_economica ADD CONSTRAINT Refcatalogo255 
    FOREIGN KEY (fk_id_clasificacion_tipo_actividad)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: almacen 
--

ALTER TABLE almacen ADD CONSTRAINT Refusuario315 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE almacen ADD CONSTRAINT Refgrupo382 
    FOREIGN KEY (fk_id_grupo)
    REFERENCES grupo(pk_id_grupo)
;

ALTER TABLE almacen ADD CONSTRAINT Refcatalogo384 
    FOREIGN KEY (fk_id_sistema_valoracion_inventario)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE almacen ADD CONSTRAINT Refconstante328 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE almacen ADD CONSTRAINT Reftransaccion_log341 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE almacen ADD CONSTRAINT Reftransaccion_log354 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE almacen ADD CONSTRAINT Refempresa379 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: archivo 
--

ALTER TABLE archivo ADD CONSTRAINT Refusuario196 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE archivo ADD CONSTRAINT Refconstante206 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE archivo ADD CONSTRAINT Reftransaccion_log218 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE archivo ADD CONSTRAINT Refempresa240 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE archivo ADD CONSTRAINT Refcatalogo310 
    FOREIGN KEY (fk_id_tipo_archivo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE archivo ADD CONSTRAINT Reftransaccion_log311 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;


-- 
-- TABLE: bancarizacion 
--

ALTER TABLE bancarizacion ADD CONSTRAINT Refusuario327 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refconstante340 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Reftransaccion_log353 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Reftransaccion_log366 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refempresa367 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refcatalogo403 
    FOREIGN KEY (fk_id_modalidad_transaccion)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refcatalogo404 
    FOREIGN KEY (fk_id_tipo_transaccion)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refcatalogo405 
    FOREIGN KEY (fk_id_nit_entidad_financiera)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refcatalogo406 
    FOREIGN KEY (fk_id_tipo_documento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE bancarizacion ADD CONSTRAINT Refcatalogo409 
    FOREIGN KEY (fk_id_tipo_bancarizacion)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: campo_entrada 
--

ALTER TABLE campo_entrada ADD CONSTRAINT Refusuario193 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Refconstante203 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Refcatalogo303 
    FOREIGN KEY (fk_tipo_entrada_formulario)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Refcatalogo304 
    FOREIGN KEY (fk_id_entidad_campo_entrada)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Reftransaccion_log215 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Reftransaccion_log225 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE campo_entrada ADD CONSTRAINT Refempresa237 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: campo_formulario 
--

ALTER TABLE campo_formulario ADD CONSTRAINT Refusuario198 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Refconstante208 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Reftransaccion_log220 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Reftransaccion_log230 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Refempresa242 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Refcatalogo263 
    FOREIGN KEY (fk_id_campo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Refcatalogo266 
    FOREIGN KEY (fk_tipo_campo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE campo_formulario ADD CONSTRAINT Refcatalogo288 
    FOREIGN KEY (fk_id_tipo_entidad)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: carga_datos 
--

ALTER TABLE carga_datos ADD CONSTRAINT Refusuario195 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE carga_datos ADD CONSTRAINT Refconstante205 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE carga_datos ADD CONSTRAINT Reftransaccion_log217 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE carga_datos ADD CONSTRAINT Reftransaccion_log227 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE carga_datos ADD CONSTRAINT Refempresa239 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE carga_datos ADD CONSTRAINT Refarchivo312 
    FOREIGN KEY (fk_id_archivo)
    REFERENCES archivo(pk_id_archivo)
;

ALTER TABLE carga_datos ADD CONSTRAINT Refcatalogo313 
    FOREIGN KEY (fk_id_tipo_entidad)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE carga_datos ADD CONSTRAINT Refcatalogo314 
    FOREIGN KEY (fk_id_estado_carga_datos)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: catalogo 
--

ALTER TABLE catalogo ADD CONSTRAINT Refusuario171 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE catalogo ADD CONSTRAINT Reftransaccion_log172 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE catalogo ADD CONSTRAINT Reftransaccion_log173 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE catalogo ADD CONSTRAINT Refempresa264 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE catalogo ADD CONSTRAINT Refconstante2 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE catalogo ADD CONSTRAINT Refconstante3 
    FOREIGN KEY (cnf_base)
    REFERENCES constante(pk_id_constante)
;


-- 
-- TABLE: cliente 
--

ALTER TABLE cliente ADD CONSTRAINT Refcampo_entrada298 
    FOREIGN KEY (fk_id_rubro)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE cliente ADD CONSTRAINT Refcampo_entrada300 
    FOREIGN KEY (fk_id_categoria)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE cliente ADD CONSTRAINT Refcampo_entrada301 
    FOREIGN KEY (fk_id_ubicacion_geografica)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE cliente ADD CONSTRAINT Refcampo_entrada302 
    FOREIGN KEY (fk_id_vendedor)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE cliente ADD CONSTRAINT Refusuario291 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE cliente ADD CONSTRAINT Refconstante292 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE cliente ADD CONSTRAINT Reftransaccion_log293 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE cliente ADD CONSTRAINT Reftransaccion_log294 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE cliente ADD CONSTRAINT Refempresa295 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: compra 
--

ALTER TABLE compra ADD CONSTRAINT Refusuario317 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE compra ADD CONSTRAINT Refcatalogo391 
    FOREIGN KEY (fk_id_formato_dato_recargo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE compra ADD CONSTRAINT Refcatalogo392 
    FOREIGN KEY (fk_id_formato_dato_descuento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE compra ADD CONSTRAINT Refconstante330 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE compra ADD CONSTRAINT Reftransaccion_log343 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE compra ADD CONSTRAINT Reftransaccion_log356 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE compra ADD CONSTRAINT Refempresa377 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE compra ADD CONSTRAINT Refdato_entrada_buscar389 
    FOREIGN KEY (fk_id_dato_entrada_buscar_unidad)
    REFERENCES dato_entrada_buscar(pk_id_dato_entrada_buscar)
;

ALTER TABLE compra ADD CONSTRAINT Refdato_entrada_buscar390 
    FOREIGN KEY (fk_id_dato_entrada_buscar_centro_costo)
    REFERENCES dato_entrada_buscar(pk_id_dato_entrada_buscar)
;

ALTER TABLE compra ADD CONSTRAINT Reftipo_compra394 
    FOREIGN KEY (fk_id_tipo_compra)
    REFERENCES tipo_compra(pk_id_tipo_compra)
;


-- 
-- TABLE: constante 
--

ALTER TABLE constante ADD CONSTRAINT Refempresa265 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE constante ADD CONSTRAINT Refconstante1 
    FOREIGN KEY (cnf_base)
    REFERENCES constante(pk_id_constante)
;


-- 
-- TABLE: dato_entrada_buscar 
--

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Refusuario320 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Refconstante333 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Reftransaccion_log346 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Reftransaccion_log359 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Refempresa374 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE dato_entrada_buscar ADD CONSTRAINT Refcatalogo388 
    FOREIGN KEY (fk_id_dato_entrada_buscar)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: dosificacion 
--

ALTER TABLE dosificacion ADD CONSTRAINT Refusuario192 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE dosificacion ADD CONSTRAINT Refconstante202 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE dosificacion ADD CONSTRAINT Reftransaccion_log214 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE dosificacion ADD CONSTRAINT Reftransaccion_log224 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE dosificacion ADD CONSTRAINT Refempresa236 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE dosificacion ADD CONSTRAINT Refsucursal267 
    FOREIGN KEY (fk_id_sucursal)
    REFERENCES sucursal(pk_id_sucursal)
;

ALTER TABLE dosificacion ADD CONSTRAINT Refactividad_economica268 
    FOREIGN KEY (fk_id_actividad_economica)
    REFERENCES actividad_economica(pk_id_actividad_economica)
;


-- 
-- TABLE: empresa 
--

ALTER TABLE empresa ADD CONSTRAINT Refusuario191 
    FOREIGN KEY (fk_id_usuario)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE empresa ADD CONSTRAINT Refconstante209 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE empresa ADD CONSTRAINT Reftransaccion_log211 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE empresa ADD CONSTRAINT Reftransaccion_log231 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo248 
    FOREIGN KEY (fk_id_departamento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo249 
    FOREIGN KEY (fk_id_municipio)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo256 
    FOREIGN KEY (fk_id_tipo_actividad)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo257 
    FOREIGN KEY (fk_id_tipo_formato_factura)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo289 
    FOREIGN KEY (fk_tipo_empresa)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE empresa ADD CONSTRAINT Refcatalogo290 
    FOREIGN KEY (fk_tipo_razon_social)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: factura 
--

ALTER TABLE factura ADD CONSTRAINT Refusuario326 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE factura ADD CONSTRAINT Refcatalogo396 
    FOREIGN KEY (fk_id_formato_dato_recargo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE factura ADD CONSTRAINT Refcatalogo397 
    FOREIGN KEY (fk_id_formato_dato_descuento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE factura ADD CONSTRAINT Refcatalogo398 
    FOREIGN KEY (fk_id_opcion_tipo_venta)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE factura ADD CONSTRAINT Refconstante339 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE factura ADD CONSTRAINT Reftransaccion_log352 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE factura ADD CONSTRAINT Reftransaccion_log365 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE factura ADD CONSTRAINT Refempresa368 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE factura ADD CONSTRAINT Refsucursal395 
    FOREIGN KEY (fk_id_sucursal)
    REFERENCES sucursal(pk_id_sucursal)
;

ALTER TABLE factura ADD CONSTRAINT Refdato_entrada_buscar399 
    FOREIGN KEY (fk_id_dato_entrada_buscar_unidad)
    REFERENCES dato_entrada_buscar(pk_id_dato_entrada_buscar)
;


-- 
-- TABLE: formato_factura 
--

ALTER TABLE formato_factura ADD CONSTRAINT Refusuario189 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refconstante200 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE formato_factura ADD CONSTRAINT Reftransaccion_log212 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE formato_factura ADD CONSTRAINT Reftransaccion_log222 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo252 
    FOREIGN KEY (fk_id_tipo_facturacion)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo253 
    FOREIGN KEY (fk_id_tipo_impresion)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refempresa254 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refsucursal258 
    FOREIGN KEY (fk_id_sucursal)
    REFERENCES sucursal(pk_id_sucursal)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo259 
    FOREIGN KEY (fk_id_tamanio_impresion)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo260 
    FOREIGN KEY (fk_id_frase_titulo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo261 
    FOREIGN KEY (fk_id_frase_subtitulo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE formato_factura ADD CONSTRAINT Refcatalogo262 
    FOREIGN KEY (fk_frase_pie_pagina)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: grupo 
--

ALTER TABLE grupo ADD CONSTRAINT Refusuario316 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE grupo ADD CONSTRAINT Refgrupo380 
    FOREIGN KEY (fk_id_grupo_padre)
    REFERENCES grupo(pk_id_grupo)
;

ALTER TABLE grupo ADD CONSTRAINT Refcatalogo381 
    FOREIGN KEY (fk_id_tipo_grupo)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE grupo ADD CONSTRAINT Refconstante329 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE grupo ADD CONSTRAINT Reftransaccion_log342 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE grupo ADD CONSTRAINT Reftransaccion_log355 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE grupo ADD CONSTRAINT Refempresa378 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: item 
--

ALTER TABLE item ADD CONSTRAINT Refusuario197 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE item ADD CONSTRAINT Refconstante207 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE item ADD CONSTRAINT Reftransaccion_log219 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE item ADD CONSTRAINT Reftransaccion_log229 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE item ADD CONSTRAINT Refempresa241 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE item ADD CONSTRAINT Refcampo_entrada305 
    FOREIGN KEY (fk_id_unidad_medida)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE item ADD CONSTRAINT Refproveedor306 
    FOREIGN KEY (fk_id_proveedor)
    REFERENCES proveedor(pk_id_proveedor)
;

ALTER TABLE item ADD CONSTRAINT Refarchivo309 
    FOREIGN KEY (fk_id_archivo_imagen)
    REFERENCES archivo(pk_id_archivo)
;


-- 
-- TABLE: menu 
--

ALTER TABLE menu ADD CONSTRAINT Refusuario321 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE menu ADD CONSTRAINT Refconstante334 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE menu ADD CONSTRAINT Reftransaccion_log347 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE menu ADD CONSTRAINT Reftransaccion_log360 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE menu ADD CONSTRAINT Refempresa373 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE menu ADD CONSTRAINT Refmenu411 
    FOREIGN KEY (fk_id_menu_father)
    REFERENCES menu(pk_id_menu)
;


-- 
-- TABLE: movimiento 
--

ALTER TABLE movimiento ADD CONSTRAINT Refusuario318 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE movimiento ADD CONSTRAINT Refcatalogo385 
    FOREIGN KEY (fk_id_sistema_valoracion_inventario)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE movimiento ADD CONSTRAINT Refcatalogo386 
    FOREIGN KEY (fk_id_tipo_movimiento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE movimiento ADD CONSTRAINT Refalmacen387 
    FOREIGN KEY (fk_id_almacen)
    REFERENCES almacen(pk_id_almacen)
;

ALTER TABLE movimiento ADD CONSTRAINT Refconstante331 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE movimiento ADD CONSTRAINT Reffactura400 
    FOREIGN KEY (fk_id_factura)
    REFERENCES factura(pk_id_factura)
;

ALTER TABLE movimiento ADD CONSTRAINT Refitem401 
    FOREIGN KEY (fk_id_item)
    REFERENCES item(pk_id_item)
;

ALTER TABLE movimiento ADD CONSTRAINT Refcompra407 
    FOREIGN KEY (fk_id_compra)
    REFERENCES compra(pk_id_compra)
;

ALTER TABLE movimiento ADD CONSTRAINT Reftransaccion_log344 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE movimiento ADD CONSTRAINT Refcatalogo408 
    FOREIGN KEY (fk_id_motivo_movimiento)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE movimiento ADD CONSTRAINT Reftransaccion_log357 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE movimiento ADD CONSTRAINT Refempresa376 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: permiso 
--

ALTER TABLE permiso ADD CONSTRAINT Refconstante69 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE permiso ADD CONSTRAINT Reftransaccion_log70 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE permiso ADD CONSTRAINT Reftransaccion_log71 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE permiso ADD CONSTRAINT Refusuario100 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;


-- 
-- TABLE: persona 
--

ALTER TABLE persona ADD CONSTRAINT Refcatalogo181 
    FOREIGN KEY (fk_departamento_expedicion_doc)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE persona ADD CONSTRAINT Refcatalogo182 
    FOREIGN KEY (fk_tipo_documento_identidad)
    REFERENCES catalogo(pk_id_catalogo)
;

ALTER TABLE persona ADD CONSTRAINT Refempresa232 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE persona ADD CONSTRAINT Reftransaccion_log27 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE persona ADD CONSTRAINT Refconstante33 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE persona ADD CONSTRAINT Reftransaccion_log35 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE persona ADD CONSTRAINT Refusuario109 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;


-- 
-- TABLE: proveedor 
--

ALTER TABLE proveedor ADD CONSTRAINT Refusuario194 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE proveedor ADD CONSTRAINT Refconstante204 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE proveedor ADD CONSTRAINT Reftransaccion_log216 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE proveedor ADD CONSTRAINT Reftransaccion_log226 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE proveedor ADD CONSTRAINT Refempresa238 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE proveedor ADD CONSTRAINT Refcampo_entrada307 
    FOREIGN KEY (fk_id_rubro)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;

ALTER TABLE proveedor ADD CONSTRAINT Refcampo_entrada308 
    FOREIGN KEY (fk_id_ubicacion_geografica)
    REFERENCES campo_entrada(pk_id_campo_entrada)
;


-- 
-- TABLE: rol 
--

ALTER TABLE rol ADD CONSTRAINT Refconstante38 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE rol ADD CONSTRAINT Reftransaccion_log43 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE rol ADD CONSTRAINT Reftransaccion_log44 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE rol ADD CONSTRAINT Refusuario111 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;


-- 
-- TABLE: sucursal 
--

ALTER TABLE sucursal ADD CONSTRAINT Refusuario188 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE sucursal ADD CONSTRAINT Refconstante199 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE sucursal ADD CONSTRAINT Reftransaccion_log210 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE sucursal ADD CONSTRAINT Reftransaccion_log221 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE sucursal ADD CONSTRAINT Refempresa233 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;


-- 
-- TABLE: tipo_compra 
--

ALTER TABLE tipo_compra ADD CONSTRAINT Refusuario319 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE tipo_compra ADD CONSTRAINT Refconstante332 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE tipo_compra ADD CONSTRAINT Reftransaccion_log345 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE tipo_compra ADD CONSTRAINT Reftransaccion_log358 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE tipo_compra ADD CONSTRAINT Refempresa375 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE tipo_compra ADD CONSTRAINT Refcatalogo393 
    FOREIGN KEY (fk_id_opcion_tipo_compra)
    REFERENCES catalogo(pk_id_catalogo)
;


-- 
-- TABLE: transaccion_log 
--

ALTER TABLE transaccion_log ADD CONSTRAINT Refempresa247 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE transaccion_log ADD CONSTRAINT Refusuario11 
    FOREIGN KEY (fk_id_usuario)
    REFERENCES usuario(pk_id_usuario)
;


-- 
-- TABLE: usuario 
--

ALTER TABLE usuario ADD CONSTRAINT Refempresa244 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE usuario ADD CONSTRAINT Refconstante31 
    FOREIGN KEY (cnf_base)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE usuario ADD CONSTRAINT Refconstante37 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE usuario ADD CONSTRAINT Reftransaccion_log39 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario ADD CONSTRAINT Reftransaccion_log40 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario ADD CONSTRAINT Refpersona61 
    FOREIGN KEY (fk_id_persona)
    REFERENCES persona(pk_id_persona)
;

ALTER TABLE usuario ADD CONSTRAINT Refusuario96 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;


-- 
-- TABLE: usuario_permiso 
--

ALTER TABLE usuario_permiso ADD CONSTRAINT Refusuario325 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Refconstante338 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Reftransaccion_log351 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Reftransaccion_log364 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Refempresa369 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Refusuario412 
    FOREIGN KEY (fk_id_usuario)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE usuario_permiso ADD CONSTRAINT Refpermiso413 
    FOREIGN KEY (fk_id_permiso)
    REFERENCES permiso(pk_id_permiso)
;


-- 
-- TABLE: usuario_rol 
--

ALTER TABLE usuario_rol ADD CONSTRAINT Refempresa245 
    FOREIGN KEY (fk_id_empresa)
    REFERENCES empresa(pk_id_empresa)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Refusuario28 
    FOREIGN KEY (fk_id_usuario)
    REFERENCES usuario(pk_id_usuario)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Refrol29 
    FOREIGN KEY (fk_id_rol)
    REFERENCES rol(pk_id_rol)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Refconstante36 
    FOREIGN KEY (estado_registro)
    REFERENCES constante(pk_id_constante)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Reftransaccion_log41 
    FOREIGN KEY (transaccion_creacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Reftransaccion_log42 
    FOREIGN KEY (transaccion_modificacion)
    REFERENCES transaccion_log(pk_id_transaccion_log)
;

ALTER TABLE usuario_rol ADD CONSTRAINT Refusuario97 
    FOREIGN KEY (usuario_transaccion)
    REFERENCES usuario(pk_id_usuario)
;


