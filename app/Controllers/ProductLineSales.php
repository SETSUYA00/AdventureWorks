<?php
namespace App\Controllers;
use App\Models\ProductLineSalesModel;

class ProductLineSales extends BaseController
{
    public function index()
    {
        $model = new ProductLineSalesModel();
        $category = $this->request->getGet('category');
        
        $data = [
            'products' => $model->getTopProducts($category, 20),
            'categories' => $model->getCategories(),
            'selectedCategory' => $category,
            'title' => 'Product Line Sales'
        ];
        
        return view('templates/header', $data)
             . view('product_line_sales/index', $data)
             . view('templates/footer');
    }
}