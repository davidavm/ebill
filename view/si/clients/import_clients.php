<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=plupload&ci_jq[0]=plupload&ci_js[0]=messages";

// Prepare Object 
$object = new Archivo($registry[$dbSystem]);
$objFileCliente = new Cliente($registry[$dbSystem]);
$objImportacion = new ImportacionDatos($registry[$dbSystem]);
// Prepare Transacction
$transaction = new Transaccion($registry[$dbSystem]);

 //manejo de session para el nombre del directorio temporal
if (isset($_SESSION["fileupload_dirname"])) 
 {
    $tmpDirName = $_SESSION["fileupload_dirname"];
 }
   
        
 
// Data Action insert/delete/edit/view/insert_form/edit_form Capture, by default action is list
$action = 'formulario';
if (isset($_POST["action"])) {
    $action = $_POST["action"];
} else if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

// If action is insert
if ($action == 'subir') {
   
   try {


        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings  c:\wamp\tmp\plupload
        //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        
        $targetDir = "view/si/upload/import/clients/".$_SESSION["authenticated_id_empresa"].'/'.$tmpDirName;
        //$targetDir = "view/si/upload/import/clients/".$_SESSION["authenticated_id_empresa"];
                
//$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        
                                
                                

        // Create target dir
        if (!file_exists($targetDir)) {
                @mkdir($targetDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
                $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
                $fileName = $_FILES["file"]["name"];
        } else {
                $fileName = uniqid("file_");
        }

        //$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $filePath = $targetDir . '/' . $fileName;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


        // Remove old temp files	
        if ($cleanupTargetDir) {
                if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "No se pudo abrir el directorio temporal."}, "id" : "id"}');
                }
                
              
                while (($file = readdir($dir)) !== false) {
                     if($file!='.')
                        if($file!='..')
                        {
                        $tmpfilePath = $targetDir . '/' . $file;

                        
                               $texto ="file = ".$file.' tmpdir '.$tmpfilePath;
                                $file_read = fopen("files.log", "a");
                                fwrite($file_read, $texto . PHP_EOL);                            
                                fclose($file_read);  
                                
                                
                        // If temp file is current file proceed to the next
                        if ($tmpfilePath == "{$filePath}.part") {
                                continue;
                        }

                        // Remove temp file if it is older than the max age and is not the current file
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                                @unlink($tmpfilePath);
                        }
                    
                    // registro de los archivos en la base
                    if($file!='.')
                        if($file!='..')
                        {
                            $fileType = pathinfo($tmpfilePath,PATHINFO_EXTENSION);
                            $data = array($file,
                                            $fileType,
                                            filesize($tmpfilePath),
                                            mime_content_type( $tmpfilePath ),
                                            pathinfo($tmpfilePath,PATHINFO_DIRNAME),
                                            pathinfo($tmpfilePath,PATHINFO_BASENAME),
                                            456,// tipo texto
                                            $_SESSION["authenticated_id_user"], 
                                            $idTransaccion, 
                                            $idTransaccion, 
                                            ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])                        
                                              );
                    
                            $res_upload_file = $object->insert($data);
                            
                            if($res_upload_file<0)
                            {
                                $texto ="error en el registro del log id = ".$res_upload_file;
                                $file = fopen("clientes.log", "a");
                                fwrite($file, $texto . PHP_EOL);                            
                                fclose($file);  
                            } 
                        }
                  
                }
                   } 
                closedir($dir);
                 
                 
        }	


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "No se pudo abrir la secuencia de salida."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
                if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Error al mover el archivo subido."}, "id" : "id"}');
                }

                // Read binary input stream and append it to temp file
                if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "No se pudo abrir la secuencia de entrada."}, "id" : "id"}');
                }
        } else {	
                if (!$in = @fopen("php://input", "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "No se pudo abrir la secuencia de entrada."}, "id" : "id"}');
                }
        }

        while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
                // Strip the temp .part suffix off 
                rename("{$filePath}.part", $filePath);
                
                //#########################################################################               
                    $separador="|";
                    $filename=$filePath;
                    $handle = fopen($filename, "r");

                           
                    if ($handle) {
                        $cont = 1;
                        $insertados = 0;
                        $erroneos=0;
                        while (($line = fgets($handle)) !== false) 
                            {
                                     if($cont!=1)
                                     {
                                       $data = explode($separador,$line);	 
                                       array_push($data,
                                                  $_SESSION["authenticated_id_user"], 
                                                  $idTransaccion, 
                                                  $idTransaccion, 
                                                  ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])                        
                                                 );
                                       //mostrar el contenido
                                       // INSERTAR A LA TABLA CLIENES
                                       $res_insert = $objFileCliente->insert($data);
                                       
                                       if ($res_insert > 0 )
                                          $insertados++;
                                       else
                                       {
                                           $erroneos++;
                                           // REGISTRAR EN UNA TABLA DE LOS LOS ERRONEOS
                                       }
                                     }
                                     $cont++;                         
                        }
                        
                        $leidos = $cont-2;
                        
                      // REGISTRO DE RESUMEN DE LA CARGA DE LOS DATOS
                        $id_archivo_cargado =$object->getIdFile($filename);
                          
                            $texto ="filename = ".$filename.' id '.$id_archivo_cargado[0]['pk_id_archivo'];
                            $file = fopen("importacion.log", "a");
                            fwrite($file, $texto . PHP_EOL);                            
                            fclose($file);  
                            
                      
                        $mensaje_carga = $erroneos>0?'EXISTIO ERRORES EN LA CARGA':'CARGA CORRECTA';
                        $data_import = array(
                                            $leidos, // registros leidos
                                            $insertados, // registros ingresados
                                            $erroneos, //registros error
                                            $mensaje_carga, //mensaje de la carga
                                            562, //tipo_importacion_datos
                                            $id_archivo_cargado[0]['pk_id_archivo'],    //id del archivo cargado
                                            $_SESSION["authenticated_id_user"], 
                                            $idTransaccion, 
                                            $idTransaccion, 
                                            ($_SESSION["authenticated_id_empresa"]==-1 ? NULL : $_SESSION["authenticated_id_empresa"])                                                                         
                                            );
                        
                        
                        $res_importacion = $objImportacion->insert($data_import); 
                        
                        if($res_importacion<0)
                        {
                            $texto ="error en el registro del log id = ".$res_importacion;
                            $file = fopen("importacion.log", "a");
                            fwrite($file, $texto . PHP_EOL);                            
                            fclose($file);  
                        } 
                            
                            
                      fclose($handle);
                    } else {
                        echo "No es posible abrir el archivo!!!!!!";
                    } 
    //#########################################################################               
           

        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}'); 

    } catch (Exception $e) {
        $messageErrorTransaction = "Existio un error al querer ingresar los datos.";
        $detailMessageErrorTransaction = '<strong>Error JF-View-0001:</strong> ' . $e->getMessage();
    }
    $action = 'formulario';
}

if ($action == 'formulario'){
?>

<!-- Action insert, view or edit -->
    <div class="page-title">
        <div class="title-env">
            <h1 class="title"><i class="fa-users"></i> Importar Datos de Clientes</h1>
            <p class="description">En esta pagina usted podr&aacute; realizar  la importacion de datos de Clientes.</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Inicio</a>
                </li>
                <li>
                    <a href="forms-native.html">Clientes</a>
                </li>
                <li class="active">
                    <strong>Importar Datos de Clientes</strong>
                </li>
            </ol>
        </div>
    </div>

 <div class="row">
  <div class="col-sm-12">
    <div class="panel-body">
        <form method="post" role="form" action="index.php?page=<?php echo $routeFull; ?>&action=formulario">	
                <div id="uploader">
                        <p>Su navegador no tiene soporte para Flash, Silverlight o HTML5.</p>
                </div>
                <input type="submit" value="Cargar Mas Archivos" />
        </form>
   </div>
  </div>
</div>
<?php
 }
?>
