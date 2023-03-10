<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta id="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- DataTables JS library -->
    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- DataTables JBootstrap -->
    <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Validate jquery lib-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> 
    
    <title></title>
  </head>
  <body>
    <div class="container">
      <h1>Editar menu</h1>
      <br>
      <form  method="POST" id="formulario" >
      <div class="form-group">
        <label for="id_menu_padre">Selecciona menu padre</label>
          <select class="form-select" aria-label="Default select example" id="selectMenu">
            <option selected>Seleccionar un menu</option>
          </select>
        </label>
        <label for="nombre_sub_menu">Nombre</label>
          <input id="nombre_sub_menu" name="nombre_sub_menu" type="text" class="form-control">
        </label>
        <label for="descripcion_sub_menu">Descripcion</label>
          <input id="descripcion_sub_menu" name="descripcion_sub_menu" type="text" class="form-control">
        </label>
      </div>
      <br>
      <button id="submit"  type="submit" class="btn btn-primary">Crear</button>
      <a href="http://localhost/s2next/Views/submenu/"><button id="submit" type="button" class="btn btn-light">Cancelar</button></a>
    </form>
    </div>
  
  

  
    
  <script src="../resources/submenu_edit.js"></script>
    
  </body>
</html>
</body>
</html>