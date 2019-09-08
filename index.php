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
    if( isset($data['do_singup'])) {

      $errors = array();
      if( trim($data['username']) == '') {
        $errors[] = 'Enter user name!';
      }
      if( trim($data['email']) == '') {
        $errors[] = 'Enter email!';
      }
      if( $data['password'] == '') {
        $errors[] = 'Enter password!';
      }
      if( $data['password_2'] != $data['password']) {
        $errors[] = 'Password entered incorrectly!';
      }
      if( R::count('users', "username = ?", array($data['username'])) > 0) {
        $errors[] = 'A user with this user name already exists!';
      }
      if( R::count('users', "email = ?", array($data['email'])) > 0) {
        $errors[] = 'A user with this email already exists!';
      }

      if( empty($errors)) {
        $user = R::dispense('users');
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green"> You are successfully registered! </div>';
      } else {
        echo '<div style="color: red">' .array_shift($errors). '</div>';
      }

    }
?>
    
<div class="container">
<form method="POST"  class="form-sinin">
  <h2>Registration</h2>
  <div class="form-group">
    <label for="formGroupExampleInput">Enter your user name</label>
    <input type="text" name="username" class="form-control" id="formGroupExampleInput" placeholder="User name" value="<?php echo @$data['username']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo @$data['email']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo @$data['password']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Re-enter password</label>
    <input type="password" name="password_2" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo @$data['password_2']; ?>">
  </div>
  <button type="submit" name="do_singup" class="btn btn-primary">Registration</button>
  <a href='login.php' class='btn btn-primary'>Login</a>
</form>
</div>

</body>
</html>