<div class="hero-unit">
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('User', array('url' => 'login')); ?>
    <?php echo $this->Form->input('User.name', array('label' => 'ユーザ名')); ?>
    <?php echo $this->Form->input('User.password', array('label' => 'パスワード')); ?>
    <?php echo $this->Form->end('ログイン'); ?>
    <?php echo $this->html->link('Login at Twitter',array('controller' => 'TwLogins', 'action' => 'login')); ?>
    <?php echo $this->html->link('Login at Facebook',array('controller' => 'Fbconnects', 'action' => 'index')); ?>
    <a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>