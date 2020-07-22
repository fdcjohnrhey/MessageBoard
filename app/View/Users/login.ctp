
<div style="float: right;">
<?php
	if(AuthComponent::user()){
		echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'));
	}else{
		echo $this->Html->link('Register',array('controller'=>'users', 'action'=>'add'));
	}
?>
</div>

<h2>Login</h2>

<?php
	echo $this->Form->create();
	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->end('Login');

?>
