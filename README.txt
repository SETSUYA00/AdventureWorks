====================================================================================
ADVENTUREWORKS DATA WAREHOUSE REPORTS - CODEIGNITER 4 APPLICATION
====================================================================================

PROJECT INFORMATION
====================================================================================
Section: BSIT-3B
Student Name: Simon, John Roldan T. and Dan Riche Balaba
Date Submitted: 4/15/26
Course: Midterm Project - Web Application Development

PROJECT OVERVIEW
====================================================================================
This is a CodeIgniter 4 web application that displays data from the AdventureWorksDW2012
database. The application provides FIVE interactive reports with drill-down capabilities,
charts, and professional UI built on real AdventureWorks data using SQL Server.

Key Features:
- 5 Interactive Reports with drill-down navigation
- Real-time charts using Chart.js
- DataTables with search, sorting, and pagination
- Drill-down from summary to detail data
- Click-through navigation between related reports
- Responsive Bootstrap 5 design
- SQL Server database connectivity (SQLSRV driver)

SYSTEM REQUIREMENTS
====================================================================================
- PHP 8.1 or higher (with intl, mbstring, json extensions)
- SQL Server 2012 or later (with AdventureWorksDW2012 restored)
- SQL Server PHP Driver (sqlsrv and pdo_sqlsrv extensions)
- Microsoft ODBC Driver 17 for SQL Server
- Visual C++ Redistributable 2015-2022
- Composer (for dependency management)
- Modern web browser (Chrome, Firefox, Edge)

INSTALLATION & SETUP
====================================================================================

1. DATABASE SETUP
   a) Download AdventureWorksDW2012.bak from Microsoft documentation
   b) Restore the backup file to your SQL Server instance:
      - Open SQL Server Management Studio (SSMS)
      - Right-click Databases → Restore Database → Device
      - Select AdventureWorksDW2012.bak file
   c) Verify the database is accessible by running:
      SELECT COUNT(*) FROM FactInternetSales

2. CONFIGURE DATABASE CONNECTION
   Edit the .env file in the project root:
   
   database.default.hostname = DESKTOP-VKRMBR2\SQLEXPRESS
   database.default.database = AdventureWorksDW2012
   database.default.username = sa
   database.default.password = [Your SA Password]
   database.default.DBDriver = SQLSRV
   database.default.encrypt = false
   database.default.trustServerCertificate = true
   
   Or edit app/Config/Database.php directly if .env doesn't work

3. INSTALL DEPENDENCIES
   composer install

4. CONFIGURE PHP EXTENSIONS
   Ensure these lines are in your php.ini:
   extension=php_sqlsrv_82_ts_x64.dll
   extension=php_pdo_sqlsrv_82_ts_x64.dll
   
   Note: The "82" indicates PHP 8.2. Adjust if using different PHP version.

5. START THE DEVELOPMENT SERVER
   php spark serve
   
   Then access: http://localhost:8080

6. VERIFY THE APPLICATION
   - Dashboard should show 5 report cards
   - Test drill-down on Territory Sales
   - Verify charts load on Company Sales and Product Line reports

INTERACTIVE FEATURES
====================================================================================

✓ DRILL-DOWN NAVIGATION
  - Territory Sales → Click territory → See salespeople → See their orders
  - Company Sales → Click category row → View products in that category
  - All tables are clickable and navigate to related details

✓ INTERACTIVE CHARTS (Chart.js)
  - Company Sales: Bar chart showing sales by period
  - Product Line Sales: Bar chart of top 10 products
  - Territory Sales: Visual metric cards with hover effects

✓ ADVANCED TABLES (DataTables)
  - Search functionality in all tables
  - Sort by any column (click headers)
  - Pagination for large datasets
  - Responsive design for mobile

✓ DYNAMIC FILTERING
  - Year dropdown filters on Company Sales
  - Category filters on Product Catalog and Product Line
  - Real-time updates without page reload

