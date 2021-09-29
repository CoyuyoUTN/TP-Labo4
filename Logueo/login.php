<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <?php
    if ($_GET && isset($_GET["msg"])) {
      switch ($_GET["msg"]) {
        case "incorrect":
  ?>
          Email y/o password incorrectos<br>
  <?php
          break;
        case "error":
  ?>
          Hubo un error inesperado, intente nuevamente<br>
  <?php
          break;
      }
    }
  ?>
  <form action="session.php" method="post">
    <input type="email" name="email" placeholder="Email" required autocomplete="off">
    <br>
    <input type="password" name="password" placeholder="Password" required autocomplete="off">
    <br><br>
    <button type="submit">Iniciar sesión</button>
    <button><a href="signup.php">Crear Usuario</a></button>
  </form>
</body>
</html>