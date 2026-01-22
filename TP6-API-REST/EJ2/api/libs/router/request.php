<?php
class Request {
    public $body = null;
    public $params = null;
    public $query = null;
    public $user = null;

    public function __construct() {
        try {
            # lee el body de la request (JSON)
            $this->body = json_decode(file_get_contents('php://input'));
        } catch (Exception $e) {
            $this->body = null;
        }
        $this->query = (object) $_GET;
    }
}
?>