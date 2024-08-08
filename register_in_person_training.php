<?php
// Inclure la connexion à la base de données
include('db_connect.php');

// Collecter les données du formulaire
$training_id = $_POST['training_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$job = $_POST['job'];
$education_level = $_POST['education_level'];
$experience = $_POST['experience'];

// Afficher les valeurs soumises pour débogage
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Vérifier que l'ID de formation existe dans la table in_person_trainings
$check_sql = "SELECT id FROM in_person_trainings WHERE id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $training_id);
$check_stmt->execute();
$check_stmt->store_result();

// Afficher les résultats pour débogage
echo "Nombre de lignes trouvées: " . $check_stmt->num_rows;

if ($check_stmt->num_rows > 0) {
    // Insérer les données dans la base de données
    $sql = "INSERT INTO registrations (training_id, name, email, phone, job, education_level, experience)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $training_id, $name, $email, $phone, $job, $education_level, $experience);

    if ($stmt->execute()) {
        // Envoyer un email de notification
        $to = "emmanuelfosso18@gmail.com";
        $subject = "Nouvelle inscription à la formation";
        $message = "Une nouvelle inscription a été reçue:\n\nNom: $name\nEmail: $email\nTéléphone: $phone\nMétier: $job\nNiveau d'étude: $education_level\nExpérience: $experience";
        mail($to, $subject, $message);

        // Rediriger vers la page de paiement
        header("Location: paiement.php?id=10");
        exit();
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erreur: L'ID de la formation n'existe pas.";
}

$check_stmt->close();
$conn->close();
?>
