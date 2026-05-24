<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductLineSalesModel extends Model
{
    public function getTopProducts($category = null, $limit = 10)
    {
        $sql = "SELECT 
                    p.EnglishProductName as Product,
                    pc.EnglishProductCategoryName as Category,
                    SUM(f.SalesAmount) as TotalSales,
                    SUM(f.OrderQuantity) as UnitsSold,
                    AVG(f.UnitPrice) as AvgPrice
                FROM FactInternetSales f
                JOIN DimProduct p ON f.ProductKey = p.ProductKey
                JOIN DimProductSubcategory psc ON p.ProductSubcategoryKey = psc.ProductSubcategoryKey
                JOIN DimProductCategory pc ON psc.ProductCategoryKey = pc.ProductCategoryKey
                ". ($category ? "WHERE pc.EnglishProductCategoryName = '$category'" : "") ."
                GROUP BY p.EnglishProductName, pc.EnglishProductCategoryName
                ORDER BY TotalSales DESC
                LIMIT $limit";
        return $this->db->query($sql)->getResultArray();
    }
    
    public function getSalesTrend($productName)
    {
        $sql = "SELECT 
                    d.CalendarYear,
                    d.CalendarQuarter,
                    SUM(f.SalesAmount) as Sales
                FROM FactInternetSales f
                JOIN DimProduct p ON f.ProductKey = p.ProductKey
                JOIN DimDate d ON f.OrderDateKey = d.DateKey
                WHERE p.EnglishProductName = ?
                GROUP BY d.CalendarYear, d.CalendarQuarter
                ORDER BY d.CalendarYear, d.CalendarQuarter";
        return $this->db->query($sql, [$productName])->getResultArray();
    }
    
    public function getCategories()
    {
        return $this->db->query("SELECT EnglishProductCategoryName as Category FROM DimProductCategory ORDER BY EnglishProductCategoryName")->getResultArray();
    }
}