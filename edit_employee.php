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
        $query = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$getid'");
        $row = mysqli_fetch_assoc($query);
        $designation_name=$row['designation'];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('db_connect.php');

    $employee_id = $_POST['employee_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $nid = $_POST['nid'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];
    $driving_license = $_POST['driving_license'];


    $query = mysqli_query($con, "SELECT * FROM employee WHERE employee_id='$employee_id'");
    $row = mysqli_fetch_assoc($query);


    $sql = mysqli_query($con, "UPDATE employee SET name='$name',phone='$phone',email='$email',designation='$designation',nid='$nid',driving_license='$driving_license',salary='$salary',address='$address' WHERE employee_id='$employee_id'");

    if ($sql) {
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Employee ' . $name);
        // End insert access log in to data base
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Successfully Updated!","Done!","success");';
        echo '}, 500);</script>';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { window.open('employee_list.php','_self')";
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
    <title>Update Employee</title>
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

                            <h3 class="card-title">Update Employee Information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="edit_employee.php">
                            <div class="card-body">

                                <div class="form-group">
                                    <input type="hidden" name="employee_id" class="form-control" id="exampleInputexpenseId"
                                           value="<?php echo $row['employee_id'] ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmployeeName">Employee Name</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmployeeName"
                                                   value="<?php echo $row['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPhone">Employee Phone Number</label>
                                            <input type="number" name="phone" class="form-control" id="exampleInputPhone"
                                                   value="<?php echo $row['phone'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Employee Email</label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail"
                                                   value="<?php echo $row['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputDesignation">Select Designation</label>
                                            <select class="form-control select2" name="designation">


                                                <?php echo "<option value='" . $designation_name . "'>" . $designation_name . "</option>"; ?>
                                                <?php

                                                $result = mysqli_query($con, "SELECT * FROM designation");
                                                while ($row2 = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row2['designation_name'] . "'>" . $row2['designation_name'] . "</option>";

                                                }
                                                echo "</select>";

                                                ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputNid">Employee NID</label>
                                            <input type="number" name="nid" class="form-control" id="exampleInputNid"
                                                   value="<?php echo $row['nid'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputLicense">Driving License No <small>[If Any]</small></label>
                                            <input type="text" name="driving_license" class="form-control" id="exampleInputLicense"
                                                   value="<?php echo $row['driving_license'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputSalary">Employee Salary</label>
                                            <input type="number" name="salary" class="form-control" id="exampleInputSalary"
                                                   value="<?php echo $row['salary'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputAddress">Employee Address</label>
                                            <input type="text" name="address" class="form-control" id="exampleInputAddress"
                                                   value="<?php echo $row['address'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="update_employee" class=" btn btn-primary"><i class="fa fa-check-circle"></i> Update Employee</button>
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

    $(document).on('click', '#update_employee', function (e) {


        $('#quickForm').validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                designation: {
                    required: true
                },
                nid: {
                    required: true
                },
                salary: {
                    required: true
                },
                address: {
                    required: true
                },


            },
            messages: {
                name: {
                    required: "Please enter employee name"
                },
                phone: {
                    required: "Please enter phone number"
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter a valid email address"
                },
                designation: {
                    required: "Please enter employee designation"
                },
                nid: {
                    required: "Please enter NID"
                },
                salary: {
                    required: "Please enter salary"
                },
                address: {
                    required: "Please enter address"
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

    $(document).on('click', '#update_employee', function (e) {
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
