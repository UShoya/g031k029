<?php
class Join extends Model{
	public $name = 'Join';
	public $useTable = false;

	public function handan($data){
		$result = array();
		if($data['sex'] == '0'){
			$result['sex'] = "男";
		}elseif($data['sex'] == '1'){
			$result['sex'] = "女";
		}
		
		$result['choise'] = "";
		if(!empty($data['c1'])){
			$result['choise'].= $data['c1'];
		}
		if(!empty($data['c2'])){
			$result['choise'].= $data['c2'];
		}
		if(!empty($data['c3'])){
			$result['choise'].= $data['c3'];
		}

		$result['name'] = "";
		$result['name'].= $data['myozi'];
		$result['name'].= $data['namae'];
		$result['grade']= $data['grade'];
		$result['comment']= $data['comment'];
		$result['password']= $data['password'];
		$result['time']= $data['time'];

		return $result;
	}
}
?>