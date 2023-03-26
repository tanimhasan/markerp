<?php

function userName($user_id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
    $user_data = mysqli_fetch_assoc($sql);
    $user_name = $user_data['name'];
    return $user_name;
}
/*Get User ID*/
function getIdByEmail($email)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_array($sql);
    $user_id = $row['id'];
    return $user_id;
}
/*Insert Access Log*/
function insertActivityLog($id,$description)
{
    global $con;
    mysqli_query($con,"INSERT INTO access_log (user_id,description) values('$id','$description')");
}
/*Insert Log Info*/
function inLog($id,$s_id,$ip,$time)
{
    global $con;
    mysqli_query($con,"INSERT INTO log_info (user_id,s_id,ip_no,in_time) values('$id',$s_id,'$ip','$time')");
}
function outLog($id,$s_id,$ip,$time)
{
    global $con;
    mysqli_query($con,"Update log_info SET out_time='$time' WHERE s_id='$s_id' AND user_id='$id' AND ip_no='$ip'");
}
function categoryName($category_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM product_category WHERE product_category_id='$category_id'");
    $category_data = mysqli_fetch_assoc($sql);
    $category_name = $category_data['product_category_name'];

    return $category_name;
}


function weightUnit($weight_unit_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM weight_unit WHERE weight_unit_id='$weight_unit_id'");
    $weight_unit_data = mysqli_fetch_assoc($sql);
    $weight_unit_name = $weight_unit_data['weight_unit_name'];
    return $weight_unit_name;
}


function supplierName($suppliers_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$suppliers_id'");
    $suppliers_data = mysqli_fetch_assoc($sql);
    $suppliers_name = $suppliers_data['suppliers_name'];
    return $suppliers_name;
}

function getShopAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM daily_ledger WHERE date='$date'");
    $data = mysqli_fetch_assoc($sql);
    $amount = $data['shop_amount'];
    return $amount;
}

function getTotalPurchaseAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(amount) as total FROM purchase_payment_history WHERE date='$date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}

function getTotalSalaryAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(salary) as total FROM salary WHERE type='Debit' AND date='$date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}

function getTotalExpenseAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(expense_amount) as total FROM expense WHERE expense_date='$date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}

function getTotalDepositAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(amount) as total FROM transaction WHERE tran_type='Deposit' AND tran_date='$date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}

function getOfficeAmount($date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM daily_ledger WHERE date='$date'");
    $data = mysqli_fetch_assoc($sql);
    $amount = $data['office_amount'];
    return $amount;
}

function supplierNameByPid($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM purchase WHERE purchase_id='$id'");
    $data = mysqli_fetch_assoc($sql);
    $suppliers_id = $data['supplier_id'];

    $sql = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$suppliers_id'");
    $data = mysqli_fetch_assoc($sql);
    $suppliers_name = $data['suppliers_name'];
    return $suppliers_name;
}


function getArticleMaxQty($article_no)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM article WHERE article_no='$article_no'");
    $article_data = mysqli_fetch_assoc($sql);
    $max_qty = $article_data['qty'];
    return $max_qty;
}


function getTotalCotton($emp_id,$from_date,$to_date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(qty) as total FROM production WHERE date>='$from_date' AND date<='$to_date' AND item_name='Cotton' AND emp_id='$emp_id'");
    $article_data = mysqli_fetch_assoc($sql);
    $qty = $article_data['total'];
    return $qty;
}

function getTotalFancy($emp_id,$from_date,$to_date)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(qty) as total FROM production WHERE date>='$from_date' AND date<='$to_date' AND item_name='Fancy' AND emp_id='$emp_id'");
    $article_data = mysqli_fetch_assoc($sql);
    $qty = $article_data['total'];
    return $qty;
}


function getTotalItem($item_name)
{

    global $con;
    $sql = mysqli_query($con, "SELECT SUM(qty) as total FROM production WHERE item_name='$item_name'");
    $article_data = mysqli_fetch_assoc($sql);
    $qty = $article_data['total'];
    return $qty;
}



