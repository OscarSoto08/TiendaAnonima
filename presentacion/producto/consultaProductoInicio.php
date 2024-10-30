<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Tienda Anonima</h4>
				</div>
				<div class="card-body">
    					<?php
        $i = 0;
        $producto = new Producto();
        $productos = $producto->consultarTodos();
        foreach ($productos as $productoActual) {
            if ($i % 4 == 0) {
                echo "<div class='row mb-3'>";
            }
            echo "<div class='col-lg-3 col-md-4 col-sm-6' >";
            echo "<div class='card text-bg-light'>";
            echo "<div class='card-body'>";
            echo "<div class='text-center'><img src='https://icons.iconarchive.com/icons/custom-icon-design/mono-general-1/256/faq-icon.png' width='70%' /></div>";
            echo "<a href='#'>" . $productoActual->getNombre() . "</a><br>";
            echo "Cantidad: " . $productoActual->getCantidad() . "<br>";
            echo "Valor: $" . $productoActual->getPrecioVenta() . "<br>";
            echo "Marca: " . $productoActual->getMarca()->getNombre() . "<br>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            if ($i % 4 == 3) {
                echo "</div>";
            }
            $i ++;
        }
        if ($i % 4 != 0) {
            echo "</div>";
        }
        ?>
					</div>
			</div>
		</div>
	</div>
</div>