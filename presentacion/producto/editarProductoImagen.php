<?php
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));
}
$error = 0;
if(isset($_POST["editar"])){    
    $nombre = $_FILES["imagen"]["name"];
    $extension = pathinfo($nombre, PATHINFO_EXTENSION);
    $extensiones = array('jpg','png','jpeg');
    if(in_array($extension, $extensiones)){
        $tam = $_FILES["imagen"]["size"] / 1024;
        if($tam < 150){
            $rutaLocal = $_FILES["imagen"]["tmp_name"];
            $rutaServidor = "imagenes/";
            $nombreImagen = time() . "." . $extension;
            $producto = new Producto($_GET["idProducto"]);
            $producto -> consultar();
            if($producto -> getImagen() != ""){
                unlink($rutaServidor . $producto -> getImagen());
            }
            copy($rutaLocal, $rutaServidor . $nombreImagen);
            $producto = new Producto($_GET["idProducto"], "", 0, 0, 0, $nombreImagen);
            $producto -> editarImagen();
            
        }else{
            $error = 2;
        }
    }else{
        $error = 1;
    }    
    
}
$producto = new Producto($_GET["idProducto"]);
$producto -> consultar();
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
?>
<div class="container">
	<div class="row mt-5">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Editar Imagen del Producto <br><?php echo $producto -> getNombre()?></h4>
				</div>
				<div class="card-body">
    				<?php 
    				if (isset($_POST["editar"])) { 
    				    if($error == 0){
    				        echo "<div class='alert alert-success mt-3' role='alert'>Imagen editada</div>";
    				    }else if($error == 1){
    				        echo "<div class='alert alert-danger mt-3' role='alert'>Tipo de imagen no permitido</div>";
    				    }else if($error == 2){
    				        echo "<div class='alert alert-danger mt-3' role='alert'>Tamaño de imagen no permitido</div>";
    				    }
    				}    				    
    				?>
					<form method="post"
						action="?pid=<?php echo base64_encode("presentacion/producto/editarProductoImagen.php")?>&idProducto=<?php echo $_GET["idProducto"] ?>"
						enctype="multipart/form-data">
						<div class="mb-3">
							<input type="file" name="imagen" class="form-control"
								placeholder="Nombre" value="<?php echo $producto -> getNombre() ?>" required>
						</div>
						<button type="submit" name="editar" class="btn btn-primary">Editar Producto</button>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>