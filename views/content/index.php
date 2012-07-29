<?php $columns = 6; ?>
<div class="admin-box">
	<h3>Contact</h3>

	<?php echo form_open(current_url()) ;?>
	<table class="table table-striped">
		<thead>
			<tr>
				<?php if(has_permission('Contact.Content.Delete')):?>
					<?php $columns++; ?>
				<th class="column-check"><input class="check-all" type="checkbox" /></th>
				<?php endif;?>
				<th><?php echo lang('contact_form_name');?></th>
				<th><?php echo lang('contact_form_email');?></th>
				<th><?php echo lang('contact_form_phone');?></th>
				<th><?php echo lang('contact_form_subject');?></th>
				<th><?php echo lang('contact_form_message');?></th>
				<th><?php echo lang('contact_form_created');?></th>
			</tr>
		</thead>
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<tfoot>
		<?php if(has_permission('Contact.Content.Delete')):?>
			<tr>
				<td colspan="<?php echo $columns?>">
					<?php echo lang('bf_with_selected') ?>
					<input type="submit" name="submit" class="btn-danger" id="delete-me" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('pages_delete_multiple_confirm'); ?>')">
				</td>
			</tr>
		<?php endif; ?>
		</tfoot>
	<?php endif; ?>
		<tbody>
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
			<tr>
			<?php if(has_permission('Contact.Content.Delete')):?>
				<td><input type="checkbox" name="checked[]" value="<?php echo $record->contact_id ?>" /></td>
			<?php endif;?>
				<td><?php echo anchor(SITE_AREA .'/content/contact/view/'. $record->contact_id, $record->name) ?></td>
				<td><?php echo $record->email_address;?></td>
				<td><?php echo $record->phone;?></td>
				<td><?php echo $record->subject;?></td>
				<td><?php echo $record->message;?></td>
				<td><?php echo $record->created_on;?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="<?php echo $columns?>">No items were found that match your selection.</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>

	<div class="well">
		<?php echo $total_records." records found"; ?>
	</div>
	<?php echo form_close(); ?>

	<?php echo $this->pagination->create_links(); ?>

</div>	<!-- Contact Editor -->
