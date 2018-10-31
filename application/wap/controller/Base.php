<?php
namespace app\wap\controller;
use think\Controller;
use think\Session;

class Base extends Controller {
    
    public function _initialize(){
        parent::_initialize();
        if (!Session::has("user_name") && !Session::has("user_id")) {
            $this->redirect(url('login/index'));
        }
        
        $user_id = session('user_id');
        $this->userinfo = db('users')->where(['id' => $user_id])->find();
        $this->assign('userinfo',$this->userinfo);
    }
    
}