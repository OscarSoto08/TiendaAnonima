<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container">
		<a class="navbar-brand" href="#"><img src="img/logo2.png" width="50" /></a>
		<button class="navbar-toggler" type="button"
			data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav me-auto">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Producto</a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='#'>Nuevo Producto</a></li>
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode("presentacion/producto/buscarProducto.php")?>'>Buscar Producto</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false">Clientes</a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode('presentacion/cliente/buscarCliente.php')?>'>Buscar Clientes</a></li>
                        <li><a class='dropdown-item' href='?pid=<?php echo base64_encode('presentacion/cliente/consultarCliente.php')?>'>Consultar Clientes</a></li>
					</ul>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false"><?php echo $administrador -> getNombre() . " " . $administrador -> getApellido() ?></a>
					<ul class="dropdown-menu">
                        <li><a class='dropdown-item' href='?cerrarSesion=true'>Cerrar Sesion</a></li>
					</ul></li>
			</ul>			
		</div>
	</div>
</nav>