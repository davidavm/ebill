<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
?>   

<div class="page-title">
    <div class="title-env">
        <h1 class="title"><i class="fa fa-pencil-square-o"></i> Contacto para el soporte</h1>
        <p class="description">En esta p&aacute;gina se muestra los datos de contacto para el soporte en caso de tener dificultades con el sistema.</p>
    </div>

    <div class="breadcrumb-env">
        <ol class="breadcrumb bc-1">
            <li>
                <a href="index.php"><i class="fa-home"></i>Inicio</a>
            </li>
            <li class="active">
                Contacto soporte
            </li>
        </ol>
    </div>
</div>  
<!-- Contenido -->
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                Contacto del soporte de Sistema
            </div>

            <div class="panel-body">

                <p class="text-justify">
                <address>
                    <strong>EBIL, Copy Right.</strong><br/>
                    Zona San Idelfonso, Calle Corazon de Jesus S/N<br/>
                    Cochabamba, Bolivia<br/>
                    <abbr title="Phone">Telefonos:</abbr> (591)(4) 4393807 - (591) 70710033
                </address>

                <address>
                    <strong>Penta Group SRL</strong><br>
                    <a href="mailto:#">it@ebil.com</a>
                </address>
                </p>


                <br/>
                <p class="text-right">
                    <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                        <i class="fa fa-print"></i>
                        <span>Imprimir</span>
                    </a>
                </p>                 

            </div>
        </div>

    </div>
</div>
