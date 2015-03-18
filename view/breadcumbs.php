<?php
$routeBreads = array();
$breadToshow = array();

$object = new Menu($registry[$dbSystem]);

// $menuRoute = 
$optionSubmenuGET = isset($_GET["page"]) ? $_GET["page"] : "";
$routeBread = $object->getMenuByRoute($optionSubmenuGET);

if (count($routeBread) > 0) {

    $routeBreads[] = $routeBread[0];

    while (count($routeBread) > 0 && $routeBread[0]['fk_id_menu_father'] != null) {
        $routeBread = $object->getMenuByPk($routeBread[0]['fk_id_menu_father']);
        if (count($routeBread) > 0) {
            $routeBreads[] = $routeBread[0];
        }
    }
}

$breadsToShow = array();
if (isset($_SESSION["menu_active"])) {
    foreach (array_reverse($routeBreads) as $item) {
        if ($item['show_bread'] == 1)
            $breadsToShow[] = $item;
    }
}

if (count($breadsToShow) > 0) {
    ?>
    <ul>   
        <?php
        foreach ($breadsToShow as $item) {
            ?>
            <li><a href="<?php echo $item["href"]; ?>" <?php echo $item['class_item']; ?> >
                    <span><?php echo $item['title']; ?></span>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>   
    <?php
}
?>