<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $repite_contrasena = $_POST['repite_contrasena'] ?? '';
    $correo = strtolower($correo);
    if (empty(trim($nombre)) || empty(trim($correo)) || empty(trim($contrasena)) || empty(trim($repite_contrasena))) {
        die("Error: Completa todos los campos para registrarte. <a href='index.php'>Volver</a>");
    }

    $correo_dividido = explode("@", $correo);
    $correo_dividido2 = explode(".",$correo_dividido[1]);
    if (strlen($correo_dividido[0]) < 4 || strlen($correo_dividido2[0]) < 3 || strlen($correo_dividido2[1]) < 2) {
        die("Error: Formato de correo incorrecto<br><a href='index.php'>Volver</a>");
        exit;
    }

    if ($repite_contrasena != $contrasena) {
        die("Error: Ambas contraseñas deben ser iguales.<br><a href='index.php'>Volver</a>");
        exit;
    }
    
    if (strlen($contrasena) < 4) {
        die("Error: Tu contraseña debe ser más larga.<br><a href='index.php'>Volver</a>");
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
            die("El correo introducido no es válido, intente con otro.<br><a href='index.php'>Volver</a>");
            exit;
        }
    }
    $usuarios[] = $nuevo_usuario;
    $json_data = json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if (file_put_contents($archivo_json, $json_data)) {
        echo 'Registro exitoso.<br><a href="login.php">Iniciar Sesión</a>';
    } else {
        echo "Error: No se pudo escribir en el archivo. Cambiate a Windows.";
    }
} else {
    header("Location: index.php");
    exit;
}
?>