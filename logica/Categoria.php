<?php
require "./persistencia/Conexion.php";
require "./persistencia/CategoriaDAO.php";
class Categoria{
    private $id;
    private $nombre;
    public function __construct($id = 0, $nombre = ""){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function consultarTodos(){
        $categorias = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion -> ejecutarConsulta($categoriaDAO -> consultarTodos());
        while($registro = $conexion -> siguienteRegistro()){
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($categorias, $categoria);
        }
        $conexion -> cerrarConexion();
        unset($conexion);
        return $categorias;        
    }

}
?>