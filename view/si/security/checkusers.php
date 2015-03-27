$("form#formObject").validate({

        rules: {
                usuario: {
                        required: true,
                        alfanumericosepsinesp: true
                       },
                llave: {
                        required: true,
                        alfanumericosepsinesp: true
                       },
                fk_id_rol: {
                        required: true
                       },
                fk_id_empresa: {
                        required: true
                       },
                fk_id_persona: {
                        required: true
                       }                       
         },
         messages: {
                    usuario: {required: " Este campo debe ser llenado.",
                           alfanumericosepsinesp: " Ingrese letras, n&uacute;meros o '-','_'"
                          },
                    llave: {required: " Este campo debe ser llenado.",
                           alfanumericosepsinesp: " Ingrese letras, n&uacute;meros o '-','_'"
                          },
                    fk_id_rol: {required: " Seleccione un valor de la lista."
                          },
                    fk_id_empresa: {required: " Seleccione un valor de la lista."
                          },
                    fk_id_persona: {required: " Seleccione un valor de la lista."
                          }                          
                   }
});

    $('#fk_id_empresa').change(function(){
        var selected = $('#fk_id_empresa').val();
        $('#fk_id_persona').empty();
        $.getJSON("view/si/security/children_person_business.php?padre="+selected,function(result){
           $.each(result, function(key,value){
              $('#fk_id_persona').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    });

