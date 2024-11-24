<?php
include '../includes/auth.php';
$user = check_login($mysqli);
?>

<h2>Gestão de Produtos</h2>
<p>Aqui você pode gerenciar os produtos.</p>
<!-- Adicione código para listar, adicionar, editar e excluir produtos -->
<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

$query = "SELECT * FROM products";
$result = $mysqli->query($query);
?>

<h2>Gestão de Produtos</h2>
<a href="?action=create">Adicionar Novo Produto</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td>
            <a href="?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
            <a href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

//criar produto
<?php if ($_GET['action'] == 'create'): ?>
<h2>Adicionar Produto</h2>
<form method="POST" action="?action=store">
    <input type="text" name="name" placeholder="Nome do Produto" required>
    <input type="number" step="0.01" name="price" placeholder="Preço do Produto" required>
    <button type="submit">Salvar</button>
</form>
<?php endif; ?>

//salvar no banco de dados

<?php
if ($_GET['action'] == 'store') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
    $mysqli->query($query);

    header('Location: /produtos');
    exit();
}
?>

//editar produto

<?php
if ($_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = $id";
    $result = $mysqli->query($query);
    $product = $result->fetch_assoc();
?>

<h2>Editar Produto</h2>
<form method="POST" action="?action=update&id=<?php echo $product['id']; ?>">
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
    <button type="submit">Atualizar</button>
</form>
<?php } ?>

//actualizar produto

<?php
if ($_GET['action'] == 'update') {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "UPDATE products SET name = '$name', price = '$price' WHERE id = $id";
    $mysqli->query($query);

    header('Location: /produtos');
    exit();
}
?>


//excluir produto

<?php
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM products WHERE id = $id";
    $mysqli->query($query);

    header('Location: /produtos');
    exit();
}
?>


