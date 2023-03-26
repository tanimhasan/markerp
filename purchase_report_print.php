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
    <title>Purchase Report</title>



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
                display :  none;
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
        function printpage()
        {
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


                        <td  class="title">
                            <img src="product_images/erp.png" width="850" height="150">
                            <p>Purchase Report</p>
                        </td>


                    </tr>
                </table>
            </td>


        </tr>


        <?php
        include('db_connect.php');
        include("my_function.php");
        $supplier_id = $_POST['supplier_id'];
        $to_date = $_POST['to_date'];
        $from_date = $_POST['from_date'];

        $my_result = mysqli_query($con, "SELECT * FROM shop WHERE shop_id=1");
        $shop_data = mysqli_fetch_array($my_result)

        ?>


        <tr class="information">
            <td >
                <table>
                    <tr>
                        <td>

                            <b> <?php echo $shop_data['shop_name'] ?></b><br/>
                            <?php echo $shop_data['shop_address'] ?><br/>
                            <?php echo $shop_data['shop_contact'] ?><br>
                            <?php echo $shop_data['shop_email'] ?><br>
                        </td>


                        <td>
                            <b>Supplier,</b><br>
                            <?php
                            if ($supplier_id=='All')
                            {
                                echo 'All Suppliers'.'<br>';
                            }
                            else
                            {
                                echo supplierName($supplier_id).'<br>';
                                echo supplierAddress($supplier_id).'<br>';
                                echo 'Phone: '.supplierPhone($supplier_id).'<br>';


                            }


                            ?>
                        </td>


                    </tr>
                </table>
            </td>
        </tr>




    </table>

    <p style="text-align: center;text-style">Purchase Report From Date <?php echo date('d F, Y', strtotime($from_date)) ?> to <?php echo date('d F, Y', strtotime($to_date))  ?> </p>

    <table>

        <tr class="heading">
            <td>SL</td>
            <td>Memo/Bill No</td>
            <td>Purchase Date</td>
            <td>Total</td>
            <td>Paid</td>
            <td>Due</td>
        </tr>


        <?php



        $currency = getCurrency();

        if ($supplier_id=='All')
        {
            $result = mysqli_query($con, "SELECT * FROM purchase  WHERE  purchase_date>='$from_date' AND purchase_date<='$to_date'");

        }
        else{
            $result = mysqli_query($con, "SELECT * FROM purchase  WHERE  purchase_date>='$from_date' AND purchase_date<='$to_date' AND supplier_id='$supplier_id'");

        }

        $i = 0;
        $total_commission = 0;
        $total_discount = 0;
        $total_amount = 0;
        $total_paid = 0;
        $total_paid = 0;
        $total_due = 0;

        while ($row = mysqli_fetch_array($result)) {


            $i++;
            $due_amount = $row['total_amount'] - $row['paid_amount'];
            $total_amount = $total_amount + $row['total_amount'];
            $total_paid = $total_paid + $row['paid_amount'];
            $total_due = $total_due + $due_amount

            ?>


            <tr >
                <td><?php echo $i ?></td>
                <td><?php echo $row['invoice_number'] ?></td>
                <td><?php echo $row['purchase_date'] ?></td>
                <td><?php echo $row['total_amount'] ?></td>
                <td><?php echo $row['paid_amount'] ?></td>
                <td><?php echo $due_amount ?></td>


            </tr>


            <?php
        }
        ?>


        <tr class="total">

            <td></td>
            <td>Total=</td>
            <td></td>


            <td><b><?php echo $currency . ' ' . number_format($total_amount,2) ?></b></td>
            <td><b><?php echo $currency . ' ' . number_format($total_paid,2) ?></b></td>
            <td><b><?php echo $currency . ' ' . number_format($total_due,2) ?></b></td>
        </tr>
    </table>
</div>

<div align='center'>
    <input class="button" id ="printbtn" type="button" value="Print" onclick="window.print();" >
</div>


<footer>
    print by: <?php echo $_SESSION['admin_name'].' '.'Print time:'.' '.date('d-m-Y h:m:a')?>
</footer>
</body>
</html>