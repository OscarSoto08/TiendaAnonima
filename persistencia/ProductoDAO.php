<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $imagen;
    
    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $imagen=""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> imagen = $imagen;
    }
    
    public function consultar(){
        return "select nombre, cantidad, precioCompra, precioVenta, imagen
                from Producto
                where idProducto = '" . $this -> idProducto . "'";
    }
    
    public function editar(){
        return "update Producto
                set nombre = '" . $this -> nombre . "', cantidad = '" . $this -> cantidad . "', precioCompra = '" . $this -> precioCompra . "', precioVenta = '" . $this -> precioVenta . "'
                where idProducto = '" . $this -> idProducto . "'";
    }
    
    public function editarImagen(){
        return "update Producto
                set imagen = '" . $this -> imagen . "'
                where idProducto = '" . $this -> idProducto . "'";
    }
    
    public function consultarTodos(){
        return "select idProducto, nombre, cantidad, precioCompra, precioVenta, imagen, Marca_idMarca 
                from Producto";
    }
    
    public function buscar($filtro){
        return "select idProducto, nombre, cantidad, precioCompra, precioVenta, imagen, Marca_idMarca
                from Producto
                where nombre like '%" . $filtro . "%'";
    }
}

?>