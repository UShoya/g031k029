<h2>ユーザー登録フォーム</h2>
<?php
	echo $this->Form->create('sign', array(
		'type'=>'post',
		'url'=>'show'
	));

	echo '<br />名字<br />';
	echo $this->Form->text('sign.myozi');

	echo '<br />名前<br />';
	echo $this->Form->text('sign.namae');

	echo '<br />性別<br />';
	echo $this->Form->radio('sign.sex', array(
		"0"=>'男',"1"=>'女'),
		array('legend'=>false,'label'=>true,'value'=>'1'
	));

	echo '<br />学年<br />';
	echo $this->Form->select('sign.grade', array(
		'学部1年','学部2年','学部3年','学部4年'),
		array('value'=>'1'
	));

	echo '<br />好きなもの<br />';
	echo $this->Form->checkbox('sign.c1', array('value'=>'運動','checked'=>true));
	echo $this->Form->label('sign.運動');
	echo $this->Form->checkbox('sign.c2', array('value'=>'漫画','checked'=>false));
	echo $this->Form->label('sign.漫画');
	echo $this->Form->checkbox('sign.c3', array('value'=>'女の子','checked'=>true));
	echo $this->Form->label('sign.女の子');

	echo '<br />コメント<br />';
	echo $this->Form->textarea('sign.comment', array(
		'cols'=>40,'rows'=>3
	));

	echo '<br />パスワード<br />';
	echo $this->Form->text('sign.password', array(
		'type'=>'password'
	));
	echo $this->Form->hidden('sign.time', array(
		'value'=>date("Y/m/d/H:i:s")
	));

	echo $this->Form->submit();
	echo $this->Form->end();
?>