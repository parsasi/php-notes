<?php
$root=$_SERVER['DOCUMENT_ROOT'];

require_once($root .'/db/db.php');

function connect(){

    $schemas = Array(
        "users" => Array(
            "path" => "/db/users.json",
            "schema" => Array(
                "Email",
                "Password",
                "Websites",
                "Notes",
                "TBD",
                "Images"
            )
        )
    );

    return new Database($schemas);;
}

//$newUser = Array(
//    "Email" => "mail@parsa.pro",
//    "Password" => "123456",
//    "Websites" => Array("mail@yahoo.com" , "google.ca"),
//    "TBD" => "Some note here",
//    "Notes" => "Some TBD here",
//    "image" => Array("image.png" , "image2.png")
//);

//$db->editRow("users" , "Email" , "parsasi@rocketmail.com" , $newUser);

//$db->createRow("users" , $newUser);

//var_dump($db->searchTable("users", "Email" , "parsasi@.com"));

