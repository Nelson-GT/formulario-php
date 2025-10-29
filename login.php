<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="/styles/tailwind.js"></script>
</head>
<body class="h-screen flex flex-col items-center justify-center">
    <form action="login_logic.php" method="POST" class="flex flex-col border p-4 items-center justify-center max-w-md rounded-md shadow-lg">
        <div class="flex flex-col p-3 gap-3">
            <h2 class="text-xl font-bold text-center">Iniciar Sesión</h2>
            <div class="gap-5">
                <div class="flex flex-col my-5">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" name="correo" required class="border p-2 rounded-md">
                </div>
                <div class="flex flex-col my-5">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required class="border p-2 rounded-md">
                </div>
            </div>
            <button type="submit" class="border border-gray-400 bg-red-500 px-4 py-2 rounded-md font-semibold text-white">Iniciar Sesión</button>
        </div>
    </form>
    
    <div class="flex flex-col items-center justify-center mt-5">
        <a href="index.php" class="text-purple-900 hover:underline text-center"> Aún no tienes cuenta?<br>Registrate aquí</a>
    </div>
</body>
</html>