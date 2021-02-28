<?php
    $root=$_SERVER['DOCUMENT_ROOT'];

    require_once($root .'/helpers/connection.php');


    class UserDto
    {
        private $db;

        public function __construct(){
            $this->db = connect();
        }
        public function findUser($email){
            $searchResult =  $this->db->searchTable('users' , 'Email' , $email);
            if(count($searchResult) > 0){
                return $searchResult[0];
            }
            else return false;
        }

        public function editUser($email , $password , $notes , $tbd , $websites , $images){
            $userToEdit = $this->findUser($email);
            if($userToEdit != false){
                $newUser = Array(
                    "Email" => $userToEdit->email,
                    "Password" => $this->hashUserPassword($password),
                    "Websites" => $websites,
                    "TBD" => $tbd,
                    "Notes" => $notes,
                    "image" => $images
                );
                $this->db->editRow("users" , "Email" , $userToEdit->email , $newUser);
                return true;
            }
            return false;
        }

        public function createUser($email , $password , $notes , $tbd , $websites , $images){
            $userToCheck = $this->findUser($email);
            //If a user exist with the same email
            if($userToCheck == false){
                $newUser = Array(
                    "Email" => $email,
                    "Password" => $this->hashUserPassword($password),
                    "Websites" => $websites,
                    "TBD" => $tbd,
                    "Notes" => $notes,
                    "image" => $images
                );
                $this->db->createRow("users" , $newUser);
                return true;
            }
            return false;
        }

        private function hashUserPassword($password){
            return password_hash($password , PASSWORD_DEFAULT);
        }
    }