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
                    <span class="title">Configuracion Factura</span>
                    <span class="label label-info pull-right">3</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Datos Factura</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Manejo Sucursales</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="#">
                            <span class="title">Formato factura</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <span class="title">Manejo Dosificaci&oacute;n</span>
                        </a>
                    </li>

                </ul>
            </li>
            
            <li>
                <a href="#">
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
                    <span class="title">Lista</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <span class="title">Grupos</span>
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
                  <a href="index.php?page=/si/warehouse/groups&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <span class="title">Manejo de grupos</span>
                </a>
            </li>
            
            <li>
                  <a href="index.php?page=/si/warehouse/warehouse&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <span class="title">Manejo de almacenes</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <span class="title">Configurar campos de item</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <span class="title">Manejo de items</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="title">Importar datos  de items</span>
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
                    <i class="linecons-cloud"></i>
                    <span class="title">Menu Levels</span>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <i class="entypo-flow-line"></i>
                            <span class="title">Menu Level 1.1</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Menu Level 2.1</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#">
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Menu Level 2.2</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="entypo-flow-cascade"></i>
                                            <span class="title">Menu Level 3.1</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="#">
                                            <i class="entypo-flow-cascade"></i>
                                            <span class="title">Menu Level 3.2</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="entypo-flow-branch"></i>
                                                    <span class="title">Menu Level 4.1</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                    
                            <li>
                                <a href="#">
                                    <i class="entypo-flow-parallel"></i>
                                    <span class="title">Menu Level 2.3</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="entypo-flow-line"></i>
                            <span class="title">Menu Level 1.2</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="entypo-flow-line"></i>
                            <span class="title">Menu Level 1.3</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            
            <li>
                <a href="#">
                    <span class="title">Lista</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="title">Stock</span>
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
            <li>
                <a href="#">
                    <span class="title">Lista de proveedores</span>
                </a>
            </li>
        </ul>
    </li>
    
    <li>
        <a href="">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/bank.png"; ?>">
            <span class="title">Bancarización</span>
        </a>
        <ul>
            <li>
                <a href="ui-widgets.html">
                    <i class="linecons-star"></i>
                    <span class="title">Menu nivel 1</span>
                </a>
            </li>
            
            <li>
                <a href="mailbox-main.html">
                    <i class="linecons-mail"></i>
                    <span class="title">Menu nivel 1</span>
                    <span class="label label-success pull-right">3</span>
                </a>
                <ul>
                    <li>
                        <a href="mailbox-main.html">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailbox-compose.html">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailbox-message.html">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="extra-gallery.html">
                    <i class="linecons-beaker"></i>
                    <span class="title">Menu Multinivel</span>

                </a>
                <ul>
                    <li>
                        <a href="#">
                            <span class="title">Menu Nivel 2</span>
                            <span class="label label-warning pull-right">4</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Menu Nivel 3</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="title">Menu Nivel 2</span>
                        </a>
                    </li>
                </ul>
            </li>



        </ul>
    </li>

    <li>
        <a href="forms-native.html">
            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/iconos/provider.png"; ?>">
            <span class="title">Seguridad</span>
        </a>
        <ul>
            <li>
                <a href="index.php?page=/si/security/business&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages">
                    <span class="title">Manejo de empresas</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <span class="title">Manejo de usuarios</span>
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
                    <span class="title">Reporte por fechas</span>
                </a>
            </li>

        </ul>
    </li>

</ul>