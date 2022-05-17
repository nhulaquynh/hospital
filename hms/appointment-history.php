<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_GET['cancel'])) {
    mysqli_query($con, "update appointment set userStatus='0' where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "Hủy thành công !!";
}
if (isset($_GET['del'])) {
    mysqli_query($con, "delete from appointment where id = '" . $_GET['id'] . "'");
    $_SESSION['msg'] = "data deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>LỊCH SỬ CUỘC HẸN</title>
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
    <script src="timejs/navbarclock.js"></script>
    <link rel="stylesheet" href="timejs/style.css">
</head>

<body onload="startTime()">
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
                                <h1 class="mainTitle">LỊCH SỬ KHÁM BỆNH</h1>
                            </div>
                            <div class="col-sm-4">

                                <div id="clockdate">
                                    <div class="clockdate-wrapper">
                                        <div id="clock"></div>
                                        <div id="date"><?php echo date('l, F j, Y'); ?></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">


                        <div class="row">
                            <div class="col-md-12">

                                <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">STT</th>
                                            <th class="hidden-xs">Tên bác sĩ điều trị</th>
                                            <th>Tên bệnh nhân</th>
                                            <th>Phí khám</th>
                                            <th>Ngày / Giờ</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                            <th>Mã QR code</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // var_dump($_SESSION['id']);
                                        $sql = mysqli_query($con, "SELECT doctors.doctorName AS docname,appointment.*  FROM appointment JOIN doctors ON doctors.id_doctor=appointment.doctorId WHERE appointment.userId=' " . $_SESSION['id'] . " ' ORDER BY appointment.id DESC ");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>

                                            <tr>
                                                <td class="center"><?php echo $cnt; ?>.</td>
                                                <td class="hidden-xs"><?php echo $row['docname']; ?></td>
                                                <td><?php echo $row['Name']; ?></td>
                                                <td><?php echo $row['consultancyFees']; ?>.000 VNĐ</td>
                                                <td><?php echo date('d/m/Y', strtotime($row['appointmentDate'])); ?> / <?php echo
                                                                                            $row['appointmentTime']; ?>
                                                </td>

                                                <td>
                                                    <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 2)) {
                                                        echo ('<p  class="label label-warning">Đang chờ duyệt</p>');
                                                    }
                                                    if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 0)) {
                                                        echo ('<p  class="label label-danger">Phòng khám đã hủy lịch hẹn của bạn</p>');
                                                    }
                                                    if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                        echo ('<p  class="label label-success">Thành công!</p>');
                                                    }
                                                    if (($row['userStatus'] == 0)) {
                                                        echo ('<p  class="label label-default">Bạn đã hủy lịch hẹn</p>');
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php if ( ( ($row['userStatus'] == 1) && ($row['doctorStatus'] == 1) ) || ( ( $row['userStatus'] == 1) && ($row['doctorStatus'] == 2) ) )  { ?>
                                                    <a href="appointment-history.php?id=<?php echo $row['id'] ?>&cancel=update" onClick="return confirm('Bạn có muốn hủy lịch đã đăng ký hông ?')" class="nav-link text-danger" title="Hủy" tooltip-placement="top" tooltip="Remove"><i class="fa fa-close"></i></a>
                                                    <a href="edit-booking.php?id=<?php echo $row['id'] ?>" class="nav-link"><i class="fa fa-pencil"></i></a>
                                                    <a href="appointment-history.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Bạn có chắc xóa dữ liệu này?')" class="nav-link text-success" tooltip-placement="top" tooltip="Remove"><i class="fa fa-trash"></i>

                                                    <?php } elseif (($row['userStatus'] == 0)) {?>
                                                    <a href="appointment-history.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Bạn có chắc xóa dữ liệu này?')" class="nav-link text-success" tooltip-placement="top" tooltip="Remove"><i class="fa fa-trash"></i>
                                                    <?php } ?>
                                                </td>

                                                <td>
                                                    <?php if (($row['userStatus'] == 1) && ($row['doctorStatus'] == 1)) {
                                                        echo ('<img src = temp/' . $row['Images'] . '.png style="with:150px; height:150px;"> <br> ');
                                                    }
                                                    ?>
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