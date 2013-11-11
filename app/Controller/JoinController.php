<?php
class JoinController extends AppController{
	public $name = "Join";
	public $components = array('DebugKit.Toolbar');

	public function index(){
		
	}

	public function show(){
		if($this->request->is('POST')){
			if(!empty($this->request->data['sign'])){
				$data = $this->Join->handan($this->request->data['sign']);
				$this->set('data',$data);
			}
		}
	}

	public function input(){
		
	}
}