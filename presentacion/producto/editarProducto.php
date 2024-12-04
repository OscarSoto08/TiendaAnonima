<?php
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
if(isset($_POST["editar"])){
    $producto = new Producto($_GET["idProducto"], $_POST["nombre"], $_POST["cantidad"], $_POST["precioCompra"], $_POST["precioVenta"]);
    $producto -> editar();
}else{
    $producto = new Producto($_GET["idProducto"]);
    $producto -> consultar();    
}
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Editar Producto</h4>
				</div>
				<div class="card-body">
				
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/producto/editarProducto.php")?>&idProducto=<?php echo $_GET["idProducto"] ?>">
						<div class="mb-3">
							<input type="text" name="nombre" class="form-control"
								placeholder="Nombre" value="<?php echo $producto -> getNombre() ?>" required>
						</div>
						<div class="mb-3">
							<input type="number" name="cantidad" class="form-control"
								placeholder="Cantidad" value="<?php echo $producto -> getCantidad() ?>" required>
						</div>
						<div class="mb-3">
							<input type="number" name="precioCompra" class="form-control"
								placeholder="Precio Compra" value="<?php echo $producto -> getPrecioCompra() ?>" required>
						</div>
						<div class="mb-3">
							<input type="number" name="precioVenta" class="form-control"
								placeholder="Precio Venta" value="<?php echo $producto -> getPrecioVenta() ?>" required>
						</div>
						<button type="submit" name="editar" class="btn btn-primary">Editar Producto</button>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>