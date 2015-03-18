<?php
$property = $registry["properties"];
$headWebPageProperty = $property["general"]["head"];
$footWebPageProperty = $property["general"]["foot"];
$errorWebPageProperty = $property["general"]["error"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $headWebPageProperty["titleSystemWebPage"]; ?>" />
	<meta name="author" content="<?php echo $headWebPageProperty["author"]; ?>" />
        
        <title><?php echo $headWebPageProperty["titleSystemWebPage"]; ?></title>
                        
        <link href="<?php echo CSS_RELATIVE_PATH . "bootstrap/fonts/linecons/css/linecons.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "bootstrap/fonts/fontawesome/css/font-awesome.min.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "bootstrap/bootstrap.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "ebil/ebil-core.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "ebil/ebil-forms.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "ebil/ebil-components.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "ebil/ebil-skin.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "jquery/jquery.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "bootstrap/bootstrap.min.js"; ?>"></script>
	<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/TweenMax.min.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/resizeable.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/joinable.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/ebil-api.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/ebil-toggles.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "ebil/ebil-custom.js"; ?>"></script>        
        
        <?php
        // Para incluir librerias CSS y Javascript desde archivo.
        $commonDirectoryJsCss = "si/lib/fjscss/";
        $pathDirectoryJsCssCommon = "";
        $pathDirectoryJsCssLocal = "";
        $routeArrayFileJsCssCommon = "";
        $routeArrayFileJsCssLocal = "";
        // Put this values on URL
        $getArrayCommonFileJsCss = array("common" => "cf_jscss", "local" => "lf_jscss");
        // Common file JS or CSS -> cf_jscss        
        if (isset($_GET[$getArrayCommonFileJsCss["common"]])) {
            $pathDirectoryJsCssCommon = $commonDirectoryJsCss;
            $routeArrayFileJsCssCommon = $_GET[$getArrayCommonFileJsCss["common"]];
        }
        // Local file JS or CSS -> lf_jscss
        if (isset($_GET[$getArrayCommonFileJsCss["local"]])) {
            $pathDirectoryJsCssLocal = "";
            $routeArrayFileJsCssLocal = $_GET[$getArrayCommonFileJsCss["local"]];
        }
        if ( ($routeArrayFileJsCssCommon != "") || ($routeArrayFileJsCssLocal != "") ) {
            if($routeArrayFileJsCssCommon != ""){
                foreach ($routeArrayFileJsCssCommon as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssCommon . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }
            }
            if($routeArrayFileJsCssLocal != ""){
                foreach ($routeArrayFileJsCssLocal as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssLocal . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }    
            } 
        }
        ?>
             
        <?php
        // para incluir CSS en linea
        $commonDirectoryJsCss = "si/lib/icss/";
        $pathDirectoryJsCssCommon = "";
        $pathDirectoryJsCssLocal = "";
        $routeArrayFileJsCssCommon = "";
        $routeArrayFileJsCssLocal = "";
        // Put this values on URL
        $getArrayCommonFileJsCss = array("common" => "ci_css", "local" => "li_css");
        // Common inline CSS -> ci_css
        if (isset($_GET[$getArrayCommonFileJsCss["common"]])) {
            $pathDirectoryJsCssCommon = $commonDirectoryJsCss;
            $routeArrayFileJsCssCommon = $_GET[$getArrayCommonFileJsCss["common"]];
        }
        // Local inline CSS -> li_css
        if (isset($_GET[$getArrayCommonFileJsCss["local"]])) {
            $pathDirectoryJsCssLocal = "";
            $routeArrayFileJsCssLocal = $_GET[$getArrayCommonFileJsCss["local"]];
        }
        if (($routeArrayFileJsCssCommon != "") || ($routeArrayFileJsCssLocal != "")) {
            echo '<style type="text/css">';
            echo '@import url("'.CSS_RELATIVE_PATH . "datatable/dataTables.bootstrap.css".'")';
            if($routeArrayFileJsCssCommon != ""){
                foreach ($routeArrayFileJsCssCommon as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssCommon . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }
            }
            if($routeArrayFileJsCssLocal != ""){
                foreach ($routeArrayFileJsCssLocal as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssLocal . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }    
            } 
            echo '</style>';
        }
        ?>      
                        
        <?php        
        // Para incluir javascrip en linea
        $commonDirectoryJsCss = "si/lib/ijs/";
        $pathDirectoryJsCssCommon = "";
        $pathDirectoryJsCssLocal = "";
        $routeArrayFileJsCssCommon = "";
        $routeArrayFileJsCssLocal = "";
        $getArrayCommonFileJsCss = array("common" => "ci_js", "local" => "li_js");
        // Common inline JS -> ci_js
        if (isset($_GET[$getArrayCommonFileJsCss["common"]])) {
            $pathDirectoryJsCssCommon = $commonDirectoryJsCss;
            $routeArrayFileJsCssCommon = $_GET[$getArrayCommonFileJsCss["common"]];
        }
        // Local inline JS -> li_js
        if (isset($_GET[$getArrayCommonFileJsCss["local"]])) {
            $pathDirectoryJsCssLocal = "";
            $routeArrayFileJsCssLocal = $_GET[$getArrayCommonFileJsCss["local"]];
        }
        if ( ($routeArrayFileJsCssCommon != "") || ($routeArrayFileJsCssLocal != "") ) {
            echo '<script type="text/javascript" language="javascript" charset="utf-8">';
            if($routeArrayFileJsCssCommon != ""){
                foreach ($routeArrayFileJsCssCommon as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssCommon . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }
            }
            if($routeArrayFileJsCssLocal != ""){
                foreach ($routeArrayFileJsCssLocal as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssLocal . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }    
            }            
            echo '</script>';
        }
        ?>

        <?php
        // Para incluir jquery en linea
        $commonDirectoryJsCss = "si/lib/ijq/";
        $pathDirectoryJsCssCommon = "";
        $pathDirectoryJsCssLocal = "";
        $routeArrayFileJsCssCommon = "";
        $routeArrayFileJsCssLocal = "";
        $getArrayCommonFileJsCss = array("common" => "ci_jq", "local" => "li_jq");
        // Common inline Jquery -> ci_jq
        if (isset($_GET[$getArrayCommonFileJsCss["common"]])) {
            $pathDirectoryJsCssCommon = $commonDirectoryJsCss;
            $routeArrayFileJsCssCommon = $_GET[$getArrayCommonFileJsCss["common"]];
        }
        // Local inline Jquery -> li_jq
        if (isset($_GET[$getArrayCommonFileJsCss["local"]])) {
            $pathDirectoryJsCssLocal = "";
            $routeArrayFileJsCssLocal = $_GET[$getArrayCommonFileJsCss["local"]];
        }
        if ( ($routeArrayFileJsCssCommon != "") || ($routeArrayFileJsCssLocal != "") ) {
            echo '<script type="text/javascript" language="javascript" charset="utf-8">';
            echo '$(document).ready(function() {';
            if($routeArrayFileJsCssCommon != ""){
                foreach ($routeArrayFileJsCssCommon as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssCommon . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }
                }
            if($routeArrayFileJsCssLocal != ""){
                foreach ($routeArrayFileJsCssLocal as $libraryJsCss) {                
                    $pathDirectoryJsCssInclude = VIEW_PATH . $pathDirectoryJsCssLocal . $libraryJsCss . '.php';                
                    if (file_exists($pathDirectoryJsCssInclude)) {
                        include( $pathDirectoryJsCssInclude );
                    }
                }    
            }
            echo '} );';
            echo '</script>';
        }
        ?>
    </head>
    <body class="page-body horizontal-menu-skin-ebil">
        
    <!-- START Panel Superior -->
        <div class="settings-pane">

            <a href="#" data-toggle="settings-pane" data-animate="true">
                &times;
            </a>

            <div class="settings-pane-inner">

                <div class="row">

                    <div class="col-md-4">

                        <div class="user-info">

                            <div class="user-image">
                                <a href="extra-profile.html">
                                    <img src="<?php echo IMG_RELATIVE_PATH . "ebil/user-2.png"; ?>" class="img-responsive img-circle" />
                                </a>
                            </div>

                            <div class="user-details">
                                <h3>
                                    <a href="extra-profile.html">Juan Peres</a>
                                    <span class="user-status is-online"></span>
                                </h3>

                                <p class="user-title">Administrador</p>

                                <div class="user-links">
                                    <a href="#" class="btn btn-primary">Información</a>
                                    <a href="#" class="btn btn-warning">Editar Perfil</a>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-8 link-blocks-env">

                        <div class="links-block left-sep">
                            <h4>
                                <span>Notificaciones</span>
                            </h4>

                            <ul class="list-unstyled">
                                <li>
                                    <input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk1" />
                                    <label for="sp-chk1">Mensajes</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk2" />
                                    <label for="sp-chk2">Eventos</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk3" />
                                    <label for="sp-chk3">Actualizaciones</label>
                                </li>
                                <li>
                                    <input type="checkbox" class="cbr cbr-primary" checked="checked" id="sp-chk4" />
                                    <label for="sp-chk4">Servidor</label>
                                </li>
                            </ul>
                        </div>

                        <div class="links-block left-sep">
                            <h4>
                                <a href="#">
                                    <span>Ayuda</span>
                                </a>
                            </h4>

                            <ul class="list-unstyled">
                                <li>
                                    <a href="#">
                                        <i class="fa-angle-right"></i>
                                        Centro de soporte
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-angle-right"></i>
                                        Protocolo
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-angle-right"></i>
                                        Acerca del dominio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa-angle-right"></i>
                                        Terminos de servicio
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- END Panel Superior -->
        
        <!-- START Barra Principal -->
        <nav class="navbar horizontal-menu navbar-fixed-top">

            <div class="navbar-inner">

                <!-- Navbar Brand -->
                <div class="navbar-brand">
                    <a href="dashboard-1.html" class="logo">
                        <img src="<?php echo IMG_RELATIVE_PATH . "ebil/logo_ebil.png"; ?>" width="100" alt="" class="hidden-xs" />
                        <img src="<?php echo IMG_RELATIVE_PATH . "ebil/logo-collapsed@2x.png"; ?>" width="45" alt="" class="visible-xs" />
                    </a>
                    <a href="#" data-toggle="settings-pane" data-animate="true">
                        <i class="linecons-cog"></i>
                    </a>
                </div>

                <div class="nav navbar-mobile">


                    <div class="mobile-menu-toggle">

                        <a href="#" data-toggle="settings-pane" data-animate="true">
                            <i class="linecons-cog"></i>
                        </a>

                        <a href="#" data-toggle="mobile-menu-horizontal">
                            <i class="fa-bars"></i>
                        </a>
                    </div>

                </div>

                <div class="navbar-mobile-clear"></div>  

                <!-- START Menu -->
                        <?php
                        $menuFile = "menu";
                        $pathMenuFile = VIEW_PATH . $menuFile . ".php";
                        if (file_exists($pathMenuFile)) {
                            include( $pathMenuFile );
                        } else {
                            echo $errorWebPageProperty["loadPageModel"] . ' <b>' . $menuFile . '</b>. ' . $errorWebPageProperty["pathPageModel"] . '<b> ' . $pathMenuFile . '</b>';
                        }
                        ?>
                <!-- END Menu -->
                
                <!-- notifications and other links -->
                <ul class="nav nav-userinfo navbar-right">

                    <li class="dropdown user-profile">
                        <a href="#" data-toggle="dropdown">
                            <img src="<?php echo IMG_RELATIVE_PATH . "ebil/user-1.png"; ?>" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                            <span>
                                Juan Peres
                                <i class="fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="dropdown-menu user-profile-menu list-unstyled">
                            <li>
                                <a href="#settings">
                                    <i class="fa-wrench"></i>
                                    Configuraciones
                                </a>
                            </li>
                            <li>
                                <a href="#profile">
                                    <i class="fa-user"></i>
                                    Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a href="#help">
                                    <i class="fa-info"></i>
                                    Ayuda
                                </a>
                            </li>
                            <li class="last">
                                <a href="index.php?page=exit&menu=exit">
                                    <i class="fa-lock"></i>
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </nav>                        
        <!-- END Barra Principal -->
        
        <!-- START Miga de pan -->        
                        <?php
                        /*
                        $breadcumbsFile = 'breadcumbs';
                        $pathBreadcumbsFile = VIEW_PATH . $breadcumbsFile . ".php";
                        if (file_exists($pathBreadcumbsFile)) {
                            include( $pathBreadcumbsFile );
                        } else {
                            echo $errorWebPageProperty["loadPageModel"] . ' <b>' . $breadcumbsFile . '</b>. ' . $errorWebPageProperty["pathPageModel"] . '<b> ' . $pathBreadcumbsFile . '</b>';
                        }                        
                         */
                        ?>
        <!-- END Miga de pan --> 
	<div class="page-container">
            <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->			
            
            <div class="main-content">      
                <!-- START Contenido -->
                <?php
                if (file_exists($path_business_view)) {
                    include( $path_business_view );
                } else { // En caso de error al incluir
                    ?>
                    <div class="grid_9">
                        <h1 class="alert">Error!!!!</h1>
                    </div>
                    <div id="eventbox" class="grid_6">
                        <a class="inline_tip" href="#">A continuaci&oacute;n se muestra el detalle del error.</a>
                    </div>
                    <div class="clear"> </div>
                    <div id="textcontent" class="grid_15">
                        <p class="info" id="error">
                            <span class="info_inner">
                                Error en la carga de la p&aacute;gina: <?php echo ": " . $page . "."; ?>
                            </span>
                        </p>
                        <?php
                        echo $errorWebPageProperty["loadPageModel"] . ' ' . $page . '.<br/> ' . $errorWebPageProperty["pathPageModel"] . ' ' . $path_business_view . '.';
                        ?>
                    </div>
                    <?php
                }
                ?>                   
                <!-- END Contenido -->
                
                <!-- START Pie -->
                <footer class="main-footer sticky footer-type-1">

                    <div class="footer-inner">
                        <!-- Add your copyright text here -->
                        <div class="footer-text">
                            <?php echo $footWebPageProperty["footLicenceSystem"]; ?>                     
                        </div>

                        <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                        <div class="go-up">
                            <a href="#" rel="go-top">
                                <i class="fa-angle-up"></i>
                            </a>
                        </div>
                    </div>
                </footer>        
                <!-- END Pie -->
            </div>            
        </div>
    </body>
</html>