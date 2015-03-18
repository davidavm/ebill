<?php
/**
* It contains constant that the framework "PUNKU PHP" uses.
* 
* It contains constant that the framework "PUNKU PHP" uses built
* based on the data of the file constants.php.
* 
* PHP version >= 5.1
* 
* @category     FrameworkPunkuPHP
* @package      Configuration
* @author       Luis Fernando Almendras Aruzamen
* @copyright    2007 Luis Fernando Almendras Aruzamen
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2010
* @deprecated   No
*/

// {{{ Constants
/**
 * Constant for the language of the messages and labels in ENGLISH.
 * @package Configuration 
 */
define( 'ENGLISH', 'ENGLISH' );

/**
 * Constant for the language of the messages and labels in SPANISH.
 * @package Configuration 
 */
define( 'SPANISH', 'SPANISH' );

/**
 * Constant for the look and feel STANDART.
 * @package Configuration 
 */
define( 'STANDART', 'STANDART' );

/**
 * Constant for the look and feel OTHER.
 * @package Configuration 
 */
define( 'OTHER', 'OTHER' );

/**
 * Constant for the type data base manager PDO.
 * @package Configuration
 */
define( 'PDO', 'pdo' );

/**
 * Constant for the type data base manager SQLRELAY.
 * @package Configuration
 */
define( 'SQLRELAY', 'sqlrelay' );

/**
 * Constant for the type data base manager DOCTRINE.
 * @package Configuration
 */
define( 'DOCTRINE', 'doctrine' );

/**
 * Constant for the data base manager system MYSQL.
 * @package Configuration
 */
define( 'MYSQL', 'mysql' );

/**
 * Constant for the data base manager system ORACLE.
 * @package Configuration
 */
define( 'ORACLE', 'oci' );

/**
 * Constant for the data base manager system POSTGRESQL.
 * @package Configuration
 */
define( 'POSTGRESQL', 'pgsql' );

/**
 * Constant for the state ON of the data base manager system.
 * @package Configuration
 */
define( 'ON', 1 );

/**
 * Constant for the state OFF of the data base manager system.
 * @package Configuration
 */
define( 'OFF', 0 );

/**
 * Constant for the separador of directory
 * @package Configuration 
 */
define( 'DIR_SEP', DIRECTORY_SEPARATOR );

/**
 * Constant for the root path
 * @package Configuration
 */
$pathExplode = explode(DIR_SEP,realpath(dirname(__FILE__)));
define( 'ROOT_PATH',rtrim(realpath(dirname(__FILE__)),DIR_SEP.$pathExplode[count($pathExplode)-2].DIR_SEP.$pathExplode[count($pathExplode)-1]).DIR_SEP);

/**
 * Constant for the site path
 * @package Configuration 
 */
$pathExplode = explode(DIR_SEP,realpath(dirname(__FILE__)));
$rootSitePath = "";
for($i = 0; $i < count($pathExplode)-1;  $i++ ){
$rootSitePath = $rootSitePath.$pathExplode[$i].DIR_SEP;
}
define( 'SITE_PATH', $rootSitePath);

/**
 * Constant for the library site path
 * @package Configuration
 */
define( 'LIBRARY_PATH', SITE_PATH . 'lib' . DIR_SEP );

/**
 * Constant for the library site path
 * @package Configuration
 */
define( 'VENDORS_PATH', SITE_PATH . 'vendors' . DIR_SEP );

/**
 * Constant for the model path
 * @package Configuration 
 */
define( 'MODEL_PATH', SITE_PATH .'model'. DIR_SEP );

/**
 * Constant for the view path
 * @package Configuration 
 */
define( 'VIEW_PATH', SITE_PATH .'view'. DIR_SEP );

/**
 * Constant for the controller path
 * @package Configuration 
 */
define( 'CONTROLLER_PATH', SITE_PATH .'controller'. DIR_SEP );

 /**
 * Constant for the configuration path
 * @package Configuration
 */
define( 'CONFIGURATION_PATH', SITE_PATH .'configuration'. DIR_SEP );

/**
 * Constant for the library UPLOAD path
 * @package Configuration
 */
define( 'UPLOAD_PATH', SITE_PATH .'upload'. DIR_SEP );

/**
 * Constant for the documentation path
 * @package Configuration
 */
define( 'DOCUMENTATION_PATH', SITE_PATH .'doc'. DIR_SEP );

/**
 * Constant for the extension file php.
 * @package Configuration
 */
define( 'EXT_PHP', 'php' );

/**
 * Constant for the cascading style sheets path (Define Look And Feel)
 * @package Configuration
 */
define( 'CSS_VIEW_PATH', VIEW_PATH .'css'. DIR_SEP );

/**
 * Constant for the extension cascading style sheets file.
 * @package Configuration
 */
define( 'EXT_CSS', 'css' );

/**
 * Constant for the javascript's path.
 * @package Configuration
 */
define( 'JS_VIEW_PATH', VIEW_PATH .'js'. DIR_SEP );

/**
 * Constant for the extension javascript file.
 * @package Configuration
 */
define( 'EXT_JS', 'js' );

/**
 * Constant for the flash path.
 * @package Configuration
 */
define( 'FLASH_VIEW_PATH', VIEW_PATH .'flash'. DIR_SEP );

/**
 * Constant for the extension flash file.
 * @package Configuration
 */
define( 'EXT_FLASH', 'swf' );

/**
 * Constant for the images path.
 * @package Configuration
 */
define( 'IMG_VIEW_PATH', VIEW_PATH .'img'. DIR_SEP );

/**
 * Constant for the separador relative path
 * @package Configuration
 */
define( 'DIR_SEP_REL', '/' );

/**
 * Constant for the relative path aplicacion.
 * @package Configuration
 */

$partsRelativePathApp = pathinfo($_SERVER['PHP_SELF']);
$partsRelativePathAppAux = explode(DIR_SEP_REL,$partsRelativePathApp['dirname']);
$rootRelativePath = "";
for($i = 1; $i < count($partsRelativePathAppAux)-1;  $i++ ){
$rootRelativePath = DIR_SEP_REL.$rootRelativePath.$partsRelativePathAppAux[$i];
}
define( 'ROOT_RELATIVE_PATH',$rootRelativePath.DIR_SEP_REL );

/**
 * Constant for the relative path aplicacion.
 * @package Configuration
 */
define( 'APPLICATION_RELATIVE_PATH',$partsRelativePathApp['dirname']. DIR_SEP_REL );

/**
 * Constant for the relative images path .
 * @package Configuration
 */
define( 'IMG_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."img". DIR_SEP_REL );

/**
 * Constant for the relative java scripts path .
 * @package Configuration
 */
define( 'JS_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."js". DIR_SEP_REL );

/**
 * Constant for the relative java scripts path .
 * @package Configuration
 */
define( 'FLASH_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."flash". DIR_SEP_REL );

/**
 * Constant for the relative css path .
 * @package Configuration
 */
define( 'CSS_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."css". DIR_SEP_REL );

/**
 * Constant for the relative css path .
 * @package Configuration
 */
define( 'REPORTS_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."si". DIR_SEP_REL."report". DIR_SEP_REL );

/**
 * Constant for the relative language path .
 * @package Configuration
 */
define( 'LANGUAGE_RELATIVE_PATH',APPLICATION_RELATIVE_PATH."view".DIR_SEP_REL."lang". DIR_SEP_REL );

// }}}

?>