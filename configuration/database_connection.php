<?php
/**
* This the file of configuration database connection of the framework "PUNKU PHP"
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

// {{{ ConfigurationDBConection

/**
 * To configure the data base connection.
 * Configure the Data Base Manager System "dbms" with values constants: MYSQL, ORACLE, POSTGRESQL.
 * Configure the type manager Data Base "typeDB" with values constants: PDO, SQLRELAY, DOCTRINE.
 * Configure the name or IP from de host Data Base "hostDB".
 * Configure the name Data Base "nameDB".
 * Configure the user Data Base "userDB".
 * Configure the password Data Base "passwordDB".
 * Configure the state Data Base with values constants: ON, OFF .
 * Example 1:
 * $dataBaseConnection['testMysql'] = array(
                                   'dbms'                => MYSQL,
                                   'typeDataBaseManager' => PDO,
                                   'dataBasehost'        => 'localhost',
                                   'dataBaseName'        => 'test',
                                   'dataBaseUser'        => 'user',
                                   'passwordDataBaseUser' => 'pwd',
                                   'state'               => OFF
                                  );
 * Example 2:
 * $dataBaseConnection['puntophp'] = array(
                                   'dbms'                => ORACLE,
                                   'typeDataBaseManager' => PDO,
                                   'dataBasehost'        => '',
                                   'dataBaseName'        => 'ora10g',
                                   'dataBaseUser'        => 'user',
                                   'passwordDataBaseUser' => 'pwd',
                                   'state'               => ON
                                  );
*/
// Initial value array null
$dataBaseConnection = array();
// Connections Data Base

$dbSystem = 'dbSystem';
$dataBaseConnection[$dbSystem] = array(
                                   'dbms'                => MYSQL,
                                   'typeDataBaseManager' => PDO,
                                   'dataBasehost'        => 'localhost',
                                   'dataBaseName'        => 'ebil',
                                   'dataBaseUser'        => 'root',
                                   'passwordDataBaseUser' => '',
                                   'state'               => ON
                                  );

// }}}
?>
