//editMenu
$(document).ready(function() {
    var URLsearch = window.location.search;
    console.log(URLsearch);
    let id;
    let $nombre_menu_padre= document.getElementById('nombre_menu_padre');
    $.ajax({
            type: "GET",
            url:"http://localhost/s2next/padre/"+URLsearch+"",
            success: function (data) {
                var jsonData = JSON.parse(data);
                id=jsonData[0]['id_menu_padre'];
                nombre_menu_padre.value=jsonData[0]['nombre_menu_padre'];
            }
        })
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
          },
          },
      submitHandler: function() {
        nombre_menu_padre= document.getElementById('nombre_menu_padre').value;
        $.ajax({
              type: "PUT",
              url:"http://localhost/s2next/padre/",
              async: false,
              data: JSON.stringify({ 
                "id_menu_padre":id,
                "nombre_menu_padre": nombre_menu_padre,
              }),
              contentType: "application/json",
              success: function(data) {
                  alert("Datos actualizados correctamente");
                  location.href = 'http://localhost/s2next/Views/menu/';
              },
              error: function(error) {
                  alert("Ha ocurrido un error al enviar la petición");
              }
            });
        }
  });
});