<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Nonobakes </title>
    <link rel="icon" href="images/logo.png">
    <script src="js/app.js" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin&family=Herr+Von+Muellerhoff&family=Poiret+One&family=Source+Sans+Pro:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="style-customer.css">
</head>

<body>
    <!-- HEADER -->

    <header>
        <div class="container">
            <nav class="navbar-con">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
                <div class ="logo">
                    <img src="images/logo.png" alt="" class="logoimg">
                    <a href="customer-index.php" class="logo">Nonobakes</a>
                </div>
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="customer-index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="customer-menu.php" class="nav-link ">Menu</a>
                    </li>
                    <li class="nav-item dropdown-nav ">
                        <button class="btn-drops" onclick="myFunction()">
                            About Us <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-cont" id="myDropdown">
                            <a href="about.html">About Us</a>
                            <a href="customer-contacts.php">Contact Us</a>
                            <a href="customer-faqs.php">FAQS</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="customer-cart.php" class="nav-link">Cart</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->

    <section class="hero" id="hero">
        <div class="container">
            <h1 class="headline">Let's Taste Perfection</h1>
            <a href="customer-menu.php" class="btn btn-primary">Order Now</a>
        </div>
    </section>

    <!-- STORY SECTION -->
    <section class="our-story">
        <div class="container">
            <div class="row">
                <div class="description padding-right animate-left">
                    <div class="global-headline">
                        <h3 class="headline headline-dark">Our Story</h3>
                        <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    </div>
                    <p>Created by Jebbie Dela Luz</p>
                    <a href="about.html" class="btn btn-secondary">Learn More</a>
                </div>
                <div class="image animate-right">
                    <img class="story-img" src="images/story-img.png" alt="bread">
                </div>
            </div>
        </div>
    </section>

    <!-- ALWAYS FRESH -->
    <section class="always-fresh shared">
        <div class="container">
            <div class="global-headline">
                <div class="animate-top">
                </div>
                <div class="animate-bottom">
                    <h3 class="headline headline-dark"></h3>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU SECTION -->
    <section class="menu">
        <div class="container">
            <div class="row">
                <div class="image-group padding-right animate-left">
                    <img src="images/square-1.jpg" alt="image">
                    <img src="images/square-2.jpg" alt="image">
                    <img src="images/square-3.jpg" alt="image">
                    <img src="images/square-4.jpg" alt="image">
                </div>
                <div class="description animate-right">
                    <div class="global-headline">
                        <h3 class="headline headline-dark">Menu</h3>
                        <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    </div>
                    <p>All of our baked items were baked with love, enthusiasm, and firm commitment.</p>
                    <a href="customer-menu.php" class="btn btn-secondary">See Full Menu</a>
                </div>
            </div>
        </div>
    </section>

    <!-- TASTY SECTION -->
    <section class="tasty shared">
        <div class="container">
            <div class="global-headline">
                <div class="animate-top">
                </div>
                <div class="animate-bottom">
                    <h3 class="headline headline-dark"></h3>
                </div>
            </div>
        </div>
    </section>

    <!-- BAKERS DELIGHT SECTION -->
    <section class="delight">
        <div class="container">
            <div class="row">
                <div class="description padding-right animate-left">
                    <div class="global-headline">
                        <h3 class="headline headline-dark">Delight</h3>
                        <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    </div>
                    <a href="customer-order.php" class="btn btn-secondary">Make A Reservation</a>
                </div>
                <div class="image-group animate-right">
                    <img class="animate-top" src="images/delight1.jpg" alt="bread">
                    <img class="animate-bottom" src="images/delight2.jpg" alt="bread">
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="back-to-top">
                <a href="#hero"><i class="fas fa-chevron-up"></i></a>
            </div>
            <div class="footer__content">
                <div class="footer__content-about animate-top">
                    <h4>About nonobakes.ph</h4>
                    <div class="asterisk"><i class="fas fa-asterisk"></i></div>
                    <p>All of our baked items were baked with love, enthusiasm, and firm commitment.</p>
                </div>
                <div class="footer__content-divider animate-bottom">
                    <div class="social-media">
                        <h4>Follow Us</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="https://www.facebook.com/nonobakes.ph">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/nonobakes.ph/">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="newsletter-container">
                        <h4>Newsletter</h4>
                        <form action="" class="newsletter-form">
                            <div class="newsletter-form-box">
                                <input type="text" class="newsletter-input" placeholder="Your email address...">
                                <button class="newsletter-btn" type="submit">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>