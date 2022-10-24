<?php
class Conexion{

    private function __construct(){}

    //user u241751678_casacentro
    //clave BScRV=GK8>w

    public static function connection(){
        return mysqli_connect("localhost", "u241751678_casacentro", "BScRV=GK8>w", "u241751678_casacentro");
    }  
}
    
?>