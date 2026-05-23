<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    public function getProducts($category = null)
    {
        $sql = "SELECT p.EnglishProductName, p.ListPrice, p.Size,
                pc.EnglishProductCategoryName as Category
                FROM DimProduct p
                JOIN DimProductSubcategory psc ON p.ProductSubcategoryKey = psc.ProductSubcategoryKey
                JOIN DimProductCategory pc ON psc.ProductCategoryKey = pc.ProductCategoryKey
                WHERE p.ListPrice > 0
                ". ($category ? "AND pc.EnglishProductCategoryName = '$category'" : "") ."
                ORDER BY pc.EnglishProductCategoryName, p.EnglishProductName";
        return $this->db->query($sql)->getResultArray();
    }
    
    public function getCategories()
    {
        return $this->db->query("SELECT EnglishProductCategoryName as Category FROM DimProductCategory")->getResultArray();
    }
}