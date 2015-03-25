<?php   
session_start();
// If first time yes
if (empty($_SESSION["menu_active"])) {
    $_SESSION["menu_active"] = "home";
    $_SESSION["active_option_menu"] = "/si/configuration/home";
}

// If option Exit
if (isset($_GET["menu"]) && $_GET["menu"] == "exit") {
    $_SESSION = array();
    session_regenerate_id();
    session_destroy();
    unset($_SESSION);
    header('Location: index.php');
}
/**
 * It contains the code control panel the framework "PUNKU PHP".
 *
 * Only through this you can enter to the application web.
 *
 * PHP version >= 5.1
 *
 * @category     FrameworkPunkuPHP
 * @package      ControlPanel
 * @author       Luis Fernando Almendras Aruzamen
 * @copyright    2007 Luis Fernando Almendras Aruzamen
 * @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
 * @version      1.0
 * @link         None
 * @see          None
 * @since        Available from the version  0.1 01-01-2010
 * @deprecated   No
 */
// {{{ Inclusions
/**
 * It includes the information of the constants of the framework "PUNKU PHP"
 */
require_once("configuration/constants.php");

require_once("lib/punkupattern/Menu.php");


/**
 * It includes the information of the configuration of the framework "PUNKU PHP"
 */
require_once("configuration/configuration.php");

/**
 * It includes the information of the libraries of the framework "PUNKU PHP"
 */
require_once("configuration/library.php");

/**
 * It includes the information of the vendors of the framework "PUNKU PHP"
 */
require_once("configuration/vendor.php");

/**
 * It includes the information of the configuration language extend of the framework "PUNKU PHP"
 */
require_once("configuration/language_extend.php");

/**
 * It includes the information of the configuration look and feel extend of the framework "PUNKU PHP"
 */
require_once("configuration/lookandfeel_extend.php");

/**
 * It includes the information of the configuration conection Data Base of the framework "PUNKU PHP"
 */
require_once("configuration/database_connection.php");

/**
 * It includes the information of the configuration conection Data Base of the framework "PUNKU PHP"
 */
require_once("configuration/path_local.php");

/**
 * It includes the information of the configuration supported version of the framework "PUNKU PHP"
 */
require_once("configuration/supported_version.php");

/**
 * To verify that the PHP version is compatible with the framework "PUNKU PHP"
 */
error_reporting(E_ALL);
if (version_compare(phpversion(), SUPPORTED_VERSION, '<') == true) {
    die('PLEASE UPDATE YOUR VERSION PHP TO: ' . SUPPORTED_VERSION);
}

/**
 * It includes the information of the folder
 */
require_once("Loader.php");

// upload package model
spl_autoload_register(array('Loader', 'model'));

// upload package view
spl_autoload_register(array('Loader', 'view'));

// upload package library
spl_autoload_register(array('Loader', 'lib'));
spl_autoload_register(array('Loader', 'libPunkuDb'));
spl_autoload_register(array('Loader', 'libPunkuPattern'));
spl_autoload_register(array('Loader', 'libPunkuMail'));
spl_autoload_register(array('Loader', 'vendorPhpMailer'));
spl_autoload_register(array('Loader', 'modelApplication'));
spl_autoload_register(array('Loader', 'modelApplicationWarehouse'));
spl_autoload_register(array('Loader', 'modelApplicationBanks'));
spl_autoload_register(array('Loader', 'modelApplicationClient'));
spl_autoload_register(array('Loader', 'modelApplicationBuy'));
spl_autoload_register(array('Loader', 'modelApplicationConfiguration'));
spl_autoload_register(array('Loader', 'modelApplicationBilling'));
spl_autoload_register(array('Loader', 'modelApplicationReport'));
spl_autoload_register(array('Loader', 'modelApplicationRRHH'));
spl_autoload_register(array('Loader', 'modelApplicationSecurity'));

/**
 * Create registry object for the application.
 */
try {
    $registry = Registry::getInstanceRegistry();
} catch (Exception $e) {
    die('CREATED REGISTRY OBJECT FAIL: ' . $e->getMessage());
}

/**
 * Create Data Base Connection for the application.
 */
