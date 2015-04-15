<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Factura($registry[$dbSystem]);

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
//require_once 'create_invoice_pdf.php';
if ($action == 'insert') {
    
    try {
        if ($object->isExist(array($_POST["grupo"]))) {
            $messageErrorTransaction = "No se puede ingresar una factura que ya existe. Revise los datos de factura.";
        } else {
          
            
            $idTransaccion = $transaction->insert(array(Grupo::INSERT, $_SESSION["authenticated_id_user"], $_SESSION["authenticated_id_empresa"]));            
            $data = array($_POST["fk_id_sucursal"],
                            $_POST["numero_factura"],
                            $_POST["numero_autorizacion"],
                            $_POST["llave_dosificacion"],
                            $_POST["fecha_limite_emision"],
                            $_POST["fecha_factura"],
                            $_POST["nit_cliente"],
                            $_POST["categoria"],
                            $_POST["razon_social"],
                            $_POST["descuento"], 
                            $_POST["fk_id_formato_dato_descuento"],
                            $_POST["recargo"],
                            $_POST["fk_id_formato_dato_recargo"],
                            $_POST["ice"], 
                            $_POST["excentos"], 
                            $_POST["fk_id_opcion_tipo_venta"],
                            $_POST["cantidad_dias"],
                            $_POST["codigo_control"],
                            $_POST["cantidad"], 
                            $_POST["unidad"],
                            $_POST["fk_id_dato_entrada_buscar_unidad"],
                            $_POST["detalle"],
                            $_POST["precio_unitario"], 
                            $_POST["total"],
                            $_POST["sujeto_descuento_fiscal"], 
                          $_SESSION["authenticated_id_user"], 
                          $idTransaccion, 
                          $idTransaccion,
                          $_SESSION["authenticated_id_empresa"]);
            
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
        $idTransaccion = $transaction->insert(array(Grupo::DELETE, $_SESSION["authenticated_id_user"], $_SESSION["authenticated_id_empresa"]));
        $data = array($_GET["idObject"], 
                      $_SESSION["authenticated_id_user"], 
                      $idTransaccion,
                      $_SESSION["authenticated_id_empresa"]
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
    
require_once 'create_invoice_pdf.php';
    try {
        $result = NULL;
        $objectEdit = NULL;
        $result = $object->getList($_GET["idObject"]);
        $objectEdit = $result[0];
        
        
        
        if (($object->isExist(array($_POST["grupo"]))) && ($objectEdit["grupo"] != $_POST["grupo"] )) {
            $messageErrorTransaction = "Edici&oacute;n incorrecta, se quiere ingresar un Grupo que ya existe.";
        } else {
            $idTransaccion = $transaction->insert(array(Grupo::UPDATE, $_SESSION["authenticated_id_user"], $_SESSION["authenticated_id_empresa"]));
            $data = array($_GET["idObject"], 
                           $_POST["fk_id_grupo_padre"],
                           $_POST["grupo"], 
                           $_POST["descripcion"], 
                           $_POST["fk_id_tipo_grupo"], 
                           $_SESSION["authenticated_id_user"], 
                           $idTransaccion,
                           $_SESSION["authenticated_id_empresa"]
                            ); 
            
            
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
            <h1 class="title"><i class="fa fa-cubes"></i> Facturas</h1>
            <p class="description">En esta p&aacute;gina podr&aacute; realizar operaciones para administrar las facturas.</p>
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
                    <strong>Facturar</strong>
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
                        <form method="post" action="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/billing/checkInvoices&action=edit_form&action=insert_form" style="margin-top:1px;">
                            <button type="submit" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="linecons-shop"></i>
                                <span>Generar Factura</span>
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
                                <th>Nro Factura</th>
                                <th>Fecha Factura</th>
                                <th>NIT</th>
                                <th>Razon Social</th>
                                <th>Total Factura</th>
                                <th>Descuento</th>
                                <th>Recargo</th>
                                <th>Estado</th>        
                                <th>Opciones</th> 
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                               <th>Nro Factura</th>
                                <th>Fecha Factura</th>
                                <th>NIT</th>
                                <th>Razon Social</th>
                                <th>Total Factura</th>
                                <th>Descuento</th>
                                <th>Recargo</th>
                                <th>Estado</th>        
                                <th>Opciones</th> 
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $result = $object->getList();
                            foreach ($result as  $register) {
                                ?>
                                <tr>
                                    <td><?php echo $register['numero_factura']; ?></td>
                                    <td><?php echo $register['fecha_factura']; ?></td>
                                    <td><?php echo $register['nit_cliente']; ?></td>
                                    <td><?php echo $register['razon_social']; ?></td>
                                     <td><?php echo $register['total']; ?></td>
                                      <td><?php echo $register['descuento']; ?></td>
                                       <td><?php echo $register['recargo']; ?></td>
                                        <td><?php echo $register['estado_factura']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_factura']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                   <!-- <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/billing/checkInvoices&action=edit_form&idObject=<?php echo $register['pk_id_factura']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>-->
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_factura']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-remove-circle"></span></a>
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
    $typeOperation = $typeOperation . " Dosificacion"
    ?>
    <!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa fa-cubes"></i> Facturas</h1>
            <p class="description">En este formulario usted podr&aacute; realizar <?php echo $describeTypeOperation; ?> de datos para dosificaiones.</p>
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
                    <strong>Facturar</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">                
                <div class="panel-heading">
                    <h3 class="panel-title">Formulario para datos de Factura</h3>                                       
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
                                <label for="fk_id_sucursal">Sucursal:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_sucursal" name="fk_id_sucursal" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_sucursal"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $sucursal = new Sucursal($registry[$dbSystem]);
                                        $listaSucursales = $sucursal->getList();
                                        foreach ($listaSucursales as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_sucursal"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["sucursal"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                                                 
                         <div class="form-group col-lg-6">
                                <label for="fecha_factura">Fecha Factura</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="fecha_factura" name="fecha_factura" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["fecha_factura"] . "\" " : NULL); ?>/>
                                </div>
                            </div>     
                        
                      
                        <div class="form-group col-lg-6">
                                <label for="nit">Nit</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="nit" name="nit" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["nit"] . "\" " : NULL); ?>/>
                                </div>
                            </div>   
                              <div class="form-group col-lg-6">
                                <label for="razon_social">Razon Social</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="razon_social" name="razon_social" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["razon_social"] . "\" " : NULL); ?>/>
                                </div>
                            </div>   
                              <div class="form-group col-lg-6">
                                <label for="descuento">Descuentos</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="descuento" name="descuento" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["descuento"] . "\" " : NULL); ?>/>
                                </div>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="fk_id_formato_dato_descuento">Formato:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_formato_dato_descuento" name="fk_id_formato_dato_descuento" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_formato_dato_descuento"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('formato_dato') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_formato_dato_descuento"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                              <div class="form-group col-lg-6">
                                <label for="recargo">Recargos</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="recargo" name="recargo" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["recargo"] . "\" " : NULL); ?>/>
                                </div>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="fk_id_formato_dato_recargo">Formato:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_formato_dato_recargo" name="fk_id_formato_dato_recargo" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_formato_dato_recargo"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('formato_dato') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_formato_dato_recargo"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="ice">Ice</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="ice" name="ice" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["ice"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                             <div class="form-group col-lg-6">
                                <label for="fk_id_formato_dato_recargo">Formato:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_formato_dato_recargo" name="fk_id_formato_dato_recargo" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_formato_dato_recargo"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('formato_dato') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_formato_dato_recargo"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="excentos">Excentos</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Campo obligatorio."></span>
                                    </span>                            
                                    <input id="excentos" name="excentos" maxlength="255" class="form-control" type="text" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> <?php echo($action == 'edit_form' || $action == 'view_form' ? " value=\"" . $objectEdit["excentos"] . "\" " : NULL); ?>/>
                                </div>
                            </div>
                             <div class="form-group col-lg-6">
                                <label for="fk_id_formato_dato_excentos">Formato:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_formato_dato_excentos" name="fk_id_formato_dato_excentos" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_formato_dato_excentos"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('formato_dato') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_formato_dato_excentos"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                              <div class="form-group col-lg-6">
                                <label for="fk_id_formato_dato_ice">Tipo Venta:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_formato_dato_ice" name="fk_id_formato_dato_ice" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_formato_dato_ice"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('opcion_tipo_venta') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_formato_dato_ice"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="fk_id_tipo_movimiento">Tipo Movimiento:</label>                                    
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span  class="fa fa-bars" data-toggle="tooltip" data-placement="top" title="Seleccione un valor de la lista."></span>                                        
                                    </span>
                                    <select id="fk_id_tipo_movimiento" name="fk_id_tipo_movimiento" class="form-control" <?php echo($action == 'view_form' ? 'disabled="disabled"' : NULL); ?> >                                            
                                        <option value="-1" <?php 
                                        if ( ($action == 'insert_form') || ($objectEdit["fk_id_tipo_movimiento"] == NULL) ) { 
                                            echo ' selected="selected" ';
                                        }
                                        ?> ></option>
                                        <?php
                                        $catalogo = new Catalogo($registry[$dbSystem]);
                                        $listCatalogo = $catalogo->getCatalogo('motivo_movimiento') ;
                                        foreach ($listCatalogo as $item) {
                                        ?>
                                        <option value="<?php echo $item["pk_id_catalogo"]; ?>" <?php 
                                            if ( ($action == 'edit_form' || $action == 'view_form') && ($objectEdit["fk_id_tipo_movimiento"] == $item["pk_id_catalogo"])  ) {
                                                echo ' selected="selected" ';
                                            }
                                        ?> ><?php echo $item["descripcion"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>                                     
                                </div>                            
                            </div> 
                           
                        
                             </br>
                        </div>  
                         <div class="row" id="invoice_detail"> 
                             <?php
                                                                     include_once 'invoice_detail.php';
                             ?>
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
