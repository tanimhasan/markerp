<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";

else {
    header("location:index.php");
}
include('my_function.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $getid = $_GET['id'];
    include('db_connect.php');

    if (!empty($getid)) {
        $query = mysqli_query($con, "SELECT * FROM production WHERE production_id='$getid'");
        $row = mysqli_fetch_assoc($query);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('db_connect.php');

    $production_id = $_POST['production_id'];
    $emp_id = $_POST['emp_id'];
    $lot_no = $_POST['lot_no'];
    $item_name = $_POST['item_name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $total_price = $price * $qty;


    $query = mysqli_query($con, "SELECT * FROM production WHERE production_id='$production_id'");
    $row = mysqli_fetch_assoc($query);

    if (mysqli_query($con, "UPDATE production SET emp_id='$emp_id',lot_no='$lot_no', item_name='$item_name',qty='$qty',price='$price',total_price='$total_price',date='$date' WHERE production_id='$production_id'")) {
        // insert access log in to data base
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Production ' . $item_name);
        // End insert access log in to data base
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Successfully Updated!","Done!","success");';
        echo '}, 500);</script>';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { window.open('production.php','_self')";
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
    <title>Update Production</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="plugins/jquery.min/jquery.min.js"></script>

    <!--Preloader-->
    <link rel="stylesheet" href="dist/css/preloader.css">
    <script src="dist/js/preloader.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
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

                            <h3 class="card-title">Update production information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="edit_production.php">
                            <div class="card-body">


                                <div class="form-group">
                                    <input type="hidden" name="production_id" class="form-control" id="exampleInputProductionId"
                                           value="<?php echo $row['production_id'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFactory">Select Employee</label>
                                            <select class="form-control select2" name="emp_id">
                                                <!--<option disabled selected hidden>Select Factory</option>-->
                                                <option value="<?php echo $row['emp_id'] ?>"><?php echo employeeName($row['emp_id']) ?></option>

                                                <?php
                                                $result = mysqli_query($con, "SELECT * FROM employee");
                                                while ($row1 = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row1['employee_id'] . "'>" . $row1['name'] . "</option>";

                                                }
                                                echo "</select>";

                                                ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone">Lot No</label>
                                            <input type="number" name="lot_no" class="form-control" id="exampleInputAmount"
                                                   value="<?php echo $row['lot_no'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleItemName">Item Name</label>
                                            <input type="text" name="item_name" class="form-control" id="exampleItemName"
                                                   value="<?php echo $row['item_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputQuantity">Quantity</label>
                                            <input type="number" name="qty" class="form-control" id="exampleInputQuantity"
                                                   value="<?php echo $row['qty'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPrice">Price</label>
                                            <input type="number" name="price" class="form-control" id="exampleInputPrice"
                                                   value="<?php echo $row['price'] ?>">
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

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="update_production" class=" btn btn-primary"><i class="fa fa-check-circle"></i> Update Production</button>
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


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

    $(document).on('click', '#update_production', function (e) {


        $('#quickForm').validate({
            rules: {
                emp_id: {
                    required: true
                },
                lot_no: {
                    required: true
                },
                item_name: {
                    required: true,
                },
                qty: {
                    required: true
                },
                price: {
                    required: true
                },


            },
            messages: {
                emp_id: {
                    required: "Please select employee"
                },
                lot_no: {
                    required: "Please enter lot no"
                },
                item_name: {
                    required: "Please enter item name",
                },
                qty: {
                    required: "Please enter quantity"
                },
                price: {
                    required: "Please enter price"
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

    $(document).on('click', '#update_production', function (e) {
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
