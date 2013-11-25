<?php
	echo $this->Html->tag('h2', 'コメント編集');
	echo $this->Html->tag('br');

	if(!empty($data)){
		echo $this->Form->create();
		echo $this->Form->text('comment', array("value" => $data["Board"]["comment"]));
		echo $this->Form->hidden("id", array("value" => $data["Board"]["id"]));
		echo $this->Form->submit('送信');
		echo $this->Form->end();
	}else{
		echo $this->Form->create(array(
			'action' => 'create2'
		));
		echo $this->Html->tag('h2', $edt["Board"]["comment"]);
		echo $this->Html->tag('br');
		echo $this->Form->hidden('comment', array("value" => $edt["Board"]["comment"]));
		echo $this->Form->hidden("id", array("value" => $edt["Board"]["id"]));
		echo 'この内容で編集してもいいですか？';
		echo $this->Form->submit('送信');
		echo $this->Form->end();
	}