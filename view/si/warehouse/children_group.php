<?php
session_start();
$raiz = '../../../';
if (empty($_SESSION["authenticated_id_user"])) {
        header("Location: ".$raiz."index.php");
}
include ($raiz.'configuration/constants.php');
include ($raiz.'configuration/configuration.php');

// Conectarse a base de datos
include($raiz.'configuration/database_connection.php');
include($raiz.'lib/punkudb/DataBase.php');
include($raiz.'lib/punkupattern/Registry.php');
$attrDataBase = $dataBaseConnection[$dbSystem];
$dsn = $attrDataBase['dbms'] . ":host=" . $attrDataBase['dataBasehost'] . ";dbname=" . $attrDataBase['dataBaseName'];
$db = DataBase::getInstanceDataBase($dsn, $attrDataBase['dataBaseUser'], $attrDataBase['passwordDataBaseUser']);
$registry[$dbSystem] = $db;

include($raiz.'model/si/almacen/Grupo.php');
$empresa = isset($_GET["empresa"]) ? $_GET["empresa"] : NULL;
$idPadre = isset($_GET["padre"]) ? $_GET["padre"] : NULL;
$object = new Grupo($registry[$dbSystem]);
$list = $object->getListOffSpring($idPadre, $empresa);
$result = array();
foreach($list as $key => $value){
   $result[$value["pk_id_grupo"]]=$value["grupo"];
};
echo json_encode($result);
?>

