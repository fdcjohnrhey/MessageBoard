<?php var_dump($messagelist[9]); ?>
<div class="messagelists view">
<h2>Conversation with <?php echo $convoWith['User']['name']; ?></h2>
<form id="reply_message" name="reply_message" action="javascript:void(0);" method="post">
	<input type="text" name="content" id="new_message">
	<input type="hidden" name="to_id" id="new_message" value="<?php echo $convoWith['User']['id']; ?>">	

    <button id="send_message" name="send_message" type="button" class="btn btn-primary" style="float: left;">Reply</button>
</form>
<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
				<th>Message</th>
				<th>Created</th>
				<th>From</th>
				<th class="actions">Actions</th>
		</tr>
	</thead>
	

<?php echo $this->element('messagebody');?>
</table>
<div class="paging">
<?php
	
echo $this->Html->script('jquery', false);
$message_count = $this->Paginator->counter('%count%');
echo $message_count;
?>
<a href="javascript:void(0);" id='show_more'>LOAD MORE</a>
</div>
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