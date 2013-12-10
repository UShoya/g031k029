<?php
	class Board extends Model{
		public $name = 'Board';
		public $belongsTo = array(
			'User'=> array(
				'className'    => 'User',
				'foreignKey'  => 'user_id',

			), 
			// 'NewUser' => array(
			// 	'className'    => 'NewUser',
			// 	'foreignKey'  => 'user_id',
			// )
		);
		//public $useTable = false;
		
		public function db_connect($com){
			$this->save($com);
		}

		public function del($data){
			$this->delete($data["Board"]["id"]);
		}
	}
?>