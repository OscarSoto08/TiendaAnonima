<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $marca;
    private $categoria;
    private $administrador;
    
    public function setIdProducto($idProducto){ $this -> idProducto=$idProducto;}
    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $marca= null, $categoria= null, $administrador = null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this ->marca = $marca;
        $this->categoria = $categoria;
        $this -> administrador = $administrador;
    }
    
    public function consultarTodos(){
        return "select idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca 
                from Producto";
    }
    
    public function buscar($filtro){
        return "select idProducto, nombre, cantidad, precioCompra, precioVenta, Marca_idMarca
                from Producto
                where nombre like '%" . $filtro . "%'";
    }
    public function maxIdProducto(){
        return 
        "SELECT max(idProducto) 
        FROM Producto";
    }

    public function insertar(){
        return 
        "INSERT INTO `Producto`(`idProducto`, `nombre`, `cantidad`, `precioCompra`, `precioVenta`, `Marca_idMarca`, `Categoria_idCategoria`, `Administrador_idAdministrador`) VALUES ('".$this -> idProducto. "','".$this -> nombre."','".$this ->cantidad."','".$this -> precioCompra."','".$this -> precioVenta ."','". $this -> marca -> getIdMarca()."','". $this -> categoria -> getIdCategoria()."','".$this -> administrador -> getIdPersona()."') 
        ";
    }
}

?>