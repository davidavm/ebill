<?php
/**
* Class Catalogo.
*
* Implementation of the class Catalogo.
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
* Class Catalogo
*
* Implementation of class Catalogo.
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
    class Catalogo {
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
     const INSERT = "INSERT TABLE Catalogo";
     const UPDATE = "UPDATE TABLE Catalogo";
     const DELETE = "DELETE TABLE Catalogo";
     const SELECT = "SELECT TABLE Catalogo";
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
        public function getList($idCatalogo = self::ALL){
            $result = NULL;
            $query = NULL;            
            try{
                $query = "SELECT pk_id_catalogo, descripcion, catalogo, negocio, orden, dependencia, fecha_transaccion, comentario, usuario_transaccion, estado_registro, cnf_base, transaccion_creacion, transaccion_modificacion, fk_id_empresa ".
                         "FROM   catalogo ".
                         "WHERE  estado_registro = 'A' ";                         

                if( $idCatalogo != self::ALL){
                $query = $query." AND id_catalogo = ? ";
                $result = DataBase::getArrayListQuery($query, array($idCatalogo), $this->instanceDataBase);
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
        public function getCatalogo($catalog = self::ALL){
            $result = NULL;
            $query = NULL;            
            try{
                $query = "SELECT pk_id_catalogo, descripcion, catalogo, negocio, orden, dependencia, fecha_transaccion, comentario, usuario_transaccion, estado_registro, cnf_base, transaccion_creacion, transaccion_modificacion, fk_id_empresa ".
                         "FROM   catalogo ".
                         "WHERE  estado_registro = 'A' ";                         

                if( $catalog != self::ALL){
                $query = $query." AND catalogo = ? order by orden asc ";
                $result = DataBase::getArrayListQuery($query, array($catalog), $this->instanceDataBase);
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
        public function getCatalogoHijos($catalogChildren, $idFather){
            $result = NULL;
            $query = NULL;            
            try{
                $query = "select pk_id_catalogo, descripcion
                         from   catalogo 
                         where  estado_registro = 'A' 
                          and catalogo = ? and dependencia = ? order by orden asc ";
                $result = DataBase::getArrayListQuery($query, array($catalogChildren, $idFather), $this->instanceDataBase);
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }
        
     // }}}
    }
?>