<?php

class UserModel {

    private $userDb;

    public function __construct() {
        $this->userDb = new PDO('mysql:host=localhost;'.'dbname=dbtp1;charset=utf8', 'root', '');
    }

    public function getUserByEmail($email) {
        $query = $this->userDb->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}
