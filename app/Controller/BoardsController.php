<?php
	class BoardsController extends AppController{
		public $name = 'Boards';

		public $uses = array('Board','User', 'NewUser'); //Userモデルを追加
		/****認証周り*****/
		public $components = array(
            'DebugKit.Toolbar', //デバッグきっと
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User',
                        'fields' => array('username' => 'name','password' => 'password')
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'Boards', 'action' => 'index'),
                //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'Boards', 'action' => 'login'),
                //ログインページのパス
                'loginAction' => array('controller' => 'Boards', 'action' => 'login'),
                //未ログイン時のメッセージ
                'authError' => 'あなたのお名前とパスワードを入力して下さい。',
            )
        );
        //public $layout = "board";
		//public $layout = "jquery";

		public function index(){
            if(!empty($this->request->data['Board']['words'])){
                $WORDS = $this->request->data['Board']['words'];
                $NUM = $this->request->data['Board']['num'];
                $conditions = array("Board.comment LIKE" => "%$WORDS%");
                if (!empty($this->request->data['Board']['sort'])) {
                    $id = $this->request->data['Board']['sort'];
                    if($id == 0){
                        $this->set('data', $this->Board->find('all', array('order' => 'Board.created ASC','conditions' => $conditions, 'limit' => $NUM)));
                    }else{
                        $data = $this->Board->find('all', array('order' => 'Board.created DESC','conditions' => $conditions, 'limit' => $NUM));
                    }
                }else{
                    $data = $this->Board->find('all', array('conditions' => $conditions, 'limit' => $NUM));
                }
                $data = $this->NewUser->getdata($data);
                $this->set('data', $data);
            }else if(!empty($this->request->data['Board']['sort'])){
                $id = $this->request->data['Board']['sort'];
                if($id == 0){
                    $this->set('data', $this->Board->find('all', array('order' => 'Board.created ASC')));
                }else{
                    $data = $this->Board->find('all', array('order' => 'Board.created DESC'));//var_dump($this->Auth->user());
                    $data = $this->NewUser->getdata($data);
                    //$this->set('data', $this->Board->find('all', array('order' => 'Board.created DESC')));
                    $this->set('data', $data);
                }
            }else{
                $data = $this->Board->find('all');//var_dump($this->Auth->user());
                $data = $this->NewUser->getdata($data);
                $this->set('data',$data);
            }
		}

		public function create(){
			if(!empty($this->request->data)){
				$com = $this->request->data;
				$this->set('com', $com);
			}
		}

		public function edit($id){
			if(!empty($this->request->data)){
				$this->set('edt', $this->request->data);
			}else{
				$this->set("data", $this->Board->findById($id));
			}
		}

		public function del($id){
			$this->Board->delete($id);
			$this->redirect(array("action" => "index"));
		}

		public function create2(){
    //         if(empty($this->request->data['Board']['user_id'])){
			// $this->request->data['Board']['user_id'] = $this->Auth->user('id');
            
			$this->Board->db_connect($this->request->data);
			$this->redirect(array("action" => "index"));
		}

		public function beforeFilter(){//login処理の設定
             $this->Auth->allow('login','logout','useradd');//ログインしないで、アクセスできるアクションを登録する
             $this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする 。
             if($this->request->is('mobile')){
                $this->theme = 'jquery';
                $this->layout = 'jquery';
             }
        }

        public function login(){//ログイン
            if($this->Auth->user()){
                $this->redirect(array('action' => 'index'));
            }
            if($this->request->is('post')){//POST送信なら
                if($this->Auth->login()){//ログイン成功なら
                    //$this->Session->delete('Auth.redirect'); //前回ログアウト時のリンクを記録させない
                    $this->redirect($this->Auth->redirect()); //Auth指定のログインページへ移動
                }else{ //ログイン失敗なら
                    $this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
                }
            }
        }
 
        public function logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'login'));
        }
 
        public function useradd(){
            //POST送信なら
            if($this->request->is('post')) {
                $this->User->set($this->request->data);
                if($this->User->validates()){
                    //パスワードとパスチェックの値をハッシュ値変換
                    $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
                    $this->request->data['User']['pass_check'] = AuthComponent::password($this->request->data['User']['pass_check']);
                    //入力したパスワートとパスワードチェックの値が一致
                    if($this->request->data['User']['pass_check'] === $this->request->data['User']['password']){        
                        $this->User->create();//ユーザーの作成
                        $mes = ($this->User->save($this->request->data))? '新規ユーザーを追加しました' : '登録できませんでした。やり直して下さい';
                        $this->Session->setFlash(__($mes));
                        $this->redirect(array('action' => 'login'));//リダイレクト
                    }else{
                        $this->Session->setFlash(__('パスワード確認の値が一致しません．'));
                    }
                }
            }
        }
	}
?>