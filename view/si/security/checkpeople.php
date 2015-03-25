$("form#formObject").validate({

        rules: {
                nombres: {
                        required: true,
                        alfanumericoespacio: true
                       },
                apellido_paterno: {
                        required: true,
                        alfanumericoespacio: true
                       },
                fk_tipo_documento_identidad: {
                        required: true
                       },
                numero_identidad: {
                        required: true,
                        digitos: true
                       },
                fk_departamento_expedicion_doc: {
                        required: true
                       },
                fk_id_empresa: {
                        required: true
                       }                       
                       
         },
         messages: {
                    nombres: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    apellido_paterno: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    fk_tipo_documento_identidad: {required: " Seleccione un valor de la lista."
                          },
                    numero_identidad: {required: " Este campo debe ser llenado.",
                           digitos: " Ingrese d&iacute;gitos."
                          },
                    fk_departamento_expedicion_doc: {required: "Seleccione un valor de la lista."
                          },
                    fk_id_empresa: {required: "Seleccione un valor de la lista."
                          }  
                   }
});


