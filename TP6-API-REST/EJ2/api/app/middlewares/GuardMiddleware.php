<?php
class GuardMiddleware {
    public function run($request, $response) {
       // --- LISTA BLANCA (WHITELIST) ---
        
        // 1. Si es el Login, pasar. GET (lectura), pasar
        if ($_GET['resource'] === 'auth/token' || $_SERVER['REQUEST_METHOD'] === 'GET'){
            return;
        }

        // ---------------------------------
        // 3. Chequeamos si el JWTMiddleware logró identificar al usuario
        if(!$request->user) {
            return $response->json("No autorizado (Falta token o es inválido)", 401);
        }

        // 4. Chequeamos permisos (Roles)
        // El rol viene dentro del token. En tu DB el campo es 'rol', en el token lo guardamos igual.
        if($request->user->rol !== 'ADMIN') {
            return $response->json("Prohibido: No tienes permisos de administrador", 403);
        }
        
        // Si pasa ambas, no hacemos nada y dejamos que el Router continúe.
    }
}






?>