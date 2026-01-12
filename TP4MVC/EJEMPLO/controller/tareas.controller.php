<?php
require_once 'models/tareas.models.php';
require_once 'view/tareas.view.php';

class TareasController {
    private $model;
    private $view;

    public function __construct() {
        // En el constructor inicializamos las otras dos partes del MVC
        $this->model = new TareasModel();
        $this->view = new TareasView();
    }

    // --- ACCIÓN 1: MOSTRAR LA LISTA (Home) ---
    public function showTareas() {
        // 1. Pide datos al Modelo (Slide 27)
        $tareas = $this->model->getTareas();

        // 2. Manda los datos a la Vista para renderizar
        $this->view->mostrarTareas($tareas);
    }

    // --- ACCIÓN 2: AGREGAR TAREA ---
    public function addTarea() {
        // Verificamos que vengan los datos del formulario
        if (!empty($_POST['titulo']) && !empty($_POST['descripcion'])) {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $finalizada = 0;

            // Le decimos al modelo que guarde
            $this->model->insertarTarea($titulo, $descripcion, $finalizada);
            
            // Redireccionamos al home (asumiendo que el router maneja 'home')
            header("Location: home"); 
        } else {
            // Si faltan datos, también volvemos
            header("Location: " . BASE_URL);
        }
    }

    // --- ACCIÓN 3: BORRAR TAREA ---
    public function removeTarea($id) {
        $this->model->borrarTarea($id);
        header("Location: " . BASE_URL);
    }

    // --- ACCIÓN 4: FINALIZAR TAREA ---
    public function finishTarea($id) {
        $this->model->finalizarTarea($id);
        header("Location: " . BASE_URL);
    }
}
?>