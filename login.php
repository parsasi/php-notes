<?php
    session_start();

    $error = Array();
    require_once('helpers/auth.php');
    $auth = new Auth();
    if(isset($_POST["submit"])){
        $authenticateUser = $auth->verify($_POST["email"] , $_POST["password"]);
        if($authenticateUser){
            $logindatetime = date("Y/m/d");
            $_SESSION['email'] = $_POST["email"];
            $_SESSION['timer'] = time();
            $_SESSION['logintime'] = $logindatetime;
            header('Location: index.php');
        }
        else{
            array_push($error , "Username or Password is wrong!");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Login</title>
  </head>
  <body>
    <div class="login card">
      <h2>Login</h2>
      <form action="/login.php" method="POST">
        <div class="login-inputs">
          <input type="email" placeholder="email..." name="email" />
          <input type="password" placeholder="password..." name="password" />
        </div>
        <input type="submit" name="submit" value="login" />
        <div class="feedback">
          <ul>
              <?php
              foreach($error as $singleError){
                  echo "<li>{$singleError}</li>";
              }
              ?>
          </ul>
        </div>
      </form>
      <div class="links">
        <a href="/reset.php">Forgot Password</a>
        <a href="/register.php"> Register </a>
      </div>
    </div>
  </body>
</html>
