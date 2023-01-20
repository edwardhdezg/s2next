<?php
require_once(realpath(dirname(__FILE__) . '/../Controllers/PadreController.php'));

function validateData($datos) {
    if (!empty($datos) && isset($datos->nombre_menu_padre)) {
        return true; //REtorna true si todos los parametros estan presentes
    } else {
        return false; //Retorna false si no se encuentran los parametros solicitados
       /*  http_response_code(405);
        echo json_encode(["Error" => "Incluir todos los parametros."]); */
    }
}
function validateData2($datos) {
    if (!empty($datos) && isset($datos->id_menu_padre) && isset($datos->nombre_menu_padre)) {
        return true; //REtorna true si todos los parametros estan presentes
    } else {
        return false; //Retorna false si no se encuentran los parametros solicitados
       /*  http_response_code(405);
        echo json_encode(["Error" => "Incluir todos los parametros."]); */
    }
}

switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id_menu_padre'])){
            $request= new PadreController();
            $request->getWhere($_GET['id_menu_padre']);
        }
        else{
            $request= new PadreController();
            $request->getAll();
        }
        break;

    case 'POST':
        $datos=json_decode(file_get_contents('php://input'));
        if(validateData($datos)==true){
            $request= new PadreController();
            $request->insert($datos->nombre_menu_padre);
        }else{
            http_response_code(405);
            echo json_encode(["Error" => "Incluir todos los parametros."]);
        }
        break;
        
    case 'PUT';
        $datos=json_decode(file_get_contents('php://input'));
        if(validateData2($datos)==true){
            $request= new PadreController();
            $request->update($datos->id_menu_padre,$datos->nombre_menu_padre);
        }else{
            http_response_code(405);
            echo json_encode(["Error" => "Incluir todos los parametros."]);
        }
        break;
    break;
            
    case 'DELETE';
            if(isset($_GET['id_menu_padre'])){
                $request= new PadreController();
                $request->delete($_GET['id_menu_padre']);
            }
    break; 
    default :
            http_response_code(405);
        break;
}
?>