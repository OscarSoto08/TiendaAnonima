<?php
require("fpdf/fpdf.php");
$pdf = new FPDF("P", "mm", "Letter");
$pdf -> AddPage();
$pdf -> Image("img/logo.png", 10, 10, 30);
$pdf -> SetFont('Times','BI',20);
$pdf -> SetY(20);
$pdf -> Cell(196, 10, 'Reporte de Productos', 0, 1, "C");
$pdf -> SetY(50);
$pdf -> SetFont('Times','B',14);
$pdf -> Cell(15, 10, "Id", 1, 0, "C");
$pdf -> Cell(90, 10, "Nombre", 1, 0, "C");
$pdf -> Cell(25, 10, "Cant", 1, 0, "C");
$pdf -> Cell(66, 10, "Precio V", 1, 1, "C");

$pdf -> setFont('Times', '', 12);

$objProducto = new Producto();
$productos = $objProducto -> consultarTodos();

foreach($productos as $productoAct){
    $pdf -> Cell(15, 10, $productoAct -> getIdProducto(), 1, 0, "C");

    $longitudNombre = strlen($productoAct -> getNombre());
    $pdf -> Cell(90, 10, substr($productoAct -> getNombre(), 0, 40) . (($longitudNombre > 40) ? " ..." : ""), 1, 0, "C");
    $pdf -> Cell(25, 10, $productoAct -> getCantidad(), 1, 0, "C");
    $pdf -> Cell(66, 10, $productoAct -> getPrecioVenta() , 1, 1, "C");
}

$pdf -> Output();
?>