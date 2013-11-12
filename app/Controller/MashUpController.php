<?php
	class MashupController extends AppController{
		public $name = "Mashup";
		public $components = array('DebugKit.Toolbar');
		public function index(){
			$result = $this->Mashup->api();
			$this->set("result",$result);
		}
	}
?>