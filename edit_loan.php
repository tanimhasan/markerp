<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key'])){
    echo " ";
} else {
    header("location:index.php");

}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $getid = $_GET['id'];

    include('db_connect.php');
    if (!empty($getid)) {
        $query = mysqli_query($con, "SELECT * FROM loan WHERE loan_id='$getid'");
        $row = mysqli_fetch_assoc($query);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_connect.php');

    $loan_id = $_POST['loan_id'];
    $name = $_POST['name'];
    $loan = $_POST['loan'];
    $notes = $_POST['notes'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $query = mysqli_query($con, "SELECT * FROM loan where loan_id='$loan_id'");
    $row = mysqli_fetch_assoc($query);

    if (mysqli_query($con, "Update loan SET name='$name',loan='$loan',notes='$notes',status='$status',date='$date' WHERE loan_id='$loan_id'")) {
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Loan ' . $name);
        // End insert access log in to data base

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Successfully updated!","Done!","success");';
            echo '}, 500);</script>';

            echo '<script type="text/javascript">';
            echo "setTimeout(function () { window.open('loan.php','_self')";
            echo '}, 1500);</script>';

    } else {// display the error message
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("ERROR!","Something Wrong!","error");';
            echo '}, 500);</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Loan</title>
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

                            <h3 class="card-title">Edit Loan information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="edit_loan.php">
                            <div class="card-body">

                                <div class="form-group">

                                    <input type="hidden" name="loan_id" class="form-control" id="exampleInputUnitId"
                                           value="<?php echo $row['loan_id'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputName">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                   id="exampleInputName"
                                                   value="<?php echo $row['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputUnitName">Loan</label>
                                            <input type="text" name="loan" class="form-control" id="exampleInputUnitName"
                                                   value="<?php echo $row['loan'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputWeightUnit">Select Status</label>
                                            <select class="form-control" name="status">
                                                <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>

                                                <option value='Received'>Received</option>
                                                <option value='On Going'>On Going</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputDate">Date</label>
                                            <input type="date" name="date" class="form-control" id="exampleInputDate"
                                                   value="<?php echo $row['date'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputName">Notes</label>
                                            <input type="text" name="notes" class="form-control"
                                                   id="exampleInputName"
                                                   value="<?php echo $row['notes'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="update_loan" class="btn btn-primary"> <i class="fa fa-check-circle"></i> Update Loan</button>
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

    $(document).on('click', '#update_loan', function (e) {


        $('#quickForm').validate({
            rules: {
                emp_id: {
                    required: true
                },
                loan: {
                    required: true
                },
                notes: {
                    required: true
                },
            },
            messages: {
                emp_id: {
                    required: "Please Select Employee"
                },
                loan: {
                    required: "Please enter loan"
                },
                notes: {
                    required: "Please write notes"
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

    $(document).on('click', '#update_loan', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Want to Update ?',
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
