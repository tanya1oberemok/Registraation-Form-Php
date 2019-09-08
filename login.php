<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php
    require 'includes/db.php';

    $data = $_POST;
    if( isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'username = ?', array($data['username']));
        if( $user) {
            if( password_verify($data['password'], $user->password)){
                $_SESSION['logged_user'] = $user;
                echo '<div style="color: green"> You are authorized! </div>';
            } else {
                $errors[] = 'Password entered incorrectly!';
            }
        } else {
            $errors[] = 'User with such login not found!';
        }
        if( ! empty($errors)) {
            echo '<div style="color: red">' .array_shift($errors). '</div>';
          }
    
    }

    
?>

<div class="container">
<form method="POST" class="form-sinin">
  <h2>Login</h2>

  <div class="form-group">
    <label for="formGroupExampleInput">Enter your user name</label>
    <input type="text" name="username" class="form-control" id="formGroupExampleInput" placeholder="User name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember_me" checked="checked" >
    <label class="form-check-label" for="exampleCheck1">Remember password</label>
  </div>
  <button type="submit" name="do_login" class="btn btn-primary">Login</button>
  <a href="index.php" class="btn btn-primary">Registration</a>
</form>
</div>