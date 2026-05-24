<?php
namespace App\Controllers;

class TestDb extends BaseController
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            
            // Test 1: Check connection
            $query = $db->query("SELECT VERSION() as version");
            $result = $query->getRow();
            
            echo "<h2>✅ SQL Server Connected!</h2>";
            echo "<p><strong>Version:</strong> " . $result->version . "</p>";
            
            // Test 2: List tables in AdventureWorksDW2012
            $tables = $db->query("
                SELECT TABLE_NAME 
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_TYPE = 'BASE TABLE'
                LIMIT 10
            ")->getResultArray();
            
            echo "<h3>📋 Sample Tables:</h3><ul>";
            foreach ($tables as $table) {
                echo "<li>" . $table['TABLE_NAME'] . "</li>";
            }
            echo "</ul>";
            
            // Test 3: Sample data from DimProduct
            $products = $db->query("
                SELECT EnglishProductName, ListPrice 
                FROM DimProduct 
                WHERE ListPrice > 0
                LIMIT 5
            ")->getResultArray();
            
            echo "<h3>🚲 Sample Products:</h3><ul>";
            foreach ($products as $p) {
                echo "<li>" . $p['EnglishProductName'] . " - $" . $p['ListPrice'] . "</li>";
            }
            echo "</ul>";
            
        } catch (\Exception $e) {
            echo "<h2>❌ Connection Failed</h2>";
            echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
            echo "<hr>";
            echo "<h4>🔧 Quick Fixes:</h4>";
            echo "<ul>";
            echo "<li>Make sure SQL Server service is running</li>";
            echo "<li>Check if PHP sqlsrv extension is installed (php -m | findstr sqlsrv)</li>";
            echo "<li>Verify database name is exactly: AdventureWorksDW2012</li>";
            echo "<li>Try using Windows Authentication (leave username/password empty)</li>";
            echo "</ul>";
        }
    }
}