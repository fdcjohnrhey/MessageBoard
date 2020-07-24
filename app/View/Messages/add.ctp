<div class="messages form">
<?php echo $this->Form->create('Message'); ?>
	<fieldset>
		<legend><?php echo __('Add Message'); ?></legend>
	<?php
		echo $this->Form->input('to_id',array('id'=>'user-select','type'=>'select'));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Message List'), array('controller' => 'messagelists', 'action' => 'index',$currentUser['User']['id']));?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		var base_url = '<?php echo $this->webroot; ?>';		
		$("#user-select").select2({			
			ajax: {
	            url: base_url+'messages/getUsers',
	            type: 'get',
				dataType: 'json',
	            data: function (params) {
	            	console.log(params);
	                return {
	                    search: params.term
	                };
	            },
	            processResults: function (data) {
	            	console.log(data);
	                return { 
	                    results:data
	                };
	            },
	            cache: true
	        }
		});
	});
</script>