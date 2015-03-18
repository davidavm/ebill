<?php
/**
* Class Transaccion.
*
* Implementation of the class Transaccion.
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
* Class Transaccion
*
* Implementation of class Transaccion.
*
* @category   WindowSI
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
    class Transaccion {
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
     const INSERT = "INSERT TABLE TRANSACCION";
     const UPDATE = "UPDATE TABLE TRANSACCION";
     const DELETE = "DELETE TABLE TRANSACCION";
     const SELECT = "SELECT TABLE TRANSACCION";
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
     * The implementation method for insert data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2010.
     * @deprecated No.
     */
        public function insert($data){
            $result = null;
            $resultAux = null;
            $aux = null;
            $query = null;
            $id_aux = null;
            try{
                $query = "INSERT INTO transaccion_log(fecha_transaccion, descripcion, fk_id_usuario, fk_id_empresa) ".
                         "VALUES (current_timestamp(), ?, ?, ?)";
                DataBase::getBeginTransaction($this->instanceDataBase);
                $result = DataBase::getExecuteDmlAndGetLastInsertId($query, $data, $this->instanceDataBase);
                DataBase::getCommitTransaction($this->instanceDataBase);
                return $result;
            }
            catch(PDOException $e){
                //echo 'Error JF-Model-9999: '.$e->getMessage().'</br>';
                throw $e;
            }            
        }
 

     // }}}
    }
?>
