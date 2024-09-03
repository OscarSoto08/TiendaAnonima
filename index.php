<?php 
require ("logica/Producto.php");

$producto = new Producto();
$productos = $producto -> consultarTodos();

foreach ($productos as $productoActual){
    echo $productoActual -> getIdProducto() . ", ";
    echo $productoActual -> getNombre() . ", ";
    echo $productoActual -> getCantidad() . ", ";
    echo $productoActual -> getPrecioVenta() . ", ";
    echo "<br>";
}

?>