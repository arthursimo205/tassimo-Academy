<?php
// in_person_training.php

// Database connection
include 'db_connect.php';

// Fetch training sessions from the database
$sql = "SELECT * FROM in_person_training ORDER BY start_date ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur de requête: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>Tassimo Academy -Formation présentiel</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>
    <!-- // Preloader -->

    <!-- Header top -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-info">
                        <ul>
                            <li><a href="#"><i class="fas fa-phone"></i> +237672146946</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i> tassimoconstruction18@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="header-top-right text-right">
                        <!-- Socila Links -->
                        <div class="social-links no-border">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- //Socila Links -->
                        <a href="login_register.php" class="bttn-sm">Rejoingnez-nous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // Header top -->

    <!--Header Area-->
    <header class="header-area white-bg">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="assets/img/logo-2 (2).png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto main-menu">
                        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="login_register.php">connexion</a></li>
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Formation presentiel
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="blog.php">blog</a>
                                <a class="dropdown-item" href="in_person_training.php"> Formation presentiel</a>
                            </div>
                        </li>

                        
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
                    </ul>

                    <div class="header-btn justify-content-end">
                        <button type="button" class="search-btn"><i class="fas fa-search"></i></button>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <!--// Header Area-->

    <!--Full Search-->
    <div class="search-full">
        <button type="submit" class="search-close"><i class="fas fa-times"></i></button>
        <div class="search-full--inner">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form class="main-search-form">
                            <input type="search" name="main_search" id="main_search" placeholder="Search here...">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Full Search-->

    <!-- Breadcrumb Area -->
    <section class="section-padding breadcrumb-area bg-overlay" style="background-image: url(assets/img/breadcrumb.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="banner-title text-center">
                        <h2>Inscription Formation presentiel</h2>
                        <ul>
                            <li><a href="#">Accueil</a></li>
                            <li>Formations</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Breadcrumb Area -->

    <?php while ($row = $result->fetch_assoc()): ?>
    <section class="section-padding call-back-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="uploads/<?php echo htmlspecialchars($row['flyer']); ?>" alt="Flyer de la formation">
                </div>
                <div class="col-md-6">
                    <div class="call-back-content">
                        <!-- Section title -->
                        <div class="section-title text-center">
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                            <div class="section-line">
                                <span></span>
                                <span class="line-big"></span>
                                <span></span>
                            </div>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
                            <P>Après votre inscription vous serez directement ajouté(e) dans le groupe de la communauté</P>
                            <p><strong>Prix Inscription:</strong> <?php echo htmlspecialchars($row['price']); ?> XAF</p>
                            <p><strong>Date limite d'inscription:</strong> <?php echo htmlspecialchars($row['registration_deadline']); ?></p>
                            <p><strong>Date de début:</strong> <?php echo htmlspecialchars($row['start_date']); ?></p>
                        </div>
                        <form action="form.html" method="POST">
    <input type="hidden" name="training_id" value="<?php echo htmlspecialchars($row['id']); ?>">
    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="phone">Téléphone:</label>
    <input type="text" id="phone" name="phone" required>
    <label for="job">Métier:</label>
    <input type="text" id="job" name="job" required>
    <label for="education_level">Niveau d'étude:</label>
    <input type="text" id="education_level" name="education_level" required>
    <label for="experience">Avez-vous déjà une expérience professionnelle avec cette formation ?</label>
    <select id="experience" name="experience" required>
        <option value="oui">Oui</option>
        <option value="non">Non</option>
    </select>
    <form action="form.html">
    <button type="submit">Cliquez ici</button>
</form>
</form>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>



     <!-- Call to Action -->
     <section class="section-padding call-to-action bg-overlay" style="background-image: url(assets/img/cta-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="inner-promo">
                        <h2>LOOKING FOR AN EXCELENT BUSINESS SOLUTION ?</h2>
                        <p> Commodi cupiditate nam dolores accusamus labore dignissimos, eum pariatur.</p>
                        <a href="send_message.php" class="bttn-md-light">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Call to Action -->

    <!-- Footer Area -->
    <footer class="footer-area section-padding pb-90" style="background-image: url(assets/img/footer-map.png);">
        <div class="container">
            <div class="row">
                <!-- Single Footer Widget -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget footer-about">
                        <img src="assets/img/logo.png" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae illo tempora quia, quasi laboriosam officia eaque. Repellat explicabo non ex!</p>

                        <!-- Socila Links -->
                        <div class="social-links">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- //Socila Links -->
                    </div>
                </div>
                <!-- // Single Footer Widget -->
                <!-- Single Footer Widget -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-widget footer-nav">
                        <div class="footer-widget-title">
                            <h4>Quick Links</h4>
                        </div>
                        <ul>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="service.html">Our Services</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="contact.html">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <!-- // Single Footer Widget -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-widget footer-nav">
                        <div class="footer-widget-title">
                            <h4>Services</h4>
                        </div>
                        <ul>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="service.html">Our Services</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="contact.html">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <!-- // Single Footer Widget -->


                <!-- Single Footer Widget -->
                <div class="col-lg-4">
                    <div class="footer-widget footer-form">
                        <!-- Footer Title -->
                        <div class="footer-widget-title">
                            <h4>Newsletter</h4>
                        </div>
                        <!-- // Footer Title -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo architecto, id, ullam omnis qui repudiandae! Illo architecto, id, ullam omnis qui repudiandae!</p>
                        <form action="#">
                            <input type="email" name="email" required placeholder="Email">
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>
                <!-- // Single Footer Widget -->

            </div>
        </div>
    </footer>
    <!-- // Footer Area -->

    <!-- copyright Area -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright-text">&copy; 2024 All Rights Reserved | Design by <a href="">Tassimo Academy</a></p>
                </div>

                <div class="col-md-6">
                    <div class="footer-copyright-nav text-right">
                        <ul>
                            <li><a href="#">Term</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Site map</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // copyright Area -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.mixitup.js"></script>
    <script src="assets/js/sticky-kit.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>

<?php
$conn->close();
?>
