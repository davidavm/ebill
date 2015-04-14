$("form#formObject").validate({

        rules: {
                fk_id_sucursal: {
                        required: true
                       } ,
                fecha_factura: {
                        required: true
                       } ,       
                nit: {
                        required: true,
                        digitos: true
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
                    fk_id_sucursal: {required: "Seleccione un valor de la lista."
                          },
                    fecha_factura: {required: " Este campo debe ser llenado."
                          },
                    nit: {required: " Este campo debe ser llenado.",
                           digitos: " Ingrese d&iacute;gitos."
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


