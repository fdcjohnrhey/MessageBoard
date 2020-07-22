
<div style="float: right;">
<?php
	if(AuthComponent::user()){
		echo $this->Html->link('Profile',array('controller'=>'users','action'=>'index'));
		echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'));
	}else{
		echo $this->Html->link('Login',array('controller'=>'users', 'action'=>'login'));
	}
?>
</div>
<h2>Register</h2>

<?php
	echo $this->Form->create();
	echo $this->Form->input('name');
	echo $this->Form->input('email');
	echo $this->Form->input('password');
	echo $this->Form->input('confirm_password',array('type'=>'password'));
	echo $this->Form->end('Register');

?>
