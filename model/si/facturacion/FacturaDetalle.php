<?php
/**
* Class Dosificacion.
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
* Class Dosificacion
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
    class FacturaDetalle
{
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
     const INSERT = "INSERT TABLE DOSIFICACION";
     const UPDATE = "UPDATE TABLE DOSIFICACION";
     const DELETE = "DELETE TABLE DOSIFICACION";
     const SELECT = "SELECT TABLE DOSIFICACION";

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
        public function getList($idDosificacion = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = " 	select  `pk_id_factura_detalle`,
  `fk_id_factura`,
  `codigo_item`,
  `fk_id_item`,
  `descuento`,
  `fk_id_formato_dato_descuento`,
  `recargo`,
  `fk_id_formato_dato_recargo`,
  `ice`,
  `fk_id_formato_dato_ice`,
  `excentos`,
  `fk_id_formato_dato_excentos`,
  `cantidad`,
  `unidad`,
  `fk_id_dato_entrada_buscar_unidad`,
  `detalle`,
  `precio_unitario`,
  `total`,
  `sujeto_descuento_fiscal`,
  `fecha_transaccion`,
  `usuario_transaccion`,
  `estado_registro`,
  `transaccion_creacion`,
  `transaccion_modificacion`,
  `fk_id_empresa`
                          from factura_detalle a
                          where `estado_registro`='A'
                                ";

                if( $idDosificacion != self::ALL){
                $query = $query." and a.pk_id_factura_detalle = ?";
                $result = DataBase::getArrayListQuery($query, array($idDosificacion), $this->instanceDataBase);
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

           public function getListByInvoice($fk_id_factura ){
            $result = null;
            $query = null;
            try{
                $query = " select  `pk_id_factura_detalle`,
  `fk_id_factura`,
  `codigo_item`,
  `fk_id_item`,
  `descuento`,
  `fk_id_formato_dato_descuento`,
  `recargo`,
  `fk_id_formato_dato_recargo`,
  `ice`,
  `fk_id_formato_dato_ice`,
  `excentos`,
  `fk_id_formato_dato_excentos`,
  `cantidad`,
  `unidad`,
  `fk_id_dato_entrada_buscar_unidad`,
  `detalle`,
  `precio_unitario`,
  `total`,
  `sujeto_descuento_fiscal`,
  `fecha_transaccion`,
  `usuario_transaccion`,
  `estado_registro`,
  `transaccion_creacion`,
  `transaccion_modificacion`,
  `fk_id_empresa`
                          from factura_detalle a
                          where `estado_registro`='A'
                                ";

         
                $query = $query." and a.fk_id_factura = ?";
                $result = DataBase::getArrayListQuery($query, array($fk_id_factura), $this->instanceDataBase);
                
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
                  
                $sentencia = $gbd->prepare("call factura_detalle_alta(?,?,?,?,?,?,?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call factura_detalle_baja(?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call factura_detalle_modif(?,?,?,?,?,?,?,?,?,?,@resultado); ");
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

