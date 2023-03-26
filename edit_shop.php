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
    $query = mysqli_query($con, "SELECT * FROM shop WHERE shop_id='$getid'");
    $row = mysqli_fetch_assoc($query);
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include('db_connect.php');

  $shop_id = $_POST['shop_id'];
  $shop_name = $_POST['shop_name'];
  $shop_email = $_POST['shop_email'];
  $shop_contact = $_POST['shop_contact'];
  $shop_address = $_POST['shop_address'];
  $shop_status = $_POST['shop_status'];

  $tax = $_POST['tax'];
  $currency_symbol = $_POST['currency_symbol'];


  $query = mysqli_query($con, "SELECT * FROM shop WHERE shop_id='$shop_id'");
  $row = mysqli_fetch_assoc($query);

  $sql = mysqli_query($con, "Update shop SET shop_name='$shop_name',shop_email='$shop_email',shop_contact='$shop_contact',shop_address='$shop_address',tax='$tax',currency_symbol='$currency_symbol',shop_status='$shop_status' WHERE shop_id='$shop_id'");

  if ($sql) {
      // insert access log in to data base
      include('my_function.php');
      $user_email = $_SESSION['email'];
      $user_id = getIdByEmail($user_email);
      insertActivityLog($user_id,'Updated Shop Info ' . $shop_name);
      // End insert access log in to data base
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal.fire("Successfully updated!","Done!","success");';
    echo '}, 500);</script>';

    echo '<script type="text/javascript">';
    echo "setTimeout(function () { window.open('shop_information.php','_self')";
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
  <title>Update Information</title>
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

    <!--Sidebar -->
    <?php include('sidebar.php')?>
    <!--Sidebar -->

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Information</h1>

          </div>

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

              <h3 class="card-title">Update Information</h3>

            </div>


            <form role="form" id="quickForm" method="post" action="edit_shop.php">
              <div class="card-body">

                <div class="form-group">

                  <input type="hidden" name="shop_id" class="form-control" id="exampleInputCustomerName"
                         value="<?php echo $row['shop_id'] ?>">
                </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputshopName">Name</label>
                              <input type="text" name="shop_name" class="form-control" id="exampleInputshopName"
                                     value="<?php echo $row['shop_name'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" name="shop_email" class="form-control" id="exampleInputEmail1"
                                     value="<?php echo $row['shop_email'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPhone">Phone Number</label>
                              <input type="tel" name="shop_contact" class="form-control" id="exampleInputPhone"
                                     value="<?php echo $row['shop_contact'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputAddress">Address</label>
                              <input type="text" name="shop_address" class="form-control" id="exampleInputAddress"
                                     value="<?php echo $row['shop_address'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputTax">Tax (%)</label>
                              <input type="number" name="tax" class="form-control" id="exampleInputTax"
                                     value="<?php echo $row['tax'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputCurrencySymbol">Currency Symbol</label>
                              <input type="text" name="currency_symbol" class="form-control" id="exampleInputCurrencySymbol"
                                     value="<?php echo $row['currency_symbol'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <div class="form-group">
                                  <label for="exampleShopStatus">Status</label>
                                  <select class="form-control" name="shop_status" id="exampleShopStatus">
                                      <option value="<?php echo $row['shop_status'] ?>"><?php echo $row['shop_status'] ?></option>
                                      <option value="OPEN">OPEN</option>
                                      <option value="CLOSED">CLOSED</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">

                      </div>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="update_shop" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update
                  Information
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

  $(document).on('click', '#update_shop', function (e) {


    $('#quickForm').validate({
      rules: {

        shop_name: {
          required: true
        },
        shop_email: {
          required: true,
          email: true,
        },
        shop_phone: {
          required: true
        },
        shop_address: {
          required: true
        },


      },
      messages: {
        shop_name: {
          required: "Please enter shop name"
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        shop_phone: {
          required: "Please enter shop phone number"
        },
        shop_address: {
          required: "Please enter shop address"
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

  $(document).on('click', '#update_shop', function (e) {
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
