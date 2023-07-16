<?php
include("bd/header.php");

session_start();

if (isset($_POST['Registrar'])) {
    // Capturar los valores enviados por el formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['DocNum'];
    $direccion = $_POST['direccion'];
    $email = $_POST['Email'];
    $tel = $_POST['num'];
    $numTarjeta = $_POST['tarjetaNum'];
    $venFecha = $_POST['venFecha'];
    $CVV = $_POST['CVV'];
    $usuario = $_POST['Usuario'];
    $clave = $_POST['Clave'];

    // Validar el campo de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_register'] = "Por favor, ingresa un correo electrónico válido.";
        header("location: register.php"); // Cambiar "register.php" por la página del formulario de registro.
        exit;
    }

    // Realizar más validaciones si es necesario...

    $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

    // Preparar la consulta SQL utilizando una sentencia preparada para insertar en la tabla `clientes`
    $sql1 = "INSERT INTO clientes (nomCliente, apeCliente, tipoDocCli, numDocCli, cliDireccion, cliEmail, cliTelefono, numTarjeta, venFecha, CVV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "ssssssssss", $nombres, $apellidos, $tipoDoc, $numDoc, $direccion, $email, $tel, $numTarjeta, $venFecha, $CVV);

    // Preparar la consulta SQL utilizando una sentencia preparada para insertar en la tabla `usuarios`
    $sql2 = "INSERT INTO usuarios (tipoUsuario, usuNombre, usuContrasena) VALUES ('cliente', ?, ?)";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $usuario, $clave_encriptada);

    // Ejecutar ambas consultas preparadas
    $resultado1 = mysqli_stmt_execute($stmt1);
    $resultado2 = mysqli_stmt_execute($stmt2);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado1 && $resultado2) {
        // Los datos se insertaron correctamente
        $_SESSION['mensaje_register_successful'] = "Usuario registrado correctamente";
        header("location: login.php"); // Cambiar "login.php" por la página de inicio de sesión.
        exit;
    } else {
        // Ocurrió un error al insertar los datos
        $_SESSION['mensaje_register'] = "Error al generar el registro";
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);
}
?>

<script src="script.js"></script>

<div class=" max-w-lg mx-auto p-6 bg-white shadow-lg rounded-md mt-4    ">
    <h2 class="text-2xl font-semibold mb-4 text-center"><i class="bi bi-person-circle px-2"></i>Registrar</h2>
    <form method="post" onsubmit="return validarFormulario()">
    <div class="grid grid-cols-2 gap-x-4">
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Nombres" type="text" id="nombres" name="nombres">
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Apellidos" type="text" id="apellidos" name="apellidos">
        </div>
        <div class="mb-3">
            <select class="w-full border border-gray-300 text-gray-400 px-3 py-2 rounded-md" required id="tipoDoc" name="tipoDoc">
                <option>Seleccione su tipo de documento</option>
                <option>TI</option>
                <option>CC</option>
                <option>CE</option>
            </select>
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Número de documento" type="text" id="DocNum" name="DocNum">
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Número de tarjeta" type="text" id="tarjetaNum" name="tarjetaNum">
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Fecha de vencimiento" type="date" id="venFecha" name="venFecha">
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="CVV" type="text" id="CVV" name="CVV">
        </div>

        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Dirección " type="text" id="direccion" name="direccion">
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Email" type="text" id="Email" name="Email">
            <span id="errorEmail" class="text-red-500"></span>
        </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Numero de contacto" type="number" id="num" name="num">
            <span id="errorEmail" class="text-red-500"></span>
        </div>
    </div>
        <div class="mb-3">
            <input class="w-full border border-gray-300 px-3 py-2 rounded-md" required placeholder="Usuario" type="text" id="Usuario" name="Usuario">
        </div>
        <div class="input-group mb-3">
    <input placeholder="Clave" type="password" id="Clave" name="Clave" class="border border-gray-300 rounded-md px-3 py-2 w-4/5">
    <span class="input-group-text bg-white cursor-pointer"><a class="hover:text-black " onclick="mostrarContrasena()"><i class="bi bi-eye-fill"></i></a></span>
</div>

        <div class="formulario-terminos mb-2">
            <input class="rounded" type="checkbox" name="aceptar" required> Acepto los <a class="text-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalterminos">términos y condiciones.</a>
        </div>
        <div class="space-x-60 mt-4 ">
            <button class="bg-green-600 text-white hover:bg-green-500 px-2 py-2 rounded-md" type="submit" name="Registrar"> Crear Cuenta</button>
            <a class="bg-indigo-600 text-white absolute hover:bg-indigo-500 px-2 py-2 rounded-md" href="login.php">Iniciar Sesión</a>
        </div>
    </form>
