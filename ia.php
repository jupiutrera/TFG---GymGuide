<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - IA Chatbot</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .chatbot-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .chatbot-header {
            background: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .chatbot-messages {
            padding: 10px;
            height: 400px;
            overflow-y: auto;
        }
        .chatbot-input {
            display: flex;
            border-top: 1px solid #ccc;
        }
        .chatbot-input input {
            flex: 1;
            padding: 10px;
            border: none;
        }
        .chatbot-input button {
            padding: 10px;
            border: none;
            background: #007bff;
            color: #fff;
            cursor: pointer;
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
                                        <a class="nav-link" href="ia.php">IA</a>
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
    <!-- Chatbot Section -->
    <section class="chatbot-section">
        <div class="container">
            <div class="chatbot-container">
                <div class="chatbot-header">
                    <h3>GymGuide Chatbot</h3>
                </div>
                <div class="chatbot-messages" id="chatbot-messages">
                    <!-- Aquí se mostrarán los mensajes -->
                </div>
                <div class="chatbot-input">
                    <input type="text" id="user-input" placeholder="Escribe tu pregunta..." />
                    <button onclick="sendMessage()">Enviar</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
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
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        async function sendMessage() {
            const userInput = document.getElementById('user-input').value;
            if (userInput.trim() === '') return;

            const messages = document.getElementById('chatbot-messages');
            const userMessage = document.createElement('div');
            userMessage.textContent = `Tú: ${userInput}`;
            messages.appendChild(userMessage);

            const response = await fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `message=${encodeURIComponent(userInput)}`,
            });
            const data = await response.json();
            const botMessage = document.createElement('div');
            botMessage.textContent = `Bot: ${data}`;
            messages.appendChild(botMessage);

            document.getElementById('user-input').value = '';
            messages.scrollTop = messages.scrollHeight;
        }
    </script>
</body>
</html>