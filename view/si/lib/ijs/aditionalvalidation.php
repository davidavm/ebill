jQuery.validator.addMethod("alfanumericosep", function(value, element) {
return this.optional(element) || /^[a-z,"\-"," ","_",0-9]+$/i.test(value);
}, " Ingrese Letras, n&uacute;meros o caracteres (espacio, _, -)."); 

jQuery.validator.addMethod("alfanumericosepsinesp", function(value, element) {
return this.optional(element) || /^[a-z,"\-","_",0-9]+$/i.test(value);
}, " Ingrese Letras, n&uacute;meros o caracteres (_, -).");

jQuery.validator.addMethod("alfanumerico", function(value, element) {
return this.optional(element) || /^[a-z,0-9]+$/i.test(value);
}, " Ingrese Letras y n&uacute;meros."); 

jQuery.validator.addMethod("alfanumericoespacio", function(value, element) {
return this.optional(element) || /^[a-z," ",0-9]+$/i.test(value);
}, " Ingrese Letras, n&uacute;meros o espacios."); 


jQuery.validator.addMethod("letrasespacio", function(value, element) {
return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, " Ingrese Letras y espacio."); 

jQuery.validator.addMethod("letras", function(value, element) {
return this.optional(element) || /^[a-z]+$/i.test(value);
}, " Ingrese Letras."); 

jQuery.validator.addMethod("digitosespacio", function(value, element) {
return this.optional(element) || /^[0-9," "]+$/i.test(value);
}, " Ingrese d&iacute;gitos y espacio."); 

jQuery.validator.addMethod("digitos", function(value, element) {
return this.optional(element) || /^[0-9]+$/i.test(value);
}, " Ingrese d&iacute;gitos."); 
