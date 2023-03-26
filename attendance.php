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
    <title>Add Attendance</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="plugins/jquery.min/jquery.min.js"></script>

    <!--Preloader-->
    <link rel="stylesheet" href="dist/css/preloader.css">
    <script src="dist/js/preloader.js"></script>

    <script src="plugins/jquery.min/jquery.min.js"></script>
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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">




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
            <?php include('sidebar.php');?>
            <!-- /.sidebar-menu -->


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

                            <h3 class="card-title">Add Attendance For <?php echo date("d F, Y"); ?></h3>

                        </div>

                        <form id="quickForm" method="get" action="give_attendance.php">
                            <div class="card-body">
                                <!--Date Selection-->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputInDate">Select Date</label>
                                            <input type="date" name="att_date" class="form-control" id="exampleInputInDate">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button style="margin-top: 30px" id="giveAtt" type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Give Attendance</button>
                                    </div>
                                </div>
                            </div>
                            <!--Date Selection-->
                        </form>

                        <form role="form" id="quickForm" method="post" action="attendance.php">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Employee Name</th>
                                                <th>Status</th>
                                                <th>Attendance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            include 'db_connect.php';

                                            include('my_function.php');


                                            $sql = "SELECT * FROM employee ORDER BY employee_id DESC";
                                            $result = mysqli_query($con, $sql);
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                <td><?php echo $i ?></td>

                                                <td><?php echo $row['name'] ?></td>
                                                <td>
                                                    <?php
                                                    $i++;
                                                    $emId = $row['employee_id'];
                                                    $att_status = getStatus($emId);
                                                    if (isset($att_status)) {
                                                        if ($att_status == 'Present'){
                                                            echo "<p class='btn btn-success'>Present</p>";
                                                        }else{
                                                            echo "<p class='btn btn-danger'>Absent</p>";
                                                        }

                                                    } else {
                                                        echo "N/A";
                                                    }

                                                    ?></td>

                                                <td>
                                                <?php
                                                if (isset($att_status)) { ?>
                                                    <p class='btn btn-secondary'>Completed</p>
                                                <?php } else { ?>
                                                    <a class='btn btn-success'
                                                       href="add_attendance.php?id=<?php echo $row['employee_id'] . '&cur_date=' . date("Y/m/d") ?>">Present</a>
                                                    <a class='confirmation btn btn-danger'
                                                       href="abs_attendance.php?id=<?php echo $row['employee_id'] . '&cur_date=' . date("Y/m/d") ?>">Absent</a></td>
                                                    </tr>
                                                    <?php

                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </form>


                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

    $(document).on('click', '#giveAtt', function (e) {


        $('#quickForm').validate({
            rules: {
                att_date: {
                    required: true
                },
            },
            messages: {
                att_date: {
                    required: "Please Select Date"
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