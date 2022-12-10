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
  <script src="https://kit.fontawesome.com/96d4f37cea.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/styleCart.css">
</head>

<body>
  <?php
  // print_r($_SESSION);

  if (isset($_POST['order'])) {
    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    if ($conn === false) {
      die("ERROR : could not connect." . mysqli_connect_error());
    }
    $sql = "INSERT INTO user_order (email, username, phone, useraddress)
    VALUES ('$email', '$fullName', '$phoneNumber', '$address')";
    mysqli_query($conn, $sql);

    header('Location: invoice.php');
  }

  if (isset($_POST['back'])) {
    header('Location: checkout.php');
  }
  ?>
  <div class="container p-2">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6 p-5 bg-light rounded">
        <h4>Please fill this form to finish the payment!</h4>
        <hr>
        <form method="POST" action="invoicefield.php">

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" aria-describedby="emailHelp" name="fullName" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phoneNumber" aria-describedby="emailHelp" name="phoneNumber" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Tuliskan Alamat" name="address" id="address" style="height: 100px" required></textarea>
              <label for="floatingTextarea2">Address</label>
            </div>
          </div>
          <button type="order" name="order" class="btn btn-success">Order Now!</button>
          <button type="back" name="back" class="btn btn-warning">Back</button>
        </form>
      </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>