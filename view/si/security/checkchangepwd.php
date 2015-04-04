 $("#formObject").validate({        
        rules: {
                llave: {
                        required: true,
                        minlength: 4
                       },
                retypellave: {
                        required: true,
                        minlength: 4,
                        equalTo: "#llave"
                       }
         },
         messages: {
                   llave: {required: " El campo debe ser llenado.",
                              minlength: " El campo debe tener al menos 4 caracteres."
                          }, 
                    retypellave: {required: " El campo debe ser llenado.",
                            minlength: " El campo debe tener al menos 4 caracteres.",
                            equalTo: " No concide con la Contrase&nacute;a, vuelva a escribirla."
                          }                      
                   }
});