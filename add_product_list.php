<?php
session_start();
if (isset($_SESSION['email']))
    echo " ";
else
    header("location:../index.php");
?>


<!doctype html>
<html lang="en">
<head>

    <style>
        .error {
            font-family: sans-serif;
            font-style: italic;
            color: #FF0000;
        }

        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(images/loader-64x/Preloader_2.gif) center no-repeat #fff;
        }

        #my_button {
            display: inline-block;
            width: 200px;
            height: 50px;
            margin: 2px;
        }

    </style>


    <title>Add Products</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
            ;
        });
    </script>

    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css" type="text/css"/>

    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Add Product</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>

</head>
<body>

<!-- <div class="se-pre-con"></div> <!--For preloader-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Admin Panel
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li>
                    <a href="view_brand_list.php">
                        <i class="pe-7s-plus"></i>
                        <p>View Brands</p>
                    </a>
                </li>


                <li class="active">
                    <a href="view_product_list.php">
                        <i class="pe-7s-plus"></i>
                        <p>View Products</p>
                    </a>
                </li>


                <li>
                    <a href="view_payment_list.php">
                        <i class="pe-7s-plus"></i>
                        <p>View Payment</p>
                    </a>
                </li>


                <li>
                    <a href="report.php">
                        <i class="pe-7s-plus"></i>
                        <p>View Report</p>
                    </a>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="pe-7s-power"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Add Products</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">

                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <div class="form-group">
            <form name="add_name" id="add_name">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">


                        <tr>
                            <div class="col-xs-2">

                                <td><label>Date</label><input type="date" name="date" placeholder="Date" class="form-control name_list"/>
                                </td>

                                <td><level>Invoice Number</level><input type="text" name="invoice" placeholder="Invoice"
                                           class="form-control name_list" required/>
                                </td>

                                <td class="col-xs-4"><label>Brand Name</label>
                                    <select class="form-control name_list" name="brand" required id="brand">
                                        <option value="Not Selected">Select Brand</option>
                                        <?php
                                        include('db_connect.php');

                                        $result = mysqli_query($con, "SELECT * FROM brands");
                                        //sort($result);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";

                                        }
                                        echo "</select>";

                                        ?>

                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="col-xs-4">

                                <td><label>Model</label><input type="text" name="model[]" placeholder="Model"
                                           class="form-control name_list"/></td>
                                <td class="col-xs-4"><label>Qty</label><input type="number" name="qty[]" placeholder="Qty" class="form-control name_list"/>
                                </td>
                                <td class="col-xs-4"><label>Rate</label><input type="number" name="rate[]" placeholder="Rate"
                                           class="form-control name_list"/></td>

                                <td>


                                </td>
                                <td>
                                    <button type="button" name="add" id="add" class="btn btn-success btn-fill pull-left">
                                        +
                                    </button>
                                </td>


                            </div>
                        </tr>


                    </table>
                    <input type="button" name="submit" id="submit" class="btn btn-info btn-fill pull-left"
                           value="Submit"/>
                </div>
            </form>
        </div>


        <script type="text/javascript">

            $(document).on('click', '#btn_submit', function (e) {
                e.preventDefault();
                swal({
                    title: "ARE YOU SURE ?",
                    text: "Want to add new Product ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "YES",
                    cancelButtonText: "NO",
                    closeOnConfirm: false,
                    closeOnCancel: false

                }).then(function (e) {
                    $('#student_info_form').submit();
                });
            });


        </script>


    </div>
</div>

<script>
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>


</body>


<!--  Checkbox, Radio & Switch Plugins -->

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>


</html>


<script>
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="model[]" placeholder="Model" class="form-control name_list" /></td><td><input type="number" name="qty[]" placeholder="Qty" class="form-control name_list" /></td><td><input type="number" name="rate[]" placeholder="Rate" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-fill pull-left btn_remove">X</button></td><td>  <button type="button" name="add" id="add" class="btn btn-success btn-fill pull-left btn_add">+</button> </td>  </tr>');
        });
        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $(document).on('click', '.btn_add', function () {
            var button_id = $(this).attr("id");
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="model[]" placeholder="Model" class="form-control name_list" /></td><td><input type="number" name="qty[]" placeholder="Qty" class="form-control name_list" /></td><td><input type="number" name="rate[]" placeholder="Rate" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-fill pull-left btn_remove">X</button></td><td>  <button type="button" name="add" id="add" class="btn btn-success btn-fill pull-left btn_add">+</button> </td>  </tr>');

        });


        $('#submit').click(function () {
            $.ajax({
                url: "name.php",
                method: "POST",
                data: $('#add_name').serialize(),
                success: function (data) {
                    alert(data);
                    $('#add_name')[0].reset();
                    window.open('view_product_list.php','_self');
                }
            });
        });
    });
</script>
   