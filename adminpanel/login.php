<?php
    session_start();
    require "../koneksi.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .login-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #ffffff;
    }
    </style>
</head>
<body>
    <div class="text-center align-items-center">
    <div class="login-container">
  <h3 class="text-center">Login</h3>
  <form action="" method="POST">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div id="error-message" class="text-danger mb-3"></div>
    <button type="submit" class="btn btn-primary w-100" onclick="validateForm()" name="loginbtn">Login</button>
  </form>
  <?php
  if(isset($_POST['loginbtn'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);

    if($countdata>0){
      if (password_verify( $password, $data['password'])){
        $_SESSION['username'] = $data['username'];
        $_SESSION['login'] = true;
        header('location: ../adminpanel');
      }
      else{
        ?>
        <div class="alert alert-danger" role="alert">
             Password Salah
    </div>
    <?php
      }
    }
    else{
        ?>
        <div class="alert alert-danger" role="alert">
             Username Atau Password Salah
    </div>
    <?php
    }
  }
  ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>