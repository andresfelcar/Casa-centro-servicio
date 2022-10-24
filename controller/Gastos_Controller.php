<?php
require_once "model/Conexion.php";

//$conexion = mysqli_connect('localhost', 'root', '', 'appWeb');

class Gastos_Controller
{

    private function __construct()
    {
    }

    public static function Main($option, $array = [])
    {
        $products = new Gastos_Controller();
        switch ($option) {
            case 0:
                $result = $products->Consult($array);
                break;
            case 1:
                $result = $products->Insert($array);
                break;
            case 2:
                $result = $products->Update($array);
                break;
            case 3:
                $result = $products->Delete($array);
                break;
        }
        return $result;
    }

    public function Consult($array)
    {
        $conexion = Conexion::connection();
        if ($array == null) {
            $sql = "SELECT IdGasto,NombreGasto,Fecha,TotalGasto,codigoF from gastos"; 
            return $conexion->query($sql);
        }
        $conexion = Conexion::connection();

        $conexion = Conexion::connection();
        $sql2="SELECT SUM(Total) FROM facturas WHERE Fecha BETWEEN '$array[0]' AND '$array[1]'";
        $result1 = $conexion->query($sql2);
        $result1 = $result1->fetch_row();

        $sql2="SELECT SUM(TotalGasto) FROM gastos WHERE Fecha BETWEEN '$array[0]' AND '$array[1]'";
        $result = $conexion->query($sql2);
        $result = $result->fetch_row();
 
        $utilidad=$result1[0]-$result[0];

        echo "<h5>Gastos de la Empresa Entre las Fechas: $ $result[0] </h5>
              <h5>Ventas de la Empresa Entre las Fechas: $ $result1[0] </h5>
              <h5>Utilidades de la Empresa Entre las Fechas: $ $utilidad
              
              ";


        
    }
    public function Insert($array)
    {
       
        //conexion
        $conexion = Conexion::connection();
        //consulta
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d', time());
        $sql = "INSERT INTO gastos(NombreGasto,Fecha,TotalGasto,CodigoF) VALUES (?,'$date',?,?)";
        //preparamos la consulta
        $stmt = $conexion->prepare($sql);
        // añadimos los parametros ("tipo de dato s= string, i= entero, d=double",$Variables en su lugar correspondiente con los ?)
        $stmt->bind_param("sdi", $array[0],$array[1],$array[2]);
        //ejecutamos el stmt
        $stmt->execute();

        return $conexion->query($sql);
    }

    public function Update($array)
    {

        $conexion = Conexion::connection();
        $sql = "UPDATE productos SET Cantidad=?,Nombre=?,Precio=? WHERE idProducto=?";
        $stmt = $conexion->prepare($sql);
        // añadimos los parametros ("tipo de dato s= string, i= entero, d=double",$Variables en su lugar correspondiente con los ?)
        $stmt->bind_param("isdi", $array[3],$array[1],$array[2], $array[0]);
        //ejecutamos el stmt
        $stmt->execute();


        return $conexion->query($sql);
    }

    public function Delete($array)
    {
        $conexion = Conexion::connection();
        
        $sql = "DELETE FROM productos WHERE IdProducto=? ";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("i",$array[0]);
        
        $stmt->execute();

    }
}
