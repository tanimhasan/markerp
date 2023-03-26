<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['user_type']) and isset($_SESSION['key'])) {
    echo " ";
    include('db_connect.php');
    include 'my_invoice.php';
    $invoice = new my_invoice();
} else {
    header("location:index.php");

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (!empty($_POST['supplier_id']) && $_POST['invoice_number']) {
        $invoice->saveInvoice($_POST);

        $invoice_num = $_POST['invoice_number'];
        // insert access log in to data base
        include('my_function.php');
        $user_email = $_SESSION['email'];
        $user_id = getIdByEmail($user_email);
        insertActivityLog($user_id,'New Purchase Added ' . $invoice_num);
        // End insert access log in to data base
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Purchase Successfully Added!","Done!","success");';
        echo '}, 500);</script>';

        echo '<script type="text/javascript">';
        echo "setTimeout(function () { window.open('purchase.php','_self')";
        echo '}, 1500);</script>';

    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("ERROR!","Please input all fields","error");';
        echo '}, 500);</script>';
    }
}
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//
//    $customer_name = $_POST['customer_name'];
//    $customer_email = $_POST['customer_email'];
//    $customer_phone = $_POST['customer_phone'];
//    $customer_address = $_POST['customer_address'];
//
//
//    include('db_connect.php');
//
//
//    $result = mysqli_query($con, "SELECT * FROM customers where customer_email='$customer_email' OR customer_cell='$customer_phone'");
//    $num_rows = mysqli_num_rows($result);
//
//
//    if ($num_rows > 0) {
//        echo '<script type="text/javascript">';
//        echo 'setTimeout(function () { swal.fire("ERROR!","Customer email or phone already exists!","error");';
//        echo '}, 500);</script>';
//    } else {
//        if (mysqli_query($con, "INSERT INTO customers (`customer_name`,`customer_email`,`customer_cell`,`customer_address`) VALUE ('$customer_name','$customer_email','$customer_phone','$customer_address')")) {
//            echo '<script type="text/javascript">';
//            echo 'setTimeout(function () { swal.fire("Customer Successfully Added!","Done!","success");';
//            echo '}, 500);</script>';
//        } else {// display the error message
//            echo '<script type="text/javascript">';
//            echo 'setTimeout(function () { swal.fire("ERROR!","Something Wrong!","error");';
//            echo '}, 500);</script>';
//        }
//
//
//    }
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Purchase</title>
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

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!--    <script src="js/invoice.js"</script>-->

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


                        <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
                            <div class="card-body">


                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Purchase Order</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-3">
                                            <h6>Select Supplier</h6>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                </div>
                                                <select class="form-control select2" name="supplier_id"
                                                        id="inputSupplier">


                                                    <?php
                                                    include('db_connect.php');

                                                    $result = mysqli_query($con, "SELECT * FROM suppliers");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo "<option value='" . $row['suppliers_id'] . "'>" . $row['suppliers_name'] . "</option>";

                                                    }
                                                    echo "</select>";

                                                    ?>
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <h6>Select Date</h6>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-calendar-day"></i></span>
                                                </div>
                                                <input type="date" name="purchase_date" class="form-control" value="<?php echo date("Y-m-d")?>"
                                                >
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <h6>Bill/Memo Number</h6>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-receipt"></i></span>
                                                </div>
                                                <input type="text" name="invoice_number" class="form-control"
                                                       value="<?php echo 'INV'. mt_rand(1000,9999).mt_rand(2000,9999) ?>" required>
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <h6>Payment Method</h6>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="fas fa-receipt"></i></span>
                                                </div>
                                                <select class="form-control select2" name="payment_method" id="inputPaymentMethod">
                                                    <option value="CASH">CASH</option>
                                                    <option value="BANK">BANK</option>
                                                    <option value="CARD">CARD</option>
                                                    <option value="BKASH">BKASH</option>
                                                    <option value="NAGAD">NAGAD</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-info">
                                        <div class="card-header align-content-center">
                                            <h3 class="card-title align-content-center">Purchase Invoice Items</h3>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-bordered table-hover" id="invoiceItem">
                                                <tr>

                                                    <th style="background: #ECF0F5" width="2%"><input
                                                                id="checkAll" class="formcontrol"
                                                                type="checkbox"></th>


                                                    <th style="background: #ECF0F5" width="38%">Item Name</th>
                                                    <th style="background: #ECF0F5" width="15%">Quantity</th>
                                                    <th style="background: #ECF0F5" width="15%">Rate (Tk)</th>
                                                    <th style="background: #ECF0F5" width="15%">Total (Tk)</th>
                                                    <th style="background: #ECF0F5" width="15%">Delete</th>
                                                </tr>
                                                <tbody id="tb">


                                                <tr>
                                                    <td><input class="itemRow" type="checkbox"></td>

                                                    <td><select class="form-control select2" name="productId[]"
                                                                id="productId_1">


                                                            <?php


                                                            $result = mysqli_query($con, "SELECT * FROM products");
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";

                                                            }
                                                            echo "</select>";

                                                            ?>

                                                    </td>

                                                    <td><input type="number" name="quantity[]" id="quantity_1"
                                                               class="form-control quantity" placeholder="0"
                                                               autocomplete="off">
                                                    </td>
                                                    <td><input type="number" name="price[]" id="price_1"
                                                               class="form-control price" placeholder="0"
                                                               autocomplete="off">
                                                    </td>
                                                    <td><input type="number" name="total[]" id="total_1"
                                                               class="form-control total" placeholder="0"
                                                               autocomplete="off"
                                                               readonly>
                                                    </td>

                                                    <td align="center" class="text-danger">
                                                        <button type="button" data-toggle="tooltip"
                                                                data-placement="right" title="Click To Remove"
                                                                onclick="if(confirm('Are you sure to remove?')){$(this).closest('tr').remove();}"
                                                                class="btn btn-danger"><i
                                                                    class="fa fa-fw fa-trash-alt"></i></button>
                                                    </td>

                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <button class="btn btn-danger delete" id="removeRows" type="button"><i class='fas fa-minus-circle'></i>
                                            Delete
                                        </button>
                                        <button class="btn btn-success" id="addmore" type="button"> <i class='fas fa-plus-circle'></i> Add More
                                        </button>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <h3>Notes </h3>
                                        <div class="form-group">
                                                    <textarea class="form-control txt" rows="5" name="notes" id="notes"
                                                              placeholder="Your Notes"></textarea>
                                        </div>


                                    </div>


                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">

                        <table class="table table-bordered">

                            <tr>
                                <td>

                                    <label>Sub Total&nbsp;</label>

                                </td>

                                <td>
                                    <div class="input-group">

								<input value="" type="number" class="form-control" name="subTotal" id="subTotal"
                                       placeholder="Subtotal" readonly>
							</div>
                                </td>

                            </tr>


                              <tr>
                                <td>

                                   <label>Tax Rate&nbsp;</label>

                                </td>

                                <td>
                                    	<div class="input-group">
								<input value="" type="number" class="form-control" name="taxRate" id="taxRate"
                                       placeholder="Tax Rate">
								<div class="input-group-addon"> %</div>

							</div>
                                </td>

                            </tr>




                            <tr>
                                <td>

                                  <label>Tax Amount&nbsp;</label>

                                </td>

                                <td>
                                    	<div class="input-group">
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount"
                                       placeholder="Tax Amount" readonly>

							</div>
                                </td>

                            </tr>




                              <tr>
                                <td>

                                  <label>Total </label>

                                </td>

                                <td>
                                    	<div class="input-group">
								<input value="" type="number" class="form-control" name="totalAftertax"
                                       id="totalAftertax" placeholder="Total" readonly>

							</div>
                                </td>

                            </tr>




                              <tr>
                                <td>

                                 <label>Amount Paid</label>

                                </td>

                                <td>
                                    	<div class="input-group">
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid"
                                       placeholder="Amount Paid">

							</div>
                                </td>

                            </tr>




                              <tr>
                                <td>

                                	<label>Amount Due</label>

                                </td>

                                <td>
                                    	<div class="input-group">
									<input value="" type="number" class="form-control" name="amountDue" id="amountDue"
                                           placeholder="Amount Due" readonly>

							</div>
                                </td>

                            </tr>


                            <tr>

                                <td colspan="2">


                                     <div class="col-md-12 bg-light text-center">
                                            <input type="hidden" value="<?php echo $_SESSION['user_name']; ?>"
                                                   class="form-control" name="user_name">
                                            <input data-loading-text="Saving Invoice..." type="submit"
                                                   name="invoice_btn" value="Save Invoice"
                                                   class="btn btn-success btn-lg submit_btn invoice-save-btm">
                                        </div>
                                </td>
                            </tr>



                        </table>



					</span>
                                    </div>
                                </div>


                            </div>
                    </div>
                    <!-- /.card-body -->
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
<script src="js/purchase_invoice.js"></script>
<script type="text/javascript">

    $(document).on('click', '#invoice_btn', function (e) {


        $('#quickForm').validate({
            rules: {

                customer_name: {
                    required: true
                },
                customer_email: {
                    required: true,
                    email: true,
                },
                customer_phone: {
                    required: true
                },
                customer_address: {
                    required: true
                },


            },
            messages: {
                customer_name: {
                    required: "Please enter customer name"
                },
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                customer_phone: {
                    required: "Please enter customer phone number"
                },
                customer_address: {
                    required: "Please enter customer address"
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


<script type="text/javascript">

    var count = 1;
    $(document).ready(function (e) {
        $("#addmore").on("click", function () {
            count++;
            $.ajax({
                type: 'POST',
                url: 'action-form.ajax.php',
                data: {
                    'action': 'addDataRow',
                    'count': count
                },
                success: function (data) {
                    $('#tb').append(data);
                }
            });
        });
    });


</script>

<script type="text/javascript">

    $(document).on('click', '#invoice_btn', function (e) {
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
