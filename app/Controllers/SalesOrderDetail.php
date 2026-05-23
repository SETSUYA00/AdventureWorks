<?php
namespace App\Controllers;
use App\Models\SalesOrderModel;

class SalesOrderDetail extends BaseController
{
    public function index()
    {
        $model = new SalesOrderModel();
        $orderNum = $this->request->getGet('order_number');
        
        $data = [
            'order' => $orderNum ? $model->getOrder($orderNum) : null,
            'searchNumber' => $orderNum,
            'title' => 'Sales Order Detail'
        ];
        
        return view('templates/header', $data)
             . view('sales_order/detail', $data)
             . view('templates/footer');
    }
}