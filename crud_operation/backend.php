<?php

$con = mysqli_connect('localhost', 'root', '', 'cruddb');

//extract the all value one by one
extract($_POST);    // var fname = $_POST['fname'];


//come after readrecord function
//come after readrecord function
//2nd
if (isset($_POST['readrecord'])) {

    $data = '<table class="table table-bordered table-striped">
        <tr>
            <th> No. </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Email Address</th>
            <th> Phone Number </th>
            <th> Edit Action</th>
            <th> Delete Action </th>
        </tr>';

    $display = " SELECT  * FROM crudtable ";
    $result = mysqli_query($con, $display);

    if (mysqli_num_rows($result) > 0) {

        $number = 1;
        while ($row = mysqli_fetch_array($result)) {
            $data .= '<tr>
            <td>' . $number . '</td>
            <td>' . $row['first_name'] . ' </td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>
                <button onclick="GetUserDetail(' . $row['id'] . ')"
                class="btn btn-warning"> Edit</button> 
            </td>
            <td>
                 <button onclick="DeleteRecord(' . $row['id'] . ')"
                 class="btn btn-danger">Delete</button>
            </td>

        </tr>';
            $number++;
        }
    }
    $data .= '</table>';
    echo $data;
}



// query fire...  isset() function is used to chack whether a variable is set or not  (chack the values came proper or not )
//1st
if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone'])) {


    //write the query to insert data into database
    $query = " INSERT INTO `crudtable` (`first_name`, `last_name`, `email`, `phone`) VALUES ('$fname', '$lname', '$email', '$phone')";

    //query fire  (first connection then query)
    mysqli_query($con, $query);
}


// delete record
if (isset($_POST['deleteid'])) {
    $userid = $_POST['deleteid'];
    $del = "delete from crudtable where id = '$userid' ";
    mysqli_query($con, $del);
}


// get userid for update

if(isset($_POST['id']) && isset($_POST['id']) != '')  {

    $user_id = $_POST['id'];
    $q = " select * from crudtable where id = '$user_id' ";
    if(!$result = mysqli_query($con , $q)){
        exit();
    }

    $response = array();

    if(mysqli_num_rows($result) > 0 ){
        while($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else {
        $response['status'] = 200;
        $response['message'] = 'Data not found!..';

    }
 // php has some build-in functions to handle JSON.
 // object in php can be convert into json by using the php function.
 // json_encode():
    echo json_encode($response);
}
else{
    $response['status'] = 200;
        $response['message'] = 'Invalid Request!...';


}

//update table...
if(isset($_POST['hidden_user_id'])) {

    $hidden_user_id = $_POST['hidden_user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
   
    $uq = " update crudtable set first_name = $fname , last_name = $lname, email = $email, phone = $phone where id=  '$hidden_user_id' ";

    mysqli_query($con,$uq);
}

?>