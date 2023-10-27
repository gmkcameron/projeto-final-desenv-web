// Para gerenciar comentários; configurar com DB
<?php
session_start();

$db = new mysqli('localhost', 'seu_usuario', 'sua_senha', 'seu_banco_de_dados');

if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

if (isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $comment_text = $_POST['comment_text'];

    $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, comment_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $user_id, $comment_text);
    $stmt->execute();
    $stmt->close();
    header("Location: post.php?id=$post_id");
}
?>
