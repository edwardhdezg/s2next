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
      <h1>Editar Menu Padre</h1>
      <form  method="POST" id="formulario" >
      <div class="form-group">
        <label for="nombre_menu_padre">Nombre Menu Padre</label>
        <input id="nombre_menu_padre" name="nombre_menu_padre" type="text" class="form-control" >
      </div>
      

      <button id="submit"  type="submit" class="btn btn-primary">Editar</button>
      <a href="http://localhost/s2next/Views/menu/"><button id="submit" type="button" class="btn btn-light">Cancelar</button></a>
    </form>
    </div>
  
  
    <script>
           
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
     
    
    
</script>
    
  </body>
</html>
</body>
</html>