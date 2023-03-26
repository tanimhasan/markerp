
<?php
session_start();
if (isset($_SESSION['email']))
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
    <title>Sales Report By Date</title>
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
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customers.php" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Customers

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="suppliers.php" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Suppliers

                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="category.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Products Category

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="products.php" class="nav-link">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Products

                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="orders.php" class="nav-link">
                            <i class="nav-icon fas fa-sort-amount-up"></i>
                            <p>
                                Orders

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="expense.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Expense
                            </p>
                        </a>
                    </li>


                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="sales_report.php" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Report</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="sales_report_by_date.php" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Report By Date</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="expense_report.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expense Report</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="expense_report_by_date.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expense Report By Date</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="sales_chart.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Chart </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="expense_chart.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expense Chart</p>
                                </a>
                            </li>

                        </ul>


                    </li>

                    <li class="nav-item">
                        <a href="products.php" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Settings
                                <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="shop_information.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Shop Information</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="shipping_method.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Shipping Method</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="all_admin.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Admin</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="app_banner.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>App Banner</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
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
                            <h3 class="card-title">All sales information by date</h3><br>
                            <div class="form-group">

                                <form action="sales_report_by_date.php" id="myform" method="post">
                                    <div class="row">



                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>From</label>
                                                <input type="date" name="from_date" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="date" name="to_date" class="form-control" required>
                                            </div>
                                        </div>



                                    </div>


                                        <!-- text input -->
                                        <div class="form-group">

                                            <button type="submit"  class="btn btn-primary"><i
                                                        class="fa fa-check-circle"></i> Submit
                                            </button>

                                    </div>


                                </form>


                            </div>

                        </div>


                        <?php

                        include('db_connect.php');
                        include('my_function.php');

                        $currency = getCurrency();
                        if ($_SERVER["REQUEST_METHOD"] == "POST" AND $_POST['from_date']!='' AND ($_POST['to_date'])!='' ) {
                        $from_date=$_POST['from_date'];
                        $to_date=$_POST['to_date'];

                        ?>

                        <!-- /.card-header -->
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>


                                    <th>Product Name</th>
                                    <th>Invoice ID</th>
                                    <th>Product Qty</th>
                                    <th>Product Weight</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>



                                </tr>
                                </thead>
                                <tbody>

                                <?php


                                $sql = "SELECT * FROM order_details WHERE  product_order_date>='$from_date' AND product_order_date<='$to_date'  ORDER BY order_details_id DESC";



                                $total_price = floatval(getTotalOrderPriceDateRange($from_date,$to_date));
                                $total_tax = floatval(getTotalTaxDateRange($from_date,$to_date));
                                $total_discount = floatval(getTotalDiscountDateRange($from_date,$to_date));

                                $net_sales = $total_price + $total_tax - $total_discount;


                                $result = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";

                                    echo "<td>" . $i . "</td>";

                                    echo "<td>" . productNameById($row['product_id']) . "</td>";
                                    echo "<td>" . $row['invoice_id'] . "</td>";
                                    echo "<td>" . $row['product_quantity'] . "</td>";
                                    echo "<td>" . $row['product_quantity'] . "</td>";
                                    echo "<td>" . $currency . $row['sales_price'] . "</td>";
                                    echo "<td>" .$row['product_order_date'] . "</td>";


                                    $i++;

                                    echo "</tr> ";
                                }


                                echo "<tfoot>";
                                echo "<tr>";
                                echo "<th>=</th>";
                                echo "<th>Summary</th>";

                                echo "<th>Total Order Price= " . getCurrency() . $total_price . "</th>";


                                echo "<th>Total Tax =" . getCurrency() . $total_tax . "</th>";
                                echo "<th>Total Discount=" . getCurrency() . $total_discount . "</th>";
                                echo "<th>Net Sales=" . getCurrency() . $net_sales . "</th>";


                                echo "<th></th>";
                                echo "</tr>";

                                echo " </tbody>";
                                echo " </table>";


                                echo "</div>";


                                echo "</div>";


                                echo "</div>";

                                }
                                ?>
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
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Expense Report',
                    filename: 'expense_report',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },

                {
                    extend: 'print',
                    message: '<?php echo 'Print Time: ' . date(" h:m a d F, Y")?>',
                    title: '<p align="center">Sales Report</p>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },


            ]
        });

    });
</script>


<script>
    function change() {
        document.getElementById("myform").submit();
    }
</script>

<!--For data export and print-->
<script src="plugins/buttons/dataTables.buttons.min.js"></script>
<script src="plugins/buttons/jszip.min.js"></script>
<script src="plugins/buttons/pdfmake.min.js"></script>
<script src="plugins/buttons/vfs_fonts.js"></script>
<script src="plugins/buttons/buttons.html5.min.js"></script>
<script src="plugins/buttons/buttons.print.min.js"></script>
<!--For data export and print-->

</body>
</html>
