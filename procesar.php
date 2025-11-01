<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $repite_contrasena = $_POST['repite_contrasena'] ?? '';
    $correo = strtolower($correo);
    if (empty(trim($nombre)) || empty(trim($correo)) || empty(trim($contrasena)) || empty(trim($repite_contrasena))) {
        $error_mensaje = urlencode("No deben haber campos vacíos.");
        header("Location: index.php?error=" . $error_mensaje);
        exit;
    }

    $correo_dividido = explode("@", $correo);
    $correo_dividido2 = explode(".",$correo_dividido[1]);
    if (strlen($correo_dividido[0]) < 4 || strlen($correo_dividido2[0]) < 3 || strlen($correo_dividido2[1]) < 2) {
        $error_mensaje = urlencode("Formato de correo incorrecto.");
        header("Location: index.php?error=" . $error_mensaje);
        exit;
    }

    if ($repite_contrasena != $contrasena) {
        $error_mensaje = urlencode("Ambas contraseñas deben ser iguales.");
        header("Location: index.php?error=" . $error_mensaje);
        exit;
    }
    
    if (strlen($contrasena) < 4) {
        $error_mensaje = urlencode("Tu contraseña debe ser más larga (mínimo 4).");
        header("Location: index.php?error=" . $error_mensaje);
        exit;
    }
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $nuevo_usuario = [
        'nombre' => $nombre,
        'correo' => $correo,
        'contrasena' => $contrasena_hash
    ];
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
            $error_mensaje = urlencode("El correo introducido ya existe, intente con otro.");
            header("Location: index.php?error=" . $error_mensaje);
            exit;
        }
    }
    $usuarios[] = $nuevo_usuario;
    $json_data = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if (file_put_contents($archivo_json, $json_data)) {
        header("Location: login.php");
        exit;
    } else {
        $error_mensaje = urlencode("Error, no se puede escribir en el archivo, intente más tarde.");
        header("Location: index.php?error=" . $error_mensaje);
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>