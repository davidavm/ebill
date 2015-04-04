<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkchangepwd";
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

// If action is edit
if ($action == 'edit') {
    try {
        $result = NULL;
        $objectEdit = NULL;
        $idTransaccion = $transaction->insert(array(Empresa::UPDATE, $_SESSION["authenticated_id_user"], $_SESSION["authenticated_id_empresa"]));
        $data = array($_POST["retypellave"], $_SESSION["authenticated_id_user"], $idTransaccion, $_SESSION["authenticated_id_user"]);
        if ($object->updatePassword($data) == -1) {
            throw new Exception("Error en el UPDATE hacia la Base de datos.");
        }
        $messageOkTransaction = "El registro fue modificado correctamente.";
    } catch (Exception $e) {
        $messageErrorTransaction = "Existio un error al querer modificar los datos.";
        $detailMessageErrorTransaction = '<strong>Error JF-View-0003:</strong> ' . $e->getMessage();
    }
}

// If action is view
if ($action == 'view') {
    $action = 'edit';
}
?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-male"></i> Cambiar Contraseña</h1>
            <p class="description">En este formulario usted podr&aacute; realizar de su contrase&nacute;a.</p>
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
                    <strong>Cambiar contrase&nacute;a</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para cambiar la contrase&nacute;a del usuario actual.</h3>                                       
                </div>
                <div class="panel-body">
                    <div class="row">
                    <div class="col-md-7">
                        <!-- Mensajes de accion -->
                        <?php if ($messageOkTransaction != "") { ?>
                        <div class="alert alert-info">
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
                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-pencil-square-o"></i></span> deben ser llenados de manera obligatoria.</p> </br>

                    <form name="formObject" id="formObject" role="form" action="index.php?page=<?php echo $routeFull; ?>&action=edit" method="post" >
                        <div class="row col-margin">
                            <div class="form-group col-lg-7">
                                <label for="llave">Ingrese la nueva contrase&nacute;a:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="llave" name="llave" maxlength="255" class="form-control" type="password" />
                                </div>
                            </div>        
                        </div>
                        <br/>
                        <div class="row col-margin">
                            <div class="form-group col-lg-7">
                                <label for="retypellave">Reescribir nueva contrase&nacute;a para confirmar:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="retypellave" name="retypellave" maxlength="255" class="form-control" type="password" />
                                </div>
                            </div>
                            <br/>
                        </div>                            
                        <div class="row">
                        <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-user"></i>
                                    <span>Guardar</span>
                                </button>
                                <a href="index.php?page=<?php echo $routeFull; ?>" class="btn btn-blue btn-icon btn-icon-standalone">
                                    <i class="linecons-user"></i>
                                    <span>Cancelar</span>
                                </a>                                    
                        </div>		
                        </div>                            
                                        
                    </form>                 


                </div>
            </div>
        </div>
    </div>


