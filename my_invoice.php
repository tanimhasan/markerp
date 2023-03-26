<?php

class my_invoice
{
    private $invoiceUserTable = 'invoice_user';
    private $invoiceOrderTable = 'purchase';
    private $invoiceOrderItemTable = 'purchase_details';
    private $invoiceOrderList = 'order_list';
    private $invoiceOrderDetails = 'order_details';



    //for purchase
    public function saveInvoice($POST)
    {
        global $con;
        $sqlInsert = "
			INSERT INTO purchase (supplier_id,purchase_date, tax_percentage,tax, sub_total,total_amount, paid_amount, notes,invoice_number,payment_method,done_by) 
			VALUES ('" . $POST['supplier_id'] . "', '" . $POST['purchase_date'] . "','" . $POST['taxRate'] . "' ,'" . $POST['taxAmount'] . "','" . $POST['subTotal'] . "','" . $POST['totalAftertax'] . "' ,'" . $POST['amountPaid'] . "', '" . $POST['notes'] . "','" . $POST['invoice_number'] . "','" . $POST['payment_method'] . "','" . $POST['user_name'] . "')";
        mysqli_query($con, $sqlInsert);

        $lastInsertId = mysqli_insert_id($con);

        if ($POST['amountPaid'] > 0) {
            $insert = "INSERT INTO purchase_payment_history (purchase_id,supplier_id,payment_method,amount,date,reference,done_by) VALUES ('" . $lastInsertId . "','" . $POST['supplier_id'] . "','" . $POST['payment_method'] . "','" . $POST['amountPaid'] . "','" . $POST['purchase_date'] . "','Initial Payment','" . $POST['user_name'] . "')";
            mysqli_query($con, $insert);
        }

        for ($i = 0; $i < count($POST['productId']); $i++) {

            $product_id=$POST['productId'][$i];
            $qty=$POST['quantity'][$i];
            $purchase_rate=$POST['price'][$i];

            $sqlInsertItem = "
			INSERT INTO purchase_details (purchase_id, product_id, qty, price, total,supplier_id,date) 
			VALUES ('" . $lastInsertId . "', '" . $POST['productId'][$i] . "', '" . $POST['quantity'][$i] . "', '" . $POST['price'][$i] . "', '" . $POST['total'][$i] . "','" . $POST['supplier_id'] . "','" . $POST['purchase_date'] . "')";
            mysqli_query($con, $sqlInsertItem);


            $sql_stock =  "SELECT * FROM products WHERE product_id='$product_id'";
            $sql=mysqli_query($con, $sql_stock);
            $product_data = mysqli_fetch_assoc($sql);
            $get_current_stock = $product_data['product_stock'];

            $updated_stock=$get_current_stock+$qty;

            $sql_update_stock="UPDATE products SET product_stock='$updated_stock', buy_price='$purchase_rate' WHERE product_id='$product_id'";



            mysqli_query($con, $sql_update_stock);



        }
    }





    //for sales order
    public function saveSales($POST)
    {
        global $con;
        $sqlInsert = "
			INSERT INTO order_list (invoice_id,customer_id,order_date,order_payment_method,sub_total,discount,total_amount, paid_amount, notes,done_by) 
			VALUES ('" . $POST['invoice_number'] . "', '" . $POST['customer_id'] . "','" . $POST['sales_date'] . "','" . $POST['payment_method'] . "','" . $POST['subTotal'] . "','" . $POST['discount'] . "' ,'" . $POST['totalAftertax'] . "' ,'" . $POST['amountPaid'] . "', '" . $POST['notes'] . "','" . $POST['user_id'] . "')";
        mysqli_query($con, $sqlInsert);

        $insert= "INSERT INTO sales_payment_history (invoice_id,payment_method,amount,date,reference,done_by)
 VALUES ('" . $POST['invoice_number'] . "','" . $POST['payment_method'] . "','" . $POST['amountPaid'] . "','" . $POST['sales_date'] . "','Initial Payment','" . $POST['user_id'] . "')";
        mysqli_query($con, $insert);

        for ($i = 0; $i < count($POST['productId']); $i++) {

            $product_id=$POST['productId'][$i];
            $qty=$POST['quantity'][$i];
            $sqlInsertItem = "
			INSERT INTO order_details (invoice_id, product_id, product_quantity, buy_price,sales_price, product_order_date,done_by) 
			VALUES ('" . $POST['invoice_number'] . "','" . $POST['productId'][$i] . "', '" . $POST['quantity'][$i] . "', '" . $POST['buy_price'][$i] . "','" . $POST['price'][$i] . "','" . $POST['sales_date'] . "','" . $POST['user_id'] . "')";
            mysqli_query($con, $sqlInsertItem);


            $sql_stock =  "SELECT * FROM products WHERE product_id='$product_id'";
            $sql=mysqli_query($con, $sql_stock);
            $product_data = mysqli_fetch_assoc($sql);
            $get_current_stock = $product_data['product_stock'];

            $updated_stock=$get_current_stock-$qty;

            $sql_update_stock="UPDATE products SET product_stock='$updated_stock' WHERE product_id='$product_id'";

            mysqli_query($con, $sql_update_stock);


        }
    }








    function getProductStock($product_id)
    {
        global $con;
        $sql_stock =  "SELECT * FROM products WHERE product_id='$product_id'";
        $sql=mysqli_query($con, $sql_stock);
        $product_data = mysqli_fetch_assoc($sql);
        $product_stock = $product_data['product_stock'];
        return $this->$product_stock;
    }





}

?>