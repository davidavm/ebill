$("form#formObject").validate({

        rules: {
                actividad_economica: {
                        required: true,
                        alfanumericoespacio: true
                       },                
                fk_id_clasificacion_tipo_actividad: {
                        required: true
                       }                       
                       
         },
         messages: {
                    actividad_economica: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },                   
                    fk_id_empresa: {required: "Seleccione un valor de la lista."
                          }  
                   }
});


