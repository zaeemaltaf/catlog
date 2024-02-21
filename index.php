<!DOCTYPE html>
<?php include('dbconnection.php'); 

if (!isset($_SESSION['count'])) {
    $_SESSION['count'][0] = 0;
    $_SESSION['index'] = 0;
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .card{
                border-radius: 10px;
            }

            .product-image{
                aspect-ratio: 3/2;
                height: 200px;
                width: 200px;
                border-radius: 20px;
                align-self: center;
            }

            .card button[type=submit]{
                width: 50%;
                align-self: center;
            }
            a{
                text-decoration: none;
            }
        </style>
</head>

<body>
    <div class="container">
            <h2 class="text-center my-4">Products</h2>
            <h2 class="text-end "><a href="cart.php">Cart(<?= $_SESSION['index'];?>)</a></h2>
        <div class="row">
            <?php
            $query = "SELECT * from product";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3">
                        <div class="card text-center py-4 px-0">
                            <img src="Images/<?= $row['pimage']; ?>" alt="Image" class="product-image">
                            <p><b><?= $row['pname'];?></b></p>
                            <p> Rs <?= $row['pprice'];?> /= </p>
                            <button type="submit" class="btn btn-primary"><a href="addtocart.php?id=<?= $row['pid']; ?>" class="text-white">Add to cart</a></button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>