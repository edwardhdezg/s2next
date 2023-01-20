//editSubMenu
var URLsearch = window.location.search;
let selectMenu= document.getElementById('selectMenu');
let id_menu_padre;
const url3="http://localhost/s2next/padre/";
fetch(url3)
.then(response => response.json())
.then(repos => { 
    const arrMenus = repos.map(repo => repo);
    for (let i = 0; i < arrMenus .length; i++) {
        selectMenu.innerHTML+='<option value="'+arrMenus[i]['id_menu_padre']+'">'+arrMenus[i]['nombre_menu_padre']+'</option>';
    }
})
.catch(err => console.log(err)); 
     

$(document).ready(function() {
var URLsearch = window.location.search;
let selectMenu= document.getElementById('selectMenu');
let $nombre_sub_menu= document.getElementById('nombre_sub_menu');
let $descripcion_sub_menu= document.getElementById('descripcion_sub_menu');
let id;
$.ajax({
        type: "GET",
        url:"http://localhost/s2next/submenu/"+URLsearch+"",
        success: function (data) {
            var jsonData = JSON.parse(data);
            id=jsonData[0]['id_sub_menu'];
            nombre_sub_menu.value=jsonData[0]['nombre_sub_menu'];
            descripcion_sub_menu.value=jsonData[0]['descripcion_sub_menu'];
        }
})
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
          type: "PUT",
          url:"http://localhost/s2next/submenu/",
          async: false,
          data: JSON.stringify({ 
            "id_sub_menu": id,
            "nombre_sub_menu": nombre_sub_menu,
            "id_menu_padre":selectMenu,
            "descripcion_sub_menu": descripcion_sub_menu,
          }),
          contentType: "application/json",
          success: function(data) {
              console.log(data);
              alert("Datos actualizados correctamente");
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