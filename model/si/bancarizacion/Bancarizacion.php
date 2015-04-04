<?php
/**
* Class Bancarizacion.
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
* Class Bancarizacion
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
    class Bancarizacion {
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
     const INSERT = "INSERT TABLE BANCARIZACION";
     const UPDATE = "UPDATE TABLE BANCARIZACION";
     const DELETE = "DELETE TABLE BANCARIZACION";
     const SELECT = "SELECT TABLE BANCARIZACION";

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
        public function getList($idBancarizacion = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = " 	
                        select  
                            `pk_id_compra` ,
                                  `nit` ,
                                  `razon_social` ,
                                  `numero_factura` ,
                                  `numero_autorizacion` ,
                                   date_format(`fecha_compra`,'%Y-%m-%d %H:%i-%s')  as fecha_compra,
                                  `monto` ,
                                  `descuentos` ,
                                  `fk_id_formato_dato_descuento` ,
                                  `recargos` ,
                                  `fk_id_formato_dato_recargo` ,
                                  `ice` ,
                                  `excentos` ,
                                  `codigo_control` ,
                                  `sujeto_credito_fiscal` ,
                                  `precio_unitario` ,
                                  `detalle` ,
                                  `unidad` ,
                                  `fk_id_dato_entrada_buscar_unidad` ,
                                  `centro_costo` ,
                                  `fk_id_dato_entrada_buscar_centro_costo` ,
                                  `fk_id_tipo_compra` ,
                                  `cantidad_dias` ,
                                  date_format(`fecha_transaccion`,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,
                                  `usuario_transaccion`,
                                  `estado_registro` ,
                                  `transaccion_creacion` ,
                                  `transaccion_modificacion` ,
                                  `fk_id_empresa`
                                  from compra
                                where `estado_registro`='A'
                                ";

                if( $idBancarizacion != self::ALL){
                $query = $query." and a.pk_id_bancarizacion = ?";
                $result = DataBase::getArrayListQuery($query, array($idBancarizacion), $this->instanceDataBase);
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
                          from bancarizacion
                          where estado_registro = 'A' 
                          and ( pk_id_bancarizacion = ?  )";

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
                  
                $sentencia = $gbd->prepare("call bancarizacion_alta(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@resultado);  ");
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
                $sentencia->bindParam(17, $datos[16], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(18, $datos[17], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(19, $datos[18], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(20, $datos[19], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(21, $datos[20], PDO::PARAM_STR, 4000); 
               
                
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
                  
                $sentencia = $gbd->prepare("call bancarizacion_baja(?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call bancarizacion_modif(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@resultado); ");
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
                $sentencia->bindParam(17, $datos[16], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(18, $datos[17], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(19, $datos[18], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(20, $datos[19], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(21, $datos[20], PDO::PARAM_STR, 4000); 
                
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

