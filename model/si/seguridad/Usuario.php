<?php
/**
* Class Usuario.
*
* Implementation of the class Usuario.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Model
* @author       Luis Fernando Almendras Aruzamen
* @copyright    2015 Luis Fernando Almendras Aruzamen
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2015
* @deprecated   No
*/

/**
* Class Usuario
*
* Implementation of class Usuario.
*
* @category   EBIL
* @package    Model
* @author     Luis Fernando Almendras Aruzamen
* @copyright  2015 Luis Fernando Almendras Aruzamen
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2015
* @deprecated No
*/
    class Usuario {
     // {{{ Constants

    /**
     * Constant for represent all registers.
     *
     * @access private
     */
     const ALL = -1;
     const VALUE = 1;
     const NONE = 0;
     // Operations
     const INSERT = "INSERT TABLE USUARIO";
     const UPDATE = "UPDATE TABLE USUARIO";
     const DELETE = "DELETE TABLE USUARIO";
     const SELECT = "SELECT TABLE USUARIO";

     const ROLE_ADMINISTRATOR_DEFAULT = "Administrador"; // Rol Administrator
     const ROLE_ROOT_DEFAULT = "SuperUsuario"; // Rol Super Usuario
     const ROLE_OPERATOR_DEFAULT = "Operador"; // Rol Reportes

    // }}}

    // {{{ atributos

    /**
     * Variable instance Data Base.
     *
     * @var DataBase
     * @access private
     */
        private  $instanceDataBase;
    // }}}

    // {{{ constructores

    /**
     * This is construct base of the class.
     *
     * A public constructor; initializes the variable $instanceDataBase.
     *
     */
        public function __construct( $instanceDataBase ) {
            $this->instanceDataBase = $instanceDataBase;
        }
    // }}}

    // {{{ metodos

/**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function getLoginUsuario($user, $password, $role= self::ROLE_OPERATOR_DEFAULT ){
            $result = false;
            $query = null;
            $resAux = null;
            try{
                $query = "select count(1) login 
                         from usuario a, rol b, usuario_rol c 
                         where a.estado_registro = 'A' 
                         and a.usuario = ? 
                         and a.llave = password(?) 
                         and b.estado_registro = 'A' 
                         and c.estado_registro = 'A' 
                         and c.fk_id_usuario = a.pk_id_usuario 
                         and c.fk_id_rol = b.pk_id_rol ";

                $resultAux = DataBase::getArrayListQuery($query, array($user, $password), $this->instanceDataBase);
                $aux = $resultAux[0];
                $result = $aux["login"]==1 ? true : false;
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }

        /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function getIdUsuario($user, $password, $role= self::ROLE_OPERATOR_DEFAULT ){
            $result = -1;
            $query = null;
            $resAux = null;
            try{
                $query = "select a.pk_id_usuario 
                         from usuario a, rol b, usuario_rol c 
                         where a.estado_registro = 'A' 
                         and a.usuario = ? 
                         and a.llave = password(?) 
                         and b.estado_registro = 'A' 
                         and c.estado_registro = 'A' 
                         and c.fk_id_usuario = a.pk_id_usuario 
                         and c.fk_id_rol = b.pk_id_rol ";
                
                $resultAux = DataBase::getArrayListQuery($query, array($user, $password), $this->instanceDataBase);

                $aux = $resultAux[0];
                $result = $aux["pk_id_usuario"];
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }

    /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function getList($idUsuario = self::ALL, $idEmpresa = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = "select a.pk_id_usuario, a.usuario, a.llave, a.fk_id_persona, a.cnf_base, 
                        a.fecha_transaccion, a.usuario_transaccion, a.estado_registro, 
                        a.transaccion_creacion, a.transaccion_modificacion, a.fk_id_empresa, 
                        b.nombres, b.apellido_paterno, b.apellido_materno, 
                        b.fk_tipo_documento_identidad, (select abreviacion from catalogo where pk_id_catalogo = b.fk_tipo_documento_identidad) tipo_documento_identidad,
                        b.numero_identidad, 
                        b.fk_departamento_expedicion_doc, (select abreviacion from catalogo where pk_id_catalogo = b.fk_departamento_expedicion_doc) departamento_expedicion_doc, 
                        c.fk_id_rol, d.rol, c.pk_id_usuario_rol,
                        e.empresa, e.nombre_corto, e.nit
                        from usuario a, persona b, usuario_rol c, rol d, empresa e 
                        where a.estado_registro = 'A'  
                        and b.estado_registro = 'A' 
                        and a.fk_id_persona = b.pk_id_persona 
                        and c.estado_registro = 'A' 
                        and c.fk_id_usuario = a.pk_id_usuario 
                        and d.estado_registro = 'A' 
                        and c.fk_id_rol = d.pk_id_rol 
                        and e.estado_registro = 'A'
                        and a.fk_id_empresa = e.pk_id_empresa ";

                if( $idUsuario != self::ALL){
                    if( $idEmpresa != self::ALL){
                        $query = $query." and a.pk_id_usuario = ? and a.fk_id_empresa = ? ";
                        $result = DataBase::getArrayListQuery($query, array($idUsuario, $idEmpresa), $this->instanceDataBase);
                    } else{
                        $query = $query." and a.pk_id_usuario = ?";
                        $result = DataBase::getArrayListQuery($query, array($idUsuario), $this->instanceDataBase);
                    }                
                } else{
                    if( $idEmpresa != self::ALL){
                        $query = $query." and a.fk_id_empresa = ?";
                        $result = DataBase::getArrayListQuery($query, array($idEmpresa), $this->instanceDataBase);
                    } else{
                        $result = DataBase::getArrayListQuery($query,array(), $this->instanceDataBase);
                    }
                }
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }

    /**
     * The implementation method for insert data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function insert($datos){
          
            try{
                $id=-1;        
        
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call usuario_alta(?,?,?,?,?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 

                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                 $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }           
        }

     /**
     * The implementation method for delete data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function delete($datos){
        
            try{
              $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call usuario_baja(?,?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000);  
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000);                               
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000);
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }              
        }

     /**
     * The implementation method for update data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function update($datos){
           
            try{
                $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call usuario_modif(?,?,?,?,?,?,?,?,?,@resultado); ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $datos[8], PDO::PARAM_STR, 4000); 
            
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }              
        }
     // }}}
    }
?>
