

<tbody id="convo-body">
	<?php foreach ($messageList as $messages): ?>
	<tr>
		<td><?php echo h($messages['Message']['content']); ?>&nbsp;</td>
		<td><?php echo h($messages['Message']['created']); ?>&nbsp;</td>
		<?php foreach ($users as $user): ?>
			<?php if($user['User']['id'] == $messages['Messagelist']['from_id']): ?>
				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<?php endif;?>
		<?php endforeach; ?>
		<td class="actions" style="width: 5%;">
			<?php echo $this->Js->link('Delete', array('action' => 'delete', $messages['Messagelist']['id']),array('escape' => false, 'class'=>'confirm-delete','id'=>'confirm-delete'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
