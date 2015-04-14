<?php
/**
* Class Vendedor.
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
* Class Vendedor
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
    class Vendedor {
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
     const INSERT = "INSERT TABLE VENDEDOR";
     const UPDATE = "UPDATE TABLE VENDEDOR";
     const DELETE = "DELETE TABLE VENDEDOR";
     const SELECT = "SELECT TABLE VENDEDOR";

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
        public function getList($idVendedor = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = " 	
                                  select 
                                    pk_id_vendedor                          ,
                                    nombres                     ,
                                    primer_apellido            ,
                                    segundo_apellido            ,
                                    telefono1                  ,
                                    telefono2                  ,
                                    telefono3                  ,
                                     (select empresa from empresa  where pk_id_empresa=fk_id_empresa ) empresa,
                                    date_format(`fecha_transaccion`,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,                                        
                                    usuario_transaccion         ,
                                    estado_registro             ,
                                    transaccion_creacion        ,
                                    transaccion_modificacion    ,
                                    fk_id_empresa
                                         from vendedor
                                where `estado_registro`='A'
                                ";

                if( $idVendedor != self::ALL){
                $query = $query." and pk_id_vendedor = ?";
                $result = DataBase::getArrayListQuery($query, array($idVendedor), $this->instanceDataBase);
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
                          from vendedor
                          where estado_registro = 'A' 
                          and  nombres = ?  and primer_apellido= ? ";

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
                  
                $sentencia = $gbd->prepare("call vendedor_alta(?,?,?,?,?,?,?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call vendedor_baja(?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call vendedor_modif(?,?,?,?,?,?,?,?,?,?,@resultado); ");
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

