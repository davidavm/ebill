<?php
/**
* Class DataBase.
*
* Implementation of the class Data Base.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Library
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
* Class DataBase
*
* Implementation of class Data Base.
*
* @category   PUNKUDB
* @package    Library
* @author     Luis Fernando Almendras Aruzamen
* @copyright  2010 Luis Fernando Almendras Aruzamen
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2010
* @deprecated No
*/
    class DataBase {
    // {{{ atributos

    /**
     * Variable instance Data Base.
     *
     * @var DataBase
     * @access private
     */
        private static $instanceDataBase;
    // }}}

    // {{{ constructores

    /**
     * This is construct base of the class.
     *
     * A private constructor; prevents direct creation of objec.
     *
     */
        private function __construct() {
        }
    // }}}

    // {{{ metodos

    /**
     * The implementation method for the verification instance data Base.
     *
     * @throws None.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
        private static function verificationInstanceDataBase($dsn, $userDB, $passwordDB){
            $instanceDataBaseAux = null;
            try{
              if (!empty(self::$instanceDataBase)) {
                  foreach( self::$instanceDataBase as $valueInsDB){
                    if($valueInsDB['dsn'] == $dsn && $valueInsDB['user'] == $userDB &&  $valueInsDB['pwd'] == $passwordDB ){
                      $instanceDataBaseAux = $valueInsDB['instance'];
                      break;
                    }
                  }
              }
            return $instanceDataBaseAux;
            }
            catch(PDOException $e){
                //echo 'Error FWP-MODEL-80000: '.$e->getMessage().'</br>';
                throw $e;
            }            
        }

    /**
     * The implementation method for the get instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
        public static function getInstanceDataBase($dsn, $userDB, $passwordDB){            
            try{
              $instance = self::verificationInstanceDataBase($dsn, $userDB, $passwordDB);
              if ( $instance == null ) {
                  $instance = new PDO( $dsn, $userDB, $passwordDB );
                  $instance -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  self::$instanceDataBase[] = array( 'dsn' =>  $dsn,
                                                     'user' => $userDB,
                                                     'pwd' =>  $passwordDB,
                                                     'instance' => $instance
                                                   );
              }
            return $instance;
            }
            catch(PDOException $e){            
            //echo 'Error FWP-MODEL-80001: '.$e->getMessage().'</br>';
            throw $e;
            }            
        }

    /**
     * The implementation method for the execute SQL QUERY and return array list.
     *
     * @param string  $querySql   Sql query.
     * @param array   $param      Parameters for the sql query.
     * @param PDO     $dbObject   Object data base PDO.
     *
     * @return array  List Array Consequently execute SQL.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getArrayListQuery( $querySql , $param, $dbObject){
            $arrayList = array();
            try{
            $cmd = $dbObject -> prepare($querySql);
            if( count($param) > 0 ){
                $cmd -> execute( $param );
            }
            else{
                $cmd -> execute();
            }
            $arrayList = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $arrayList;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80002: '.$e->getMessage().'</br>';
            throw $e;            
            }            
        }

    /**
     * The implementation method for the execute SQL DML.
     *
     * @param string $dmlSql      DML SQL.
     * @param array  $param       DML SQL parameters or values.
     * @param PDO    $dbObject    Object data base PDO.
     *
     * @return boolean  True if execute correctly SQL DML else false.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getExecuteDML( $dmlSql , $param, $dbObject){
            $state = false;
            try{
            $cmd = $dbObject -> prepare($dmlSql);
            $cmd -> execute( $param );
            $state = true;
            return $state;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80003: '.$e->getMessage().'</br>';
            throw $e;
            }            
        }

 /**
     * The implementation method for the begin transaction.
     *
     * @param PDO    $dbObject    Object data base PDO.
     *
     * @return boolean  True if execute correctly begin transaction else false.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getBeginTransaction($dbObject){
            $state = false;
            try{
            $state = $dbObject->beginTransaction();
            return $state;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80004: '.$e->getMessage().'</br>';
            throw $e;
            }
        }

 /**
     * The implementation method for the commit transaction.
     *
     * @param PDO    $dbObject    Object data base PDO.
     *
     * @return boolean  True if execute correctly commit transaction else false.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getCommitTransaction($dbObject){
            $state = false;
            try{
            $state = $dbObject -> commit();
            return $state;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80005: '.$e->getMessage().'</br>';
            throw $e;
            }

        }

 /**
     * The implementation method for the rollback transaction DML.
     *
     * @param PDO    $dbObject    Object data base PDO.
     *
     * @return boolean  True if execute correctly rollback transaction else false.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getRollbackTransaction($dbObject){
            $state = false;
            try{
            $state = $dbObject -> rollBack();
            return $state;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80006: '.$e->getMessage().'</br>';
            throw $e;
            }            
        }


     /**
     * The implementation method for the rollback transaction DML.
     *
     * @param PDO    $dbObject    Object data base PDO.
     *
     * @return boolean  True if execute correctly rollback transaction else false.
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2008.
     * @deprecated No.
     */
        public static function getExecuteDmlAndGetLastInsertId( $dmlSql , $param, $dbObject ){
            $lastid = -1;
            try{
            $cmd = $dbObject -> prepare($dmlSql);
            $cmd -> execute( $param );
            $lastid = $dbObject->lastInsertId();
            return $lastid;
            }
            catch(PDOException $e){
            //echo 'Error FWP-MODEL-80007: '.$e->getMessage().'</br>';
            throw $e;
            }            
        }

        // Prevent users to clone the instance
        public function __clone(){
            trigger_error('Clonar no esta permitido.', E_USER_ERROR);
        }
     // }}}
    }
?>
