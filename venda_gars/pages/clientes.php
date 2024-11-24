<?php
include '../includes/auth.php';
$user = check_login($mysqli);
?>

<h2>Gestão de Clientes</h2>
<p>Aqui você pode gerenciar os clientes.</p>
<!-- Adicione código para listar, adicionar, editar e excluir clientes -->

<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

$query = "SELECT * FROM clients";
$result = $mysqli->query($query);
?>

<h2>Gestão de Clientes</h2>
<a href="?action=create">Adicionar Novo Cliente</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
            <a href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

//criar cliente

<?php if ($_GET['action'] == 'create'): ?>
<h2>Adicionar Cliente</h2>
<form method="POST" action="?action=store">
    <input type="text" name="name" placeholder="Nome do Cliente" required>
    <input type="email" name="email" placeholder="Email do Cliente" required>
    <button type="submit">Salvar</button>
</form>
<?php endif; ?>

//armazenar cliente

<?php
if ($_GET['action'] == 'store') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "INSERT INTO clients (name, email) VALUES ('$name', '$email')";
    $mysqli->query($query);

    header('Location: /clientes');
    exit();
}
?>


//editar cliente

<?php
if ($_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $query = "SELECT * FROM clients WHERE id = $id";
    $result = $mysqli->query($query);
    $client = $result->fetch_assoc();
?>

<h2>Editar Cliente</h2>
<form method="POST" action="?action=update&id=<?php echo $client['id']; ?>">
    <input type="text" name="name" value="<?php echo $client['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $client['email']; ?>" required>
    <button type="submit">Atualizar</button>
</form>
<?php } ?>

//actualizar cliente

<?php
if ($_GET['action'] == 'update') {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE clients SET name = '$name', email = '$email' WHERE id = $id";
    $mysqli->query($query);

    header('Location: /clientes');
    exit();
}
?>


//excluir cliente

<?php
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM clients WHERE id = $id";
    $mysqli->query($query);

    header('Location: /clientes');
    exit();
}
?>

