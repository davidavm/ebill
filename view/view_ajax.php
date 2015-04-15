<?php
$_SESSION["active_option_menu"] = "/";
?>
<?php
                if (file_exists($path_business_view)){
                    include( $path_business_view );
                }
                else{
                    echo '<p class="error">' . $errorWebPageProperty["loadPageModel"] . ' <b>' . $page . '</b>. ' . $errorWebPageProperty["pathPageModel"] . '<b> ' . $path_business_view . '</b> </p>';
                }
                ?> 