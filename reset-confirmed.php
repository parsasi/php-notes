<?php
    if(!isset($_GET["password"])){
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" href="css/styles.css"/>
    <title>Register</title>
</head>
<body>
<div class="register confirm card">
    <h2>Your new password is <input style="display: inline;max-width: 80px;" type="text" value="<?php echo htmlspecialchars($_GET["password"]) ?>" disabled />. Please <a href="/login.php"> Login </a></h2>
</div>
</body>
</html>

