    <?php include("../includes/header5.php"); 
        if (empty($_SESSION['username'])){
            header("location: ../login.php");
            die();
        }
    ?>
        <div>
        <?php if(isset($_SESSION['message'])){?>
                    <div class="mx-96 font-bold alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times text-xl"></i></button>
                    </div>
                <?php unset($_SESSION['message']); } ?>        
        </div>
    <div class="container flex mx-auto my-6">
        <table class="table">
            <thead>
                <tr class="border-t-2 border-gray-900">
                    <th>Nombres</th>
                    <th>Descripción de la PQRS</th>
                    <th>Estado de PQRS</th>
                    <th>Respuesta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "CALL pa_consulta_pqrs();";
                    $result = mysqli_query($conn, $query);  

                    while($row = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td><?php echo $row['Nombre'] ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['Estado'] ?></td> 
                            <td><?php echo $row['Respuesta'] ?></td>                        
                            <td>
                                <a class="btn btn-outline-primary my-2" href="respuesta.php?id=<?php echo $row['id']?>"><i class="bi bi-check2-all"></i></i></a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id']?>"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>

        <div class="modal fade" id="modal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Estás seguro de realizar esta acción? 😰</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body w-full max-w-md mx-auto bg-white shadow rounded-lg p-6 my-4">
                        <form action="eliminar_pqrs.php" method="post" >
                            <input type="hidden" name="pqrs_id" value="<?php echo $row['id'] ?>">
                        <div class="my-6">
                            <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo de cierre de la PQRS</label>
                            <textarea name="motivo" rows="4" placeholder="Ingrese el motivo de cierre de la PQRS" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"  required></textarea>
                            <span class="absolute right-2 top-2 text-gray-500">
                                <i class="bi bi-chat-left-fill"></i>
                            </span>
                        </div>
                        <p class="my-4 text-xs text-red-500">El mensaje debe tener un contenido mínimo de 10 palabras.</p>
                        <div class="flex justify-end">
                            <button type="button" class="px-4 py-2 mr-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none">¡Eliminar!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</tbody>
</table>
</div>
 <?php include("../includes/footer.php"); ?>

                        