✓ MODAL POPUPS
  - Product Line Sales: Click "View Trend" to see product performance over time
  - Expandable sections in Territory drill-down

THE 5 REPORTS
====================================================================================

1. COMPANY SALES REPORT (Matrix Report)
   -------------------------------------
   URL: /company-sales
   
   Features:
   - Displays sales by quarter and product category
   - Interactive bar chart visualization
   - Year filter dropdown (All Years, 2010, 2011, 2012, 2013, 2014)
   - Click any row to view products in that category
   - Color-coded category badges (Bikes=blue, Components=green, etc.)
   - Links to Product Line Sales for detailed view
   
   SQL Tables:
   - FactInternetSales, DimDate, DimProduct, DimProductCategory, DimProductSubcategory

2. TERRITORY SALES DRILLDOWN (Hierarchical Report)
   ------------------------------------------------
   URL: /territory-sales
   
   Features:
   - Visual metric cards for each territory (North America, Europe, Pacific, etc.)
   - Shows Total Sales, Order Count, and Units Sold
   - DRILL-DOWN: Click territory → See salespeople in that region
   - EXPAND: Click salesperson to see their individual orders
   - Click-through to Sales Order Detail for full order information
   - Breadcrumb navigation (Territories > [Territory Name])
   
   Drill-down Path:
   Territory → Salesperson → Orders → Order Detail
   
   SQL Tables:
   - FactInternetSales, DimSalesTerritory, DimEmployee, DimCustomer

