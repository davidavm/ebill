<?php
$objectDetail = new FacturaDetalle($registry[$dbSystem]);

$pk_id_factura = $action == 'edit_form' || $action == 'view_form' ? $objectEdit["pk_id_factura"] :0;

$list = $objectDetail->getListByInvoice($pk_id_factura);
?>
<div class="panel-body">
      <table id="agregar" class="table" cellspacing="0" width="100%">
                        <thead>
                             <tr>
                                 <th colspan="12" ><center>AGREGAR NUEVO ITEM</center></th>
                                
                               
                            </tr>
                            <tr>
                                <th>Buscar Item</th>
                                <th>Item</th>
                                <th>Unidad</th>
                                <th>P.U.</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Descuentos</th>
                                <th>Recargos</th>
                                <th>Ice</th>
                                <th>Exentos</th>        
                                <th>Sujeto a DF</th> 
                                <th>Agregar</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th> <input id="add_buscar_item" name="add_buscar_item" maxlength="255" class="form-control" type="text" /> </th>
                                <th><input id="add_item_detail" name="add_item_detail" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_unidad" name="add_unidad" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_pu" name="add_pu" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_cantidad" name="add_cantidad" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_total" name="add_total" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_descuentos" name="add_descuentos" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_recargo" name="add_recargo" maxlength="255" class="form-control" type="text" /></th>
                                <th><input id="add_ice" name="add_ice" maxlength="255" class="form-control" type="text" /></th>
                               <th><input id="add_excento" name="add_excento" maxlength="255" class="form-control" type="text" /></th>        
                               <th><input id="add_sujeto_df" name="add_sujeto_df" maxlength="255" class="form-control" type="text" /></th>   
                                <th>
                                    
                                     <button class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="linecons-shop"></i>
                                    <span>Agregar nuevo Item</span>
                                </button>
                                </th> 
                            </tr>
                        </tbody>
      </table>
</div>
 <div class="panel-body">                        

                    <table id="example" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Codigo </th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Detalle</th>
                                <th>P.U.</th>
                                <th>Total</th>
                                <th>Descuentos</th>
                                <th>Recargos</th>
                                <th>Ice</th>
                                <th>Exentos</th>        
                                <th>Sujeto a DF</th> 
                                <th>Opciones</th> 
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                 <th>Codigo </th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Detalle</th>
                                <th>P.U.</th>
                                <th>Total</th>
                                <th>Descuentos</th>
                                <th>Recargos</th>
                                <th>Ice</th>
                                <th>Exentos</th>        
                                <th>Sujeto a DF</th> 
                                <th>Opciones</th> 
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($list as  $register) {
                                ?>
                                <tr>
                                    <td><?php echo $register['codigo_item']; ?></td>
                                   <td><?php echo $register['cantidad']; ?></td>
                                    <td><?php echo $register['unidad']; ?></td>
                                    <td><?php echo $register['descripcion']; ?></td>
                                     <td><?php echo $register['precio_unitario']; ?></td>
                                      <td><?php echo $register['total']; ?></td>
                                        <td><?php echo $register['descuento']; ?></td>
                                       <td><?php echo $register['recargo']; ?></td>
                                        <td><?php echo $register['ice']; ?></td>
                                              <td><?php echo $register['excentos']; ?></td>
                                              <td><?php echo $register['sujeto_descuento_fiscal']; ?></td>
                                    <td style="width: 80px; text-align: center">
                                        <a href="index.php?page=<?php echo $route; ?>&action=view_form&idObject=<?php echo $register['pk_id_factura_detalle']; ?>" title="<?php echo $labelOptionList["view"]; ?>" class="view_icon"><span class="glyphicon glyphicon-search"></span></a>
                                        <a href="index.php?page=<?php echo $route; ?>&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/warehouse/checkgroups&action=edit_form&idObject=<?php echo $register['pk_id_factura_detalle']; ?>" title="<?php echo $labelOptionList["edit"]; ?>" class="edit_icon"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="index.php?page=<?php echo $routeFull; ?>&action=delete&idObject=<?php echo $register['pk_id_factura_detalle']; ?>" title="<?php echo $labelOptionList["delete"]; ?>" onclick="return confirmationDelete();" class="delete_icon"><span class="glyphicon glyphicon-trash"></span></a>
                                    </td>                        
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>