<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

// Verifique se o usuário é administrador
if (!$_SESSION['is_admin']) {
    header('Location: /home.php');
    exit();
}

// Consulta todos os usuários
$query = "SELECT * FROM users";
$result = $mysqli->query($query);
?>

<h2>Gestão de Usuários</h2>
<a href="create_user.php">Adicionar Novo Usuário</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Administrador</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $
