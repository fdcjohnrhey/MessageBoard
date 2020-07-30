<div class="chats form">
<?php echo $this->Form->create('Chat'); ?>
	<fieldset>
		<legend><?php echo __('Edit Chat'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('person1');
		echo $this->Form->input('person2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Chat.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Chat.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Chats'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Messagelists'), array('controller' => 'messagelists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Messagelist'), array('controller' => 'messagelists', 'action' => 'add')); ?> </li>
	</ul>
</div>
