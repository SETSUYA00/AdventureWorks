<h2>📊 Company Sales Report</h2>
<p class="text-muted">Click on any row to see quarterly breakdown by category</p>

<div class="row mb-4">
    <div class="col-md-12">
        <form method="get" class="d-flex gap-2">
            <select name="year" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">All Years</option>
                <?php foreach ($years as $y): ?>
                <option value="<?= $y['CalendarYear'] ?>" <?= $selectedYear==$y['CalendarYear']?'selected':'' ?>>
                    <?= $y['CalendarYear'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">🔄 Update</button>
            <a href="/company-sales" class="btn btn-outline-secondary">Reset</a>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>

<div class="table-responsive mt-4">
    <table class="table table-hover datatable">
        <thead class="table-dark">
            <tr>
                <th>📅 Year</th>
                <th>📈 Quarter</th>
                <th>🏷️ Category</th>
                <th>💰 Sales Amount</th>
                <th>🔍 Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $chartData = [];
            foreach ($sales as $s): 
                $chartKey = $s['CalendarYear'] . ' Q' . $s['CalendarQuarter'];
                if (!isset($chartData[$chartKey])) $chartData[$chartKey] = 0;
                $chartData[$chartKey] += $s['TotalSales'];
            ?>
            <tr class="clickable-row" onclick="window.location='/product-line-sales?category=<?= urlencode($s['Category']) ?>'">
                <td><strong><?= $s['CalendarYear'] ?></strong></td>
                <td>Q<?= $s['CalendarQuarter'] ?></td>
                <td>
                    <span class="badge bg-<?= 
                        $s['Category']=='Bikes'?'primary':
                        ($s['Category']=='Components'?'success':
                        ($s['Category']=='Clothing'?'warning':'info')) 
                    ?>"><?= $s['Category'] ?></span>
                </td>
                <td class="text-end fw-bold text-success">$<?= number_format($s['TotalSales'], 2) ?></td>
                <td>
                    <a href="/product-line-sales?category=<?= urlencode($s['Category']) ?>" class="btn btn-sm btn-outline-primary">
                        View Products →
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($chartData)) ?>,
        datasets: [{
            label: 'Total Sales',
            data: <?= json_encode(array_values($chartData)) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: { display: true, text: 'Sales by Period' }
        },
        scales: {
            y: { beginAtZero: true, ticks: { callback: function(value) { return '$' + value.toLocaleString(); } } }
        }
    }
});
</script>