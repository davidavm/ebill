$("form#formObject").validate({

        rules: {
                usuario: {
                        required: true,
                        alfanumerico: true,
                        minlength: 4
                       },
                llave: {
                        required: true,
                        alfanumerico: true,
                        minlength: 4
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
                           alfanumerico: " Ingrese Letras o n&uacute;meros.",
                           minlength: " Al menos se debe colocar 4 caracteres."
                          },
                    llave: {required: " Este campo debe ser llenado.",
                           alfanumerico: " Ingrese Letras o n&uacute;meros.",
                           minlength: " Al menos se debe colocar 4 caracteres."
                          },
                    fk_id_rol: {required: " Este campo debe ser llenado."
                          },
                    fk_id_empresa: {required: " Este campo debe ser llenado."
                          },
                    fk_id_persona: {required: " Este campo debe ser llenado."
                          }                          
                   }
});

    var fillSecondary = function(){
        var selected = $('#fk_id_persona').val();
        $('#fk_id_persona').empty();
        $.getJSON("view/si/security/children_person_business.php?padre="+selected,function(result){
           $.each(result, function(key,value){
              $('#fk_id_persona').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    };
    $('#fk_id_empresa').change(function(){
        var selected = $('#fk_id_empresa').val();
        $('#fk_id_persona').empty();
        $.getJSON("view/si/security/children_person_business.php?padre="+selected,function(result){
           $.each(result, function(key,value){
              $('#fk_id_persona').append('<option value="'+key+'">'+value+'</option>');              
           });
        });
    });

