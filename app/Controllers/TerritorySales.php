<?php
namespace App\Controllers;
use App\Models\TerritorySalesModel;

class TerritorySales extends BaseController
{
    public function index()
    {
        $model = new TerritorySalesModel();
        
        $data = [
            'territories' => $model->getTerritorySummary(),
            'title' => 'Territory Sales'
        ];
        
        return view('templates/header', $data)
             . view('territory_sales/index', $data)
             . view('templates/footer');
    }
    
    public function drilldown($territory)
    {
        $model = new TerritorySalesModel();
        $territory = urldecode($territory);
        
        // Get customers for this territory
        $customers = $model->getCustomersByTerritory($territory);
        
        // Get all orders for this territory in a single query (optimized)
        $allOrders = $model->getOrdersByTerritory($territory);
        
        // Organize orders by customer
        $ordersByCustomer = [];
        foreach ($allOrders as $order) {
            $customerName = $order['CustomerName'];
            if (!isset($ordersByCustomer[$customerName])) {
                $ordersByCustomer[$customerName] = [];
            }
            $ordersByCustomer[$customerName][] = $order;
        }
        
        // Attach orders to each customer
        foreach ($customers as &$customer) {
            $customer['orders'] = $ordersByCustomer[$customer['CustomerName']] ?? [];
        }
        
        $data = [
            'territory' => $territory,
            'customers' => $customers,
            'title' => $territory . ' - Customer Details'
        ];
        
        return view('templates/header', $data)
             . view('territory_sales/drilldown', $data)
             . view('templates/footer');
    }
}