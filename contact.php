<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - Contacto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        /* Estilos para asegurar que el mapa tenga un tamaño adecuado */
        #map {
            height: 400px; /* Ajustar el tamaño según tus necesidades */
            width: 100%;
        }
    </style>
</head>
<body class="main-layout position_head">
    <header>
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php" class="brand-logo"><img src="images/logo.png" alt="#" />
                                        <p>GymGuide</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Inicio</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Funcionalidades Fitness
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="calorie-calculator.php">Calculadora de calorias</a>
                                            <a class="dropdown-item" href="1RM-calculator.php">Calculadora de 1RM</a>
                                            <a class="dropdown-item" href="bloquesdefuerza.php">Programación en Bloques de fuerza</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tienda
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="shop.php">Productos</a>
                                            <a class="dropdown-item" href="cart.php">Carrito</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contacto</a>
                                    </li>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="micuenta.php">Mi Cuenta</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="registro.php">Registro</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- contact section -->
    <div id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form id="request" class="main_form">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Contacta con nosotros</h3>
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Nombre" type="text" name="Name"> 
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Número de teléfono" type="text" name="Phone Number"> 
                            </div>
                            <div class="col-md-12">
                                <input class="contactus" placeholder="Email" type="text" name="Email">                          
                            </div>
                            <div class="col-md-12">
                                <input class="contactusmess" placeholder="Mensaje" type="text" name="Message">
                            </div>
                            <div class="col-md-12">
                                <button class="send_btn">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <img src="images/fondocontacto.jpg" alt="#" />
    </div>
    <!-- end contact section -->
    <!-- footer -->
    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <ul class="location_icon">
                            <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> C/San Benito 6</li>
                            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> tfg.gymguide@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>© 2024 Todos los derechos reservados. Diseñado por Juan Utrera Díaz y David Miñano de la Osa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>