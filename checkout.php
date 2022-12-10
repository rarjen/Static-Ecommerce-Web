<?php
session_start();

require_once "php/CreateDB.php";
require_once "php/component.php";

$db =  new CreateDb("Uaspwl", "Products");

if (isset($_POST['hapus'])) {
  if ($_GET['action'] == 'hapus') {
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['product_id'] == $_GET['id']) {
        unset($_SESSION['cart'][$key]);
        echo "<script> alert('Product dihapus dari cart!')</script>";
        echo "<script>window.location = 'cart.php'</script>";
      }
    }
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <script src="https://kit.fontawesome.com/96d4f37cea.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    <?php include "styles/styleCart.css"; ?>
  </style>
</head>

<body class="bg-light">
  <div class="container-fluid">
    <div class="row px-5">
      <div class="col-md-7">
        <div class="shopping-cart">

          <h2>Checkout</h2>
          <hr>
          <?php
          $total = 0;
          if (isset($_SESSION['cart'])) {
            $product_id = array_column($_SESSION['cart'], 'product_id');

            $result = $db->getData();
            while ($row = mysqli_fetch_assoc($result)) {
              foreach ($product_id as $id) {
                if ($row['id'] == $id) {
                  checkout($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                  $total = $total + (int)$row['product_price'];
                }
              }
            }
          } else {
            echo "<h5>Cart is empty</h5>";
          }

          if (isset($_POST['bayar'])) {
            header("Location: invoicefield.php");
            // session_unset();
          }
          ?>
        </div>
      </div>
      <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
        <div class="pt-4">
          <h5>Rincian Harga</h5>
          <hr>
          <div class="row total">
            <div class="col-md-6">
              <?php
              if (isset($_SESSION['cart'])) {
                $count =  count($_SESSION['cart']);
                echo "<h6>Sub Total ($count items)</h6>";
              } else {
                echo "<h6>Sub Total (0 items)</h6>";
              }
              ?>
              <h6>Ongkos Kirim</h6>
              <hr>
              <h6>Total Bayar</h6>
            </div>
            <div class="col-md-6">
              <h6>IDR <?php echo $total; ?></h6>
              <h6 class="text-success">GRATIS</h6>
              <hr>
              <h6>IDR <?php echo $total; ?></h6>
            </div>
            <div class="col-md-6 buttons">
              <form action="checkout.php" method="POST">
                <button type="bayar" name="bayar" class="btn btn-secondary"> <a href="cart.php">Back</a></button>
                <button type="bayar" name="bayar" class="btn btn-success">Bayar</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>