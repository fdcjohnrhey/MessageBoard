<div class="chats view">
<h2><?php echo __('Chat'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($chat['Chat']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person1'); ?></dt>
		<dd>
			<?php echo h($chat['Chat']['person1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Person2'); ?></dt>
		<dd>
			<?php echo h($chat['Chat']['person2']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Chat'), array('action' => 'edit', $chat['Chat']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Chat'), array('action' => 'delete', $chat['Chat']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $chat['Chat']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Chats'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Chat'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messagelists'), array('controller' => 'messagelists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Messagelist'), array('controller' => 'messagelists', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Messagelists'); ?></h3>
	<?php if (!empty($chat['Messagelist'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Message Id'); ?></th>
		<th><?php echo __('To Id'); ?></th>
		<th><?php echo __('From Id'); ?></th>
		<th><?php echo __('Chat Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($chat['Messagelist'] as $messagelist): ?>
		<tr>
			<td><?php echo $messagelist['id']; ?></td>
			<td><?php echo $messagelist['user_id']; ?></td>
			<td><?php echo $messagelist['message_id']; ?></td>
			<td><?php echo $messagelist['to_id']; ?></td>
			<td><?php echo $messagelist['from_id']; ?></td>
			<td><?php echo $messagelist['chat_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messagelists', 'action' => 'view', $messagelist['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messagelists', 'action' => 'edit', $messagelist['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messagelists', 'action' => 'delete', $messagelist['id']), array('confirm' => __('Are you sure you want to delete # %s?', $messagelist['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Messagelist'), array('controller' => 'messagelists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
