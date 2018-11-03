<?php

 namespace app\admin\controller;

 use think\Controller;
 use think\Session;

 class Base extends Controller {
     
     protected $userinfo;
     protected $empty = '<tr><td colspan="20" align="center">当前条件没有查到数据</td></tr>';
     
     public function _initialize(){
         parent::_initialize();
         $request = \think\Request::instance();
         define('MODULE_NAME', $request->module());
         define('CONTROLLER_NAME', $request->controller());
         define('ACTION_NAME', $request->action());
         define('REQUEST_URL', $request->url());
         if ($request->isMobile()){
         	$this->view = $this->view->config('view_path',APP_PATH.MODULE_NAME.'/view/wap/');
         }
         
         if (!Session::has("user_name") && !Session::has("user_id")) {
             $this->redirect("login/index");
         } 
         
         $user_id = session('user_id');
         $this->userinfo = db('users')->where(['id' => $user_id])->find();
         $this->assign('userinfo',$this->userinfo);
         
         if (!in_array($this->userinfo['id'], config('AUTH_CONFIG')['NO_AUTH_USER'])){
             $node = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
             if (!in_array($node, config('AUTH_CONFIG')['NO_AUTH_URL'])){
                 $auth = new \Auth();
                 if(!$auth->check($node, $this->userinfo['id'])){
                     if ($node == strtolower(MODULE_NAME).'/index/index'){
                         Session::clear(); // 清除session值
                         $this->redirect(url('Login/index'));
                     }
                     $this->error('您没有权限访问！');
                 }
             }
         }
         $this->menu();
         $this->assign('empty',$this->empty);
     }

     private function menu(){
     	$URL = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
     	$notAuth = config('AUTH_CONFIG')['NO_AUTH_USER'];
     	$where = array('status' => 1);
     	if (!in_array($this->userinfo['id'], $notAuth)){
     		if (empty($this->userinfo['group_id'])){
     			Session::clear(); // 清除session值
     			$this->error('您没有权限访问！',url('Login/index'));
     		}
     		$auth_group = db('auth_group')->where(['id' => $this->userinfo['group_id']])->find();
     		if (empty($auth_group) || empty($auth_group['rule_pids']) || empty($auth_group['rules'])){
     			Session::clear(); // 清除session值
     			$this->error('您没有权限访问！',url('Login/index'));
     		}
     		if (!$auth_group['status']){
     		    Session::clear(); // 清除session值
     		    $this->error('角色状态已禁用',url('Login/index'));
     		}
     		$rulesID = $auth_group['rule_pids'].','.$auth_group['rules'];
     		$where['id'] = ['in',$rulesID];
     	}
     	$lists = json_decode(session('cache_list'),true);
     	if (empty($lists)){
     	     $lists = db('auth_rule')->where($where)->order('sort asc')->select();
     	     session('cache_list',json_encode($lists));
     	}
     	$parentid = 0;
     	foreach ($lists as $key => $value){
     		if ($value['name'] == $URL && $value['parentid']){
     			$parent = getParent($lists,$value['id']);
     			$parentid = $parent['id'];
     			break;
     		}
     	}
     	$top_menu = array();
     	$current_name = '';
     	$current_pid = 0;
     	if ($parentid){
     		foreach ($lists as $key => $value){
     			if ($value['name'] == $URL){
     				$current_name = $value['title'];
     				$current_pid = $value['parentid'];
     			}
     			if ($value['parentid'] == $parentid){
     				$top_menu[] = array(
     						'node' => $value['name'],
     						'nodeid' => str_replace('/', '-', $value['name']),
     						'title' => $value['title'],
     						'level' => $value['level'],
     						'icon' => $value['css'],
     						'id' => $value['id']
     				);
     			}
     		}
     	}
     	$menu = json_decode(session('left_menu'),true);
     	if (empty($menu)){
         	$node = getChild($lists);
         	foreach ($node as $key => $value){
         		if (empty($value['child'])){
         			$menu[$value['name']] = array(
         					'node' => $value['name'],
         					'nodeid' => str_replace('/', '-', $value['name']),
         					'title' => $value['title'],
         					'level' => $value['level'],
         					'icon' => $value['css'],
         					'id' => $value['id'],
         					'subNode' => array(),
         			);
         		}else{
         			$menu[$value['name']] = array(
         					'node' => $value['name'],
         					'nodeid' => str_replace('/', '-', $value['name']),
         					'title' => $value['title'],
         					'level' => $value['level'],
         					'icon' => $value['css'],
         					'id' => $value['id'],
         					'subNode' => array(),
         			);
         			$subNode = array();
         			foreach ($value['child'] as $childKey => $childValue){
         				$subNode[] = array(
         						'node' => $childValue['name'],
         						'url' => url($childValue['name']),
         						'nodeid' => str_replace('/', '-', $childValue['name']),
         						'icon' => !empty($childValue['css']) ? $childValue['css'] : 'icon-ecs',
         						'title' => $childValue['title'],
         						'level' => $childValue['level'],
         						'id' => $childValue['id'],
         						'parentid' => $childValue['parentid']
         				);
         			}
         			$menu[$value['name']]['subNode'] = $subNode;
         		}
         	}
         	session('left_menu',json_encode($menu));
     	}
     	$this->assign('top_menu',$top_menu);
     	$this->assign('left_URL',$URL);
     	$this->assign('left_menu',$menu);
     	$this->assign('current_title', $current_name);
     	$this->assign('current_pid', $current_pid);
     	$this->assign('left_active',$parentid);
     }
     
     protected function ajaxReturn($data){
         header("Content-Type: application/json; charset=utf-8");
         exit(json($data)->getContent());
     }
     
     public function _empty(){
         if ($this->request->isAjax()){
             $this->error('方法不存在');
         }
         if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
             $this->redirect($_SERVER['HTTP_REFERER']);
             exit;
         }
         $this->error('方法不存在');
     }
     
     public function email(){
     	$type = strtolower($this->request->param('type'));
     	$id = intval($this->request->param('id'));
     	$email = $this->request->param('email');
     	$data['files'] = '';
     	if ($type == 'baojia'){
     		$data['files'] = $this->_createPDF($id,1);
     		$data['email'] = $this->send_email;
     	}elseif ($type == 'order'){
     		
     	}elseif ($type == 'purchase'){
     		$data['files'] = $this->create_pdf($id,1);
     		$data['email'] = $email;
     	}
     	$data['type'] = $type;
     	$data['id'] = $id;
     	$this->assign('data',$data);
     	return $this->fetch('public/email');
     }
     
     public function sendemail(){
         if ($this->request->isAjax()){
             $type = strtolower($this->request->param('type'));
             $id = intval($this->request->param('id'));
             $email = $this->request->param('email');
             $copyto = $this->request->param('copyto');
             $subject = $this->request->param('subject');
             $files = $this->request->param('files');
             $content = $this->request->param('content');
             $email = explode(';', trim($email,';'));
             $copyto = explode(';', trim($copyto,';'));
             if (empty($email)) $this->error('邮箱不能为空');
             if (empty($subject)) $this->error('主题不能为空');
             if(send_email($email,$subject,$files, $content, $copyto)){
                 switch ($type){
                 	case 'baojia':
                 		db('baojia')->where(['id' => $id])->update(['status' => 1,'send_email_time' => time()]);
                 		break;
                 	case 'purchase':
                 		db('purchase')->where(['id' => $id])->setField('status',2);
                 		break;
                 }
                 $this->success('发送成功');
             }
             $this->error('发送失败');
         }
     }
     
     protected function upload_file($subDir='',$type=true){
     	// 获取表单上传文件 例如上传了001.jpg
     	$file = request()->file('file');
     	if (empty($file)){
     		$file = request()->file('Filedata');
     	}
     	if (empty($file)) return [];
     	// 移动到框架应用根目录/public/uploads/ 目录下
     	if (!empty($subDir)) $subDir = DS.$subDir;
     	$ext = ['ext'=>'jpg,png,gif,jpeg,pdf,docx,doc,xlsx,xls,csv'];

     	if (is_array($file)){
     	    $files = [];
     	    foreach ($file as $obj){
     	        $info = $obj->validate($ext)->move(config('UPLOAD_DIR') . $subDir);
     	        if ($info){
     	            $files[] = [
     	                'ext' => $info->getExtension(),
     	                'path' => str_replace('\\', '/', DS . config('UPLOAD_DIR') .$subDir .'/'.$info->getSaveName()),
     	                'oldfilename' => $obj->getInfo('name'),
     	                'filename' => $info->getFilename()
     	            ];
     	        }else{
     	            if($type){
     	            	$this->error($obj->getError());
     	            }else{
     	            	return $obj->getError();
     	            }
     	        }
     	    }
     	    return $files;
     	}else{
     	    $info = $file->validate($ext)->move(config('UPLOAD_DIR') . $subDir);
         	if($info){
         		return [
         				'ext' => $info->getExtension(),
         				'path' => str_replace('\\', '/', DS . config('UPLOAD_DIR') .$subDir .'/'.$info->getSaveName()),
         		    'oldfilename' => $file->getInfo('name'),
         		         'filename' => $info->getFilename()
         		];
         	}else{
         		// 上传失败获取错误信息
         	    if ($type){
         	    	$this->error($file->getError());
         	    }else{
         	    	return $file->getError();
         	    }
         	}
     	}
     }
 }