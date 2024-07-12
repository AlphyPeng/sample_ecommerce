<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->

<?php
session_name("customer_session");
session_start();

// Logged In
if (
    isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])
    && isset($_SESSION['email']) && isset($_SESSION['image']) && isset($_SESSION['contact']) && isset($_SESSION['address'])
) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $profileImg = $_SESSION['image'];
    $contact = $_SESSION['contact'];
    $address = $_SESSION['address'];
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="../../css/tiny-slider.css" rel="stylesheet">
    <link href="../../scss/style.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Jquery -->
    <script src="../../js/jquery.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="../main/main.php">Furni<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item <?php echo ($current_page == 'main.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../main/main.php">Home</a>
                    </li>
                    <li class="nav-item <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../shop/shop.php">Shop</a>
                    </li>
                    <li class="nav-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../about/about.php">About us</a>
                    </li>
                    <li class="nav-item <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../service/services.php">Services</a>
                    </li>
                    <li class="nav-item <?php echo ($current_page == 'blog.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../blog/blog.php">Blog</a>
                    </li>
                    <li class="nav-item <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
                        <a class="nav-link" href="../contact/contact.php">Contact us</a>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <?php if (!isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/login.php">
                                <i class="bi bi-person me-2"></i>
                                Login
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link">
                                <?php if (!isset($_SESSION['image']) || empty($_SESSION['image'])) { ?>
                                    <img src="../../images/default-profile.png">
                                <?php } else { ?>
                                    <img src="<?php echo '../../../img/user_image/' . $_SESSION['image'] ?>">
                                <?php } ?>

                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="../account/account.php">My Account</a></li>
                                <li><a href="../logout/logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart/cart.php">
                                <div class="inline">
                                    <i class="bi bi-cart"></i>
                                    <div class="cart-quantity-bg d-flex justify-content-center align-items-center">
                                        <span class="cart-quantity"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <script>
        $(document).ready(function() {
            updateCartQuantity();
        });

        function updateCartQuantity() {
            $.ajax({
                url: "../../update.php",
                type: "GET",
                success: function(data) {
                    $(".cart-quantity").text(data);
                },
            });
        }

        setInterval(updateCartQuantity, 500);
    </script>