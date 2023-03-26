<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";
else {
    header("location:index.php");

}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $getid = $_GET['id'];
    include('db_connect.php');


    if (!empty($getid)) {
        $query = mysqli_query($con, "SELECT * FROM banking WHERE account_id='$getid'");
        $row = mysqli_fetch_assoc($query);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('db_connect.php');

    $account_id = $_POST['account_id'];
    $account_name = $_POST['account_name'];
    $account_type = $_POST['account_type'];
    $account_number = $_POST['account_number'];
    $bank_name = $_POST['bank_name'];
    $bank_address = $_POST['bank_address'];
    $balance = $_POST['balance'];


    $query = mysqli_query($con, "SELECT * FROM banking WHERE account_id='$account_id'");
    $row = mysqli_fetch_assoc($query);


    $sql = mysqli_query($con, "Update banking SET account_name='$account_name',account_type='$account_type',account_number='$account_number',bank_name='$bank_name',bank_address='$bank_address',balance='$balance' WHERE account_id='$account_id'");

    if ($sql) {
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Bank Account ' . $account_name);
        // End insert access log in to data base
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Successfully updated!","Done!","success");';
        echo '}, 500);</script>';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { window.open('bank_account.php','_self')";
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
    <title>Update Bank Account</title>
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

    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>
    <!-- Sidebar -->

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

                            <h3 class="card-title">Update customers information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="edit_bank_account.php">
                            <div class="card-body">

                                <div class="form-group">

                                    <input type="hidden" name="account_id" class="form-control" id="exampleInputAccountId"
                                           value="<?php echo $row['account_id'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputCustomerName">Account Name</label>
                                            <input type="text" name="account_name" class="form-control" id="exampleInputAccountName"
                                                   value="<?php echo $row['account_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleUserType">Select Account Type</label>
                                            <select class="form-control select2" name="account_type" id="exampleAccountType">
                                                <?php include('my_function.php')?>
                                                <option
                                                        value="<?php echo $row['account_type'] ?>"><?php echo typeName($row['account_type']) ?></option>
                                                <option value='0'>Savings</option>
                                                <option value='1'>Check</option>
                                                <option value='2'>Credit</option>
                                                <option value='3'>Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputAccountNumber">Account Number</label>
                                            <input type="number" name="account_number" class="form-control" id="exampleInputAccountNumber"
                                                   value="<?php echo $row['account_number'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputBankName">Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control" id="exampleInputBankName"
                                                   value="<?php echo $row['bank_name'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputAddress">Bank Address</label>
                                            <input type="text" name="bank_address" class="form-control" id="exampleInputAddress"
                                                   value="<?php echo $row['bank_address'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputBalance">Balance</label>
                                            <input type="number" name="balance" class="form-control" id="exampleInputBalance"
                                                   value="<?php echo $row['balance'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="update_customer" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Account</button>
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

<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

    $(document).on('click', '#update_account', function (e) {


        $('#quickForm').validate({
            rules: {
                account_name: {
                    required: true
                },
                account_type: {
                    required: true
                },
                account_number: {
                    required: true,
                },
                bank_name: {
                    required: true
                },
                bank_address: {
                    required: true
                },
                balance: {
                    required: true
                },


            },
            messages: {
                account_name: {
                    required: "Please enter account name"
                },
                account_type: {
                    required: "Please select account type"
                },
                account_number: {
                    required: "Please enter account number",
                },
                bank_name: {
                    required: "Please enter bank name"
                },
                bank_address: {
                    required: "Please enter bank address"
                },
                balance: {
                    required: "Please enter balance"
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

    $(document).on('click', '#update_account', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Want to update ?',
            text: 'Are you sure?',
            icon: 'warning',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update it!',
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
