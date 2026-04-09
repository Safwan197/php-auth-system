<?php

$showAlert = false;
$showError = false;

$id = $_GET["id"];
    
  require('../partials/_dbconn.php');
  $sql = "DELETE FROM products WHERE id=$id";
  $result = mysqli_query($conn,$sql) ;
  // $showAlert = true;a
  header("Location: index.php");
  exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<?php

    if($showAlert == true){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> '. $showAlert .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    };
    
    if($showError == true){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Try Again !</strong> '. $showError .'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        };
        
    ?>

    <?php require '../partials/_nav.php'?>
</body>
</html>