function totalCuttingQty($article_no)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(qty) as total FROM cutting_book WHERE  article_no='$article_no'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}


function supplierPhone($suppliers_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$suppliers_id'");
    $suppliers_data = mysqli_fetch_assoc($sql);
    $suppliers_cell = $suppliers_data['suppliers_cell'];
    return $suppliers_cell;
}
function supplierAddress($suppliers_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$suppliers_id'");
    $suppliers_data = mysqli_fetch_assoc($sql);
    $suppliers_address = $suppliers_data['suppliers_address'];
    return $suppliers_address;
}

function customerNameById($id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$id'");
    $customer_data = mysqli_fetch_assoc($sql);
    $customer_name = $customer_data['customer_name'];
    return $customer_name;
}

function customerNameByInvoiceId($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM order_list WHERE invoice_id='$id'");
    $data = mysqli_fetch_assoc($sql);
    $customer_id = $data['customer_id'];

    $sql2 = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$customer_id'");
    $customer_data = mysqli_fetch_assoc($sql2);
    $customer_name = $customer_data['customer_name'];
    return $customer_name;
}

function creditAmount($id)
{
    global $con;
    $i = 0;
    $totalAmount = 0;

    $sql = "SELECT * FROM sales_payment_history WHERE invoice_id='$id'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $i++;
        $totalAmount = $totalAmount + $row['amount'];
    }
    return $totalAmount;
}

function supplierDebitAmount($id)
{
    global $con;
    $i = 0;
    $totalAmount = 0;

    $sql = "SELECT * FROM purchase WHERE purchase_id='$id'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $i++;
        $totalAmount = $totalAmount + $row['total_amount'];
    }
    return $totalAmount;
}

function supplierInvId($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM purchase WHERE purchase_id='$id'");
    $data = mysqli_fetch_assoc($sql);
    $id = $data['invoice_number'];
    return $id;
}

function customerCellById($id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$id'");
    $customer_data = mysqli_fetch_assoc($sql);
    $customer_cell= $customer_data['customer_cell'];
    return $customer_cell;
}


function customerEmailById($id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$id'");
    $customer_data = mysqli_fetch_assoc($sql);
    $customer_email= $customer_data['customer_email'];
    return $customer_email;
}


function customerAddressById($id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM customers WHERE customer_id='$id'");
    $customer_data = mysqli_fetch_assoc($sql);
    $customer_address= $customer_data['customer_address'];
    return $customer_address;
}


function getTotalExpenseByShopDateRange($from_date,$to_date)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(expense_amount) as total FROM expense WHERE  expense_date>='$from_date' AND expense_date<='$to_date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}



function getTotalProductionDateRange($from_date,$to_date)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(qty) as total FROM production WHERE  date>='$from_date' AND date<='$to_date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}




function getTotalBankTransaction($from_date,$to_date,$type)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(amount) as total FROM transaction WHERE  tran_date>='$from_date' AND tran_date<='$to_date' AND tran_type='$type'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}


function getTotalOrderPriceDateRange($from_date,$to_date)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(sales_price) AS value_sum FROM order_details WHERE  product_order_date>='$from_date' AND product_order_date<='$to_date'");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['value_sum'];

    return $sum;
}


function getTotalTaxDateRange($from_date,$to_date)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(tax_amount) AS value_tax FROM order_list WHERE  order_date>='$from_date' AND order_date<='$to_date'");
    $row = mysqli_fetch_assoc($result);
    $total_tax = $row['value_tax'];

    return $total_tax;
}


function getTotalDiscountDateRange($from_date,$to_date)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(discount) AS value_discount FROM order_list WHERE  order_date>='$from_date' AND order_date<='$to_date'");
    $row = mysqli_fetch_assoc($result);
    $total_discount = $row['value_discount'];
    return $total_discount;
}


function productNameById($product_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id'");
    $product_data = mysqli_fetch_assoc($sql);
    $product_name = $product_data['product_name'];
    return $product_name;
}


