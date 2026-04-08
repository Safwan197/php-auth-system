<?php

$showAlert = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

include ("../partials/_dbconn.php");

$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$image = $_POST['image'];

$sql = "SELECT * FROM products WHERE name = '$name'";
$result = mysqli_query($conn,$sql);

if (!empty($_POST['name']) && !empty($_POST['quantity'] && !empty($_POST['price']) && !empty($_POST['price']))){

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){
            
            if(isset($row['name']) && $row['name'] == $name){
                $showError = "Item already exists";
            }
        }
    }
    
    else{
        $sql = "INSERT INTO `products` (`name`, `quantity`, `price`,`image`) VALUES ('$name','$quantity','$price','$image')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = "Item Added Successfully";
        }
    }
            
}
else{
    $showError = "Fill out all the areas";
    }
}
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/loginsystem">iSecure</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/loginsystem/dashboard/index.php">Home<span class="sr-only">(current)</span></a>
      </li>

      <!-- Li 1 -->
      <li class="nav-item">
          <a class="nav-link" href="/loginsystem/dashboard/add_product.php">Add</a>
        </li>
        
        <!-- Li 2 -->
      <li class="nav-item">
        <a class="nav-link" href="/loginsystem/auth/logout.php">Logout</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<h2 class="text-center text-primary my-4">
  <i class="bi bi-plus-circle"></i> Add Products
</h2>
<form method="POST" action="add_product.php">

<div class="form-group m-3">
    <label for="productName">Name</label>
    <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name">
</div>

<div class="form-group m-3">
    <label for="productQuantity">Quantity</label>
    <input type="number" class="form-control" id="productQuantity" name="quantity" placeholder="Enter quantity">
</div>

<div class="form-group m-3">
    <label for="productPrice">Price</label>
    <input type="number" step="1" class="form-control" id="productPrice" name="price" placeholder="Enter price">
</div>

<div class="form-group m-3">
            <label for="image">Product Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" accept="images/*" required>
                <label class="custom-file-label" for="image">Choose image...</label>
            </div>
        </div>

<div class="form-group m-3">
    <button type="submit" class="btn btn-primary">Add Product</button>
</div>

</form>
</body>
</html>