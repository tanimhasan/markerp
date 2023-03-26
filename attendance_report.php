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
    <title>Attendance Report By Date</title>
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

    <style>

        @media print {
            html, body {
                height: auto;
            }

            .dt-print-table, .dt-print-table thead, .dt-print-table th, .dt-print-table tr {
                border: 0 none !important;
            }
        }

    </style>
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

            <!-- Sidebar Menu -->
            <?php include('sidebar.php'); ?>
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
                            <h3 class="card-title">All Attendance Information</h3><br>

                            <div class="form-group">

                                <form action="attendance_report.php" id="quickForm" method="post">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>From</label>
                                                <input type="date" name="from_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>To</label>
                                                <input type="date" name="to_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label for="exampleInputVehicle">Select Employee</label>
                                                <select class="form-control select2" name="employee_id">
                                                    <option disabled selected hidden>Select Employee</option>

                                                    <?php
                                                    echo "<option value='" . 'all' . "'>" . 'All' . "</option>";

                                                    include('db_connect.php');
                                                    $result = mysqli_query($con, "SELECT * FROM employee");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<option value='" . $row['employee_id'] . "'>" . $row['name'] . "</option>";
                                                    }

                                                    echo "</select>";

                                                    ?>
                                            </div>
                                        </div>



                                    </div>


                                    <!-- text input -->
                                    <div class="form-group">

                                        <button type="submit" id="add_ex_date"  class="btn btn-primary"><i
                                                class="fa fa-check-circle"></i> Submit
                                        </button>

                                    </div>


                                </form>



                            </div>

                        </div>


                        <?php

                        include('my_function.php');
                        $currency = getCurrency();

                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                        $employee_id=$_POST['employee_id'];
                        $from_date=$_POST['from_date'];
                        $to_date=$_POST['to_date'];

                        ?>


                        <!-- /.card-header -->
                        <div class="card-body">

                            <p><?php echo "Attendance from ". date('d F Y', strtotime($from_date)) . " to ". date('d F Y', strtotime($to_date))  ?></p>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Attendance Status</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                if ($employee_id == 'all'){
                                    $sql = "SELECT * FROM attendance WHERE  att_date>='$from_date' AND att_date<='$to_date' ORDER BY att_date DESC";
                                } else{
                                    $sql = "SELECT * FROM attendance WHERE  att_date>='$from_date' AND att_date<='$to_date' AND emp_id='$employee_id' ORDER BY att_date DESC";
                                }

                                $result = mysqli_query($con, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";

                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . employeeName($row['emp_id']) . "</td>";
                                    echo "<td>" . $row['attendance'] . "</td>";
                                    echo "<td>" . date('d F, Y', strtotime($row['att_date'])) . "</td>";

                                    $i++;

                                    echo "</tr> ";
                                }

                                echo " </tbody>";
                                echo " </table>";


                                }
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>


<script type="text/javascript">

    $(document).on('click', '#add_ex_date', function (e) {


        $('#quickForm').validate({
            rules: {
                employee_id: {
                    required: true
                },
                from_date: {
                    required: true
                },
                to_date: {
                    required: true
                },
            },
            messages: {
                employee_id: {
                    required: "Please Select Employee"
                },
                from_date: {
                    required: "Please Select From Date"
                },
                to_date: {
                    required: "Please Select to date"
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
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Attendance Report',
                    filename: 'attendance_report',


                    exportOptions: {
                        columns: [0, 1, 2, 3],
                        alignment: 'center',

                    }
                },

                {
                    extend: 'print',
                    autoPrint: true,
                    message: '<?php echo 'Print Time: ' . date(" h:m a d F, Y")?>',
                    title: '<p align="center">Attendance Report</p>',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
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