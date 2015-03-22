<?php
/**
* Class Sucursal.
*
* Implementation of the class Usuario.
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
* Class Sucursal
*
* Implementation of class Usuario.
*
* @category   EBIL
* @package    Model
* @author     Luis Juan Carlos Torrico Rios
* @copyright  2015 Juan Carlos Torrico Rios
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2015
* @deprecated No
*/
    class Sucursal {
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
     const INSERT = "INSERT TABLE SUCURSAL";
     const UPDATE = "UPDATE TABLE SUCURSAL";
     const DELETE = "DELETE TABLE SUCURSAL";
     const SELECT = "SELECT TABLE SUCURSAL";

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
        public function getList($idSucursal = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = " 	
                                  select 
                                    `pk_id_sucursal` ,
                                         `sucursal` ,
                                         `razon_social` ,
                                         `numero` ,
                                         `direccion`,
                                         `telefono1` ,
                                         `teefono2` ,
                                         `telefono3` ,
                                         date_format(`fecha_transaccion`,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,
                                         `usuario_transaccion` ,
                                         `estado_registro` ,
                                         `transaccion_creacion` ,
                                         `transaccion_modificacion` ,
                                         `fk_id_empresa`
                                         from sucursal
                                where `estado_registro`='A'
                                ";

                if( $idSucursal != self::ALL){
                $query = $query." and a.pk_id_sucursal = ?";
                $result = DataBase::getArrayListQuery($query, array($idSucursal), $this->instanceDataBase);
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
                          from sucursal
                          where estado_registro = 'A' 
                          and ( sucursal = ?  )";

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
        public function insert($datos){
          
            try{
                $id=-1;        
        
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call sucursal_alta(?,?,?,?,?,?,?,?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call sucursal_baja(?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000);  
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
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
                  
                $sentencia = $gbd->prepare("call sucursal_modif(?,?,?,?,?,?,?,?,?,?,?,@resultado); ");
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

