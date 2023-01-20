<?php

class Connection{

       /* Properties */
    private $conn;
    private $dsn = 'mysql:dbname=catalogo;host=127.0.0.1';
    private $user = 'root';
    private $password = '';
    /* Creates database connection */


    function __construct(){
        try
            {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
            }

        catch(PDOException $e)
            {
            print "Error!: " . $e->getMessage() . "";
            die();
            }

    return $this->conn;
    }

    public function getmyDB(){
        if ($this->conn instanceof PDO)
            {
            return $this->conn;
            }
    }

}

$conexion=new Connection();
$conexion->getmyDB();
?>