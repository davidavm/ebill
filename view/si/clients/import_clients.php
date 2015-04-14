<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
// Prepare Object 
$object = new Vendedor($registry[$dbSystem]);

// Prepare Transacction
$transaction = new Transaccion($registry[$dbSystem]);

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
$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
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

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
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

<form method="post" action="import_clients.php?action=subir">	
	<div id="uploader">
		<p>Su navegador no tiene soporte para Flash, Silverlight o HTML5.</p>
	</div>
	<input type="submit" value="Send" />
</form>
<?php
}