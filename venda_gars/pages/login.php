<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];

            if ($user['role'] == 'admin') {
                header('Location: /admin/dashboard');
            } else {
                header('Location: /home');
            }
            exit();
        }
    }

    $error = "E-mail ou senha incorretos!";
}
?>

<h2>Login</h2>
<form method="POST" action="">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</form>
