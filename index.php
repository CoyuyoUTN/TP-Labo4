<?php
  session_start();

  if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
  } else {
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenidos al <br>Proyecto Final de Lab 4</title>
</head>
<body>
  <h1>Bienvenido <?php echo $email; ?>!</h1>
  <a href="logout.php">Logout</a>
</body>
</html>