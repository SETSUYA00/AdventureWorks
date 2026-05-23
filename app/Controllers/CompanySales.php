<?php
namespace App\Controllers;
use App\Models\CompanySalesModel;

class CompanySales extends BaseController
{
    public function index()
    {
        $model = new CompanySalesModel();
        $year = $this->request->getGet('year');
        
        $data = [
            'years' => $model->getYears(),
            'sales' => $model->getSalesByYear($year),
            'selectedYear' => $year,
            'title' => 'Company Sales'
        ];
        
        return view('templates/header', $data)
             . view('company_sales/index', $data)
             . view('templates/footer');
    }
}