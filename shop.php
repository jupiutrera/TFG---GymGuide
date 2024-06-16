<?php
session_start();
include 'config.php'; // Incluye el archivo de configuración

// Obtener los productos de la base de datos
$sql = "SELECT Producto, Categoria, Descripcion, Precio, ID_producto FROM gymguide_tienda";
$result = $conn->query($sql);

// Inicializar un array para almacenar los productos por categorías
$productos_por_categoria = [];

if ($result->num_rows > 0) {
    // Agrupar productos por categoría
    while ($row = $result->fetch_assoc()) {
        $productos_por_categoria[$row["Categoria"]][] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymGuide - Tienda</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
        .category-btn {
            cursor: pointer;
            background: linear-gradient(45deg, #03cafc, #007bff);
            color: white;
            padding: 10px 20px;
            border: none;
            margin-bottom: 10px;
            display: inline-block;
            width: 100%;
            text-align: left;
            font-size: 18px;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .category-btn:hover {
            background: linear-gradient(45deg, #007bff, #03cafc);
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .product-list {
            display: none; /* Oculto por defecto */
            margin-bottom: 20px;
        }

        .product-list.active {
            display: block; /* Mostrar cuando está activo */
        }

        .product-item {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-item:hover {
            transform: translateY(-10px);
        }

        .product-img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-item h4 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }

        .product-item p {
            margin-bottom: 10px;
            color: #666;
        }

        .product-item .btn {
            background-color: #03cafc;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .product-item .btn:hover {
            background-color: black;
        }

        .product-section {
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .category-btn {
                font-size: 16px;
                padding: 8px 16px;
            }

            .product-item {
                padding: 15px;
            }

            .product-item h4 {
                font-size: 18px;
            }

            .product-item p {
                font-size: 14px;
            }

            .product-item .btn {
                padding: 8px 16px;
            }
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
    <!-- Product Section -->
    <section class="product-section">
        <div class="container">
            <?php foreach ($productos_por_categoria as $categoria => $productos): ?>
                <button class="category-btn"><?php echo htmlspecialchars($categoria); ?></button>
                <div class="product-list">
                    <div class="row">
                        <?php foreach ($productos as $producto): ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product-item">
                                    <a href="shop/product.php?id=<?php echo htmlspecialchars($producto['ID_producto']); ?>">
                                        <img src="images/shop/<?php echo htmlspecialchars($producto['ID_producto']); ?>.jpg" class="product-img" alt="<?php echo htmlspecialchars($producto['Producto']); ?>">
                                        <h4><?php echo htmlspecialchars($producto['Producto']); ?></h4>
                                    </a>
                                    <p>
                                        <?php
                                        if ($producto['Precio'] == 0) {
                                            echo "Gratis";
                                        } else {
                                            echo "€" . number_format($producto['Precio'], 2, ',', '.');
                                        }
                                        ?>
                                    </p>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <form action="add_to_cart.php" method="POST">
                                            <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($producto['ID_producto']); ?>">
                                            <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="login.php">
                                            <input class="btn btn-primary" type="submit" value="Añadir al Carrito" />
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Footer -->
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
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var categoryButtons = document.querySelectorAll(".category-btn");

            categoryButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var productList = this.nextElementSibling;
                    productList.classList.toggle("active");
                });
            });
        });
    </script>
</body>
</html>