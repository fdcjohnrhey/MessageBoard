
<div class="messagelists index">
	<h2><?php echo __('Messagelists'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('id'); ?></th>
		<th><?php echo $this->Paginator->sort('message_id'); ?></th>
		<th><?php echo $this->Paginator->sort('to_id'); ?></th>
		<th><?php echo $this->Paginator->sort('from_id'); ?></th>
		<th><?php echo $this->Paginator->sort('modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($list as $messagelist): ?>
	<tr>
		<td><?php echo h($messagelist['Messagelist']['id']); ?>&nbsp;</td>
		<td><?php echo h($messagelist['Message']['content']); ?>&nbsp;</td>
		<?php foreach ($users as $user): ?>
			<?php if($user['User']['id'] == $messagelist['Messagelist']['to_id']): ?>
				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<?php endif;?>
		<?php endforeach; ?>		
		<td><?php echo h($messagelist['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($messagelist['Message']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $messagelist['Messagelist']['chat_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $messagelist['Messagelist']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $messagelist['Messagelist']['id']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link('Add New Message',array('controller'=>'messages','action'=>'add'));?>	</li>
		<li><?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Message List'), array('controller' => 'messagelists', 'action' => 'index',$currentUser['User']['id']));?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
