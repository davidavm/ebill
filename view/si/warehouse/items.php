<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Item($registry[$dbSystem]);

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
        if ($object->isExist(array($_POST["nit"], $_POST["razon_social"]))) {
            $messageErrorTransaction = "No se puede ingresar un Item que ya existe. Revise los datos de Nit y Razon Social.";
        } else {
            $idTransaccion = $transaction->insert(array(Item::INSERT, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));            
            $data = array($_POST["codigo"], $_POST["razon_social"], $_POST["nit"], $_POST["direccion"], $_POST["telefono1"], $_POST["telefono2"], $_POST["telefono3"], $_POST["contacto"], $_POST["fk_id_unidad_medida"], $_POST["fk_id_proveedor"],$_POST["fk_id_grupo_padre"],$_POST["fk_id_grupo"],$_POST["fk_id_vendedor"],$_POST["fecha1"],$_POST["fecha2"],$_POST["texto1"],$_POST["texto2"],$_SESSION["authenticated_id_user"], $idTransaccion, $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"]));
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
        $idTransaccion = $transaction->insert(array(Item::DELETE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
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
        if (($object->isExist(array($_POST["nit"], $_POST["razon_social"]))) && ($objectEdit["nit"] != $_POST["nit"] || $objectEdit["razon_social"] != $_POST["razon_social"])) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar un Item que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Item::UPDATE, $_SESSION["authenticated_id_user"], ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])));
            $data = array($_GET["idObject"],$_POST["codigo"], $_POST["razon_social"], $_POST["nit"], $_POST["direccion"], $_POST["telefono1"], $_POST["telefono2"], $_POST["telefono3"], $_POST["contacto"], $_POST["fk_id_unidad_medida"], $_POST["fk_id_proveedor"],$_POST["fk_id_grupo_padre"],$_POST["fk_id_grupo"],$_POST["fk_id_vendedor"],$_POST["fecha1"],$_POST["fecha2"],$_POST["texto1"],$_POST["texto2"],$_SESSION["authenticated_id_user"], $idTransaccion, ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"]));
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
            <h1 class="title"><i class="fa fa-clipboard"></i> Items</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones relacionadas con los datos de vendedores.</p>
        </div>

        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="#"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="#">Items</a>
                </li>
                <li class="active">
                    <strong>Manejo de vendedores</strong>
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
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/warehouse/checkitems&cf_jscss[1]=datetimepicker&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-shop"></i>
                                <span>Agregar Item</span>
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
                                <th>Cod. Item</th>
                                <th>Cod. Fabrica</th>
                                <th>Item</th>
                                <th>Unidad</th>
                                <th>Costo</th>
                                <th>Precio</th>
                                <th>Vencimiento</th>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Cod. Item</th>
                                <th>Cod. Fabrica</th>
                                <th>Item</th>
                                <th>Unidad</th>
                                <th>Costo</th>
                                <th>Precio</th>
                                <th>Vencimiento</th>
                                <th>Modificaci&oacute;n</th>
                                <th>Acciones</th>                    
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $result = $object->getList(Item::ALL,($_SESSION["authenticated_id_empresa"]==-1?Item::ALL:$_SESSION["authenticated_id_empresa"]));
                            foreach ($result as $indice => $register) {
                                ?>
                                <tr>
                                    <td style="width: 25px;"></td>
                                    <td><?php echo $register['codigo_item']; ?></td>
                                    <td><?php echo $register['codigo_fabrica']; ?></td>
                                    <td><?php echo $register['descripcion']; ?></td>
                                    <td><?php echo $register['unidad_medida']; ?></td>
                                    <td><?php echo $register['cantidad']; ?></td>
                                    <td><?php echo $register['costo_unitario']; ?></td>
                                    <td><?php echo $register['precio_unitario']; ?></td>
                                    <td><?php echo $register['fecha_vencimiento']; ?></td>
                                    <td style="width: 120px;"><?php echo $register['fecha_transaccion']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_item']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/warehouse/checkitems&cf_jscss[1]=datetimepicker&action=edit_form&idObject=<?php echo $register['pk_id_item']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_item']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
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
    $typeOperation = $typeOperation . " Item"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa fa-clipboard"></i> Items</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para Item.</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="index.php"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="forms-native.html">Items</a>
                </li>
                <li class="active">
                    <strong>Manejo de Items</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Item</h3>                                       
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
                            <div class="form-group col-lg-4">                            
                                <label for="codigo_item">C&oacute;digo de Item:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">                                        
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="codigo_item" name="codigo_item" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["codigo_item"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="codigo_fabrica">C&oacute;digo de Fabrica:</label> 
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="codigo_fabrica" name="codigo_fabrica" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["codigo_fabrica"] . "\" " : NULL); ?>/>
                                </div>
                            </div>    
                            <div class="form-group col-lg-4">
                                <label for="descripcion">Nombre del Item:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="descripcion" name="descripcion" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["descripcion"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-12">                            
                                <label for="caracteristicas_especiales">Caracter&iacute;sticas Especiales:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="caracteristicas_especiales" name="caracteristicas_especiales" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["caracteristicas_especiales"] . "\" " : NULL); ?>/>
                                </div>
                            </div>                            
                            <div class="form-group col-lg-4">
                                <label for="cantidad">Cantidad Inicial:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="cantidad" name="cantidad" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["cantidad"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="costo_unitario">Costo Unitario:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="costo_unitario" name="costo_unitario" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["costo_unitario"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="precio_unitario">Precio Unitario:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="precio_unitario" name="precio_unitario" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["precio_unitario"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="fk_id_unidad_medida">Unidad de Medida:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>
                                    <select id="fk_id_unidad_medida" name="fk_id_unidad_medida" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_unidad_medida"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $unidadMedida = new UnidadMedida($registry[$dbSystem]);
                                        $result = $unidadMedida->getList(UnidadMedida::ALL,($_SESSION["authenticated_id_empresa"]==-1?UnidadMedida::ALL:$_SESSION["authenticated_id_empresa"]));
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_unidad_medida"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_unidad_medida"] == $register["pk_id_unidad_medida"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["unidad_medida"]." (".$register["unidad_medida"].")"; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>
                            <div class="form-group col-lg-4">                            
                                <label for="fecha_vencimiento">Fecha Vencimiento (yyyy-mm-dd):</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="fecha_vencimiento" name="fecha_vencimiento" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["fecha_vencimiento"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">                            
                                <label for="saldo_minimo">Saldo M&iacute;nimo:</label>                                
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="Campo Opcional."></span>
                                    </span>                            
                                    <input id="saldo_minimo" name="saldo_minimo" maxlength="255" class="form-control" type="text"<?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["saldo_minimo"] . "\" " : NULL); ?>/>
                                </div>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="fk_id_proveedor">Proveedor:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Opcional un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_proveedor" name="fk_id_proveedor" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_proveedor"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $proveedor = new Proveedor($registry[$dbSystem]);
                                        $result = $proveedor->getList(Proveedor::ALL,($_SESSION["authenticated_id_empresa"]==-1?Proveedor::ALL:$_SESSION["authenticated_id_empresa"]));
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_proveedor"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_proveedor"] == $register["pk_id_proveedor"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["razon_social"]." - Nit ". $register["nit"]. " - C&oacute;digo".$register["codigo"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>  
                            
                            <div class="form-group col-lg-4">
                                <label for="fk_id_grupo_padre">Grupo Padre:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                         <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Opcional un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_grupo_padre" name="fk_id_grupo_padre" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_grupo_padre"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $grupoPadre = new Grupo($registry[$dbSystem]);
                                        $result = $grupoPadre->getListFathers(Grupo::ALL,($_SESSION["authenticated_id_empresa"]==-1?Grupo::ALL:$_SESSION["authenticated_id_empresa"]));
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_grupo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_grupo_padre"] == $register["pk_id_grupo"]) ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["grupo"]; ?></option>
                                        <?php
                                        }
                                        $grupoPadre = NULL;
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div>                             
                            <div class="form-group col-lg-4">
                                <label for="fk_id_grupo">Grupo:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                         <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Opcional un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_grupo" name="fk_id_grupo" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_grupo"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        if($action == 'edit_form' || $action == 'view_form'){
                                        $grupo = new Grupo($registry[$dbSystem]);
                                        $result = $grupo->getListOffSpring($objectEdit["fk_id_grupo_padre"],($_SESSION["authenticated_id_empresa"]==-1?Grupo::ALL:$_SESSION["authenticated_id_empresa"]));
                                        foreach ($result as $indice => $register) {
                                        ?>
                                        <option value="<?php echo $register["pk_id_grupo"]; ?>" <?php 
                                            if ( $objectEdit["fk_id_grupo"] == $register["pk_id_grupo"] )  {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $register["grupo"]; ?></option>
                                        <?php
                                        }
                                        $grupo = NULL;
                                        }
                                        ?>
                                    </select>                                    
                                </div>                            
                            </div> 
                        </div> 
                            <div class="form-group col-lg-8">
                                <label for="fk_id_archivo_imagen">Subir imagen de Item:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa-picture-o" data-toggle="tooltip" data-placement="top" title="Campo opcional"></span>
                                    </span>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />                                                                        
                                    <input id="fk_id_archivo_imagen" name="fk_id_archivo_imagen" class="form-control" type="file" accept="image/*" style="padding: 0px;" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["fk_id_archivo_imagen"] . "\" " : NULL); ?>/>                                    
                                </div>  
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="old_fk_id_archivo_foto">&nbsp;</label>
                                <div class="input-group">
                                     
                                <?php                                 
                                        if($objectEdit["fk_id_archivo_foto"] == NULL ){
                                    ?>
                                    <img src="<?php echo IMG_RELATIVE_PATH . "ebil/user-1.png"; ?>" alt="Usuario del sistema" class="img-circle img-inline userpic-32" width="35" />
                                    <?php
                                        } elseif( $action == 'edit_form' || $action == 'view_form' ){
                                    ?>
                                    <input type="hidden" name="old_fk_id_archivo_foto" value="<?php echo $objectEdit["fk_id_archivo_foto"]; ?>" />
                                    <img src="<?php echo UPLOAD_RELATIVE_PATH . "identification/".$objectEdit["nombre_archivo_foto"]; ?>" alt="Usuario del sistema" class="img-circle img-inline userpic-32" width="35" height="35"/>        
                                    <?php
                                        }
                                    ?>     
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

