<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Evaluacion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../menu/index.php">Menu padre</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Catalogos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="dropdown-menu-catalogos">
                
                </ul>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Marcas
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="dropdown-menu-marcas">
                
                </ul>
                </li> 
            </ul>
            </div>
        </div>
    </nav>

  <div class="container mt-5">
        <div class="container border border-dark d-flex justify-content-between p-3 mb-2 bg-primary text-white" >
            <div>
                <h1>Menu</h1>
            </div>
            <div>
                <a href="create.php"><button type="button" class="btn btn-success">Nuevo</button></a>
            </div>
        </div>
        <table class="table" id="tabla-menu-padre">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Menu padre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Editar</th>
                <th scope="col">Borrar</th>
                </tr>
            </thead>
        </table>
    </div>


    <br>
    <div class="container border border-dark " style="display:none;" id="contenedor">
        <div class="mx-auto" style="width: 200px;" id="divCaja">
            
        </div>
    </div>
    
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- jQuery Library -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- DataTables JS library -->
    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    <script>
            
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


       
        
    </script>
  </body>
</html>