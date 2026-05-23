<h2>Product Catalog</h2>

<form method="get" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['Category'] ?>" 
                        <?= $selectedCategory == $c['Category'] ? 'selected' : '' ?>>
                        <?= $c['Category'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="/product-catalog" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Product Name</th>
            <th>Size</th>
            <th>Weight</th>
            <th class="text-end">List Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= esc($p['Category']) ?></td>
            <td><?= esc($p['Subcategory']) ?></td>
            <td><?= esc($p['ProductName']) ?></td>
            <td><?= esc($p['Size'] ?: 'N/A') ?></td>
            <td><?= $p['Weight'] ? $p['Weight'] . ' kg' : 'N/A' ?></td>
            <td class="text-end">$<?= number_format($p['ListPrice'], 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>