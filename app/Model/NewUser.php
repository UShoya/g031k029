<?php
    class NewUser extends Model{
        public $name = 'NewUser';
        //var $primaryKey = 'tw_id';
 
        var $validate = array(
            'tw_id' => array(
                'rule' => 'isUnique', //重複登録回避
                'message' => '重複です'
            ),
            'username' => array(
                'rule' => 'isUnique', //重複登録回避
                'message' => '重複です'
            ),
            'email' => array(
                'rule' => 'isUnique', //重複登録回避
                'message' => '重複です'
            )
        );
 
        //新規登録＆ログイン
        public function signin($token){
            //アクセストークンを正しく取得できなかった場合の処理
            if(is_string($token))return; //エラー
 
            $data['tw_id'] = $token['user_id'];
            $data['username'] = $token['screen_name'];
            $data['password'] = Security::hash($token['oauth_token']);
            //$data['oauth_token'] = Security::hash($token['oauth_token']);
            //$data['oauth_token_secret'] = Security::hash($token['oauth_token_secret']);

            //バリデーションチェックでエラーがなければ、新規登録
            if($this->validates())$this->save($data);
            return $data; //ログイン情報
        }

        public function signinfb($token){

            //$count = $this->find('count');
                //アクセストークンを正しく取得できなかった場合の処理
            if(is_string($token))return; //エラー
                $data['username'] = $token['name'];
                $data['email'] = $token['email'];
                //$data['id'] = $count+1;
            //バリデーションチェックでエラーがなければ、新規登録
                //var_dump($data);
            if($this->validates()){
                $this->create();
                $this->save($data);
            }
            $data = $this->find('first', array('conditions' => array('username' => $data['username'], 'email' => $data['email'])));
                // foreach ($data as $key => $value) {
                // if (empty($value['User']['id'])){
                //     $data2 = $this->find('first', array('conditions' => array('NewUser.id' => $value['Board']['user_id'])));
                //     if (!empty($data2)){
                //         $value['User'] = $data2['NewUser'];
                //     $data[$key]['User'] = $value['User'];
                //     }  
                // }
                return $data; //ログイン情報
                //var_dump($data);
        }
        public function getdata($data){
            foreach ($data as $key => $value) {
                if (empty($value['User']['id'])){
                    $data2 = $this->find('first', array('conditions' => array('NewUser.tw_id' => $value['Board']['user_id'])));
                    if (empty($data2)){ // TwitterがだめならFB
                        $data2 = $this->find('first', array('conditions' => array('NewUser.id' => $value['Board']['user_id'])));
                    }
                    // if(!empty($userData["NewUser"]["tw_id"])){ // Twitter
                    //     $data2 = $this->find('first', array('conditions' => array('NewUser.tw_id' => $value['Board']['user_id'])));
                    // }else if(!empty($userData["NewUser"]["id"])){ // FB
                    //     $data2 = $this->find('first', array('conditions' => array('NewUser.id' => $value['Board']['user_id'])));
                    // }if ($key == 11) var_dump($value);
                    $value['User'] = $data2['NewUser'];
                    $data[$key]['User'] = $value['User'];
                }
            }
            return $data;
        }   
    }
?>