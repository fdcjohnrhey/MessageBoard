


<div class="users form">
<?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data','type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php	
		echo $this->Form->input('image',array('type'=>'file'));
		echo $this->Form->input('name');
		$options = array('0' => 'None','1' => 'Male', '2' => 'Female');
		echo $this->Form->input('gender', array('type'=>'select','options'=>$options));
		echo $this->Form->input('birthdate',array('type'=>'text','id'=>'datepick'));
		echo $this->Form->input('hubby');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<script>
	$(function() {
		$('#datepick').datepicker({
			dateFormat: "yy-mm-dd",
		});

		
	});
	function dateChanged(ev) {
		console.log(ev);
	}
</script>