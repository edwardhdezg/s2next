<?php

require_once(realpath(dirname(__FILE__) . '/../Models/Submenu.php'));

class SubmenuController{
	function __construct(){
       
    }
	// Consulta todos los datos
    public function getAll(){
    	$submenu	=	new Submenu();
		echo $submenu->getAll();
    }
    // Consulta Where
    static function getWhere($id_sub_menu){
    	$submenu	=	new Submenu();
		echo $submenu->getWhere($id_sub_menu);
		
    }

	//consulta datos foraneos de sub_menu
	static function getDataJoin(){
    	$submenu	=	new Submenu();
		echo $submenu->getDataJoin();
		
    }

	//consulta datos que sean de tipo marcas en el menu_padre
	static function getWhereMarcas(){
    	$submenu	=	new Submenu();
		echo $submenu->getWhereMarcas();
	}
		//consulta datos que sean de tipo marcas en el menu_padre
	static function getWhereCatalogos(){
    	$submenu	=	new Submenu();
		echo $submenu->getWhereCatalogos();
		
    }
    // INSERTAR
    static function insert($nombre_sub_menu, $id_menu_padre, $descripcion_sub_menu){
		$submenu	=	new Submenu();
		echo $submenu->insert($nombre_sub_menu, $id_menu_padre, $descripcion_sub_menu);
		
    }
    
	


    // ACTUALIZAR

    static function update($id_sub_menu,$nombre_sub_menu,$id_menu_padre,$descripcion_sub_menu){
    	$submenu	=	new Submenu();
    	echo $submenu->update($id_sub_menu,$nombre_sub_menu,$id_menu_padre,$descripcion_sub_menu);   
    }
    

    // ELIMINAR

	static function delete($id_sub_menu){		
		$submenu	=	new Submenu();
    	echo $submenu->delete($id_sub_menu);    
	}
}
?>