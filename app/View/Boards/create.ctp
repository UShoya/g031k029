<?php
	echo $this->Html->tag('h2', '投稿ページ');
	echo $this->Html->tag('br');

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
		//echo $this->Form->hidden("user_id", array("value" => $com["Board"]["user_id"]));
		//echo $this->Form->hidden("id", array("value" => $com["Board"]["user_id"]));
		if(!empty($user["NewUser"]["tw_id"])){
			//$this->User->save($user["NewUser"]["tw_id"]);
			$com["Board"]["user_id"]=$user["NewUser"]["tw_id"];
			//var_dump($user);
		}else{
			$com["Board"]["user_id"]=$user["id"];
		}
		//var_dump($com);
		echo $this->Form->hidden("user_id", array("value" => $com["Board"]["user_id"]));
		echo $this->Html->tag('h2', $com["Board"]["comment"]);
		echo $this->Html->tag('br');
		echo 'この内容で投稿してもいいですか？';
		echo $this->Form->submit('送信');
		echo $this->Form->end();
	}
?>