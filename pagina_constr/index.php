<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/app.js"></script>
    <script src="js/formulario.js"></script>
    <link rel="website icon" href="logo-img/logo-panther.png">
    <script src="//code.tidio.co/wmbt5ah4q76gqccxywn7jtddh8auveiy.js" async></script>
    <title>PcGlobal</title>
</head>
<body>
<header>
    <nav class="bg-indigo-700 container-fluid">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="hidden md:block">
              <ul class="flex space-x-4 font-bold fs-5 px-4 sm:">
                <li><a href="../#home" class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a></li>
                <li><a href="../#productos" class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Productos</a></li>
                <li><a href="../#comentarios" class="text-white hover:bg-indigo-600 hover:text-white  px-3 py-2 rounded-md text-sm font-medium">Comentarios</a></li>
              </ul>
            </div>
          </div>
          <div class="flex items-center space-x-1">
            <input type="text" class="flex-grow px-6 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-bg-indigo-600 focus:border-bg-indigo-600" placeholder="¿Qué deseas buscar?">
            <span id="icon-search" class="px-3 py-3 text-white bg-indigo-6700 rounded-md hover:bg-indigo-600 cursor-pointer"><i class="bi bi-search"></i></span>
            <a href="carrito.html" class="text-white px-2 fs-5"><i class="bi bi-cart-check-fill"></i></a><div class="dropdown">
            <?php if(empty($_SESSION['usuario_cliente'])){?>
                <i class="bi bi-person text-white px-2 fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu mt-2">
                    <li><a class="dropdown-item" href="Login-register/login.php">Inicia sesión</a></li>
                    <li><hr class="dropdown-diver my-2 mx-1"></li>
                    <li><a class="dropdown-item" href="Login-register/registrar.php">Regístrate</a></li>
                </ul>
           <?php }else{?> 
                <i class="bi bi-person text-white px-2 fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu mt-2">
                    <li class="dropdown-header"> ¡Hola, <?php echo $_SESSION['usuario_cliente']?>!</li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="Login-register/cambiar_contrasena.php">Cambia tu contraseña
                        <i class="bi bi-key"></i>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Login-register/cerrar_sesion.php">Cerrar sesión 
                            <i class="bi bi-box-arrow-in-right"></i>
                        </a>
                    </li>
                </ul>
           <?php } ?>
        </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
    <div class="min-height-full flex">
        <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:max-w-lg lg:w-[100rem]">
                <div class="text-center lg:text-left">
                    <img src="src/img/logoa-nobg.png" class="h-30 w-auto m-auto lg:m-0" alt="">
                    <h2 class="mt-32 sm:mt-6 text-2xl sm:text-3xl font-extrabold text-gray-900"><b class="p-1">¡OOPS!</b> 404 ERROR</i></h2>
                </div>
                <div class="mt-6">
                    <form action="" class="space-y-1">
                        <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-3">
                            <div class="col-span-2 text-md sm:text-lg">
                            Lo sentimos, la página no fue encontrada. El link al que entraste probablemente esté roto o la página fue removida
                            </div>
                            <div class="text-center col-span-2 font-bold text-md mt-6">
                                <p>¡Vuelve Pronto!</p>
                            </div>
                        </div>
                        <div class="flex">
                            <a href="../index.php" class="text-center mt-8 w-full py-3 text-white font-medium hover:shadow-md hover:text-slate-100"><i class="bi bi-arrow-left"></i> Volver al Inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative flex-1">
            <img src="src/img/brand.png" class="height" alt="">
        </div>
    </div>
</body>
</html>