<?php
    $root=$_SERVER['DOCUMENT_ROOT'];

    require_once($root.'/helpers/userDto.php');

    class Auth{
        private $userDto;
        public function __construct(){
            $this->userDto = new UserDto();
        }

        function verify($email , $password){
            $user = $this->userDto->findUser($email);
            if($user != false){
                if( password_verify ( $password,  $user["Password"])){
                    return true;
                }
            }
            return false;
        }

        //Function gets the session array by reference (hence the &) so it can directly modify it
        function authenticate(&$sessions){
            $email = $sessions['email'];
            $timeSinceLogin = (time() - $sessions['timer']);
            if(isset($email) && $timeSinceLogin < 500) {
                $user = $this->userDto->findUser($email);
                if ($user != false) {
                    $_SESSION['timer'] = time();
                    return $user;
                }
            }
            $this->logout();
            return false;
        }

        function logout(){
            session_destroy();
            header('Location: login.php');
        }

    }