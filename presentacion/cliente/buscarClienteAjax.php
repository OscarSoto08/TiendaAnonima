<?php 
$filtro = urldecode($_GET['filtro']);
$cliente = new Cliente();
$Clientes = $cliente -> filtrar($filtro);

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
        <?php if(!$Clientes){ 
        echo "<div class='alert alert-danger mt-3' role='alert'>Cliente no encontrado</div>";
        } else { 
            echo "<table class='table table-striped table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Estado</th>
                </tr>"; 
            foreach( $Clientes as $ClienteActual ) {
                $id = $ClienteActual->getIdPersona();
                $nombre = $ClienteActual -> getNombre();
                $apellido = $ClienteActual -> getApellido();
                $correo = $ClienteActual -> getCorreo();

                echo "<tr>";
                //id cliente
                echo "<td id=".$ClienteActual -> getIdPersona() .">". str_ireplace(
                    $filtro, 
                    "<strong>".substr(
                        $id,
                        stripos($id, $filtro),
                        strlen($filtro)
                    )."</strong>", 
                    $id) 
                    ."</td>";

                //Nombre
                echo "<td>". str_ireplace(
                    $filtro, 
                    "<strong>".substr(
                        $nombre,
                        stripos($nombre, $filtro),
                        strlen($filtro)
                    )."</strong>", 
                    $nombre) 
                    ."</td>";
                
                //Apellido
                echo "<td>". str_ireplace(
                    $filtro, 
                    "<strong>".substr(
                        $apellido,
                        stripos($apellido, $filtro),
                        strlen($filtro)
                    )."</strong>", 
                    $apellido) 
                    ."</td>";

                //Correo
                echo "<td>". str_ireplace(
                    $filtro, 
                    "<strong>".substr(
                        $correo,
                        stripos($correo, $filtro),
                        strlen($filtro)
                    )."</strong>", 
                    $correo) 
                    ."</td>";
                $icono = $ClienteActual -> getEstado() == '1' ? $check : $x_mark; //Asigna el icono correspondiente a la variable icono dependiendo de lo que provenga de la bd
                echo "<td>
                        <a href='#' class='cambioEstado '>". $icono . "</a>
                      </td>";

                echo "</tr>";
            } 
            echo "</table>";
        } ?>          
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