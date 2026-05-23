<h2>Sales Order Detail</h2>

<form method="get" class="mb-3">
    <input type="text" name="order_number" placeholder="SO43659" value="<?= $searchNumber ?>" class="form-control w-auto d-inline">
    <button class="btn btn-primary">Search</button>
</form>

<?php if (isset($order) && $order['header']): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h4>Order #<?= $order['header']['SalesOrderNumber'] ?></h4>
            <p>Customer: <?= $order['header']['CustomerName'] ?><br>
               Date: <?= $order['header']['OrderDate'] ?></p>
        </div>
    </div>

    <table class="table">
        <tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr>
        <?php foreach ($order['details'] as $d): ?>
        <tr>
            <td><?= $d['EnglishProductName'] ?></td>
            <td><?= $d['OrderQuantity'] ?></td>
            <td>$<?= number_format($d['UnitPrice'], 2) ?></td>
            <td>$<?= number_format($d['SalesAmount'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php elseif ($searchNumber): ?>
    <div class="alert alert-warning">Order not found</div>
<?php endif; ?>