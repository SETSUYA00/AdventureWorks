<?php
namespace App\Models;
use CodeIgniter\Model;

class SalesOrderModel extends Model
{
    private function concat(string ...$parts): string
    {
        if ($this->db->DBDriver === 'MySQLi') {
            return 'CONCAT(' . implode(", ' ', ", $parts) . ')';
        }
        return implode(" + ' ' + ", $parts);
    }

    public function getOrder($orderNumber)
    {
        $nameExpr = $this->concat('FirstName', 'LastName');
        $header = $this->db->query("
            SELECT SalesOrderNumber, OrderDate, 
                   $nameExpr as CustomerName
            FROM FactInternetSales f
            JOIN DimCustomer c ON f.CustomerKey = c.CustomerKey
            WHERE SalesOrderNumber = ?", [$orderNumber])->getRowArray();
            
        $details = $this->db->query("
            SELECT p.EnglishProductName, f.OrderQuantity, f.UnitPrice, f.SalesAmount
            FROM FactInternetSales f
            JOIN DimProduct p ON f.ProductKey = p.ProductKey
            WHERE f.SalesOrderNumber = ?", [$orderNumber])->getResultArray();
            
        return ['header' => $header, 'details' => $details];
    }
}