<?php

namespace lib\mvc\model;

abstract class basemodel {
    public static function getDB() {
        return new \PDO("mysql:host=localhost;dbname=social_goods", "root", "root");
    }
}