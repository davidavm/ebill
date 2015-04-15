    <?php
    /*
    $object = new Menu($registry[$dbSystem]);

    $principalMenu = $object->getMenubyType('principal');

    if (isset($_SESSION["menu_active"])) {
        $optionMenuGET = isset($_GET["menu"]) ? $_GET["menu"] : "";
        $optionMenu = isset($_GET["menu"]) ? $_GET["menu"] : $_SESSION["menu_active"];
        foreach ($principalMenu as $value) {
            $menuActiveValueClass = "main";
            $detailMenuOptions = $value;
            if ($optionMenuGET == $detailMenuOptions["title"]) { //home primera vez 
                $_SESSION["active_option_menu"] = $detailMenuOptions["route"];
            }
            if ($optionMenu == $detailMenuOptions["title"]) { //home por la sesion
                $_SESSION["menu_active"] = $detailMenuOptions["title"];
                $menuActiveValueClass = "main current";
            }
            ?>
            <li class="<?php echo $detailMenuOptions["class_item"]; ?>" id="<?php echo $detailMenuOptions["pk_id_menu"]; ?>">
                <a href="<?php echo $detailMenuOptions["href"]; ?>" class="<?php echo $menuActiveValueClass; ?>">
                    <span class="outer">
                        <span class="<?php echo $detailMenuOptions["class_image"]; ?>"><?php echo $detailMenuOptions["title"]; ?></span>
                    </span>
                </a>
            </li>
            <?php
        }
    }
    */
    ?>              
