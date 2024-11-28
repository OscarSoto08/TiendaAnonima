<?php 
$id = $_GET["idCliente"] ?? '';
$cliente = new Cliente($id);
$cliente -> consultar();

$nombre = $cliente -> getNombre();
$apellido = $cliente -> getApellido();
$correo = $cliente -> getCorreo();


$x_mark = '<i class="fa-regular fa-circle-xmark"></i>';
$check = '<i class="fa-regular fa-circle-check"></i>';

//Aca necesito saber cual es el antiguo y nuevo estado
$estadoViejo = $cliente -> getEstado();
$estadoNuevo = $estadoViejo == '1' ? '0' : '1'; //Si el estado es 1 ahora pasa a ser 0, si es 0 pasa a ser 1
//? Cambio de estado
$cliente -> setEstado($estadoNuevo);
$cliente -> cambiarEstado();

$icono = $estadoNuevo == '1' ? $check : $x_mark;

echo $icono;




