<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php // Change the css classes to suit your needs    
if( isset($contact) ) {
	$contact = (array)$contact;
}
$id = isset($contact['contact_id']) ? "/".$contact['contact_id'] : '';
?>
	<div id="login">
		<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>
		<div>
			<?php echo form_label('Your Name <span class="required">*</span>', 'name'); ?>
			<input id="name" type="text" name="name" maxlength="150" value="<?php echo set_value('name', isset($contact['name']) ? $contact['name'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Email Address <span class="required">*</span>', 'email_address'); ?>
			<input id="email_address" type="text" name="email_address" maxlength="150" value="<?php echo set_value('email_address', isset($contact['email_address']) ? $contact['email_address'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Phone Number', 'phone'); ?>
			<input id="phone" type="text" name="phone" maxlength="20" value="<?php echo set_value('phone', isset($contact['phone']) ? $contact['phone'] : ''); ?>"  />
		</div>

		<div>
			<?php echo form_label('Subject <span class="required">*</span>', 'subject'); ?>
			<input id="phosubjectne" type="text" name="subject" maxlength="150" value="<?php echo set_value('subject', isset($contact['subject']) ? $contact['subject'] : ''); ?>"  />
		</div>                                             

		<div>
			<?php echo form_label('Message <span class="required">*</span>', 'message'); ?>
			<?php echo form_textarea( array( 'name' => 'message', 'id' => 'message', 'rows' => '5', 'cols' => '30', 'value' => set_value('message', isset($contact['message']) ? $contact['message'] : '') ) )?>
		</div>



		<div class="text-right">
			<br/>
			<input type="submit" name="submit" value="Submit" />
		</div>
		<?php echo form_close(); ?>
	</div>