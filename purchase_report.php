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
    <title>Purchase Report</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="plugins/jquery.min/jquery.min.js"></script>

    <!--Preloader-->
    <link rel="stylesheet" href="dist/css/preloader.css">
    <script src="dist/js/preloader.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

    <!-- Bootstrap core CSS     -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

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

    <!-- Sidebar Menu -->
    <?php require('sidebar.php') ?>
    <!-- /.sidebar-menu -->

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
            <p>Supplier Wise Purchase Report</p>
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->


                    <div class="card">

                        <div class="card-header">

                            <div class="form-group">

                                <form action="purchase_report_print.php" id="myform" method="post" target="_blank">
                                    <div class="row">


                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>From</label>
                                                <input type="date" name="from_date" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="date" name="to_date" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <!-- text input -->


                                            <div class="form-group">
                                                <label>Select Suppliers</label>
                                                <select class="form-control select2" name="supplier_id"
                                                        id="inputSupplier">
                                                    <option disabled selected hidden>Select Suppliers</option>
                                                    <option value="All">All Suppliers</option>

                                                    <?php

                                                    include('db_connect.php');

                                                    $result = mysqli_query($con, "SELECT * FROM suppliers");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<option value='" . $row['suppliers_id'] . "'>" . $row['suppliers_name'] . "</option>";

                                                    }
                                                    echo "</select>";

                                                    ?>
                                            </div>


                                        </div>


                                    </div>


                                    <!-- text input -->
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-check-circle"></i> Submit
                                        </button>

                                    </div>


                                </form>


                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-12">


                    <p>Product Wise Purchase Report</p>
                    <div class="card">

                        <div class="card-header">

                            <div class="form-group">

                                <form action="product_wise_purchase_report_print.php" id="myform" method="post"
                                      target="_blank">
                                    <div class="row">


                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>From</label>
                                                <input type="date" name="from_date" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="date" name="to_date" class="form-control" required>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <!-- text input -->


                                            <div class="form-group">
                                                <label>Select Item</label>
                                                <select class="form-control select2" name="product_id"
                                                        id="inputProduct">
                                                    <option disabled selected hidden>Select Item</option>
                                                    <option value="All">All Items</option>

                                                    <?php

                                                    include('db_connect.php');

                                                    $result = mysqli_query($con, "SELECT * FROM products");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";

                                                    }
                                                    echo "</select>";

                                                    ?>
                                            </div>


                                        </div>


                                    </div>


                                    <!-- text input -->
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-check-circle"></i> Submit
                                        </button>

                                    </div>


                                </form>


                            </div>

                        </div>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>


<script>
    function change() {
        document.getElementById("myform").submit();
    }
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>

</body>
</html>
