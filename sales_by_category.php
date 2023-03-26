<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
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
    <title>Sales Report</title>
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
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!--For data export and print button css-->
    <link rel="stylesheet" href="dist/css/buttons.dataTables.min.css">

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

    <!--Sidebar -->
    <?php include('sidebar.php')?>
    <!--Sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">


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

                            <h3 class="card-title">All Sales information in <?php echo date("Y"); ?></h3>

                        </div>


                        <form action="sale_by_category.php" method="get">
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-2"  style="text-align: center">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select class="form-control select2" name="year" required>
                                            <option value="" disabled selected>Choose option</option>
                                            <?php
                                            for ($year = (int)date('Y'); 2015 <= $year; $year--): ?>
                                                <option value="<?=$year;?>"><?=$year;?></option>
                                            <?php endfor; ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-5" style="margin-top: 32px;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>



                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include('db_connect.php');
                                include('my_function.php');
                                $currency = getCurrency();
                                $current_year = date("Y");
                                $result = mysqli_query($con, "SELECT * FROM product_category");
                                while ($row = mysqli_fetch_array($result)) {

                                    echo "<tr>";
                                    echo "<td>" . $row['product_category_name'] . "</td>";
                                    $id = $row['product_category_id'];
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'01',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'02',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'03',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'04',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'05',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'06',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'07',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'08',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'09',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'10',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'11',$current_year) . "</td>";
                                    echo "<td>" . $currency . getMonthlySalesReport($id,'12',$current_year) . "</td>";
                                    echo "</tr> ";
                                }

                                echo "<tr>";
                                echo "<th>Sub Total</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('01',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('02',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('03',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('04',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('05',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('06',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('07',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('08',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('09',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('10',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('11',$current_year),2) . "</th>";
                                echo "<th>" . $currency . number_format(getMonthlySales('12',$current_year),2) . "</th>";
                                echo "</tr>";


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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    }
                },
                {
                    extend: 'pdfHtml5',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    }
                },

                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
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
