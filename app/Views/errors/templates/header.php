<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?> - AdventureWorks Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar { background-color: #2c3e50; }
        .report-container { margin-top: 30px; }
        .table th { background-color: #34495e; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">AdventureWorks DW Reports</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/">Dashboard</a>
                <a class="nav-link" href="/company-sales">Company Sales</a>
                <a class="nav-link" href="/product-catalog">Product Catalog</a>
                <a class="nav-link" href="/sales-order">Sales Order Detail</a>
            </div>
        </div>
    </nav>
    <div class="container report-container">