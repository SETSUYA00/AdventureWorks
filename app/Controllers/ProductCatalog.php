<?php
namespace App\Controllers;
use App\Models\ProductModel;

class ProductCatalog extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $category = $this->request->getGet('category');
        
        $data = [
            'categories' => $model->getCategories(),
            'products' => $model->getProducts($category),
            'selectedCategory' => $category,
            'title' => 'Product Catalog'
        ];
        
        return view('templates/header', $data)
             . view('product_catalog/index', $data)
             . view('templates/footer');
    }
}