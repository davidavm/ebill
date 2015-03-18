<?php
/*$ldap['user']              = 'lalmendras'; //'sanvtbouser';
$ldap['pass']              = 'Informacion089'; //'Datawarehous3';  
$ldap['host']              = '10.40.3.97'; // nombre del host o servidor  
$ldap['port']              = 389; // puerto del LDAP en el servidor  
$ldap['dn']                = 'uid='.$ldap['user'].',OU=GEOI,OU=VP-IT,OU=CB,OU=NUEVATEL,OU=Servicios,OU=Usuarios,DC=nuevatel,DC=net'; // modificar respecto a los valores del LDAP  
$ldap['base']              = 'DC=nuevatel,DC=net';  
*/
require_once(dirname(__FILE__) . '/adLDAP.php');

$options["domain_controllers"]=array("10.40.3.97","10.20.3.97","10.30.3.97");
$user = 'lalmendras';
$password = 'Informacion0';
$options["ad_username"]=$user; //el usuario de active directory
$options["ad_password"]=$password;
$options["use_ssl"]=false;
$ldap = new adLDAP();

$aut=$ldap->authenticate($user,$password);
if($aut){
echo 'ok';
}else{
echo 'error';
}

?>