<?php
require_once 'app/models/product.model.php';

class ProductApiController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    /**
     * GET /api/productos
     * Obtiene la lista completa de productos.
     */
    public function getAll($req, $res) {
        $products = $this->model->getAll();
        
        // Devolvemos el array de productos con código 200 (OK)
        return $res->json($products, 200);
    }

    /**
     * GET /api/productos/:id
     * Obtiene un producto específico.
     */
    public function getOne($req, $res) {
        // El router parsea la URL y nos deja el ID en params
        $id = $req->params->id;

        $product = $this->model->get($id);

        // Si no existe, devolvemos 404
        if (!$product) {
            return $res->json("El producto con el id=$id no existe", 404);
        }

        return $res->json($product, 200);
    }

    /**
     * DELETE /api/productos/:id
     * Elimina un producto.
     */
    public function delete($req, $res) {
        $id = $req->params->id;

        // 1. Verificamos que exista antes de borrar
        $product = $this->model->get($id);
        if (!$product) {
            return $res->json("El producto con el id=$id no existe", 404);
        }

        // 2. Lo borramos
        $this->model->remove($id);

        // 3. Devolvemos confirmación (puede ser 200 con mensaje o 204 sin contenido)
        return $res->json("Producto eliminado correctamente", 200);
    }

    /**
     * POST /api/productos
     * Crea un nuevo producto.
     * Espera un JSON en el body con: { nombre, descripcion, precio, oferta }
     */
    public function create($req, $res) {
        // 1. Validamos datos obligatorios
        if (empty($req->body->nombre) || empty($req->body->precio)) {
            return $res->json('Faltan datos obligatorios (nombre, precio)', 400);
        }

        // 2. Obtenemos los datos. Usamos operadores ternarios para los opcionales
        $nombre = $req->body->nombre;
        $precio = $req->body->precio;
        $descripcion = $req->body->descripcion ?? null; // Si no viene, es null
        $oferta = $req->body->oferta ?? false;           // Si no viene, es false

        // 3. Insertamos en la DB
        $id = $this->model->insert($nombre, $descripcion, $precio, $oferta);

        if (!$id) {
            return $res->json("Error al insertar el producto", 500);
        }

        // 4. Buena práctica: Devolver el objeto recién creado
        $newProduct = $this->model->get($id);
        return $res->json($newProduct, 201); // 201 Created
    }

    /**
     * PUT /api/productos/:id
     * Modifica un producto existente.
     */
    public function update($req, $res) {
        $id = $req->params->id;

        // 1. Verificamos existencia
        $product = $this->model->get($id);
        if (!$product) {
            return $res->json("El producto con el id=$id no existe", 404);
        }

        // 2. Validamos datos obligatorios
        if (empty($req->body->nombre) || empty($req->body->precio)) {
            return $res->json('Faltan datos obligatorios (nombre, precio)', 400);
        }

        // 3. Tomamos los datos
        $nombre = $req->body->nombre;
        $precio = $req->body->precio;
        $descripcion = $req->body->descripcion ?? $product->descripcion; // Si no viene, mantenemos el viejo
        $oferta = isset($req->body->oferta) ? $req->body->oferta : $product->oferta;

        // 4. Actualizamos
        $this->model->update($id, $nombre, $descripcion, $precio, $oferta);

        // 5. Devolvemos el producto actualizado
        $updatedProduct = $this->model->get($id);
        return $res->json($updatedProduct, 200);
    }

    /**
     * Ruta por defecto cuando no se encuentra el endpoint
     */
    public function show404($req, $res) {
        return $res->json("La URL solicitada no existe. Revisa el endpoint.", 404);
    }
}
?>