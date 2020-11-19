<?php

namespace controllers;

use lib\mvc\controller\basecontroller;
use models\categoriesmodel;
use models\itemsmodel;

class categories extends BaseController {
    protected function view() {
        $this->id = $this->id;
        $viewModel = CategoriesModel::getCategories("WHERE name='".$this->id."'");
        $this->titlePage = $viewModel[0]->name;
        $this->alias = $viewModel[0]->name;
        $this->controllerName = "Categories";
        $this->RenderView($viewModel,'public');
    }
    
    protected function edit() {
        $this->titlePage = "Faiz?";
        $this->alias = "faiz";
        $this->controllerName = "Faiz?";
        $viewModel = Page::getPage();
        $this->RenderView($viewModel,'admins');
    }
    
    public function getItems($scope){
        $items = CategoriesModel::getItems($scope);
        return items;
    }
}
