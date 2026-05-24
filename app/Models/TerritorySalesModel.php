<?php
namespace App\Models;
use CodeIgniter\Model;

class TerritorySalesModel extends Model
{
    private function concat(string ...$parts): string
    {
        if ($this->db->DBDriver === 'MySQLi') {
            return 'CONCAT(' . implode(", ' ', ", $parts) . ')';
        }
        return implode(" + ' ' + ", $parts);
    }

    public function getTerritorySummary()
    {
        $sql = "SELECT 
                    st.SalesTerritoryRegion as Territory,
                    SUM(f.SalesAmount) as TotalSales,
                    COUNT(DISTINCT f.SalesOrderNumber) as OrderCount,
                    SUM(f.OrderQuantity) as TotalQuantity
                FROM FactInternetSales f
                JOIN DimSalesTerritory st ON f.SalesTerritoryKey = st.SalesTerritoryKey
                GROUP BY st.SalesTerritoryRegion
                ORDER BY TotalSales DESC";
        return $this->db->query($sql)->getResultArray();
    }
    
    public function getCustomersByTerritory($territory)
    {
        $nameExpr = $this->concat('c.FirstName', 'c.LastName');
        $sql = "SELECT 
                    $nameExpr as CustomerName,
                    SUM(f.SalesAmount) as Sales,
                    COUNT(DISTINCT f.SalesOrderNumber) as Orders
                FROM FactInternetSales f
                JOIN DimSalesTerritory st ON f.SalesTerritoryKey = st.SalesTerritoryKey
                JOIN DimCustomer c ON f.CustomerKey = c.CustomerKey
                WHERE st.SalesTerritoryRegion = ?
                GROUP BY c.FirstName, c.LastName
                ORDER BY Sales DESC";
        return $this->db->query($sql, [$territory])->getResultArray();
    }
    
    public function getOrdersByCustomer($customerName, $territory)
    {
        $nameExpr = $this->concat('c.FirstName', 'c.LastName');
        $sql = "SELECT 
                    f.SalesOrderNumber,
                    f.OrderDate,
                    SUM(f.SalesAmount) as OrderTotal
                FROM FactInternetSales f
                JOIN DimCustomer c ON f.CustomerKey = c.CustomerKey
                JOIN DimSalesTerritory st ON f.SalesTerritoryKey = st.SalesTerritoryKey
                WHERE $nameExpr = ? 
                AND st.SalesTerritoryRegion = ?
                GROUP BY f.SalesOrderNumber, f.OrderDate
                ORDER BY f.OrderDate DESC";
        return $this->db->query($sql, [$customerName, $territory])->getResultArray();
    }

    public function getOrdersByTerritory($territory)
    {
        $nameExpr = $this->concat('c.FirstName', 'c.LastName');
        $sql = "SELECT 
                    $nameExpr as CustomerName,
                    f.SalesOrderNumber,
                    f.OrderDate,
                    SUM(f.SalesAmount) as OrderTotal
                FROM FactInternetSales f
                JOIN DimCustomer c ON f.CustomerKey = c.CustomerKey
                JOIN DimSalesTerritory st ON f.SalesTerritoryKey = st.SalesTerritoryKey
                WHERE st.SalesTerritoryRegion = ?
                GROUP BY c.FirstName, c.LastName, f.SalesOrderNumber, f.OrderDate
                ORDER BY c.FirstName, c.LastName, f.OrderDate DESC";
        return $this->db->query($sql, [$territory])->getResultArray();
    }
}