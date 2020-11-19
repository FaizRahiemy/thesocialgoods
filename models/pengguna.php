<?php

namespace models;

use lib\mvc\model\basemodel;

class pengguna extends basemodel {
    public $id;
    public $username;
    public $name;
    public $email;
    public $password;

    public function __construct($id, $username, $name, $email, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function getPengguna($scope) {
        $query = self::getDB()->prepare("SELECT * FROM `tsg_user` ".$scope);
        $query->execute();

        $result = array();
        while ($row = $query->fetch()) {
            array_push($result, new pengguna($row["id"], $row["username"], $row["name"], $row["email"], $row["password"]));
        }

        return $result;
    }
}
