<?php include("../includes/header3.php")?>
<?php
if(empty($_SESSION['username'])){
    header("location: ../login.php");
    die();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];


    $query = "SELECT * FROM articulos  INNER JOIN stock ON articulos.artCodigo = stock.artCodigo
    INNER JOIN categorias ON articulos.idCategoria = categorias.idCategoria
    INNER JOIN marcas ON articulos.idMarca = marcas.idMarca WHERE articulos.artCodigo = $id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);
        $name = $row['artNombre'];
        $precio = $row['artPrecio'];
        $img = $row['artImagen'];
        $cant = $row['cantStock'];
    }
    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $name = $_POST['name'];
        $precio = $_POST['precio'];
        $img = $_POST['img'];
        $cant = $_POST['cant'];

        if($cant>0){
            $q = "UPDATE articulos SET artEstado = 'Con stock' " ;
            $r = mysqli_query($conn, $q);
        } 

        $query = "UPDATE articulos INNER JOIN stock ON articulos.artCodigo = stock.artCodigo
        INNER JOIN categorias ON articulos.idCategoria = categorias.idCategoria
        INNER JOIN marcas ON articulos.idMarca = marcas.idMarca SET artNombre = '$name', artPrecio = '$precio', artImagen = '$img', cantStock = '$cant' WHERE articulos.artCodigo = $id";

        $_SESSION['message'] = "Artículo actualizado correctamente";
        $_SESSION['message_type']  = 'info';
        mysqli_query($conn, $query);
        header ("location: index.php");
        exit();
    }
}
?>
<div class="container p-4">
    <div class="flex w-full">
        <div class="mx-auto w-full">
            <h1 class="text-center mb-3 fw-bold fs-4">Actualizar Artículo</h1>
            <div class="card">
                <div class="card-body">
                    <form class="grid grid-cols-1 sm:grid-cols-2 gap-x-6" action="editar.php?id=<?php echo $_GET['id']?>" method="POST">
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Nombre del Artículo</label>
                            <input required class="form-control" placeholder="Actualizar Nombre" type="text" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Precio</label>
                            <input required class="form-control" placeholder="Actualizar Precio" type="text" pattern="{1,15}" name="precio" value="<?php echo $precio; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Imágen</label>
                            <input required class="form-control" placeholder="Actualizar Imágen" type="text" name="img" value="<?php echo $img; ?>">
                        </div>
                        <div class="my-3">
                            <label class="form-label fw-bold">Actualizar Cantidad</label>
                            <input required class="form-control" placeholder="Actualizar cantidad" type="text" name="cant" value="<?php echo $cant; ?>">
                        </div>
                        <button class="btn btn-success col-span-0 sm:col-span-2 mt-3" name="update">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.php")?>