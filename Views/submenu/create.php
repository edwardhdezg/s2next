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
      <h1>Nuevo menu</h1>
      <br>
      <form  method="POST" id="formulario" >
      <div class="form-group">
        <label for="id_menu_padre">Selecciona menu padre</label>
          <select class="form-select" aria-label="Default select example" id="selectMenu">
            <option selected></option>
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
  
  
 <script>

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
     
    
    
</script>
    
  </body>
</html>
</body>
</html>