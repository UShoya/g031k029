<h2>この情報で登録して大丈夫ですか？</h2>
<?php
	echo $this->Form->create('sign', array(
			'type'=>'post',
			'url'=>'index'
	));

	echo '名前：'.$data['name'].'<br />';
	echo '性別：'.$data['sex'].'<br />';
	echo '学年：'.$data['grade'].'<br />';
	echo '好きなもの：'.$data['choise'].'<br />';
	echo 'コメント：'.$data['comment'].'<br />';
	echo 'パスワード：'.$data['password'].'<br />';
	echo '登録時間：'.$data['time'].'<br />';

	echo $this->Form->submit('登録');
	echo $this->Form->end();
?>