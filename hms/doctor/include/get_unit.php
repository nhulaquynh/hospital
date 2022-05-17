<?php
include('config.php');
if(!empty($_POST["medName"])) 
{

 $sql=mysqli_query($con,"select * from medicine where id_med='".$_POST['medName']."'");
 while($row=mysqli_fetch_array($sql))
 	{
       
         ?>
 <input type="text"  id="unit" class="form-control" name="unit" value="<?php echo $row['unit']?>">
 <br>
 <label>Liều dùng</label>
<input type="text"  id="instruct" class="form-control" name="instruct" value="<?php echo $row['instruct']?>">
     

 

  <?php
}
}

?>

