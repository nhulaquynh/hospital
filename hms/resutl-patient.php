<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hồ SƠ BỆNH ÁN</title>
    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
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

<body  onload="startTime()">
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <div class=row>
                    <div class="col-sm-8">
                            <h1 class="mainTitle">Hồ sơ bệnh án</h1>
                        </div>
                    <div class="col-sm-4">
								
                                <div id="clockdate">
                                    <div style="margin-top:20px" class="clockdate-wrapper">
                                        <div id="clock"></div>
                                        <div id="date"><?php echo date('l, F j, Y'); ?></div>
                                    </div>
                                </div>
                                        
                    </div>
                    </div>
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div style="margin-top:-10px" class="row">                              
                                <?php  
                                    $ret=mysqli_query($con,"select appointment.Name as patientname,doctors.doctorName as docname, 
                                    tblmedicalhistory.* 
                                    from tblmedicalhistory join doctors on doctors.id=tblmedicalhistory.Docid
                                    join appointment on appointment.doctorId=doctors.id 
                                    join users on users.id=appointment.userId 
                                    where appointment.id=tblmedicalhistory.PatientID 
                                    and userId='".$_SESSION['id']."'");
                                    $cnt=1;
                                ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tr align="center">
                                        <th colspan="12">Thông tin bệnh án</th>
                                    </tr>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên bệnh nhân</th>
                                        <th>Tên bác sĩ đều trị</th>
                                        <th>Glu (Glucose): Đường trong máu</th>
                                        <th>Số lượng hồng cầu (RBC)</th>
                                        <th>Số lượng bạch cầu</th>
                                        <th>Bạch cầu trung tính</th>
                                        <th>Lời nhắc của bác sĩ</th>
                                        <th>Ngày cập nhật</th>
                                        <th>Thời gian cập nhật</th>
                                    </tr>
                                    <?php  
                                        while ($row=mysqli_fetch_array($ret)) { 
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php  echo $row['patientname'];?></td>
                                        <td><?php  echo $row['docname'];?></td>
                                        <td><?php  echo $row['BloodPressure'];?></td>
                                        <td><?php  echo $row['Weight'];?></td>
                                        <td><?php  echo $row['BloodSugar'];?></td>
                                        <td><?php  echo $row['Temperature'];?></td>
                                        <td><?php  echo $row['MedicalPres'];?></td>
                                        <td><?php  echo $row['CreationDate'];?></td>
                                        <td><?php  echo $row['CreationTime'];?></td>
                                    </tr>
                                    <?php $cnt=$cnt+1;} ?>
                                </table>                                                                                          
                            </div>
                        </div>
                    </section>
                </div>
                <!-- start: FOOTER -->
                <?php include('include/footer.php');?>
                <!-- end: FOOTER -->

                <!-- start: SETTINGS -->
                <?php include('include/setting.php');?>

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