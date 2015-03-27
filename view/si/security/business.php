<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Empresa($registry[$dbSystem]);

// Prepare Transacction
$transaction = new Transaccion($registry[$dbSystem]);

// Data Action insert/delete/edit/view/insert_form/edit_form Capture, by default action is list
$action = 'list';
if (isset($_POST["action"])) {
    $action = $_POST["action"];
} else if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
// Messages init
$messageErrorTransaction = "";
$detailMessageErrorTransaction = "";
$messageOkTransaction = "";
// If action is insert
if ($action == 'insert') {
    try {
        if ($object->isExist(array($_POST["nombre_corto"], $_POST["razon_social"], $_POST["nit"]))) {
            $messageErrorTransaction = "No se puede ingresar una Empresa que ya existe. Revise los datos de Nombre corto, Razon Social o Nit.";
        } else {
            $idTransaccion = $transaction->insert(array(Empresa::INSERT, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));            
            $data = array($_POST["empresa"], $_POST["nombre_corto"], $_POST["razon_social"], $_POST["nit"], $_POST["direccion"], $_POST["telefono1"],$_POST["telefono2"], $_POST["telefono3"], ($_POST["fk_id_departamento"]==-1?NULL:$_POST["fk_id_departamento"]), (empty($_POST["fk_id_municipio"])||($_POST["fk_id_municipio"]==-1)?NULL:$_POST["fk_id_municipio"]), NULL, NULL, NULL, NULL, $_SESSION["authenticated_id_user"], $idTransaccion, $idTransaccion);
            
            if( $object->insert($data) == -1 ){
                throw new Exception("Error en el INSERT hacia la Base de datos.");
            }
            $messageOkTransaction = "El registro fue ingresado correctamente.";
        }
    } catch (Exception $e) {
        $messageErrorTransaction = "Existio un error al querer ingresar los datos.";
        $detailMessageErrorTransaction = '<strong>Error JF-View-0001:</strong> ' . $e->getMessage();
    }
    $action = 'list';
}
// If action is delete
if ($action == 'delete') {
    try {
        $idTransaccion = $transaction->insert(array(Empresa::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
        $data = array($_GET["idObject"], $_SESSION["authenticated_id_user"], $idTransaccion);        
        if( $object->delete($data) == -1 ){
            throw new Exception("Error en el DELETE hacia la Base de datos.");
        }
        $messageOkTransaction = "El registro fue eliminado correctamente.";
    } catch (Exception $e) {
        $messageErrorTransaction = "Existio un error al querer eliminar los datos.";
        $detailMessageErrorTransaction = '<strong>Error JF-View-0002:</strong> ' . $e->getMessage();
    }
    $action = 'list';
}

// If action is edit
if ($action == 'edit') {
    try {
        $result = NULL;
        $objectEdit = NULL;
        $result = $object->getList($_GET["idObject"]);
        $objectEdit = $result[0];
        if (($object->isExist(array($_POST["nombre_corto"], $_POST["razon_social"], $_POST["nit"]))) && ($objectEdit["nombre_corto"] != $_POST["nombre_corto"] || $objectEdit["razon_social"] != $_POST["razon_social"] || $objectEdit["nit"] != $_POST["nit"])) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar una Empresa que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Empresa::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"], $_POST["empresa"], $_POST["nombre_corto"], $_POST["razon_social"], $_POST["nit"], $_POST["direccion"], $_POST["telefono1"],$_POST["telefono2"], $_POST["telefono3"], ($_POST["fk_id_departamento"]==-1?NULL:$_POST["fk_id_departamento"]), (empty($_POST["fk_id_municipio"])||($_POST["fk_id_municipio"]==-1)?NULL:$_POST["fk_id_municipio"]), NULL, NULL, NULL, NULL, $_SESSION["authenticated_id_user"], $idTransaccion);            
            if( $object->update($data) == -1 ){
                throw new Exception("Error en el UPDATE hacia la Base de datos.");
            }
            $messageOkTransaction = "El registro fue modificado correctamente.";
        }
    } catch (Exception $e) {
        $messageErrorTransaction = "Existio un error al querer modificar los datos.";
        $detailMessageErrorTransaction = '<strong>Error JF-View-0003:</strong> ' . $e->getMessage();
    }
    $action = 'list';
}

// If action is view
if ($action == 'view') {
    $action = 'list';
}

// If action is list
if ($action == 'list') {
    $labelOptionList = $property["general"]["list"]["option"];
    ?>   
   
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-university"></i> Empresas</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones relacionadas con los datos de empresas.</p>
        </div>

        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="#"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="#">Seguridad</a>
                </li>
                <li class="active">
                    <strong>Manejo de empresas</strong>
                </li>
            </ol>
        </div>
    </div>  
    <!-- Contenido -->
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-success">
                <div class="row">
                    <div class="col-md-3">
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkbusiness&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-shop"></i>
                                <span>Agregar Empresa</span>
                            </button>
                        </form>
                    </div>   
                    <div class="col-md-9">
                        <!-- Mensajes de accion -->
                        <?php if ($messageOkTransaction != "") { ?>
                        <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Cerrar</span>
                                    </button>
                                    <strong><?php echo $messageOkTransaction; ?></strong>
                        </div>                        
                        <?php
                            } if ($messageErrorTransaction != "") {
                            ?>
                        <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Cerrar</span>
                                    </button>
                                    <strong><?php echo $messageErrorTransaction; ?></strong>
                        </div>                          
                        <?php } if ($detailMessageErrorTransaction != "") { ?>     
                        <div class="alert alert-default">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Cerrar</span>
                                    </button>
                                    <strong><?php echo $detailMessageErrorTransaction; ?></strong>
                        </div>                             
                        <?php } ?>            
                    </div>
                </div>                    
                
                <div class="panel-body">                        

                    <table id="example" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre completo</th>
                                <th>Nombre corto</th>
                                <th>Razon Social</th>
                                <th>Nit</th>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nombre completo</th>
                                <th>Nombre corto</th>
                                <th>Razon Social</th>
                                <th>Nit</th>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>   
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $result = $object->getList();
                            foreach ($result as $indice => $register) {
                                ?>
                                <tr>
                                    <td style="width: 25px;"></td>
                                    <td><?php echo $register['empresa']; ?></td>
                                    <td><?php echo $register['nombre_corto']; ?></td>
                                    <td><?php echo $register['razon_social']; ?></td>
                                    <td><?php echo $register['nit']; ?></td>
                                    <td style="width: 120px;"><?php echo $register['fecha_transaccion']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_empresa']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkbusiness&action=edit_form&idObject=<?php echo $register['pk_id_empresa']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_empresa']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>                        
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php
} else if ($action == 'insert_form' || $action == 'edit_form' || $action == 'view_form') {
    $typeOperation = "";
    if ($action == 'insert_form') {
        $describeTypeOperation = "el ingreso";
        $typeOperation = "ingresar nueva";
    } else if ($action == 'edit_form') {
        $describeTypeOperation = "la edici&oacute;n";
        $typeOperation = "editar datos de";
    } else if ($action == 'view_form') {
        $describeTypeOperation = "la  visualizaci&oacute;n";
        $typeOperation = "ver datos de";
    } else {
        $typeOperation = "Ningun";
    }
    $typeOperation = $typeOperation . " Empresa"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-university"></i> Empresas</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Empresa.</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="forms-native.html">Seguridad</a>
                </li>
                <li class="active">
                    <strong>Empresa</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Empresa</h3>                                       
                </div>
                <div class="panel-body">

                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-check-square-o"></i></span> deben ser llenados de manera obligatoria.</p> </br>

                    <form name="formObject" id="formObject" role="form" action="index.php?page=<?php echo $routeFull; ?>&action=<?php
                    if ($action == 'insert_form') {
                        echo "insert";
                    } else if ($action == 'edit_form') {
                        echo "edit&idObject=" . $_GET["idObject"];
                    } else {
                        echo 'view';
                    }
                    ?>" method="post" >
                          <?php
                          $result = NULL;
                          $objectEdit = NULL;
                          if ($action == 'edit_form' || $action == 'view_form') {
                              $result = $object->getList($_GET["idObject"]);
                              $objectEdit = $result[0];
                          }
                          ?>
                        <div class="row col-margin">
                            <div class="form-group col-lg-6">                            
                                <label for="empresa">Nombre <strong>completo</strong> de la Empresa:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="empresa" name="empresa" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["empresa"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="nombre_corto">Nombre <strong>corto</strong> de la Empresa utilizado como dominio:</label> <a class="fa fa-question-circle" style="cursor: pointer" tabindex="0" data-toggle="popover" data-trigger="focus" title="Dominio de la Empresa" data-content="Este dato le servira para poder acceder al sistema de la siguiente manera: usuario@dominio. Por ejemplo si su empresa tiene el dominio 'miempresa' los usuarios de su empresa deberan ingresar al sistema colocando usuario1@miempresa"></a>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="nombre_corto" name="nombre_corto" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["nombre_corto"] . "\" " : NULL); ?>/>
                                </div>
                            </div>    
                            <div class="form-group col-lg-6">
                                <label for="razon_social">Raz&oacute;n Social:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="razon_social" name="razon_social" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["razon_social"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-6">
                                <label for="nit">NIT:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="nit" name="nit" maxlength="64" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["nit"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="direccion">Direcci&oacute;n (Domicilio tributario):</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>
                                    <input id="direccion" name="direccion" maxlength="1024" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["direccion"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>     
                            <div class="form-group col-lg-4">
                                <label for="telefono1">Tel&eacute;fonos/Celulares:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Telefono/Celular 1"></span>                                        
                                    </span>
                                    <input id="telefono1" name="telefono1" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono1"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="telefono2">&nbsp;</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Telefono/Celular 2"></span>
                                    </span>
                                    <input id="telefono2" name="telefono2" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono2"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="telefono3">&nbsp;</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Telefono/Celular 3"></span>
                                    </span>
                                    <input id="telefono3" name="telefono3" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono3"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>                             
                            <div class="form-group col-lg-6">
                                <label for="fk_id_departamento">Departamento:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_departamento" name="fk_id_departamento" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_departamento"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $departamento = new Catalogo($registry[$dbSystem]);
                                        $result = $departamento->getCatalogo('departamento');
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_departamento"] == $register["pk_id_catalogo"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                             
                            <div class="form-group col-lg-6">
                                <label for="fk_id_municipio">Municipio:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>
                                    </span>
                                    <select id="fk_id_municipio" name="fk_id_municipio" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_municipio"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        if($action == 'edit_form' || $action == 'view_form'){
                                        $municipio = new Catalogo($registry[$dbSystem]);
                                        $result = $municipio->getCatalogo('municipio');
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_catalogo"]; ?>" <?php 
                                            if ( $objectEdit["fk_id_municipio"] == $register["pk_id_catalogo"] )  {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["descripcion"]; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>                                    
                                </div>                            
                            </div>   
                        </div>                            
                        <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($action == 'view_form') {
                                ?>                                           
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-shop"></i>
                                    <span>Aceptar</span>
                                </a>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-shop"></i>
                                    <span>Guardar</span>
                                </button>
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-blue btn-icon btn-icon-standalone">
                                    <i class="linecons-shop"></i>
                                    <span>Cancelar</span>
                                </a>                                    
                                <?php
                            }
                            ?>
                        </div>		
                        </div>                            
                                        
                    </form>                 

                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

