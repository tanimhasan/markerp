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
    <title>Production Ledger Info</title>


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

        table h4{margin: 0;padding: 10px 0PX;}
        table p{margin: 0;padding-bottom: 5px; font-size: 16px;}

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
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $emp_id=$_POST['emp_id'];

        /*if ($customer_id == 'all'){
            $customer_name="All";
        }else{
            $customer_name=customerNameById($_POST['customer_id']);
        }*/

        $my_result = mysqli_query($con, "SELECT * FROM shop WHERE shop_id=1");
        $shop_data = mysqli_fetch_array($my_result)

        ?>

        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="product_images/erp.png" width="850" height="150">
                            <h4>Production Ledger</h4>
                            <p><strong>Employee Name:</strong> <?php echo employeeName($emp_id); ?></p>
                            <p><strong>Phone No:</strong> <?php echo employeePhoneNo($emp_id); ?></p>
                        </td>


                    </tr>
                </table>
            </td>


        </tr>


    </table>


    <p style="text-align: center;text-style">From <?php echo $from_date ?>
        to <?php echo $to_date ?> </p>


    <table>



        <tr class="heading">
            <td>SL</td>
            <td>Date</td>
            <td>Art. No</td>
            <td>Item Name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total Amount</td>
        </tr>


        <?php
        $currency = getCurrency();

        if ($emp_id == 'all'){
            $sql = "SELECT * FROM production";
            $total_fancy=getTotalItem("Fancy");
            $total_cotton=getTotalItem("Cotton");

        }else{
            $sql = "SELECT * FROM production WHERE date>='$from_date' AND date<='$to_date' AND emp_id='$emp_id'";
            $total_fancy=getTotalFancy($emp_id,$from_date,$to_date);
            $total_cotton=getTotalCotton($emp_id,$from_date,$to_date);
        }

        $result = mysqli_query($con, $sql);
        $i = 0;
        $totalQuantity = 0;
        $totalPrice = 0;

        while ($row = mysqli_fetch_array($result)) {

            $i++;
            $totalQuantity = $totalQuantity + $row['qty'];
            $totalPrice = $totalPrice + $row['total_price'];

            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . date('d F, Y', strtotime($row['date'])) . "</td>";
            echo "<td>" . $row['lot_no'] . "</td>";
            echo "<td>" . $row['item_name'] . "</td>";
            echo "<td>" . $row['qty'] . "</td>";
            echo "<td>" . $currency . $row['price'] . "</td>";
            echo "<td>" . $currency . $row['total_price'] . "</td>";



            echo "</tr> ";

        }
        ?>


        <tr class="total">


            <td></td>
            <td>Fancy= <?php echo $total_fancy;?> pcs</td>
            <td>Cotton= <?php echo $total_cotton;?> pcs</td>
            <td><b>Total=</b></td>
            <td><b><?php echo $totalQuantity ?> pcs</b></td>
            <td></td>

            <td><b><?php echo $currency . ' ' . number_format($totalPrice,2) ?></td>
            <td></td>
        </tr>


    </table>

    <table>
        <br>
        <h2>Employee Cost List (কর্মচারীর খরচের তালিকা)</h2>

        <tr class="heading">
            <td>SL</td>
            <td>Date</td>
            <td>Description</td>
            <td>Total Debit (মোট খরচ)</td>
        </tr>


        <?php
        $currency = getCurrency();

        if ($emp_id == 'all'){
            $sql = "SELECT * FROM production";
            $total_fancy=getTotalItem("Fancy");
            $total_cotton=getTotalItem("Cotton");

        }else{
            $sql = "SELECT * FROM salary WHERE date>='$from_date' AND date<='$to_date' AND emp_id='$emp_id' AND type='Debit'";
            $total_fancy=getTotalFancy($emp_id,$from_date,$to_date);
            $total_cotton=getTotalCotton($emp_id,$from_date,$to_date);
        }

        $result = mysqli_query($con, $sql);
        $i = 0;
        $totalCost = 0;
        $totalAmount = $totalPrice;

        while ($row = mysqli_fetch_array($result)) {

            $i++;

            $debit = $row['salary'];
            $totalCost = $totalCost + $debit;
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . date('d F, Y', strtotime($row['date'])) . "</td>";
            echo "<td>" . $row['reference'] . "</td>";
            echo "<td>" . $currency . $debit . "</td>";



            echo "</tr> ";

        }
        ?>


        <tr class="total">


            <td></td>
            <td></td>
            <td><b>Total Debit (মোট খরচ)=</b></td>
            <td><b><?php echo $currency . ' ' . number_format($totalCost,2) ?></b></td>
        </tr>


        <tr class="total">

            <td></td>
            <td></td>
            <td><b>Total Credit (মোট জমা) =</b></td>
            <td><b><?php echo $currency . ' ' . number_format($totalAmount,2) ?></b></td>
            <?php $balance = ($totalAmount - $totalCost) ?>
            <td></td>
        </tr>


        <tr class="total">

            <td></td>
            <td></td>
            <td><b>Total Balance (মোট অবশিষ্ট)=</b></td>
            <td><b><?php echo $currency . ' ' . number_format($balance,2) ?></b></td>
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