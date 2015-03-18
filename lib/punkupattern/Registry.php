<?php
/**
* Pattern design Registry.
*
* Implementation of pattern design Registry.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Library
* @author       Luis Fernando Almendras Aruzamen
* @copyright    2007 Luis Fernando Almendras Aruzamen
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2010
* @deprecated   No
*/

/**
* Class Registry
*
* Implementation of class pattern design Registry.
* Based in the interface ArrayAccess.
*
* @category   PUNKUPATTERN
* @package    Library
* @author     Luis Fernando Almendras Aruzamen
* @copyright  2007 Luis Fernando Almendras Aruzamen
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since        Available from the version  0.1 01-01-2010
* @deprecated No
*/
Class Registry Implements ArrayAccess {

     // {{{ atributos

    /**
     * Array variable of set key - value.
     *
     * Array variable of set key - value. This values is accesible
     * from any where of application.
     *
     * @var bool
     * @access private
     */
    private $vars = array();

    /**
     * Hold an instance of the class.
     *
     * @var object
     * @access private
     */
    private static $registry;

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
     * The singleton method.
     *
     * This method implements the pattern singleton.
     *
     * @return object  Return the object instanced.
     *
     * @throws None.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public static function getInstanceRegistry(){
            if (!isset(self::$registry)) {
                $class = __CLASS__;
                self::$registry = new $class();
            }

            return self::$registry;
    }

    /**
     * This method set the value in array $vars based in the key.
     *
     * This method set the value (in general any object) in array
     * $vars based the key pased.
     *
     * @param string $key  Key the element in the array.
     * @param object $var  Value the element in the array based the key pased.
     *
     * @return bool  Return true if the operation is succefull else return exception.
     *
     * @throws Exception  If the value fail set in the array.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    private function set($key, $var) {
        if (isset($this->vars[$key]) == true) {
            throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }

        $this->vars[$key] = $var;
        return true;
    }

    /**
     * This method get the value in array $vars based in the key.
     *
     * This method get the value (in general any object) in array
     * $vars based the key pased.
     *
     * @param string $key  Key the element in the array.
     *
     * @return object  Return object if the operation is succefull
     *                 else return null.
     *
     * @throws No.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    private function &get($key) {
        if (isset($this->vars[$key]) == false) {
            return null;
        }

        return $this->vars[$key];
    }

    /**
     * This method remove the value in array $vars based in the key.
     *
     * This method remove the value (in general any object) in array
     * $vars based the key pased.
     *
     * @param string $key  Key the element in the array.
     *
     * @return No.
     *
     * @throws No.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    private function remove($key) {
        unset($this->vars[$key]);
    }

    /**
     * This method return true if the value exists in array $vars based in the key.
     *
     * This method return true if the value (in general any object) exists in array
     * $vars based the key pased. The method is part of the interface
     * ArrayAccess.
     *
     * @param string $offset Key the element in the array.
     *
     * @return Return true if the key exists in the array, else return false.
     *
     * @throws No.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public function offsetExists($offset) {
        return isset($this->vars[$offset]);
    }

    /**
     * This method get the value in array $vars based in the key.
     *
     * This method return the value (in general any object) exists in array
     * $vars based the key pased of maner []. The method is part of the interface
     * ArrayAccess.
     *
     * @param string $offset Key the element in the array.
     *
     * @return Return the value of the array based in the key pased.
     *
     * @throws No.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public function offsetGet($offset) {
        return $this->get($offset);
    }

    /**
     * This method set the value in array $vars based in the key.
     *
     * This method set the value (in general any object) in array
     * $vars based the key pased of maner []. The method is part of the interface
     * ArrayAccess.
     *
     * @param string $offset Key the element in the array.
     * @param object $value Value the element in the array.
     *
     * @return Return the value of the array based in the key pased.
     *
     * @throws No.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    /**
     * This method remove the value in array $vars based in the key.
     *
     * This method remove the value (in general any object) in array
     * $vars based the key pased of maner []. The method is part of the interface
     * ArrayAccess.
     *
     * @param string $offset Key the element in the array.
     *
     * @return Return the value of the array based in the key pased.
     *
     * @throws No.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public function offsetUnset($offset) {
        unset($this->vars[$offset]);
    }

    /**
     * Prevent users to clone the instance.
     *
     * @throws None.
     *
     * @access     private
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 20-09-2007.
     * @deprecated No.
     */
    public function __clone(){
            trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    // }}}
}
?>