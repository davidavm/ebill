$("form#formObject").validate({

        rules: {
                cod_almacen: {
                        required: true,
                        alfanumericosep: true
                       },
                almacen: {
                        required: true,
                        alfanumericoespacio: true
                       },
                fk_id_sistema_valoracion_inventario: {
                        required: true
                       }
                       
         },
         messages: {
                    cod_almacen: {required: " Este campo debe ser llenado.",
                           alfanumericosep: " Ingrese Letras, n&uacute;meros, espacio o -,_."
                          },
                    almacen: {required: " Este campo debe ser llenado.",
                           alfanumericoespacio: " Ingrese Letras, n&uacute;meros o espacios."
                          },
                    fk_id_sistema_valoracion_inventario: {required: " Este campo debe ser llenado."
                          }                                                  
                   }
});
