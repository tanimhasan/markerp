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
    <title>Bank Report</title>


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
                            <p>Bank Report</p>
                        </td>


                    </tr>
                </table>
            </td>


        </tr>


        <?php
        include('db_connect.php');
        include("my_function.php");
        $tran_type=$_POST['tran_type'];
        $account_id=$_POST['account_id'];
        $from_date=$_POST['from_date'];
        $to_date=$_POST['to_date'];

        /*if ($customer_id == 'all'){
            $customer_name="All";
        }else{
            $customer_name=customerNameById($_POST['customer_id']);
        }*/

        $my_result = mysqli_query($con, "SELECT * FROM shop WHERE shop_id=1");
        $shop_data = mysqli_fetch_array($my_result)

        ?>





    </table>


    <p style="text-align: center;text-style">Bank Report From <?php echo date("d F,Y",strtotime($from_date)) ?>
        to <?php echo date("d F,Y",strtotime($to_date)) ?> </p>


    <table>

        <tr class="heading">
            <td>SL</td>
            <td>Account Name</td>
            <td>Date</td>
            <td>Amount</td>
            <td>Payment Method</td>
            <td>Reference</td>
            <td>Transaction Type</td>
        </tr>


        <?php
        $currency = getCurrency();

        if ($tran_type == 'all' && $account_id == 'all'){
            $sql = "SELECT * FROM transaction WHERE  tran_date>='$from_date' AND tran_date<='$to_date' ORDER BY tran_date DESC";
        } elseif ($tran_type == 'all' && $account_id){
            $sql = "SELECT * FROM transaction WHERE  tran_date>='$from_date' AND tran_date<='$to_date' AND account_id='$account_id' ORDER BY tran_date DESC";
        } elseif ($account_id == 'all' && $tran_type){
            $sql = "SELECT * FROM transaction WHERE  tran_date>='$from_date' AND tran_date<='$to_date' AND tran_type='$tran_type' ORDER BY tran_date DESC";
        } else{
            $sql = "SELECT * FROM transaction WHERE  tran_date>='$from_date' AND tran_date<='$to_date' AND tran_type='$tran_type' AND account_id='$account_id' ORDER BY tran_date DESC";
        }
        $result = mysqli_query($con, $sql);
        $i = 1;
        $total_amount = 0;
        while ($row = mysqli_fetch_array($result)) {
            $amount = $row['amount'];
            $total_amount = $total_amount + $amount;

            echo "<tr>";

            echo "<td>" . $i . "</td>";
            echo "<td>" . accountName($row['account_id']) . "</td>";
            echo "<td>" . date('d F, Y',strtotime($row['tran_date'])) . "</td>";
            echo "<td>" . $currency . " " . $amount . "</td>";
            echo "<td>" . $row['payment_method'] . "</td>";
            echo "<td>" . $row['reference'] . "</td>";
            echo "<td>" . $row['tran_type'] . "</td>";

            $i++;

            echo "</tr> ";
        }
        ?>

        <tr class="total">

            <td></td>
            <td></td>
            <td><b>Total=</b></td>
            <td><b><?php echo $currency . ' ' . number_format($total_amount,2) ?></b></td>

            <td></td>
            <td></td>
            <td></td>
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