<?php
    session_start();
    require_once('helpers/auth.php');
    $auth = new Auth();
    $currentUser = $auth->authenticate($_SESSION);

    $error = Array();
    require_once('helpers/validation.php');



    $file = uploadFile($_FILES , $error);
    $websites = handleWebsites($_POST["website"] , $error);

    saveUser($_POST["notes"] , $_POST["TBD"] , $websites , $file);
    header('Location: index.php');





function saveUser($notes , $TBD , $websites , $file){
        global $currentUser;

        require_once('helpers/userDto.php');
        $userDto = new UserDto();

//        var_dump($currentUser["Images"] , [$file]);
        $websitesToSave = array_merge($currentUser["Websites"] , $websites);
        $imagesToSave = [];
        if($file != false){
            $imagesToSave = array_merge ($currentUser["Images"] , [$file]);
        }
        var_dump($currentUser["Websites"]);
        //Not ideal that I'm updating everything from the currentUser everytime!
        $userDto->editUser($currentUser["Email"] , $currentUser["Password"] , $notes , $TBD , $websitesToSave, $imagesToSave);


    }

    function handleWebsites($websites , &$error){
        $websitesToAdd = Array();
        foreach($websites as $website){
            if($website != ""){
                if(validateWebsite($website)){
                    array_push($websitesToAdd , $website);
                }else{
                    array_push($error , $website . " is not a valid url!");
                }
            }
        }
        return $websitesToAdd;
    }

    function uploadFile($files , &$error){
        if($files["image"]["size"] > 0){
            require_once("helpers/randomGenerator.php");
            $target_dir = "uploads/";
            $target_file = $target_dir . generate();
            $currentFile =  $target_dir . basename($files["image"]["name"]);
            $imageFileType = strtolower(pathinfo($currentFile, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($files["image"]["tmp_name"]);
            if ($check !== false) {
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType != "jpeg" || $imageFileType == "gif" ) {
                    $fullPath = $target_file.".".$imageFileType;
                    move_uploaded_file($files["image"]["tmp_name"], $fullPath);
                    return $fullPath;
                }
            }

            array_push($error , "Could not upload the file!");
            return false;
        }
        else{
            return false;
        }
    }







