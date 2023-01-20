//indexMenu
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

    