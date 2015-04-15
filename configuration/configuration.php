<?php
/**
* This the file of configuration of the framework "PUNKU PHP"
* 
* It contains data that the final user modifies to carry out the configuration
* of the framework "PUNKU PHP".
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

// {{{ Configuration
/**
* To configure the language of the labels and messages of the application Web,
* to choose ENGLISH or SPANISH constant.
*/
$languageLabelAndMessage = SPANISH;

/**
* To configure the look and feel of the application Web, to choose STANDART or
* OTHER constant.
*/
$lookAndFeel = STANDART;

/**
* To configure the default page.
*/
$default_page = "default";

/**
* To configure the  page view.
*/
$page_view = "view";
/**
* To configure the  page view.
*/
$page_view_ajax = "view_ajax";


/**
* To configure the  page view login.
*/
$page_view_login = "view_login";

/**
* To configure the default page login.
*/
$default_page_login = "login";

/**
* To configure mail server.
*/
$settingServerMailer_01 = array('port'=>25,
                                'host'=>"mail.wallejlla.com",
                                'userName'=>"ebil@wallejlla.com",
                                'password'=>"ebil123",
                                'from'=>"ebil@wallejlla.com",
                                'fromName'=>"Sistema de Facturacion"
                                );

// }}}

?>
