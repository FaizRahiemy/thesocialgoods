<?php

namespace models;

use lib\mvc\model\basemodel;

class itemsmodel extends basemodel {
    public $id;
    public $name;
    public $desc;
    public $img;
    public $price;
    public $date;

    public function __construct($id, $name, $desc, $img, $price, $categories, $date) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->img = $img;
        $this->price = $price;
        $this->categories = $categories;
        $this->date = $date;
    }

    public static function getItems($scope) {
        $query = self::getDB()->prepare("SELECT * FROM `tsg_items` ".$scope);
        $query->execute();
        
        $result = array();
        while ($row = $query->fetch()) {
            array_push($result, new itemsmodel($row["id"], $row["name"], $row["descr"], $row["img"], $row["price"], $row["categories"], $row["date"]));
        }
        
        return $result;
    }
    
    public function getTotal($scope){
        $query = self::getDB()->prepare("SELECT COUNT(id) AS total FROM `items` ".$scope);
        $query->execute();
        
        $row = $query->fetch();
        $result = $row['total'];
        
        return $result;
    }
    
    public function editItems($name,$desc,$target_file,$price){
        $query = self::getDB()->prepare("UPDATE tsg_items SET name = :name, descr = :descr, img= :img, price = :price WHERE id=".$this->id);
        $query->execute(array(
            ':name' => $name,
            ':descr' => $desc,
            ':img' => $target_file,
            ':price' => $price
        ));
        $query->execute();
    }
    
    public function deleteItems(){
        $query = self::getDB()->prepare("DELETE FROM tsg_items WHERE id=".$this->id);
        $query->execute();
    }
    
    public function addItems($name,$desc,$target_file,$price){
        $query = self::getDB()->prepare("INSERT INTO tsg_items VALUES(null, :name, :desc, :img, :price, ',Men,Women,Sale,Features,', NOW())");
        $query->execute(array(
            ':name' => $name,
            ':desc' => $desc,
            ':img' => $target_file,
            ':price' => $price
        ));
    }
}
