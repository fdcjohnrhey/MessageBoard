<div class="users index" style="width: 50%;">
	<div style="float: right;">
	<?php
		if(AuthComponent::user()){
			echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'));
		}else{
			echo $this->Html->link('Login',array('controller'=>'users', 'action'=>'login'));
		}
	?>
	</div>
	<?php echo $this->Html->link('Add New Messages',array('controller'=>'messages','action'=>'add'));?>	
	<br>
	<?php echo $this->Html->link('See Message List',array('controller'=>'messagelists','action'=>'index',$currentUser['User']['id']));?>
	
	
</div>

<div class="actions" style="width: 30%;">
	<ul style="display: flex;">
		<li>
			<h3><?php echo __('Profile'); ?></h3>
		</li>
		
	</ul>	
	
	<?php echo $this->Html->image($currentUser['User']['image'], array('border' => '0','width'=>'200')); ?>
	<ul>
		<?php
			switch($currentUser['User']['gender']){
				case 1;
					$gender='Male';
					break;
				case 2;
					$gender='Female';
					break;
				default;
					$gender='None';
			}
		?>
		<li><?php echo $currentUser['User']['name'] ?></li>
		<li>Gender: <?php echo $gender; ?></li>
		<li>Birthdate: <?php echo  date("F d, Y ",  strtotime($currentUser['User']['birthdate']));?></li>
		<li>Joined: <?php echo $currentUser['User']['created'] ?></li>
		<li>Last Login: <?php echo $currentUser['User']['last_login_time'] ?></li>
		<li>Hobby:</li>
		<li><textarea style="height: 200px;font-size: 90%;" readonly><?php echo $currentUser['User']['hubby'] ?></textarea></li>
		<li style='width: 40%;'>
			<?php echo $this->Html->link('Edit Profile',array('controller'=>'users','action'=>'edit',$currentUser['User']['id']));?>
		</li>
	</ul>
</div>

