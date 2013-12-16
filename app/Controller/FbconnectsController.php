<?php
//facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));
 
class FbconnectsController extends AppController {
    public $name = 'Fbconnects';
    public $uses = array('NewUser');
 	public $components = array(
             'DebugKit.Toolbar', //デバッグきっと
             'Auth' => array( //ログイン機能を利用する
                 'authenticate' => array(
                     'Form' => array(
                         'userModel' => 'User'
                     )
                 ),
                 //ログイン後の移動先
                 'loginRedirect' => array('controller' => 'Boards', 'action' => 'index'),
                 //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'Boards', 'action' => 'logout'),
                 //ログインページのパス
                'loginAction' => array('controller' => 'Boards', 'action' => 'index'),
                 //未ログイン時のメッセージ
                'authError' => 'あなたのお名前とパスワードを入力して下さい。',
            )
    );
    function index(){}
 
    function showdata(){//トップページ
        $facebook = $this->createFacebook(); //セッション切れ対策 (?)
        $myFbData = $this->Session->read('mydata');//facebookのデータ
        //$myFbData_kana = $this->Session->read('fbdata_kana'); //フリガナ
        //pr($myFbData_kana); //フリガナデータ表示
        pr($myFbData);//表示
        //$this->fbpost("hello world");//facebookに投稿
    }

 	public function beforeFilter(){//login処理の設定
        $this->Auth->allow('index', 'facebook', 'fbpost', 'createFacebook');
        $this->set('user',$this->Auth->user('NewUser')); // ctpで$userを使えるようにする 。
        if($this->request->is('mobile')){
                $this->theme = 'jquery';
                $this->layout = 'jquery';
             }
    }

    public function facebook(){//facebookの認証処理部分
        $this->autoRender = false;
        $this->facebook = $this->createFacebook();
        $user = $this->facebook->getUser();//ユーザ情報取得
        if($user){//認証後
            $me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));//ユーザ情報を日本語で取得
            $this->Session->write('mydata',$me);//fbデータをセッションに保存
            //フリガナを取得する．
            //$me_kana = $this->facebook->api('/fql?q=SELECT+first_name%2C+sort_first_name%2C+last_name%2C+sort_last_name%2Cname+FROM+user+WHERE+uid+%3D+'.$me['id'].'&locale=ja_JP');//ふりがな
            //if(!empty($me_kana)){//フリガナ設定をしているユーザのみ
            // mb_convert_variables('UTF-8', 'auto', $me_kana);
            // $this->Session->write('fbdata_kana',$me_kana);//フリガナデータをセッションに保存
        //}
            $data = $this->NewUser->signinfb($this->Session->read('mydata'));
 			if ($this->Auth->login($data))
                return $this->redirect($this->Auth->redirect());
        }else{//認証前
            $url = $this->facebook->getLoginUrl(array(
            'scope' => 'email,publish_stream,user_birthday'
            ,'canvas' => 1,'fbconnect' => 0));
            $this->redirect($url);
        }
    }
 
    private function createFacebook() {//appID, secretを記述
        return new Facebook(array(
            'appId' => '775698135779387',
            'secret' => '290a50d4875a93dbabdf0206e509cafc'
        ));
    }
 
    public function fbpost($postData) {//facebookのwallにpostする処理
        $facebook = $this->createFacebook();
        $attachment = array(
            'access_token' => $facebook->getAccessToken(), //access_token入手
            'message' => $postData,
            'name' => "test",
            'link' => "http://twitter.com/softboy18",
            'description' => "test",
        );
        $facebook->api('/me/feed', 'POST', $attachment);
    }
}
?>