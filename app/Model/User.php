<?php
	class User extends Model{
		public $name = 'User';
		
		public $validate = array(
            'name' => array(
            	'custom' => array(
	                'rule' => array('custom', '/^[a-zA-Z]+$/'),
	                'required' => true,
	                'alloEmpty' => false,
	                'message' => 'ユーザ名は半角英字のみです'
            		),
            	'unique' => array(
            		'rule' => 'isUnique',
            		'message' => 'そのユーザ名は既に使用されています'
            		)
            	),
            'email' => array(
                'rule' => 'email',
                'required' => true,
                'alloEmpty' => false,
                'message' => 'メールアドレスの形式で入力して下さい'
            	),
            'password' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'alloEmpty' => false,
                'message' => 'パスワードを入力して下さい'
				),
            'pass_check' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'alloEmpty' => false,
                'message' => 'パスワードを入力して下さい'
				)
        );
	}
?>