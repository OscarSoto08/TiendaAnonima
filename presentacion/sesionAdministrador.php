<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
<<<<<<< HEAD
$administrador = new Administrador($id);
$administrador -> consultar();
include "presentacion/encabezado.php";
include "presentacion/menuAdministrador.php";
=======
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
$administrador = new Administrador($id);
$administrador -> consultar();
>>>>>>> 7a22e247bb2f1dab5db66bc4cd5f43d49c5c811a
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Sesion Administrador</h4>
				</div>
				<div class="card-body">
					<p>Bienvenido administrador <?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?></p>
				</div>
			</div>
		</div>
	</div>
</div>