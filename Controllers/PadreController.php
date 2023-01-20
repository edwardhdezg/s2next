<?php

require_once(realpath(dirname(__FILE__) . '/../Models/Padre.php'));

class PadreController{
	

	// Consulta todos los datos
    public function getAll(){
    	$padre 	=	new Padre();
		echo $padre->getAll();
    }
    // Consulta Where
    static function getWhere($id_menu_padre){
    	$padre 	=	new Padre();
		echo $padre->getWhere($id_menu_padre);
		
    }

    // INSERTAR
    static function insert($nombre_menu_padre){
		$padre 	=	new Padre();
		echo $padre->insert($nombre_menu_padre);
		
    }
    
	// CONULTAR NOMBRE DE MENU PADRE
    static function getName(){
    	$padre 	=	new Padre();
		echo $producto->getName();
    }


    // ACTUALIZAR

    static function update($id_menu_padre,$nombre_menu_padre){
    	$padre 	=	new Padre();
    	echo $padre->update($id_menu_padre,$nombre_menu_padre);   
    }
    

    // ELIMINAR

	static function delete($id_menu_padre){		
		$padre 	=	new Padre();
    	echo $padre->delete($id_menu_padre);    
	}
}
?>