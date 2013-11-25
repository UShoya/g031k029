<?php
	class BoardsController extends AppController{
		public $name = 'Boards';
		public $uses = array('Board');
		public $components = array('DebugKit.Toolbar');
		public $layout = "board";

		public function index(){
			$this->set('data',$this->Board->find('all'));
		}

		public function create(){
			if(!empty($this->request->data)){
				$com = $this->request->data;
				$this->set('com', $com);
			}
		}

		public function edit($id){
			if(!empty($this->request->data)){
				$this->set('edt', $this->request->data);
			}else{
				$this->set("data", $this->Board->findById($id));
			}
		}

		public function del($id){
			$this->Board->delete($id);
			$this->redirect(array("action" => "index"));
		}

		public function create2(){
			$this->Board->db_connect($this->request->data);
			$this->redirect(array("action" => "index"));
		}
	}
?>