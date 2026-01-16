<?php
require_once "User.php";

class AuthenticationManager {
    private $users = [];

    public function __construct(){
        $this->users[] = new User("U001", "waed@gmail.com", password_hash("1234", PASSWORD_DEFAULT));
        $this->users[] = new User("U002", "safaa@gmail.com", password_hash("pass", PASSWORD_DEFAULT));
    }

    public function validateCredentials($email, $password){
        $email = trim($email);
        foreach($this->users as $user){
            if($user->getEmail() === $email && password_verify($password, $user->getPasswordHash())){
                return $user;
            }
        }
        return null;
    }
}
?>