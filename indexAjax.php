<?php
require "logica/Producto.php";
require "logica/Marca.php";
require "logica/Persona.php";
require 'logica/Cliente.php';
$pid = base64_decode($_GET["pid"]);
include($pid);
?>