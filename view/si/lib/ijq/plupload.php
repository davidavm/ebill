<?php
//manejo de session para el nombre del directorio temporal
   unset($_SESSION["fileupload_dirname"]);
 if (isset($_SESSION["fileupload_dirname"])) 
 {
    $tmpDirName = $_SESSION["fileupload_dirname"];
 }
else  
 {
    $object = new Archivo($registry[$dbSystem]);
    $tmpDirName=$object->randomNameFile();
    $_SESSION["fileupload_dirname"] = $tmpDirName;
 }
  ?>
// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : 'index.php?page=<?php echo isset($_GET["page"]) ? $_GET["page"] : "".'&cf_jscss[0]=plupload&ci_jq[0]=plupload&ci_js[0]=messages'; ?>&action=subir',
		chunk_size: '1mb',
		rename : true,
		dragdrop: true,
		multi_selection: true,
		filters : {
			// Maximum file size
			max_file_size : '10mb',
			// Specify what files to browse for
			mime_types: [
                                     {title : "Text plain", extensions : "txt"}
                                    ]
		},

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90},
               
		flash_swf_url : '<?php echo FLASH_RELATIVE_PATH; ?>plupload/Moxie.swf',
		silverlight_xap_url : '<?php echo FLASH_RELATIVE_PATH; ?>plupload/Moxie.xap'
	});