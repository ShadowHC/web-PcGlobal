<?php
include("bd/header.php");
session_start();

if (!isset($_SESSION['usuario_cliente'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['CambiarContrasena'])) {
    // Capturar los valores enviados por el formulario
    $usuario = mysqli_real_escape_string($conn, $_SESSION['usuario_cliente']);
    $clave_actual = $_POST['ClaveActual'];
    $nueva_clave = $_POST['NuevaClave'];
    $confirmar_nueva_clave = $_POST['ConfirmarNuevaClave'];

    // Obtener la contraseña encriptada actual de la base de datos
    $sql = "SELECT usuContrasena FROM usuarios WHERE usuNombre = '$usuario'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_assoc($resultado);
        $clave_encriptada_actual = $row['usuContrasena'];

        // Verificar si la contraseña actual ingresada coincide con la contraseña encriptada actual
        if (password_verify($clave_actual, $clave_encriptada_actual)) {
            // Verificar si las nuevas contraseñas coinciden
            if ($nueva_clave === $confirmar_nueva_clave) {
                // Encriptar la nueva contraseña
                $nueva_clave_encriptada = password_hash($nueva_clave, PASSWORD_BCRYPT);

                // Actualizar la contraseña en la base de datos
                $sql_update = "UPDATE usuarios SET usuContrasena = '$nueva_clave_encriptada' WHERE usuNombre = '$usuario'";
                mysqli_query($conn, $sql_update);

                $_SESSION['mensaje_cambio_contrasena'] = "¡Contraseña cambiada exitosamente!";
            } else {
                $_SESSION['mensaje_error_cambio_contrasena'] = "Las nuevas contraseñas no coinciden.";
            }
        } else {
            $_SESSION['mensaje_error_cambio_contrasena'] = "La contraseña actual es incorrecta.";
        }
    } else {
        $_SESSION['mensaje_error_cambio_contrasena'] = "Usuario no encontrado.";
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
            <h2 class="text-2xl mb-6 text-center">CAMBIAR CONTRASEÑA</h2>
            <form method="post">
                <div class="grid grid-cols-1 gap-6 mt-3">
                    <div>
                        <input placeholder="Contraseña actual" type="password" id="ClaveActual" name="ClaveActual" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
                    </div>
                    <div>
                        <input placeholder="Nueva contraseña" type="password" id="NuevaClave" name="NuevaClave" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
                    </div>
                    <div>
                        <input placeholder="Confirmar nueva contraseña" type="password" id="ConfirmarNuevaClave" name="ConfirmarNuevaClave" class="border border-gray-300 rounded-md px-3 py-2 w-full" required>
                    </div>
                </div>
                <div class="Cuenta mt-4 flex justify-between items-center">
                    <input class="button bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md" type="submit" value="Cambiar contraseña" name="CambiarContrasena">
                    <a href="login.php" class="text-blue-500 font-semibold"><i class="bi bi-door-open"></i>Volver al inicio de sesión</a>
                </div>
            </form>
        </div>
        <div>
            <?php if (isset($_SESSION['mensaje_cambio_contrasena'])) { ?>
                <div class="mx-auto w-full sm:w-1/2 font-medium text-center alert alert-success alert-dismissible fade show my-5" role="alert">
                    <i class="bi bi-check-lg"></i> <?= $_SESSION['mensaje_cambio_contrasena'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            <?php unset($_SESSION['mensaje_cambio_contrasena']); } ?>

            <?php if (isset($_SESSION['mensaje_error_cambio_contrasena'])) { ?>
                <div class="mx-auto w-full sm:w-1/2 font-medium text-center alert alert-danger alert-dismissible fade show my-5" role="alert">
                    <i class="bi bi-x-lg"></i> <?= $_SESSION['mensaje_error_cambio_contrasena'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            <?php unset($_SESSION['mensaje_error_cambio_contrasena']); } ?>
        </div>

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


