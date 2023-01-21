<?php
require_once(realpath(dirname(__FILE__) . '/../Connection/Connection.php'));

class Padre{
    private $id_menu_padre;
    private $nombre_menu_padre;
    
    function __construct()
    {
    $this->conn = new Connection();
    $this->conn = $this->conn->getmyDB();
    }

    
    
    public function getAll() {
        try {
            $query = "SELECT * FROM menu_padre";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_menu_padre'=>$row['id_menu_padre'],
                        'nombre_menu_padre'=>$row['nombre_menu_padre'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["error" => "No record found"]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data.".$e->getMessage()]);
        }
    }

    
    
    public function getWhere($id_menu_padre){
        $this->id_menu_padre=$id_menu_padre;
        if (!is_numeric($this->id_menu_padre) || $this->id_menu_padre < 0) {
            return json_encode(["error" => "Invalid id_almacen parameter"]);
        }else{
            try {
                $query = "SELECT * FROM menu_padre WHERE id_menu_padre =:id_menu_padre";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":id_menu_padre", $this->id_menu_padre);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $data=[];
                if (!empty($result)) {
                    foreach ($result as $row) { 
                        $data[]=[
                            'id_menu_padre'=>$row['id_menu_padre'],
                            'nombre_menu_padre'=>$row['nombre_menu_padre'],
                        ];
                    }
                    return json_encode($data);
                } else {
                    return json_encode(["Error" => "No record found for id_menu_padre: " . $this->id_menu_padre]);
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return json_encode(["Error" => "An error occurred while trying to retrieve the data.".$e->getMessage()]);
            }
        }
        
    }
    
    
    public function insert($nombre_menu_padre) {
        $this->nombre_menu_padre=$nombre_menu_padre;
        if($this->validateTypeData()==true){ //validar que el tipo de daatos sea el requerido
            // Iniciar una transacción
            $this->conn->beginTransaction();
            // Verificar si el registro ya existe
            $checkExist = $this->conn->prepare("SELECT COUNT(*) FROM menu_padre WHERE nombre_menu_padre = :nombre_menu_padre");
            $checkExist->bindParam(':nombre_menu_padre', $this->nombre_menu_padre);
            $checkExist->execute();
            if ($checkExist->fetchColumn() > 0) {
                return http_response_code(404);
            }else{
               
                try {
                    // Insertar los datos utilizando sentencias preparadas
                    $stmt = $this->conn->prepare("INSERT INTO menu_padre (nombre_menu_padre) VALUES (:nombre_menu_padre)");
                    $stmt->bindParam(':nombre_menu_padre', $this->nombre_menu_padre);
                    $stmt->execute();
                    // Confirmar la transacción
                    $this->conn->commit();
                    return json_encode(["Success" => "Record insert successfully"]);        
                } catch (Exception $e) {
                    // Revertir los cambios en caso de error
                    $this->conn->rollBack();
                    return json_encode(["Error" => "An error occurred while trying to insert the data.".$e->getMessage()]);
                }
            } 

        }else{
            return json_encode(["Error" => "Verify that the data types sent are correct."]);
        }
       
       
    }
    
    public function update($id_menu_padre,$nombre_menu_padre){
        $this->id_menu_padre=$id_menu_padre;
        $this->nombre_menu_padre=$nombre_menu_padre;
        // Iniciar una transacción
        if($this->validateTypeData2()==true){ //validar que el tipo de daatos sea el requerido
            try {
                $query = "UPDATE menu_padre SET nombre_menu_padre=:nombre_menu_padre WHERE id_menu_padre=:id_menu_padre";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':nombre_menu_padre', $this->nombre_menu_padre);    
                $stmt->bindValue(':id_menu_padre', $this->id_menu_padre);             
                $stmt->execute();
                if ($stmt->rowCount()) {
                    return json_encode(["Success"=>"Record updated successfully."]);
                } else {
                    return json_encode(["Info"=>"No row updated."]);
                }
                
            } catch (PDOException $e) {
                return json_encode(["Info" => "An error occurred while trying to insert the data.".$e->getMessage()]);
            }
        }else{
            return json_encode(["Error" => "Verify that the data types sent are correct."]);
        }
    }
     
    public function delete($id_menu_padre){
        $this->id_menu_padre=$id_menu_padre;
        if (!is_numeric($this->id_menu_padre) || $this->id_menu_padre < 0) {
            return json_encode(["error" => "Invalid id_almacen parameter"]);
        }else{
            try {
                $query="DELETE FROM menu_padre WHERE id_menu_padre=:id_menu_padre";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id_menu_padre', $this->id_menu_padre, PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->rowCount()) {
                    return json_encode(["Success"=>"Record delete successfully."]);
                } else {
                    return json_encode(["Info"=>"No record was deleted"]);
                }
                } catch (PDOException $e) {
                    return json_encode(["Error" => "An error occurred while trying to delete the data.".$e->getMessage()]);
                return false;
                }
        }
    }

    private function validateTypeData(){
        if (is_string($this->nombre_menu_padre)) {
            if($this->nombre_menu_padre=="Catalogos" ||$this->nombre_menu_padre=="Marcas" ){
                return true; //Retorna true se los datos no son de tipo string
            }  
        }else{
            return false; //Retorna true se los datos  son de tipo string
        }
            
    }
    private function validateTypeData2(){
        if (is_numeric($this->id_menu_padre) && is_string($this->nombre_menu_padre)) {
                return true; //Retorna true si id_menu_padre es numerico y nombre_menu_padre es de tipo string
        }else{
            return false; //Retorna true se los datos  son de tipo string
        }
            
    }
}