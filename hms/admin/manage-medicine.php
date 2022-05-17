<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['del'])) {
    // var_dump( $_GET['id']);
    // exit();
    mysqli_query($con, "DELETE FROM medicine WHERE id_med = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "Đã xóa dữ liệu khỏi hệ thống !!";
}

if (isset($_POST['submit'])) {
    $medName = $_POST['medName'];
    $note = $_POST['note'];
    $pharmacy_Qty = $_POST['pharmacy_Qty'];
    $exp_date = $_POST['exp_date'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $instruct = $_POST['instruct'];
    $data = [$medName, $pharmacy_Qty, $exp_date, $price, $unit, $note, $instruct];

    $sql = mysqli_query($con, "INSERT INTO medicine (medName, note, pharmacy_Qty, exp_date, price, instruct, unit) VALUES ('$medName', '$note', '$pharmacy_Qty', '$exp_date', '$price', '$instruct', '$unit')");
    // var_dump($data);
    // exit();
    if ($sql) {
        echo "<script>alert('Thêm mới thuốc thành công!');</script>";
        header("Location: manage-medicine.php");
    } else {
        // var_dump($sql);
        // exit();
    }
}

if(isset($_POST['update'])){
    $medName = $_POST['medName'];
    $note = $_POST['note'];
    $pharmacy_Qty = $_POST['pharmacy_Qty'];
    $exp_date = $_POST['exp_date'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $instruct = $_POST['instruct'];
    
    $update = mysqli_query($con, "UPDATE medicine SET medName = '$medName', note = '$note', pharmacy_Qty = '$pharmacy_Qty', exp_date = '$pharmacy_Qty', exp_date = '$exp_date', price = '$price', unit = '$unit', instruct = '$instruct' ");
    if($update){
        $_SESSION['msg'] = 'Cập nhật thành công!';
        header("Location: manage-medicine.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Manage Medicines</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

    <script>
        function checkmed() {
            $("#loaderIcon").show();
            var medName = $("#addMed").val();
            var pharmacy_Qty = $("#pharmacy_Qty").val();

            $.ajax({
                url: "include/check_med.php",
                data: {
                    medName: medName,
                    pharmacy_Qty: pharmacy_Qty
                },
                type: "POST",
                success: function(data) {
                    $("#medicine-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">

            <?php include('include/header.php'); ?>

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Quản lý thuốc</h1>
                            </div>

                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                    <p style="color:red;">
                        <?php
                            echo htmlentities($_SESSION['msg']);
                        ?>
                        <?php 
                            echo htmlentities($_SESSION['msg'] = "");
                        ?>
                    </p>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="over-title margin-bottom-15"> <span class="text-bold">Quản lý thuốc</span></h5>
                            </div>

                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right">
                                    Thêm thuốc
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="background-color: white">
                                            <form role="form" method="post" action="manage-medicine.php">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm thuốc</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationServer01">Tên thuốc</label>
                                                                    <input type="text" class="form-control" id="addMed" name="medName" required onBlur="checkmed()">
                                                                    <span id="medicine-availability-status"></span>

                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="validationServer02">Đơn vị tính</label>
                                                                    <input type="text" class="form-control" name="unit" required>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <label for="validationServer02">Giá tiền</label>
                                                                    <input type="text" class="form-control" name="price" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-6 mb-3  margin-top-10">
                                                                    <label for="validationServerUsername">Nhà sản xuất</label>
                                                                    <input type="text" class="form-control" id="pharmacy_Qty" name="pharmacy_Qty" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3 margin-top-10">
                                                                    <label for="validationServer02">Ngày hết hạn</label>
                                                                    <input class="form-control datepicker" name="exp_date" required="required">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-6 mb-3  margin-top-10">
                                                                    <label for="validationServerUsername">Chỉ định</label>
                                                                    <input type="text" class="form-control" name="note" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3 margin-top-10">
                                                                    <label for="validationServer02">Liều lượng dùng</label>
                                                                    <input type="text" class="form-control" name="instruct" required="required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">STT</th>
                                            <th>Thuốc</th>
                                            <th class="hidden-xs">Đơn vị tính</th>
                                            <th>Hướng dẫn</th>
                                            <th>Liều lượng dùng (Tham khảo)</th>
                                            <th>Ngày hết hạn</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM medicine");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>

                                            <tr>
                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                <td class="hidden-xs"><?php echo $row['medName']; ?></td>
                                                <td><?php echo $row['unit']; ?></td>
                                                <td><?php echo $row['note']; ?></td>
                                                <td><?php echo $row['instruct']; ?></td>
                                                <td><?php echo $row['exp_date']; ?></td>
                                                </td>
                                                <td>
                                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-md<?php echo $row['id_med'] ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i>
                                                        </button>
                                                        <!-- MODAL SỬA -->
                                                        <div class="modal fade" id="modal-md<?php echo $row['id_med'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-md" role="document">
                                                                <div class="modal-content">
                                                                    <div class="card card-default">
                                                                        <div class="modal-header" style="background-color: #f39c12">
                                                                            <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fa fa-edit"></i>&nbsp;CẬP NHẬT THÔNG TIN THUỐC: <?php echo $row['medName'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="manage-medicine.php" method="POST">
                                                                            <div class="modal-body">
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="validationServer01">Tên thuốc</label>
                                                                                        <input type="text" class="form-control" id="addMed" name="medName" required onBlur="checkmed()" value="<?php echo $row['medName']?>">
                                                                                    </div>
                                                                                    <div class="col-md-3 mb-3">
                                                                                        <label for="validationServer02">Đơn vị tính</label>
                                                                                        <input type="text" class="form-control" name="unit" value="<?php echo $row['unit']?>" required>
                                                                                    </div>

                                                                                    <div class="col-md-3 mb-3">
                                                                                        <label for="validationServer02">Giá tiền</label>
                                                                                        <input type="text" class="form-control" name="price" value="<?php echo $row['price']?>" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <div class="col-md-6 mb-3  margin-top-10">
                                                                                        <label for="validationServerUsername">Nhà sản xuất</label>
                                                                                        <input type="text" class="form-control" id="pharmacy_Qty" name="pharmacy_Qty" value="<?php echo $row['pharmacy_Qty']?>" required>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3 margin-top-10">
                                                                                        <label for="validationServer02">Ngày hết hạn</label>
                                                                                        <input class="form-control datepicker" name="exp_date" value="<?php echo $row['exp_date']?>" required="required">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <div class="col-md-6 mb-3  margin-top-10">
                                                                                        <label for="validationServerUsername">Chỉ định</label>
                                                                                        <input type="text" class="form-control" name="note" value="<?php echo $row['note']?>" required>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3 margin-top-10">
                                                                                        <label for="validationServer02">Liều lượng dùng</label>
                                                                                        <input type="text" class="form-control" name="instruct" value="<?php echo $row['instruct']?>" required="required">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="reset" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                                                                <button type="submit" class="btn btn-success" name="update">Lưu lại</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <a href="manage-medicine.php?id=<?php echo $row['id_med'] ?>&del=delete" onClick="return confirm('Xóa thuốc này khỏi hệ thống?')" class="btn btn-transparent btn-xs " tooltip-placement="top" tooltip="Remove">
                                                        <button class="btn btn-danger btn-xs ml-1" title="Xóa vĩnh viễn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </a>
                                                    </div>

                                                </td>
                                            </tr>

                                        <?php
                                            $cnt = $cnt + 1;
                                        } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: BASIC EXAMPLE -->
            <!-- end: SELECT BOXES -->

        </div>
    </div>
    </div>
    <!-- start: FOOTER -->
    <?php include('include/footer.php'); ?>
    <!-- end: FOOTER -->

    <!-- start: SETTINGS -->
    <?php include('include/setting.php'); ?>

    <!-- end: SETTINGS -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>