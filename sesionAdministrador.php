<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
		#bienvenida{
			margin-top: 50px;
		}
    </style>
</head>
<body>
<?php include ("encabezado.php");?>
<?php include "navbar.php"; ?>
    <div class="container" id="bienvenida">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">
                        <h4>Sesion Administrador</h4>
                    </div>
                    <div class="card-body">
                        <p>Bienvenido administrador <?php echo $administrador -> getNombre() . " " . $administrador -> getApellido(); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>
</html>
