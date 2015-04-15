$("form#formObject").validate({

        rules: {
                razon_social: {
                        required: true,
                        alfanumericoespacio: true
                       },
                nit: {
                        required: true,
                        digitos: true
                       }                                        
         },
         messages: {
                    razon_social: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    nit: {required: " Este campo debe ser llenado.",
                    alfanumericoespacio: " Ingrese d&iacute;gitos."
                          }
                   }
});

    $('#fk_id_departamento').change(function(){
        var selected = $('#fk_id_departamento').val();        
        $('#fk_id_municipio').empty();
        $.getJSON("view/si/configuration/children_back_catalog.php?hijos=municipio&padre="+selected,function(result){
           $.each(result, function(key,value){              
              $('#fk_id_municipio').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    });
    
$('#fecha1').datetimepicker({
    dayOfWeekStart : 1,
    lang:'es',    
    timepicker:false,
    format:'Y-m-d'
});    

$('#fecha2').datetimepicker({
    dayOfWeekStart : 1,
    lang:'es',    
    timepicker:false,
    format:'Y-m-d'
}); 