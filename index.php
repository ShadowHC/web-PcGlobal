<?php session_start();?>
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
                <li><a href="#home" class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a></li>
                <li><a href="#productos" class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Productos</a></li>
                <li><a href="#comentarios" class="text-white hover:bg-indigo-600 hover:text-white  px-3 py-2 rounded-md text-sm font-medium">Comentarios</a></li>
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
        <section class="flex justify-center mx-32" id="home">
            <div id="intro" class="carousel slide hidden sm:flex" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button data-bs-target="#intro" data-bs-slide-to="0" class="active"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="1"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="2"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="3"></button>
                    <button data-bs-target="#intro" data-bs-slide-to="4"></button>
                </div>

                <div class="carousel-inner d-flex align-content-md-centers ">
                    <div class="carousel-item active">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-1.jpg" class="d-block ">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-2.jpg" class="d-block w-100 ">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-3.jpg" class="d-block w-100 ">
                    </div>

                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-4.jpg" class="d-block w-100 ">
                    </div>
                    
                    <div class="carousel-item">
                        <div class="carousel-caption">
                        </div>
                        <img src="images/img slider/f-5.jpg" class="d-block w-100">
                    </div>
                </div>

                <button class="carousel-control-prev" data-bs-target="#intro" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" data-bs-target="#intro" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div> 
        </section>
    </div> 
<section id="productos">
    <div class="p-6 border-t-0 sm:border-t border-gray-600 mt-6 mx-10"> 
        <h2 class="fs-3 text-center mb-10">Categoría de productos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  mx-auto justify-center gap-x-6 gap-y-4">
            <div>
                <a href="componentes/Tarjetas Graficas.php" class="text-black no-underline">
                <img src="images/Portafolio/Tarjeta Gráfica.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Tarjetas Graficas</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Procesadores.php" class="text-black no-underline">
                <img src="images/Portafolio/procesador.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Procesadores</h3>
                </a>    
            </div>
            <div>
                <a href="componentes/Almacenamiento.php" class="text-black no-underline">
                <img src="images/Portafolio/Almacenamiento.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Almacenamiento</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Ram.php" class="text-black no-underline">
                <img src="images/Portafolio/Ram.png" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Ram</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Monitores.php" class="text-black no-underline">
                <img src="images/Portafolio/Monitores.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Monitores</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Tarjeta Madre.php" class="text-black no-underline">
                <img src="images/Portafolio/mother-board.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Tarjetas Madre</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Cases.php" class="text-black no-underline">
                <img src="images/Portafolio/cases.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Cases</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Perifericos.php" class="text-black no-underline">
                <img src="images/Portafolio/Perifericos.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Periféricos</h3>
                </a>
            </div>
            <div>
                <a href="componentes/Fuentes de poder.php" class="text-black no-underline">
                <img src="images/Portafolio/Fuente de poder.jpg" alt="Iconos Redondos" class=" hover:shadow-lg rounded-md transform transition-all duration-100 hover:scale-90">
                <h3 class="text-center fs-5">Fuentes de poder</h3>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="bg-gray-100 py-16" id="comentarios">
    <div class="container">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Comentarios</h2>
            <div>
                <div class="space-y-2">
                    <div class="grid grid-cols-3 gap-4 bg-gray-700 rounded-xl shadow-lg p-4">
                        <div class="col-span-1">
                            <img class="h-20 w-20 shadow-gray-300 shadow-md rounded-full mx-auto" src="https://scotiabankfiles.azureedge.net/scotiabank-chile/iniciativa-mujeres/mujer.png" alt="Cliente 1">
                        </div>
                        <div class="col-span-2">
                            <h3 class="text-lg leading-6 font-medium text-gray-200">Andrea</h3>
                            <p class="text-sm text-gray-300">Compré una computadora y estoy muy satisfecha con la calidad del producto y la atención al cliente.</p>
                        </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 bg-gray-500 rounded-xl shadow-lg p-4">
                            <div class="col-span-1">
                                <img class="h-20 w-20 shadow-gray-600 shadow-md rounded-full mx-auto" src="https://www.labsaenzrenauld.com/wp-content/uploads/2020/10/Perfil-hombre-ba%CC%81sico_738242395.jpg" alt="Cliente 2">
                        </div>
                        <div class="col-span-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-200">Carlos</h3>
                                <p class="text-sm text-white">Recomiendo esta tienda a todos. El servicio es excelente y los productos son de alta calidad.</p>
                        </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 bg-gray-400 rounded-xl shadow-lg p-4">
                            <div class="col-span-1">
                                <img class="h-20 w-20 shadow-gray-800 shadow-md rounded-full mx-auto" src="https://www.joseivanaguilar.com/wp-content/uploads/2021/03/mujer.jpg" alt="Cliente 3">
                            </div>
                            <div class="col-span-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-800">Karla</h3>
                                <p class="text-sm text-gray-700">El servicio que recibí en esta página web fue excepcional. El equipo de atención al cliente fue amable, eficiente y muy servicial.</p>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Botón para generar PQRS -->
            <div class="text-center mt-8">
            <?php if (isset($_SESSION['usuario_cliente'])) : ?>
                <a href="PQRS/generar_PQRS.php" class="border-1 border-sky-500 py-2 px-4 rounded-sm hover:bg-sky-500 hover:text-white hover:shadow-md">Generar PQRS</a>
            <?php else : ?>
                <a href="Login-register/login.php" class="border-1 border-red-500 py-2 px-4 rounded-sm hover:bg-red-500 hover:text-white hover:shadow-md">¡Debes iniciar sesion para generar una PQRS!</a>
            <?php endif; ?>    
            </div>
        </div>
    </div>
</section>
<iframe class="mt-4" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1988.2989721749705!2d-74.05879632918939!3d4.665551278628364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sunilago!5e0!3m2!1ses!2sco!4v1677883140666!5m2!1ses!2sco" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <footer class="bg-gray-200 py-4 text-center">
        <div class="flex justify-center space-x-4">
            <a href="https://www.facebook.com/profile.php?  id=100087015408684" class="text-gray-600 hover:text-blue-500">
                <i class="bi bi-facebook"></i>
            </a>
            <a   class="text-gray-600 hover:text-red-600">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.twitter.com" class="text-gray-600 hover:text-blue-400">
                <i class="bi bi-twitter"></i>
            </a>
        </div>
        <p class="text-gray-600 mt-2">
        &copy; 2023 <strong>PC Global</strong> - Todos los Derechos Reservados
    </p>
</footer>
    <script src="js/script.js"></script>
</body>
</html>