<?php
require_once ("./persistencia/Conexion.php");
require ("./persistencia/ProductoDAO.php");

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $marca;
    private $categoria;
    private $administrador;

    public function getIdProducto() {return $this->idProducto;}
    public function getNombre() {return $this->nombre; }
    public function getCantidad() {return $this->cantidad;}
    public function getPrecioCompra () {return $this->precioCompra;}

    public function getPrecioVenta () {
        return $this->precioVenta;
    }
    public function getMarca(){return $this->marca;}
    public function getCategoria(){return $this->categoria;}
    public function getAdministrador(){return $this -> administrador;}

    //SETTERS

    public function setIdProducto($idProducto){$this->idProducto = $idProducto;}

    public function setNombre($nombre){$this->nombre = $nombre;}
    public function setCantidad($cantidad){$this->cantidad = $cantidad;}

    public function setPrecioCompra($precioCompra){$this->precioCompra = $precioCompra;}

    public function setPrecioVenta($precioVenta){$this->precioVenta = $precioVenta;}
    public function setMarca($marca){$this->marca = $marca;}
    public function setCategoria($categoria){$this -> categoria = $categoria; }
    public function setAdministrador($administrador){ $this->administrador = $administrador;}

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $marca=null, $categoria = null, $administrador=null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> marca = $marca;
        $this -> categoria = $categoria;
        $this -> administrador = $administrador;
    }
    
    public function consultarTodos(){
        $marcas = array();
        $productos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){
            $marca = null;
            if(array_key_exists($registro[5], $marcas)){
                $marca = $marcas[$registro[5]];
            }else{
                $marca = new Marca($registro[5]);
                $marca -> consultar();
                $marcas[$registro[5]] = $marca;
            }
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $marca);
            array_push($productos, $producto);
        }
        $conexion -> cerrarConexion();
        return $productos;        
    }
    
    
    public function buscar($filtro){
        $marcas = array();
        $productos = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO();
        $conexion -> ejecutarConsulta($productoDAO -> buscar($filtro));
        while($registro = $conexion -> siguienteRegistro()){
            $marca = null;
            if(array_key_exists($registro[5], $marcas)){
                $marca = $marcas[$registro[5]];
            }else{
                $marca = new Marca($registro[5]);
                $marca -> consultar();
                $marcas[$registro[5]] = $marca;
            }
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $marca);
            array_push($productos, $producto);
        }
        $conexion -> cerrarConexion();
        return $productos;
    }
    public function insertar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        //se instancia ya con todos los datos que conocemos y por ultimo buscamos la llave que tendrá
        $productoDAO = new ProductoDAO(null, $this -> nombre, $this -> cantidad, $this -> precioCompra, $this -> precioVenta, $this -> marca, $this -> categoria, $this -> administrador);

        //Se busca cual es la mayor llave para agregar el producto justo despues
        $conexion -> ejecutarConsulta($productoDAO -> maxIdProducto());
        $nuevaLlave = $conexion -> siguienteRegistro();
        $nuevaLlave[0] += 1;
        //Agregar mi nueva llave 
        $this -> idProducto = $nuevaLlave[0];

        $productoDAO -> setIdProducto($nuevaLlave[0]);

        //aqui es donde ejecuto mi consulta
        $conexion -> ejecutarConsulta($productoDAO -> insertar());
        $llave = $conexion -> obtenerLlaveAutonumerica();

        $conexion -> cerrarConexion();
        return ($llave == $nuevaLlave) ? true : false;
    }
}

?>