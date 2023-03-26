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
    <title>Purchase</title>
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

    <!--For data export and print button css-->
    <link rel="stylesheet" href="dist/css/buttons.dataTables.min.css">

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

    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>
    <!-- Sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


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
                            <button type="button" onclick="location.href = 'add_purchase.php';"
                                    class="btn btn-primary float-right"><i class='fas fa-plus-circle'></i> Add Purchase
                            </button>
                            <h3 class="card-title">All Purchase information</h3>

                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Supplier</th>
                                    <th>Purchase Date</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <?php
                                    $user_type = $_SESSION['user_type'];
                                    if ($user_type == 'admin') {


                                        ?>
                                        <th>Action</th>

                                        <?php
                                    }
                                    ?>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                include('db_connect.php');
                                include("my_function.php");
                                $sql = "SELECT * FROM purchase ORDER BY purchase_id DESC";
                                $result = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";

                                    $paid = $row['paid_amount'];
                                    $total = $row['total_amount'];
                                    $due = $total - $paid;

                                    echo "<td>" . $i . "</td>";

                                    echo "<td>" . supplierName($row['supplier_id']) . "</td>";
                                    echo "<td>" . date('d F, Y', strtotime($row['purchase_date'])) . "</td>";

                                    echo "<td>" . getCurrency() . number_format($row['total_amount'],2) . "</td>";
                                    echo "<td>" . getCurrency() . number_format($row['paid_amount'],2) . "</td>";

                                    echo "<td>" . getCurrency() . number_format($due,2) . "</td>";


                                    if ($paid == 0) {


                                        echo "<td>  <button type='button' class='btn btn-block bg-gradient-danger btn-xs'>Pending</button></td>";

                                    } else if ($due > 0 and $due < $total) {
                                        echo "<td>  <button type='button' class='btn btn-block bg-gradient-info btn-xs'>Partial</button></td>";

                                    } else {
                                        echo "<td>  <button type='button' class='btn btn-block bg-gradient-success btn-xs'>Completed</button></td>";

                                    }


                                    if ($due==0)
                                    {
                                        echo "<td>  <button type='button' class='btn btn-block bg-gradient-success btn-xs' >Done</button></td>";

                                    }
                                    else
                                    {
                                        echo "<td>  <button type='button' class='btn btn-block bg-gradient-gray btn-xs'  data-toggle=\"modal\" data-target=\"#paymentModal\" data-id='" . $row['purchase_id'] . "'  data-sid='" . $row['supplier_id'] . "'  data-due='" . $due. "'>Add Payment</button></td>";

                                    }


                                    if ($user_type == 'admin') {

                                        echo "<td><a class='btn btn-primary'  href=\"purchase_details.php?id=" . $row['purchase_id']."&paid=".$row['paid_amount'] . "\" ><i class='fas fa-eye'></i></a>  ";
                                        echo "<a class='confirmation btn btn-danger'  href=\"delete_purchase.php?id=" . $row['purchase_id'] . "\" ><i class='fas fa-trash'></i></a></td>";



                                    }

                                    $i++;

                                    echo "</tr> ";
                                }

                                echo " </tbody>";
                                echo " </table>";

                                ?>
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

<!-- page script for export data from data tables -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": true,

            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdfHtml5',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },

                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },


            ]


        });

    });
</script>


<script>
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>


<!--For data export and print-->
<script src="plugins/buttons/dataTables.buttons.min.js"></script>
<script src="plugins/buttons/jszip.min.js"></script>
<script src="plugins/buttons/pdfmake.min.js"></script>
<script src="plugins/buttons/vfs_fonts.js"></script>
<script src="plugins/buttons/buttons.html5.min.js"></script>
<script src="plugins/buttons/buttons.print.min.js"></script>
<!--For data export and print-->


<!-- Modal HTML Markup -->
<div id="paymentModal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">New Payment</h1>
            </div>
            <div class="modal-body">


                <form role="form" method="POST" id="due_form" action="add_purchase_payment.php">
                    <input type="hidden" name="_token" value="">

                    <div class="form-group">
                        <label class="control-label">Invoice Number</label>
                        <div>
                            <input type="text" id="id" class="form-control input-lg" name="purchase_id" readonly>
                            <input type="hidden" id="sid" class="form-control input-lg" name="supplier_id" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Payment Method</label>
                        <div>
                            <select class="form-control" name="payment_method" id="inputPaymentMethod">
                                <option value="CASH">CASH</option>
                                <option value="BANK">BANK</option>
                                <option value="CARD">CARD</option>
                                <option value="BKASH">BKASH</option>
                                <option value="NAGAD">NAGAD</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Due Amount</label>
                        <div>
                            <input type="number" id="amount"  class="form-control input-lg" name="amount" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date</label>
                        <div>
                            <input type="date" class="form-control input-lg" name="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Reference</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="reference" name="reference" placeholder="Reference" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" id="purchase_modal_submit" class="btn btn-success">
                                Pay Now
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
   $('#paymentModal').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); // Button that triggered the modal
       var recipant = button.data('id');
       var get_sid = button.data('sid');
       var get_due = button.data('due');
       // Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
       var modal = $(this);
       // modal.find('.control-level').text('Invoice ID: ' + recipient);
       // modal.find('.control-level').val(recipient);
       modal.find('#id').val(recipant);
       modal.find('#sid').val(get_sid);
       modal.find('#amount').val(get_due).prop('max',get_due);
       modal.find('#amount').val(get_due).prop('min',1);

   });

</script>





<script type="text/javascript">

    $(document).on('click', '#purchase_modal_submit', function (e) {


        $('#due_form').validate({
            rules: {

                paid_amount: {
                    required: true
                },

                reference: {
                    required: true
                },


            },
            messages: {
                paid_amount: {
                    required: "Please enter amount"
                },

                reference: {
                    required: "Please enter reference"
                },

            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

    });


</script>


</body>
</html>
