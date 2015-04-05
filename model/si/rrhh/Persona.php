<?php
/**
* Class Persona.
*
* Implementation of the class Permiso.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Model
* @author       Juan Carlos Torrico Rios
* @copyright    2015 Juan Carlos Torrico Rios
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2015
* @deprecated   No
*/

/**
* Class Persona
*
* Implementation of class Permiso.
*
* @category   EBIL
* @package    Model
* @author     Juan Carlos Torrico Rios
* @copyright  2015 Juan Carlos Torrico Rios
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2015
* @deprecated No
*/
    class Persona {
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
     const INSERT = "INSERT TABLE RRHH_PERSONA";
     const UPDATE = "UPDATE TABLE RRHH_PERSONA";
     const DELETE = "DELETE TABLE RRHH_PERSONA";
     const SELECT = "SELECT TABLE RRHH_PERSONA";
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
        public function getList($idPersona = self::ALL, $idEmpresa = self::ALL ){
            $result = null;
            $query = null;
            try{
                $query = "SELECT  pk_id_persona, 
                                  nombres, 
                                  apellido_paterno, 
                                  apellido_materno, 
                                  fk_tipo_documento_identidad, 
                                  (select abreviacion from catalogo where pk_id_catalogo = fk_tipo_documento_identidad) tipo_documento_identidad,
                                  numero_identidad, 
                                  fk_departamento_expedicion_doc, 
                                  (select abreviacion from catalogo where pk_id_catalogo = fk_departamento_expedicion_doc) departamento_expedicion_doc,
                                  direccion, 
                                  telefono1, 
                                  telefono2, 
                                  telefono3, 
                                  fk_id_archivo_foto, 
                                  fecha_transaccion, 
                                  usuario_transaccion, 
                                  estado_registro, 
                                  transaccion_creacion, 
                                  transaccion_modificacion, 
                                  fk_id_empresa,
                                  (select concat(nombre_corto,' (NIT: ',nit,')') from empresa where pk_id_empresa = fk_id_empresa and estado_registro = 'A') empresa,
                                  (select concat(fk_id_empresa,'_',pk_id_archivo,'.',extension) from archivo where pk_id_archivo = fk_id_archivo_foto and estado_registro = 'A') nombre_archivo_foto
                           FROM   persona
                           WHERE  estado_registro = 'A' ";

                if( $idPersona != self::ALL){
                    if($idEmpresa != self::ALL){
                        $query = $query." AND pk_id_persona = ? AND fk_id_empresa = ? ";
                        $result = DataBase::getArrayListQuery($query, array($idPersona, $idEmpresa), $this->instanceDataBase);
                    } else{
                        $query = $query." AND pk_id_persona = ?";
                        $result = DataBase::getArrayListQuery($query, array($idPersona), $this->instanceDataBase);
                    }                
                } else{
                    if($idEmpresa != self::ALL){
                        $query = $query." AND fk_id_empresa = ?";
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
            $result = null;
            $query = null;
            try{
                $id=-1;        
        
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call persona_alta(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, @resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $datos[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $datos[9], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(11, $datos[10], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(12, $datos[11], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(13, $datos[12], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(14, $datos[13], PDO::PARAM_STR, 4000);
                $sentencia->bindParam(15, $datos[14], PDO::PARAM_STR, 4000);
                
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                 $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0){
                   $id = $result[0]['resultado'];
                }
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
            $result = null;
            $query = null;
            try{
                $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call persona_baja(?,?,?,?,?, @resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000);  
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000);                               
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000);                               
                
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0){
                   $id = $result[0]['resultado'];
                }
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
            $result = null;
            $query = null;
            try{
               $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call persona_modif(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, @resultado); ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $datos[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $datos[9], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(11, $datos[10], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(12, $datos[11], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(13, $datos[12], PDO::PARAM_STR, 4000);                                                  
                $sentencia->bindParam(14, $datos[13], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(15, $datos[14], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(16, $datos[15], PDO::PARAM_STR, 4000); 

                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0){
                   $id = $result[0]['resultado'];
                }
                return $id;
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
        public function isExist( $datos ){
            $result = false;
            $query = NULL;
            $aux = NULL;
            try{
                $query = "select count(1) existe
                          from persona
                          where estado_registro = 'A' 
                          and fk_tipo_documento_identidad = ? 
                          and numero_identidad = ? 
                          and fk_departamento_expedicion_doc = ? 
                          and fk_id_empresa = ? ";

                $resultAux = DataBase::getArrayListQuery($query, $datos, $this->instanceDataBase);
                $aux = $resultAux[0];
                $result = $aux["existe"]==0 ? false : true;
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }
     
     // }}}
    }
?>