<ul class="navbar-nav">
    <li>
        <a href="">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/codigo_barras.png"; ?>">
            <span class="title">Facturaci&oacute;n</span>
        </a>
        <ul>
            <li>
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Configuraci&oacute;n de Factura</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Mi Empresa</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="#">
                            <span class="title">Datos de Factura</span>
                        </a>
                    </li>
                      <li>
                       <a href="index.php?page=/si/billing/economic_activities&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Actividades Economicas</span>
                        </a>
                    </li> 
                    <li>
                       <a href="index.php?page=/si/billing/branchs&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Sucursales</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="#">
                            <span class="title">Formato de Factura</span>
                        </a>
                    </li>
                    
                    <li>
                       <a href="index.php?page=/si/billing/dosifications&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Dosificaci&oacute;n</span>
                        </a>
                    </li>
                    <!--
                    <li>
                       <a href="#">
                            <span class="title">Campos de Factura</span>
                        </a>
                    </li>
                    -->
                    <li>
                       <a href="#">
                            <span class="title">Certificacion del Sistema</span>
                        </a>
                    </li>                    
                    
                </ul>
            </li>            
            <li>
                <a href="index.php?page=/si/billing/invoices&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <i class="linecons-money"></i>
                    <span class="title">Facturar</span>
                </a>
            </li>
            
        </ul>
    </li>
    
    <li>
        <a href="#">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/usuarios.png"; ?>">
            <span class="title">Clientes</span>
        </a>
        <ul>
            <li>
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Configuraci&oacute;n de Cliente</span>
                </a>
                <ul>                  
                    <!--
                    <li>
                        <a href="#">
                            <span class="title">Campos de Cliente</span>
                        </a>
                    </li>
                    -->
                    <li>
                        <a href="index.php?page=/si/clients/category&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Categoria de Cliente</span>
                        </a>
                    </li>                      
                    <li>
                        <a href="index.php?page=/si/clients/entry&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Rubro</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=/si/clients/seller&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Vendedor</span>
                        </a>
                    </li>                     
                </ul>
            </li>                           
            <li>
                <a href="index.php?page=/si/clients/client&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <i class="linecons-wallet"></i>
                    <span class="title">Manejar Clientes</span>
                </a>
            </li>
            <li>
                <a href="index.php?page=/si/clients/import_clients&cf_jscss[0]=plupload&ci_jq[0]=plupload&ci_js[0]=messages">
                    <i class="linecons-database"></i>
                    <span class="title">Importar datos  de Clientes</span>
                </a>
            </li>            
        </ul>
    </li>
    
    <li>
        <a href="ui-panels.html">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/fork4.png"; ?>">
            <span class="title">Almacenes</span>
        </a>
        <ul>
            <li>
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Configuraci&oacute;n de Almacenes</span>
                </a>
                <ul>
                    <!--
                    <li>
                        <a href="#">
                            <span class="title">Campos de Item</span>
                        </a>
                    </li>
                    -->
                    <li>
                        <a href="index.php?page=/si/warehouse/measurement&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Unidad de Medida</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=/si/warehouse/groups&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                              <span class="title">Grupos</span>
                        </a>
                    </li>

                    <li>
                          <a href="index.php?page=/si/warehouse/warehouse&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                            <span class="title">Almacenes</span>
                        </a>
                    </li>                    
                </ul>
            </li>                
            
            <li>
                <a href="#">
                    <i class="linecons-t-shirt"></i>
                    <span class="title">Manejo de items</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="linecons-database"></i>
                    <span class="title">Importar Datos de Items</span>
                </a>
            </li>
            
        </ul>
    </li>
    
    <li>
        <a href="forms-native.html">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/cart.png"; ?>">
            <span class="title">Compras</span>
        </a>
        <ul>
            
            <li>
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Configuraci&oacute;n de Compras</span>
                </a>
                <ul>                              
                    <li>
                        <a href="#">
                            <span class="title">Centros de Costo</span>
                        </a>
                    </li>                  
                </ul>
            </li>  
            
            <li>
                <a href="#">
                    <i class="linecons-money"></i>
                    <span class="title">Compras</span>
                </a>
            </li>

        </ul>
    </li>
    
    <li>
        <a href="forms-native.html">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/admin.png"; ?>">
            <span class="title">Proveedores</span>
        </a>
        <ul>
            <!--
            <li>
                <a href="#">
                    <i class="linecons-cog"></i>
                    <span class="title">Configuraci&oacute;n de Proveedor</span>
                </a>
                <ul>                              
                    <li>
                        <a href="#">                            
                            <span class="title">Campos de Proveedor</span>
                        </a>
                    </li>              
                </ul>
            </li>              
            -->
            <li>
                <a href="#">
                    <i class="linecons-tag"></i>
                    <span class="title">Manejar Proveedores</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="linecons-database"></i>
                    <span class="title">Importar Datos de Proveedores</span>
                </a>
            </li>            
        </ul>
    </li>
    
    <li>
        <a href="">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/bank.png"; ?>">
            <span class="title">Bancarizaci&oacute;n</span>
        </a>
        <ul>
            <li>
                <a href="ui-widgets.html">
                    <i class="linecons-diamond"></i>
                    <span class="title">Realizar Bancarizaci&oacute;n</span>
                </a>
            </li>            
        </ul>
    </li>

    <li>
        <a href="index.php?page=/si/security/users&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/provider.png"; ?>">
            <span class="title">Seguridad</span>
        </a>
        <ul>
            <li>
                <a href="index.php?page=/si/security/business&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <i class="linecons-shop"></i>
                    <span class="title">Manejo de empresas</span>
                </a>
            </li>

            <li>
                <a href="index.php?page=/si/security/people&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <i class="linecons-thumbs-up"></i>
                    <span class="title">Manejo de personas</span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=/si/security/users&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <i class="linecons-user"></i>
                    <span class="title">Manejo de usuarios</span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=/si/security/changepwd&ci_js[0]=aditionalvalidation&cf_jscss[0]=jqvalidation&li_jq[0]=/si/security/checkchangepwd">
                    <i class="linecons-key"></i>
                    <span class="title">Cambiar mi contrase&nacute;a</span>
                </a>
            </li>            

        </ul>
    </li>

    <li>
        <a href="forms-native.html">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/edit.png"; ?>">
            <span class="title">Reportes</span>
        </a>
        <ul>
            <li>
                <a href="#">
                    <i class="linecons-doc"></i>
                    <span class="title">Reportes</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Libro de compras y ventas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Ventas mensuales</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Almacenes</span>
                        </a>
                    </li>                    
                </ul>                
            </li>
            <li>
                <a href="#">
                    <i class="linecons-fire"></i>
                    <span class="title">Reportes r&aacute;pidos</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Ventas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Almacenes</span>
                        </a>
                    </li>                 
                </ul>                 
            </li>            

        </ul>
    </li>

</ul>
