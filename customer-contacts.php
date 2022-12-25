<?php
//Cookies


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Nonobakes</title>
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
                    <a href="customer-index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="customer-menu.php" class="nav-link active">Menu</a>
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

<section class="hero small-size-hero" id="hero">
</section>



<!-- JOIN US SECTION -->
<section class="join-us">
    <div class="container">
                <div class="title text-center">
                    <h3 class="headline headline-dark">Contact Us</h3><br>
                    <div class="asterisk"></div>

                </div>
                <div class="center contact-us">
                    <div class="row table3 animate-left">
                        <div class="column center">
                            <ul class="">
                                    <div class="contacts-title">
                                        <p>Nonobakes.ph</p>
                                        <br><hr class="center"><br>
                                    </div>

                                <li class="inline center">
                                    <a class="link" href="https://www.facebook.com/nonobakes.ph"><b><i class="fab fa-facebook-f"></i></b></a>
                                    <a class="link" href="https://www.instagram.com/nonobakes.ph"><b><i class="fab fa-instagram"></i></b></a>
                                </li>
                                <li>
                                    <br>
                                    <b>Email Address:</b>   nonobakes.ph@gmail.com
                                </li>
                                <li>
                                    <b>Contact Number:</b>  +639611575135
                                </li>
                                <li>
                                    <b>Address: </b>    Cainta,Rizal

                                </li>
                                <br>
                                    <div>
                                        <b>Map Location:</b><br>
                                        <object class="map" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61777.87657631516!2d121.08812164185626!3d14.592392003995643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b87f701edd6b%3A0xe1c1fe496d818869!2sCainta%2C%20Rizal!5e0!3m2!1sen!2sph!4v1644734379426!5m2!1sen!2sph" width="400" height="200">
                                        </object><br><br>
                                    </div>
                            </ul>

                        </div>
                        <div class="column center">
                            <div class="contact-section">
                                <br><br><br>
                                <div class="contacts-title" >
                                    <p>Contact Us</p>
                                    <br><hr class="center"><br>
                                </div>
                                <form class="contact-form" action="" method="post">
                                    <input type="text" class="contact-form-text" name="txtname" placeholder="Your Name" required/>
                                    <input type="text" class="contact-form-text" name="txtsubject" placeholder="Your Subject" required/> <br/>
                                    <input type="email" class="contact-form-text" name="txtemail" placeholder="Your email" required/>
                                    <textarea class="contact-form-text" name="txtmessage" placeholder="Your message" required></textarea>
                                    <div class="center">
                                        <input type="submit" name="btnSubmit" class="contact-form-btn" value="Send"/>
                                    </div>
                                </form>
                                <br>
                                <?php
                                //Import PHPMailer classes into the global namespace
                                //These must be at the top of your script, not inside a function
                                use PHPMailer\PHPMailer\PHPMailer;
                                use PHPMailer\PHPMailer\SMTP;
                                use PHPMailer\PHPMailer\Exception;

                                //Load Composer's autoloader
                                require 'vendor/autoload.php';
                                $mail = new PHPMailer(true);

                                $output = '';

                                if (isset($_POST['btnSubmit'])) {

                                    $name = $_POST['txtname'];
                                    $email = $_POST['txtemail'];
                                    $subject =  $_POST['txtsubject'];
                                    $link =$_POST['txtmessage'];




                                    $mail = new PHPMailer();

                                    $mail->CharSet =  "utf-8";
                                    $mail->IsSMTP();
                                    // enable SMTP authentication
                                    $mail->SMTPAuth = true;
                                    // GMAIL username
                                    $mail->Username = "nonobakes.ph.2@gmail.com";
                                    // GMAIL password
                                    $mail->Password = "Nonobakes.ph123";
                                    $mail->SMTPSecure = "ssl";
                                    // sets GMAIL as the SMTP server
                                    $mail->Host = "smtp.gmail.com";
                                    // set the SMTP port for the GMAIL server
                                    $mail->Port = "465";
                                    $mail->From=$email;
                                    $mail->FromName=$name;
                                    $mail->AddAddress('nonobakes.ph.2@gmail.com', 'Nonobakes.ph');
                                    $mail->Subject  =  $subject;
                                    $mail->IsHTML(true);
                                    $mail->Body    = "Sender: ".$email."
                                                      <br>Name: ".$name."                                                    
                                                      <br>Message:<br>".$link;
                                    try {
                                        if ($mail->Send()) {
                                            echo "<div class='correct error'>";
                                            echo "<div class='close' onclick='this.parentElement.remove()'><i class='fab fa-times-circle inline'></i></div>";
                                            echo "<p>Email is sent.</p>";
                                        } else {
                                            echo "<div class='bar error'>";
                                            echo "<div class='close' onclick='this.parentElement.remove()'><i class='fab fa-times-circle inline'></i></div>";
                                            echo "<p>Mail Error - >" . $mail->ErrorInfo."</p>";
                                        }
                                    } catch (phpmailerException $e) {
                                        echo "<div class='bar error'>";
                                        echo "<div class='close' onclick='this.parentElement.remove()'><i class='fas fa-times-circle inline'></i></div>";
                                        echo "<p>Invalid Email Address.</p>";

                                    }
                                }else{


                                }


                                ?>

                            </div>

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
                    <form action="customer-contacts.php" class="newsletter-form">
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
