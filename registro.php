<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Incluir configuración de la base de datos
require 'config.php';

// Inicializar variables para almacenar mensajes de error
$username_error = $email_error = $password_error = $password_repeat_error = $general_error = "";

// Inicializar variables para mantener los valores ingresados
$username = $email = "";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_repeat = $_POST['password-repeat'];

    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Correo electrónico no válido.";
    }

    // Verificar que las contraseñas coincidan
    if ($pass !== $pass_repeat) {
        $password_repeat_error = "Las contraseñas no coinciden.";
    }

    // Verificar requisitos de la contraseña
    if (strlen($pass) < 8 || !preg_match("/[A-Z]/", $pass) || !preg_match("/[a-z]/", $pass) || !preg_match("/[0-9]/", $pass) || !preg_match("/[\W]/", $pass)) {
        $password_error = "La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un carácter especial.";
    }

    // Verificar si el nombre de usuario ya existe en la tabla `gymguide_usuarios`
    if (empty($username_error) && empty($email_error) && empty($password_error) && empty($password_repeat_error)) {
        $sql_check_user = "SELECT COUNT(*) FROM gymguide_usuarios WHERE Nom_usu = ?";
        $stmt_check_user = $conn->prepare($sql_check_user);
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $stmt_check_user->bind_result($user_count);
        $stmt_check_user->fetch();
        $stmt_check_user->close();

        if ($user_count > 0) {
            $username_error = "El nombre de usuario ya existe. Por favor, elige otro nombre de usuario.";
        }
    }

    // Si no hay errores, proceder con la inserción en la base de datos
    if (empty($username_error) && empty($email_error) && empty($password_error) && empty($password_repeat_error)) {
        // Encriptar la contraseña
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Preparar y ejecutar la consulta SQL
        $sql = "INSERT INTO gymguide_usuarios (Nom_usu, Correo, Passwd) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $general_error = "Error en la preparación de la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $general_error = "Registro exitoso!";
            } else {
                $general_error = "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - GymGuide</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .main-layout {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        header, footer {
            flex-shrink: 0;
        }
        .register-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-top: 200px; /* Añadir más espacio superior para evitar solapamiento */
        }
        .form-wrapper {
            width: 100%;
            max-width: 400px;
            background-color: #fff; /* Fondo blanco para el formulario */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera para el formulario */
          	margin: auto;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 0.875em;
        }
        .register-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var passwordRepeat = document.getElementById("password-repeat").value;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/;
            var valid = true;

            if (!emailPattern.test(email)) {
                document.getElementById("email_error").textContent = "Correo electrónico no válido.";
                valid = false;
            } else {
                document.getElementById("email_error").textContent = "";
            }

            if (!passwordPattern.test(password)) {
                document.getElementById("password_error").textContent = "La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un carácter especial.";
                valid = false;
            } else {
                document.getElementById("password_error").textContent = "";
            }

            if (password !== passwordRepeat) {
                document.getElementById("password_repeat_error").textContent = "Las contraseñas no coinciden.";
                valid = false;
            } else {
                document.getElementById("password_repeat_error").textContent = "";
            }

            return valid;
        }
    </script>
</head>
<body class="main-layout">
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
                        <nav class="navigation navbar navbar-expand-md navbar-dark">
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

    <section class="register-section">
        <div class="container">
            <div class="form-wrapper">
                <h3 class="register-title">Registra una cuenta</h3>
                <?php if (!empty($general_error)) { echo "<p class='error-message'>$general_error</p>"; } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <?php if (!empty($username_error)) { echo "<p class='error-message'>$username_error</p>"; } ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        <p class='error-message' id='email_error'><?php if (!empty($email_error)) { echo $email_error; } ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <p class='error-message' id='password_error'><?php if (!empty($password_error)) { echo $password_error; } ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password-repeat">Repite la contraseña:</label>
                        <input type="password" class="form-control" id="password-repeat" name="password-repeat" required>
                        <p class='error-message' id='password_repeat_error'><?php if (!empty($password_repeat_error)) { echo $password_repeat_error; } ?></p>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <ul class="location_icon">
                            <li><a href="https://www.google.com/maps?q=C/San+Benito+6" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a><br> C/San Benito 6</li>
                            <li><a href="mailto:contacto@gymguide.es"><i class="fa fa-envelope" aria-hidden="true"></i></a><br> contacto@gymguide.es</li>
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

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>