
<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if($rol != "A"){
    header("Location: ?pid=" . base64_encode("presentacion/sinPermiso.php"));    
}
$administrador = new Administrador($id);
$administrador -> consultar();
include "presentacion/encabezado.php";
include "presentacion/menuAdministrador.php";

$cliente = new Cliente();
$clientes = $cliente -> consultarTodos();

$x_mark = '<i class="fa-regular fa-circle-xmark"></i>';
$check = '<i class="fa-regular fa-circle-check"></i>';
?>
<style>
    .fa-regular{
        color: red;
        font-size: 24px;
    }
    td, th{
        text-align: center;
    }

    .fa-circle-xmark{ color: red; }
    .fa-circle-check{ color: green; }
</style>
<div class="container">
	<div class="row mb-3">
		<div class="col">
			<div class="card border-primary">
				<div class="card-header text-bg-info">
					<h4>Lista de Clientes</h4>
				</div>
				<div class="card-body">
					<div class="row">
                        <!-- <h1>Aqui se hará la paginación</h1> -->
                        <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <?php
                        foreach($clientes as $clienteActual){
                            echo "<tr>";
                            echo "<td>".$clienteActual->getIdPersona()."</td>";
                            echo "<td>".$clienteActual -> getNombre()."</td>";
                            echo "<td>".$clienteActual -> getApellido()."</td>";
                            echo "<td>".$clienteActual -> getCorreo()."</td>";
                            $icono = $clienteActual -> getEstado() == '1' ? $check : $x_mark; //Asigna el icono correspondiente a la variable icono dependiendo de lo que provenga de la bd
                            echo "<td>\r\n<a href='#' class='cambioEstado '>$icono</a>\r\n</td>";
                            echo "</tr>";
                        }   
                        ?>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$('.cambioEstado').click(function(e){
    e.preventDefault();
    // let icono = $(this).children()
    // let esActivo = false
    // if(icono.hasClass('fa-circle-xmark')) {
    //     esActivo = false
    // }else{
    //     //? Significa que el usuario está activo
    //     esActivo = true
    // }

    //? buscar el ID
    let fila = $(this).closest('tr').first(); // Select the first row
    let id = fila.find('td:first').text();

    url = 'indexAjax.php?pid=<?php echo base64_encode('presentacion/cliente/cambiarEstadoAjax.php') . "&idCliente="; ?>' + id;

    console.log(url);
    $(this).first().load(url)
})
</script>