function typeName($type_id)
{
    if ($type_id == 0){
        $msg = "Savings";
    }
    elseif ($type_id== 1){
        $msg = "Check";
    }
    elseif ($type_id == 2){
        $msg = "Credit";
    }else{
        $msg = "Cash";
    }
    return $msg;
}
function accountName($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM banking WHERE account_id='$id'");
    $account_data = mysqli_fetch_assoc($sql);
    $account_name = $account_data['account_name'];
    return $account_name;
}
function expenseCategoryName($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM expense_category WHERE category_id='$id'");
    $category_data = mysqli_fetch_assoc($sql);
    $category_name = $category_data['category_name'];
    return $category_name;
}
function otherShopName($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM other_shop WHERE shop_id='$id'");
    $data = mysqli_fetch_assoc($sql);
    $name = $data['shop_name'];
    return $name;
}

/*Attendance Get Status*/
function getStatus($emp_id)
{
    global $con;
    $cur_date = date("Y/m/d");

    $sql = mysqli_query($con, "SELECT * FROM attendance WHERE emp_id='$emp_id' AND att_date='$cur_date'");
    $status = mysqli_fetch_assoc($sql);
    $att_status = $status['attendance'];
    return $att_status;
}
/*Attendance Get Previous Status*/
function getPreviousStatus($emp_id, $date)
{
    global $con;
    $cur_date = date("Y/m/d");

    $sql = mysqli_query($con, "SELECT * FROM attendance WHERE emp_id='$emp_id' AND att_date='$date'");
    $status = mysqli_fetch_assoc($sql);
    $att_status = $status['attendance'];
    return $att_status;
}
function employeeName($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$id'");
    $employee_data = mysqli_fetch_assoc($sql);
    $employee_name = $employee_data['name'];
    return $employee_name;
}
function employeePhoneNo($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$id'");
    $employee_data = mysqli_fetch_assoc($sql);
    $employee_phone = $employee_data['phone'];
    return $employee_phone;
}
function employeeBalance($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$id'");
    $employee_data = mysqli_fetch_assoc($sql);
    $employee_balance = $employee_data['balance'];
    return $employee_balance;
}
function employeeSalary($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$id'");
    $employee_data = mysqli_fetch_assoc($sql);
    $employee_salary = $employee_data['salary'];
    return $employee_salary;
}

function getTotalExpense()
{
    global $con;
//  $result = mysqli_query($con,"SELECT SUM('product_price') AS value_sum FROM order_details");
//  $row = mysqli_fetch_assoc($result);
//  $sum = $row['value_sum'];
    $sql = mysqli_query($con, "SELECT SUM(expense_amount) as total FROM expense");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}

/*Get Total Salary Paid*/
function getTotalSal($emId)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(salary) as total FROM salary WHERE emp_id='$emId'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];

    return $sum;
}
function getTotalOrderPrice()
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(sales_price) AS value_sum FROM order_details");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['value_sum'];

    return $sum;
}


function getTotalDiscount()
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(discount) AS value_discount FROM order_list");
    $row = mysqli_fetch_assoc($result);
    $total_discount = $row['value_discount'];
    return $total_discount;
}


function getTotalTax()
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(tax) AS value_tax FROM order_list");
    $row = mysqli_fetch_assoc($result);
    $total_tax = $row['value_tax'];

    return $total_tax;
}

function totalCredit($id)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(salary) AS total FROM salary WHERE emp_id='$id' AND type='Credit'");
    $row = mysqli_fetch_assoc($result);
    $total_credit = $row['total'];

    if (empty($total_credit)){
        return 0.00;
    }else{
        return $total_credit;
    }
}

function totalDebit($id)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(salary) AS total FROM salary WHERE emp_id='$id' AND type='Debit'");
    $row = mysqli_fetch_assoc($result);
    $total_dedit = $row['total'];

    if (empty($total_dedit)){
        return 0.00;
    }else{
        return $total_dedit;
    }
}

