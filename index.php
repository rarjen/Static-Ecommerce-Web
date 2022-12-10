<?php
//start session
session_start();

require_once "php/CreateDB.php";
require_once "php/component.php";
require_once "php/header.php";
// Create instance of CreateDB class;
$database = new CreateDb("Uaspwl", "Products");

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Produk sudah ada didalam cart')</script>";
            echo "<script>window.location = 'index.php'</script>";
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        //Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        <?php include 'styles/styleIndex.css'; ?>
    </style>
    <script src="https://kit.fontawesome.com/96d4f37cea.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <!-- <div class="navbar">
            <div class="navbarcontent">
                <div class="user thin">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-location-dot"></i><span> </span>Address123, City, Country </a></li>
                        <li>|</li>
                        <li><a href="#"><i class="fa-solid fa-envelope"></i><span> </span>someaddress@example.com </a></li>
                        <li>|</li>
                        <li><a href="#"><i class="fa-solid fa-phone"></i><span> </span>+123(456)6784812</a></li>
                    </ul>
                </div>
                <div class="account thin">
                    <ul>
                        <li><a href="login.html"><i class="fa-solid fa-user"></i><span> </span>MY ACCOUNT</a></li>
                        <li><a href="#"><i class="fa-solid fa-heart"></i><span> </span>WISHLIST</a></li>
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-google-plus-g"></i></a></li>
                    </ul>
                </div>
            </div>
        </div> -->
        <?php
        navbar();
        ?>
        <div class="header">
            <div class="headercontent">
                <div class="label">
                    <h1 class="regular">OTNIEL BOOK SHOP</h1>
                    <p class="regular">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="searchbar">
                    <div class="cat regular">
                        <select name="cat" id="cat">
                            <option value="#">--Select Category--</option>
                            <option value="category-1">Category-1</option>
                            <option value="category-2">Category-2</option>
                            <option value="category-3">Category-3</option>
                            <option value="category-4">Category-4</option>
                        </select>
                    </div>
                    <div class="search regular">
                        <input type="text" placeholder="Search products...">
                    </div>
                    <div class="buttonsearch regular">Search</div>
                </div>
            </div>
        </div>
        <div class="page">
            <div class="pagecontent">
                <div class="tabs">
                    <div class="home current"><a href="index.php" class="regular">Home</a></div>
                    <!-- <div class="fashion"><a href="books.php" class="regular">Books</a></div>
                    <div class="sport"><a href="addbooks.php" class="regular">Add Book</a></div>
                    <div class="electronics"><a href="editbooks.php" class="regular">Edit Book</a></div> -->
                </div>
                <div class="cart">
                    <div class="carts">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"bold\">$count</span>";
                        } else {
                            echo "<span id=\"cart_count\" class=\"bold\">0</span>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="productcontent">
                <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)) {
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
                ?>
            </div>
        </div>



</body>

</html>