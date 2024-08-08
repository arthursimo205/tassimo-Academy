<?php
// Inclure la connexion à la base de données
include('db_connect.php');

// Vérifier que les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collecter les données du formulaire
    $training_id = $_POST['training_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $education_level = $_POST['education_level'];
    $experience = $_POST['experience'];
    $amount = 10000; // Montant fixe pour l'inscription
    $description = "Frais d'inscription pour la formation";

    // Vérifier que l'ID de formation existe dans la table in_person_training
    $check_sql = "SELECT id FROM in_person_training WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $training_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Préparer les données pour l'API de paiement
        $payment_data = array(
            'merchantId' => "PP-F3584",
            'amount' => $amount,
            'description' => $description,
            'channel' => $_POST['channel'],
            'countryCurrencyCode' => 237,
            'referenceNumber' => "REF-" . date('YmdHis'),
            'customerEmail' => $email,
            'customerFirstName' => $name,
            'customerLastname' => '',
            'customerPhoneNumber' => $phone,
            'notificationURL' => 'https://tassimo-academy-site.free.nf/admin-site-master/notification.php', // Remplacez par l'URL de notification de votre choix
            'returnURL' => 'https://tassimo-academy-site.free.nf/merci.php?training_id=' . $training_id, // URL de retour avec l'ID de formation
            'returnContext' => ''
        );

        // Envoi des données à l'API de paiement
        $api_url = 'https://www.paiementpro.net/webservice/onlinepayment/init/curl-init.php';
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payment_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['success']) && $response_data['success']) {
            header('Location: ' . $response_data['url']);
            exit;
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'initiation du paiement. Veuillez réessayer.</div>";
        }
    } else {
        echo "Erreur: L'ID de la formation n'existe pas.";
    }

    $check_stmt->close();
    $conn->close();
} else {
    echo "Erreur: Méthode de requête non autorisée.";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <!-- Ajoutez ici votre en-tête -->
    </header>

    <div class="container">
        <h2>Inscription a la Formation</h2>
        <form id="payment-form" method="POST" action="">
            <div class="form-group">
                <label for="product_id">ID du Produit</label>
                <input type="number" class="form-control" id="product_id" name="product_id" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantité</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="channel">Canal de Paiement</label>
                <select class="form-control" id="channel" name="channel" required>
                    <option value='OMCIV2'>ORANGE CI</option>
                    <option value='MOMOCI'>MTN CI</option>
                    <!-- Ajoutez d'autres options si nécessaire -->
                </select>
            </div>
            <div class="form-group">
                <label for="customerEmail">Email du Client</label>
                <input type="email" class="form-control" id="customerEmail" name="customerEmail" required>
            </div>
            <div class="form-group">
                <label for="customerFirstName">Prénom du Client</label>
                <input type="text" class="form-control" id="customerFirstName" name="customerFirstName" required>
            </div>
            <div class="form-group">
                <label for="customerLastName">Nom du Client</label>
                <input type="text" class="form-control" id="customerLastName" name="customerLastName" required>
            </div>
            <div class="form-group">
                <label for="customerPhoneNumber">Numéro de Téléphone du Client</label>
                <input type="text" class="form-control" id="customerPhoneNumber" name="customerPhoneNumber" required>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre le Paiement</button>
        </form>
    </div>

    <footer>
        <!-- Ajoutez ici votre pied de page -->
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
