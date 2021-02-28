<?php
    $root=$_SERVER['DOCUMENT_ROOT'];

    require_once($root.'/helpers/userDto.php');

    class Auth{
        private $userDto;
        public function __constructor(){
            $this->userDto = new UserDto();
        }

        function verify($email , $password){
            $user = $this->userDto->findUser($email);
            if($user != false){
                if(password_verify ( $password, $user->Password )){
                    return true;
                }
            }
            return false;
        }

    }