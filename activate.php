<?php
$showAlert=false;
$showError=false;
session_start();
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

$showAlert=true;
header('location:login.php');

}
else
{
$msg ="Your account is already active, no need to activate again";
$showError=true;
header('location:login.php');

}
}
else
{
$msg ="Wrong activation code.";
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

    <title>login</title>
  </head>
  <body>
<!-- 
<?php require 'nav.php' ?> -->
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>account verified successfully!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
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