</div>
<div>
    <?php if (isset($_SESSION['mensaje_register'])) { ?>
        <div class="mx-auto w-full sm:w-1/2 font-medium text-center alert alert-danger alert-dismissible fade show my-5" role="alert">
            <i class="bi bi-exclamation-triangle"></i> <?= $_SESSION['mensaje_register'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <?php unset($_SESSION['mensaje_register']); } ?>
</div>

<div class="modal fade" id="modalterminos" tabindex="-1" aria-labelledby="modalterminosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4 fw-bold" id="modalterminosLabel">Términos y condiciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
        <p>
        <h1 class="fs-6 fw-bold">Propietario de la página web, la oferta y el enlace de los Términos.</h1>

        Esta página web es propiedad y está operado por . Estos Términos establecen los términos y condiciones bajo los cuales tu puedes usar nuestra página web y servicios ofrecidos por nosotros. Esta página web ofrece a los visitantes compra de computadores y componentes entre ell (tarjetas ram,tarjetas madre,procesadores etc). Al acceder o usar la página web de nuestro servicio, usted aprueba que haya leído, entendido y aceptado estar sujeto a estos Términos
        
        <h1 class="fs-6 fw-bold">Cuáles son los requisitos para crear una cuenta.</h1>
        
        Para usar nuestro página web y / o recibir nuestros servicios, debe ser mayor de edad y poseer la autoridad legal, el derecho y la libertad para participar en estos Términos como un acuerdo vinculante. No tienes permitido utilizar esta página web y / o recibir servicios si hacerlo está prohibido en tu país o en virtud de cualquier ley o regulación aplicable a tu caso.
        
        <h1 class="fs-6 fw-bold">Términos comerciales ofrecidos a los clientes.</h1>
        
        Al comprar un artículo, aceptas que: (I) eres responsable de leer el listado completo del artículo antes de comprometerte a comprarlo: (II) celebras un contrato legalmente vinculante para comprar un artículo cuando te comprometed a comprar un artículo y completar el proceso de check-out.
        
         Los precios que cobramos por usar nuestros servicios / para nuestros productos se enumeran en la página web. Nos reservamos el derecho de cambiar nuestros precios para los productos que se muestran en cualquier momento y de corregir los errores de precios que pueden ocurrir inadvertidamente. Información adicional sobre precios e impuestos sobre las ventas está disponible en la página de pagos. 
        
        "La tarifa por los servicios y cualquier otro cargo que pueda incurrir en relación con tu uso del servicio, como los impuestos y las posibles tarifas de transacción, se cobrarán mensualmente a tu método de pago.
        
        <h1 class="fs-6 fw-bold">politica de reembolso.</h1>
        
        Solo reemplazamos los artículos si están defectuosos o dañados. Si necesitas cambiarlo por el mismo artículo, envíanos un email a (Agrega dirección de correo electrónico relevante) y envía tu artículo a: (Dirección relevante).
        
        <h1 class="fs-6 fw-bold">Posesión de propiedad intelectual, derechos de autor y logos.</h1>
        
        El Servicio y todos los materiales incluidos o transferidos, incluyendo, sin limitación, software, imágenes, texto, gráficos, logotipos, patentes, marcas registradas, marcas de servicio, derechos de autor, fotografías, audio, videos, música y todos los Derechos de Propiedad Intelectual relacionados con ellos, son la propiedad exclusiva de [Nombre del propietario de la página web]. Salvo que se indique explícitamente en este documento, no se considerará que nada en estos Términos crea una licencia en o bajo ninguno de dichos Derechos de Propiedad Intelectual, y tu aceptas no vender, licenciar, alquilar, modificar, distribuir, copiar, reproducir, transmitir, exhibir públicamente, realizar públicamente, publicar, adaptar, editar o crear trabajos derivados de los mismos. 
        
        <h1 class="fs-6 fw-bold">Limitación de responsabilidad.</h1>
        
        En la máxima medida permitida por la ley aplicable, en ningún caso el [propietario de la página web] será responsable por daños indirectos, punitivos, incidentales, especiales, consecuentes o ejemplares, incluidos, entre otros, daños por pérdida de beneficios, buena voluntad, uso, datos. u otras pérdidas intangibles, que surjan de o estén relacionadas con el uso o la imposibilidad de utilizar el servicio. 
        
        En la máxima medida permitida por la ley aplicable, [el propietario la página web] no asume responsabilidad alguna por (I) errores, errores o inexactitudes de contenido; (II) lesiones personales o daños a la propiedad, de cualquier naturaleza que sean, como resultado de tu acceso o uso de nuestro servicio; y (III) cualquier acceso no autorizado o uso de nuestros servidores seguros y / o toda la información personal almacenada en los mismos.
        Derecho a cambiar y modificar los Términos.
        
        <h1 class="fs-6 fw-bold">Emails de promociones y contenido.</h1>
        
        Acepta recibir de vez en cuando nuestros mensajes y materiales de promoción, por correo postal, correo electrónico o cualquier otro formulario de contacto que nos proporciones (incluido tu número de teléfono para llamadas o mensajes de texto). Si no deseas recibir dichos materiales o avisos de promociones, simplemente avísanos en cualquier momento.
        
        <h1 class="fs-6 fw-bold">Preferencia de ley y resolución de disputas.</h1>
        
        Estos Términos, los derechos y recursos provistos aquí, y todos y cada uno de los reclamos y disputas relacionados con este y / o los servicios, se regirán, interpretarán y aplicarán en todos los aspectos única y exclusivamente de conformidad con las leyes sustantivas internas de [ Nombre del país / estado], sin respeto a sus principios de conflicto de leyes. Todos los reclamos y disputas se presentarán y usted acepta que sean decididos exclusivamente por un tribunal de jurisdicción competente ubicada en [Nombre de la ciudad de los tribunales]. La aplicación de la Convención de Contratos de las Naciones Unidas para la Venta Internacional de Bienes queda expresamente excluida.
        
        <h1 class="fs-6 fw-bold">Atención al cliente e información de contacto.</h1>
        
        Se espera que los términos tengan información de contacto que permita a los usuarios y clientes recibir servicios de atención al cliente y corresponder con las páginas web y sus operadores.
        
        <h1 class="fs-6 fw-bold">Disposiciones recomendadas para sitios web con comunidades de usuarios.</h1>
        
        Si tu página web incluye una comunidad de usuarios, recomendamos que los Términos de la página aclaren que todos los usuarios que se unen a una comunidad tienen un perfil público visible para los visitantes de la página y que su actividad pública (como sus publicaciones o comentarios) será visible a otros visitantes del sitio web.
      </p>
      </div>
        </div>
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
</script>
