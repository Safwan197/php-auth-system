<?php

$showAlert = false;
$showError = false;
$exist = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

include 'partials/_dbconn.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

// include 'partials/_dbconn.php/';
// $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";

$sql = "SELECT * FROM users WHERE (username='$username' or email='$email')";

$result = mysqli_query($conn, $sql);
// $exist = mysqli_num_rows($result) > 0;

if(mysqli_num_rows($result) > 0){
    // $showError = "Email already exists";
    $row = mysqli_fetch_assoc($result);
    if($email==isset($row['email']))
    {
        $showError = "Email already exists";
    }
		elseif($username==isset($row['username']))
    {
        $showError = "Username already exists";
    }
}

// if(mysqli_num_rows($result) > 0){
//     // $showError = "Email already exists";
//     $row = mysqli_fetch_assoc($result);
//     if($email == $row['email'])
//     {
//         $showError = "Email already exists";
//     }
// 		if($username == $row['username'])
//     {
//         $showError = "Username already exists";
//     }
// }

else if($password != $cpassword){
    $showError = "Passwords do not match";
}
else {
    $sql = "INSERT INTO `users` (`email`,`username`, `password`, `dt`) VALUES ('$email','$username','$password',current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if($result){
        $showAlert = true;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Sign Up</title>
  </head>
  <body>

  <?php require 'partials/_nav.php'?>

  <?php

    if($showAlert == true){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is now created !
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    };

    if($showError){
    echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Try Again !</strong> '. $showError .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    };

    // if($exist){
    // echo'
    // <div class="alert alert-warning alert-dismissible fade show" role="alert">
    // <strong>Success!</strong> Username already exists
    // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // };
    
    ?>
    <div class="container">

      <h3 class="p-5 text-center">Sign Up to Website</h3>
      <!-- <div class="container my-5">
  <div class="p-5 text-center bg-gradient rounded-4 shadow-lg " style="background: linear-gradient(135deg, #3c5c38 0%, #455062 100%);">
    <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.3);">
      Sign Up to Our Website
    </h1>
    <p class="lead text-white-50 fs-4">
      Create your account and join our amazing community!
    </p>
    <i class="bi bi-stars" style="font-size: 2rem; color: #ffdd00;"></i>
  </div>
</div> -->

        <form action = 'signup.php' method = 'POST'>

        <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter Email">
</div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name='username' aria-describedby="emailHelp" placeholder="Enter Username">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name='password'>
</div>
<div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name = 'cpassword'>
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password.</small>
  </div>

  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>