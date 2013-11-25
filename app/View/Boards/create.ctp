<?php
	if(empty($this->params->data['Board']['comment'])){
		echo '投稿内容';
		echo $this->Form->create();
		echo $this->Form->text('comment');
		echo $this->Form->submit('投稿');
		echo $this->Form->end();
	}else{
		echo $this->Form->create(array(
			'action' => 'create2'
		));
		echo $this->Form->hidden("comment", array("value" => $com["Board"]["comment"]));
		echo $this->Html->tag('h2', $com["Board"]["comment"]);
		echo $this->Html->tag('br');
		echo 'この内容で投稿してもいいですか？';
		echo $this->Form->submit('送信');
		echo $this->Form->end();
	}
?>