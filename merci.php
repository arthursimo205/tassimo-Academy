<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merci pour votre Achat</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            text-align: center;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            display: block;
            margin: 10px 0;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Merci pour votre achat !</h1>
        <p>Votre paiement a été traité avec succès.</p>

        <?php
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', '', 'Emmanuel15');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Obtenir l'ID du produit et la quantité depuis l'URL
        $product_id = intval($_GET['product_id']);
        $quantity = intval($_GET['quantity']);

        // Requête pour obtenir les détails du produit
        $stmt = $conn->prepare("SELECT name, link, price FROM courses WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $course = $result->fetch_assoc();
            echo "<h2>Formation: " . htmlspecialchars($course['name']) . "</h2>";
            echo "<p>Quantité: " . htmlspecialchars($quantity) . "</p>";
            echo "<p>Prix total: " . number_format($course['price'] * $quantity, 2, ',', ' ') . " FCFA</p>";
            echo "<p>Vous pouvez accéder à votre formation via le lien suivant :</p>";
            echo "<a href='" . htmlspecialchars($course['link']) . "' target='_blank'>" . htmlspecialchars($course['link']) . "</a>";
        } else {
            echo "<p>Formation non trouvée.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
