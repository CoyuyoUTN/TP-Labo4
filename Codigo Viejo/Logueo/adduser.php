<?php
  require_once "Config/Autoload.php";

  use Models\User as User;
  use Repositories\UserRepository as UserRepository;

  if ($_POST) {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);

    $userRepository = new UserRepository();
    $userRepository->Add($user);

    header("location: login.php");
  }
?>