//indexSubMenu
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url:"http://localhost/s2next/submenu/?join=",
        success: function (data) {
            let jsonData = JSON.parse(data);
            $('#tabla-menu-padre').DataTable({
                'data':jsonData,
                columns: [
                    { 'data': 'id_sub_menu'},
                    { 'data': 'nombre_sub_menu' },
                    { 'data': 'nombre_menu_padre' },
                    { 'data': 'descripcion_sub_menu' },

                ] , 
                columnDefs: [
                    {
                        targets: [4],
                        data:'id_sub_menu',
                        render: function(data,type,row){
                            return '<a href="edit.php?id_sub_menu='+data+'"><button class="btn btn-primary text-white">Editar </button></a>';
                        },
                    },
                    {
                        targets: [5],
                        data:'id_sub_menu',
                        render: function(data,type,row){
                            return '<button id="submit"  onclick="borrar('+data+')" class="btn btn-danger">Borrar</button>';
                        },
                        
                    },  
                ] 
            })
        }
    })
});

function borrar(a){
    let respuesta = confirm("Desea borrar el Menu padre "+a+ "?");
     
    if(respuesta){
        $.ajax({
        type: "DELETE",
        url:"http://localhost/s2next/submenu/?id_sub_menu="+a+"",
        dataType: 'JSON',
        contentType: "application/json",
        success: function(data) {
            console.log(data);
              alert("Datos elimiados correctamente");
              location.href = 'http://localhost/s2next/Views/submenu/';
        },
        error: function(error) {
              console.log(error);
              alert("Ha ocurrido un error al enviar la petición");
        }
        });
    }
}

//Pintando las opciones del menu y el div en el DOM dependiendo los datos recibidos
let selectDropdownCatalogos= document.getElementById('dropdown-menu-catalogos');
let selectDropdownMarcas= document.getElementById('dropdown-menu-marcas');
$.ajax({
        type: "GET",
        url:"http://localhost/s2next/submenu/?marcas",
        success: function (data) {
            var jsonMarcas = JSON.parse(data);
            if(jsonMarcas.length > 1){
                jsonMarcas.forEach(function(item) {
                    selectDropdownMarcas.innerHTML+='<li><a class="dropdown-item opcion" href="#" data-parametro="'+item.descripcion_sub_menu+'">'+item.nombre_sub_menu+'</a></li>';
                });
            }     
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus + " " + errorThrown);
            //You can also generate a specific error code here
        }
});
$.ajax({
        type: "GET",
        url:"http://localhost/s2next/submenu/?catalogos",
        success: function (data) {
            var jsonCatalogos = JSON.parse(data);
            if(jsonCatalogos.length > 1){
                jsonCatalogos.forEach(function(item) {
                    selectDropdownCatalogos.innerHTML+='<li><a class="dropdown-item opcion" href="#" data-parametro="'+item.descripcion_sub_menu+'">'+item.nombre_sub_menu+'</a></li>';
                });  
            } 
        }
});
$(document).on("click", ".opcion", function(event) {
    let divCaja= document.getElementById('divCaja');
    let parametro = event.target.getAttribute("data-parametro");
    $("#divCaja p").remove();
    $("#divCaja").append("<p>"+parametro+"</p>");
    $("#contenedor").toggle();

});


 