<?php
    $error = Array();
    require_once('helpers/userDto.php');
    require_once('helpers/validation.php');
    if(isset($_POST["submit"])){
        $validationErrors = validateSignUp($_POST["email"] , $_POST["password"] , $_POST["password-confirm"]);
        if(count($validationErrors) == 0){
            $error = Array();
            $userDto = new UserDto();
            $creationResult = $userDto->createUser($_POST["email"] , $_POST["password"] , "" , "" , [] , []);
            if($creationResult){
                header("Location: /confirmed.php");
            }else{
                array_push($error , "Something went wrong!");
            }
        }else{
            array_combine($error , $validationErrors);
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
    <title>Register</title>
</head>
<body>
<div class="register card">
    <h2>Register Now</h2>
    <form action="/register.php" method="POST">
        <div class="register-inputs">
            <input type="email" placeholder="email..." name="email" />
            <input type="password" placeholder="password..." name="password" />
            <input
                type="password"
                placeholder="Confirm password..."
                name="password-confirm"
            />
        </div>
        <input type="submit" name="submit" value="Register" />
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
        <a href="/login.php"> Login </a>
    </div>
</div>
</body>
</html>

