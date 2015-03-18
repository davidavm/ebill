<?php
/**
* It contains messages and labels in language SPANISH that the framework "PUNKU PHP" uses.
*
* It contains messages and labels in language SPANISH that the framework "PUNKU PHP" uses
* for the look and feel.
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

// {{{ Properties
/**
 * Array for the language of the messages and labels in SPANISH.
 */
// GREETING PUNKUPHP - 15sep2008
$property["punkuPHP"]["greeting"] = "E-BIL Sistema de Facturacion";
// What is Framework PUNKUPHP
$property["punkuPHP"]["whatIsPunkuPHP"] = <<<whatIsPunkuPHP
<p>Bienvenido!!!!.</p>
whatIsPunkuPHP;

// Labels and Messages for sample systems based in framework PUNKUPHP
// Header System
$property["general"]["head"] = array(   "titleSystem" => "E-BIL Sistema de Facturacion",
                                        "titleSystemWebPage" => "E-BIL Sistema de Facturacion",
                                        "author" => "www.wallejlla.com"
                                    );

// footer System
$property["general"]["foot"] = array(   "footLicenceSystem" => "&copy; 2015 <strong>E-BIL</strong> Sistema de Facturaci&oacute;n");

// message error
$property["general"]["error"] = array(  "loadPageModel" => "Error al cargar la pagina de modelo",
                                        "pathPageModel" => "No existe el archivo");

// Main menu EbilSI
$property["ebilsi"]["menu"] = array();

// Main Submenu EbilSI

$property["ebilsi"]["submenu"]["home"] = array();

// messages option
$property["general"]["list"]["option"]=array(
    "view" => "Ver",
    "edit" => "Editar",
    "delete" => "Eliminar"
);

// }}}
?>