try {
    foreach ($dataBaseConnection as $nameDataBase => $attrDataBase) {
        if ($attrDataBase['typeDataBaseManager'] == PDO && $attrDataBase['state'] == ON) {
            if ($attrDataBase['dbms'] == ORACLE) { // string ORACLE connection
                // tnsnames.ora
                $dsn = $attrDataBase['dbms'] . ":dbname=" . $attrDataBase['dataBaseName'];
                // Connect using the Oracle Instant Client
                //$dsn = $dataBase.":dbname=//".$hostDB.":1521/".$nameDB;
            } else { // string connection MYSQL and POSTGRESQL
                $dsn = $attrDataBase['dbms'] . ":host=" . $attrDataBase['dataBasehost'] . ";dbname=" . $attrDataBase['dataBaseName'];
            }
            $db = DataBase::getInstanceDataBase($dsn, $attrDataBase['dataBaseUser'], $attrDataBase['passwordDataBaseUser']);
            $registry[$nameDataBase] = $db;
        } else if ($attrDataBase['typeDataBaseManager'] == DOCTRINE && $attrDataBase['state'] == ON) {
            spl_autoload_register('__autoload'); // autoload load again the method in order not to lose the stack above
            spl_autoload_register(array('Doctrine', 'autoload')); // inclusion exclusive classes library Doctrine
            if ($attrDataBase['dbms'] == ORACLE) { // string ORACLE connection
                // tnsnames.ora
                $dsn = $attrDataBase['dbms'] . ":dbname=" . $attrDataBase['dataBaseName'];
                // Connect using the Oracle Instant Client
                //$dsn = $dataBase.":dbname=//".$hostDB.":1521/".$nameDB;
            } else { // string connection MYSQL and POSTGRESQL
                $dsn = $attrDataBase['dbms'] . ":host=" . $attrDataBase['dataBasehost'] . ";dbname=" . $attrDataBase['dataBaseName'];
            }
            $db = DataBase::getInstanceDataBase($dsn, $attrDataBase['dataBaseUser'], $attrDataBase['passwordDataBaseUser']);

            $registry['doctrine'] = Doctrine_Manager::getInstance();
            $registry[$nameDataBase] = Doctrine_Manager::connection($db, $nameDataBase);
            $registry['doctrine']->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_ALL);
            $registry['doctrine']->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_ALL);
            $registry['doctrine']->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
        }
    }
} catch (PDOException $e) {
    die("CONNECTION DATABASE FAILED: " . $e->getMessage());
}


/**
 * To configure the language.
 */
if (isset($languageLabelAndMessage)) {
    foreach ($languages as $idx => $lang) {
        if ($languageLabelAndMessage == $lang) {
            $registry["language"] = $lang;
        }
    }
} else {
    $registry["language"] = ENGLISH;
}

/**
 * Include file from the properties based in the language selected.
 */
require_once( CONFIGURATION_PATH . DIR_SEP . "properties." . $registry["language"] . ".php" );
$registry["properties"] = $property;

/**
 * To configure the look and feel.
 */
if (isset($lookAndFeel)) {
    foreach ($lookAndFeels as $idx => $laf) {
        if ($lookAndFeel == $laf) {
            $registry["lookAndFeel"] = $laf;
        }
    }
} else {
    $registry["lookAndFeel"] = STANDART;
}

/** Verificamos que se haya escogido una pagina, sino
 * tomamos el valor por defecto de la configuraciï¿½n.
 * Tambiï¿½n debemos verificar que el valor que nos
 * pasaron, corresponde a una pï¿½gina que existe.
 */
if (!empty($_GET['page']))
    $page = $_GET['page'];
else
    $page = $default_page;



/** Tambiï¿½n debemos verificar que el valor que nos
 * pasaron, corresponde a una pï¿½gina que existe, caso
 * contrario, cargamos la pï¿½gina por defecto
 */
if (empty($page))
    $page = $default_page;

/** Finalmente, cargamos el archivo de Presentaciï¿½n que a su vez, se
 * encargarï¿½ de incluir a la Lï¿½gica de Negocio propiamente dicha. si el archivo
 * no existiera, cargamos directamente el Negocio. Tambiï¿½n es un
 * buen lugar para incluir Headers y Footers comunes.
 */
// Validar si el logueo fue exitoso
$security_in = 0; // No entro al logueo
if (isset($_GET["security_administrator"])) {    
    if ($_GET["security_administrator"] == 'login' && isset($_POST["user"]) && isset($_POST["password"])) {
        $security_in = 1; // Si entro al logueo
        $user = new Usuario($registry[$dbSystem]);
        if (($user->getLoginUsuario($_POST["user"], $_POST["password"]) == 1)) {
            $_SESSION["authenticated_id_user"] = $user->getIdUsuario($_POST["user"], $_POST["password"]);            
            $user_data_login = $user->getList($_SESSION["authenticated_id_user"]);
            $_SESSION["authenticated_user"] = $user_data_login[0]["usuario"];
            $_SESSION["authenticated_role"] = $user_data_login[0]["rol"];
            $_SESSION["authenticated_id_role"] = $user_data_login[0]["fk_id_rol"];
            $_SESSION["authenticated_id_user_role"] = $user_data_login[0]["pk_id_usuario_rol"];
            // Manejo de datos de la empresa
            if($_SESSION["authenticated_user"] == 'root' && $_SESSION["authenticated_role"] = 'Superusuario'){
                $_SESSION["authenticated_id_empresa"] = -1; // Empresa de configuracion
                $_SESSION["authenticated_empresa"] = "Penta Group SRL - Ebil - Configuraci&oacute;n";
            } else{
                $_SESSION["authenticated_id_empresa"] = $user_data_login[0]["fk_id_empresa"];
            }
            
        }
    }
}

// Desidir que mostrar si fue el logueo exitoso o no
if (isset($_SESSION["authenticated_id_user"])) {
    $path_controller_view = VIEW_PATH . $page_view . '.php';
    $path_business_view = VIEW_PATH . $page . '.php';
    if ($page == $default_page) { // Si es la pagina por defecto cargar esta pagina alternativamente
        header('Location: index.php?page=/si/home');
    }
} else {
    $path_controller_view = VIEW_PATH . $page_view_login . '.php';
    $path_business_view = VIEW_PATH . $default_page_login . '.php';
}

if (file_exists($path_controller_view)) {
    include( $path_controller_view );
} else {
    die('Error al cargar la pagina de presentacion <b>' . $page_view . '</b>. No existe el archivo <b>' . $path_controller_view . '</b>');
}

?>