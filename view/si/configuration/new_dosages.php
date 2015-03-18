<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
?>
<div class="grid_9">
    <h1 class="users">Nuevas dosificaciones</h1>
</div>
<div id="eventbox" class="grid_6">
    <a class="inline_tip" href="#">Aqui se puede realizar el llenado de los datos de nuevas dosificacion.</a>
</div>
<div class="clear"> </div>
<div id="textcontent" class="grid_15">
Aqui el contenido.
</div>    