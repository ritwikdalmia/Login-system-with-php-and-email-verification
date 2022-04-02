<?php
$showAlert=false;
$showError=false;
$showAlert1=false;

// if($_SERVER["REQUEST_METHOD"] == "GET"){
include 'dbconnect.php';
if(!empty($_GET['token']) && isset($_GET['token'])){
   $token=$_GET['token'];
 
   $sql=mysqli_query($conn,"SELECT sno FROM users WHERE token='$token'");
   $num=mysqli_fetch_array($sql);
   if($num>0)
{
  
// $istatus='0';
$result =mysqli_query($conn,"SELECT * FROM users WHERE token='$token' and status=0");
$result4=mysqli_fetch_array($result);  
if($result4>0) 
  {
// $is_verified='active';
$result1=mysqli_query($conn,"UPDATE users SET status=1 WHERE token='$token'");

if ($result1>0)
  {
  
    // $istatus='0';
    $result2 =mysqli_query($conn,"SELECT * FROM users WHERE token='$token' and status=1");
    $result3=mysqli_fetch_array($result2);  
    if($result3>0) 
      {

    $showAlert=true;
    
    
    }
  }
}
}
else{
  $showAlert1=true;
}

}


//     $updatequery= "UPDATE users SET is_verified='active' where token='$token'";
//     $query=$mysqli_query($conn,$updatequery);
//     if($query){
//             $showAlert=true;
//             header('location:login.php');
//             exit();
//         }
//         else{
//             $showError=true;
//         header('location:signup.php');

           
//         }
//     }
    


// }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>verification</title>
    <style>
 .modal-confirm {		
	color: #636363;
	width: 325px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #82ce34;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #82ce34;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #6fb32b;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}

      </style>
  </head>
  <body>
 
<?php require 'nav.php' ?> -->
    <?php
    if($showAlert){
      header('location:account_verified.html');
    
    
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>account not  verified yet!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
   

    
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
