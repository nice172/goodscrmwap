<?php
namespace app\wap\controller;

class Index extends Base {
    
    public function index(){
        
        return $this->fetch();
    }
    
}