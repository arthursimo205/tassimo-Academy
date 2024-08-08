
<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Stocke l'URL actuelle pour la redirection après connexion
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login_register.php"); // Redirige vers la page de connexion
    exit();
}

// Afficher le message de bienvenue si disponible
if (isset($_SESSION['welcome_message'])) {
    echo "<p>{$_SESSION['welcome_message']}</p>";
    unset($_SESSION['welcome_message']);
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'Emmanuel15');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération de l'ID du produit depuis l'URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Requête pour récupérer les détails du produit
$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    echo "<p>Formation non trouvée.</p>";
    exit;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>TASSIMO ACADEMY</title>

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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    <div class="header-top ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-info">
                        <ul>
                            <li><a href="#"><i class="fas fa-phone"></i> +237 656 30 14 84 </a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i>tassimoconstruction18@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-top-right text-right">
                        <!-- Socila Links -->
                        <div class="social-links no-border">
                            <ul>
                                <li><a href="https://www.facebook.com/profile.php?id=100078905225165&mibextid=ZbWKwl"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://vm.tiktok.com/ZMMNxtqRw/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="www.linkedin.com/in/simo-innocant-8688522b9"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- //Socila Links -->
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Rejoingez-Nous</a>
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
                <a class="navbar-brand" href="index.html"><img src="assets/img/favicon.ico" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto main-menu">
                        <li class="nav-item"><a class="nav-link" href="index.html">Acceuil</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">A Propos</a></li>
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Services
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="service.html">Service</a>
                                <a class="dropdown-item" href="services-details.html">Service Details</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
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
                        <h2>A Propos</h2>
                        <ul>
                            <li><a href="index.html">Acceuil</a></li>
                            <li>A Propos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Breadcrumb Area -->

    <!-- About Area -->
    <section class="section-padding bg-white about-area">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <!-- section title -->
                    <div class="section-title">
                        <h4><?php echo htmlspecialchars($course['name']); ?></h4>
                        <div class="section-line">
                            <span></span>
                            <span class="line-big"></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="ratings">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
                    <!-- // section title -->

                    <div class="about-us">
                        <p>Catégorie: <?php echo htmlspecialchars($course['category']); ?></p>

                        <a href="paiement.php?id=<?php echo $id; ?>" class="bttn-md"><?php echo number_format($course['price'], 2, ',', ' '); ?>  XAF </a>
                        <div class="description">
                        <p><?php echo htmlspecialchars($course['description']); ?></p>

                        </div>

                        

                        


                        <a href="paiement.php?id=<?php echo $id; ?>" class="bttn-md">ACHETER</a>

                            <a href="index.php" class="bttn-md">MENU</a>
                    </div>
                </div>
                <div class="col-md-6">
                <img src="uploads/<?php echo htmlspecialchars($course['flyer']); ?>" class="slide" alt="<?php echo htmlspecialchars($course['name']); ?>">
                </div>
            </div>
        </div>
    </section>
    <!-- // About Area -->

    <!-- Feature Area-->
    <section class="feature-area section-padding pb-90 bg-light">
        <div class="container">
      <p>  <h3>Laisser un commentaire</h3></p>
      <p>  <form action="post.php?id=<?php echo $id; ?>" method="POST">
            <textarea name="comment_content" rows="4" required></textarea>
            <button type="submit" name="submit_comment">Envoyer</button>
        </form>

        </p>        <!-- section title -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2>Notre Equipe Comprends</h2>
                        <div class="section-line">
                            <span></span>
                            <span class="line-big"></span>
                            <span></span>
                        </div>
                        <p>Concrétisons ensemble vos idées en réalisant des espaces uniques et fonctionnels qui dépassent vos attentes.</p>
                    </div>
                </div>
            </div>
            <!-- // section title -->

            <!-- Service content -->
            <div class="row">
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-chart-bar"></i>
                        <h2>Directeur Général</h2>
                        <p>Responsable et chefs de Projets.Diplomé de l'Institut Universitaire de Technologique;</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- Single Service -->
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-chart-pie"></i>
                        <h2>Architectes</h2>
                        <p>Ils Assurent concrétisation des idées,de la réalisation de plans rendu architecturaux.</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- Single Service -->
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-coins"></i>
                        <h2>Ingenieurs</h2>
                        <p>Tous diplomés d'universités pretigieuse,ils leads nos travaux avec dynamisme.</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- Single Service -->
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-filter"></i>
                        <h2>Community Manager</h2>
                        <p>Notre politique de management services est basé sur vous ,ceux pour qui nous existons....</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- Single Service -->
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-chart-line"></i>
                        <h2>Man-oeuvres</Man-oeuvres></h2>
                        <p>Nous disposons d'une forte main-d'oeuvres qui justifie notre éfficité et notre respets des délais</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- Single Service -->
                <!-- Single Service -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-service text-center">
                        <i class="fas fa-dollar-sign"></i>
                        <h2>Stagiaires</h2>
                        <p>Nous avons a coeur la formation des jeunes c'est la raison pour laquelle,nous formons chaque année</p>
                        <a href="www.linkedin.com/in/simo-innocant-8688522b9" class="bttn-sm">Savoir plus</a>
                    </div>
                </div>
                <!-- // Single Feature -->
            </div>
        </div>
    </section>
    <!-- // Feature Area-->
    <!-- Call to Action -->
    <section class="section-padding call-to-action bg-overlay" style="background-image: url(assets/img/cta-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="inner-promo">
                        <h2>N'hesitez-plus nous sommes là pour vous!</h2>
                        <p>Nous disposons d'une  main-d'oeuvre experte qui justifie notre éfficité et notre respets des délais</p>
                        <a href="contact.html" class="bttn-md-light">Contact-Nous</a>
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
                    <img src="assets/img/logo-2.png" alt="">
                    <p>Nous sommes fiers de l’héritage de notre expertise et notre engagement envers l’excellence architecturale. </p>

                    <!-- Socila Links -->
                    <div class="social-links">
                        <ul>
                            <li><a href="https://www.facebook.com/profile.php?id=100078905225165&mibextid=ZbWKwl"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://vm.tiktok.com/ZMMNxtqRw/"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="www.linkedin.com/in/simo-innocant-8688522b9"><i class="fab fa-linkedin-in"></i></a></li>
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
                      <h4>LIENS UTILS</h4>
                    </div>
                    <ul>
                        <li><a href="about.html">A Propos</a></li>
                        <li><a href="service.html">Nos Services</a></li>
                        <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608">FAQ</a></li>
                        <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608">Question? CliC</a></li>
                        <li><a href="contact.html">Contacts</a></li>
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
                        <li><a href="about.html">A Propos</a></li>
                        <li><a href="service.html">Nos Services</a></li>
                        <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608">FAQ</a></li>
                        <li><a href="https://creator.voiceflow.com/prototype/65e31d655671df3be500c608">Question? Clic</a></li>
                        <li><a href="contact.html">Contacts</a></li>
                    </ul>
                </div>
                <script src="https://mediafiles.botpress.cloud/6647cc0f-335a-4bf6-a3e7-26e0f2124f9e/webchat/config.js" defer></script>
            </div>
            <!-- // Single Footer Widget -->


            <!-- Single Footer Widget -->
            <div class="col-lg-4">
                <div class="footer-widget footer-form">
                    <!-- Footer Title -->
                    <div class="footer-widget-title">
                        <h4>ECRIVEZ-NOUS</h4>
                    </div>
                    <!-- // Footer Title -->
                    <p>Ecrivez-nous et prenez un rendez-vous.</p>
                    <form action="Sinnocant93@gmail.com">
                        <input type="email" name="email" required placeholder="Email">
                        <button type="submit">ENVOYER</button>
                    </form>
                </div>
               <script type="text/javascript">
(function(d, t) {
  var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
  v.onload = function() {
    window.voiceflow.chat.load({
      verify: { projectID: '65e31d655671df3be500c607' },
      url: 'https://general-runtime.voiceflow.com',
      versionID: 'production'
    });
  }
  v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
})(document, 'script');
</script>
                  
        
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
                <p class="copyright-text">&copy; 2019 All Rights Reserved | Design by <a href="https://www.facebook.com/profile.php?id=100078905225165&mibextid=ZbWKwl">TASSIMO ACADEMY</a></p>
            </div>

            <div class="col-md-6">
                <div class="footer-copyright-nav text-right">
                    <ul>
                        <li><a href="www.linkedin.com/in/simo-innocant-8688522b9">Term</a></li>
                        <li><a href="www.linkedin.com/in/simo-innocant-8688522b9">FAQ</a></li>
                        <li><a href="#www.linkedin.com/in/simo-innocant-8688522b9">Site map</a></li>
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
