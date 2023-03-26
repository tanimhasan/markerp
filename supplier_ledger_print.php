<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key']))
    echo " ";
else {
    header("location:index.php");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Supplier Ledger Book</title>


    <style>
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
                            <p>Supplier Ledger Book</p>
                        </td>


                    </tr>
                </table>
            </td>


        </tr>


        <?php
        include('db_connect.php');
        include("my_function.php");
        $suppliers_id=$_POST['suppliers_id'];

        /*if ($customer_id == 'all'){
            $customer_name="All";
        }else{
            $customer_name=customerNameById($_POST['customer_id']);
        }*/

        $my_result = mysqli_query($con, "SELECT * FROM shop WHERE shop_id=1");
        $shop_data = mysqli_fetch_array($my_result)

        ?>





    </table>


    <!-- <p style="text-align: center;text-style"><?php /*echo $customer_name */?> ledger book details</p>-->


    <table>

        <tr class="heading">
            <td>SL</td>
            <td>Supplier Name</td>
            <td>Memo/Bill No</td>
            <td>Payment Date</td>
            <td>Payment Amount (জমা)</td>
            <!--<td>Debit (খরচ)</td>
            <td>Balance (অবশিষ্ট)</td>-->
        </tr>


        <?php
        $currency = getCurrency();

        if ($suppliers_id == 'all'){
            $sql = "SELECT * FROM purchase_payment_history";
        }else{
            $sql = "SELECT * FROM purchase_payment_history WHERE supplier_id='$suppliers_id'";
        }

        $result = mysqli_query($con, $sql);
        $i = 0;
        $creditAmount = 0;
        $totalCredit = 0;
        /*$totalDebit = 0;
        $totalBalance = 0;
        $totalAmount = 0;*/

        while ($row = mysqli_fetch_array($result)) {


            $debitAmount = supplierDebitAmount($row['purchase_id']);
            $invId = supplierInvId($row['purchase_id']);
            $creditAmount = $row['amount'];

            $totalCredit = $totalCredit + $creditAmount;
            /*$totalDebit = $totalDebit + $debitAmount;
            $totalBalance = $totalCredit - $totalDebit;
            $totalBalance = $creditAmount - $debitAmount;
            $totalAmount = $totalCredit - $totalDebit;*/

            if ($creditAmount != "0.00") {
                $i++;
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . supplierName($row['supplier_id']) . "</td>";
                echo "<td>" . $invId . "</td>";
                echo "<td>" . date('d F, Y', strtotime($row['date'])) . "</td>";
                echo "<td>" . $creditAmount . "</td>";
                echo "</tr> ";
            }
        }
        ?>

        <tr class="total">

            <td></td>
            <td></td>
            <td></td>
            <td><b>Total=</b></td>

            <td><b><?php echo $currency . ' ' . number_format($totalCredit,2) ?></b></td>
            <td></td>
        </tr>
    </table>
</div>

<div align='center'>
    <input class="button" id="printbtn" type="button" value="Print" onclick="window.print();">
</div>


<footer>
    print by: <?php echo $_SESSION['user_type'] . ' ' . 'Print time:' . ' ' . date('d-m-Y h:m:a') ?>
</footer>
</body>
</html>