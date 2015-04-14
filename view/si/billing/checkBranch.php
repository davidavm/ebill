$("form#formObject").validate({

        rules: {
                sucursal: {
                        required: true,
                        alfanumericoespacio: true
                       },
                razon_social: {
                        required: true,
                        alfanumericoespacio: true
                       },
                numero: {
                        required: true,
                        digitos: true
                       },                
                fk_id_empresa: {
                        required: true
                       }                       
                       
         },
         messages: {
                    sucursal: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    razon_social: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },                    
                    numero: {required: " Este campo debe ser llenado.",
                           digitos: " Ingrese d&iacute;gitos."
                          },
                    fk_id_empresa: {required: "Seleccione un valor de la lista."
                          }  
                   }
});


