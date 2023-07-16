<?php
include('bd.php');

// Recuperar los datos del formulario
$artCodigo = $_POST['artCodigo'];
$cantCompra = $_POST['cantidad'];

// Obtener el ID del cliente existente (puede ser a través de una variable, sesión, etc.)
$idCliente = 24; // Ejemplo: ID del cliente ya almacenado

// Verificar si el cliente existe en la tabla "clientes" antes de insertar en "ventas"
// (Supongamos que la tabla "clientes" tiene una columna llamada "idCliente")
$sql_verificar_cliente = "SELECT idCliente FROM clientes WHERE idCliente = $idCliente";

$resultado_verificacion = $conn->query($sql_verificar_cliente);

if ($resultado_verificacion->num_rows > 0) {    
    // Si el cliente existe, proceder con la inserción en la tabla "ventas"
    $sql_insertar_venta = "INSERT INTO ventas (idCliente, artCodigo, cantCompra) VALUES ('$idCliente', '$artCodigo', '$cantCompra')";

    if ($conn->query($sql_insertar_venta) === TRUE) {
        // Redirigir al usuario a la página de confirmación
        header("Location: confirmacion.php");
        exit; // Terminar la ejecución del script después de la redirección
    } else {
        echo "Error al confirmar la compra: " . $conn->error;
    }
} else {
    echo "El cliente con ID $idCliente no existe. Verifica el ID del cliente antes de confirmar la compra.";
}

$conn->close();
?>