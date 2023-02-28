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
<div class="container">
        <h1> this is ajax </h1>
        <p id="changehere"> this is going to be change....</p>
        <button class="btn btn-primary btnclick"> Click </button>
</div>
 
   
    <script type='text/javascript'>

        $(document).ready(function(){
            $('.btnclick').click(function(){

                $.get('get.html' , function(data,status){
                    $('#changehere').html(data);
                    alert(status);

                });
            });
        });
     </script>   
    
</body>
</html>