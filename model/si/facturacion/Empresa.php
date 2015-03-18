<?php
/**
* Class Empresa.
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
* Class Empresa
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
    class Empresa {
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
     const INSERT = "INSERT TABLE EMPRESA";
     const UPDATE = "UPDATE TABLE EMPRESA";
     const DELETE = "DELETE TABLE EMPRESA";
     const SELECT = "SELECT TABLE EMPRESA";
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
        public function getList($idEmpresa = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = "select    		pk_id_empresa ,
                                                empresa ,
						nombre_corto,
                                                razon_social ,
                                                nit ,
                                                direccion ,
                                                telefono1 ,
                                                telefono2 ,
                                                telefono3 ,
                                                fk_id_departamento ,
                                                fk_id_municipio ,
                                                fk_id_tipo_actividad ,
                                                fk_id_tipo_formato_factura ,
                                                fk_tipo_empresa ,
                                                fk_tipo_razon_social ,
                                                date_format(fecha_transaccion,'%d-%m-%Y %H:%i:%s') fecha_transaccion,
                                                fk_id_usuario ,
                                                estado_registro ,
                                                transaccion_creacion ,
                                                transaccion_modificacion
                           from   empresa 
                           where  estado_registro <> 'E' ";

                if( $idEmpresa != self::ALL){
                $query = $query." and pk_id_empresa = ?";
                $result = DataBase::getArrayListQuery($query, array($idEmpresa), $this->instanceDataBase);
                }
                else{
                $result = DataBase::getArrayListQuery($query,array(), $this->instanceDataBase);
                }
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
        public function isExist( $dato ){
            $result = false;
            $query = NULL;
            $aux = NULL;
            try{
                $query = "select count(1) existe
                          from empresa
                          where estado_registro = 'A' 
                          and ( nombre_corto = ? or razon_social = ? or nit = ? )";

                $resultAux = DataBase::getArrayListQuery($query, $dato, $this->instanceDataBase);
                $aux = $resultAux[0];
                $result = $aux["existe"]==0 ? false : true;
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
        public function insert($data){
            $result = null;
            $query = null;
            try{
                $id=-1;        
        
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call empresa_alta(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $data[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $data[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $data[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $data[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $data[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $data[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $data[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $data[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $data[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $data[9], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(11, $data[10], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(12, $data[11], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(13, $data[12], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(14, $data[13], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(15, $data[14], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(16, $data[15], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(17, $data[16], PDO::PARAM_STR, 4000);                                 

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
        public function delete($data){
            $result = null;
            $query = null;
            try{
                $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call empresa_baja(?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $data[0], PDO::PARAM_STR, 4000);  
                $sentencia->bindParam(2, $data[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $data[2], PDO::PARAM_STR, 4000); 

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
        public function update($data){
            $result = null;
            $query = null;
            try{
                 $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call empresa_modif(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@resultado); ");
                $sentencia->bindParam(1, $data[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $data[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $data[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $data[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $data[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $data[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $data[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $data[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $data[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $data[9], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(11, $data[10], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(12, $data[11], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(13, $data[12], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(14, $data[13], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(15, $data[14], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(16, $data[15], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(17, $data[16], PDO::PARAM_STR, 4000); 

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
    }
?>