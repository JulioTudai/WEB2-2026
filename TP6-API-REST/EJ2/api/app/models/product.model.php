
<?php
// Asegúrate de que config.php esté disponible si usas las constantes ahí,
// o que el controller ya lo haya cargado.
require_once 'config.php';

class ProductModel {
    private $db;

    public function __construct() {
        // Conectamos a la base de datos usando las constantes definidas en config.php
        $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
        // Configuramos para que lance errores si algo falla en SQL
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Obtiene todos los productos de la tabla.
     */
    public function getAll() {
        // Preparamos la consulta
        $query = $this->db->prepare("SELECT * FROM productos");
        $query->execute();

        // Devolvemos un arreglo de objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene un producto específico por ID.
     */
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $query->execute([$id]);

        // Devuelve el objeto o false si no existe
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Inserta un nuevo producto.
     * Retorna el ID del último producto insertado.
     */
    public function insert($nombre, $descripcion, $precio, $oferta) {
        $query = $this->db->prepare("INSERT INTO productos (nombre, descripcion, precio, oferta) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $descripcion, $precio, $oferta]);

        // Retornamos el ID generado automáticamente
        return $this->db->lastInsertId();
    }

    /**
     * Modifica un producto existente.
     */
    public function update($id, $nombre, $descripcion, $precio, $oferta) {
        $query = $this->db->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, oferta = ? WHERE id_producto = ?");
        $query->execute([$nombre, $descripcion, $precio, $oferta, $id]);
    }

    /**
     * Elimina un producto por ID.
     */
    public function remove($id) {
        $query = $this->db->prepare("DELETE FROM productos WHERE id_producto = ?");
        $query->execute([$id]);
    }
}
?>