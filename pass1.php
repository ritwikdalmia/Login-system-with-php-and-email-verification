<?php
$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;




if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    include 'dbconnect.php';
   
    $email=$_POST["email"];
    // $password = $_POST["password"];
    // $cpassword = $_POST["cpassword"];

    // $exists=false;

    // Check whether this email exists
    $sql_email = "SELECT * FROM `users` WHERE email = '$email'";
    $result_email=mysqli_query($conn, $sql_email) or die (mysqli_error($conn));
    $numExistRows1 = mysqli_num_rows($result_email);
    
    if($numExistRows1 ==0){
        // $exists = true;
        $showError = true;
    }
else{
    $code= bin2hex(random_bytes(15));
    $sql = "UPDATE users SET code='$code',pass_status=0 WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result){
               
    $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
'reply-to:smilewellnessfoundation@gmail.com'. "\r\n" .
'X-Mailer: PHP/' . phpversion();
$to = "$email";
$sub = "password reset Link ";
$msg="
    Dont worry we will Help you to reset the password
     please click on the verification link below to reset your password
      http://www.smilewellnessfoundation.org/password_activate.php?code=$code";
if (mail($to,$sub,$msg,$headers)){
    $_SESSION['email'] = $email;
  //echo "Your Mail is sent successfully.";
  $showAlert = true;
}
else{
  //echo "Your Mail is not sent. Try Again.";
  $showError1 = true;
}
}

       
}
}
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Password reset link send sucessfully!!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Email Id dont exist!!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    if($showAlert1){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Email send succesfully!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
        }
        if($showError1){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Verification mail not send please check your email id!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Password-reset</h1><br><br>
     <form action="pass1.php" method="post">
        <div class="form-group">
            <label for="email">Email</label><br>
            <input type="email"  class="form-control" id="email" name="email"  >
            
        </div>
  
  <button class="btn btn-primary" type="submit" name='continue'>Continue</button>

        
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>