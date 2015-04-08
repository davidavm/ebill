<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo 'llego';
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('EASYBILL');
$pdf->SetTitle('FACTURA NRO 1');
$pdf->SetSubject('FACTURA ASUNTO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

 $fontFamilyCssSanSerif_10= "font-size:10px; font-family: sans-serif; letter-spacing:none;";
  $fontFamilyCssSanSerif_12= "font-size:12px; font-family: sans-serif; letter-spacing:none;";
 $fontFamilyCssSanSerif_26= "font-size:26px; font-family: sans-serif; letter-spacing:none;";
 $fontFamilyCssSanSerif_16= "font-size:16px; font-family: sans-serif; letter-spacing:none;";
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set header and footer fonts
$pdf->setHeaderFont(Array('Tahoma', '', 16));
$pdf->setFooterFont(Array('Tahoma', '', 8));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('tahoma', '', 10);

// add a page
$pdf->AddPage();



// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

$image_file = 'view/img/ebil/logo_ebil.png';
$textoActividadEconomica="Desarrollo de Software";
$textoFactura="FACTURA";
$textOriginal="ORIGINAL";
$textoNitEmpresa ="4440910";
$textoNroAutorizacion ="30020015358";
$textoNroFactura = "1236587";

$textoNombreEmpresa = "PENTAGROUP";
$textoSucursal = "CASA MATRIZ";
$textoDireccionEmpresa ="Av. Los Parrales # 100";

$textoLugaryFecha = "Cochabamba, 10/02/2015";
$textoNitCliente = "4440910";
$textoRazonSocialCliente = "David Vargas";

$textoCodigoControl="AF-D0-BA-EH-CE-0O";
$textoFechaLimiteEmision="31/12/2015";
    
$textoPieFactura="<b>\"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS. EL USO ILÍCITO DE ÉSTA SERÁ SANCIONADO DE ACUERDO A LEY\"</b><br>
   Ley N°453: \"En caso de incumplimiento a lo ofertado o convenido, el proveedor debe reparar o sustituir el servicio\" ";

 $textoCodigoQR='5654564654';
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example
        
        /*********************************************************************************************************************************************/
       /** LOGOTIPO*************************************************************************************************************************/
       /*********************************************************************************************************************************************/ 

        
        $pdf->Image($image_file, 5, 5, 72, 15, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $pdf->SetFont('times', 'B', 13);
        
       /*********************************************************************************************************************************************/
       /**FIN LOGOTIPO*************************************************************************************************************************/
       /*********************************************************************************************************************************************/ 
        
       /*********************************************************************************************************************************************/
       /**TITULO FACTURA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
        
        $htmlTitle =<<<EOD
                         <div style=" text-align:center; $fontFamilyCssSanSerif_26" >$textoFactura</div>           
EOD;
           $pdf->writeHTMLCell(55, 5, 75, 30, $htmlTitle, 'LRTB', 1, 0, true, '', true);
           $pdf->SetFont('times', 'B', 13);
         /*********************************************************************************************************************************************/
       /**FIN TITULO FACTURA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
      
      /*********************************************************************************************************************************************/
       /**ACTIVIDAD ECONOMICA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
        
        $htmlEconomicActivity =<<<EOD
                         <span style="$fontFamilyCssSanSerif_16 text-align: center;" >$textoOriginal</span>  
                             <br><span style="$fontFamilyCssSanSerif_10 text-align: center;" >$textoActividadEconomica</span> 
EOD;
           $pdf->writeHTMLCell(60, 10, 145, 20, $htmlEconomicActivity, 'LRTB', 1, 0, true, '', true);
           $pdf->SetFont('times', 'B', 13);
       /*********************************************************************************************************************************************/
       /**FIN ACTIVIDAD ECONOMICA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/     
           
       /*********************************************************************************************************************************************/
       /**DATOS EMPRESA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/  
        $pdf->SetFont('times', 'B', 8);
        $pdf->setCellPaddings(1,1,1,1);
      
          $htmlCompanyData = ""
                  . "<div style=\"$fontFamilyCssSanSerif_12\">"
                  . "NIT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                  . "$textoNitCliente"
                  . "<br>No AUTORIZACION:&nbsp;&nbsp;&nbsp;&nbsp;"
                  . "$textoNroAutorizacion"
                  . "<br>No FACTURA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                  . "$textoNroFactura"
                  . "</div>";
        $pdf->writeHTMLCell(60, 5, 145, 5, $htmlCompanyData, 'LRTB', 1, 0, true, '', true);
        
        /*********************************************************************************************************************************************/
       /**FIN DATOS EMPRESA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
       
       /*********************************************************************************************************************************************/
       /**DIRECCION EMPRESA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/  
       

        $txtAddress = "<div style=\" text-align:center; $fontFamilyCssSanSerif_10\">$textoNombreEmpresa <br>$textoSucursal <br>$textoDireccionEmpresa</div>";
        
        $pdf->writeHTMLCell(65, 15, 6, 20, $txtAddress, 'LRTB', 1, 0, true, '', true);

       //$pdf->MultiCell(65, 15, $txt2, 1, 'C', 0, 2, 5, 16, true);
       /*********************************************************************************************************************************************/
       /**FIN DIRECCION EMPRESA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/ 
       
       /*********************************************************************************************************************************************/
       /**DATOS CLIENTE*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
       
       
        
       $tblclientData = <<<EOD
<table  cellpadding="4" style="$fontFamilyCssSanSerif_10" >
<tr>
    <th style="width:100px; text-align: left; font-weight: bold;" >&nbsp;&nbsp;Lugar y Fecha:</th>
    <th style="width:390px; text-align: left; font-weight: bold;"  >$textoLugaryFecha</th>
    <th style="width:70px; text-align: left; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;NIT/CI:</th>
    <th style="width:140px; text-align: left; font-weight: bold;">$textoNitCliente</th>     
</tr>
<tr>
    <th style="width:100px; text-align: left; font-weight: bold;" >&nbsp;&nbsp;Señor(es):</th>
    <th style="width:390px; text-align: left; font-weight: bold;"  >$textoRazonSocialCliente</th>
    <th style="width:70px; text-align: left; font-weight: bold;"></th>
    <th style="width:140px; text-align: right; font-weight: bold;"></th>     
</tr> 
    <tr>
    <th style="width:100px; text-align: left; font-weight: bold;" >&nbsp;</th>
    <th style="width:390px; text-align: left; font-weight: bold;"  ></th>
    <th style="width:70px; text-align: left; font-weight: bold;"></th>
    <th style="width:140px; text-align: right; font-weight: bold;"></th>     
</tr> 
             
</table>
EOD;
               
        $pdf->writeHTMLCell(200, 10, 5, 45, $tblclientData, 'LRTB', 1, 0, true, '', true);
               
               
       /*********************************************************************************************************************************************/
       /**FIN DATOS CLIENTE*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
       
       /*********************************************************************************************************************************************/
       /**DETALLE*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
       
       $tbl = <<<EOD
<table border="1" cellpadding="2" style="$fontFamilyCssSanSerif_10" >
<tr>
    <th style="width:70px; text-align: center; font-weight: bold;" >CODIGO</th>
    <th style="width:420px; text-align: center; font-weight: bold;"  >DESCRIPCION</th>
    <th style="width:70px; text-align: center; font-weight: bold;">PRECIO</th>
    <th style="width:70px; text-align: center; font-weight: bold;">CANTIDAD</th>    
    <th style="width:70px; text-align: center; font-weight: bold;">SUBTOTAL</th>     
</tr>
<tr>
    <th colspan="2" style="text-align: left; font-weight: bold;">&nbsp;&nbsp;SON:</th>
    <th colspan="2" style="text-align: center; font-weight: bold;" >TOTAL Bs</th>
    <th colspan="2" style="text-align: center; font-weight: bold;" >800.63</th>                   
</tr>               
</table>
EOD;

       $pdf->writeHTMLCell(200, 30, 5, 65, $tbl, 'LRTB', 1, 0, true, '', true);
//$pdf->writeHTML($tbl, true, false, false, false, '');

  
       /*********************************************************************************************************************************************/
       /**FIN-DETALLE*************************************************************************************************************************/
       /*********************************************************************************************************************************************/     
       
       /*********************************************************************************************************************************************/
       /**CODIGO DE CONTROL*************************************************************************************************************************/
       /*********************************************************************************************************************************************/     
       $txtControlCode = <<<EOD
<SPAN style="font-size:12px; font-family: sans-serif; letter-spacing: none; ">Codigo de Control: $textoCodigoControl</SPAN>
EOD;

       $pdf->writeHTMLCell(140, 5, 5, 100, $txtControlCode, 'LRTB', 1, 0, true, '', true);
//$pdf->writeHTML($tbl, true, false, false, false, '');
       /*********************************************************************************************************************************************/
       /**FIN CODIGO DE CONTROL*************************************************************************************************************************/
       /*********************************************************************************************************************************************/  
        
       /*********************************************************************************************************************************************/
       /**FECHA LIMITE DE EMISION*************************************************************************************************************************/
       /*********************************************************************************************************************************************/  
        $txtControlCode = <<<EOD
<SPAN style="font-size:12px; font-family: sans-serif; letter-spacing: none; ">Fecha limite de emision : $textoFechaLimiteEmision</SPAN>
EOD;

       $pdf->writeHTMLCell(140, 5, 5, 109, $txtControlCode, 'LRTB', 1, 0, true, '', true);
       /*********************************************************************************************************************************************/
       /**FIN FECHA LIMITE DE EMISION*************************************************************************************************************************/
       /*********************************************************************************************************************************************/  
        // set style for barcode
       
       /*********************************************************************************************************************************************/
       /**QR*************************************************************************************************************************/
       /*********************************************************************************************************************************************/ 
      
       $style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(0,0,0),
    'bgcolor' => false
);
       $pdf->write2DBarcode($textoCodigoQR, 'QRCODE,H', 170, 100, 50, 50, $style, 'N');

       /*********************************************************************************************************************************************/
       /**FIN-QR*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
       
       /*********************************************************************************************************************************************/
       /**PIE FACTURA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/ 
        $txtInvoiceFoot = <<<EOD
<div style=" $fontFamilyCssSanSerif_10 text-align:center;">$textoPieFactura
   </div>
EOD;

       $pdf->writeHTMLCell(200, 10, 5, 135, $txtInvoiceFoot, 'LRTB', 1, 0, true, '', true);
       /*********************************************************************************************************************************************/
       /**FIN-PIE FACTURA*************************************************************************************************************************/
       /*********************************************************************************************************************************************/
/*
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// QRCODE,L : QR-CODE Low error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,L', 20, 30, 50, 50, $style, 'N');
$pdf->Text(20, 25, 'QRCODE L');

// QRCODE,M : QR-CODE Medium error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,M', 20, 90, 50, 50, $style, 'N');
$pdf->Text(20, 85, 'QRCODE M');

// QRCODE,Q : QR-CODE Better error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,Q', 20, 150, 50, 50, $style, 'N');
$pdf->Text(20, 145, 'QRCODE Q');

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
$pdf->Text(20, 205, 'QRCODE H');

   */     



        $pdf->lastPage();

// ---------------------------------------------------------
//echo SITE_PATH;
//Close and output PDF document
$pdf->Output(SITE_PATH.'invoices/invoice_test.pdf','F');

// set the barcode content and type
//$barcodeobj = new TCPDF2DBarcode('http://www.tcpdf.org', 'QRCODE,H');

// output the barcode as PNG image
//$barcodeobj->getBarcodePNG(6, 6, array(0,0,0));

//============================================================+
// END OF FILE
//============================================================+

?>

