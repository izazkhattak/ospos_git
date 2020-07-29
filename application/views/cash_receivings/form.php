<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('cash_receivings/save/'.$cash_ups_info->cashup_id, array('id'=>'cash_receiving_edit_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="item_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_info'), 'cash_ups_info', array('class'=>'control-label col-xs-4')); ?>
			<?php echo form_label(!empty($cash_ups_info->cashup_id) ? $this->lang->line('cash_receiving_id') . ' ' . $cash_ups_info->cashup_id : '', 'cashup_id', array('class'=>'control-label col-xs-8', 'style'=>'text-align:left')); ?>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_open_date'), 'open_date', array('class'=>'required control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>
					<?php echo form_input(array(
							'name'=>'open_date',
							'id'=>'open_date',
							'class'=>'form-control input-sm datepicker',
							'value'=>to_datetime(strtotime($cash_ups_info->open_date)))
							);?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_open_employee'), 'open_employee', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<?php echo form_dropdown('open_employee_id', $employees, $cash_ups_info->open_employee_id, 'id="open_employee_id" class="form-control"');?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_open_amount_cash'), 'open_amount_cash', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'open_amount_cash',
							'id'=>'open_amount_cash',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['total_tendered_new']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_transfer_amount_cash'), 'transfer_amount_cash', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'transfer_amount_cash',
							'id'=>'transfer_amount_cash',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['in_out_cash']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm hide">
			<?php echo form_label($this->lang->line('cash_receiving_close_date'), 'close_date', array('class'=>'required control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>
					<?php echo form_input(array(
							'name'=>'close_date',
							'id'=>'close_date',
							'class'=>'form-control input-sm datepicker',
							'value'=>to_datetime(strtotime($cash_ups_info->close_date)))
							);?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm hide">
			<?php echo form_label($this->lang->line('cash_receiving_close_employee'), 'close_employee', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<?php echo form_dropdown('close_employee_id', $employees, $cash_ups_info->close_employee_id, 'id="close_employee_id" class="form-control"');?>
			</div>
		</div>
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_closed_amount_total'), 'closed_amount_total', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'closed_amount_total',
							'id'=>'closed_amount_total',
							'readonly'=>'true',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['remaining_balance'])
							));?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm hide">
			<?php echo form_label($this->lang->line('cash_receiving_closed_amount_cash'), 'closed_amount_cash', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'closed_amount_cash',
							'id'=>'closed_amount_cash',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['total_cash']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_note'), 'note', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<?php echo form_checkbox(array(
					'name'=>'note',
					'id'=>'note',
					'value'=>0,
					'checked'=>isset($cash_ups_info->note) ? 1 : 0)
				);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_closed_amount_due'), 'closed_amount_due', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'closed_amount_due',
							'id'=>'closed_amount_due',
							'disabled' => 'disabled',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['total_dues']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_closed_amount_card'), 'closed_amount_card', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'closed_amount_card',
							'id'=>'closed_amount_card',
							'class'=>'form-control input-sm',
							'disabled' => 'disabled',
							'value'=>to_currency_no_money($amounts_data['total_cards']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_closed_amount_check'), 'closed_amount_check', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'closed_amount_check',
							'id'=>'closed_amount_check',
							'disabled' => 'disabled',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['total_checks']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- New Fields -->
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receivings_gift_cards'), 'gift_cards_check', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'gift_cards_check',
							'id'=>'gift_cards_check',
							'disabled' => 'disabled',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['total_giftcards']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receivings_expences'), 'expences_check', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'expences_check',
							'id'=>'expences_check',
							'disabled' => 'disabled',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['expences_check']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receivings_cash_receiving'), 'cash_receivings', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-6'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
					<?php echo form_input(array(
							'name'=>'cash_receivings',
							'id'=>'cash_receivings',
							'class'=>'form-control input-sm',
							'value'=>to_currency_no_money($amounts_data['cash_receivings']))
							);?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- New Field End -->

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('cash_receiving_description'), 'description', array('class'=>'control-label col-xs-4')); ?>
			<div class='col-xs-8'>
				<?php echo form_textarea(array(
					'name'=>'description',
					'id'=>'description',
					'class'=>'form-control input-sm',
					'value'=> isset($cash_ups_info->description) ? $cash_ups_info->description : ''
					)
					);?>
			</div>
		</div>

		<?php
		if(isset($cash_ups_info->cashup_id) && !empty($cash_ups_info->cashup_id))
		{
		?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('cash_receiving_is_deleted').':', 'deleted', array('class'=>'control-label col-xs-4')); ?>
				<div class='col-xs-5'>
					<?php echo form_checkbox(array(
						'name'=>'deleted',
						'id'=>'deleted',
						'value'=>1,
						'checked'=>($cash_ups_info->deleted) ? 1 : 0)
					);?>
				</div>
			</div>
		<?php
		}
		?>
	</fieldset>
