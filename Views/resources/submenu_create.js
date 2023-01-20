//createSubMenu
const url="http://localhost/s2next/padre/";
let selectMenu= document.getElementById('selectMenu');
fetch(url)
    .then(response => response.json())
    .then(repos => { 
    const arrMenu = repos.map(repo => repo);
      for (let i = 0; i < arrMenu.length; i++) {
        selectMenu.innerHTML+='<option value="'+arrMenu[i]['id_menu_padre']+'">'+arrMenu[i]['nombre_menu_padre']+'</option>';
      }
    })
    .catch(err => console.log(err));
    
  $(document).ready(function() {
    $.validator.addMethod( "lettersonly", function( value, element ) {
        return this.optional( element ) || /^[a-z\s-a-záéíóúý]+$/i.test( value );
    }, "Introducir solo texto" );
    $("#formulario").validate({
    rules: {
          id_menu_padre : {
          required: true,
          },
          nombre_sub_menu : {
          required: true,
          lettersonly:true,
          },
          descripcion_sub_menu : {
          required: true,
          lettersonly:true,
          },
      },
      submitHandler: function() {
        let nombre_sub_menu= document.getElementById('nombre_sub_menu').value;
        let descripcion_sub_menu= document.getElementById('descripcion_sub_menu').value;
        let selectMenu= document.getElementById('selectMenu').value;

          $.ajax({
              type: "POST",
              url:"http://localhost/s2next/submenu/",
              async: false,
              data: JSON.stringify({ 
                "nombre_sub_menu": nombre_sub_menu,
                "id_menu_padre": selectMenu,
                "descripcion_sub_menu": descripcion_sub_menu,
              }),
              contentType: "application/json",
              success: function(data) {
                  console.log(data);
                  alert("Datos agregados correctamente");
                  location.href = 'http://localhost/s2next/Views/submenu/';
                  
              },
              error: function(error) {
                  console.log(error);
                  alert("Ha ocurrido un error al enviar la petición");
              }
            });
        }
  });
});
     