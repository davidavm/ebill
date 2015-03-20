$("form#formObject").validate({

        rules: {
                grupo: {
                        required: true,
                        alfanumericoespacio: true
                       }
                       
         },
         messages: {
                    grupo: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          }                        
                   }
});