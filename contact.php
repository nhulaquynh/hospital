<?php
include_once('hms/include/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$dscrption=$_POST['description'];
$query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
}
?>
<!-- gửi email về cho bệnh viện -->
<?php
	include "PHPMailer-master/src/PHPMailer.php";
	include "PHPMailer-master/src/Exception.php";
	include "PHPMailer-master/src/OAuth.php";
	include "PHPMailer-master/src/POP3.php";
	include "PHPMailer-master/src/SMTP.php";
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	if(isset($_POST['submit'])){		
		$mail = new PHPMailer();
		$mail -> CharSet ='utf8';
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
			$mail->setFrom = $_POST['emailid'];
			$mail->addAddress('vobaquan0147@gmail.com');     // Add a recipient
			//$mail->addAddress('ellen@example.com');               // Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('vobaquan0147@gmail.com');
			//$mail->addBCC('bcc@example.com');
		 
			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		 
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Thông tin liên hệ HMS ';
			$mail->Body    = $_POST['description'];
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		 
			$mail->send();
			echo "<script>alert('Gửi thông tin liên hệ thành công !');</script>";
		} catch (Exception $e) {
			echo 'Có lỗi xảy ra vui lòng thử lại !', $mail->ErrorInfo;
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>AAP - LIỆN HỆ</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<!--start-wrap-->
		
			<!--start-header-->
			<div class="header">
				<div class="wrap">
				<!--start-logo-->
				<div class="logo">
		<a href="index.html" style="font-size: 30px;">BỆNH VIỆN Á - ÂU</a> 
				</div>
				<!--end-logo-->
				<!--start-top-nav-->
				<div class="top-nav">
					<ul>
						<li><a href="index.html">TRANG CHỦ</a></li>					
						<!-- <li class="active"><a href="contact.php">LIÊN HỆ</a></li> -->
						<li><a href="hms/user-login.php">ĐĂNG NHẬP</a></li>
					</ul>					
				</div>
				<div class="clear"> </div>
				<!--end-top-nav-->
			</div>
			<!--end-header-->
		</div>
		    <div class="clear"> </div>
		   <div class="wrap">
		   	<div class="contact">
		   	<div class="section group">				
				<div class="col span_1_of_3">
					
      			<div class="company_address">
				     	<h2>ĐỊA CHỈ :</h2>
						    	<p>118/16/40, Huỳnh Thiện Lộc</p>
						   		<p>Phường Hòa Thạnh, Tân Phú</p>
						   		<p>Hồ Chí Minh</p>
				   		<p>Phone:(84) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>vobaquan0147@gmail.com</span></p>				   	
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>THÔNG TIN LIÊN HỆ</h2>
					    <form name="contactus" method="post">
					    	<div>
						    	<span><label>HỌ VÀ TÊN LIÊN HỆ</label></span>
						    	<span><input type="text" name="fullname" required="true" value=""></span>
						    </div>
							<!-- <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="email" name="emailid" required="ture" value="vobaquan0147@gmail.com"></span>
						    </div> -->
						    <div>
						    	<span><label>E-MAIL LIÊN HỆ</label></span>
						    	<span><input type="text" name="emailid" required="ture" value=""></span>
						    </div>
						    <div>
						     	<span><label>SỐ ĐIỆN THOẠI</label></span>
						    	<span><input type="text" name="mobileno" required="true" value=""></span>
						    </div>
						    <div>
						    	<span><label>MÔ TẢ</label></span>
						    	<span><textarea name="description" required="true"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" name="submit" value="LIÊN HỆ NGAY"></span>
						  </div>
					    </form>
				    </div>
  				</div>				
			  </div>
			  	 <div class="clear"> </div>
	</div>
	<div class="clear"> </div>
			</div>
	      <div class="clear"> </div>
		   <div class="footer">
		   	 <div class="wrap">
		   	<div class="footer-left">
		   			<ul>
						<li><a href="index.html">TRANG CHỦ</a></li>
						
						<li><a href="contact.php">LIÊN HỆ</a></li>
					</ul>
		   	</div>
		  
		   	<div class="clear"> </div>
		   </div>
		   </div>
		<!--end-wrap-->
	</body>
</html>

