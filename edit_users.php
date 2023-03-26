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
    $query = mysqli_query($con, "SELECT * FROM users WHERE id='$getid'");
    $row = mysqli_fetch_assoc($query);
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include('db_connect.php');

  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_phone = $_POST['user_phone'];
  $user_password = $_POST['user_password'];
  $user_type = $_POST['user_type'];


  $query = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");
  $row = mysqli_fetch_assoc($query);


  $sql = mysqli_query($con, "Update users SET name='$user_name',email='$user_email',cell='$user_phone',password='$user_password',user_type='$user_type' WHERE id='$user_id'");

  if ($sql) {
      // insert access log in to data base
      include('my_function.php');
      $user_email = $_SESSION['email'];
      $user_id = getIdByEmail($user_email);
      insertActivityLog($user_id,'Updated User ' . $user_name);
      // End insert access log in to data base
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal.fire("Successfully Updated!","Done!","success");';
    echo '}, 500);</script>';

    echo '<script type="text/javascript">';
    echo "setTimeout(function () { window.open('all_users.php','_self')";
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
  <title>Update Users</title>
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
            <h1>All Users</h1>

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

              <h3 class="card-title">Update user information</h3>

            </div>


            <form role="form" id="quickForm" method="post" action="edit_users.php">
              <div class="card-body">

                <div class="form-group">

                  <input type="hidden" name="user_id" class="form-control" id="exampleInputuserName"
                         value="<?php echo $row['id'] ?>">
                </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputuserName">User Name</label>
                              <input type="text" name="user_name" class="form-control" id="exampleInputuserName"
                                     value="<?php echo $row['name'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">

                          <div class="form-group">
                              <label for="exampleInputEmail1">Email Address <small>[Not Editable]</small></label>
                              <input type="email" name="user_email" class="form-control" id="exampleInputEmail1" readonly
                                     value="<?php echo $row['email'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPhone">Phone Number <small>[Not Editable]</small></label>
                              <input type="tel" name="user_phone" class="form-control" id="exampleInputPhone" readonly
                                     value="<?php echo $row['cell'] ?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPassword">User Password</label>
                              <input type="password" name="user_password" class="form-control" id="exampleInputPassword"
                                     value="<?php echo $row['password'] ?>">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <div class="form-group">
                                  <label for="exampleUserType">Select User Type</label>
                                  <select class="form-control" name="user_type" id="exampleUserType">
                                      <option
                                              value="<?php echo strtolower($row['user_type']) ?>"><?php echo $row['user_type'] ?></option>
                                      <option value="admin">admin</option>
                                      <option value="manager">manager</option>
                                      <option value="staff">staff</option>
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
                <button type="submit" id="update_user" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update
                  User
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

  $(document).on('click', '#update_user', function (e) {


    $('#quickForm').validate({
      rules: {

        user_name: {
          required: true
        },
        user_email: {
          required: true,
          email: true,
        },
        user_phone: {
          required: true
        },
        user_address: {
          required: true
        },


      },
      messages: {
        user_name: {
          required: "Please enter user name"
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a valid email address"
        },
        user_phone: {
          required: "Please enter user phone number"
        },
        user_address: {
          required: "Please enter user address"
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

  $(document).on('click', '#update_user', function (e) {
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
