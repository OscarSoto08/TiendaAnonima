<?php
require_once ("./persistencia/Conexion.php");
require ("./persistencia/ProductoDAO.php");

class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precioCompra;
    private $precioVenta;
    private $imagen;
    private $marca;
    private $categoria;
    private $administrador;

    public function getIdProducto() {return $this->idProducto;}
    public function getNombre() {return $this->nombre; }
    public function getCantidad() {return $this->cantidad;}
    public function getPrecioCompra () {return $this->precioCompra;}
    public function getPrecioVenta () { return $this->precioVenta; }
    public function getImagen () { return $this->imagen;}
    public function getMarca(){return $this->marca;}
    public function getCategoria(){return $this->categoria;}
    public function getAdministrador(){return $this -> administrador;}

    //SETTERS

    public function setIdProducto($idProducto){ $this->idProducto = $idProducto; }
    public function setNombre($nombre){$this->nombre = $nombre;}
    public function setCantidad($cantidad){$this->cantidad = $cantidad;}
    public function setPrecioCompra($precioCompra){$this->precioCompra = $precioCompra;}
    public function setPrecioVenta($precioVenta){$this->precioVenta = $precioVenta;}
    public function setImagen($imagen){$this->imagen = $imagen;}
    public function setMarca($marca){$this -> marca = $marca;}
    public function setCategoria($categoria){ $this -> categoria = $categoria; }

    public function __construct($idProducto=0, $nombre="", $cantidad=0, $precioCompra=0, $precioVenta=0, $imagen="", $marca=null){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precioCompra = $precioCompra;
        $this -> precioVenta = $precioVenta;
        $this -> imagen = $imagen;
        $this -> marca = $marca;
    }
    
    public function consultar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO($this -> idProducto);
        $conexion -> ejecutarConsulta($productoDAO -> consultar());
        $registro = $conexion -> siguienteRegistro();
        $this -> nombre = $registro[0];
        $this -> cantidad = $registro[1];
        $this -> precioCompra = $registro[2];
        $this -> precioVenta = $registro[3];
        $this -> imagen = $registro[4];
        $conexion -> cerrarConexion();
    }
    
    public function editar(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO($this -> idProducto, $this -> nombre, $this -> cantidad, $this -> precioCompra, $this -> precioVenta);
        $conexion -> ejecutarConsulta($productoDAO -> editar());
        $conexion -> cerrarConexion();
    }

    public function editarImagen(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $productoDAO = new ProductoDAO($this -> idProducto, "", 0, 0, 0, $this -> imagen);
        $conexion -> ejecutarConsulta($productoDAO -> editarImagen());
        $conexion -> cerrarConexion();
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
            if(array_key_exists($registro[6], $marcas)){
                $marca = $marcas[$registro[6]];
            }else{
                $marca = new Marca($registro[6]);
                $marca -> consultar();
                $marcas[$registro[6]] = $marca;
            }
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $marca);
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
            if(array_key_exists($registro[6], $marcas)){
                $marca = $marcas[$registro[6]];
            }else{
                $marca = new Marca($registro[6]);
                $marca -> consultar();
                $marcas[$registro[6]] = $marca;
            }
            $producto = new Producto($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5], $marca);
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