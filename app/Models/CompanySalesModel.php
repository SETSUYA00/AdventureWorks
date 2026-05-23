<?php
namespace App\Models;
use CodeIgniter\Model;

class CompanySalesModel extends Model
{
    public function getSalesByYear($year = null)
    {
        $sql = "SELECT d.CalendarYear, d.CalendarQuarter, 
                pc.EnglishProductCategoryName as Category,
                SUM(f.SalesAmount) as TotalSales
                FROM FactInternetSales f
                JOIN DimDate d ON f.OrderDateKey = d.DateKey
                JOIN DimProduct p ON f.ProductKey = p.ProductKey
                JOIN DimProductSubcategory psc ON p.ProductSubcategoryKey = psc.ProductSubcategoryKey
                JOIN DimProductCategory pc ON psc.ProductCategoryKey = pc.ProductCategoryKey
                ". ($year ? "WHERE d.CalendarYear = $year" : "") ."
                GROUP BY d.CalendarYear, d.CalendarQuarter, pc.EnglishProductCategoryName
                ORDER BY d.CalendarYear, d.CalendarQuarter";
        return $this->db->query($sql)->getResultArray();
    }
    
    public function getYears()
    {
        return $this->db->query("SELECT DISTINCT CalendarYear FROM DimDate ORDER BY CalendarYear")->getResultArray();
    }
}