<?php
@session_start();
require_once "controller/Controller.php";

$resultado = $_SESSION['user'];
if ($resultado == null) {
    header("Location:login.php");
}
if ($resultado[9] == 2) {
    header("location:View_Invoice.php");
}
$invoice =  new Controller();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comisiones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="resource/css/empleados.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid fondo-amarillo">
   <div class="menu-usuario"><?php include('menu.php'); ?></div>
  </div>
    
    <div class="container-fluid">
       
        <form action="" method="POST">
            <input type="date" name="fecha1">
            <input type="date" name="fecha2">
            <button type="submit" class="btn btn-success">Buscar</button>
        </form>

        <table id="data-table" class="table">
            <thead>
                <tr>
                    <th scope="col" class="letra-blanca" width="7%">Id Vendedor</th>
                    <th scope="col" class="letra-blanca" width="30%">Nombre</th>
                    <th scope="col" class="letra-blanca" width="15%">Comisones</th>
                </tr>
            </thead>
            <?php
            if (!empty($_POST['fecha1']) && !empty($_POST['fecha2'])) {
                $array=[];
                array_push($array,$_POST['fecha1'],$_POST['fecha2']);
                $result = $invoice->ProductsList(1,$array);
                while($resultado = $result->fetch_array()) {

                    echo "<tr>
                    <td>$resultado[0]</td>
                    <td>$resultado[1]</td>
                    <td>$resultado[2]</td>
                    </tr>";
                }
            }
            ?>

        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="resource/js/invoice.js"></script>
</body>

</html>