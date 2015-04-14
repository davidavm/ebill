$("form#formObject").validate({

        rules: {
                nombres: {
                        required: true,
                        alfanumericoespacio: true
                       },
                primer_apellido: {
                        required: true,
                        alfanumericoespacio: true
                       }                                          
         },
         messages: {
                    nombres: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    primer_apellido: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          }
                   }
});


