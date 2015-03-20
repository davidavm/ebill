$("form#formObject").validate({

        rules: {
                cod_almacen: {
                        required: true,
                        alfanumericoespacio: true
                       },
                alamcen: {
                        required: true,
                        alfanumerico: true
                       }
                       
         },
         messages: {
                    cod_almacen: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    almacen: {required: " Este campo debe ser llenado.",
                           alfanumer+icoespacio: " Ingrese Letras y n&uacute;meros."
                          }                        
                   }
});
