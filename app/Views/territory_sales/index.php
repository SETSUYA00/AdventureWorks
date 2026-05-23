<h2>🌍 Territory Sales Drilldown</h2>
<p class="text-muted">Click on a territory card or the "Drill Down" button to see customer details</p>

<!-- Metric Cards -->
<div class="row mb-4">
    <?php foreach ($territories as $t): ?>
    <div class="col-md-4 mb-3">
        <div class="card h-100 bg-primary text-white" style="cursor: pointer;" onclick="location.href='/territory-sales/drilldown/<?= urlencode($t['Territory']) ?>'">
            <div class="card-body">
                <h4><?= $t['Territory'] ?></h4>
                <h2>$<?= number_format($t['TotalSales'], 0) ?></h2>
                <p class="mb-0"><?= number_format($t['OrderCount']) ?> orders | <?= number_format($t['TotalQuantity']) ?> units</p>
                <small class="text-white-50">Click to view customers →</small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Territory Performance Table</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover datatable">
            <thead class="table-light">
                <tr>
                    <th>Territory</th>
                    <th>Total Sales</th>
                    <th>Orders</th>
                    <th>Units</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($territories as $t): ?>
                <tr>
                    <td><strong><?= $t['Territory'] ?></strong></td>
                    <td class="text-success fw-bold">$<?= number_format($t['TotalSales'], 2) ?></td>
                    <td><?= number_format($t['OrderCount']) ?></td>
                    <td><?= number_format($t['TotalQuantity']) ?></td>
                    <td>
                        <a href="/territory-sales/drilldown/<?= urlencode($t['Territory']) ?>" class="btn btn-primary btn-sm">
                            🔍 Drill Down
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>