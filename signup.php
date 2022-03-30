<?php
$showAlert = false;
$showError = false;
$showAlert1 = false;
$showError1 = false;
$showError2 = false;
$showError3 = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $username = $_POST["username"];
    $email=$_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // $exists=false;

    // Check whether this email exists
    $sql_email = "SELECT * FROM `users` WHERE email = '$email'";
    $sql_username = "SELECT * FROM `users` WHERE username = '$username'";
    $result_email=mysqli_query($conn, $sql_email) or die (mysqli_error($conn));
    $result_username=mysqli_query($conn, $sql_username) or die (mysqli_error($conn));
    $numExistRows = mysqli_num_rows($result_username);
    $numExistRows1 = mysqli_num_rows($result_email);
    
    if($numExistRows > 0){
        // $exists = true;
        $showError2 = true;
    }
    else if($numExistRows1 > 0){
        // $exists = true;
        $showError3 = true;
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token= bin2hex(random_bytes(15));
            
            $sql = "INSERT INTO `users` ( `username`, `email`,`password`, `dt`,`token`) VALUES ('$username','$email','$hash', current_timestamp(),'$token')";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;


            }
        }
        // else{
        //     $showError = "Passwords do not match";
        // }
    if($password != $cpassword){
        
        $slowAlert1=false;
    $showError= true;
        
}
else{
    $headers = 'From:user@smilewellnessfoundation.org' ."\r\n" .
'reply-to:smilewellnessfoundation@gmail.com'. "\r\n" .
'X-Mailer: PHP/' . phpversion();
$to = "$email";
$sub = "Email Verification ";
$msg="
     thank you for signing up on our website.
     please click on the verification link below to verify your email
      http://www.smilewellnessfoundation.org/activate.php?token=$token";
if (mail($to,$sub,$msg,$headers)){
  //echo "Your Mail is sent successfully.";
  $showAlert1 = true;
}
else{
  //echo "Your Mail is not sent. Try Again.";
  $showError1 = true;
}
//     $slowAlert1=false;
//     $showError1 = false;
// }
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
        <strong>Success! Account created Sucessfully</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>password dont match</strong> '. $showError.'
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
                <strong>Verification mail not send please check your email id!!</strong> '. $showError1.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
            }
            if($showError2){
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Username already taken</strong> '. $showError2.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> ';
                }
                if($showError3){
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>email already exist</strong> '. $showError3.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> ';
                    }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Signup to our website</h1>
     <form action="signup.php" method="post">
        <div class="form-group">
            <label for="username">username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"  class="form-control" id="email" name="email" >
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" maxlength="23" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>
        <p class = "text-center">Already Have An Account?? <a href="login.php">login Here</a></p>
         
        <button type="submit" class="btn btn-primary">SignUp</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>