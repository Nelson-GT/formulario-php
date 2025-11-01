<?php
    $error_registro = '';
    if (isset($_GET['error'])) {
        $error_registro = urldecode($_GET['error']);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="/styles/tailwind.js"></script>
</head>
<body class="h-screen flex flex-col items-center justify-center bg-gray-50">
    
    <form action="procesar.php" method="POST" class="flex flex-col border p-4 items-center justify-center max-w-md rounded-md shadow-lg bg-white">
        <div class="flex flex-col p-3 gap-3">
            <h2 class="text-xl font-bold text-center">Formulario de Registro</h2>
            <div class="gap-5">
                <div class="flex flex-col my-5">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required class="border p-2 rounded-md">
                </div>
                <div class="flex flex-col my-5">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" required class="border p-2 rounded-md">
                </div>
                <div class="flex flex-col my-5">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required class="border p-2 rounded-md">
                </div>
                <div class="flex flex-col my-5">
                    <label for="contrasena">Repite la Contraseña</label>
                    <input type="password" id="repite_contrasena" name="repite_contrasena" required class="border p-2 rounded-md">
                </div>
            </div>
            <button type="submit" class="border border-gray-400 bg-red-500 px-4 py-2 rounded-md font-semibold text-white">Registrar</button>
        </div>
    </form>
    <div class="flex flex-col items-center justify-center mt-5">
        <a href="login.php" class="text-purple-900 hover:underline"> Ya tienes cuenta? Inicia Sesión aquí</a>
    </div>
    <script>
        const error = "<?php echo $error_registro; ?>";
        if (error.length > 0) {
            alert(error);
        }
    </script>   
</body>
</html>