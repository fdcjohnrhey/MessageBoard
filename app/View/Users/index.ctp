<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('birthdate'); ?></th>
			<th><?php echo $this->Paginator->sort('hubby'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login_time'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('created_ip'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_ip'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['image']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['birthdate']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['hubby']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_login_time']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created_ip']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified_ip']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div style="float: right;">
<?php
	if(AuthComponent::user()){
		echo $this->Html->link('Edit Profile',array('controller'=>'users','action'=>'edit',$currentUser['User']['id']));
		echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'));
	}else{
		echo $this->Html->link('Login',array('controller'=>'users', 'action'=>'login'));
	}
?>
</div>
<div class="actions">
	<h3><?php echo __('Profile'); ?></h3>
	<?php echo $this->Html->image($currentUser['User']['image'], array('alt' =>'test', 'border' => '0','width'=>'200')); ?>
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
		<li>Birthdate: <?php echo $currentUser['User']['birthdate'] ?></li>
		<li>Joined: <?php echo $currentUser['User']['created'] ?></li>
		<li>Last Login: <?php echo $currentUser['User']['last_login_time'] ?></li>
		<li>Hobby:</li>
		<li><?php echo $currentUser['User']['hubby'] ?></li>
	</ul>
</div>

