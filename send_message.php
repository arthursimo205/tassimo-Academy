<?php
session_start();

// Connexion à la base de données
$conn = new mysqli('localhost', 'username', 'password', 'database');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$subject = $conn->real_escape_string($_POST['subject']);
$message = $conn->real_escape_string($_POST['message']);

$sql = "INSERT INTO messages (sender_id, receiver_id, content) VALUES ('$sender_id', '$receiver_id', '$message')";

if ($conn->query($sql) === TRUE) {
    header('Location: paiement.php?msg=Message sent successfully');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
