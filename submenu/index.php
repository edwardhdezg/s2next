<?php
require_once(realpath(dirname(__FILE__) . '/../Controllers/SubmenuController.php'));

function validateData($datos) {
    if (!empty($datos) && isset($datos->nombre_sub_menu) && isset($datos->id_menu_padre) && isset($datos->descripcion_sub_menu)) {
        return true; //REtorna true si todos los parametros estan presentes
    } else {
        return false; //Retorna false si no se encuentran los parametros solicitados
       /*  http_response_code(405);
        echo json_encode(["Error" => "Incluir todos los parametros."]); */
    }
}
function validateData2($datos) {
    if (!empty($datos) && isset($datos->id_sub_menu) && isset($datos->nombre_sub_menu) && isset($datos->id_menu_padre) && isset($datos->descripcion_sub_menu)) {
        return true; //REtorna true si todos los parametros estan presentes
    } else {
        return false; //Retorna false si no se encuentran los parametros solicitados
       /*  http_response_code(405);
        echo json_encode(["Error" => "Incluir todos los parametros."]); */
    }
}

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id_sub_menu'])){
            $request= new SubmenuController();
            $request->getWhere($_GET['id_sub_menu']);
        }
        elseif(isset($_GET['join'])){
            $request= new SubmenuController();
            $request->getDataJoin();
        }
        elseif(isset($_GET['catalogos'])){
            $request= new SubmenuController();
            $request->getWhereCatalogos();
        }
        elseif(isset($_GET['marcas'])){
            $request= new SubmenuController();
            $request->getWhereMarcas();
        }
        else{
            $request= new SubmenuController();
            $request->getAll();
        }
        break;

    case 'POST':
        $datos=json_decode(file_get_contents('php://input'));
        if(validateData($datos)==true){
            $request= new SubmenuController();
            $request->insert($datos->nombre_sub_menu,$datos->id_menu_padre,$datos->descripcion_sub_menu);
        }else{
            http_response_code(405);
            echo json_encode(["Error" => "Incluir todos los parametros."]);
        }
        break;
        
    case 'PUT';
        $datos=json_decode(file_get_contents('php://input'));
        if(validateData2($datos)==true){
            $request= new SubmenuController();
            $request->update($datos->id_sub_menu,$datos->nombre_sub_menu,$datos->id_menu_padre,$datos->descripcion_sub_menu);
        }else{
            http_response_code(405);
            echo json_encode(["Error" => "Incluir todos los parametros."]);
        }
        break;
    break;
            
    case 'DELETE';
            if(isset($_GET['id_sub_menu'])){
                $request= new SubmenuController();
                $request->delete($_GET['id_sub_menu']);
            }
    break; 
    default :
            http_response_code(405);
        break;
}
?>