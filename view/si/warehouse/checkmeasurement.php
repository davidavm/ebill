$("form#formObject").validate({

        rules: {
                unidad_medida: {
                        required: true,
                        alfanumericoespacio: true
                       },
                abreviacion: {
                        required: true,
                        alfanumericopunto: true
                       }  
         },
         messages: {
                    unidad_medida: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    abreviacion: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o punto."
                          }                          
                   }
});