3. PRODUCT LINE SALES (Top Performers Report)
   -------------------------------------------
   URL: /product-line-sales
   
   Features:
   - Top 20 products by sales amount
   - Category filter (All, Bikes, Components, Clothing, Accessories)
   - Interactive bar chart of top 10 products
   - Rank badges (#1, #2, #3 get gold badges)
   - Click "View Trend" button to see quarterly performance (Modal popup)
   - Shows Units Sold, Average Price, and Total Sales
   
   SQL Tables:
   - FactInternetSales, DimProduct, DimProductCategory, DimProductSubcategory, DimDate

4. PRODUCT CATALOG (Browse Report)
   --------------------------------
   URL: /product-catalog
   
   Features:
   - Browse all finished goods products
   - Filter by product category dropdown
   - Displays Product Name, Category, Subcategory, Size, Weight, List Price
   - Responsive table with DataTables integration
   - Sort by any column
   - Search within table
   
   SQL Tables:
   - DimProduct, DimProductCategory, DimProductSubcategory

5. SALES ORDER DETAIL (Transaction Lookup)
   ----------------------------------------
   URL: /sales-order
   
   Features:
   - Search by Sales Order Number (e.g., SO43659)
   - Displays complete order header:
     * Customer name and email
     * Shipping address (City, State, Country)
     * Order dates (Order Date, Due Date, Ship Date)
     * Salesperson name
   - Line items table showing:
     * Product name
     * Quantity ordered
     * Unit price
     * Discount amount
     * Line total
   - Grand total calculation
   
   SQL Tables:
   - FactInternetSales, DimCustomer, DimGeography, DimProduct, DimEmployee

APPLICATION STRUCTURE
====================================================================================

app/
├── Config/
│   ├── Database.php          [SQL Server connection config]
│   ├── Routes.php            [5 routes defined]
│   └── ...
├── Controllers/
│   ├── Home.php              [Dashboard controller]
│   ├── CompanySales.php      [Sales report + chart data]
│   ├── TerritorySales.php    [Drill-down controller]
│   ├── ProductLineSales.php  [Top products + trends]
│   ├── ProductCatalog.php    [Product listing]
│   ├── SalesOrderDetail.php  [Order lookup]
│   └── ...
├── Models/
│   ├── CompanySalesModel.php [Quarterly sales queries]
│   ├── TerritorySalesModel.php [Territory/person/order queries]
│   ├── ProductLineSalesModel.php [Top product queries]
│   ├── ProductModel.php      [Catalog queries]
│   ├── SalesOrderModel.php   [Order detail queries]
│   └── ...
└── Views/
    ├── templates/
    │   ├── header.php        [Navigation + Chart.js/DataTables CDN]
    │   └── footer.php        [Scripts + jQuery]
    ├── company_sales/
    │   └── index.php         [Table + Chart.js integration]
    ├── territory_sales/
    │   ├── index.php         [Metric cards]
    │   └── drilldown.php     [Expandable drill-down view]
    ├── product_line_sales/
    │   └── index.php         [Top products + trend modal]
    ├── product_catalog/
    │   └── index.php         [Filterable catalog]
    ├── sales_order/
    │   └── detail.php        [Order search + details]
    └── dashboard.php         [5 report cards]

ROUTES DEFINED
====================================================================================
GET /                                    → Home::index (Dashboard with 5 cards)
GET /company-sales                       → CompanySales::index (Sales by quarter)
GET /company-sales/detail/(:num)/(:num)  → CompanySales::detail (Drill-down)
GET /territory-sales                     → TerritorySales::index (Territory list)
GET /territory-sales/drilldown/(:any)    → TerritorySales::drilldown (Detail view)
GET /product-line-sales                  → ProductLineSales::index (Top products)
GET /product-catalog                     → ProductCatalog::index (Product list)
GET /product-catalog/detail/(:num)       → ProductCatalog::detail (Product info)
GET /sales-order                         → SalesOrderDetail::index (Order lookup)

USAGE EXAMPLES
====================================================================================

1. DASHBOARD
   http://localhost:8080/
   - Shows all 5 report cards
   - Navigation bar with all reports

2. COMPANY SALES WITH FILTER
   http://localhost:8080/company-sales?year=2013
   - Shows only 2013 data
   - Chart updates automatically

3. TERRITORY DRILL-DOWN
   http://localhost:8080/territory-sales
   → Click "North America" card
   → See list of salespeople
   → Click arrow next to salesperson name
   → See their orders appear below

4. PRODUCT LINE WITH CATEGORY FILTER
   http://localhost:8080/product-line-sales?category=Bikes
   - Shows only Bikes category
   - Chart shows top bike products

5. ORDER LOOKUP
   http://localhost:8080/sales-order?order_number=SO43659
   - Shows complete order details
   - Lists all products in that order

INTERACTIVE NAVIGATION FLOW
====================================================================================

User Journey Examples:

Path 1: Sales Overview → Products
Company Sales → Click "Bikes" row → Product Line Sales (filtered to Bikes)

Path 2: Territory → Orders
Territory Sales → Click "Australia" → See salespeople → Click salesperson 
→ See their orders → Click order number → Sales Order Detail

Path 3: Top Products → Trends
Product Line Sales → Click "View Trend" button → Modal shows quarterly sales chart

Path 4: Direct Search
Sales Order → Enter "SO43659" → See complete order details immediately

TECHNOLOGY STACK
====================================================================================

Backend:
- CodeIgniter 4.4+ (PHP Framework)
- PHP 8.1+ with SQLSRV extensions
- SQL Server 2012+ (AdventureWorksDW2012 database)

Frontend:
- Bootstrap 5.3 (Responsive CSS framework)
- Chart.js 4.0+ (Interactive charts)
- DataTables 1.13+ (Advanced table features)
- jQuery 3.7+ (DOM manipulation)
- Font Awesome 6.4 (Icons)

Key Libraries via CDN:
- chart.js (charts)
- datatables.net (table sorting/search)
- bootstrap.bundle (responsive layout)
- jquery (javascript utilities)

TROUBLESHOOTING
====================================================================================

Issue: "SQLSRV extension not found"
Solution:
  1. Download Microsoft Drivers for PHP for SQL Server
  2. Copy php_sqlsrv_82_ts_x64.dll to C:\xampp\php\ext\
  3. Add extension=php_sqlsrv_82_ts_x64.dll to php.ini
  4. Restart Apache

Issue: "ODBC Driver not found"
Solution:
  Install Microsoft ODBC Driver 17 for SQL Server:
  https://docs.microsoft.com/en-us/sql/connect/odbc/download-odbc-driver-for-sql-server

Issue: "Charts not loading"
Solution:
  - Check internet connection (Chart.js loads from CDN)
  - Check browser console for JavaScript errors
  - Ensure jQuery is loaded before DataTables

Issue: "Drill-down shows empty data"
Solution:
  - Verify data exists in FactInternetSales table
  - Check that DimSalesTerritory has territory records
  - Ensure DimEmployee has salesperson data

Issue: "404 Not Found on routes"
Solution:
  - Check app/Config/Routes.php has all 5 routes defined
  - Verify controller files exist in app/Controllers/
  - Check file names match exactly (case-sensitive)

Issue: "Database connection failed"
Solution:
  - Verify SQL Server service is running
  - Check hostname in .env matches your server (DESKTOP-VKRMBR2\SQLEXPRESS)
  - Try Windows Authentication (leave username/password blank)
  - Set encrypt=false and trustServerCertificate=true in database config

SAMPLE DATA FOR TESTING
====================================================================================

Valid Order Numbers (for Sales Order Detail):
- SO43659, SO43660, SO43661, SO43662, SO43663
- SO44444, SO45000, SO48000, SO50000, SO55000

Valid Categories (for filters):
- Bikes
- Components
- Clothing
- Accessories

Valid Years (for Company Sales filter):
- 2010, 2011, 2012, 2013, 2014

Valid Territories (for drill-down):
- Australia, Canada, Central, France, Germany, Northeast, Northwest
- Southeast, Southwest, United Kingdom, Northwest, Southeast

DEPLOYMENT CHECKLIST
====================================================================================

Before submitting:
□ All 5 reports working and tested
□ Drill-down navigation tested (Territory → Salesperson → Orders)
□ Charts displaying correctly
□ DataTables search/sort working
□ Mobile responsiveness checked (resize browser to test)
□ No PHP errors or warnings
□ Screenshots taken of:
   - Dashboard (showing all 5 cards)
   - Company Sales (with chart visible)
   - Territory Sales (drill-down expanded)
   - Product Line Sales (with chart)
   - Product Catalog (filtered view)
   - Sales Order Detail (showing order data)
□ README.txt updated with your name/section
□ Folder named correctly: 3B_Roldan_John_S
□ Zipped file created: 3B_Roldan_John_S.zip

IMPORTANT NOTES
====================================================================================

1. INTERACTIVE FEATURES REQUIRE JAVASCRIPT
   - Ensure JavaScript is enabled in browser
   - Internet connection needed for CDN libraries (Chart.js, Bootstrap)

2. DRILL-DOWN FUNCTIONALITY
   - Click on territory cards to see salespeople
   - Click arrow buttons (▶) to expand order lists
   - Click category badges to filter related reports

3. CHART RENDERING
   - Charts render using JavaScript after page loads
   - If charts don't appear, check browser console for errors
   - Charts automatically resize with browser window

4. DATA SECURITY
   - Application uses prepared statements (SQL injection safe)
   - No database write operations (read-only reporting)
   - Input validation on all search parameters

5. PERFORMANCE
   - DataTables handles pagination client-side
   - Large datasets (>1000 rows) may take time to load
   - Consider adding year filters to reduce data volume

CREDITS & REFERENCES
====================================================================================

Data Source:
- AdventureWorksDW2012 sample database by Microsoft
- https://docs.microsoft.com/en-us/sql/samples/

Framework:
- CodeIgniter 4 (https://codeigniter.com/)

UI Components:
- Bootstrap 5 (https://getbootstrap.com/)
- Chart.js (https://www.chartjs.org/)
- DataTables (https://datatables.net/)

Sample Reports Reference:
- https://www.ssw.com.au/archive/standards/adventure-works-samples.html

====================================================================================
END OF README - AdventureWorks Data Warehouse Reports v2.0
====================================================================================