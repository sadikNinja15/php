<?php

$con = mysqli_connect('localhost','root');

if($con){
    echo 'success';
}
$db = mysqli_select_db($con,'course');
if($db){
    echo '<br>success db';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>

    <title>Document</title>

       <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
 <body>
    
    <div class="container col-lg-6">

        <h2 class='text-center text-danger' > Get data from database ...</h2>

        <form >
            username:<input type='text' name='' class='form-control'><br>
            password:<input type='text' name='' class='form-control'><br>
            Degree:<select name="" id="" class='form-control' onchange="myf(this.value)" >

                        <option value="">Select any one</option>

                        <?php
                        $q='select * from degree';
                        $result= mysqli_query($con,$q);  
                        while($rows=mysqli_fetch_array($result)){    //fetch the data
                            ?>
                            <option value="<?php  echo $rows['mid'];  ?> ">
                                <?php  echo $rows['degree'];   ?>
                            </option>

                        <?php
                           }
                        ?>

            </select><br>

            class:<select class='form-control' id='get'>
                <option > Chose any one..</option>
                    </select>

                <br><br>
                <button class='btn btn-primary'>
                            Submit
                </button>


        </form>
    </div>

    <script type-'test/javascript'>
        function myf(value){  // myf call function

            $.ajax({
                url:'class.php',
                type:'POST',
                data:{ data : value} // value is the received data 

                success: function(result){    // result received as a response output when three parameter done
                    $('#get').html(result);   //.html write the content where id is get

                }


            });
        }

    </script>
 </body>
</html>