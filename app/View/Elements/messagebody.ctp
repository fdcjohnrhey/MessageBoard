

<tbody id="convoBody">
	<?php foreach ($messagelist as $messages): ?>
	<tr>
		<td><?php echo h($messages['Message']['content']); ?>&nbsp;</td>
		<td><?php echo h($messages['Message']['created']); ?>&nbsp;</td>
		<?php foreach ($users as $user): ?>
			<?php if($user['User']['id'] == $messages['Messagelist']['from_id']): ?>
				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<?php endif;?>
		<?php endforeach; ?>
		<td class="actions" style="width: 5%;">
			<?php echo $this->Js->link('Delete', array('action' => 'delete', $messages['Messagelist']['id']),array('escape' => false, 'class'=>'confirm_delete','id'=>'confirm_delete'));?>
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
<script type="text/javascript">
	"use strict";
	$(document).ready(function() { 		
		var base_url = '<?php echo $this->webroot; ?>';
		var from= '<?php echo $convoWith['User']['id']; ?>';
		$('.confirm_delete').click(function(){
			var result = confirm('Are you sure you want to delete this?');
			if(result) {
				console.log($(this).closest('tr'));
				var delete_this = $(this).closest('tr');
				$.ajax({
					type:"POST",
					url: $(this).attr('href'),
					data:"ajax=1",
					dataType: "json",
					success:function(response){
						console.log(response);
					},
					error:function(error){
					},
					complete: function(){
						delete_this.fadeOut(2000);
					}
				});
			}
			return false;
		});

		$('#send_message').click(function(){
			var message = $('#new_message').val();
			var data = {
				to_id: "<?php echo $convoWith['User']['id']; ?>",
				content: message
			};
			console.log(data);
			$.ajax({
				type:"POST",
				url: base_url+'messages/AddNewMessage',
				data: data,
				dataType: "json",
				success:function(response){
					console.log(response);					
				},
				error:function(error){
					console.log(error);
				},
				complete: function(response){
					console.log(JSON.parse(response.responseText));		
					
				}
			});
		});

		var limit=10;

		$('#show_more').click(function(e){
			limit = limit+10;
			var message_count = '<?php echo $message_count; ?>';
			
			if(limit >= message_count){
				limit = message_count;
			}

			var data = {
				to_id: "<?php echo $convoWith['User']['id']; ?>",
				limit: limit
			};

			$.ajax({
				type:"POST",
				url: base_url+'messagelists/getMessagelist',
				data: data,
				dataType: "json",
				success:function(response){
					$('#convoBody').html(response);				
				},
				error:function(error){
					console.log(error);
				}
			});
		});
		
	});
</script>