<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merci - Tassimo Academy</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            color: #333;
            text-align: center;
        }

        .thank-you-wrapper {
            padding: 50px 15px;
            background: #fff;
            margin: 50px auto;
            max-width: 800px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .thank-you-wrapper h1 {
            color: #6c63ff;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .thank-you-wrapper p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #555;
        }

        .thank-you-wrapper .button {
            padding: 10px 20px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
            background-color: #6c63ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .thank-you-wrapper .button:hover {
            background-color: #5a52d2;
        }

        .thank-you-wrapper .button:active {
            background-color: #4e43b2;
        }

        .thank-you-wrapper .product-info {
            border-top: 2px solid #6c63ff;
            padding-top: 20px;
            margin-top: 20px;
        }

        .thank-you-wrapper .product-info h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .thank-you-wrapper .product-info p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="thank-you-wrapper">
        <h1>Merci pour votre confiance! rejoignez la communauté: https://chat.whatsapp.com/LX7UftpgWCbAXEJpQd2DET </h1>
        <p>Nous avons bien reçu votre paiement. Votre commande est en cours de traitement et vous recevrez une confirmation par email sous peu.</p>
        <a href="index.php" class="button">Retour à l'accueil</a>
        <!-- Informations sur le produit acheté -->
        <?php if (isset($_GET['product_id']) && isset($_GET['quantity'])): ?>
            <div class="product-info">
                <h2>Détails de votre achat</h2>
                <p><strong>ID du produit:</strong> <?php echo htmlspecialchars($_GET['product_id']); ?></p>
                <p><strong>Quantité:</strong> <?php echo htmlspecialchars($_GET['quantity']); ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
