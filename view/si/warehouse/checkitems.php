$("form#formObject").validate({

        rules: {
                
                codigo_item: {
                        required: true,
                        alfanumericosepsinesp: true
                       },                      
                descripcion: {
                        required: true,
                        alfanumericoespacio: true
                       },
                cantidad: {
                        required: true,
			number: true
                       },
                costo_unitario: {
                        required: true,
			number: true
                       },
                precio_unitario: {
                        required: true,
			number: true
                       },  
                fk_id_unidad_medida: {
                        required: true
                       }                       
         },
         messages: {
                    codigo_item: { required: " Este campo debe ser llenado.",
                           alfanumericosepsinesp: " Ingrese Letras, n&uacute;meros o -,_."
                          },                         
                    descripcion: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    cantidad: {required: " Este campo debe ser llenado.",
                        number: " Ingresa un n&uacute;mero."
                          },
                    costo_unitario: {required: " Este campo debe ser llenado.",
                        number: " Ingresa un n&uacute;mero."
                          },
                    precio_unitario: {required: " Este campo debe ser llenado.",
                        number: " Ingresa un n&uacute;mero."
                          },
                    fk_id_unidad_medida: {required: " Este campo debe ser llenado."
                          }                          
                   }
});

    $('#fk_id_grupo_padre').change(function(){
        var selected = $('#fk_id_grupo_padre').val();        
        $('#fk_id_grupo').empty();
        $.getJSON("view/si/warehouse/children_group.php?empresa=<?php echo ($_SESSION["authenticated_id_empresa"]==-1?Grupo::ALL:$_SESSION["authenticated_id_empresa"]); ?>&padre="+selected,function(result){
           $.each(result, function(key,value){              
              $('#fk_id_grupo').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    });
    
$('#fecha_vencimiento').datetimepicker({
    dayOfWeekStart : 1,
    lang:'es',    
    timepicker:false,
    format:'Y-m-d'
});    

