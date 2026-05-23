<h2>Company Sales Report</h2>
<p class="text-muted">Sales by Quarter and Product Category</p>

<form method="get" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <select name="year" class="form-select">
                <option value="">All Years</option>
                <?php foreach ($years as $y): ?>
                    <option value="<?= $y['CalendarYear'] ?>" 
                        <?= $selectedYear == $y['CalendarYear'] ? 'selected' : '' ?>>
                        <?= $y['CalendarYear'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">View Report</button>
        </div>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Category</th>
            <th>2002 Q1</th>
            <th>2002 Q2</th>
            <th>2002 Q3</th>
            <th>2002 Q4</th>
            <th>2003 Q1</th>
            <th>2003 Q2</th>
            <th>2003 Q3</th>
            <th>2003 Q4</th>
            <th>2004 Q1</th>
            <th>2004 Q2</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $categories = ['Bikes', 'Components', 'Clothing', 'Accessories'];
        foreach ($categories as $cat): 
        ?>
        <tr>
            <td><strong><?= $cat ?></strong></td>
            <?php foreach ([2002, 2003, 2004] as $year): ?>
                <?php for ($q = 1; $q <= 4; $q++): ?>
                    <?php if ($year == 2004 && $q > 2) continue; ?>
                    <td class="text-end">
                        <?php 
                        $amount = $matrix[$cat][$year]['Q'.$q] ?? 0;
                        echo $amount > 0 ? '$' . number_format($amount, 2) : '-';
                        ?>
                    </td>
                <?php endfor; ?>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>