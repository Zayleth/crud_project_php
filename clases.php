<?php
// CRUD - POO
// CLASES FILE - FUNCIONALIDADES

// crear la conexion a la base de datos "chivo" por POO
class Database{
    // al momento de crear atributos tenemos 3 formas:
    // private
    // public
    // protected - se usa a traves de herencias
	private $con;
	private $dbhost="localhost";
	private $dbuser="root";
	private $dbpass="";
	private $dbname="chivo";
	function __construct(){
		$this->connect_db();
	}
		
    public function connect_db(){
		$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if(mysqli_connect_error()){
			die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
		}
	}

    // ANTI ATAQUE IMPORTANTE!!!!!
    // usamos funcion SANITIZE - se encarga de evitar que por un formulario te hagan ataques mediante sentencias
    // y capturar datos (si la funcion ve algun funcionamiento raro, no le da curso. AGG AL PROYECTO)

    public function sanitize($var){
        $return = mysqli_real_escape_string($this->con, $var);
        return $return;
    }

    // FUNCION ingresar datos a la base de datos
    public function create($nombres,$apellidos,$telefono,$direccion,$correo_electronico) {
        $sql = "INSERT INTO `clientes` (nombres, apellidos, telefono, direccion, correo_electronico) VALUES ('$nombres', '$apellidos', '$telefono', '$direccion', '$correo_electronico')";
        $res = mysqli_query($this->con, $sql);
        if($res) {
          return true;
        } else {
        return false;
     }
    }

    // funcion para una sentencia especifica
    public function read(){
        $sql = "SELECT * FROM clientes";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }

    // funcion para mostrar los clientes en la tabla de formulario en base al id a modificar con sus datos
    public function single_record($id){
        $sql = "SELECT * FROM clientes where id='$id'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_object($res );
        return $return ;
    }

    // funcion para actualizar datos
    public function update($nombres,$apellidos,$telefono,$direccion,$correo_electronico, $id){
        $sql = "UPDATE clientes SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', direccion='$direccion', correo_electronico='$correo_electronico' WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    // funcion o metodo para borrar 
    public function delete($id){
        $sql = "DELETE FROM clientes WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
        return true;
        }else{
        return false;
        }
    }

}

?>