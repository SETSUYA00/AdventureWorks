<?php
namespace App\Models;
use CodeIgniter\Model;

class SalesOrderModel extends Model
{
    public function getOrder($orderNumber)
    {
        $header = $this->db->query("
            SELECT SalesOrderNumber, OrderDate, 
                   CONCAT(FirstName, ' ', LastName) as CustomerName
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