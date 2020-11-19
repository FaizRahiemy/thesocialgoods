<?php

namespace controllers;

use lib\mvc\controller\basecontroller;
use models\itemsmodel;

class items extends BaseController {
    protected function view() {
        $this->id = explode('-', $this->id);
        $this->id = $this->id[0];
        $viewModel = ItemsModel::getItems("WHERE id=".$this->id);
        $this->titlePage = $viewModel[0]->name;
        $this->controllerName = "Items";
        $this->RenderView($viewModel,'public');
    }
    
    public function getTotalCoretan(){
        return CoretanModel::getTotal("");
    }
    
    protected function admin() {
        $viewModel = ItemsModel::getItems("");
        $this->titlePage = "Edit Items";
        $this->controllerName = "Items";
        $this->RenderView($viewModel,'admins');
    }
    
    protected function edit() {
        $this->id = explode('-', $this->id);
        $this->id = $this->id[0];
        $viewModel = ItemsModel::getItems("WHERE id=".$this->id);
        $this->titlePage = $viewModel[0]->name;
        $this->controllerName = "Items";
        $this->RenderView($viewModel,'admins');
    }
    
    protected function new() {
        $viewModel = ItemsModel::getItems("");
        $this->titlePage = "Add New Items";
        $this->controllerName = "Items";
        $this->RenderView($viewModel,'admins');
    }
}
