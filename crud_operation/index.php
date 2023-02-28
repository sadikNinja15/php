<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    <div class="container">
        <h1 class='text-primary text-uppercase text-center'>Ajax Crud Function</h1>


        <div class="d-flex justify-content-end">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#myModal">Open modal</button>
        </div>


        <h2 class='text-danger text-center'>All Records Here</h2>
        <div id="records_contant"> </div>


        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">


                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>


                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name='' id='fname' class='form-control' placeholder='first name'>
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name='' id='lname' class='form-control' placeholder='last name'>
                        </div>

                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="text" name='' id='email' class='form-control' placeholder='email'>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name='' id='phone' class='form-control' placeholder='phone'>
                        </div>
                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='addRecord()'>Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- update -->
        <!-- The Modal -->
        <div class="modal fade" id="update_user_modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for='up_fname'>Update First Name</label>
                            <input type="text" name='' id='up_fname' class='form-control' placeholder='update first name'>
                        </div>
                        <div class="form-group">
                            <label for='up_lname'>Update Last Name</label>
                            <input type="text" name='' id='up_lname' class='form-control' placeholder='update last name'>
                        </div>
                        <div class="form-group">
                            <label for='up_email'>Update Email Id</label>
                            <input type="text" name='' id='up_email' class='form-control' placeholder='email'>
                        </div>
                        <div class="form-group">
                            <label for='up_phone'>Update Phone</label>
                            <input type="text" name='' id='up_phone' class='form-control' placeholder='phone'>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='updateuserdetail()'>Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                        <input type='hidden' name='' id='hidden_user_id'>

                    </div>

                </div>
            </div>

        </div>

        <script>
            $(document).ready(function() {
                readRecord(); // it show table always
            });

            function readRecord() {
                var readrecord = 'readrecord';

                $.ajax({
                    url: 'backend.php ',
                    type: 'post',
                    data: {
                        readrecord: readrecord
                    },
                    success: function(data, status) {
                        $('#records_contant').html(data);
                    }
                });
            }



            //first write
            function addRecord() {
                $(document).ready(function() {
                    var fname = $('#fname').val();
                    var lname = $('#lname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();

                    $.ajax({
                        url: 'backend.php',
                        type: 'post',
                        data: {
                            fname: fname,
                            lname: lname,
                            email: email,
                            phone: phone,
                        },
                        success: function(data, status) {
                            readRecord();
                        }

                    });
                });
            }

            // delete function 
            function DeleteRecord(deleteid) {
                var conf = confirm('Are you sure..');

                if (conf == true) {
                    $.ajax({
                        url: 'backend.php',
                        type: 'post',
                        data: {
                            deleteid: deleteid
                        },
                        success: function(data, status) {
                            readRecord();

                        }

                    });
                }

            }

            //edit 
            function GetUserDetail(id) {
                $('#hidden_user_id').val();

                $.post('backend.php', {
                        id: id
                    },
                    function(data, status) {

                        var user = JSON.parse(data);// it return javascript  from backend object
                        $('#up_fname').val(user.first_name);
                        $('#up_lname').val(user.last_name);
                        $('#up_email').val(user.email);
                        $('#up_phone').val(user.phone);

                    }
                );

                $("#update_user_modal").modal('show');
            }

            function  updateuserdetail(){
                var fname = $('#up_fname').val();
                var lname = $('#up_lname').val();
                var email = $('#up_email').val();
                var phone = $('#up_phone').val();

                var hidden_user_id = $('#hidden_user_id').val();

                $.post('backend.php',
                     {
                    hidden_user_id : hidden_user_id,
                    fname : fname ,
                    lname : lname,
                    email : email ,
                    phone : phone  
                        },
                    function(data,status){
                        $('#update_user_modal').modal('hide');
                        readRecord();

                    }
                
                );
 
            }
        </script>

</body>

</html>