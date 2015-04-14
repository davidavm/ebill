$("form#formObject").validate({

        rules: {
                grupo: {
                        required: true,
                        alfanumericoespacio: true
                       },
                fk_id_tipo_grupo: {
                        required: true
                       }                       
         },
         messages: {
                    grupo: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    fk_id_tipo_grupo: {required: " Este campo debe ser llenado."
                          }                                     
                   }
});