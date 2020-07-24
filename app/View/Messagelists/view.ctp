
<div class="messagelists view">
<h2>Conversation with <?php echo $convoWith['User']['name']; ?></h2>
<?php echo $this->Form->create('Message',array('controller'=>'messages','action'=>'AddNewMessage')); ?>
	<input type="text" name="content" id="new_message">
	<input type="hidden" name="user_id" id="new_message" value="<?php echo $currentUser['User']['id']; ?>">
	<input type="hidden" name="to_id" id="new_message" value="<?php echo $convoWith['User']['id']; ?>">	
	<input type="hidden" name="from_id" id="new_message" value="<?php echo $currentUser['User']['id']; ?>">	
	
	<!-- <?php echo $this->Js->link('Send', array('controller'=>'messages','action' => 'AddNewMessage'),array('escape' => false, 'id'=>'send_message'));?> -->
<?php echo $this->Form->end(__('Submit')); ?>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
				<th>Message</th>
				<th>Created</th>
				<th>From</th>
				<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($messagelist as $messages): ?>
		<tr>
			<td><?php echo h($messages['Message']['content']); ?>&nbsp;</td>
			<td><?php echo h($messages['Message']['created']); ?>&nbsp;</td>
			<?php foreach ($users as $user): ?>
				<?php if($user['User']['id'] == $messages['Messagelist']['to_id']): ?>
					<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
				<?php endif;?>
			<?php endforeach; ?>
			<td class="actions" style="width: 5%;">
				<?php echo $this->Js->link('Delete', array('action' => 'delete', $messages['Messagelist']['id']),array('escape' => false, 'class'=>'confirm_delete'));?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Message List'), array('controller' => 'messagelists', 'action' => 'index',$currentUser['User']['id']));?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>


<script type="text/javascript">
	$(document).ready(function() { 
		$('.confirm_delete').click(function(){
			var result = confirm('Are you sure you want to delete this?');
			if(result) {
				$(this).closest('tr').fadeOut(2000);
				$.ajax({
					type:"POST",
					url: $(this).attr('href'),
					data:"ajax=1",
					dataType: "json",
					success:function(response){
					}
				});
			}
			return false;
		});

		$('#send_message').click(function(){
			var message = $('#new_message').val();
			var data = {
				'user_id': "",
				'to_id': "<?php echo $convoWith['User']['id']; ?>",
				'from_id': "<?php echo $currentUser['User']['id']; ?>",
				'content': message
			};
			console.log(data);
			$.ajax({
				type:"POST",
				url: $(this).attr('href'),
				data: data,
				dataType: "json",
				success:function(response){
					console.log(response);
				},
				error:function(error){
					console.log(error);
				}
			});
		});
	});
</script>