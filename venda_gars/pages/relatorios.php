<?php
include '../includes/auth.php';
$user = check_login($mysqli);
?>

<h2>Relatórios</h2>
<p>Aqui você pode visualizar os relatórios de vendas, clientes, produtos, etc.</p>
<!-- Adicione código para gerar relatórios -->

<?php
include '../includes/db.php';
include '../includes/auth.php';

$user = check_login($mysqli);

// Verifica se um relatório foi solicitado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_type = $_POST['report_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $result = null;

    switch ($report_type) {
        case 'total_sales':
            $query = "SELECT SUM(total_price) as total_sales FROM sales WHERE sale_date BETWEEN '$start_date' AND '$end_date'";
            $result = $mysqli->query($query);
            $data = $result->fetch_assoc();
            $report_title = "Total de Vendas de $start_date a $end_date";
            $report_data = "Total de Vendas: R$ " . $data['total_sales'];
            break;

        case 'sales_by_product':
            $query = "SELECT products.name as product_name, SUM(sales.quantity) as total_quantity, SUM(sales.total_price) as total_sales 
                      FROM sales 
                      INNER JOIN products ON sales.product_id = products.id 
                      WHERE sale_date BETWEEN '$start_date' AND '$end_date' 
                      GROUP BY product_name";
            $result = $mysqli->query($query);
            $report_title = "Vendas por Produto de $start_date a $end_date";
            break;

        case 'sales_by_client':
            $query = "SELECT clients.name as client_name, SUM(sales.total_price) as total_sales 
                      FROM sales 
                      INNER JOIN clients ON sales.client_id = clients.id 
                      WHERE sale_date BETWEEN '$start_date' AND '$end_date' 
                      GROUP BY client_name";
            $result = $mysqli->query($query);
            $report_title = "Vendas por Cliente de $start_date a $end_date";
            break;

        default:
            $report_data = "Tipo de relatório inválido.";
    }
}
?>

<h2>Relatórios de Vendas</h2>

<form method="POST" action="relatorios.php">
    <label for="report_type">Tipo de Relatório:</label>
    <select name="report_type" required>
        <option value="total_sales">Total de Vendas</option>
        <option value="sales_by_product">Vendas por Produto</option>
        <option value="sales_by_client">Vendas por Cliente</option>
    </select><br>

    <label for="start_date">Data de Início:</label>
    <input type="date" name="start_date" required><br>

    <label for="end_date">Data de Fim:</label>
    <input type="date" name="end_date" required><br>

    <button type="submit">Gerar Relatório</button>
</form>

<?php if (isset($report_title)): ?>
    <h3><?php echo $report_title; ?></h3>
    <?php if (isset($report_data)): ?>
        <p><?php echo $report_data; ?></p>
    <?php else: ?>
        <table border="1">
            <tr>
                <?php if ($report_type == 'sales_by_product'): ?>
                    <th>Produto</th>
                    <th>Quantidade Vendida</th>
                    <th>Total de Vendas (R$)</th>
                <?php elseif ($report_type == 'sales_by_client'): ?>
                    <th>Cliente</th>
                    <th>Total de Vendas (R$)</th>
                <?php endif; ?>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <?php if ($report_type == 'sales_by_product'): ?>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['total_quantity']; ?></td>
                        <td><?php echo $row['total_sales']; ?></td>
                    <?php elseif ($report_type == 'sales_by_client'): ?>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['total_sales']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
<?php endif; ?>
