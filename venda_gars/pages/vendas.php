<?php
include '../includes/auth.php';
$user = check_login($mysqli);
?>

<h2>Gestão de Vendas</h2>
<p>Aqui você pode gerenciar as vendas.</p>
<!-- Adicione código para listar, adicionar, editar e excluir vendas -->

//listar vendas

<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

$query = "SELECT sales.id, clients.name as client_name, products.name as product_name, sales.quantity, sales.total_price, sales.sale_date 
          FROM sales
          INNER JOIN clients ON sales.client_id = clients.id
          INNER JOIN products ON sales.product_id = products.id";
$result = $mysqli->query($query);
?>

<h2>Gestão de Vendas</h2>
<a href="?action=create">Adicionar Nova Venda</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço Total</th>
        <th>Data da Venda</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['client_name']; ?></td>
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td><?php echo $row['total_price']; ?></td>
        <td><?php echo $row['sale_date']; ?></td>
        <td>
            <a href="?action=edit&id=<?php echo $row['id']; ?>">Editar</a> |
            <a href="?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta venda?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

//criar venda

<?php
if ($_GET['action'] == 'create') {
    $clients_query = "SELECT * FROM clients";
    $clients_result = $mysqli->query($clients_query);

    $products_query = "SELECT * FROM products";
    $products_result = $mysqli->query($products_query);
?>
<h2>Adicionar Venda</h2>
<form method="POST" action="?action=store">
    <select name="client_id" required>
        <option value="">Selecione um Cliente</option>
        <?php while ($client = $clients_result->fetch_assoc()): ?>
        <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <select name="product_id" required>
        <option value="">Selecione um Produto</option>
        <?php while ($product = $products_result->fetch_assoc()): ?>
        <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
        <?php endwhile; ?>
    </select>

    <input type="number" name="quantity" placeholder="Quantidade" required>
    <button type="submit">Salvar</button>
</form>
<?php } ?>

//armazenar venda

<?php
if ($_GET['action'] == 'store') {
    $client_id = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product_query = "SELECT price FROM products WHERE id = $product_id";
    $product_result = $mysqli->query($product_query);
    $product = $product_result->fetch_assoc();

    $total_price = $quantity * $product['price'];

    $query = "INSERT INTO sales (client_id, product_id, quantity, total_price) VALUES ('$client_id', '$product_id', '$quantity', '$total_price')";
    $mysqli->query($query);

    header('Location: /vendas');
    exit();
}
?>

//editar venda

<?php
if ($_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $query = "SELECT * FROM sales WHERE id = $id";
    $result = $mysqli->query($query);
    $sale = $result->fetch_assoc();

    $clients_query = "SELECT * FROM clients";
    $clients_result = $mysqli->query($clients_query);

    $products_query = "SELECT * FROM products";
    $products_result = $mysqli->query($products_query);
?>

<h2>Editar Venda</h2>
<form method="POST" action="?action=update&id=<?php echo $sale['id']; ?>">
    <select name="client_id" required>
        <?php while ($client = $clients_result->fetch_assoc()): ?>
        <option value="<?php echo $client['id']; ?>" <?php if ($sale['client_id'] == $client['id']) echo 'selected'; ?>>
            <?php echo $client['name']; ?>
        </option>
        <?php endwhile; ?>
    </select>

    <select name="product_id" required>
        <?php while ($product = $products_result->fetch_assoc()): ?>
        <option value="<?php echo $product['id']; ?>" <?php if ($sale['product_id'] == $product['id']) echo 'selected'; ?>>
            <?php echo $product['name']; ?>
        </option>
        <?php endwhile; ?>
    </select>

    <input type="number" name="quantity" value="<?php echo $sale['quantity']; ?>" required>
    <button type="submit">Atualizar</button>
</form>
<?php } ?>


//atualizar venda

<?php
if ($_GET['action'] == 'update') {
    $id = $_GET['id'];
    $client_id = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product_query = "SELECT price FROM products WHERE id = $product_id";
    $product_result = $mysqli->query($product_query);
    $product = $product_result->fetch_assoc();

    $total_price = $quantity * $product['price'];

    $query = "UPDATE sales SET client_id = '$client_id', product_id = '$product_id', quantity = '$quantity', total_price = '$total_price' WHERE id = $id";
    $mysqli->query($query);

    header('Location: /vendas');
    exit();
}
?>

//excluir venda

<?php
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM sales WHERE id = $id";
    $mysqli->query($query);

    header('Location: /vendas');
    exit();
}
?>