function getTotalPrice()
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(paid_amount) AS value_sum FROM order_list");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['value_sum'];

    return $sum;
}
function productWeight($product_id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id'");
    $product_data = mysqli_fetch_assoc($sql);
    $product_weight = $product_data['product_weight'];
    return $product_weight;
}

function productWeightUnit($product_id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id'");
    $product_data = mysqli_fetch_assoc($sql);
    $product_unit = $product_data['product_weight_unit_id'];
    $sql = mysqli_query($con, "SELECT * FROM weight_unit WHERE weight_unit_id='$product_unit'");
    $product_data = mysqli_fetch_assoc($sql);
    $product_unit_name = $product_data['weight_unit_name'];
    return $product_unit_name;
}

function productPrice($invoice_id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM order_list WHERE invoice_id='$invoice_id'");
    $product_data = mysqli_fetch_array($sql);
    $price = $product_data['paid_amount'];
    return $price;
}

function productQuantity($invoice_id)
{
    global $con;
    $totalQty = 0;
    $sql = "SELECT * FROM order_details WHERE invoice_id='$invoice_id'";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $qty = $row['product_quantity'];
        $totalQty = $totalQty + $qty;
    }

    return $totalQty;
}

function getCurrency()
{
    global $con;
    $result = mysqli_query($con, "SELECT currency_symbol FROM shop WHERE shop_id=1 ");
    $row = mysqli_fetch_assoc($result);
    $currency = $row['currency_symbol'];

    return $currency;
}


//calculate total income in month
function getMonthlySalesAmount($month, $getYear)
{

    global $con;
    $totalCost = 0;

    $year = $getYear;


    $sql = "SELECT * FROM sales_payment_history WHERE  MONTH(STR_TO_DATE(date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(date,'%Y-%m-%d')) = '$year'";

    //$sql="SELECT * FROM order_list";

    //$sql = "SELECT * FROM order_list WHERE  DATE_FORMAT('%m',order_date) = '". $month . "' AND  DATE_FORMAT('%Y', order_date) = '".  $year;

    $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_assoc($result);


    while ($row = mysqli_fetch_array($result)) {
        $cost = floatval($row['amount']);
        $totalCost = $totalCost + $cost;
    }


    return $totalCost;

}

//calculate total income in year
function getYearlyIncome($getYear)
{

    global $con;
    $totalIncome = 0;

    $year = $getYear;


    $sql = "SELECT * FROM sales_payment_history WHERE YEAR(STR_TO_DATE(date,'%Y-%m-%d')) = '$year'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $cost = floatval($row['amount']);
        $totalIncome = $totalIncome + $cost;
    }

    return $totalIncome;

}

//calculate total Sales price in month
function getMonthlySalesReport($id, $month, $getYear)
{
    global $con;
    $totalSales = 0;
    $year = $getYear;

    $sql = "SELECT * FROM products WHERE product_category_id='$id'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];

        $sql2 = "SELECT * FROM order_details WHERE  MONTH(STR_TO_DATE(product_order_date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(product_order_date,'%Y-%m-%d')) = '$year'  AND product_id='$product_id'";

        $result2 = mysqli_query($con, $sql2);

        while ($row2 = mysqli_fetch_array($result2)) {
            $price = floatval($row2['sales_price']);
            $quantity = $row2['product_quantity'];
            $finalPrice = $price * $quantity;
            $totalSales = $totalSales + $finalPrice;
        }
    }

    return $totalSales;

}

//calculate total Sales price in month
function getMonthlySales($month, $getYear)
{

    global $con;
    $totalSales = 0;

    $year = $getYear;


    $sql = "SELECT * FROM order_details WHERE  MONTH(STR_TO_DATE(product_order_date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(product_order_date,'%Y-%m-%d')) = '$year'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $price = floatval($row['sales_price']);
        $quantity = $row['product_quantity'];
        $finalPrice = $price * $quantity;
        $totalSales = $totalSales + $finalPrice;
    }

    return $totalSales;

}

