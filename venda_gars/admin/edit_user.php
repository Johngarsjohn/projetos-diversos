<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = $mysqli->query($query);
$user_data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Atualiza apenas a senha se um novo valor for fornecido
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $query = "UPDATE users SET name = '$name', email = '$email', password = '$password', is_admin = '$is_admin' WHERE id = $id";
    } else {
        $query = "UPDATE users SET name = '$name', email = '$email', is_admin = '$is_admin' WHERE id = $id";
    }
    $mysqli->query($query);

    header('Location: manage_users.php');
    exit();
}
?>

<h2>Editar Usuário</h2>
<form method="POST" action="">
    <input type="text" name="name" value="<?php echo $user_data['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required>
    <input type="password" name="password" placeholder="Nova Senha (deixe em branco para não alterar)">
    <label>
        <input type="checkbox" name="is_admin" <?php if ($user_data['is_admin']) echo 'checked'; ?>> Administrador
    </label>
    <button type="submit">Atualizar</button>
</form>
