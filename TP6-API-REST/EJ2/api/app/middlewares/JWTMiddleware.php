<?php
require_once 'libs/jwt/jwt.php'; // Asegúrate que la ruta a la librería sea correcta

class JWTMiddleware {
    public function run($request, $response) {
        $auth_header = $_SERVER['HTTP_AUTHORIZATION'] ?? null; // "Bearer un.token.firma"
        
        // Si no hay header, seguimos (el GuardMiddleware se encargará de rechazar si es necesario)
        if (!$auth_header) {
            return;
        }

        $auth_header = explode(' ', $auth_header); // ["Bearer", "un.token.firma"]
        
        // Validamos formato
        if(count($auth_header) != 2 || $auth_header[0] != 'Bearer') {
            return;
        }

        $jwt = $auth_header[1];
        
        // Validamos la firma y expiración
        $user_data = validateJWT($jwt);
        
        if ($user_data) {
            // ¡Éxito! Inyectamos el usuario en la request para que los controladores lo usen
            $request->user = $user_data;
        }
    }
}
?>