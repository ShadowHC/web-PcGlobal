<?php
include("php/db.php"); // Incluye el archivo de conexión a la base de datos
include("includes/header.php"); // Incluye el encabezado de la página

if (isset($_GET['id'])) { // Comprueba si el parámetro 'id' está presente en la URL
  $id = $_GET['id']; // Obtiene el valor del parámetro 'id'
  // Realiza una consulta para obtener los detalles del artículo con el id especificado
  $query = "SELECT * FROM articulos INNER JOIN marcas ON marcas.idMarca = articulos.idMarca INNER JOIN stock ON stock.artCodigo = articulos.artCodigo INNER JOIN categorias ON categorias.idCategoria = articulos.idCategoria WHERE articulos.artCodigo = $id";
  $result = mysqli_query($conn, $query); // Ejecuta la consulta
  $row = mysqli_fetch_array($result); // Obtiene los datos del artículo como un array
}
?>

<!-- Contenido HTML de la página -->
<div class="w-full grid grid-cols-1 mx-auto sm:grid-cols-2 inline-block flex flex-col flex-1 my-5 items-center">
  <!-- Sección para mostrar los detalles del artículo -->
  <div class="flex flex-col mx-auto text-center my-3 border-b-2 sm:border-r-2 sm:border-b-0 border-slate-900">
    <h1 class="mar"><?php echo $row['nomMarca']; ?></h1>
    <p class="mt-2 mb-3 text-xl font-medium"><?php echo $row['artNombre']; ?></p>
    <img class="p-3 mx-auto rounded-lg" src="<?php echo $row['artImagen']; ?>" alt="">
  </div>
  <div class="flex flex-col justify-start mx-3">
    <!-- Botón para volver a la página anterior -->
    <div class="text-white mb-3 text-lg font-bold"><a class="p-2 rounded-md" href="Monitores.php"><i class="bi bi-arrow-left"></i> Volver</a></div>
    <div>
      <!-- Mostrar información adicional del artículo -->
      <h2><b>Cantidad:</b> <?php echo $row['cantStock']; ?> unidad(es)</h2>
      <p><b>Tipo:</b> <?php echo $row['nomCategoria']; ?></p>
    </div>
    <p class="mt-8"><b>Especificaciones:</b><br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque asperiores omnis consequuntur quo perspiciatis, ea consectetur illum alias fugiat exercitationem rem ad amet commodi nostrum impedit labore adipisci ratione? Provident?</p>
    <?php if (isset($_SESSION['usuario_cliente'])): ?>
      <!-- Botón para comprar - activa el modal -->
      <button type="button" class="border-1 border-indigo-700 hover:bg-indigo-700 hover:text-white mt-4 px-3 py-2 rounded-md w-full text-center text-indigo-500" data-bs-toggle="modal" data-bs-target="#paymentModal">Comprar</button>
    <?php else: ?>
      <!-- Botón para comprar - redirige al inicio de sesión -->
      <button type="button" class="border-1 border-indigo-700 hover:bg-indigo-700 hover:text-white mt-4 px-3 py-2 rounded-md w-full text-center text-indigo-500" onclick="redireccionarLogin()">Comprar</button>
    <?php endif; ?>
    <!-- Botón para añadir al carrito -->
    <a href="../pagina_constr/index.php" class="border-1 border-indigo-700 hover:bg-indigo-700 hover:text-white mt-4 px-3 py-2 rounded-md w-full text-center text-indigo-500">Añadir al carrito <i class="bi bi-cart4"></i></a>
  </div>
</div>

<!-- Modal para la confirmación de compra -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="paymentModalLabel">Confirmación de Compra</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Contenido del modal -->
        <h2 class="modal-title">Confirmación de Compra</h2>
        <p><b>Usuario:</b> <?php echo $_SESSION['usuario_cliente']?></p>
        <p><b>Producto:</b> <?php echo $row['artNombre']; ?></p>
        <p><b>Precio:</b> <?php echo $row['artPrecio']; ?></p>
        <form action="pasarela de pago/confirmar_compra.php" method="POST">
          <!-- Formulario para confirmar la compra -->
          <div class="mb-3">
            <input type="hidden" name="idCliente" value="ID del Usuario">
          </div>
          <div class="mb-3">
            <input type="hidden" name="artCodigo" value="<?php echo $row['artCodigo']; ?>">
          </div>
          <div class="mb-3">
            <label for="cantCompra" class="form-label">Cantidad de Productos:</label>
            <input type="number" min="1" max="<?php echo $row['cantStock']; ?>" class="form-control" id="cantidad" name="cantidad" required>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn border-indigo-600 text-indigo-600 hover:text-white hover:bg-indigo-600">Confirmar Compra</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="pasarela de pago/script.js"></script>
</body>
</html>
