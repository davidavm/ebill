<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Persona($registry[$dbSystem]);
?>
<!-- Action insert, view or edit -->
<div class="page-title">
    <div class="title-env">
        <h1 class="title"><i class="fa-male"></i> Mi Perfil</h1>
        <p class="description">Esta p&aacute;na muestra los datos de la persona que esta usando el sistema.</p>
    </div>
    <div class="breadcrumb-env">
        <ol class="breadcrumb bc-1">
            <li>
                <a href="index.php"><i class="fa-home"></i>Inicio</a>
            </li>
            <li class="active">
                <strong>Mi perfil</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-success">                
            <div class="panel-heading">
                <h3 class="panel-title">Mi Perfil</h3>                                       
            </div>
            <div class="panel-body">

                <form name="formObject" id="formObject" role="form" action="#" >
                    <?php
                    $result = NULL;
                    $objectEdit = NULL;
                    $result = $object->getList($_GET["idObject"], ($_SESSION["authenticated_id_empresa"] == -1 ? Persona::ALL : $_SESSION["authenticated_id_empresa"]));
                    $objectEdit = $result[0];
                    ?>
                    <div class="row col-margin">
                        <div class="form-group col-lg-4">                            
                            <label for="nombres">Nombres:</label>                                
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["nombres"]; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="apellido_paterno">Primer apellido:</label> 
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["apellido_paterno"]; ?>
                                </span>                                                                
                            </div>
                        </div>    
                        <div class="form-group col-lg-4">
                            <label for="apellido_materno">Segundo apellido:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["apellido_materno"]; ?>
                                </span>                                                                
                            </div>
                        </div>  
                        <div class="form-group col-lg-4">
                            <label for="fk_tipo_documento_identidad">Tipo de documento identidad:</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php
                                    $tipo_documento_identidad = new Catalogo($registry[$dbSystem]);
                                    $result = $tipo_documento_identidad->getCatalogo('tipo_documento_identidad');
                                    foreach ($result as $indice => $register) {
                                        if ($objectEdit["fk_tipo_documento_identidad"] == $register["pk_id_catalogo"]) {
                                            echo $register["descripcion"];
                                            break;
                                        }
                                    }
                                    ?>
                                </span>                                   
                            </div>                            
                        </div>                               
                        <div class="form-group col-lg-4">
                            <label for="numero_identidad">Numero de identidad:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["numero_identidad"]; ?>
                                </span>                                                                
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="fk_departamento_expedicion_doc">Departamento de expedici&oacute;n de documento:</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php
                                    $departamento = new Catalogo($registry[$dbSystem]);
                                    $result = $departamento->getCatalogo('departamento');
                                    foreach ($result as $indice => $register) {
                                        if ($objectEdit["fk_departamento_expedicion_doc"] == $register["pk_id_catalogo"]) {
                                            echo $register["descripcion"];
                                            break;
                                        }
                                    }
                                    ?>
                                </span>                                    
                            </div>                            
                        </div>                               
                        <div class="form-group col-lg-12">
                            <label for="direccion">Direcci&oacute;n o ubicaci&oacute;n del domicilio:</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["direccion"]; ?>
                                </span>
                            </div>                            
                        </div>     
                        <div class="form-group col-lg-4">
                            <label for="telefono1">Tel&eacute;fonos/Celulares:</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["telefono1"]; ?>
                                </span>                                    
                            </div>                            
                        </div>  
                        <div class="form-group col-lg-4">
                            <label for="telefono2">&nbsp;</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["telefono2"]; ?>
                                </span>                                    
                            </div>                            
                        </div> 
                        <div class="form-group col-lg-4">
                            <label for="telefono3">&nbsp;</label>                                    
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <?php echo $objectEdit["telefono3"]; ?>
                                </span>
                            </div>                            
                        </div>
                        </br>
                    </div>                            
                    <div class="row">
                        <div class="col-md-12">                                       
                            <p class="text-right">
                                <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                    <i class="fa fa-print"></i>
                                    <span>Imprimir</span>
                                </a>
                            </p>  
                        </div>		
                    </div>                            

                </form>                 

            </div>
        </div>
    </div>
</div>


