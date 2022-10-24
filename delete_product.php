<?php
@session_start();
require_once "controller/Controller.php";

$resultado = $_SESSION['user'];
if ($resultado == null) {
    header("Location:login.php");
}
$idproducto=$_GET['delete_id'];
echo "$idproducto";
 
$conexion = Conexion::connection();
        
$sql = "DELETE FROM productos WHERE IdProducto='$idproducto' ";

$stmt = $conexion->prepare($sql);

header("location:View_Products.php");

$stmt->execute();


?>