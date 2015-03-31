<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Usuario($registry[$dbSystem]);

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
        if ($object->isExist(array($_POST["usuario"], ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) ))) {
            $messageErrorTransaction = "No se puede ingresar una Usuario que ya existe. Revise los datos de Usuario y Empresa.";
        } else {
            $idTransaccion = $transaction->insert(array(Usuario::INSERT, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])) );                       
            $data = array($_POST["usuario"], $_POST["llave"], $_POST["fk_id_persona"], 'NOBASE', $_SESSION["authenticated_id_user"], $idTransaccion, $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]), $_POST["fk_id_rol"]);            
            if( $object->insert($data)  == -1 ){
                throw new Exception("Error en el INSERT de usuario hacia la Base de datos.");
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
        $idTransaccion = $transaction->insert(array(Usuario::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
        $data = array($_GET["idObject"], $_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_GET["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]), $_GET["pk_id_usuario_rol"]);        
        if( $object->delete($data) == -1 ){
            throw new Exception("Error en el DELETE usuario hacia la Base de datos.");
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
        if (($object->isExist(array($_POST["usuario"], ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) ))) && ($objectEdit["usuario"] != $_POST["usuario"] || $objectEdit["fk_id_empresa"] != ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) )) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar un Usuario que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Usuario::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"], $_POST["usuario"], $_POST["llave"], $_POST["fk_id_persona"], 'NOBASE', $_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]), $_POST["fk_id_rol"], $_GET["pk_id_usuario_rol"]);
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
            <h1 class="title"><i class="fa-user"></i> Usuarios</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones relacionadas con los datos de usuarios.</p>
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
                    <strong>Manejo de usuarios</strong>
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
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkusers&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-user"></i>
                                <span>Agregar Usuario</span>
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
                                <th>Usuario</th>
                                <th>Rol</th>                                
                                <th>Persona</th>
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
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Persona</th>                                
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
                            $result = $object->getList(Usuario::ALL, ($_SESSION["authenticated_id_empresa"]==-1?Usuario::ALL:$_SESSION["authenticated_id_empresa"]) );
                            foreach ($result as $indice => $register) {
                                ?>
                                <tr>
                                    <td style="width: 25px;"></td>
                                    <td><?php echo $register['usuario']; ?></td>
                                    <td><?php echo $register['rol']; ?></td>
                                    <td><?php echo $register['nombres']." ".$register['apellido_paterno']." ".$register['apellido_materno']; ?></td>
                                    <td><?php echo $register['tipo_documento_identidad']." ".$register['numero_identidad']." ".$register['departamento_expedicion_doc']; ?></td>
                                    <?php if( $_SESSION["authenticated_id_empresa"] == -1 ){ ?>
                                    <td><?php echo $register['nombre_corto']." (NIT: ".$register['nit'].")"; ?></td>
                                    <?php } ?>
                                    <td style="width: 130px;"><?php echo $register['fecha_transaccion']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_usuario']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkusers&action=edit_form&idObject=<?php echo $register['pk_id_usuario']; ?>&pk_id_usuario_rol=<?php echo$register['pk_id_usuario_rol']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_usuario']; ?>&pk_id_usuario_rol=<?php echo$register['pk_id_usuario_rol']; ?><?php echo ($_SESSION["authenticated_id_empresa"]==-1?'&fk_id_empresa='.$register['fk_id_empresa']:$_SESSION["authenticated_id_empresa"]); ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
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
    $typeOperation = $typeOperation . " Usuario"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-male"></i> Usuarios</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Usuario.</p>
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
                    <strong>Usuario</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Usuario</h3>                                       
                </div>
                <div class="panel-body">

                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-pencil-square-o "></i></span> deben ser llenados de manera obligatoria.</p> </br>

                    <form name="formObject" id="formObject" role="form" action="index.php?page=<?php echo $routeFull; ?>&action=<?php
                    if ($action == 'insert_form') {
                        echo "insert";
                    } else if ($action == 'edit_form') {
                    echo "edit&idObject=" . $_GET["idObject"]."&pk_id_usuario_rol=".$_GET["pk_id_usuario_rol"];
                    } else {
                        echo 'view';
                    }
                    ?>" method="post" >
                          <?php
                          $result = NULL;
                          $objectEdit = NULL;
                          if ($action == 'edit_form' || $action == 'view_form') {
                              $result = $object->getList($_GET["idObject"], ($_SESSION["authenticated_id_empresa"]==-1?Usuario::ALL:$_SESSION["authenticated_id_empresa"]) );
                              $objectEdit = $result[0];
                          }
                          ?>
                        <div class="row col-margin">
                            <div class="form-group col-lg-6">                            
                                <label for="usuario">Usuario:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="usuario" name="usuario" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["usuario"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="llave">Contrase&nacute;a:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="llave" name="llave" maxlength="255" class="form-control" type="password" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["llave"] . "\" " : NULL); ?>/>
                                </div>
                            </div>    
                            <div class="form-group col-lg-6">
                                <label for="fk_id_rol">Rol:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_id_rol" name="fk_id_rol" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_rol"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $rol = new Rol($registry[$dbSystem]);
                                        $result = $rol->getList();
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_rol"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_rol"] == $register["pk_id_rol"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["rol"]." (".$register["descripcion"].")"; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                         
                            <?php 
                            if( $_SESSION["authenticated_id_empresa"] == -1 ){
                            ?>
                            <div class="form-group col-lg-6">
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
                            <div class="form-group col-lg-6">
                                <label for="fk_id_persona">Persona:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_id_persona" name="fk_id_persona" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_persona"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        if($action == 'edit_form' || $action == 'view_form'){
                                        $persona = new Persona($registry[$dbSystem]);
                                        $result = $persona->getList(Persona::ALL );
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_persona"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_persona"] == $register["pk_id_persona"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["nombres"]." ".$register["apellido_paterno"]." ".$register["apellido_materno"]." (".$register["tipo_documento_identidad"]." ".$register["numero_identidad"]." ".$register["departamento_expedicion_doc"].")"; ?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                             
                            <?php
                            } else{
                            ?>
                            <div class="form-group col-lg-6">
                                <label for="fk_id_persona">Persona:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Obligatorio, seleccione un valor."></span>                                        
                                    </span>
                                    <select id="fk_id_persona" name="fk_id_persona" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_persona"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $persona = new Persona($registry[$dbSystem]);
                                        $result = $persona->getList(Persona::ALL, $_SESSION["authenticated_id_empresa"] );
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_persona"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_persona"] == $register["pk_id_persona"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["nombres"]." ".$register["apellido_paterno"]." ".$register["apellido_materno"]." (".$register["tipo_documento_identidad"]." ".$register["numero_identidad"]." ".$register["departamento_expedicion_doc"].")"; ?></option>
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
                                    <i class="linecons-user"></i>
                                    <span>Aceptar</span>
                                </a>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-user"></i>
                                    <span>Guardar</span>
                                </button>
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-blue btn-icon btn-icon-standalone">
                                    <i class="linecons-user"></i>
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

