<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - AdventureWorks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .clickable-row { cursor: pointer; transition: all 0.2s; }
        .clickable-row:hover { background-color: #f8f9fa; transform: translateX(5px); }
        .expandable-content { display: none; animation: slideDown 0.3s ease-out; }
        .expandable-content.show { display: table-row; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .drill-down-btn { 
            background: none; border: none; color: #0d6efd; 
            cursor: pointer; font-size: 1.2em; transition: transform 0.2s;
        }
        .drill-down-btn.rotated { transform: rotate(90deg); }
        .metric-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; border-radius: 10px; padding: 20px; margin-bottom: 20px;
        }
        .chart-container { position: relative; height: 300px; margin: 20px 0; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">🏢 AdventureWorks Reports</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">🏠 Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/company-sales">📊 Company Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="/territory-sales">🌍 Territory Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="/product-line-sales">🏷️ Product Line</a></li>
                <li class="nav-item"><a class="nav-link" href="/product-catalog">📦 Catalog</a></li>
                <li class="nav-item"><a class="nav-link" href="/sales-order">🧾 Orders</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">