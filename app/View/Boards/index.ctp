<?php 
	//debug($data); 
	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
    echo $this->Html->tag('br');
    echo $this->Html->tag('br');
    echo $this->Form->create();
    echo $this->Form->input('Board.words',array('label'=>'検索ワード')); 
    echo $this->Form->input('Board.num',array('label'=>'検索件数')); 
    echo $this->Form->select('Board.sort', array('0'=>'古い順','1'=>'新しい順'));
    echo $this->Form->end('検索');
    echo $this->Html->tag('br');
    echo $this->Html->tag('br');
    echo $this->Html->link('ログアウト', array('controller' => 'Boards', 'action' => 'logout'));
	echo $this->Html->tag('br');
    echo $this->Html->tag('br');
	//echo $this->element('showboard',array('data' => $data, 'mes' => 'こんにちは'));
    foreach ($data as $key => $value) {
        if(!empty($value["Board"]["comment"])){
            echo $value["Board"]["id"].':';
            echo $value["Board"]["comment"].' ';
            if (!empty($value["User"]["name"]))
                echo $value["User"]["name"].'/';
            else
                echo $value["User"]["username"].'/';    
            if (!empty($value["User"]["email"]))
                echo $value["User"]["email"].'/';
            echo $value["Board"]["created"].' ';
        }
        //var_dump($user);
        if (empty($user['id']))
            $user_id = $user['NewUser']["tw_id"];
        else
            $user_id = $user["id"];
        if($value["Board"]["user_id"] == $user_id){
            echo $this->Html->link('編集', array(
                    'action' => 'edit',
                    $value["Board"]["id"]
                )).'/';
            echo $this->Html->link('削除', array(
                    'action' => 'del',
                    $value["Board"]["id"]
                ));
            echo $this->Html->tag('br');
        }else{
            echo $this->Html->tag('br');
        }
    }
?>