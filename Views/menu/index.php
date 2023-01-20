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
            <a class="nav-link active" aria-current="page" href="../submenu/index.php">Menu</a>
            </li>
            
        </ul>
        </div>
    </div>
    </nav>

    <div class="container mt-5">
            <div class="container border border-dark d-flex justify-content-between p-3 mb-2 bg-primary text-white" >
                <div>
                    <h1>Menu padre</h1>
                </div>
                <div>
                    <a href="create.php"><button type="button" class="btn btn-success">Nuevo</button></a>
                </div>
            </div>
            <table class="table w-100 p-3" id="tabla-menu-padre">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre menu padre</th>
                    <th scope="col">Eliminar</th>

                    </tr>
                </thead>
            </table>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->
    

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
            url:"http://localhost/s2next/padre/",
            success: function (data) {
                let jsonData = JSON.parse(data);
                $('#tabla-menu-padre').DataTable({
                    'data':jsonData,
                    columns: [
                        { 'data': 'id_menu_padre'},
                        { 'data': 'nombre_menu_padre' },
                    ] , 
                    columnDefs: [
                        {
                            targets: [2],
                            data:'id_menu_padre',
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
            url:"http://localhost/s2next/padre/?id_menu_padre="+a+"",
            dataType: 'JSON',
            contentType: "application/json",
                success: function(data) {
                  console.log(data);
                  alert("Datos elimiados correctamente");
                  location.href = 'http://localhost/s2next/Views/menu/';
                },
                error: function(error) {
                  console.log(error);
                  alert("Ha ocurrido un error al enviar la petición");
                }
            });
        }  
    }

    
    </script>
  </body>
</html>