<?php

namespace lib\mvc\controller;

use models\itemsmodel;
use models\categoriesmodel;
use models\pengguna;

abstract class basecontroller {
    protected $urlParams;
    protected $action;
    protected $id;
    public $titlePage;
    public $alias;
    public $metakey = "the,social,goods,Creating,Social,Life.";
    public $metadesc = "Creating Goods For Good Social Life.";
    public $controllerName;
//    public $baseUrl = "http://localhost/faiz/";
    public $baseUrl = "http://localhost/thesocialgoodstsg/";
    public $siteCaptcha = "6LcePAATAAAAABjXaTsy7gwcbnbaF5XgJKwjSNwT";
    public $secretCaptcha = "6Ldq0wsUAAAAAMhEn6VjA0hc1G1jM0TyCz_YQ29x";

    public function __construct($action, $urlParams, $id) {
        $this->action = $action;
        $this->urlParams = $urlParams;
        $this->id = $id;
        @ob_start();
        if(session_status()!=PHP_SESSION_ACTIVE) session_start();
        //DATE
        date_default_timezone_set("Asia/Jakarta");
    }

    public function ExecuteAction() {
        return $this->{$this->action}();
    }

    protected function RenderView($viewModel, $type, $fullView = true) {
        $classData = explode("\\", get_class($this));
        $className = end($classData);
        
        if ($type == "admin"){
            $content = __DIR__ . "/../../../views/" . $className . "/" . $this->action . ".php";
            if ($fullView) {
                require __DIR__ . "/../../../views/admin/layout/layout.php";
            } else {
                require $content;
            }
        }else if($type == "admins"){
            $content = __DIR__ . "/../../../views/admin/" . $className . "/" . $this->action . ".php";
            if ($fullView) {
                require __DIR__ . "/../../../views/admin/layout/layout.php";
            } else {
                require $content;
            }
        }else{
            $content = __DIR__ . "/../../../views/public/" . $className . "/" . $this->action . ".php";
            if ($fullView) {
                require __DIR__ . "/../../../views/public/layout/layout.php";
            } else {
                require $content;
            }
        }
    }
    
    public function getItems($scope){
        $items = ItemsModel::getItems($scope);
        return $items;
    }
    
    public function addItems($name,$desc,$target_file,$price){
        $query = ItemsModel::addItems($name,$desc,$target_file,$price);
    }
    
    public function getCategories($scope){
        $items = categoriesmodel::getCategories($scope);
        return $items;
    }
    
    public function getPengguna($scope){
        $user = Pengguna::getPengguna($scope);
        return $user;
    }
} 