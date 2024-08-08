<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'article - Tassimo Academy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'Emmanuel15');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Afficher les détails de l'article
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Assurez-vous que $id est un entier pour éviter les injections SQL
            $result = $conn->query("SELECT * FROM posts WHERE id=$id");

            if ($result && $post = $result->fetch_assoc()) {
                echo '<h1>' . htmlspecialchars($post['title']) . '</h1>';
                echo '<p>' . nl2br(htmlspecialchars($post['content'])) . '</p>';
            } else {
                die('Commentaire ajouté avec succès..');
            }
        } else {
            die('Commentaire ajouté avec succès.');
        }

        // Formulaire de commentaire
        if (isset($_POST['submit_comment'])) {
            $user_id = 1; // Remplacer par l'ID utilisateur connecté
            $post_id = $id;
            $content = $_POST['comment_content'];

            // Vérifier si le post_id est valide
            $post_check = $conn->query("SELECT id FROM posts WHERE id=$post_id");
            if ($post_check->num_rows > 0) {
                $stmt = $conn->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $user_id, $post_id, $content);
                
                if ($stmt->execute()) {
                    echo "Commentaire ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'ajout du commentaire : " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Article non trouvé, impossible d'ajouter le commentaire.";
            }
        }

        echo '<h2>Commentaires</h2>';
        $result = $conn->query("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = $id ORDER BY c.creation_date DESC");
        while ($comment = $result->fetch_assoc()) {
            echo '<div class="comment">';
            echo '<p><strong>' . htmlspecialchars($comment['username']) . '</strong>: ' . nl2br(htmlspecialchars($comment['content'])) . '</p>';
            echo '<p><em>' . $comment['creation_date'] . '</em></p>';
            echo '</div>';
        }
        ?>

        <!-- Formulaire pour ajouter un commentaire -->
        <h3>Laisser un commentaire</h3>
        <form action="post.php?id=<?php echo $id; ?>" method="POST">
            <textarea name="comment_content" rows="4" required></textarea>
            <button type="submit" name="submit_comment">Envoyer</button>
        </form>
    </div>
</body>
</html>
