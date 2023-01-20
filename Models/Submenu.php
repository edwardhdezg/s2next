<?php

require_once(realpath(dirname(__FILE__) . '/../Connection/Connection.php'));

class Submenu{
    private $id_sub_menu,$nombre_sub_menu, $id_menu_padre,$descripcion_sub_menu;
    
    function __construct()
    {
    $this->conn = new Connection();
    $this->conn = $this->conn->getmyDB();
    }

    public function getAll() {
        try {
            $query = "SELECT * FROM sub_menu";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_sub_menu'=>$row['id_sub_menu'],
                        'nombre_sub_menu'=>$row['nombre_sub_menu'],
                        'id_menu_padre'=>$row['id_menu_padre'],
                        'descripcion_sub_menu'=>$row['descripcion_sub_menu'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["error" => "No record found"]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data."]);
        }
    }

    
    
    public function getWhere($id_sub_menu){
        $this->id_sub_menu=$id_sub_menu;
        if (!is_numeric($this->id_sub_menu) || $this->id_sub_menu < 0) {
            return json_encode(["error" => "Invalid id_sub_menu parameter"]);
        }

        try {
            $query = "SELECT * FROM sub_menu WHERE id_sub_menu =:id_sub_menu";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_sub_menu", $this->id_sub_menu);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_sub_menu'=>$row['id_sub_menu'],
                        'nombre_sub_menu'=>$row['nombre_sub_menu'],
                        'id_menu_padre'=>$row['id_menu_padre'],
                        'descripcion_sub_menu'=>$row['descripcion_sub_menu'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["Error" => "No record found for id_sub_menu: " . $this->id_sub_menu]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data."]);
        }
    }

    public function getDataJoin(){
        try {
            $query = "SELECT a.id_sub_menu, a.nombre_sub_menu, b.nombre_menu_padre, a.descripcion_sub_menu
            FROM sub_menu AS a 
            JOIN menu_padre AS b 
            ON a.id_menu_padre=b.id_menu_padre";
            //$stmt->bindParam(":id_menu_padre", $this->id_menu_padre);
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_sub_menu'=>$row['id_sub_menu'],
                        'nombre_sub_menu'=>$row['nombre_sub_menu'],
                        'nombre_menu_padre'=>$row['nombre_menu_padre'],
                        'descripcion_sub_menu'=>$row['descripcion_sub_menu'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["Error" => "No record found for id_menu_padre: " . $this->id_menu_padre]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data."]);
        }
    }

    public function getWhereMarcas(){
        try {
            $query = "SELECT a.id_sub_menu, a.nombre_sub_menu, b.nombre_menu_padre, a.descripcion_sub_menu FROM sub_menu AS a JOIN menu_padre AS b ON a.id_menu_padre=b.id_menu_padre AND b.nombre_menu_padre='Marcas'";
            //$stmt->bindParam(":id_menu_padre", $this->id_menu_padre);
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_sub_menu'=>$row['id_sub_menu'],
                        'nombre_sub_menu'=>$row['nombre_sub_menu'],
                        'nombre_menu_padre'=>$row['nombre_menu_padre'],
                        'descripcion_sub_menu'=>$row['descripcion_sub_menu'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["Error" => "No record found for Marcas"]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data."]);
        }
    }

    
    public function getWhereCatalogos(){
        try {
            $query = "SELECT a.id_sub_menu, a.nombre_sub_menu, b.nombre_menu_padre, a.descripcion_sub_menu FROM sub_menu AS a JOIN menu_padre AS b ON a.id_menu_padre=b.id_menu_padre AND b.nombre_menu_padre='Catalogos'";
            //$stmt->bindParam(":id_menu_padre", $this->id_menu_padre);
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=[];
            if (!empty($result)) {
                foreach ($result as $row) { 
                    $data[]=[
                        'id_sub_menu'=>$row['id_sub_menu'],
                        'nombre_sub_menu'=>$row['nombre_sub_menu'],
                        'nombre_menu_padre'=>$row['nombre_menu_padre'],
                        'descripcion_sub_menu'=>$row['descripcion_sub_menu'],
                    ];
                }
                return json_encode($data);
            } else {
                return json_encode(["Error" => "No record found for Catalogos"]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return json_encode(["Error" => "An error occurred while trying to retrieve the data."]);
        }
    }
    
    
    public function insert($nombre_sub_menu, $id_menu_padre,$descripcion_sub_menu) {
        $this->nombre_sub_menu=$nombre_sub_menu;
        $this->id_menu_padre=$id_menu_padre;
        $this->descripcion_sub_menu=$descripcion_sub_menu;
        if($this->validateTypeData()==true){ //validar que el tipo de daatos sea el requerido
            // Iniciar una transacción
            $this->conn->beginTransaction();
            // Verificar si id_menu_padre existe en la BD menu_padre
            $checkExist = $this->conn->prepare("SELECT COUNT(*) FROM menu_padre WHERE id_menu_padre = :id_menu_padre");
            $checkExist->bindParam(':id_menu_padre', $id_menu_padre);
            $checkExist->execute();
            if ($checkExist->fetchColumn() > 0) { // return true si existe al menos un registro de ind_menu_padre - 
                try {
                    // Insertar los datos utilizando sentencias preparadas
                    $stmt = $this->conn->prepare("INSERT INTO sub_menu (nombre_sub_menu, id_menu_padre,descripcion_sub_menu ) VALUES (:nombre_sub_menu, :id_menu_padre, :descripcion_sub_menu)");
                    $stmt->bindParam(':nombre_sub_menu', $this->nombre_sub_menu);
                    $stmt->bindParam(':id_menu_padre', $this->id_menu_padre);
                    $stmt->bindParam(':descripcion_sub_menu', $this->descripcion_sub_menu);
                    $stmt->execute();
            
                    // Confirmar la transacción
                    $this->conn->commit();
                    return json_encode(["Success" => "Datos insertados correctamente."]);
                    
            
                } catch (Exception $e) {
                    // Revertir los cambios en caso de error
                    $this->conn->rollBack();
                    return json_encode(["Error" => "An error occurred while trying to insert the data.".$e->getMessage()]);
                }
            }else{ 
                return json_encode(["Error" => "No se puede crear el regististo el valor id_menu_padre no exisste en la relacion"]);
            }  
        }else{
            return json_encode(["Error" => "Verificar que los tipos de datos enviados sean los correctos."]);
        }
       
       
    }
    
    public function update($id_sub_menu,$nombre_sub_menu, $id_menu_padre,$descripcion_sub_menu){
        $this->id_sub_menu=$id_sub_menu;
        $this->nombre_sub_menu=$nombre_sub_menu;
        $this->id_menu_padre=$id_menu_padre;
        $this->descripcion_sub_menu=$descripcion_sub_menu;
        // Iniciar una transacción
        if($this->validateTypeData2()==true){ //validar que el tipo de daatos sea el requerido
            // Verificar si id_menu_padre existe en la BD menu_padre
            $checkExist = $this->conn->prepare("SELECT COUNT(*) FROM menu_padre WHERE id_menu_padre = :id_menu_padre");
            $checkExist->bindParam(':id_menu_padre', $this->id_menu_padre);
            $checkExist->execute();
            if ($checkExist->fetchColumn() > 0) { // return true si existe al menos un registro de ind_menu_padre - 
                try {
                    $query = "UPDATE sub_menu SET nombre_sub_menu=:nombre_sub_menu, id_menu_padre=:id_menu_padre, descripcion_sub_menu=:descripcion_sub_menu WHERE id_sub_menu=:id_sub_menu";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindValue(':nombre_sub_menu', $this->nombre_sub_menu);
                    $stmt->bindValue(':id_menu_padre', $this->id_menu_padre);
                    $stmt->bindValue(':descripcion_sub_menu', $this->descripcion_sub_menu);
                    $stmt->bindValue(':id_sub_menu', $this->id_sub_menu);
                    $stmt->execute();
                    if ($stmt->rowCount()) {
                        return json_encode(["Success"=>"Record updated successfully."]);
                    } else {
                        return json_encode(["Info"=>"No se actualizo ninguna fila."]);
                    }
                    
                } catch (PDOException $e) {
                    return json_encode(["Info" => "An error occurred while trying to insert the data.".$e->getMessage()]);
                }
            }else{
                return json_encode(["Error" => "No se puede crear el regististo el valor id_menu_padre no exisste en la relacion"]);
            }
        }else{
            return json_encode(["Error" => "Verificar que los tipos de datos enviados sean los correctos."]);
        }
    }
     
    public function delete($id_sub_menu){
        $this->id_sub_menu=$id_sub_menu;
        try {
        $query="DELETE FROM sub_menu WHERE id_sub_menu=:id_sub_menu";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sub_menu', $this->id_sub_menu, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return json_encode(["Success"=>"Record delete successfully."]);
        } else {
            return json_encode(["Info"=>"No se elimino ninguna fila."]);
        }
        } catch (PDOException $e) {
            return json_encode(["Error" => "An error occurred while trying to delete the data.".$e->getMessage()]);
        return false;
        }
    }

    private function validateTypeData(){
        if(is_numeric($this->id_menu_padre) && is_string($this->nombre_sub_menu) && is_string($this->descripcion_sub_menu)) {
                return true; //Retorna true se los datos no son de tipo string
        }else{
            return false; //Retorna true se los datos  son de tipo string
        }
            
    }
    private function validateTypeData2(){
        if (is_numeric($this->id_sub_menu) && is_string($this->nombre_sub_menu) && is_numeric($this->id_menu_padre) && is_string($this->descripcion_sub_menu)) {
                return true; //Retorna true se los datos no son de tipo string
        }else{
            return false; //Retorna true se los datos  son de tipo string
        }
            
    }
}