//calculate total price in month
function getMonthlyExpenseReport($id, $month, $getYear)
{
    global $con;
    $totalExpense = 0;

    $year = $getYear;


    $sql = "SELECT * FROM expense WHERE  MONTH(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$year' AND category_id='$id'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $cost = floatval($row['expense_amount']);
        $totalExpense = $totalExpense + $cost;
    }

    return $totalExpense;

}

//calculate total price in month
function getMonthlyExpense($month, $getYear)
{

    global $con;
    $totalExpense = 0;

    $year = $getYear;


    $sql = "SELECT * FROM expense WHERE  MONTH(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$month' AND YEAR(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$year'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $cost = floatval($row['expense_amount']);
        $totalExpense = $totalExpense + $cost;
    }

    return ($totalExpense);

}

//calculate total price in year
function getYearlyExpense($getYear)
{

    global $con;
    $totalExpense = 0;

    $year = $getYear;


    $sql = "SELECT * FROM expense WHERE YEAR(STR_TO_DATE(expense_date,'%Y-%m-%d')) = '$year'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $cost = floatval($row['expense_amount']);
        $totalExpense = $totalExpense + $cost;
    }

    return $totalExpense;

}


function time_elapsed_string($datetime, $full = false)
{

    //set default time zone
    date_default_timezone_set("Asia/Dhaka");

    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function getProductStock($product_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id'");

    $product_data = mysqli_fetch_assoc($sql);
    $product_stock = $product_data['product_stock'];
    return $product_stock;
}

function getPaidAmount($purchase_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM purchase WHERE purchase_id='$purchase_id'");

    $purchase_data = mysqli_fetch_assoc($sql);
    $paid_amount = $purchase_data['paid_amount'];
    return $paid_amount;
}

function getSalesPaidAmount($invoice_id)
{

    global $con;
    $sql = mysqli_query($con, "SELECT * FROM order_list WHERE invoice_id='$invoice_id'");

    $sales_data = mysqli_fetch_assoc($sql);
    $paid_amount = $sales_data['paid_amount'];
    return $paid_amount;
}

function getBankAmount($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM banking WHERE account_id='$id'");

    $data = mysqli_fetch_assoc($sql);
    $balance = $data['balance'];
    return $balance;
}
function getBalance($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM employee WHERE employee_id ='$id'");

    $data = mysqli_fetch_assoc($sql);
    $balance = $data['balance'];
    return $balance;
}

function getTranAmount($id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT * FROM transaction WHERE tran_id='$id'");
    $data = mysqli_fetch_assoc($sql);
    $amount = $data['amount'];
    return $amount;
}

function getAmountInWord($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Taka ' : '') . $paise;
}

/*Expense Report*/
function getTotalExpenseByDateRange($from_date,$to_date,$category_id)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(expense_amount) as total FROM expense WHERE expense_date>='$from_date' AND expense_date<='$to_date' AND category_id='$category_id'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}

function getAllExpenseByDateRange($from_date,$to_date)
{
    global $con;
    $sql = mysqli_query($con, "SELECT SUM(expense_amount) as total FROM expense WHERE  expense_date>='$from_date' AND expense_date<='$to_date'");
    $row = mysqli_fetch_array($sql);
    $sum = $row['total'];
    return $sum;
}
/*Expense Report*/

/*Balance Sheet Report*/
function getPurchaseTotalAmount($from_date, $to_date)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(total_amount) AS value_purchase FROM purchase WHERE  purchase_date>='$from_date' AND purchase_date<='$to_date'");
    $row = mysqli_fetch_assoc($result);
    $total_purchase = $row['value_purchase'];

    return $total_purchase;
}


function getSalesTotalAmount($from_date, $to_date)
{
    global $con;
    $result = mysqli_query($con, "SELECT SUM(total_amount) AS value_sales FROM order_list WHERE  order_date>='$from_date' AND order_date<='$to_date'");
    $row = mysqli_fetch_assoc($result);
    $total_sales = $row['value_sales'];
    return $total_sales;
}
/*Balance Sheet Report*/

?>
