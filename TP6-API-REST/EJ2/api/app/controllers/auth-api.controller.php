<?php
require_once 'app/models/user.model.php';
require_once 'libs/jwt/jwt.php';

class AuthApiController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function getToken($req, $res) {
        // 1. Obtener el header Authorization
        $auth = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        
        // Si no viene el header o no empieza con "Basic "
        if (!$auth || strpos($auth, 'Basic ') !== 0) {
            return $res->json("No autorizado (Falta header Authorization)", 401);
        }

        // 2. Decodificar el header: "Basic base64(user:pass)"
        // Quitamos "Basic " y decodificamos
        $credentials = base64_decode(substr($auth, 6));
        
        // Separamos usuario y contraseña
        $parts = explode(':', $credentials);
        if (count($parts) != 2) {
            return $res->json("Formato de credenciales inválido", 401);
        }

        $email = $parts[0];
        $password = $parts[1];

        // 3. Verificar usuario en la base de datos
        $user = $this->model->getByEmail($email);

        // Si el usuario no existe O la contraseña no coincide
        if (!$user || !password_verify($password, $user->pasword)) {
            return $res->json("Usuario o contraseña incorrectos", 401);
        }

        // 4. Generar el Token (JWT)
        // Definimos qué rol tendrá (si la base tiene columna rol, usamos esa)
        // Si no, podemos usar un valor por defecto o lógica custom.
        $rol = $user->rol ?? 'USER'; // Si es null, asumimos USER

        $tokenData = [
            'sub' => $user->id_usuario,
            'email' => $user->email,
            'rol' => $rol,
            'iat' => time(),             // Emitido ahora
            'exp' => time() + 3600       // Expira en 1 hora
        ];

        $token = createJWT($tokenData);

        // 5. Devolver el token
        return $res->json(['token' => $token], 200);
    }
}
?>