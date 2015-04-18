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
        
        <title><?php echo $headWebPageProperty["titleSystemWebPage"]; ?> - Ingreso al Sistema</title>
        <link href="<?php echo IMG_RELATIVE_PATH . "ebil/logo_ebil.ico" ?>" rel="shortcut icon" type="image/ico">
        <link href="<?php echo CSS_RELATIVE_PATH . "fonts/linecons/css/linecons.css"; ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo CSS_RELATIVE_PATH . "fonts/fontawesome/css/font-awesome.min.css"; ?>" rel="stylesheet" type="text/css" media="all" />
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
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "toastr/toastr.min.js"; ?>"></script>
        <script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo JS_RELATIVE_PATH . "validate/jquery.validate.min.js"; ?>"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
        
        <script type="text/javascript" language="javascript" charset="utf-8">
            jQuery(document).ready(function($)
            {
                // Reveal Login form
                setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
                
                // Validation and Ajax action
                $("form#login").validate({
                            rules: {
                                    user: {
                                                required: true
                                    },								
                                    password: {
                                                required: true
                                    }
                            },							
                            messages: {
                                    user: {
                                            required: 'Por favor ingrese su nombre de Usuario.'
                                    },								
                                    password: {
                                            required: 'Por favor ingrese su Contraseña.'
                                    }
                            }							
                });
            });

            // Set Form focus
            $("form#login .form-group:has(.form-control):first .form-control").focus();

        </script>
    </head>
    <body class="page-body login-page login-light" style="padding-top: 100px">
        <div class="login-container">	
                <?php
                if (file_exists($path_business_view)){
                    include( $path_business_view );
                }
                else{
                    echo '<p class="error">' . $errorWebPageProperty["loadPageModel"] . ' <b>' . $page . '</b>. ' . $errorWebPageProperty["pathPageModel"] . '<b> ' . $path_business_view . '</b> </p>';
                }
                ?>                                                            
        </div>
    </body>
</html>