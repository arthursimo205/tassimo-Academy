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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Page</title>
    <link rel="stylesheet" href="styledetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <nav>
        <div class="logo">Ecommerce</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Offers</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <i class="fas fa-shopping-cart"></i>
        </ul>
    </nav>

    <div class="flex-box">
        <div class="left">
            <div class="main_image">
                <img src="uploads/<?php echo htmlspecialchars($course['flyer']); ?>" class="slide" alt="<?php echo htmlspecialchars($course['name']); ?>">
            </div>
        </div>

        <div class="right">
            <div class="url">Home > Product > </div>

            <div class="pname"><h3><?php echo htmlspecialchars($course['name']); ?></h3></div>
            <div class="ratings">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price"><h4><small> XAF </small> <?php echo number_format($course['price'], 2, ',', ' '); ?></h4></div>

            <div class="pname"><h5>Catégorie: <?php echo htmlspecialchars($course['category']); ?></h5></div>

            <div class="pname"><p><?php echo htmlspecialchars($course['description']); ?></p></div>

            <div class="btn-box">
                <form method="POST" action="paiement.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($course['id']); ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="cart-btn">Add to Cart</button>
                </form>
                <form method="POST" action="paiement.php">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($course['id']); ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="buy-btn">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
