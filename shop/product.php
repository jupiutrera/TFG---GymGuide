<?php
session_start();
include '../config.php'; // Asegúrate de ajustar la ruta a tu archivo de configuración

// Obtener el ID del producto de la URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar si el ID del producto es válido
if ($product_id <= 0) {
    header("Location: ../404.php");
    exit();
}

// Obtener los detalles del producto de la base de datos
$sql = "SELECT Producto, Categoria, Descripcion, Precio FROM gymguide_tienda WHERE ID_producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: ../404.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - <?php echo htmlspecialchars($product['Producto']); ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .product-detail-section {
            padding: 60px 0;
        }
        .product-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .product-detail {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .product-detail h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .product-detail p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .btn-nav {
            background-color: #03cafc;
            border: none;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-nav:hover {
            background-color: #028aa8;
        }
        .btn-block {
            display: block;
            width: 100%;
            text-align: center;
        }
        .btn-shop {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-shop:hover {
            background-color: #0056b3;
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
                                    <a href="../index.php" class="brand-logo"><img src="../images/logo.png" alt="#" />
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
                                        <a class="nav-link" href="../index.php">Inicio</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="../shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Funcionalidades Fitness
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="../calorie-calculator.php">Calculadora de calorias</a>
                                            <a class="dropdown-item" href="../1RM-calculator.php">Calculadora de 1RM</a>
                                            <a class="dropdown-item" href="../bloquesdefuerza.php">Programación en Bloques de fuerza</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="../shop.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tienda
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="../shop.php">Productos</a>
                                            <a class="dropdown-item" href="../cart.php">Carrito</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../contact.php">Contacto</a>
                                    </li>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../micuenta.php">Mi Cuenta</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../login.php">Iniciar sesión</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../registro.php">Registro</a>
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
    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="../images/shop/<?php echo htmlspecialchars($product_id); ?>.jpg" class="product-img" alt="<?php echo htmlspecialchars($product['Producto']); ?>">
                </div>
                <div class="col-md-6">
                    <div class="product-detail">
                        <h1><?php echo htmlspecialchars($product['Producto']); ?></h1>
                        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($product['Categoria']); ?></p>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($product['Descripcion']); ?></p>
                        <p><strong>Precio:</strong> 
                            <?php
                            if ($product['Precio'] == 0) {
                                echo "Gratis";
                            } else {
                                echo "€" . number_format($product['Precio'], 2, ',', '.');
                            }
                            ?>
                        </p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="../add_to_cart.php" method="POST">
                                <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($product_id); ?>">
                                <button type="submit" class="btn btn-primary btn-block">Añadir al Carrito</button>
                            </form>
                        <?php else: ?>
                            <form action="../login.php">
                                <input class="btn btn-primary btn-block" type="submit" value="Añadir al Carrito" />
                            </form>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <?php if ($product_id > 1): ?>
                                <a href="product.php?id=<?php echo $product_id - 1; ?>" class="btn btn-nav">Anterior</a>
                            <?php endif; ?>
                            <a href="../shop.php" class="btn btn-shop">Volver a la tienda</a>
                            <a href="product.php?id=<?php echo $product_id + 1; ?>" class="btn btn-nav">Siguiente</a>
                        </div>
                    </div>
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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/custom.js"></script>
</body>
</html>