<?php echo form_close(); ?>

<script type='text/javascript'>
//validation and submit handling
$(document).ready(function()
{
	<?php $this->load->view('partial/datepicker_locale'); ?>

	$('#open_date').datetimepicker({
		format: "<?php echo dateformat_bootstrap($this->config->item('dateformat')) . ' ' . dateformat_bootstrap($this->config->item('timeformat'));?>",
		startDate: "<?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), mktime(0, 0, 0, 1, 1, 2010));?>",
		<?php
		$t = $this->config->item('timeformat');
		$m = $t[strlen($t)-1];
		if( strpos($this->config->item('timeformat'), 'a') !== false || strpos($this->config->item('timeformat'), 'A') !== false )
		{
		?>
			showMeridian: true,
		<?php
		}
		else
		{
		?>
			showMeridian: false,
		<?php
		}
		?>
		minuteStep: 1,
		autoclose: true,
		todayBtn: true,
		todayHighlight: true,
		bootcssVer: 3,
		language: '<?php echo current_language_code(); ?>'
	});

	$('#close_date').datetimepicker({
		format: "<?php echo dateformat_bootstrap($this->config->item('dateformat')) . ' ' . dateformat_bootstrap($this->config->item('timeformat'));?>",
		startDate: "<?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), mktime(0, 0, 0, 1, 1, 2010));?>",
		<?php
		$t = $this->config->item('timeformat');
		$m = $t[strlen($t)-1];
		if( strpos($this->config->item('timeformat'), 'a') !== false || strpos($this->config->item('timeformat'), 'A') !== false )
		{
		?>
			showMeridian: true,
		<?php
		}
		else
		{
		?>
			showMeridian: false,
		<?php
		}
		?>
		minuteStep: 1,
		autoclose: true,
		todayBtn: true,
		todayHighlight: true,
		bootcssVer: 3,
		language: '<?php echo current_language_code(); ?>'
	});

	$('#open_amount_cash, #cash_receivings, #expences_check, #transfer_amount_cash, #closed_amount_cash, #closed_amount_due, #closed_amount_card, #closed_amount_check').keyup(function() {
		$.post("<?php echo site_url($controller_name . 's/ajax_cashup_total')?>", {
				'open_amount_cash': $('#open_amount_cash').val(),
				'transfer_amount_cash': $('#transfer_amount_cash').val(),
				'cash_receivings': $('#cash_receivings').val(),
				'closed_amount_due': $('#closed_amount_due').val(),
				'closed_amount_cash': $('#closed_amount_cash').val(),
				'closed_amount_card': $('#closed_amount_card').val(),
				'closed_amount_check': $('#closed_amount_check').val(),
				'expences_check': $('#expences_check').val()
			},
			function(response) {
				$('#closed_amount_total').val(response.total);
			},
			'json'
		);
	});

	var submit_form = function()
	{
		$(this).ajaxSubmit(
		{
			success: function(response)
			{
				dialog_support.hide();
				table_support.handle_submit('<?php echo site_url('cash_receivings'); ?>', response);
			},
			dataType: 'json'
		});
	};

	$('#cash_receiving_edit_form').validate($.extend(
	{
		submitHandler: function(form)
		{
			submit_form.call(form);
		},
		rules:
		{

		},
		messages:
		{
			open_date:
			{
				required: '<?php echo $this->lang->line('cash_receiving_date_required'); ?>'

			},
			close_date:
			{
				required: '<?php echo $this->lang->line('cash_receiving_date_required'); ?>'

			},
			amount:
			{
				required: '<?php echo $this->lang->line('cash_receiving_amount_required'); ?>',
				number: '<?php echo $this->lang->line('cash_receiving_amount_number'); ?>'
			}
		}
	}, form_support.error));
});
</script>
