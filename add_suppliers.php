<?php
session_start();
if (isset($_SESSION['email']) AND isset($_SESSION['user_type']) AND isset($_SESSION['key']) )
    echo " ";
else {
    header("location:index.php");

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $suppliers_name = $_POST['suppliers_name'];
  $suppliers_contact_person = $_POST['suppliers_contact_person'];
  $suppliers_email = $_POST['suppliers_email'];
  $suppliers_phone = $_POST['suppliers_phone'];
  $suppliers_address = $_POST['suppliers_address'];


  include('db_connect.php');


  $result = mysqli_query($con, "SELECT * FROM suppliers where suppliers_email='$suppliers_email' OR suppliers_cell='$suppliers_phone'");
  $num_rows = mysqli_num_rows($result);


  if ($num_rows > 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal.fire("ERROR!","suppliers already exists!","error");';
    echo '}, 500);</script>';
  } else {
    if (mysqli_query($con, "INSERT INTO suppliers (`suppliers_name`,`suppliers_contact_person`,`suppliers_email`,`suppliers_cell`,`suppliers_address`) VALUE ('$suppliers_name','$suppliers_contact_person','$suppliers_email','$suppliers_phone','$suppliers_address')")) {
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Added Suppliers ' . $suppliers_name);
        // End insert access log in to data base
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal.fire("suppliers Successfully Added!","Done!","success");';
      echo '}, 500);</script>';
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
  <title>Add Suppliers</title>
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

              <h3 class="card-title">Add suppliers information</h3>

            </div>


            <form role="form" id="quickForm" method="post" action="add_suppliers.php">
              <div class="card-body">

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputsuppliersName">Suppliers Name</label>
                              <input type="text" name="suppliers_name" class="form-control" id="exampleInputsuppliersName"
                                     placeholder="Enter suppliers Name">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputsuppliersContactPerson">Suppliers Contact Person Name</label>
                              <input type="text" name="suppliers_contact_person" class="form-control"
                                     id="exampleInputsuppliersContactPerson"
                                     placeholder="Enter Suppliers Contact Person Name">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email Address</label>
                              <input type="email" name="suppliers_email" class="form-control" id="exampleInputEmail1"
                                     placeholder="Enter email">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPhone">Suppliers Phone Number</label>
                              <input type="tel" name="suppliers_phone" class="form-control" id="exampleInputPhone"
                                     placeholder="Enter phone number">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputAddress">Suppliers Address</label>
                              <input type="text" name="suppliers_address" class="form-control" id="exampleInputAddress"
                                     placeholder="Enter suppliers address">
                          </div>
                      </div>
                      <div class="col-md-6">

                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="reset" class="btn btn-dark"><i class="fa fa-times-circle"></i> Reset</button>
                <button type="submit" id="add_suppliers" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add
                  suppliers
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


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

  $(document).on('click', '#add_suppliers', function (e) {


    $('#quickForm').validate({
      rules: {

        suppliers_name: {
          required: true
        },
        suppliers_contact_person: {
          required: true
        },
        suppliers_email: {
          required: true,
          email: true,
        },
        suppliers_phone: {
          required: true
        },
        suppliers_address: {
          required: true
        },


      },
      messages: {
        suppliers_name: {
          required: "Please enter suppliers name"
        },
        suppliers_contact_person: {
          required: "Please enter suppliers contact person name"
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        suppliers_phone: {
          required: "Please enter suppliers phone number"
        },
        suppliers_address: {
          required: "Please enter suppliers address"
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

  $(document).on('click', '#add_suppliers', function (e) {
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


</body>
</html>
