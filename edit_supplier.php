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
    $query = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$getid'");
    $row = mysqli_fetch_assoc($query);
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include('db_connect.php');

  $supplier_id = $_POST['supplier_id'];
  $supplier_name = $_POST['supplier_name'];
  $supplier_contact_person = $_POST['supplier_contact_person'];
  $supplier_email = $_POST['supplier_email'];
  $supplier_phone = $_POST['supplier_phone'];
  $supplier_address = $_POST['supplier_address'];


  $query = mysqli_query($con, "SELECT * FROM suppliers WHERE suppliers_id='$supplier_id'");
  $row = mysqli_fetch_assoc($query);

  $status = "OK";
  $msg = "";


  if ($status == "OK") {


    $sql = mysqli_query($con, "Update suppliers SET suppliers_name='$supplier_name',suppliers_contact_person='$supplier_contact_person',suppliers_email='$supplier_email',suppliers_cell='$supplier_phone',suppliers_address='$supplier_address' WHERE suppliers_id='$supplier_id'");

    if ($sql) {
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'Updated Supplier ' . $supplier_name);
        // End insert access log in to data base
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { swal.fire("Successfully updated!","Done!","success");';
      echo '}, 500);</script>';

      echo '<script type="text/javascript">';
      echo "setTimeout(function () { window.open('suppliers.php','_self')";
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
  <title>Update Suppliers</title>
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

              <h3 class="card-title">Update suppliers information</h3>

            </div>


            <form role="form" id="quickForm" method="post" action="edit_supplier.php">
              <div class="card-body">

                <div class="form-group">

                  <input type="hidden" name="supplier_id" class="form-control" id="exampleInputSupplierId"
                         value="<?php echo $row['suppliers_id'] ?>">
                </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputSupplierName">Suppliers Name</label>
                              <input type="text" name="supplier_name" class="form-control" id="exampleInputSupplierName"
                                     value="<?php echo $row['suppliers_name'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputSupplierName">Supplier Contact Person Name</label>
                              <input type="text" name="supplier_contact_person" class="form-control" id="exampleInputSupplierName"
                                     value="<?php echo $row['suppliers_contact_person'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email Address </label>
                              <input type="email" name="supplier_email" class="form-control" id="exampleInputEmail1"
                                     value="<?php echo $row['suppliers_email'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPhone">Phone Number </label>
                              <input type="tel" name="supplier_phone" class="form-control" id="exampleInputPhone"
                                     value="<?php echo $row['suppliers_cell'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputAddress">Supplier Address</label>
                              <input type="text" name="supplier_address" class="form-control" id="exampleInputAddress"
                                     value="<?php echo $row['suppliers_address'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">

                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="update_supplier" class="btn btn-primary"> <i class="fa fa-check-circle"></i> Update Supplier</button>
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

  $(document).on('click', '#update_supplier', function (e) {


    $('#quickForm').validate({
      rules: {

        supplier_name: {
          required: true
        },
        supplier_email: {
          required: true,
          email: true,
        },
        supplier_phone: {
          required: true
        },
        supplier_address: {
          required: true
        },


      },
      messages: {
        supplier_name: {
          required: "Please enter supplier name"
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        supplier_phone: {
          required: "Please enter supplier phone number"
        },
        supplier_address: {
          required: "Please enter supplier address"
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

  $(document).on('click', '#update_supplier', function (e) {
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




</body>
</html>
