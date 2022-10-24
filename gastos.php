<?php
@session_start();
require_once "controller/Controller.php";
//validacion admin
$resultado = $_SESSION['user'];
if ($resultado == null) {
    header("location:login.php");
}
if ($resultado[9] == 2) {
    header("location:View_Invoice.php");
}

//validacion de el post definido
if (!empty($_POST['nombreGasto']) && !empty($_POST['gastoTotal'])) {

    //creamos array
    $array = [];
    //agregamos datos al array  array_push(nombre_del_array,Variable1,varable2,variables...);
    array_push($array, $_POST['nombreGasto'], $_POST['gastoTotal'],$_POST['codigoF']);
    //objeto para acceder al sellers
    $productos =  new Controller();

$result = $productos->Gastos(1, $array);
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="resource/css/empleados.css">
</head>

<body>


<div class="container-fluid fondo-amarillo">
   <div class="menu-usuario"><?php include('menu.php'); ?></div>
  </div>
       
      
    
    </div>
    <div class="container-fluid mt-5">
    <form action="" method="POST">
            <input type="date" name="fecha1">
            <input type="date" name="fecha2">
            <button type="submit" class="btn btn-success">Buscar</button>
        </form>
        <?php 
        if(!empty($_POST['fecha1']) && !empty($_POST['fecha2'])){

            $array=[];
            array_push($array,$_POST['fecha1'],$_POST['fecha2']);
            $productos =  new Controller();
        
        $result = $productos->Gastos(0, $array);
        }
        
        ?>
    <div class="row">
        <div class="col-md-8">

            <table class="table">
                <thead class="thead-dark ">
                    <tr>
                        <th class="letra-blanca" scope="col">Codigo</th>
                        <th class="letra-blanca" scope="col">Nombre Gasto</th>
                        <th class="letra-blanca" scope="col">Fecha</th>
                        <th class="letra-blanca" scope="col">Total Gastos</th>
                        <th class="letra-blanca" scope="col">No.Factura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $emple = new Controller();
                        $vendedores = $emple->Gastos(0);
                        while ($mostrar = $vendedores->fetch_row()) {
                        ?>

                    <tr>

                        <td>
                            <p><?php echo $mostrar[0] ?></p>
                        </td>
                        <td>
                            <p><?php echo $mostrar[1] ?></p>
                        </td>
                        <td>
                            <p><?php echo $mostrar[2] ?></p>
                        </td>
                        <td>
                            <p><?php echo $mostrar[3] ?></p>
                        </td>
                        <td>
                            <p><?php echo $mostrar[4] ?></p>
                        </td>
                        

                    </tr>
                    <?php
                        }
                        ?>

                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <form class="form_reg" action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Gasto</label>
                    <input type="text" name="nombreGasto" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gasto Total</label>
                    <input type="text" name="gastoTotal" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Ingresa el gasto">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No.Factura</label>
                    <input type="text" name="codigoF" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Ingresa el codigo">
                </div>
                
        <div class="form-group text-center">
        <button type="submit" class="btn mt-4 btn btn-primary">Registrar</button>
        </div>
        </form>
    </div>

    </div>
    </div>
    </div>
   

    </div> 

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="resource/js/invoice.js"></script>
    <script src="resource/js/produ.js"></script>
</html>
