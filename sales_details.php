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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Details</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="plugins/jquery.min/jquery.min.js"></script>
    <!--Preloader-->
    <link rel="stylesheet" href="dist/css/preloader.css">
    <script src="dist/js/preloader.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">

<div class="se-pre-con"></div>

<div class="wrapper">


    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>

    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="dist/img/AdminLTELogo.png"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <?php require('sidebar.php') ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sales Details</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <?php
                            $user_type = $_SESSION['user_type'];
                            ?>


                            <button class='btn btn-primary'><i
                                        class='fas fa-file-invoice'></i> <?php echo $getid = $_GET['id']; ?>
                            </button>


                            <button type="button" onclick="window.open('invoice.php?id=<?php echo $getid ?>')"
                                    class='btn btn-primary'><i class='fas fa-file-invoice'></i> Generate Invoice
                            </button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Product Name</th>
                                    <th>Product Qty</th>
                                    <th>Product Price</th>
                                    <th>Total</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                include('db_connect.php');
                                include("my_function.php");
                                $getid = $_GET['id'];
                                $paid_amount = $_GET['paid'];
                                $discount = $_GET['discount'];
                                $notes = $_GET['notes'];


                                $currency = getCurrency();

                                $result = mysqli_query($con, "SELECT * FROM order_details WHERE invoice_id='$getid'");


                                $i = 1;
                                $sub_total = 0;
                                $total_qty = 0;

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";

                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . productNameById($row['product_id']) . "</td>";
                                    echo "<td>" . $row['product_quantity'] . "</td>";
                                    echo "<td>" . $currency . $row['sales_price'] . "</td>";

                                    echo "<td>" . getCurrency() . $row['product_quantity'] * $row['sales_price'] . "</td>";

                                    $sub_total = $sub_total + $row['product_quantity'] * $row['sales_price'];
                                    $total_qty = $total_qty + $row['product_quantity'];

                                    $i++;

                                    echo "</tr> ";


                                }

                                ?>

                                <tr>
                                    <td colspan="2" align="right">
                                        <b>Total Qty</b>
                                    </td>

                                    <td colspan="1" align="left">
                                        <b> <?php echo $total_qty ?></b>
                                    </td>


                                    <td colspan="1" align="right">
                                        <b>Sub Total</b>
                                    </td>

                                    <td colspan="2">
                                        <?php echo getCurrency() . ' ' . $sub_total ?>

                                    </td>

                                </tr>


                                <tr>
                                    <td colspan="4" align="right">
                                        <b>Discount(-)</b>
                                    </td>

                                    <td colspan="1">
                                        <?php echo getCurrency() . ' ' . $discount ?>

                                    </td>

                                </tr>


                                <tr>
                                    <td colspan="4" align="right">
                                        <b>Total Amount</b>
                                    </td>

                                    <td colspan="1">
                                        <b>
                                            <?php
                                            $total = $sub_total - $discount;

                                            echo getCurrency() . ' ' . $total ?></b>

                                    </td>

                                </tr>


                                <tr>
                                    <td colspan="4" align="right">
                                        <b>Total Paid</b>
                                    </td>

                                    <td colspan="1">
                                        <b>
                                            <?php


                                            echo getCurrency() . ' ' . $paid_amount ?></b>

                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="4" align="right">
                                        <b>Total Due</b>
                                    </td>

                                    <td colspan="1">
                                        <b>
                                            <?php
                                            $total_due = $total - $paid_amount;

                                            echo getCurrency() . ' ' . $total_due ?></b>

                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="1" align="left">
                                        <b>Order Notes</b>
                                    </td>
                                    <td colspan="1">
                                        <?php echo $notes; ?>
                                    </td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <?php

                                echo " </tbody>";
                                echo " </table>";

                                ?>
                        </div>
                        <!-- /.card-body -->
                    </div>


                    <div class="card">
                        <div class="card-header">


                            <button class='btn btn-primary'><i class='fas fa-file-invoice'></i> Payment History
                            </button>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-success">
                                <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Reference</th>
                                    <th>Amount</th>


                                </tr>
                                </thead>
                                <tbody>

                                <?php


                                $getid = $_GET['id'];
                                $currency = getCurrency();

                                $result2 = mysqli_query($con, "SELECT * FROM sales_payment_history WHERE invoice_id='$getid'");


                                $i = 1;
                                $total_paid = 0;
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    echo "<tr>";

                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . date('d F, Y', strtotime($row2['date'])) . "</td>";

                                    echo "<td>" . $row2['payment_method'] . "</td>";
                                    echo "<td>" . $row2['reference'] . "</td>";
                                    echo "<td>" . $currency . $row2['amount'] . "</td>";


                                    $total_paid = $total_paid + $row2['amount'];


                                    $i++;

                                    echo "</tr> ";
                                }


                                ?>

                                <tr>
                                    <td colspan="4" align="right">
                                        <b>Total Paid</b>
                                    </td>

                                    <td colspan="1">
                                        <?php echo $currency . ' ' . $total_paid ?>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "searching": false,
            "ordering": false,
            "paging": false,
            "info": false,
            "lengthChange": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,

            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>


<!-- Modal HTML Markup -->
<div id="updatePaymentModal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Payment</h4>
            </div>
            <div class="modal-body">


                <form role="form" method="POST" id="due_form" action="update_sales_payment.php">
                    <input type="hidden" name="_token" value="">

                    <div class="form-group">
                        <div>
                            <input type="hidden" id="sph_id" class="form-control input-lg" name="sph_id" readonly>
                            <input type="hidden" id="invoice_id" class="form-control input-lg" name="invoice_id"
                                   readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Payment Method</label>
                        <div>
                            <select class="form-control" name="payment_method" id="inputPaymentMethod">
                                <option value="CASH">CASH</option>
                                <option value="BANK">BANK</option>
                                <option value="CARD">CARD</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"> Amount</label>
                        <div>
                            <input type="number" id="amount" class="form-control input-lg" name="amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date</label>
                        <div>
                            <input type="date" id="date" class="form-control input-lg" name="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Reference</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="reference" name="reference"
                                   placeholder="Reference" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" id="purchase_modal_submit" class="btn btn-success">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>


    // Execute something when the modal window is shown.
    $('#updatePaymentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var sph_id = button.data('id');
        var invoice_id = button.data('invoice');
        var get_amount = button.data('amount');
        var get_ref = button.data('ref');
        // Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        // modal.find('.control-level').text('Invoice ID: ' + recipient);
        // modal.find('.control-level').val(recipient);
        modal.find('#sph_id').val(sph_id);
        modal.find('#invoice_id').val(invoice_id);
        modal.find('#reference').val(get_ref);
        modal.find('#amount').val(get_amount);


    });

</script>


</body>
</html>
