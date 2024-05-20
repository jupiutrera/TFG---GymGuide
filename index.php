<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - Inicio</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .text-content {
            max-height: 200px;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .text-content.expanded {
            max-height: 1000px; /* Ajusta según sea necesario para el contenido completo */
        }

        .read_more {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        /* Botón de Volver Arriba */
        #topBtn {
            display: none; /* Oculto por defecto */
            position: fixed; /* Fijo en la pantalla */
            bottom: 20px; /* A 20px del fondo */
            right: 30px; /* A 30px de la derecha */
            z-index: 99; /* Asegúrate de que esté por encima de otros elementos */
            border: none; /* Sin borde */
            outline: none; /* Sin outline */
            background-color: #03cafc; /* Color de fondo azul */
            color: white; /* Color de texto blanco */
            cursor: pointer; /* Cursor de mano */
            width: 50px; /* Ancho */
            height: 50px; /* Alto */
            border-radius: 50%; /* Bordes redondeados para que sea circular */
            font-size: 18px; /* Tamaño de la flecha */
            text-align: center; /* Centra el contenido horizontalmente */
            line-height: 50px; /* Centra el contenido verticalmente */
        }

        #topBtn:hover {
            background-color: black; /* Color de fondo negro al pasar el cursor */
            color: white; /* Color de texto blanco */
        }
        #myCarousel {
            margin-bottom: 100px;
        }

        .banner_main {
            padding-top: 50px; /* Ajusta según sea necesario */
        }

        header {
            margin-bottom: 0px; /* Asegúrate de que no haya margen inferior */
        }

        .carousel {
            margin-top: 0px; /* Asegúrate de que no haya margen superior */
        }

        .header {
            margin-bottom: 0px; /* Asegúrate de que no haya margen inferior */
        }

        .header .navigation {
            margin-bottom: 0px; /* Asegúrate de que no haya margen inferior */
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
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.php">Sobre nosotros</a>
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
                                        <li class="nav-item d_none login_btn">
                                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                                        </li>
                                        <li class="nav-item d_none">
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

    <!-- banner -->
    <section class="banner_main">
        <div id="banner1" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#banner1" data-slide-to="0" class="active"></li>
                <li data-target="#banner1" data-slide-to="1"></li>
                <li data-target="#banner1" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="text-bg">
                                <h1> <span class="blu">BIENVENIDO <br></span>A GymGuide</h1>
                                <figure><img src="images/Bienvenido.webp" alt="#" width="750px"/></figure>
                                <a class="read_more" href="shop.php">Ir a la tienda</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="text-bg">
                                <h1> <span class="blu">LOS MEJORES <br></span>Planes y cursos</h1>
                                <figure><img src="images/Planescursos.webp" alt="#" width="750px"/></figure>
                                <a class="read_more" href="shop.php">Ir a la tienda</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="text-bg">
                                <h1> <span class="blu">RUTINAS <br></span>y dietas</h1>
                                <figure><img src="images/Dietas.webp" alt="#" width="750px"/></figure>
                                <a class="read_more" href="shop.php">Ir a la tienda</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </section>
    <!-- end banner -->
    <!-- about section -->
    <div class="about">
        <div class="container">
            <div class="row d_flex">
                <div class="col-md-5">
                    <div class="about_img">
                        <figure><img src="images/Default_Un_hombre_humano_levantando_una_macuerna_entrenando_bi_0.png" alt="#"/></figure>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="titlepage">
                        <h2>Sobre nuestra WEB</h2>
                        <div class="text-content" id="text-content">
                            <h3>Bienvenido a GYMGUIDE</h3>
                            En GYMGUIDE, estamos comprometidos con tu éxito en el mundo del fitness y el bienestar. Nuestra pasión por la salud y la forma física nos impulsa a ofrecerte una experiencia única y personalizada que te ayudará a alcanzar tus metas, superar tus límites y vivir una vida más saludable y feliz. <br>
                            <br><h4>Nuestra Misión</h4>
                            Nuestra misión es simple pero poderosa: queremos ser tu compañero de confianza en tu viaje hacia una vida más activa y saludable. Nos esforzamos por proporcionarte las herramientas, el apoyo y la motivación necesarios para que te sientas seguro, inspirado y capacitado para alcanzar tus objetivos de fitness, ya sea perder peso, aumentar tu fuerza, mejorar tu resistencia o simplemente adoptar un estilo de vida más activo. <br>
                            <br><h4>¿Qué nos hace diferentes?</h4>
                            En GYMGUIDE, nos enorgullece ofrecer una experiencia única que se distingue por: <br> <br>
                            <b>Entrenadores altamente calificados y dedicados:</b> Nuestro equipo de entrenadores está formado por profesionales apasionados y altamente capacitados que están comprometidos con tu éxito. Ellos trabajarán contigo para desarrollar un plan de entrenamiento personalizado que se adapte a tus necesidades, habilidades y objetivos específicos.
                            <br><br><b>Suplementación de calidad:</b> Nos asociamos con las marcas líderes en el mercado para ofrecerte una amplia gama de suplementos de alta calidad que complementarán tu dieta y maximizarán tus resultados.
                        </div>
                        <a class="read_more" id="read-more">Leer más</a>
                    </div>
                </div>
                <script>
                    document.getElementById('read-more').addEventListener('click', function() {
                        var textContent = document.getElementById('text-content');
                        textContent.classList.toggle('expanded');
                        if (textContent.classList.contains('expanded')) {
                            this.textContent = 'Leer menos';
                        } else {
                            this.textContent = 'Leer más';
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- about section -->
    <!-- clients section -->
    <div class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Integrantes del grupo</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide clients_Carousel " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="carousel-caption ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clients_box">
                                                    <figure><img src="images/our.png" alt="#"/></figure>
                                                    <h3>Juan Utrera</h3>
                                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact  a more-or-less normal distribution of letters,</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="clients_box">
                                                    <figure><img src="images/our.png" alt="#"/></figure>
                                                    <h3>David Miñano</h3>
                                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,It is a long established fact  a more-or-less normal distribution of letters,</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <i class='fa fa-angle-right'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end clients section -->

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
    <!-- Botón de Volver Arriba -->
    <button onclick="topFunction()" id="topBtn" title="Volver arriba">⬆</button>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>

    <!-- Script para el botón de Volver Arriba -->
    <script>
        // Obtener el botón
        var topBtn = document.getElementById("topBtn");

        // Cuando el usuario haga scroll hacia abajo 20px desde la parte superior del documento, muestra el botón
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                topBtn.style.display = "block";
            } else {
                topBtn.style.display = "none";
            }
        }

        // Cuando el usuario haga clic en el botón, desplázate hacia arriba del documento
        function topFunction() {
            document.body.scrollTop = 0; // Para Safari
            document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE y Opera
        }
    </script>
</body>
</html>