
<div id="convo-body">
<?php foreach ($messageList as $messages): ?>
	<?php 
		if($messages['Messagelist']['from_id'] == $currentUser['User']['id']){
			$container = 'container-me';
		}else{
			$container = 'container-friend';
		}
	?>
	<div class="<?php echo $container; ?>">	
		<?php foreach ($users as $user): ?>
			<?php if($user['User']['id'] == $messages['Messagelist']['from_id']): ?>
			<p>
				<u><?php echo h($user['User']['name']); ?></u>:
				<span style="float: right;">
					<?php echo $this->Js->link('Delete', array('action' => 'delete', $messages['Messagelist']['id']),array('escape' => false, 'class'=>'confirm-delete','id'=>'confirm-delete'));?>
				</span>
			</p>
			<?php endif;?>
		<?php endforeach; ?>
		<p><?php echo h($messages['Message']['content']); ?></p>
		<span class="time-right"><?php echo h($messages['Message']['created']); ?></span>
	</div>
<?php endforeach; ?>
</div>
<style type="text/css">
	.container-friend{
		border: 2px solid #dedede;
		background-color: #f1f1f1;
		border-radius: 5px;
		padding: 10px;
		margin: 10px 0;
		padding-bottom: 20px;
	}
	
	.container-me {
		border: 2px solid #dedede;
		background-color: #443ad63d;
		border-radius: 5px;
		padding: 10px;
		margin: 10px 0;
		padding-bottom: 20px;
	}
	.container::after {
		content: "";
		clear: both;
		display: table;
	}
	.time-right {
		float: right;
		color: #aaa;
	}

	.time-left {
		float: left;
		color: #999;
	}
</style>