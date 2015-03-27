$("form#formObject").validate({

        rules: {
                usuario: {
                        required: true,
                        alfanumerico: true
                       },
                nombre_corto: {
                        required: true,
                        alfanumerico: true
                       },
                razon_social: {
                        required: true,
                        alfanumericoespacio: true
                       },
                nit: {
                        required: true,
                        digitos: true
                       },
                direccion: {
                        required: true,
                        alfanumericoespacio: true
                       }
                       
         },
         messages: {
                    empresa: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    nombre_corto: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras y n&uacute;meros."
                          },
                    razon_social: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    nit: {required: " Este campo debe ser llenado.",
                    alfanumericoespacio: " Ingrese d&iacute;gitos."
                          },
                    direccion: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          }                          
                   }
});

    var fillSecondary = function(){
        var selected = $('#fk_id_departamento').val();
        $('#fk_id_municipio').empty();
        $.getJSON("view/si/configuration/children_back_catalog.php?hijos=municipio&padre="+selected,function(result){
           $.each(result, function(key,value){
              $('#fk_id_municipio').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    };
    $('#fk_id_departamento').change(function(){
        var selected = $('#fk_id_departamento').val();
        $('#fk_id_municipio').empty();
        $.getJSON("view/si/configuration/children_back_catalog.php?hijos=municipio&padre="+selected,function(result){
           $.each(result, function(key,value){
              $('#fk_id_municipio').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    });

