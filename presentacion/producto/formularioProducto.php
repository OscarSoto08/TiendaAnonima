<?php
// formularioProducto.php

$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
$administrador = new Administrador($id);
$administrador -> consultar();

 include "presentacion/encabezado.php";
 include "presentacion/menuAdministrador.php"; 
 $success = false;

//validacion de los datos

//Uso la instancia de la clase marca y categoria para almacenar todas las marcas y categorias, las cuales se mostraran en el formulario -- DEPENDENCIAS
$marca = new Marca();
$marcas = $marca -> consultarTodos();
$categoria = new Categoria();
$categorias = $categoria -> consultarTodos();

if(isset($_POST["nuevoP"])){
//Estoy reutilizando las instancias declaradas previamente pero ahora para crear un nuevo producto

//Primero set del id y luego coloca el nombre
    $marca -> setIdMarca($_POST["marca"]); 
    $marca -> consultar();

    $categoria -> setIdCategoria($_POST['categoria']);
    $categoria -> consultar();

    //ahora si creo la instancia del producto
    $producto = new Producto(null, $_POST["nombre"], intval($_POST["cantidad"]), floatval($_POST["precioCompra"]), floatval($_POST["precioVenta"]), $marca, $categoria, $administrador);

    if(!$producto -> insertar()){
        $success = true;
    }

    
}

?>

<style>
#formContainer{
    margin-top: 50px;
    padding: 30px;
    border: 2px solid gray;
    border-radius: 15px;
    box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
}
</style>

<!-- Contenedor donde se cargará el formulario -->
<div class="container" id="formContainer">

<h2 class="text-center">Nuevo Producto</h2>
<form id="productoForm" method="post" class="row g-3" action="?pid=<?php echo base64_encode('presentacion/producto/formularioProducto.php');?>">
    <!-- Nombre -->
    <div class="mb-3 col-md-12">
        <label for="nombre" class="form-label">Nombre del Producto</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <!-- Precio Compra-->
    <div class="mb-3 col-md-6">
        <label for="precioCompra" class="form-label">Precio Compra</label>
        <input type="number" class="form-control" step="2000" value="10000" min="0" id="precioCompra" name="precioCompra" required>
    </div>
    <!-- Precio Venta-->
    <div class="mb-3 col-md-6">
        <label for="precioVenta" class="form-label">Precio Venta</label>
        <input type="number" class="form-control" step="2000" value="10000" min="0" id="precioVenta" name="precioVenta" required>
    </div>

    
    <!-- Marca -->
    <div class="mb-3 col-md-5">
        <label for="marca" class="form-label">Marca</label>
        <select class="form-select" name="marca" id="marca">
            <?php 
                foreach($marcas as $marcaAct){
                    echo '<option value="'. $marcaAct -> getIdMarca().'">'. $marcaAct->getNombre() . '</option>';
                }
            ?>
        </select>
    </div>
    <!-- Categoria -->
    <div class="mb-3 col-md-5">
        <label for="categoria" class="form-label">Categoria</label>
        <select class="form-select" name="categoria" id="categoria">' <?php
        foreach($categorias as $catActual){
            echo '<option value="'. $catActual -> getIdCategoria().'">'.$catActual -> getNombre().'</option>';
         }
        ?>
        </select>
    </div>
    <!-- Cantidad -->

    <div class="mb-3 col-md-2">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
    </div>

    <div class="m-3 text-center">
        <button type="submit" name="nuevoP" class="btn btn-primary">Agregar Producto</button>
    </div>
    <?php 
    if($success){?>
        
        <div class="alert alert-success text-center" role="alert">
            El producto: <?php echo $producto -> getNombre()?>, se ha agregado satisfactoriamente con ID: <?php echo $producto -> getIdProducto() ?>
        </div>    
    <?php } ?>
</div>

