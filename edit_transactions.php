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
        $query = mysqli_query($con, "SELECT * FROM transaction WHERE tran_id='$getid'");
        $row = mysqli_fetch_assoc($query);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('db_connect.php');
    include('my_function.php');

    $tran_id = $_POST['tran_id'];
    $account_id = $_POST['account_id'];
    $tran_date = $_POST['tran_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $reference = $_POST['reference'];
    $tran_type = $_POST['tran_type'];

    if ($tran_type == 'Deposit'){
        $get_amount=getBankAmount($account_id);
        $tran_amount=getTranAmount($tran_id);
        $updated_amount=$get_amount-($tran_amount-$amount);
        mysqli_query($con,"UPDATE banking SET balance='$updated_amount' WHERE account_id='$account_id'");
    }elseif ($tran_type == 'Withdraw'){
        $get_amount=getBankAmount($account_id);
        $tran_amount=getTranAmount($tran_id);
        $updated_amount=$get_amount+($tran_amount-$amount);
        mysqli_query($con,"UPDATE banking SET balance='$updated_amount' WHERE account_id='$account_id'");
    }


    $query = mysqli_query($con, "SELECT * FROM transaction WHERE tran_id='$tran_id'");
    $row = mysqli_fetch_assoc($query);


    $sql = mysqli_query($con, "Update transaction SET account_id='$account_id',tran_date='$tran_date',amount='$amount',payment_method='$payment_method',reference='$reference',tran_type='$tran_type' WHERE tran_id='$tran_id'");

    if ($sql) {
        // insert access log in to data base
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Transaction');
        // End insert access log in to data base
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Successfully updated!","Done!","success");';
        echo '}, 500);</script>';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { window.open('transactions.php','_self')";
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
    <title>Update Transaction</title>
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

                            <h3 class="card-title">Update Transaction information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="edit_transactions.php">
                            <div class="card-body">

                                <div class="form-group">

                                    <input type="hidden" name="tran_id" class="form-control" id="exampleInputAccountId"
                                           value="<?php echo $row['tran_id'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleUserType">Select Account</label>
                                            <select class="form-control select2" name="account_id" id="exampleAccountType">

                                                <?php include('my_function.php'); ?>
                                                ?>
                                                <option
                                                        value="<?php echo $row['account_id'] ?>"><?php echo accountName($row['account_id']) ?></option>
                                                <?php
                                                include('db_connect.php');

                                                $result = mysqli_query($con, "SELECT * FROM banking");
                                                while ($row1 = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row1['account_id'] . "'>" . $row1['account_name'] . "</option>";

                                                }
                                                echo "</select>";

                                                ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputAccountNumber">Date</label>
                                            <input type="text" name="tran_date" class="form-control" id="exampleInputAccountNumber" value="<?php echo $row['tran_date'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputBankName">Amount</label>
                                            <input type="number" name="amount" class="form-control" id="exampleInputBankName"
                                                   value="<?php echo $row['amount'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputWeightUnit">Payment Method</label>
                                            <select class="form-control select2" name="payment_method">
                                                <option
                                                        value="<?php echo $row['payment_method'] ?>"><?php echo $row['payment_method'] ?></option>

                                                <option value='CASH'>CASH</option>
                                                <option value='BANK'>BANK</option>
                                                <option value='CARD'>CARD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputReference">Reference</label>
                                            <input type="text" name="reference" class="form-control" id="exampleInputReference"
                                                   value="<?php echo $row['reference'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputWeightUnit">Transaction Type</label>
                                            <select class="form-control select2" name="tran_type" >
                                                <option
                                                        value="<?php echo $row['tran_type'] ?>"><?php echo $row['tran_type'] ?></option>

                                                <option value='Withdraw'>Withdraw</option>
                                                <option value='Deposit'>Deposit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="update_tran" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Transaction</button>
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

    $(document).on('click', '#update_tran', function (e) {


        $('#quickForm').validate({
            rules: {
                account_id: {
                    required: true
                },
                tran_date: {
                    required: true
                },
                amount: {
                    required: true,
                },
                payment_method: {
                    required: true
                },
                reference: {
                    required: true
                },
                tran_type: {
                    required: true
                },


            },
            messages: {
                account_id: {
                    required: "Please Select Account name"
                },
                tran_date: {
                    required: "Please select date"
                },
                amount: {
                    required: "Please enter amount",
                },
                payment_method: {
                    required: "Please Select payment method"
                },
                reference: {
                    required: "Please enter reference"
                },
                tran_type: {
                    required: "Please Select transaction type"
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

    $(document).on('click', '#update_tran', function (e) {
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
