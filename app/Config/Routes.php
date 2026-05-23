<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('company-sales', 'CompanySales::index');
$routes->get('company-sales/detail/(:num)/(:num)', 'CompanySales::detail/$1/$2');
$routes->get('product-catalog', 'ProductCatalog::index');
$routes->get('product-catalog/detail/(:num)', 'ProductCatalog::detail/$1');
$routes->get('sales-order', 'SalesOrderDetail::index');
$routes->get('territory-sales', 'TerritorySales::index');
$routes->get('territory-sales/drilldown/(:any)', 'TerritorySales::drilldown/$1');
$routes->get('product-line-sales', 'ProductLineSales::index');