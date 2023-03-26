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
    <title>Other Shop Expense Report</title>


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

        <?php
        include('db_connect.php');
        include("my_function.php");
        $shop_id = $_POST['shop_id'];
        $to_date = $_POST['to_date'];
        $from_date = $_POST['from_date'];

        $my_result = mysqli_query($con, "SELECT * FROM shop WHERE shop_id=1");
        $shop_data = mysqli_fetch_array($my_result)

        ?>

        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="product_images/erp.png" width="850" height="150">
                            <p><?php echo otherShopName($shop_id); ?> Expense Report</p>
                        </td>


                    </tr>
                </table>
            </td>


        </tr>


    </table>

    <p style="text-align: center;text-style">Report From <?php echo date('d F, Y', strtotime($from_date)) ?> to <?php echo date('d F, Y', strtotime($to_date)) ?> </p>


    <table>

        <tr class="heading">
            <td>SL</td>
            <td>Description</td>
            <td>Date</td>
            <td>Amount</td>

        </tr>


        <?php


        $currency = getCurrency();

        if ($shop_id=='All')
        {
            $result = mysqli_query($con, "SELECT * FROM other_shop_expense  WHERE oss_date>='$from_date' AND ose_date<='$to_date'");

        }
        else
        {
            $result = mysqli_query($con, "SELECT * FROM other_shop_expense  WHERE  other_shop_id='$shop_id' AND ose_date>='$from_date' AND ose_date<='$to_date'");

        }

        $i = 0;

        $total_amount = 0;


        while ($row = mysqli_fetch_array($result)) {


            $i++;
            $total_amount = $total_amount + $row['amount'];

            ?>


            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo date('d F, Y', strtotime($row['ose_date'])) ?></td>
                <td><?php echo $row['amount'] ?></td>
            </tr>


            <?php
        }
        ?>


        <tr class="total">

            <td></td>
            <td></td>
            <td style="font-weight: bold">Total=</td>

            <td><b><?php echo $currency . ' ' . number_format($total_amount,2) ?></b></td>

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