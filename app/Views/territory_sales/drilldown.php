<h2>🌍 <?= $territory ?> - Customer Details</h2>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/territory-sales">← Territories</a></li>
        <li class="breadcrumb-item active"><?= $territory ?></li>
    </ol>
</nav>

<?php if (empty($customers)): ?>
    <div class="alert alert-warning">
        <h5>No customers found</h5>
        <p>No customer data available for this territory.</p>
    </div>
<?php else: ?>
    
    <div class="alert alert-info">
        Showing <?= count($customers) ?> customers in <?= $territory ?>
    </div>

    <?php foreach ($customers as $index => $customer): ?>
    <div class="card mb-3 border-primary">
        <div class="card-header bg-light" onclick="toggleOrders(<?= $index ?>)" style="cursor: pointer;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">👤 <?= $customer['CustomerName'] ?></h5>
                    <small class="text-muted"><?= $customer['Orders'] ?> orders</small>
                </div>
                <div class="text-end">
                    <h4 class="mb-0 text-success">$<?= number_format($customer['Sales'], 2) ?></h4>
                    <button class="btn btn-sm btn-outline-primary" id="btn-<?= $index ?>">▼ Show Orders</button>
                </div>
            </div>
        </div>
        <div class="card-body d-none" id="orders-<?= $index ?>">
            <?php if (!empty($customer['orders'])): ?>
            <h6>Order History:</h6>
            <table class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customer['orders'] as $order): ?>
                    <tr>
                        <td><strong><?= $order['SalesOrderNumber'] ?></strong></td>
                        <td><?= date('M d, Y', strtotime($order['OrderDate'])) ?></td>
                        <td>$<?= number_format($order['OrderTotal'], 2) ?></td>
                        <td>
                            <a href="/sales-order?order_number=<?= $order['SalesOrderNumber'] ?>" class="btn btn-xs btn-outline-primary btn-sm">
                                View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p class="text-muted mb-0">No orders found for this customer.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>

<?php endif; ?>

<a href="/territory-sales" class="btn btn-secondary">← Back to All Territories</a>

<script>
function toggleOrders(index) {
    const content = document.getElementById('orders-' + index);
    const btn = document.getElementById('btn-' + index);
    
    if (content.classList.contains('d-none')) {
        content.classList.remove('d-none');
        btn.textContent = '▲ Hide Orders';
        btn.classList.remove('btn-outline-primary');
        btn.classList.add('btn-primary');
    } else {
        content.classList.add('d-none');
        btn.textContent = '▼ Show Orders';
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
    }
}
</script>