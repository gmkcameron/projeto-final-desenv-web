// Para autenticação de usuários
<?php
session_start();

$db = new mysqli('localhost', 'seu_usuario', 'sua_senha', 'seu_banco_de_dados');

if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
    header("Location: login.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    if ($stmt->num_rows == 1 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
    } else {
        echo "Credenciais inválidas.";
    }
    $stmt->close();
}
?>
