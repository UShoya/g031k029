<?php
	echo $this->Board->create('com', array(
		'type'=>'post',
		'url'=>'index'
	));

	echo '<br />投稿内容<br />';
	echo $this->Board->text('com');

	echo $this->Board->submit('投稿する');
	echo $this->Board->end();
?>