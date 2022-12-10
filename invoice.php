<?php
session_start();
$conn = mysqli_connect("localhost:3308", "root", "", "uaspwl");
require_once "php/CreateDB.php";
require_once "php/component.php";

$db =  new CreateDb("Uaspwl", "Products");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/styleCart.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="invoicebox col-md-6 border rounded bg-light h-25 p-3">
        <div class="pt-4">
          <h2>Otniel Book Shop</h2>
          <h5 class="my-2 invoice bold">Invoice</h5>
          <hr>
          <div class="row p-2">
            <div class="col-3">
              <h6>Email</h6>
              <h6>Name</h6>
              <h6>Phone</h6>
              <h6>Address</h6>
            </div>
            <div class="col-9">
              <?php
              $show = "SELECT * FROM user_order";
              $query = mysqli_query($conn, $show);
              $data = mysqli_fetch_assoc($query);
              ?>
              <h6 class="regular"><?= $data['email']; ?></h6>
              <h6 class="regular"><?= $data['username']; ?></h6>
              <h6 class="regular"><?= $data['phone']; ?></h6>
              <h6 class="regular"><?= $data['useraddress']; ?></h6>
            </div>
          </div>
          <hr>
          <h6>Item</h6>
          <?php
          $total = 0;
          if (isset($_POST['pay'])) {
            $sql = "DELETE FROM user_order";
            if (mysqli_query($conn, $sql)) {
              echo '<script>alert("Proses pembelian selesai")</script>';
              session_unset();
            } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            // header('Location: index.php');
          }
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

          ?>
          <div class="row p-2">
            <form action="invoice.php" method="POST">
              <div class="col-md-12 ">
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
                </div>
              </div>
              <div class="row p-2">
                <button type="pay" class="btn btn-success" id="pay" name="pay">PAY</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>