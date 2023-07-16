<?php
    // respuesta.php
    include("../includes/header5.php");

    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pqrs_id']) && isset($_POST['respuesta'])) {
        $pqrs_id = $_POST['pqrs_id'];
        $respuesta = $_POST['respuesta'];

        // Aquí debes incluir la lógica para cambiar el estado de la PQRS a "respondida"
        // Supongamos que tienes una función en tu base de datos que realiza la actualización

        // Luego, crea una función que actualice el estado y la respuesta de la PQRS en la base de datos
        function actualizarPQRS($conn, $pqrs_id, $respuesta) {
            // Supongamos que tienes una tabla 'pqrs' con campos 'estado' y 'respuesta'
            // Actualiza el estado a 'respondida' y agrega la respuesta para el ID de la PQRS proporcionado
            $estado_nuevo = 'respondida';

            $query = "UPDATE pqrs SET estadoPqrs = ?, respuesta = ? WHERE idpqrs = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssi', $estado_nuevo, $respuesta, $pqrs_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Llama a la función para cambiar el estado y agregar la respuesta de la PQRS
        actualizarPQRS($conn, $pqrs_id, $respuesta);

        // Redirige a la página donde se muestra la lista de PQRS nuevamente
        $_SESSION['message'] = "La PQRS ha sido respondida";
        $_SESSION['message_type']  = 'success';
        header ("location: index.php");
        exit();
    }
?>
<!-- Aquí está el formulario para enviar la respuesta de la PQRS -->
<div class="container mx-auto my-6">
    <form action="" method="post">
        <input type="hidden" name="pqrs_id" value="<?php echo $_GET['id']; ?>">
        <div class="my-6">
            <label for="respuesta" class="block text-sm font-medium text-gray-700">Respuesta de la PQRS</label>
            <textarea name="respuesta" rows="4" placeholder="Ingrese la respuesta de la PQRS" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none">Enviar Respuesta</button>
        </div>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
