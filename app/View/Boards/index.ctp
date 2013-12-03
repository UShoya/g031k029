<?php 
	//debug($data); 
	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
    echo $this->Html->tag('br');
    echo $this->Html->tag('br');
    echo $this->Form->create();
    echo $this->Form->input('Board.words',array('label'=>'検索ワード')); 
    echo $this->Form->input('Board.num',array('label'=>'検索件数')); 
    echo $this->Form->select('Board.sort', array('0'=>'昇順','1'=>'降順'));
    echo $this->Form->end('検索');
    echo $this->Html->tag('br');
    echo $this->Html->tag('br');
    echo $this->Html->link('ログアウト', array('controller' => 'Boards', 'action' => 'logout'));
	echo $this->Html->tag('br');
    echo $this->Html->tag('br');
	//echo $this->element('showboard',array('data' => $data, 'mes' => 'こんにちは'));
    //var_dump($user);
    //var_dump($data);
    foreach ($data as $key => $value) {
        if(!empty($value["Board"]["comment"])){
            echo $value["Board"]["id"].':';
            echo $value["Board"]["comment"].' ';
            echo $value["User"]["name"].'/';
            echo $value["User"]["email"].'/';
            echo $value["Board"]["created"].' ';
        }
        if($value["Board"]["user_id"] == $user["id"]){
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