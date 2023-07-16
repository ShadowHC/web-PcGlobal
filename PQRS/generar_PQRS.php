<?php 
include('include/header.php');

if (isset($_POST['generar'])) {
    $tipo = $_POST['tipo'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    $nombre = $_SESSION['usuario_cliente'];

    // Validación de campos no vacíos
    if (empty($tipo) || empty($mensaje)) {
        echo "Error: Por favor, completa todos los campos del formulario.";
        exit;
    }

    // Validación del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Por favor, ingresa un correo electrónico válido.";
        exit;
    }

    // Validación del contenido mínimo del mensaje
    if (str_word_count($mensaje) < 20) {
        echo "Error: El mensaje debe tener al menos 20 palabras.";
        exit;
    }

    $sql = "INSERT INTO pqrs (descripcionPqrs, nomCliente, estadoPqrs) VALUES (?, ?, 'Enviado')";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $mensaje, $nombre);    

    if (mysqli_stmt_execute($stmt)) {
        $message = "Los datos del formulario se han guardado en la base de datos correctamente.";
    } else {
        $message = "Error al guardar los datos en la base de datos. Por favor, inténtalo de nuevo.";
    }
}
?>

<form method="POST" class="max-w-md mx-auto p-4 bg-white rounded shadow mt-4">
    <!-- Grupo: Nombre Completo -->
    <div class="mb-4">
        <h3 class="fs-5 text-center">Déjanos saber tu opinión, <?php echo $_SESSION['usuario_cliente']?></h3>
    </div>
    <!-- Grupo: Tipo de PQRS -->
    <div class="mb-4">
        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de PQRS</label>
        <div class="mt-1 relative">
            <select name="tipo" id="tipo" required class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Seleccionar tipo</option>
                <option value="Peticion">Peticion</option>
                <option value="Queja">Queja</option>
                <option value="Reclamo">Reclamo</option>
                <option value="Sugerencia">Sugerencia</option>
            </select>
        </div>
        <p class="mt-2 text-xs text-red-500">Por favor, seleccione el tipo de PQRS.</p>
    </div>

    <!-- Grupo: Correo -->
    <div class="mb-4">
        <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
        <div class="mt-1 relative">
            <input type="email" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="correo" placeholder="correo@correo.com" required>
            <span class="absolute right-2 top-2 text-gray-500">
                <i class="bi bi-envelope-fill"></i>
            </span>
        </div>
        <p class="mt-2 text-xs text-red-500">El correo solo puede contener letras, números, puntos, guiones y guión bajo.</p>
    </div>

    <!-- Grupo: Motivo -->
    <div class="mb-4">
        <label for="motivo" class="block text-sm font-medium text-gray-700">Mensaje</label>
        <div class="mt-1 relative">
            <textarea class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="mensaje" required></textarea>
            <span class="absolute right-2 top-2 text-gray-500">
                <i class="bi bi-chat-left-fill"></i>
            </span>
        </div>
        <p class="mt-2 text-xs text-red-500">El mensaje debe tener un contenido mínimo de 20 palabras.</p>
    </div>
    <div class="flex justify-center">
        <button type="submit" name="generar" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Enviar</button>
    </div>
</form>
