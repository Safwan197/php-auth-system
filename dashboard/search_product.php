<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/loginsystem">iSecure</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Li 1 -->
                <li class="nav-item active">
                    <a class="nav-link" href="/loginsystem/dashboard/index.php">Home<span
                            class="sr-only">(current)</span></a>
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
            <form class="form-inline my-2 my-lg-0" action="search_product.php" method="POST">
                <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <h2 class="my-4 text-center">Searched Items</h2>
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                include("../partials/_dbconn.php");
                $name = $_POST['name'];
                $sql = "SELECT * FROM products WHERE name = '$name'";
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        $imgPath = !empty($row['image']) ? "../images/" . $row['image'] : "https://via.placeholder.com/80";
                        echo "<td><img src='" . $imgPath . "' width='80' height='80' class='img-thumbnail'></td>";

                        // Edit and Delete buttons
                        echo "<td>
                    <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning mr-1'>Edit</a>
                    <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this product?')\">Delete</a>
                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No data found</td></tr>";
                }
            }
            ?>

        </tbody>
    </table>
</body>

</html>