<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
?>
<div class="grid_9">
    <h1 class="users">Sucursal</h1>
</div>
<div id="eventbox" class="grid_6">
    <a class="inline_tip" href="#">Aqui se puede realizar la configuraci&oacute;n de los datos de sucursal</a>
</div>
<div class="clear"> </div>
<div id="textcontent" class="grid_15">

    <div id="main_submenu">    
        <ul class="group" id="menu_group_main">
            <?php
            $object = new Menu($registry[$dbSystem]);
            $fatherMenu = $object->getMenuByRoute($route);
            if (count($fatherMenu) > 0) {

                $fatherMenuColumns = $fatherMenu[0];
                $listSubMenu = $object->getMenuByFatherPk($fatherMenuColumns["pk_id_menu"]);
                foreach ($listSubMenu as $indice => $register) {
                    ?>            
                    <li class="<?php echo $register["class_item"]; ?>">
                        <a href="<?php echo $register["href"]; ?>">
                            <span class="outer">
                                <span class=""><?php echo $register["title"]; ?></span>
                            </span>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>

    </div>

</div>    
