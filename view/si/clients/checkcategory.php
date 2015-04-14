$("form#formObject").validate({

        rules: {
                categoria: {
                        required: true,
                        alfanumericoespacio: true
                       }                                        
         },
         messages: {
                    categoria: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          }
                   }
});


