<?php

namespace controllers;

use lib\mvc\controller\basecontroller;
use models\itemsmodel;

class home extends BaseController {
    protected function index() {
        $this->titlePage = "Home";
        $this->alias = "";
        $this->controllerName = "Home";
        $viewModel = Itemsmodel::getItems("");
        $this->RenderView($viewModel,'public');
    }
}
