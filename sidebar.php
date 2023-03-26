<?php
$current_page = basename($_SERVER["SCRIPT_FILENAME"]);
$dashboard = $customers = $suppliers = $purchase = $sales = $category = $products = $bank_account = $transactions = $all_user = $expense_category = $expense_list = $employee_list = $attendance = $check_attendance = $salary = $article = $cutting_book = $employee_ledger = $production_ledger = $production = $loan = $menu_open_banking = $menu_open_employee = $menu_open_settings = $menu_open_expense = $menu_open_report = $menu_other_shop = $menu_fabrics_bill = $bill_list = $other_shop_sales = $other_shop_expense = $other_shop_report = $daily_ledger = $balance_sheet = $attendance_report = $salary_report = $expense_report = $purchase_report = $expense_report_by_month = $sales_by_category = $sales_report = $ledger_book = $supplier_ledger = $bank_report = $balance_report = $transaction_report = $information = $access_log = $low_stock = $stock_report = $export_db = $log_info = "";

if ($current_page == "dashboard.php") {
    $dashboard = "active";
} else if (($current_page == "customers.php") || ($current_page == "add_customers.php") || ($current_page == "edit_customer.php")) {
    $customers = "active";
} else if (($current_page == "suppliers.php") || ($current_page == "add_suppliers.php") || ($current_page == "edit_supplier.php")) {
    $suppliers = "active";
} else if (($current_page == "purchase.php") || ($current_page == "add_purchase.php") || ($current_page == "purchase_details.php")) {
    $purchase = "active";
} else if (($current_page == "sales_list.php") || ($current_page == "add_sales.php") || ($current_page == "sales_details.php")) {
    $sales = "active";
} else if (($current_page == "category.php") || ($current_page == "add_category.php") || ($current_page == "edit_category.php")) {
    $category = "active";
} else if (($current_page == "products.php") || ($current_page == "add_product.php") || ($current_page == "edit_product.php") || ($current_page == "view_product.php")) {
    $products = "active";
} //sub menu here
else if (($current_page == "shop_information.php") || ($current_page == "edit_shop.php")) {
    $menu_open_settings = "menu-open";
    $information = "active";
} else if (($current_page == "all_users.php") || ($current_page == "add_user.php") || ($current_page == "edit_users.php")){
    $menu_open_settings = "menu-open";
    $all_user = "active";
} else if (($current_page == "expense_category.php") || ($current_page == "add_expense_category.php") || ($current_page == "edit_expense_category.php")) {
    $menu_open_expense = "menu-open";
    $expense_category = "active";
} else if (($current_page == "bank_account.php") || ($current_page == "add_account.php") || ($current_page == "edit_bank_account.php")) {
    $menu_open_banking = "menu-open";
    $bank_account = "active";
} else if (($current_page == "transactions.php") || ($current_page == "add_transaction.php") || ($current_page == "edit_transactions.php")) {
    $menu_open_banking = "menu-open";
    $transactions = "active";
} else if (($current_page == "expense_list.php") || ($current_page == "add_expense.php") || ($current_page == "edit_expense.php")) {
    $menu_open_expense = "menu-open";
    $expense_list = "active";
} else if (($current_page == "employee_list.php") || ($current_page == "add_employee.php") || ($current_page == "edit_employee.php")) {
    $menu_open_employee = "menu-open";
    $employee_list = "active";
} else if (($current_page == "attendance.php") || ($current_page == "give_attendance.php")) {
    $menu_open_employee = "menu-open";
    $attendance = "active";
} else if ($current_page == "check_attendance.php") {
    $menu_open_employee = "menu-open";
    $check_attendance = "active";
} else if (($current_page == "salary.php") || ($current_page == "add_salary.php") || ($current_page == "edit_salary.php")) {
    $menu_open_employee = "menu-open";
    $salary = "active";
} else if (($current_page == "article.php") || ($current_page == "add_article.php") || ($current_page == "edit_article.php")) {
    $menu_open_employee = "menu-open";
    $article = "active";
} else if (($current_page == "cutting_book.php") || ($current_page == "add_cutting.php") || ($current_page == "edit_cutting.php")) {
    $menu_open_employee = "menu-open";
    $cutting_book = "active";
} else if (($current_page == "employee_ledger.php")) {
    $menu_open_employee = "menu-open";
    $employee_ledger = "active";
} else if (($current_page == "production_ledger.php")) {
    $menu_open_employee = "menu-open";
    $production_ledger = "active";
} else if (($current_page == "production.php") || ($current_page == "add_production.php") || ($current_page == "add_production.php") || ($current_page == "production_ledger.php")) {
    $menu_open_employee = "menu-open";
    $production = "active";
} else if (($current_page == "loan.php") || ($current_page == "add_loan.php") || ($current_page == "edit_loan.php")) {
    $menu_open_employee = "menu-open";
    $loan = "active";
} else if ($current_page == "balance_sheet.php") {
    $menu_open_report = "menu-open";
    $balance_sheet= "active";
} else if ($current_page == "attendance_report.php") {
    $menu_open_report = "menu-open";
    $attendance_report= "active";
} else if ($current_page == "expense_report.php") {
    $menu_open_report = "menu-open";
    $expense_report= "active";
} else if ($current_page == "purchase_report.php") {
    $menu_open_report = "menu-open";
    $purchase_report = "active";
} else if (($current_page == "expense_report_by_month.php") || ($current_page == "expense_reports.php")) {
    $menu_open_report = "menu-open";
    $expense_report_by_month= "active";
} else if (($current_page == "balance_report.php") || ($current_page == "balance_reports.php"))  {
    $menu_open_report = "menu-open";
    $balance_report= "active";
} else if (($current_page == "daily_ledger.php") || ($current_page == "add_daily_ledger.php")) {
    $menu_open_report = "menu-open";
    $daily_ledger= "active";
} else if ($current_page == "sales_report.php") {
    $menu_open_report = "menu-open";
    $sales_report= "active";
} else if ($current_page == "ledger_book.php") {
    $menu_open_report = "menu-open";
    $ledger_book= "active";
} else if ($current_page == "supplier_ledger.php") {
    $menu_open_report = "menu-open";
    $supplier_ledger= "active";
} else if ($current_page == "bank_report.php") {
    $menu_open_report = "menu-open";
    $bank_report= "active";
} else if ($current_page == "transaction_report.php") {
    $menu_open_report = "menu-open";
    $transaction_report= "active";
} else if ($current_page == "access_log.php") {
    $menu_open_settings = "menu-open";
    $access_log= "active";
} else if ($current_page == "log_info.php") {
    $menu_open_settings = "menu-open";
    $log_info= "active";
} else if ($current_page == "export_db.php") {
    $menu_open_settings = "menu-open";
    $export_db= "active";
} else if ($current_page == "stock_report.php") {
    $menu_open_report = "menu-open";
    $stock_report= "active";
} else if ($current_page == "low_stock.php") {
    $menu_open_report = "menu-open";
    $low_stock= "active";
} else if (($current_page == "sales_by_category.php") || ($current_page == "sale_by_category.php")) {
    $menu_open_report = "menu-open";
    $sales_by_category= "active";
} else if (($current_page == "other_shop_sales.php") || ($current_page == "add_os_sales.php") || ($current_page == "edit_os_sales.php")) {
    $menu_other_shop = "menu-open";
    $other_shop_sales = "active";
} else if (($current_page == "other_shop_expense.php") || ($current_page == "add_os_expense.php") || ($current_page == "edit_os_expense.php")) {
    $menu_other_shop = "menu-open";
    $other_shop_expense = "active";
} else if (($current_page == "other_shop_report.php")) {
    $menu_other_shop = "menu-open";
    $other_shop_report = "active";
} else if (($current_page == "bill_list.php") || ($current_page == "add_fabrics_bill.php") || ($current_page == "edit_fabrics_bill.php")) {
    $menu_fabrics_bill = "menu-open";
    $bill_list = "active";
}


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo strtoupper($_SESSION['user_type']);?></span>
        <p style="margin-top: 0;margin-bottom: 0;font-size: 14px;margin-left: 50px;"><?php echo $_SESSION['email'];?></p>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link  <?php echo $dashboard ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard

                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="customers.php" class="nav-link <?php echo $customers ?>">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                    Customers

                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="suppliers.php" class="nav-link <?php echo $suppliers ?>">
                <i class="nav-icon fas fa-people-carry"></i>
                <p>
                    Suppliers

                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="purchase.php" class="nav-link <?php echo $purchase ?>">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                    Purchase

                </p>
            </a>
        </li>



        <li class="nav-item">
            <a href="sales_list.php" class="nav-link <?php echo $sales ?>">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Sales
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="category.php" class="nav-link <?php echo $category ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Category

                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="products.php" class="nav-link <?php echo $products ?>">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Products

                </p>
            </a>
        </li>

        <li class="nav-item <?php echo $menu_fabrics_bill ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                    MI Fabrics Bill (IC)
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="bill_list.php" class="nav-link <?php echo $bill_list ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bill List</p>
                    </a>
                </li>
            </ul>


        </li>

        <li class="nav-item <?php echo $menu_other_shop ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                    Others Shop
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="other_shop_sales.php" class="nav-link <?php echo $other_shop_sales ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sales</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="other_shop_expense.php" class="nav-link <?php echo $other_shop_expense ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expense</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="other_shop_report.php" class="nav-link <?php echo $other_shop_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Report</p>
                    </a>
                </li>
            </ul>


        </li>

        <li class="nav-item <?php echo $menu_open_banking ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                    Banking
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item ">
                    <a href="bank_account.php" class="nav-link <?php echo $bank_account ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bank Account</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="transactions.php" class="nav-link <?php echo $transactions ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Transactions</p>
                    </a>
                </li>
            </ul>


        </li>


        <li class="nav-item <?php echo $menu_open_expense ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                    Expense
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="expense_category.php" class="nav-link <?php echo $expense_category ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expense Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="expense_list.php" class="nav-link <?php echo $expense_list ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expense List</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item <?php echo $menu_open_employee ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-house-user"></i>
                <p>
                    HRM
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="employee_list.php" class="nav-link <?php echo $employee_list ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="attendance.php" class="nav-link <?php echo $attendance ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="check_attendance.php" class="nav-link <?php echo $check_attendance ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Check Attendance</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="salary.php" class="nav-link <?php echo $salary ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Salary</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="loan.php" class="nav-link <?php echo $loan ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Loan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="employee_ledger.php" class="nav-link <?php echo $employee_ledger ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Employee Ledger</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="article.php" class="nav-link <?php echo $article ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Article</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="cutting_book.php" class="nav-link <?php echo $cutting_book ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Production Details</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="production.php" class="nav-link <?php echo $production ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Production</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="production_ledger.php" class="nav-link <?php echo $production_ledger ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Production Ledger</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item <?php echo $menu_open_report ?>">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="daily_ledger.php" class="nav-link <?php echo $daily_ledger ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daily Ledger</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="purchase_report.php" class="nav-link <?php echo $purchase_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Purchase Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="sales_report.php" class="nav-link <?php echo $sales_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sales Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="ledger_book.php" class="nav-link <?php echo $ledger_book ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customer Ledger</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="supplier_ledger.php" class="nav-link <?php echo $supplier_ledger ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Supplier Ledger</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="balance_sheet.php" class="nav-link <?php echo $balance_sheet ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Balance Sheet</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="bank_report.php" class="nav-link <?php echo $bank_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bank Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="transaction_report.php" class="nav-link <?php echo $transaction_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Transaction Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="attendance_report.php" class="nav-link <?php echo $attendance_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Attendance Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="salary_report.php" class="nav-link <?php echo $salary_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Salary Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="expense_report.php" class="nav-link <?php echo $expense_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expense Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="stock_report.php" class="nav-link <?php echo $stock_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Stock Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="cutting_report.php" class="nav-link <?php echo $stock_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cutting Report</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="low_stock.php" class="nav-link <?php echo $low_stock ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Low Stock</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="sales_by_category.php" class="nav-link <?php echo $sales_by_category ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sales By Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="expense_report_by_month.php" class="nav-link <?php echo $expense_report_by_month ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expense By Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="balance_report.php" class="nav-link <?php echo $balance_report ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Income VS Expense</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item <?php echo $menu_open_settings ?>">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Settings
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="all_users.php" class="nav-link <?php echo $all_user ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="shop_information.php" class="nav-link <?php echo $information ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Information</p>
                    </a>
                </li>

                <?php
                $user_type = $_SESSION['user_type'];
                if ($user_type == 'admin') {
                ?>
                <li class="nav-item">
                    <a href="access_log.php" class="nav-link <?php echo $access_log ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Access Log</p>
                    </a>
                </li>
                <?php } ?>

                <?php
                $user_type = $_SESSION['user_type'];
                if ($user_type == 'superadmin') {
                ?>

                <li class="nav-item">
                    <a href="log_info.php" class="nav-link <?php echo $log_info ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Log Info</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="export_db.php" class="nav-link <?php echo $export_db ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Export DB</p>
                    </a>
                </li>

                <?php } ?>
            </ul>

        </li>

        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>


    </ul>
</nav>


    </div>
    <!-- /.sidebar -->
</aside>
