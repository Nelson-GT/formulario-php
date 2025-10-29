<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $correo = strtolower($correo);
    if (empty(trim($correo)) || empty(trim($contrasena))) {
        die("Error: Completa todos los campos para registrarte. <a href='login.php'>Volver</a>");
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
                die("Contraseña incorrecta, <a href='login.php'>vuelva a intentar</a>.<br>$contrasena_hash");
            }
        }
    }
    die("Usuario no encontrado.<br><a href='login.php'>Volver</a>.");
} else {
    header("Location: login.php");
    exit;
}
?>