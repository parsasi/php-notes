<?php
    if(isset($_POST["email"])){
        $error = Array();
        require_once('helpers/userDto.php');
        require_once('helpers/randomGenerator.php');
        $userDto = new UserDto();
        $newPassword = generate();
        $changeResult = $userDto->editUserPassword($_POST["email"] , $newPassword);
        if($changeResult){
            header('Location: reset-confirmed.php?password=' . $newPassword);
        }else{
            array_push($error , "Could not find the user!");
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
    <title>Reset Password</title>
</head>
<body>
<div class="register card">
    <h2>Reset Password</h2>
    <form action="/reset.php" method="POST">
        <div class="register-inputs">
            <input type="email" placeholder="email..." name="email" />

        </div>
        <input type="submit" name="submit" value="Reset" />
    </form>
    <div class="links">
        <a href="/login"> Login </a>
    </div>
</div>
</body>
</html>

