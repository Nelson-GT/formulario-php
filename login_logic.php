<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $correo = strtolower($correo);
    if (empty(trim($correo)) || empty(trim($contrasena))) {
        $error_mensaje = urlencode("Completa todos los campos.");
        header("Location: login.php?error=" . $error_mensaje);
        exit;
    }
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $archivo_json = 'usuarios.json';
    $usuarios = [];
    if (file_exists($archivo_json)) {
        $contenido_actual = file_get_contents($archivo_json);
        if (!empty($contenido_actual)) {
            $usuarios = json_decode($contenido_actual, true);
            if (!is_array($usuarios)) {
                $usuarios = [];
            }
        }
    }
    foreach ($usuarios as $usuario) {
        if ($usuario["correo"] === $correo) {
            if (password_verify($contrasena, $usuario["contrasena"])) {
                header("Location: pagina.php");
                exit;
            } else {
                $error_mensaje = urlencode("Contraseña incorrecta, vuelve a intentarlo.");
                header("Location: login.php?error=" . $error_mensaje);
                exit;
            }
        }
    }
    $error_mensaje = urlencode("Usuario no encontrado.");
    header("Location: login.php?error=" . $error_mensaje);
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>