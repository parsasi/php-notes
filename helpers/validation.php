<?php

$regLibrary = Array(
    "email" => '~^\S+@\S+$~',
    "password" => '~^.{6,}$~'
);

function validateLogin($email , $password){
    global $regLibrary;
    $error = Array();

}

function validateSignUp($email , $password , $passwordConfirm){

    global $regLibrary;
    $error = Array();

    if($password != $passwordConfirm){
       array_push($error , "Please make sure your passwords match");
    }
    if(!preg_match($regLibrary["email"] , $email)){
        array_push($error , "Please enter a correct email");
    }

    if(!preg_match($regLibrary["password"] , $password)){
        array_push($error , "Please enter a password with at least 6 characters");
    }

    return $error;
}