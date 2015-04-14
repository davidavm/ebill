<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Categoria($registry[$dbSystem]);

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
        if ($object->isExist(array($_POST["categoria"]))) {
            $messageErrorTransaction = "No se puede ingresar un Categoria que ya existe. Revise los datos de Categoria.";
        } else {
            $idTransaccion = $transaction->insert(array(Categoria::INSERT, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));            
            $data = array($_POST["categoria"], $_POST["descripcion"], $_SESSION["authenticated_id_user"], $idTransaccion, $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"]));
            
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
        $idTransaccion = $transaction->insert(array(Categoria::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
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
        if (($object->isExist(array($_POST["categoria"]))) && ($objectEdit["categoria"] != $_POST["categoria"])) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar una Categoria que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Categoria::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"], $_POST["categoria"], $_POST["descripcion"], $_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"]));            
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
            <h1 class="title"><i class="fa-users"></i> Categorias</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones relacionadas con los datos de categorias.</p>
        </div>

        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="#"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="#">Clientes</a>
                </li>
                <li class="active">
                    <strong>Manejo de categorias</strong>
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
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/clients/checkcategory&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-shop"></i>
                                <span>Agregar Categoria</span>
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
                                <th>Categoria</th>
                                <th>Descripci&oacute;n</th>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Categoria</th>
                                <th>Descripci&oacute;n</th>
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
                                    <td><?php echo $register['categoria']; ?></td>
                                    <td><?php echo $register['descripcion']; ?></td>
                                    <td style="width: 120px;"><?php echo $register['fecha_transaccion']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_categoria']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/clients/checkcategory&action=edit_form&idObject=<?php echo $register['pk_id_categoria']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_categoria']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
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
        $typeOperation = "ingresar nuevo";
    } else if ($action == 'edit_form') {
        $describeTypeOperation = "la edici&oacute;n";
        $typeOperation = "editar datos de";
    } else if ($action == 'view_form') {
        $describeTypeOperation = "la  visualizaci&oacute;n";
        $typeOperation = "ver datos de";
    } else {
        $typeOperation = "Ningun";
    }
    $typeOperation = $typeOperation . " Categoria"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-users"></i> Categorias</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Categoria.</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="forms-native.html">Clientes</a>
                </li>
                <li class="active">
                    <strong>Categoria</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Categoria</h3>                                       
                </div>
                <div class="panel-body">

                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-pencil-square-o"></i></span> deben ser llenados de manera obligatoria.</p> </br>

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
                            <div class="form-group col-lg-6" style="margin-bottom: 5px;">                            
                                <label for="categoria">Categoria:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="categoria" name="categoria" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["categoria"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6">
                                <label for="descripcion">Descripci&oacute;n:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <textarea id="descripcion" name="descripcion" maxlength="1024" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> ><?php echo($action == 'edit_form' || $action == 'view_form' ? $objectEdit["descripcion"]: NULL); ?></textarea>
                                </div>
                            </div>    
                        </div>     
                        <br/>
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

