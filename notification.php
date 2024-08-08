<?php
// notification.php

// Inclure la connexion à la base de données si nécessaire
// include('db_connect.php');

// Récupérer les données POST envoyées par l'API de paiement
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    // Vérifier que les champs requis sont présents
    if (isset($data['transactionId']) && isset($data['amount']) && isset($data['status']) && isset($data['customerEmail'])) {
        $transactionId = $data['transactionId'];
        $amount = $data['amount'];
        $status = $data['status'];
        $customerEmail = $data['customerEmail'];
        $customerFirstName = isset($data['customerFirstName']) ? $data['customerFirstName'] : '';
        $customerLastName = isset($data['customerLastName']) ? $data['customerLastName'] : '';
        $customerPhoneNumber = isset($data['customerPhoneNumber']) ? $data['customerPhoneNumber'] : '';
        
        // Enregistrer la notification dans la base de données si nécessaire
        // $sql = "INSERT INTO notifications (transaction_id, amount, status, customer_email, customer_first_name, customer_last_name, customer_phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("sssssss", $transactionId, $amount, $status, $customerEmail, $customerFirstName, $customerLastName, $customerPhoneNumber);
        // $stmt->execute();
        // $stmt->close();

        // Envoyer un email de notification
        $to = "emmanuelfosso205@gmail.com"; // Remplacez par votre adresse email
        $subject = "Notification de Paiement";
        $message = "Une nouvelle inscription a la formation a été reçue :\n\n";
        $message .= "Transaction ID: $transactionId\n";
        $message .= "Montant: $amount\n";
        $message .= "Statut: $status\n";
        $message .= "Email Client: $customerEmail\n";
        $message .= "Prénom Client: $customerFirstName\n";
        $message .= "Nom Client: $customerLastName\n";
        $message .= "Numéro de Téléphone Client: $customerPhoneNumber\n";

        mail($to, $subject, $message);
        
        // Répondre avec un message de succès
        echo json_encode(['success' => true, 'message' => 'Notification reçue et traitée.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Données de notification manquantes.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
}
?>
