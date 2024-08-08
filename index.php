<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'Emmanuel15');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les formations
$formations_sql = "SELECT * FROM courses";
$formations_result = $conn->query($formations_sql);

// Récupérer les catégories
$categories_sql = "SELECT DISTINCT category FROM courses";
$categories_result = $conn->query($categories_sql);

// Initialiser le panier si ce n'est pas déjà fait
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Compter le nombre d'articles dans le panier
$cart_count = count($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>Tassimo Academy - Accueil</title>

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
                            <li><a href="#"><i class="fas fa-envelope"></i> tassimoconstruction18.com</a></li>
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
                        <h2>Accueil</h2>
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

    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <!-- Blog Area -->
                    <div class="row">
                    <?php while ($formation = $formations_result->fetch_assoc()): ?>
    <!-- Single Blog -->
    <div class="col-md-6">
        <div class="single-blog">
            <div class="blog-thumb">
                <img src="uploads/<?php echo $formation['flyer']; ?>" alt="">
            </div>

            <div class="blog-content">
                <div class="blog-meta">
                    <p>Catégorie: <a href="#"><?php echo $formation['category']; ?></a></p>
                </div>
                <h3><a href="#"><?php echo $formation['name']; ?></a></h3>
                <?php
                // Extrait les premiers mots de la description
                $description = $formation['description'];
                $description_excerpt = implode(' ', array_slice(explode(' ', $description), 0, 15)); // 15 mots pour l'extrait
                ?>
                <p class="text"><?php echo htmlspecialchars($description_excerpt); ?>...</p>
                <a href="detail.php?id=<?php echo $formation['id']; ?>" class="bttn-sm">Lire plus</a>
                
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="course_id" value="<?php echo $formation['id']; ?>">
                    <button type="submit" class="bttn-sm">Ajouter au panier</button>
                </form>
            </div>
        </div>
    </div>
    <!-- // Single Blog -->
<?php endwhile;?>
                    </div>
                    <!-- // Blog Area -->

                    <!-- Blog Pagination -->
                    <div class="blog-pagination text-center">
                        <ul>
                            <li><a href="#"><i class="fas fa-angle-left"></i></a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- // Blog Pagination -->
                </div>

                <!-- sidebar widget -->
                <div class="col-lg-4">
                    <!-- Single sidebar widget -->
                    <div class="sidebar-widget search-widget">
                        <form action="#">
                            <input type="text" placeholder="search" required>
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- // Single sidebar widget -->

                    <!-- Single sidebar widget -->
                    <div class="sidebar-widget sidebar-list">
    <h3>Catégories</h3>
    <ul>
        <?php while ($category = $categories_result->fetch_assoc()): ?>
        <li><a href="#"><?php echo htmlspecialchars($category['category']); ?></a></li>
        <?php endwhile; ?>
    </ul>
</div>

                    <!-- // Single sidebar widget -->

                    <!-- Single sidebar widget -->
                    <div class="sidebar-widget popular-posts">
                        <h3>Articles populaires</h3>
                        <ul>
                            <!-- Single Popular Post -->
                            <li><a href="#">
                                    <span class="popular-post-thumd">
                                        <img src="assets/img/blog/blog-1.jpg" alt="">
                                    </span>
                                    <div class="popular-post-content">
                                        <h4>Google Search tips</h4>
                                        <p class="post-meta"><i class="fas fa-eye"></i>5963</p>
                                    </div>
                                </a></li>
                            <!-- // Single Popular Post -->
                            <!-- Single Popular Post -->
                            <li><a href="#">
                                    <span class="popular-post-thumd">
                                        <img src="assets/img/blog/blog-2.jpg" alt="">
                                    </span>
                                    <div class="popular-post-content">
                                        <h4>How to do seo?</h4>
                                        <p class="post-meta"><i class="fas fa-eye"></i>5963</p>
                                    </div>
                                </a></li>
                            <!-- // Single Popular Post -->
                            <!-- Single Popular Post -->
                            <li><a href="#">
                                    <span class="popular-post-thumd">
                                        <img src="assets/img/blog/blog-3.jpg" alt="">
                                    </span>
                                    <div class="popular-post-content">
                                        <h4>How to Marketing?</h4>
                                        <p class="post-meta"><i class="fas fa-eye"></i>5963</p>
                                    </div>
                                </a></li>
                            <!-- // Single Popular Post -->
                            <!-- Single Popular Post -->
                            <li><a href="#">
                                    <span class="popular-post-thumd">
                                        <img src="assets/img/blog/blog-4.jpg" alt="">
                                    </span>
                                    <div class="popular-post-content">
                                        <h4>Want to Earn money?</h4>
                                        <p class="post-meta"><i class="fas fa-eye"></i>5963</p>
                                    </div>
                                </a></li>
                            <!-- // Single Popular Post -->
                            <!-- Single Popular Post -->
                            <li><a href="#">
                                    <span class="popular-post-thumd">
                                        <img src="assets/img/blog/blog-5.jpg" alt="">
                                    </span>
                                    <div class="popular-post-content">
                                        <h4>Creative Blog writer</h4>
                                        <p class="post-meta"><i class="fas fa-eye"></i>5963</p>
                                    </div>
                                </a></li>
                            <!-- // Single Popular Post -->
                        </ul>
                    </div>
                    <!-- // Single sidebar widget -->

                    <!-- Single sidebar widget -->
                    <div class="sidebar-widget tags">
                        <h3>Tags</h3>
                        <ul>
                            <li><a href="#">Seo</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Tricks</a></li>
                        </ul>
                    </div>
                    <!-- // Single sidebar widget -->

                </div>
            </div>
            <!-- // sidebar widget -->
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding call-to-action bg-overlay" style="background-image: url(assets/img/cta-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="inner-promo">
                        <h2>N'hesitez-plus nous sommes là pour vous!</h2>
                        <p>Nous disposons d'une  main-d'oeuvre experte qui justifie notre éfficité et notre respets des délais</p>
                        <a href="contact.php" class="bttn-md-light">Contact-Nous</a>
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
                <p class="copyright-text">&copy; 2019 All Rights Reserved | Design by <a href="https://www.facebook.com/profile.php?id=100078905225165&mibextid=ZbWKwl">TASSIMO CONSTRUCTION SARL</a></p>
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
