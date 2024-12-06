<?php 
$filtro = $_GET["filtro"];
$filtro = urldecode($filtro);
$producto = new Producto();
$productos = $producto -> buscar($filtro);
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">		
			<?php 
<<<<<<< HEAD
		if(count($productos) > 0){
		    echo "<table class='table table-striped table-hover'>";
			echo "<tr>";
			echo "<th>Marca</th>";
			echo "<th>Nombre</th>";
			echo "<th>Cantidad</th>";
			echo "<th>Precio</th>";
			echo "</tr>";
			
			foreach ($productos as $productoActual){
			    echo "<tr>";
			    echo "<td>" . $productoActual -> getMarca() -> getNombre() . "</td>";
			    echo "<td>" . str_ireplace($filtro, "<strong>" . substr($productoActual -> getNombre(), stripos($productoActual -> getNombre(),$filtro), strlen($filtro)) . "</strong>", $productoActual -> getNombre()) . "</td>";
			    echo "<td>" . $productoActual -> getCantidad() . "</td>";
			    echo "<td>" . $productoActual -> getPrecioVenta() . "</td>";
			    echo "</tr>";
=======
			if(count($productos) > 0){
                echo "<table class='table table-striped table-hover'>";
				echo "<tr>";
				echo "<th>Marca</th>";
				echo "<th>Nombre</th>";
				echo "<th>Cantidad</th>";
				echo "<th>Precio</th>";
				echo "<th>Imagen</th>";
				echo "<th></th>";
				echo "</tr>";
				
				foreach ($productos as $productoActual){
				    echo "<tr>";
				    echo "<td>" . $productoActual -> getMarca() -> getNombre() . "</td>";
				    echo "<td>" . str_ireplace($filtro, "<strong>" . substr($productoActual -> getNombre(), stripos($productoActual -> getNombre(), $filtro), strlen($filtro)) . "</strong>", $productoActual -> getNombre()) . "</td>";
				    echo "<td>" . $productoActual -> getCantidad() . "</td>";
				    echo "<td>" . $productoActual -> getPrecioVenta() . "</td>";
				    echo "<td>" . (($productoActual -> getImagen() != "")?"<img src='imagenes/" . $productoActual -> getImagen() . "' height='50px' />":"") . "</td>";
				    echo "<td><a href='?pid=" . base64_encode("presentacion/producto/editarProducto.php") . "&idProducto=" . $productoActual -> getIdProducto() ."'><i class='fas fa-edit'></i></a> 
                              <a href='?pid=" . base64_encode("presentacion/producto/editarProductoImagen.php") . "&idProducto=" . $productoActual -> getIdProducto() ."'><i class='fas fa-image'></i></a></td>";
				    echo "</tr>";
				}
				echo "</table>";
			} else {
			    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
>>>>>>> 7a22e247bb2f1dab5db66bc4cd5f43d49c5c811a
			}
			echo "</table>";
		} else {
		    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
		}
			?>
		</div>
	</div>
</div>