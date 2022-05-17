<?php
include_once('include/config.php');
if (isset($_POST['submit'])) {
	$fname = $_POST['full_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$query = mysqli_query($con, "insert into users(fullname,address,city,gender,email,password) values('$fname','$address','$city','$gender','$email','$password')");
	// if($query)
	// {
	// 	echo "<script>alert('Đăng ký thành công, bạn có thể đăng nhập ngay !');</script>";
	// 	header('location:user-login.php');
	// }
}
?>
<!-- gửi thông tin đăng ký khi đăng ký thành công tài khoản -->
<?php
include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
	$mail = new PHPMailer();
	$mail->CharSet = 'utf8';
	try {
		//Server settings
		$mail->SMTPDebug = 0;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'vobaquan0147@gmail.com';                 // SMTP username
		$mail->Password = 'ylwvjlgnefkadkql';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('vobaquan0147@gmail.com');
		$mail->addAddress($_POST['email']);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('vobaquan0147@gmail.com');
		// $mail->addBCC('bcc@example.com');

		//Attachments
		$mail->addAttachment('hms.jpg');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Đăng ký thành công tài khoản bệnh viện Á -Âu ';
		$mail->Body    = "<h3>Bạn đã đăng ký thành công tài khoản. Giờ đây bạn có thể đăng nhập để kiểm tra tài khoản và đăng ký thăm khám tại bệnh viện Á-Âu</h3>
							  <a href='https://hmshospital.tk/hms/user-login.php'>Đăng nhập ngay!</a> 
							  ";
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo "<script>alert('Đăng ký thành công, bạn có thể đăng nhập ngay !');</script>";
		//header('location:user-login.php');
	} catch (Exception $e) {
		echo 'Có lỗi xảy ra vui lòng thử lại !', $mail->ErrorInfo;
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>ĐĂNG KÝ TÀI KHOẢN</title>
	<meta charset="utf-8">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

	<script type="text/javascript">
		function valid() {
			if (document.registration.password.value != document.registration.password_again.value) {
				alert("Nhập lại mật khẩu không chính xác !");
				document.registration.password_again.focus();
				return false;
			}
			return true;
		}
	</script>


</head>

<body class="login">
	<!-- start: REGISTRATION -->
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<a href="../index.html">
					<h2>AAP | ĐĂNG KÝ</h2>
				</a>
			</div>
			<!-- start: REGISTER BOX -->
			<div class="box-register">
				<form name="registration" id="registration" method="post" onSubmit="return valid();">
					<fieldset>
						<legend>
							Đăng ký
						</legend>
						<p>
							Vui lòng nhập thông tin cá nhân :
						</p>
						<div class="form-group">
							<input type="text" class="form-control" name="full_name" placeholder="Họ và tên" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="address" placeholder="Địa chỉ" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="city" placeholder="Thành phố" required>
						</div>
						<div class="form-group">
							<label class="block">
								Giới tính
							</label>
							<div class="clip-radio radio-primary">
								<input type="radio" id="rg-female" name="gender" value="Nữ">
								<label for="rg-female">
									Nữ
								</label>
								<input type="radio" id="rg-male" name="gender" value="Nam">
								<label for="rg-male">
									Nam
								</label>
							</div>
						</div>
						<p>
							Vui lòng nhập thông tin tài khoản :
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="E-mail" required>
								<i class="fa fa-envelope"></i> </span>
							<span id="user-availability-status1" style="font-size:12px;"></span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password_again" name="password_again" placeholder="Nhập lại mật khẩu" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<div class="checkbox clip-check check-primary">
								<input type="checkbox" id="agree" value="agree" checked="true" readonly=" true">
								<label for="agree">
									Đồng ý
								</label>
							</div>
						</div>
						<div class="form-actions">
							<p>
								Bạn đã có tài khoản ?
								<a href="user-login.php">
									Đăng nhập ngay
								</a>
							</p>
							<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
								Đăng ký <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> AAP</span>. <span>All rights reserved</span>
				</div>

			</div>

		</div>
	</div>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/login.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

</body>
<!-- end: BODY -->

</html>