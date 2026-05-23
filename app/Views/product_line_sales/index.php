<h2>🏷️ Product Line Sales</h2>

<?php if (empty($products)): ?>
    <div class="alert alert-warning">
        No products found. Check database connection.
    </div>
<?php else: ?>
    <div class="alert alert-success">
        Found <?= count($products) ?> products
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['Product'] ?></td>
                <td><?= $p['Category'] ?></td>
                <td>$<?= number_format($p['TotalSales'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>