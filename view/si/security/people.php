<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Persona($registry[$dbSystem]);

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
        if ($object->isExist(array($_POST["fk_tipo_documento_identidad"], $_POST["numero_identidad"], $_POST["fk_departamento_expedicion_doc"], ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) ))) {
            $messageErrorTransaction = "No se puede ingresar una Persona que ya existe. Revise los datos de Nombre corto, Razon Social o Nit.";
        } else {
            $idTransaccion = $transaction->insert(array(Persona::INSERT, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])) );                       
            $data = array($_POST["nombres"], $_POST["apellido_paterno"], $_POST["apellido_materno"], $_POST["fk_tipo_documento_identidad"], $_POST["numero_identidad"], $_POST["fk_departamento_expedicion_doc"],$_POST["direccion"], $_POST["telefono1"],$_POST["telefono2"],$_POST["telefono3"], NULL, $_SESSION["authenticated_id_user"], $idTransaccion, $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]));
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
        $idTransaccion = $transaction->insert(array(Persona::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
        $data = array($_GET["idObject"], $_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_GET["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]));        
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
        if (($object->isExist(array($_POST["fk_tipo_documento_identidad"], $_POST["numero_identidad"], $_POST["fk_departamento_expedicion_doc"], ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) ))) && ($objectEdit["fk_tipo_documento_identidad"] != $_POST["fk_tipo_documento_identidad"] || $objectEdit["numero_identidad"] != $_POST["numero_identidad"] || $objectEdit["fk_departamento_expedicion_doc"] != $_POST["fk_departamento_expedicion_doc"] || $objectEdit["fk_id_empresa"] != ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) )) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar una Persona que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Persona::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"], $_POST["nombres"], $_POST["apellido_paterno"], $_POST["apellido_materno"], $_POST["fk_tipo_documento_identidad"], $_POST["numero_identidad"], $_POST["fk_departamento_expedicion_doc"],$_POST["direccion"], $_POST["telefono1"],$_POST["telefono2"],$_POST["telefono3"], NULL, $_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]));
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
            <h1 class="title"><i class="fa-male"></i> Personas</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones relacionadas con los datos de personas.</p>
        </div>

        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="index.php"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="#">Seguridad</a>
                </li>
                <li class="active">
                    <strong>Manejo de personas</strong>
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
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkpeople&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-thumbs-up"></i>
                                <span>Agregar Persona</span>
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
                                <th>Nombres</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Identificaci&oacute;n</th>
                                <?php if( $_SESSION["authenticated_id_empresa"] == -1 ){ ?>
                                <th>Empresa</th>
                                <?php } ?>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nombres</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Identificaci&oacute;n</th>
                                <?php if( $_SESSION["authenticated_id_empresa"] == -1 ){ ?>
                                <th>Empresa</th>
                                <?php } ?>                                
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $result = $object->getList(Persona::ALL, ($_SESSION["authenticated_id_empresa"]==-1?Persona::ALL:$_SESSION["authenticated_id_empresa"]) );
                            foreach ($result as $indice => $register) {
                                ?>
                                <tr>
                                    <td style="width: 25px;"></td>
                                    <td><?php echo $register['nombres']; ?></td>
                                    <td><?php echo $register['apellido_paterno']; ?></td>
                                    <td><?php echo $register['apellido_materno']; ?></td>
                                    <td><?php echo $register['tipo_documento_identidad']." ".$register['numero_identidad']." ".$register['departamento_expedicion_doc']; ?></td>
                                    <?php if( $_SESSION["authenticated_id_empresa"] == -1 ){ ?>
                                    <td><?php echo $register['empresa']; ?></td>
                                    <?php } ?>
                                    <td style="width: 130px;"><?php echo $register['fecha_transaccion']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_persona']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkpeople&action=edit_form&idObject=<?php echo $register['pk_id_persona']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_persona']; ?><?php echo ($_SESSION["authenticated_id_empresa"]==-1?'&fk_id_empresa='.$register['fk_id_empresa']:$_SESSION["authenticated_id_empresa"]); ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
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
    $typeOperation = $typeOperation . " Persona"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-male"></i> Personas</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Persona.</p>
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
                    <strong>Persona</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Persona</h3>                                       
                </div>
                <div class="panel-body">

                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-pencil-square-o "></i></span> deben ser llenados de manera obligatoria.</p> </br>

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
                              $result = $object->getList($_GET["idObject"], ($_SESSION["authenticated_id_empresa"]==-1?Persona::ALL:$_SESSION["authenticated_id_empresa"]) );
                              $objectEdit = $result[0];
                          }
                          ?>
                        <div class="row col-margin">
                            <div class="form-group col-lg-4">                            
                                <label for="nombres">Nombres:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="nombres" name="nombres" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["nombres"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="apellido_paterno">Primer apellido:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="apellido_paterno" name="apellido_paterno" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["apellido_paterno"] . "\" " : NULL); ?>/>
                                </div>
                            </div>    
                            <div class="form-group col-lg-4">
                                <label for="apellido_materno">Segundo apellido:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="apellido_materno" name="apellido_materno" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["apellido_materno"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="fk_tipo_documento_identidad">Tipo de documento identidad:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_tipo_documento_identidad" name="fk_tipo_documento_identidad" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_tipo_documento_identidad"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $tipo_documento_identidad = new Catalogo($registry[$dbSystem]);
                                        $result = $tipo_documento_identidad->getCatalogo('tipo_documento_identidad');
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_tipo_documento_identidad"] == $register["pk_id_catalogo"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                               
                            <div class="form-group col-lg-4">
                                <label for="numero_identidad">Numero de identidad:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="numero_identidad" name="numero_identidad" maxlength="64" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["numero_identidad"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="fk_departamento_expedicion_doc">Departamento de expedici&oacute;n de documento:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_departamento_expedicion_doc" name="fk_departamento_expedicion_doc" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_departamento_expedicion_doc"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $departamento = new Catalogo($registry[$dbSystem]);
                                        $result = $departamento->getCatalogo('departamento');
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_departamento_expedicion_doc"] == $register["pk_id_catalogo"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                               
                            <div class="form-group col-lg-12">
                                <label for="direccion">Direcci&oacute;n o ubicaci&oacute;n del domicilio:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo opcional."></span>
                                    </span>
                                    <input id="direccion" name="direccion" maxlength="1024" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["direccion"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>     
                            <div class="form-group col-lg-4">
                                <label for="telefono1">Tel&eacute;fonos/Celulares:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Opcional, Telefono/Celular 1"></span>                                        
                                    </span>
                                    <input id="telefono1" name="telefono1" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono1"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="telefono2">&nbsp;</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Opcional, Telefono/Celular 2"></span>
                                    </span>
                                    <input id="telefono2" name="telefono2" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono2"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="telefono3">&nbsp;</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-tty" data-toggle="tooltip" data-placement="top" title="Opcional, Telefono/Celular 3"></span>
                                    </span>
                                    <input id="telefono3" name="telefono3" maxlength="32" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["telefono3"] . "\" " : NULL); ?>/>
                                </div>                            
                            </div>
                            <?php 
                            if( $_SESSION["authenticated_id_empresa"] == -1 ){
                            ?>
                            <div class="form-group col-lg-8">
                                <label for="fk_id_empresa">Empresa:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_id_empresa" name="fk_id_empresa" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_empresa"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $empresa = new Empresa($registry[$dbSystem]);
                                        $result = $empresa->getList(Empresa::ALL);
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_empresa"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_empresa"] == $register["pk_id_empresa"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["empresa"]." ( <strong>Dominio</strong>: ".$register["nombre_corto"].", <strong>NIT</strong>: ".$register["nit"]." )"; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>  
                            <?php
                            }
                            ?>
                            </br>
                        </div>                            
                        <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($action == 'view_form') {
                                ?>                                           
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-thumbs-up"></i>
                                    <span>Aceptar</span>
                                </a>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-thumbs-up"></i>
                                    <span>Guardar</span>
                                </button>
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-blue btn-icon btn-icon-standalone">
                                    <i class="linecons-thumbs-up"></i>
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

