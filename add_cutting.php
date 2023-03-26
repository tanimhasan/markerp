<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key'])) {
    echo " ";
}
else {
    header("location:index.php");
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['emp_id'];
    $article_no = $_POST['article_no'];
    $description = $_POST['description'];
    $qty = $_POST['qty'];
    $date = $_POST['date'];

    include('db_connect.php');
    include ('my_function.php');

    $article_max_qty=getArticleMaxQty($article_no);
    $total_cutting_qty=totalCuttingQty($article_no);
    $total_cutting_pcs=$total_cutting_qty+$qty;


    if ($total_cutting_pcs > $article_max_qty) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("ERROR!","Cutting pcs exceed from Article max qty!","error");';
        echo '}, 500);</script>';
    } else {
        if (mysqli_query($con, "INSERT INTO cutting_book (`emp_id`,`description`,`qty`,`date`,`article_no`) VALUE ('$emp_id','$description','$qty','$date','$article_no')")) {
            // insert access log in to data base

            $user_email = $_SESSION['email'];
            $user_id = getIdByEmail($user_email);
            insertActivityLog($user_id,'Added Cutting Data');
            // End insert access log in to data base
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Successfully Added!","Done!","success");';
            echo '}, 500);</script>';

            echo '<script type="text/javascript">';
            echo "setTimeout(function () { window.open('cutting_book.php','_self')";
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
    <title>Add Production Details Data</title>
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

                            <h3 class="card-title">Add Production Details Information</h3>

                        </div>


                        <form role="form" id="quickForm" method="post" action="add_cutting.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmployee">Select Employee</label>
                                    <select class="form-control select2" name="emp_id">
                                        <option disabled selected hidden>Select Employee</option>

                                        <?php
                                        include('db_connect.php');
                                        $result = mysqli_query($con, "SELECT * FROM employee");
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['employee_id'] . "'>" . $row['name'] . "</option>";

                                        }
                                        echo "</select>";

                                        ?>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmployee">Select Article</label>
                                    <select class="form-control select2" name="article_no">
                                        <option disabled selected hidden>Select Article</option>

                                        <?php
                                        include('db_connect.php');
                                        $result = mysqli_query($con, "SELECT * FROM article");
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['article_no'] . "'>" . $row['article_no'] . "</option>";

                                        }
                                        echo "</select>";

                                        ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDescription">Description</label>
                                    <textarea name="description" class="form-control" id="exampleInputNotes"
                                              placeholder="Write Description" style="height:100px"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputlQty">Quantity</label>
                                    <input type="number" name="qty" class="form-control" id="exampleInputloan"
                                           placeholder="Enter qty">

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDate">Date</label>
                                    <input type="date" name="date" class="form-control" id="exampleInputloan"
                                    >
                                </div>



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="reset" class="btn btn-dark"><i class="fa fa-times-circle"></i> Reset
                                </button>
                                <button type="submit" id="add_loan" class="btn btn-primary"><i
                                        class="fa fa-check-circle"></i> Add Data
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

    $(document).on('click', '#add_loan', function (e) {


        $('#quickForm').validate({
            rules: {
                emp_id: {
                    required: true
                },
                article_no: {
                    required: true
                },
                description: {
                    required: true
                },
                qty: {
                    required: true
                },
                date: {
                    required: true
                },
            },
            messages: {
                emp_id: {
                    required: "Please Select Employee"
                },
                article_no: {
                    required: "Please enter article no"
                },
                description: {
                    required: "Please write description"
                },

                qty: {
                    required: "Please enter qty"
                },

                date: {
                    required: "Please select date"
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

    $(document).on('click', '#add_loan', function (e) {
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
