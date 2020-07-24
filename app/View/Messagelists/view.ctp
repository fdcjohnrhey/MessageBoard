<div class="messagelists view">
<h2><?php echo __('Messagelist'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($messagelist['Messagelist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($messagelist['User']['name'], array('controller' => 'users', 'action' => 'view', $messagelist['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message Id'); ?></dt>
		<dd>
			<?php echo h($messagelist['Messagelist']['message_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To Id'); ?></dt>
		<dd>
			<?php echo h($messagelist['Messagelist']['to_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Id'); ?></dt>
		<dd>
			<?php echo h($messagelist['Messagelist']['from_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Messagelist'), array('action' => 'edit', $messagelist['Messagelist']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Messagelist'), array('action' => 'delete', $messagelist['Messagelist']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $messagelist['Messagelist']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Messagelists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Messagelist'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($messagelist['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($messagelist['Message'] as $message): ?>
		<tr>
			<td><?php echo $message['id']; ?></td>
			<td><?php echo $message['content']; ?></td>
			<td><?php echo $message['created']; ?></td>
			<td><?php echo $message['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messages', 'action' => 'view', $message['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messages', 'action' => 'delete', $message['id']), array('confirm' => __('Are you sure you want to delete # %s?', $message['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
