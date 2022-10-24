<?php
@session_start();
$resultado = $_SESSION['user'];
if ($resultado == null) {
	header("Location:login.php");
}

?>
<!--validacion de inicio de sesion-->
<ul class="nav navbar-nav">
	<li class="dropdown">
		<button class="btn btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><strong>Menu de Usuario</strong>
			<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="View_Invoice.php"><strong>Lista de Facturas</strong></a></li>
			<li><a href="Create_Invoice.php"><strong>Crear Factura</strong></a></li>
			<li><a href="Clientes.php"><strong>Clientes</strong></a></li>
			<?php
			if($resultado[9]==1){
				echo '<li><a href="Empleados.php"><strong>Vendedores</strong></a></li>';
				echo '<li><a href="View_Products.php"><strong>Productos</strong></a></li>';
				echo '<li><a href="View_Ranking.php"><strong>Ventas</strong></a></li>';
				echo '<li><a href="View_ProductsDay.php"><strong>Productos del día</strong></a></li>';
				echo '<li><a href="View_Comision.php"><strong>Comisiones</strong></a></li>';
				echo '<li><a href="gastos.php"><strong>Gastos</strong></a></li>';
			}
			?>
		</ul>
	</li>
	<li class="dropdown dr">
		<button class="btn btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><strong>Conectado: <?php echo $resultado[1]; ?></strong>
			<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="Salir.php">Salir</a></li>
		</ul>
	</li>
</ul>
<br /><br /><br /><br />