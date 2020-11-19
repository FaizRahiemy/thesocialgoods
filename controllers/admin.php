<?php

namespace controllers;

use lib\mvc\controller\basecontroller;
use models\pengguna;
use models\information;
use models\coretanmodel;
use models\kreasimodel;
use models\bisnismodel;

class admin extends BaseController {
    protected function index() {
        $this->titlePage = "Admin Home";
        $this->alias = "admin";
        $this->controllerName = "Home";
        if (isset($_SESSION['username'])){
            $viewModel = Pengguna::getPengguna("WHERE username='".$_SESSION['username']."'");
        }else{
            $viewModel = "";
        }
        $this->RenderView($viewModel,'admin');
    }
}
