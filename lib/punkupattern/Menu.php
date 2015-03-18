<?php
/**
* Class Report.
*
* Implementation of the class Report.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Model
* @author       Luis Fernando Almendras Aruzamen
* @copyright    2010 Luis Fernando Almendras Aruzamen
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2010
* @deprecated   No
*/

/**
* Class Report
*
* Implementation of class Report.
*
* @category   WindowSI
* @package    Model
* @author     Luis Fernando Almendras Aruzamen
* @copyright  2010 Luis Fernando Almendras Aruzamen
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2010
* @deprecated No
*/
    class Menu {
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
     const INSERT = "INSERT TABLE Report";
     const UPDATE = "UPDATE TABLE Report";
     const DELETE = "DELETE TABLE Report";
     const SELECT = "SELECT TABLE Report";
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
     * @since      Available from the version  1.0 01-01-2010.
     * @deprecated No.
     */
           public function getMenubyType($type){
            $result = null;
            $query = null;
            try{
                $query = "select pk_id_menu, route, title, class_item, class_image, position, href, level, type, show_bread, fk_id_menu_father, fecha_transaccion, usuario_transaccion, estado_registro, transaccion_creacion, transaccion_modificacion, fk_id_empresa 
                            from cnf_menu
                            where type= ? AND estado_registro='A' ";

                $result = DataBase::getArrayListQuery($query, array($type), $this->instanceDataBase);
            }
            catch(PDOException $e){
                echo 'Error JF-Model-1015: '.$e->getMessage();
            }
            return $result;
        }
        
        
        public function getMenuByRoute($idMenu){
            $result = null;
            $query = null;
            try{
                $query = "select pk_id_menu, route, title, class_item, class_image, position, href, level, type, show_bread, fk_id_menu_father, fecha_transaccion, usuario_transaccion, estado_registro, transaccion_creacion, transaccion_modificacion, fk_id_empresa 
                            from cnf_menu
                            where route= ? AND estado_registro='A' ";

                $result = DataBase::getArrayListQuery($query, array($idMenu), $this->instanceDataBase);
            }
            catch(PDOException $e){
                echo 'Error JF-Model-1015: '.$e->getMessage();
            }
            return $result;
        }
      /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2010.
     * @deprecated No.
     */
        public function getMenuByPk($idMenu){
            $result = null;
            $query = null;
            try{
                $query = "select pk_id_menu, route, title, class_item, class_image, position, href, level, type, show_bread, fk_id_menu_father, fecha_transaccion, usuario_transaccion, estado_registro, transaccion_creacion, transaccion_modificacion, fk_id_empresa 
                            from cnf_menu
                            where pk_id_menu= ?  AND estado_registro='A' ";

                $result = DataBase::getArrayListQuery($query, array($idMenu), $this->instanceDataBase);
            }
            catch(PDOException $e){
                echo 'Error JF-Model-1015: '.$e->getMessage();
            }
            return $result;
        }         
       
      /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2010.
     * @deprecated No.
     */
        public function getMenuByFatherPk($idMenu){
            $result = null;
            $query = null;
            try{
                $query = "select pk_id_menu, route, title, class_item, class_image, position, href, level, type, show_bread, fk_id_menu_father, fecha_transaccion, usuario_transaccion, estado_registro, transaccion_creacion, transaccion_modificacion, fk_id_empresa 
                            from cnf_menu
                            where fk_id_menu_father = ?  AND estado_registro='A' ";

                $result = DataBase::getArrayListQuery($query, array($idMenu), $this->instanceDataBase);
            }
            catch(PDOException $e){
                echo 'Error JF-Model-1015: '.$e->getMessage();
            }
            return $result;
        }     
     // }}}
    }
?>
