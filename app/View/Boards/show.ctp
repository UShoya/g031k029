<?php
	echo $this->Board->create('com', array(
			'type'=>'post',
			'url'=>'index'
	));

	echo '<h2>'.$data['com'].'</h2>';
	この内容で投稿してよろしいですか？

	echo $this->Board->submit('確定する');
	echo $this->Board->end();

?>