<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'Emmanuel15');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour trouver l'utilisateur par email
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            // Authentification réussie
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user'] = $username;
            $_SESSION['welcome_message'] = "Bienvenue, $username !";

            // Redirection vers la page souhaitée après connexion
            $redirect_url = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'index.php';
            unset($_SESSION['redirect_after_login']); // Nettoyer la session après redirection
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }

    $stmt->close();
}
$conn->close();
?>
