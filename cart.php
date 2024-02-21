<!DOCTYPE html>
<?php include('dbconnection.php'); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .product-image {
            aspect-ratio: 3/2;
            height: 70px;
            width: 70px;
            border-radius: 10px;
            align-self: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["count"] as $id) {
                        $query = "SELECT * from product WHERE pid = $id";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['pid']; ?>
                                    </td>
                                    <td> <img src="Images/<?= $row['pimage']; ?>" alt="Image" class="product-image"></td>
                                    <td>
                                        <?= $row['pname']; ?>
                                    </td>
                                    <td><input type="number" value="<?= $row['pprice']; ?>" class="price" /></td>
                                    <td>
                                        <button id="btn" onclick="changeQuantity(this.parentNode.querySelector('.qty'), -1)"> -
                                        </button>
                                        <input type="number" name="pqty" value="1" min="0" class="qty" id="qty" readonly>
                                        <button id="btn" onclick="changeQuantity(this.parentNode.querySelector('.qty'), 1)"> +
                                        </button>
                                    </td>
                                    <td>
                                        <input type="number" name="pprice" value="<?php echo $row['pprice']; ?>"
                                            class="subtotalprice" readonly>
                                    </td>
                                    <td>
                                        <form method="post" action=''>
                                            <input type='hidden' name='id' value="<?php echo $row["pid"]; ?>" />
                                            <button type="submit" id="btn" name="remove" class="remove">
                                                X
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    echo "<tr>";
                    echo "<th colspan=\"3\" style='text-align:center;'><h3>Cart Total:</h3></th>";
                    echo "<td><input type='number' name='total_qty' value='0' min='0' id='Tqty' readonly></td>";
                    echo "<td colspan=\"2\"><b>PKR: </b><input type='number' name='total_price' value='0' min='0' id='OverallTotalPrice' readonly></td>";
                    echo "</tr>";


                    // Removing
                    if (isset($_POST['remove'])) {
                        $removeProductId = $_POST["id"];

                        foreach ($_SESSION["count"] as $key => $value) {
                            if ($value === $removeProductId) {
                                unset($_SESSION["count"][$key]);

                                // Decrease $_SESSION["index"] when an  is removed
                                $_SESSION["index"] = count($_SESSION["count"]);
                                echo "<script>window.location.href='cart.php';</script>";
                            }
                        }


                        // If the cart is empty after removing the item, unset the session variable
                        if (empty($_SESSION["itemcount"])) {
                            unset($_SESSION["itemcount"]);
                        }
                    }
                    ?>
                     <tr>
                        <td colspan="8">
                            <a class="btn btn-primary" id="checkoutBtn" onclick="checkoutBtn()">Ckeckout</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>



    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
