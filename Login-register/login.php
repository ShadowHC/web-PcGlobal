<?php
include("bd/header.php");
session_start();

// Verificar si se envió el formulario de inicio de sesión
if (isset($_POST['IniciarSesion'])) {
    // Capturar los valores enviados por el formulario
    $usuario = mysqli_real_escape_string($conn, $_POST['Usuario']);
    $clave = $_POST['Clave']; // No se escapa la contraseña

    // Construir y ejecutar la consulta SQL para obtener la contraseña encriptada del usuario
    $sql = "SELECT usuContrasena FROM usuarios WHERE usuNombre = '$usuario'";
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontró un registro coincidente
    if (mysqli_num_rows($resultado) == 1) {
        // Obtener la contraseña encriptada de la base de datos
        $row = mysqli_fetch_assoc($resultado);
        $clave_encriptada = $row['usuContrasena'];

        // Verificar si la contraseña ingresada coincide con la contraseña encriptada
        if (password_verify($clave, $clave_encriptada)) {
            // Inicio de sesión exitoso
            $_SESSION['usuario_cliente'] = $usuario;
            // Redireccionar a la página de inicio o a cualquier otra página deseada
            header("Location: ../index.php");
            exit();
        } else {
            // Credenciales inválidas
            $mensaje_error = "Usuario o contraseña incorrectos.";
        }
    } else {
        // Credenciales inválidas
        $mensaje_error = "Usuario o contraseña incorrectos.";
    }

    // Liberar el resultado y cerrar la conexión
    mysqli_free_result($resultado);
    mysqli_close($conn);
}
?>

<!-- Resto del código HTML -->

<body class="bg-gray-200">
  <div class="mt-16">
  <div id="alerta" class="mx-auto w-full py-4 px-3 sm:w-1/2 font-medium text-center alert alert-danger d-none fade show my-5 rounded-md border border-2" role="alert"></div>
    <div class="max-w-sm mx-auto bg-white p-6 shadow-lg rounded-md mt-18">
        <h2 class="text-2xl mb-6 text-center">INICIAR SESIÓN</h2>
        <form method="post">
            <div class="flex justify-center">
                <i class="bi bi-person text-7xl"></i>
            </div>
            <div class="grid grid-cols-1 gap-6 mt-3">
                <div>
                    <input placeholder="Usuario" type="text" id="Usuario" name="Usuario" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
                </div>
                <div class="input-group">
                    <input placeholder="Clave" type="password" id="Clave" name="Clave" class="border border-gray-300 rounded-md px-3 py-2 w-72">
                    <span class="input-group-text bg-white cursor-pointer"><a class="hover:text-black " onclick="mostrarContrasena()"><i class="bi bi-eye-fill"></i></a></span>
                </div>
            </div>
            <div class="Cuenta mt-4 flex justify-between items-center">
                <input class="button bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md" type="submit" value="Iniciar sesión" name="IniciarSesion">
                <a href="registrar.php" class="text-blue-500 font-semibold"><i class="bi bi-door-open"></i>Crear cuenta</a>
            </div>
        </form>
    </div>
    <div>
        <?php if(isset($_SESSION['mensaje_register_successful'])){?>
            <div class="mx-auto w-full sm:w-1/2 font-medium text-center alert alert-success alert-dismissible fade show my-5" role="alert">
                <i class="bi bi-check-lg"></i> <?= $_SESSION['mensaje_register_successful'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        <?php unset($_SESSION['mensaje_register_successful']); } ?>        
    </div>

    <script>
        function mostrarContrasena() {
            var campoContrasena = document.getElementById("Clave");
            if (campoContrasena.getAttribute("type") === "password") {
                campoContrasena.setAttribute("type", "text");
            } else {
                campoContrasena.setAttribute("type", "password");
            }
        }

        <?php if (isset($mensaje_error)): ?>
            document.getElementById('alerta').innerText = "<?php echo $mensaje_error; ?>";
            document.getElementById('alerta').classList.remove('d-none');
        <?php endif; ?>
    </script>

</body>

</html>


