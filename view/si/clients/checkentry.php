$("form#formObject").validate({

        rules: {
                rubro: {
                        required: true,
                        alfanumericoespacio: true
                       }                                        
         },
         messages: {
                    rubro: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          }
                   }
});


