
    /* colocar en table id="example" y class="display" */
    var table = $('#example').DataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "<?php echo FLASH_RELATIVE_PATH; ?>tabletools/copy_csv_xls_pdf.swf",
            "aButtons": [ { "sExtends": "copy", "sButtonText": "Copiar a la papelera" }, 
                          {
                          "sExtends":    "collection",
                          "sButtonText": "Vista para Imprimir ...",
                          "aButtons":    [ 
                                            { "sExtends": "print", "sButtonText": "Todos los datos", "sToolTip": "Imprimir todos los datos", "sInfo": "<h6>Vista de Impresi&oacute;n</h6><p>Por favor usar la funci&oacute;n de imprimir de su navegador para imprimir esta tabla. Presione la tecla ESC (Escapar) cuando haya finalizado.</p>", "sMessage": "Generado por el Sistema de gestion de archivos"}, 
                                            { "sExtends": "print", "sButtonText": "La pagina actual", "bShowAll": false, "sToolTip": "Imprimir la pagina actual", "sInfo": "<h6>Vista de Impresi&oacute;n</h6><p>Por favor usar la funci&oacute;n de imprimir de su navegador para imprimir esta tabla. Presione la tecla ESC (Escapar) cuando haya finalizado.</p>", "sMessage": "Generado por el Sistema de gestion de archivos" }                          
                                         ]
                          }, 
                          {
                          "sExtends":    "collection",
                          "sButtonText": "Exportar todo a ...",
                          "aButtons":    [ 
                                            { "sExtends": "csv", "sButtonText": "CSV", "sFileName": "SGEA_lista_completa.csv", "bFooter": false, "sToolTip": "Exportar todo a CSV" }, 
                                            { "sExtends": "xls", "sButtonText": "EXCEL", "sFileName": "SGEA_lista_completa.csv", "bFooter": false, "sToolTip": "Exportar todo a Exel" },                          
                                            { "sExtends": "pdf", "sButtonText": "PDF", "sFileName": "SGEA_lista_completa.pdf", "bFooter": false, "sTitle": "Sistema de gestion de archivos", "sPdfMessage": "Archivo exportado con todos los datos.", "sPdfSize": "letter", "sToolTip": "Exportar todo a PDF" }
                                         ]
                          },
                          {
                          "sExtends":    "collection",
                          "sButtonText": "Exportar pagina a ...",
                          "aButtons":    [ 
                                            { "sExtends": "csv", "sButtonText": "CSV", "sFileName": "SGEA_lista_seleccionada.csv", "oSelectorOpts": { page: 'current' }, "bFooter": false, "sToolTip": "Exportar pagina a CSV" }, 
                                            { "sExtends": "xls", "sButtonText": "EXCEL", "sFileName": "SGEA_lista_seleccionada.csv", "oSelectorOpts": { page: 'current'}, "bFooter": false, "sToolTip": "Exportar pagina a Excel" } ,                          
                                            { "sExtends": "pdf", "sButtonText": "PDF", "sFileName": "SGEA_lista_seleccionada.pdf", "oSelectorOpts": { page: 'current' },"bFooter": false, "sTitle": "Sistema de gestion de archivos", "sPdfMessage": "Archivo exportado con datos seleccionados.", "sPdfSize": "letter", "sToolTip": "Exportar pagina a PDF" }
                                         ]
                          }                          
                        ] 
        },
        "language": { 
                        "url": "<?php echo LANGUAGE_RELATIVE_PATH; ?>Spanish.json"  
        },
        "pagingType": "full_numbers",
        "lengthMenu": [ [ 25, 50, 100, 200, 500, -1], [ 25, 50, 100, 200, 500, "Todos"] ]
    } );


