<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key']))
    echo " ";
else {
    header("location:index.php");

}

?>

<?php
include('db_connect.php');
include("my_function.php");
$date = $_POST['date'];

$sql = mysqli_query($con, "SELECT * FROM daily_ledger WHERE date='$date'");
$data = mysqli_fetch_assoc($sql);
$num_rows = mysqli_num_rows($sql);
if ($num_rows > 0) {
$previous_amount = $data['previous_amount'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Daily Ledger</title>


    <style>
        /*table style*/
        * {
            box-sizing: border-box;
        }
        .row {
            margin-left:-5px;
            margin-right:-5px;
        }

        .col-4{
            float: left;
            width: 33%;
            padding: 15px;
        }
        .col-2{
            float: left;
            width: 20%;
            padding: 15px;
        }

        .col-6 {
            float: left;
            width: 60%;
            padding: 15px;
        }
        .col {
            float: left;
            width: 33%;
            padding: 15px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: center;
            padding: 16px;
        }
        /*table style*/

        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 30px;

            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(8) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 5px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 25px;
            line-height: 25px;
            color: #333;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        @media print {
            #printbtn {
                display: none;
            }
        }


        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }


        footer {
            font-size: 9px;
            color: #000;
            text-align: left;
        }

        @page {
            size: A4;
            margin: 11mm 17mm 17mm 17mm;
        }

        @media print {
            footer {
                position: fixed;
                bottom: 0;
            }

            .content-block, p {
                page-break-inside: avoid;
            }

            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
    </style>


    <script>
        function printpage() {
            window.print()
        }
    </script>

</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">




                <table>
                    <tr>
                        <td class="title">
                            <img src="product_images/erp.png" width="850" height="150">
                            <p>Daily Ledger Report</p>

                            <p style="text-align: center;font-size: 16px;">Daily Ledger On <?php echo date('d F, Y', strtotime($date)) ?> </p>

                            <?php

                            $currentDate = date('D', strtotime($date));


                            $engDATE = array('1','2','3','4','5','6','7','8','9','0','January','February','March','April',
                                'May','June','July','August','September','October','November','December','Sat','Sun',
                                'Mon','Tue','Wed','Thu','Fri');
                            $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে',
                                'জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
বুধবার','বৃহস্পতিবার','শুক্রবার'
                            );
                            $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);

                            ?>

                            <p style="text-align: center;font-size: 16px; font-weight: bold;">রোজ - <?php echo $convertedDATE; ?> </p>


                        </td>


                    </tr>
                </table>
            </td>


        </tr>


    </table>


    <div class="row">
        <div class="col-4">

            <table border="1">
                <tr>
                    <td>Previous Amount (সাবেক)</td>
                    <td>
                        <?php
                            echo $previous_amount;
                        ?>
                    </td>
                </tr>

                <!--Bank Withdraw data-->
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM transaction WHERE tran_type='Withdraw' AND tran_date='$date'");

                    $total_withdraw_amount = 0;

                        while ($row = mysqli_fetch_array($result)) {
                            $amount = $row['amount'];
                            $total_withdraw_amount = $total_withdraw_amount + $amount;
                            $account_name = accountName($row['account_id']);
                    ?>


                    <tr>
                        <td><?php echo $account_name ?></td>
                        <td><?php echo $amount ?></td>
                    </tr>

                    <?php } ?>
                <!--Bank Withdraw data-->

                <!--Sales data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM sales_payment_history WHERE date='$date'");
                $result2 = mysqli_query($con, "SELECT * FROM order_list WHERE order_date='$date'");
                $total_sales_amount = 0;
                $total_qty = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $sales_amount = $row['amount'];
                    $total_sales_amount = $total_sales_amount + $sales_amount;

                }

                while ($row2 = mysqli_fetch_array($result2)) {
                    $qty = productQuantity($row2['invoice_id']);
                    $total_qty = $total_qty + $qty;

                }
                ?>

                <tr>
                    <td><?php echo "Sales " . $total_qty . " <b>Piece</b>" ?></td>
                    <td><?php echo number_format($total_sales_amount,2) ?></td>
                </tr>
                <!--Sales data-->

                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>
                        <?php
                            $totalAmount = $previous_amount + $total_withdraw_amount + $total_sales_amount;
                            echo number_format($totalAmount,2);
                        ?></strong>
                    </td>
                </tr>

                <tr>
                    <td><strong>Cost (-)</strong></td>
                    <td>
                        <?php


                        $get_total_purchase_amount = getTotalPurchaseAmount($date);
                        $get_total_expense_amount = getTotalExpenseAmount($date);
                        $get_total_deposit_amount = getTotalDepositAmount($date);
                        $get_total_salary_amount = getTotalSalaryAmount($date);

                        $total_expense = $get_total_expense_amount + $get_total_deposit_amount;

                        $totalCost = $get_total_purchase_amount + $total_expense + $get_total_salary_amount;


                        echo number_format($totalCost,2);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td><strong>Net Amount</strong></td>
                    <td><strong>
                        <?php
                            $finalAmount = $totalAmount - $totalCost;
                            echo number_format($finalAmount,2);
                        ?></strong>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-4">


            <table border="1">

                                <!--Purchase data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM purchase_payment_history WHERE date='$date'");
                $total_purchase_amount = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $purchase_amount = $row['amount'];
                    $total_purchase_amount = $total_purchase_amount + $purchase_amount;
                    $name = supplierNameByPid($row['purchase_id']);
                    ?>


                        <tr>
                            <?php
                                if ($purchase_amount != "0"){
                            ?>
                                <td><?php echo $name ?></td>
                                <td><?php echo $purchase_amount ?></td>
                            <?php } ?>
                        </tr>


                <?php } ?>
                <!--Purchase data-->

                <?php
                if ($total_purchase_amount != '0'){
                ?>

                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>
                        <?php
                        echo number_format($total_purchase_amount,2);
                        ?></strong>
                    </td>
                </tr>

                <?php } ?>
            </table>
        </div>
        <div class="col-4">

            <table border="1">

                <!--Bank Deposit data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM transaction WHERE tran_type='Deposit' AND tran_date='$date'");

                $total_deposit_amount = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $amount = $row['amount'];
                    $total_deposit_amount = $total_deposit_amount + $amount;
                    $account_name = accountName($row['account_id']);
                    ?>


                    <tr>
                        <td><?php echo $account_name ?></td>
                        <td><?php echo $amount ?></td>
                    </tr>

                <?php } ?>
                <!--Bank Withdraw data-->

                <!--Expense data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM expense WHERE expense_date='$date'");

                $total_expense_amount = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $amount = $row['expense_amount'];
                    $total_expense_amount = $total_expense_amount + $amount;
                    $name = $row['expense_name'];
                    ?>


                    <tr>
                        <td><?php echo $name ?></td>
                        <td><?php echo $amount ?></td>
                    </tr>

                <?php } ?>
                <!--Expense data-->

                <?php
                if ($total_expense_amount != '0'){
                ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>
                        <?php
                        $total_expense_amount = $total_expense_amount + $total_deposit_amount;
                        echo number_format($total_expense_amount,2);
                        ?></strong>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <table border="1">

                <!--Loan data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM loan WHERE date='$date'");

                $total_loan_amount = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $amount = $row['loan'];
                    $total_loan_amount = $total_loan_amount + $amount;
                    $name = $row['name'];
                    ?>


                    <tr>
                        <td><?php echo $name ?></td>
                        <td><?php echo $amount ?></td>
                    </tr>

                <?php } ?>

                <tr>
                    <td>Shop (দোকান)</td>
                    <td>
                        <?php
                        $shop_amount = getShopAmount($date);
                        echo $shop_amount;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Office (অফিস)</td>
                    <td>
                        <?php
                        $office_amount =  getOfficeAmount($date);
                        echo $office_amount;
                        ?>
                    </td>
                </tr>
                <!--Loan data-->

                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>
                        <?php
                        $totalLoan = $total_loan_amount + $shop_amount + $office_amount;
                        echo number_format($totalLoan,2);
                        ?></strong>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col">
            <table border="1">

                <!--Expense data-->
                <?php
                $result = mysqli_query($con, "SELECT * FROM salary WHERE type='Debit' AND date='$date'");

                $total_salary_amount = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $amount = $row['salary'];
                    $total_salary_amount = $total_salary_amount + $amount;
                    $name = employeeName($row['emp_id']);
                    ?>


                    <tr>
                        <td><?php echo $name ?></td>
                        <td><?php echo $amount ?></td>
                    </tr>

                <?php } ?>
                <!--Expense data-->


                <?php
                if ($total_salary_amount != '0'){
                ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>
                        <?php
                        echo number_format($total_salary_amount,2);
                        ?></strong>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col">

        </div>
    </div>

    <?php
    } else{
        echo '<script type="text/javascript">alert("Data Not Found! \nPlease Enter Previous amount, Shop and Office amount.")</script>';
        echo "<script type='text/javascript'> window.location = 'add_daily_ledger.php'; </script>";
    } ?>

</div>

<div align='center'>
    <input class="button" id="printbtn" type="button" value="Print" onclick="window.print();">
</div>


<footer>
    print by: <?php echo $_SESSION['user_type'] . ' ' . 'Print time:' . ' ' . date('d-m-Y h:m:a') ?>
</footer>
</body>
</html>