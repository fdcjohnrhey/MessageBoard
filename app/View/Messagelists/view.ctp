<div class="messagelists view">
<h2>Conversation with <?php echo $convoWith['User']['name']; ?></h2>
<form id="reply-message" name="reply_message" action="javascript:void(0);" method="post" style="margin-bottom: 50px;width: 100%">
	<input type="text" name="content" id="new-message">
	<input type="hidden" name="to_id" id="new-message" value="<?php echo $convoWith['User']['id']; ?>">	

    <button id="send-message" name="send-message" type="button" class="btn btn-primary" style="float: right;">Reply Message</button>
</form>
<table cellpadding="0" cellspacing="0">	
	

<?php echo $this->element('messagebody');?>
</table>
<div class="paging">
<?php
	
echo $this->Html->script('jquery', false);
$message_count = $this->Paginator->counter('%count%');
?>
<a href="javascript:void(0);" id='show-more'>LOAD MORE</a>
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
		var limit=10;
		var message_count = "<?php echo $message_count; ?>";
		$('#send-message').attr('disabled','disabled');	
		$('#new-message').val('');

		if(message_count< limit){
			limit = message_count;
			$('#show-more').addClass('disabled');
		}
		
		$('#new-message').on('keyup', function(){
			var message = $(this).val();
			if(message!=""){		
				$('#send-message').removeAttr('disabled');
			}else{
				$('#send-message').attr('disabled','disabled');	
			}
		});

		$('#convo-body').on('click', '.confirm-delete', function(){
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

		$('#send-message').click(function(){
			var message = $('#new-message').val();
			
			var data = {
				to_id: "<?php echo $convoWith['User']['id']; ?>",
				content: message,
				limit : limit
			};
			$.ajax({
				type:"POST",
				url: base_url+'messages/AddNewMessage',
				data: data,
				dataType: "json",
				success:function(response){
					//console.log(response);					
				},
				error:function(error){
					console.log(error);
				},
				complete: function(response){
					$('#new-message').val('');
					$('#convo-body').html(JSON.parse(response.responseText));							
				}
			});
		});

		$('#show-more').click(function(e){
			limit = limit+10;
			
			if(limit >= message_count ||  message_count< limit){
				limit = message_count;
				$(this).addClass('disabled');
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

				},
				error:function(error){
					console.log(error);
				},
				complete: function(response){
					$('#convo-body').html(JSON.parse(response.responseText));								
				}
			});
		});
		
	});
</script>