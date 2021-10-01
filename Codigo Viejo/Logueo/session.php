<?php
  require_once "Config/Autoload.php";

  use Models\User as User;
  use Repositories\UserRepository as UserRepository;

  if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userRepository = new UserRepository();

    $userList = $userRepository->GetAll();

    $i = 0;

    while ($i < count($userList) && ($userList[$i]->getEmail() != $email || !password_verify($password, $userList[$i]->getPassword()))) {
      $i++;
    }

    if ($i < count($userList)) {
      session_start();
      $_SESSION["email"] = $email;
      header("location: index.php");
    } else {
      header("location: login.php?msg=incorrect");
    }
  }
?>