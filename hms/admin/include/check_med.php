<?php 
require_once("config.php");
if(!empty($_POST["pharmacy_Qty"])) {
    // var_dump($pharmacy_Qty);
    // exit();
	$medName= $_POST["medName"];
	$pharmacy_Qty = $_POST["pharmacy_Qty"];
    $result =mysqli_query($con,"SELECT * FROM medicine WHERE medName='$medName' AND pharmacy_Qty='$pharmacy_Qty'");
    $count=mysqli_num_rows($result);
    var_dump($pharmacy_Qty);
    exit();
    if($count > 0 )
{
    echo "<span style='color:red'> Thuốc này đã tồn tại ! .</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
}else{
	echo "<span style='color:green'> Email hợp lệ ! .</span>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
