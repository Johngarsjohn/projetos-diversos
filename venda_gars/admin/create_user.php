<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $query = "INSERT INTO users (name, email, password, is_admin) VALUES ('$name', '$email', '$password', '$is_admin')";
    $mysqli->query($query);

    header('Location: manage_users.php');
    exit();
}
?>

<h2>Adicionar Novo Usuário</h2>
<form method="POST" action="">
    <input type="text" name="name" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Senha" required>
    <label>
        <input type="checkbox" name="is_admin"> Administrador
    </label>
    <button type="submit">Salvar</button>
</form>
