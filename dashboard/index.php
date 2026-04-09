<?php

session_start();
if(!isset($_SESSION['username']) || $_SESSION['username'] !=true){
    header('location: ../auth/login.php');
    exit();
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

    <title>Welcome - <?php echo $_SESSION['username']?></title>
  </head>
  <body>
    

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/loginsystem">iSecure</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- Li 1 -->
      <li class="nav-item active">
        <a class="nav-link" href="/loginsystem/dashboard/index.php">Home<span class="sr-only">(current)</span></a>
      </li>

      <!-- Li 2 -->
      <li class="nav-item">
          <a class="nav-link" href="/loginsystem/dashboard/add_product.php">Add Product</a>
        </li>
        
        <!-- Li 3 -->
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
<?php
include '../partials/_dbconn.php';

$sql = 'SELECT * FROM products';
$result = $conn->query($sql);
?>
<h2 class="my-4 text-center">All Products</h2>
<table class="table table-striped table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>Name</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['quantity']."</td>";
            echo "<td>".$row['price']."</td>";
            $imgPath = !empty($row['image']) ? "../images/".$row['image'] : "https://via.placeholder.com/80";
            echo "<td><img src='".$imgPath."' width='80' height='80' class='img-thumbnail'></td>";

            // Edit and Delete buttons
            echo "<td>
                    <a href='edit_product.php?id=".$row['id']."' class='btn btn-sm btn-warning mr-1'>Edit</a>
                    <a href='delete_product.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this product?')\">Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No data found</td></tr>";
    }
    ?>
  </tbody>
</table>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>