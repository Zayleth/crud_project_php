<?php 
if (isset($_GET['id'])){
	include('clases.php');
	$cliente = new Database();
	$id=intval($_GET['id']);
	$res = $cliente->delete($id);
	if($res){
		header('location: principal.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>