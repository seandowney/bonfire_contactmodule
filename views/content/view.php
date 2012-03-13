
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
<div>
        <?php echo form_label(lang('contact_form_name'), 'name'); ?>: 
        <?php echo isset($contact['name']) ? $contact['name'] : ''; ?>
</div>

<div>
        <?php echo form_label(lang('contact_form_email'), 'email_address'); ?>: 
        <?php echo isset($contact['email_address']) ? $contact['email_address'] : ''; ?>
</div>

<div>
        <?php echo form_label(lang('contact_form_phone'), 'phone'); ?>: 
        <?php echo isset($contact['phone']) ? $contact['phone'] : ''; ?>
</div>

<div>
        <?php echo form_label(lang('contact_form_subject'), 'subject'); ?>: 
        <?php echo isset($contact['subject']) ? $contact['subject'] : ''; ?>
</div>                                             
                        
<div>
        <?php echo form_label(lang('contact_form_message'), 'message1'); ?>: 
		<?php echo isset($contact['message']) ? $contact['message'] : '';?>
</div>
<div>
        <?php echo form_label(lang('contact_form_created'), 'created_on'); ?>: 
        <?php echo isset($contact['created_on']) ? $contact['created_on'] : ''; ?>
</div>


	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/content/contact/delete/'. $id); ?>" onclick="return confirm('<?php echo lang('contact_delete_confirm'); ?>')"><?php echo lang('contact_delete_record'); ?></a>
		
		<h3><?php echo lang('contact_delete_record'); ?></h3>
		
		<p><?php echo lang('contact_edit_text'); ?></p>
	</div>
<?php echo form_close(); ?>
