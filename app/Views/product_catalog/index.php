<h2>Product Catalog</h2>

<form method="get" class="mb-3">
    <select name="category" class="form-select w-auto d-inline">
        <option value="">All</option>
        <?php foreach ($categories as $c): ?>
        <option value="<?= $c['Category'] ?>" <?= $selectedCategory==$c['Category']?'selected':'' ?>><?= $c['Category'] ?></option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-primary">Filter</button>
</form>

<table class="table">
    <tr><th>Category</th><th>Product</th><th>Size</th><th>Price</th></tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['Category'] ?></td>
        <td><?= $p['EnglishProductName'] ?></td>
        <td><?= $p['Size'] ?></td>
        <td>$<?= number_format($p['ListPrice'], 2) ?></td>
    </tr>
    <?php endforeach; ?>
</table>