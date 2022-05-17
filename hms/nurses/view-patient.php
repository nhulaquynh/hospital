
<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    $docid=$_SESSION['id'];  
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
    $pres=$_POST['pres'];
    $query.=mysqli_query($con,"insert into tblmedicalhistory(Docid,PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$docid','$vid','$bp','$bs','$weight','$temp','$pres')");
    // if($query)
    // {
    //     echo '<script>alert("Cập nhật hồ sơ bệnh án thành công.")</script>';
    //     echo "<script>window.location.href ='manage-patient.php'</script>";
    // }
    // else
    // {
    //   echo '<script>alert("Thao tác không thành công, Xin vui lòng thử lại !")</script>';
    // }
}
?>
<!-- GỬI EMAIL KHI CẬP NHẬT BỆNH ÁN CHO BỆNH NHÂN THÀNH CÔNG! -->
<?php
	// include "PHPMailer-master/src/PHPMailer.php";
	// include "PHPMailer-master/src/Exception.php";
	// include "PHPMailer-master/src/OAuth.php";
	// include "PHPMailer-master/src/POP3.php";
	// include "PHPMailer-master/src/SMTP.php";
	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;
	// if(isset($_POST['submit'])){
    //     $sql=mysqli_query($con,"select appointment.Name as patientname,doctors.doctorName as docname, 
    //     tblmedicalhistory.* 
    //     from tblmedicalhistory join doctors on doctors.id=tblmedicalhistory.Docid
    //     join appointment on appointment.doctorId=doctors.id 
    //     join users on users.id=appointment.userId 
    //     ");
	// 	$mail = new PHPMailer();
	// 	$mail -> CharSet ='utf8';
	// 	try {
	// 		//Server settings
	// 		$mail->SMTPDebug = 0;                                 // Enable verbose debug output
	// 		$mail->isSMTP();                                      // Set mailer to use SMTP
	// 		$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
	// 		$mail->SMTPAuth = true;                               // Enable SMTP authentication
	// 		$mail->Username = 'vobaquan0147@gmail.com';                 // SMTP username
	// 		$mail->Password = 'ylwvjlgnefkadkql';                           // SMTP password
	// 		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	// 		$mail->Port = 587;                                    // TCP port to connect to
		 
	// 		//Recipients
	// 		$mail->setFrom($_POST['']);
	// 		$mail->addAddress($_POST['email']);     // Add a recipient
	// 		//$mail->addAddress('ellen@example.com');               // Name is optional
	// 		// $mail->addReplyTo('info@example.com', 'Information');
	// 		//$mail->addCC('vobaquan0147@gmail.com');
	// 		// $mail->addBCC('bcc@example.com');
		 
	// 		//Attachments
	// 		 $mail->addAttachment('welcome.jpg');         // Add attachments
	// 		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		 
	// 		//Content
	// 		$mail->isHTML(true);                                  // Set email format to HTML
	// 		$mail->Subject = 'Đăng ký thành công tài khoản bệnh biện Á -Âu ';
	// 		$mail->Body    = "<h3>Bạn đã đăng ký thành công tài khoản. Giờ đây bạn có thể đăng nhập để kiểm tra tài khoản và đăng ký thăm khám tại bệnh viện Á-Âu</h3>
	// 						  <a href='https://hmshospital.tk/hms/user-login.php'>Đăng nhập ngay!</a> 
	// 						  ";
	// 		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		 
	// 		$mail->send();
	// 		echo "<script>alert('Đăng ký thành công, bạn có thể đăng nhập ngay !');</script>";
	// 		//header('location:user-login.php');
	// 	} catch (Exception $e) {
	// 		echo 'Có lỗi xảy ra vui lòng thử lại !', $mail->ErrorInfo;
	// 	}
	// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Manage Patients</title>
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
</head>

<body>
    
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">
            <?php include('include/header.php');?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Quản lý bệnh nhân </h1> 
                            </div>                           
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="over-title margin-bottom-15"><span class="text-bold">Quản lý bệnh án</span>
                                </h5>
                                <?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from appointment where id='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
                                <table border="1" class="table table-bordered">
                                    <tr align="center">
                                        <td colspan="4" style="font-size:20px;color:blue">
                                            Thông tin bệnh nhân</td>
                                    </tr>
                                    <tr>
                                        <th scope>Họ và tên</th>
                                        <td><?php  echo $row['Name'];?></td>
                                        <th scope>Email</th>
                                        <td><?php  echo $row['Email'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope>Số điện thoại</th>
                                        <td><?php  echo $row['Numberphone'];?></td>
                                        <th>Địa chỉ</th>
                                        <td><?php  echo $row['Address'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Giới tính</th>
                                        <td><?php  echo $row['Gender'];?></td>
                                        <th>Tuổi</th>
                                        <td><?php  echo $row['Dob'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Tình trạng ban đầu (nếu có)</th>
                                        <td><?php  echo $row['Medhis'];?></td>
                                        <th>Ngày tạo</th>
                                        <td><?php  echo $row['appointmentDate'];?></td>
                                    </tr>
                                    <?php }?>
                                </table>
                                <?php  
                                    $ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");
                                ?>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <tr align="center">
                                        <th colspan="8">Tình trạng bệnh nhân</th>
                                    </tr>
                                    <tr>
                                        <th>STT</th>
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

                                <p align="center">
                                    <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal"
                                        data-target="#myModal">Cập nhật hồ sơ bệnh nhân</button>
                                </p>

                                <?php  ?>
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật tình trạng bệnh nhân</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                                    <form method="post" name="submit">
                                                        <!-- <tr>
                                                            <th>Tên bác sĩ :</th>
                                                            <td>
                                                                <input name="doctorname" placeholder="Tên bác sĩ điều trị"
                                                                class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tên bệnh nhân :</th>
                                                            <td>
                                                                <input name="patientname" placeholder="Tên bệnh nhân điều trị"
                                                                class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr> -->
                                                        <tr>
                                                            <th>Glu (Glucose): Đường trong máu :</th>
                                                            <td>
                                                                <input name="bp" placeholder="Glu (Glucose)"
                                                                class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Số lượng hồng cầu (RBC) :</th>
                                                            <td>
                                                                <input name="bs" placeholder="RBC"
                                                                    class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Số lượng bạch cầu :</th>
                                                            <td>
                                                                <input name="weight" placeholder="Số lượng bạch cầu"
                                                                    class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Bạch cầu trung tính :</th>
                                                            <td>
                                                                <input name="temp" placeholder="Bạch cầu trung tính"
                                                                    class="form-control wd-450" required="true">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Mô tả :</th>
                                                            <td>
                                                                <textarea name="pres" placeholder="Thêm nhắc nhở"
                                                                    rows="8" cols="8" class="form-control wd-450"
                                                                    required="true"></textarea>
                                                            </td>
                                                        </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary">Cập nhật</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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