<h2>Sales Order Detail</h2>

<form method="get" class="mb-4">
    <div class="input-group">
        <input type="text" name="order_number" class="form-control" 
               placeholder="Enter Sales Order Number (e.g., SO43659)" 
               value="<?= esc($searchNumber) ?>" required>
        <button type="submit" class="btn btn-primary">View Order</button>
    </div>
</form>

<?php if (isset($order) && $order['header']): ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4>Order #<?= esc($order['header']['SalesOrderNumber']) ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Customer:</strong> <?= esc($order['header']['CustomerName']) ?></p>
                    <p><strong>Email:</strong> <?= esc($order['header']['EmailAddress']) ?></p>
                    <p><strong>Location:</strong> 
                        <?= esc($order['header']['City']) ?>, 
                        <?= esc($order['header']['StateProvinceName']) ?>, 
                        <?= esc($order['header']['CountryRegionCode']) ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Order Date:</strong> <?= date('M d, Y', strtotime($order['header']['OrderDate'])) ?></p>
                    <p><strong>Due Date:</strong> <?= date('M d, Y', strtotime($order['header']['DueDate'])) ?></p>
                    <p><strong>Ship Date:</strong> <?= $order['header']['ShipDate'] ? date('M d, Y', strtotime($order['header']['ShipDate'])) : 'Not shipped' ?></p>
                </div>
            </div>
        </div>
    </div>

    <h5>Line Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Freight</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            foreach ($order['details'] as $item): 
                $grandTotal += $item['SalesAmount'] + $item['TaxAmt'] + ($item['Freight'] / count($order['details']));
            ?>
            <tr>
                <td><?= esc($item['Product']) ?></td>
                <td><?= $item['OrderQuantity'] ?></td>
                <td>$<?= number_format($item['UnitPrice'], 2) ?></td>
                <td>$<?= number_format($item['DiscountAmount'], 2) ?></td>
                <td>$<?= number_format($item['TaxAmt'], 2) ?></td>
                <td>$<?= number_format($item['Freight'] / count($order['details']), 2) ?></td>
                <td class="text-end">$<?= number_format($item['SalesAmount'] + $item['TaxAmt'] + ($item['Freight'] / count($order['details'])), 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-dark">
                <td colspan="6" class="text-end"><strong>Grand Total:</strong></td>
                <td class="text-end"><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>
<?php elseif ($searchNumber): ?>
    <div class="alert alert-warning">Order not found.</div>
<?php endif; ?>