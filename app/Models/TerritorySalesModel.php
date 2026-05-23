<?php
namespace App\Models;
use CodeIgniter\Model;

class TerritorySalesModel extends Model
{
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
        // Use the EXACT same query that worked in SSMS
        $sql = "SELECT 
                    c.FirstName + ' ' + c.LastName as CustomerName,
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
        $sql = "SELECT 
                    f.SalesOrderNumber,
                    f.OrderDate,
                    SUM(f.SalesAmount) as OrderTotal
                FROM FactInternetSales f
                JOIN DimCustomer c ON f.CustomerKey = c.CustomerKey
                JOIN DimSalesTerritory st ON f.SalesTerritoryKey = st.SalesTerritoryKey
                WHERE c.FirstName + ' ' + c.LastName = ? 
                AND st.SalesTerritoryRegion = ?
                GROUP BY f.SalesOrderNumber, f.OrderDate
                ORDER BY f.OrderDate DESC";
        return $this->db->query($sql, [$customerName, $territory])->getResultArray();
    }

    public function getOrdersByTerritory($territory)
    {
        // Get all orders for a territory in a single query to avoid N+1 problem
        $sql = "SELECT 
                    c.FirstName + ' ' + c.LastName as CustomerName,
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