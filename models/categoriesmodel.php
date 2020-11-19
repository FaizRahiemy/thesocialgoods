<?php

namespace models;

use lib\mvc\model\basemodel;

class categoriesmodel extends basemodel {
    public $id;
    public $name;

    public function __construct($id, $name, $show) {
        $this->id = $id;
        $this->name = $name;
        $this->show = $show;
    }

    public static function getCategories($scope) {
        $query = self::getDB()->prepare("SELECT * FROM `tsg_categories` ".$scope);
        $query->execute();

        $result = array();
        while ($row = $query->fetch()) {
            array_push($result, new categoriesmodel($row["id"], $row["name"], $row["show"]));
        }
        
        return $result;
    }

    public static function insertCategories($scope) {
        $query = self::getDB()->prepare("INSERT INTO `tsg_categories` VALUES (NULL, ".$scope.")");
        $query->execute();
    }
    
    public function getTotal($scope){
        $query = self::getDB()->prepare("SELECT COUNT(id) AS total FROM `tsg_categories` ".$scope);
        $query->execute();
        
        $row = $query->fetch();
        $result = $row['total'];
        
        return $result;
    }
    
    public function getItems($scope){
        $items = ItemsModel::getItems("WHERE categories REGEXP ',".$this->name."' ".$scope);
        return $items;
    }
}
