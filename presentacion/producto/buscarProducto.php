<?php
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
include ("presentacion/encabezado.php");
include ("presentacion/menuAdministrador.php");
?>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Buscar Producto</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4"></div>
						<div class="col-4">
							<input type="text" id="filtro" class="form-control"
								placeholder="Buscar">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col">
							<div id="resultado"></div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
  $("#filtro").keyup(function(){
	filtro = $("#filtro").val();
    if (filtro.length < 3) {
		$("#resultado").html(
			"<div class='alert alert-warning mt-3' role='alert'>Ingresa al menos 3 caracteres</div>"
		);	
	}else{
	// Codifica el filtro para que sea seguro en la URL
	filtro = encodeURIComponent(filtro);
	console.log(filtro)
       url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/buscarProductoAjax.php") . "&filtro=" ?>" + filtro;
       $("#resultado").load(url);
	}
  });
});
</script>

