<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Sucursal($registry[$dbSystem]);

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
        if ($object->isExist(array($_POST["sucursal"],$_POST["numero"],($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"])))) {
            $messageErrorTransaction = "No se puede ingresar una sucursal que ya existe. Revise los datos de Sucursal.";
        } else {
          
           //  ECHO $_POST["fk_id_empresa"];
            // ECHO "<BR>". $_SESSION["authenticated_id_empresa"];
            $idTransaccion = $transaction->insert(array(Sucursal::INSERT, $_SESSION["authenticated_id_user"]
                    , ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])  ));            
            $data = array($_POST["sucursal"], 
                          $_POST["razon_social"], 
                          $_POST["numero"], 
                          $_POST["direccion"], 
                          $_POST["telefono1"], 
                          $_POST["telefono2"], 
                          $_POST["telefono3"], 
                          $_SESSION["authenticated_id_user"], 
                          $idTransaccion, 
                          $idTransaccion,
                          ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"])
                    );
            
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
        $idTransaccion = $transaction->insert(array(Grupo::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1? NULL :$_SESSION["authenticated_id_empresa"])));
        $data = array($_GET["idObject"], 
                      $_SESSION["authenticated_id_user"], 
                      $idTransaccion,
                      ($_SESSION["authenticated_id_empresa"]==-1? NULL :$_SESSION["authenticated_id_empresa"])
                     );   
           //echo '<PRE>';
           //print_r($data);
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
  
        
        if ($object->isExist(array($_POST["sucursal"],$_POST["numero"],($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]))) 
            && ($objectEdit["sucursal"] != $_POST["sucursal"] || $objectEdit["numero"] != $_POST["numero"]  || $objectEdit["fk_id_empresa"] != ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"]) )
            ) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, no se puede ingresar una Sucursal con el mismo nombre y numero para la misma empresa.";
        } else {
         
            $idTransaccion = $transaction->insert(array(Grupo::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1? NULL :$_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"], 
                          $_POST["sucursal"], 
                          $_POST["razon_social"], 
                          $_POST["numero"], 
                          $_POST["direccion"], 
                          $_POST["telefono1"], 
                          $_POST["telefono2"], 
                          $_POST["telefono3"], 
                           $_SESSION["authenticated_id_user"], 
                           $idTransaccion,
                          ($_SESSION["authenticated_id_empresa"]==-1?$_POST["fk_id_empresa"]:$_SESSION["authenticated_id_empresa"])
                            ); 
            
            print_r($data);
            if( $object->update($data) == -1 ){
                throw new Exception("Error en el Update hacia la Base de datos.");
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
            <h1 class="title"><i class="fa fa-cubes"></i> Sucursales</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones para administrar las Sucursales.</p>
        </div>

        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="#"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="#">Facturacion</a>
                </li>
                <li class="active">
                    <strong>Sucursales</strong>
                </li>
            </ol>
        </div>
    </div>  
    <!-- Contenido -->
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-success">
                <div class="row">
                    <div class="col-md-3">                                         <!-- &ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkpeople&action=edit_form&action=insert_form" style="margin-top:1px;">-->
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/billing/checkBranch&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-shop"></i>
                                <span>Agregar Sucursal</span>
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
                                <th>Empresa</th>
                                <th>Sucursal</th>
                                <th>Direccion</th>
                                <th>Nro</th>
                                <th>Telefonos</th>
                                <th>Opciones</th> 
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                              <th>Empresa</th>
                                <th>Sucursal</th>
                                <th>Direccion</th>
                                <th>Nro</th>
                                <th>Telefonos</th>
                                <th>Opciones</th> 
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $result = $object->getList();
                            foreach ($result as  $register) {
                                ?>
                                <tr>
                                    <td><?php echo $register['empresa']; ?></td>
                                    <td><?php echo $register['sucursal']; ?></td>
                                    <td><?php echo $register['direccion']; ?></td>
                                    <td><?php echo $register['numero']; ?></td>
                                     <td><?php echo $register['telefono1'].', '.$register['telefono2'].', '.$register['telefono3']; ?></td>
                              
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_sucursal']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/billing/checkBranch&action=edit_form&idObject=<?php echo $register['pk_id_sucursal']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_sucursal']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
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
    $typeOperation = $typeOperation . " Sucursal"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa fa-cubes"></i> Sucursales</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Sucursales.</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="forms-native.html">Facturacion</a>
                </li>
                <li class="active">
                    <strong>Sucursal</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Sucursal</h3>                                       
                </div>
           
            
                <div class="panel-body">

                    <p class="description">Los campos marcados con este simbolo <span  data-toggle="tooltip" data-placement="top" title="Campo obligatorio."><i class="fa fa-pencil-square-o "></i></span> deben ser llenados de manera obligatoria.</p> </br>

                    <form name="formObject" id="formObject"  role="form" enctype="multipart/form-data" action="index.php?page=<?php echo $routeFull; ?>&action=<?php
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
                                <label for="sucursal">Sucursal:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o " data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="sucursal" name="sucursal" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["sucursal"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="razon_social">Razon Social:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="razon_social" name="razon_social" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["razon_social"] . "\" " : NULL); ?>/>
                                </div>
                            </div>    
                            <div class="form-group col-lg-4">
                                <label for="numero">Numero:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="numero" name="numero" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["numero"] . "\" " : NULL); ?>/>
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
                            <div class="clear"></div>
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
    <?php
}
?>
