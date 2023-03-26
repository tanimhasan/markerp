<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key'])) {
    echo " ";
} else {
    header("location:index.php");
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_connect.php');

    $previous_amount = $_POST['previous_amount'];
    $office_amount = $_POST['office_amount'];
    $shop_amount = $_POST['shop_amount'];
    $date = $_POST['date'];

    $result = mysqli_query($con, "SELECT * FROM daily_ledger where date='$date'");
    $num_rows = mysqli_num_rows($result);


    if ($num_rows > 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("ERROR!","Already exists!","error");';
        echo '}, 500);</script>';
    } else {
        if (mysqli_query($con, "INSERT INTO daily_ledger (`previous_amount`,`office_amount`,`shop_amount`,`date`) VALUE ('$previous_amount','$office_amount','$shop_amount','$date')")) {
            // insert access log in to data base
            include('my_function.php');
            $user_email = $_SESSION['email'];
            $user_id = getIdByEmail($user_email);
            insertActivityLog($user_id,'Added daily ledger date ' . date('d F, Y', strtotime($date)));
            // End insert access log in to data base
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Successfully Added!","Done!","success");';
            echo '}, 500);</script>';

            echo '<script type="text/javascript">';
            echo "setTimeout(function () { window.open('daily_ledger.php','_self')";
            echo '}, 1500);</script>';

        } else {// display the error message
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("ERROR!","Something Wrong!","error");';
            echo '}, 500);</script>';
        }


    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Daily Ledger</title>
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
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">


    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

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

                            <h3 class="card-title">Add Daily Ledger</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="add_daily_ledger.php">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPrevious">Previous Amount (সাবেক)</label>
                                            <input type="text" name="previous_amount" class="form-control"
                                                   id="exampleInputPrevious"
                                                   placeholder="Enter Previous Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputOffice">Office Amount</label>
                                            <input type="text" name="office_amount" class="form-control"
                                                   id="exampleInputOffice"
                                                   placeholder="Enter Office Amount">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputShop">Shop Amount</label>
                                            <input type="text" name="shop_amount" class="form-control"
                                                   id="exampleInputShop"
                                                   placeholder="Enter Shop Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputAddress">Date</label>
                                            <input type="date" name="date" class="form-control" id="exampleInputDate"
                                                   value="<?php echo date("Y-m-d") ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="reset" class="btn btn-dark"><i class="fa fa-times-circle"></i> Reset
                                </button>
                                <button type="submit" id="add_daily_ledger" class="btn btn-primary"><i
                                        class="fa fa-check-circle"></i> Add Daily Ledger
                                </button>
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

    $(document).on('click', '#add_daily_ledger', function (e) {


        $('#quickForm').validate({
            rules: {
                previous_amount: {
                    required: true
                },
                office_amount: {
                    required: true
                },
                shop_amount: {
                    required: true
                },
                date: {
                    required: true
                },
            },
            messages: {
                previous_amount: {
                    required: "Please enter previous amount"
                },
                office_amount: {
                    required: "Please enter office amount"
                },
                shop_amount: {
                    required: "Please enter shop amount"
                },
                date: {
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


<script type="text/javascript">

    $(document).on('click', '#add_daily_ledger', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Want to add ?',
            text: 'Are you sure?',
            icon: 'warning',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
            $('#quickForm').submit();

        }
    })
    });
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
