<?php
include("../includes/header5.php");

if (isset($_POST['pqrs_id'])) {
    $pqrs_id = $_POST['pqrs_id'];
    $motivo = $_POST ['motivo'];
    // Assuming $conn is your database connection
    $sql = "DELETE FROM pqrs WHERE idpqrs = ?";

    // Validación del contenido mínimo del mensaje
    if (str_word_count($motivo) < 5) {
        echo "Error: El mensaje debe tener al menos 5 palabras.";
        exit;
    }

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $pqrs_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
                    
        $_SESSION['message'] = "La PQRS se ha cerrado";
        $_SESSION['message_type']  = 'danger';
        header ("location: index.php");
        exit();
        } else {
            echo "Error al eliminar la PQRS: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "No se recibió el ID de la PQRS a eliminar.";
}
?>

