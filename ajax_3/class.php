<?php

//$con = mysqli_connect('localhost','root','','course');
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'course');

$name=$_POST['data'];

$q = "select * from class where mid='$name'";

$result = mysqli_query($con,$q);

while($rows= mysqli_fetch_array($result)){
    ?>
    <option value=""> <?php echo $rows['class']; ?> </option>
        <?php


                     }

?>