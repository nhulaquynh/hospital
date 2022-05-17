<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['cancel']))
	{
		mysqli_query($con,"update appointment set doctorStatus='0' where id ='".$_GET['id']."'");
		$_SESSION['msg']="Appointment canceled !!";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TÌM KIẾM BỆNH NHÂN</title>

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
                                <h1 class="mainTitle">Tìm kiếm bệnh nhân</h1>
                            </div>

                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post" name="search">

                                    <div class="form-group">
                                        <label for="doctorname">
                                            Tìm kiếm theo tên bệnh nhân
                                        </label>
                                        <input type="text" name="searchdata" id="searchdata" class="form-control"
                                            value="" required='true'>
                                    </div>

                                    <button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
                                        Search
                                    </button>
                                </form>
                                <?php
                                if(isset($_POST['search']))
                                { 
                                $sdata=$_POST['searchdata'];
                                ?>
                                <h4 align="center">Kết quả từ khóa <i>"<?php echo $sdata;?>"</i></h4>

                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">STT</th>
                                            <th>Tên Bệnh Nhân</th>
                                            <th>Số điện thoại</th>
                                            <th>Giới tính</th>
                                            <th>Email</th>
                                            <th>CMND / CCCD</th>
                                            <th>Địa chỉ thường trú</th>
                                            <th>Trạng thái</th>
                                            <th>Mã QR code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql=mysqli_query($con,"select * from appointment where Name like '%$sdata%'");
$num=mysqli_num_rows($sql);
if($num>0){
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td class="hidden-xs"><?php echo $row['Name'];?></td>
                                            <td><?php echo $row['Numberphone'];?></td>
                                            <td><?php echo $row['Gender'];?></td>
                                            <td><?php echo $row['Email'];?></td>
                                            <td><?php echo $row['CMND'];?></td>
                                            <td><?php echo $row['Address']?></td>
                                            <td>
                                            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														{
															echo ('<p style="color:#339cff">Đang theo dõi</p>');
														}
														if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
														{
															echo ('<p style="color:red">Đã hủy !</p>');
														}												
											?>
                                            </td> 
                                            <td>
                                                <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) {
                                                    echo ('<img src = ../temp/'.$row['Images'].'.png style="with:100x; height:100px;"> <br>

                                                    ');
                                                        //echo '<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file= echo '.$filename.'.png ">Download QR Code</a>';

                                                    }
                                                ?>
                                            </td>                                       
                                        </tr>
                                        <?php 
$cnt=$cnt+1;
} } else { ?>
                                        <tr>
                                            <td colspan="8">Không có kết quả !</td>

                                        </tr>

                                        <?php }} ?>
                                    </tbody>
                                </table>
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