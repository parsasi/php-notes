<?php
    session_start();
    require_once('helpers/auth.php');
    $auth = new Auth();
    $currentUser = $auth->authenticate($_SESSION);

    $error = Array();
    require_once('helpers/validation.php');


    $file = uploadImages($_FILES , $error);
    $websites = handleWebsites($_POST["website"] , $error);
    isset($_POST["delete"]) && deleteImages($currentUser["Images"] , $_POST["delete"]);

    saveUser($_POST["notes"] , $_POST["TBD"] , $websites , $file);
    header('Location: index.php');





    function saveUser($notes , $TBD , $websites , $file){
        global $currentUser;

        require_once('helpers/userDto.php');
        $userDto = new UserDto();

        $websitesToSave = array_merge($currentUser["Websites"] , $websites);
        $imagesToSave = $currentUser["Images"];
        if($file != false){
            $imagesToSave = array_merge ($imagesToSave , [$file]);
            //Only keeping the last 4 elements in the array
            $imagesToSave = array_slice($imagesToSave, count($imagesToSave) - 4);
        }
        //Not ideal that I'm updating everything from the currentUser everytime!
        $userDto->editUser($currentUser["Email"]  , $notes , $TBD , $websitesToSave, $imagesToSave);


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

    function deleteImages(&$images , $imagesToDelete){
        foreach($imagesToDelete as $deleteKey => $deleteValue){
            if($deleteValue == "on"){
                $imageKey = array_search($deleteKey , $images);
                if($imageKey !== false){
                    unset($images[$imageKey]);
                }
            }
        }
    }

    function uploadImages($files , &$error){
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







