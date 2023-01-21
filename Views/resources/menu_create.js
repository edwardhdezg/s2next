//createMenu
$(document).ready(function() {
  $.validator.addMethod( "lettersonly", function( value, element ) {
    return this.optional( element ) || /^[a-z\s-a-záéíóúý]+$/i.test( value );
}, "Introducir solo texto" );
$.validator.addMethod( "validatorNameMenu", function( value, element ) {
  return value=="Catalogos" || value=="Marcas";
}, "Solo acepta valor de Catalogos y/o Marcas" );
$("#formulario").validate({
  rules: {
        nombre_menu_padre : {
        required: true,
        lettersonly:true,
        validatorNameMenu:true,
        }
    },
    submitHandler: function() {
      let nombre_menu_padre= document.getElementById('nombre_menu_padre').value;
        $.ajax({
            type: "POST",
            url:"http://localhost/s2next/padre/",
            async: false,
            data: JSON.stringify({ 
              "nombre_menu_padre": nombre_menu_padre,
            }),
            contentType: "application/json",
            success: function(data) {
                alert("Datos agregados correctamente");
                location.href = 'http://localhost/s2next/Views/menu/';
                
            },
            error: function(error) {
                let statusCode = error.status;
                if (statusCode === 404) {
                    alert("Error: el registro ya existe");
                }else if(statusCode === 500){
                    console.log("Internal Server Error");
                }else{
                    alert("Ha ocurrido un error al enviar la petición");
                }
               
            }
          });
      }
});
});