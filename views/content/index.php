	<!-- Contact Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
		<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<h2>Contact</h2>
			<table>
				<thead>
					<th><?php echo lang('contact_form_name');?></th>
					<th><?php echo lang('contact_form_email');?></th>
					<th><?php echo lang('contact_form_phone');?></th>
					<th><?php echo lang('contact_form_subject');?></th>
					<th><?php echo lang('contact_form_message');?></th>
					<th><?php echo lang('contact_form_created');?></th>
				</thead>
				<tbody>
<?php foreach ($records as $record) : ?>
					<tr>
						<td><?php echo anchor(SITE_AREA .'/content/contact/view/'. $record->contact_id, $record->name) ?></td>
						<td><?php echo $record->email_address;?></td>
						<td><?php echo $record->phone;?></td>
						<td><?php echo $record->subject;?></td>
						<td><?php echo $record->message;?></td>
						<td><?php echo $record->created_on;?></td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
