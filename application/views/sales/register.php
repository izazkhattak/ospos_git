
<?php
//  if (!$this->input->is_ajax_request()){
	 $this->load->view("partial/header"); 
	//  }
	  ?>

<?php
if (isset($error)) {
	echo "<div class='alert alert-dismissible alert-danger'>" . $error . "</div>";
}

if (!empty($warning)) {
	echo "<div class='alert alert-dismissible alert-warning'>" . $warning . "</div>";
}

if (isset($success)) {
	echo "<div class='alert alert-dismissible alert-success'>" . $success . "</div>";
}
?>
<style type="text/css">
	#ui-id-1:nth-child(even) {
		font-size: 13.5px;
		font-weight: 500;
		color: #04c;
	}

	.item-img {
		height: 35px;
		width: 35px;
		display: inline;
		margin-right: 5px;
	}

	@media(max-width: 1000px) {

		#register_wrapper,
		#overall_sale {
			width: 100%;
		}

		#overall_sale {
			padding-top: 10px;
			padding-bottom: 10px;
			margin-top: 20px;
		}

		.container {
			width: 100%;
		}

		#overall_sale .btn {
			margin: 0;
		}

		#register_wrapper .table-responsive {
			max-height: 625px;
			overflow-y: scroll;
		}

		table {
			font-size: 19px;
		}

		#nombre-bar {
			width: 30px;
			white-space: nowrap;
			text-overflow: ellipsis;
			overflow: hidden;
		}

		#nombre {
			display: block;
			display: -webkit-box;
			max-width: 100%;
			height: 73px;
			width: 250px;
			margin: 0 auto;
			line-height: 1;
			-webkit-line-clamp: 3;
			-webkit-box-orient: vertical;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.precio,
		.cantidad {
			width: 65px;
		}

		.item_description {
			width: 40px;
		}

		.item_description .btn {
			margin: 0;
		}
	}
</style>
<div id="register_wrapper">
	<!-- Top register controls -->
	<?php echo form_open($controller_name . "/change_mode", array('id' => 'mode_form', 'class' => 'form-horizontal panel panel-default')); ?>
	<div class="panel-body form-group">
		<ul>
			<!--
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('sales_mode'); ?></label>
				</li>			-->
			<li class="pull-left">
				<?php echo form_dropdown('mode', $modes, $mode, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'k-button btn-default btn-sm', 'data-width' => 'fit')); ?>
			</li>
			<?php
				if ($this->config->item('dinner_table_enable') == TRUE) {
				?>
			<!--
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('sales_table'); ?></label>
				</li>			-->
			<li class="pull-left">
				<?php echo form_dropdown('dinner_table', $empty_tables, $selected_table, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'k-button btn-default btn-sm', 'data-width' => 'fit')); ?>
			</li>
			<?php
				}
				if (count($stock_locations) > 1) {
				?>
			<!--
				<li class="pull-left">
					<label class="control-label"><?php echo $this->lang->line('sales_stock_location'); ?></label>
				</li>			-->
			<li class="pull-left">
				<?php echo form_dropdown('stock_location', $stock_locations, $stock_location, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'k-button btn-default btn-sm', 'data-width' => 'fit')); ?>
			</li>
			<?php
				}
				?>
			<li class="pull-right">
				<button class='k-button btn btn-default btn-sm modal-dlg' id='show_suspended_sales_button' data-href="<?php echo site_url($controller_name . "/suspended"); ?>" title="<?php echo $this->lang->line('sales_suspended_sales'); ?>">
				<span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspended_sales'); ?>
				</button>
			</li>
			<?php
				if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id'))) {
				?>
			<li class="pull-right">
				<?php echo anchor(
					$controller_name . "/manage",
					'<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'),
					array('class' => 'k-button btn btn-primary btn-sm', 'id' => 'sales_takings_button', 'title' => $this->lang->line('sales_takings'))
					); ?>
			</li>
			<?php
				}
				?>
		</ul>
	</div>
	<?php echo form_close(); ?>
	<?php $tabindex = 0; ?>
	<?php echo form_open($controller_name . "/add", array('id' => 'add_item_form', 'class' => 'form-horizontal panel panel-default')); ?>
	<div class="panel-body form-group">
		<ul>
			<li class="pull-left first_li">
				<!--
					<label for="item" class='control-label'><?php echo $this->lang->line('sales_find_or_scan_item_or_receipt'); ?></label>		-->
			</li>
			<li class="pull-left sales_search">
				<?php echo form_input(array('id' => 'buscador', 'name' => 'item', 'id' => 'item', 'class' => 'form-control input-sm', 'size' => '40', 'tabindex' => ++$tabindex, 'placeholder' => $this->lang->line('sales_start_typing_item_name'))); ?>
				<span class="ui-helper-hidden-accessible" role="status"></span>
				<button id='new_item_button' class='k-button btn btn-info btn-sm pull-right modal-dlg' data-btn-new='<?php echo $this->lang->line('common_new') ?>' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("items/view"); ?>' title='<?php echo $this->lang->line($controller_name . '_new_item'); ?>'>
				<span class="fas fa-box-open">&nbsp</span>
				<span class="text"><?php echo $this->lang->line($controller_name . '_new_item'); ?></span>
				</button>
				<i class="fa fa-question-circle flashit flashstyle" data-toggle="tooltip" title="Buscar productos"></i>
			</li>
			<?php
				if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id'))) {
				?>
			<?php
				}
				?>
		</ul>
		<div class="sales_category">
			<div class="pendiente desarrollo">
				<div class="sales_category__panel">
					<div class="sales_category__panel--title">
						<!--		<label class="">Buscar artículo por categoría</label>	-->
					</div>
					<div class="sales_category__panel--toggle-button" id="get_list_cat">
						<button type="button" class="k-button show_categories--button"><i class="fas fa-sort"></i> <span>Mostrar categorías</span></button>
					</div>
				</div>
				<div class="sales__category--wrapper list-of-categories" style="display: none">
				</div>
			</div>
		</div>
		<div class="sales_category">
			<div onclick="playSound2()" class="sales_category_image panel-body form-group list-of-items" style="display: none">
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
	<!-- Sale Items List -->
	<div class="table-responsive">
		<table class="sales_table_100" id="register">
			<thead>
				<tr>
					<th style="width: 5%;"><span class="glyphicon glyphicon-trash"></th>
					<!--
						<th style="width: 5%;"><?php echo $this->lang->line('common_delete'); ?></th>		-->
					<th id="nombre-bar" style="width: 15%;"><?php echo $this->lang->line('sales_item_number'); ?></th>
					<th id="nombre-bar" style="width: 30%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
					<!--
						<th style="width: 10%;"><?php echo $this->lang->line('cost_price'); ?></th>			-->
					<th style="width: 10%;"><?php echo $this->lang->line('sales_price'); ?></th>
					<th style="width: 10%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
					<th style="width: 13%;"><?php echo $this->lang->line('sales_discount'); ?></th>
					<th style="width: 10%;"><?php echo $this->lang->line('sales_total'); ?></th>
					<th style="width: 5%;"><span class="glyphicon glyphicon-refresh"></th>
				</tr>
			</thead>
			<tbody id="cart_contents">
				<?php
					if (count($cart) == 0) {
					?>
				<tr>
					<td colspan='8'>
						<div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
					</td>
				</tr>
				<?php
					} else {
						$item_kit_items = [];
						$kit_item_inc = 0;
						$kit_price = 0;
						$kit_comulative_price = 0;
						$kit_class_name = '';
						foreach (array_reverse($cart, TRUE) as $line => $item) {
						?>
				<?php echo form_open($controller_name . "/edit_item/$line", array('class' => 'form-horizontal', 'id' => 'cart_' . $line));
					?>
				<?php
					
					$hide_class = '';
					if ($item['kit_name'] != NULL) {
						$kit_class_name = str_replace(" ", '_', $item['kit_name']);
					}
					if (in_array($item['kit_name'], $item_kit_items)) {
						$hide_class = 'hidden';
						$kit_price += $item['discounted_total'];
						$kit_comulative_price += bcmul($item['kit_default_quantity'], $item['price']);						
					} else {
						$kit_item_inc++;
						if ($item['kit_name'] != NULL) {
							
							$kit_price = $item['discounted_total'];
							$kit_comulative_price = bcmul($item['kit_default_quantity'], $item['price']);
							array_push($item_kit_items, $item['kit_name']);
							
						}
					}
					
					
					?>
				<tr data-line='<?= $line ?>' class="<?= $hide_class . ' child_kits_' . $kit_item_inc ?>">
					<td>
						<?php echo anchor($controller_name . "/delete_item/$line", '<span class="glyphicon glyphicon-trash"></span>', array('data-trid' => 'child_kits_' . $kit_item_inc,  'data-href' => $controller_name . "/delete_item/$line", "class" => "k-button delete_item")); ?>
						<?php echo form_hidden('location', $item['item_location']); ?>
						<?php echo form_input(array('type' => 'hidden', 'name' => 'item_id', 'value' => $item['item_id'])); ?>
					</td>
					<td id="nombre-bar"><?php echo ($item['kit_name'] == null) ? $item['item_number'] : '-'; ?></td>
					<td id="nombre" class="text-center">
						<?php echo ($item['kit_name'] != null) ? $item['kit_name'] : $item['name'] . ' ' . implode(' ', array($item['attribute_values'], $item['attribute_dtvalues'])); ?>
					</td>
					<td>
						<?php if ($items_module_allowed) {
							if($item['kit_name'] == NULL){
								echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'price', 'class' => 'form-control input-sm precio', 'value' => to_currency_no_money($item['price']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
							}else{
								echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'type'=>'hidden', 'name' => 'price', 'class' => 'form-control input-sm precio', 'value' => to_currency_no_money($item['price']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
								echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'price_view_kit', 'class' => 'form-control input-sm precio price_view_'.$kit_class_name, 'value' => to_currency_no_money($item['kit_total_temp_original_price']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
							}
						} else {
							echo to_currency($item['price']);
							echo form_hidden('price', to_currency_no_money($item['price']));
							} ?>
					</td>
					<td>
						<?php
							if ($item['kit_name']) {
								echo form_input(array('autocomplete'=>'off', 'data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'quantity_kit', 'class' => 'form-control input-sm cantidad', 'value' => to_currency_no_money($item['kit_temp']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
							} else {
								echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'quantity', 'class' => 'form-control input-sm cantidad', 'value' => to_quantity_decimals($item['quantity']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
							}
							
							?>
					</td>
					<td>
						<div id="des" class="input-group">
							<?php echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'discount', 'class' => 'form-control input-sm', 'value' => $item['discount'], 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
							<span class="input-group-btn">
							<?php echo form_checkbox(array('id' => 'discount_toggle', 'name' => 'discount_toggle', 'value' => 1, 'data-toggle' => "toggle", 'data-size' => 'small', 'data-onstyle' => 'success', 'data-on' => '<b>' . $this->config->item('currency_symbol') . '</b>', 'data-off' => '<b>%</b>', 'data-line' => $line, 'checked' => $item['discount_type'])); ?>
							</span>
						</div>
					</td>
					<td>
						<?php
							if($item['kit_name'] == NULL){
						?>
						<?php
							echo to_currency($item['discounted_total']);
							}else{
							?>
							<span class="kit_price_div_<?= $kit_class_name; ?>"><?= to_currency($item['kit_total_temp_price']); ?></span>
							<?php } ?>
						<?= $item['kit_name']; ?>
					</td>
					<td>
					
						<!-- <a href="javascript:void(0);" onclick="window.location.href='<?= base_url($controller_name); ?>'" title=<?php echo $this->lang->line('sales_update')?> ><span class="glyphicon glyphicon-refresh"></span></a> -->
						<a rel="<?php echo 'cart_'.$line ?>" href="javascript:void(0);" class="update_item" title=<?php echo $this->lang->line('sales_update')?> ><span class="glyphicon glyphicon-refresh"></span></a>
						<!-- <a href="javascript:document.getElementById('<?php echo 'cart_'.$line ?>').submit();" title=<?php echo $this->lang->line('sales_update')?> ><span class="glyphicon glyphicon-refresh"></span></a> -->
						<!-- <button type="submit" style="border:none;background:none; color:blue"><span class="glyphicon glyphicon-refresh"></span></button> -->
					</td>
				</tr>
				<tr class="<?= $hide_class ?>">
					<td colspan='7' style="text-align: left;">
						<?php if ($item['description'] != '') {
							echo form_input(array('data-trid' => 'child_kits_' . $kit_item_inc, 'name' => 'description', 'class' => 'form-control item_description input-sm', 'value' => $item['description'], 'tabindex' => ++$tabindex));
							} else {
							echo $this->lang->line('sales_no_description');
							echo form_hidden('description', '');
							}
							?>
					</td>
					<td>
						<?php
							echo form_hidden('serialnumber', '');
							?>
					</td>
				</tr>
				<?php echo form_close(); ?>
				<?php
					}
					}
					?>
			</tbody>
		</table>
	</div>
</div>
<!-- Overall Sale -->
<div id="overall_sale" class="panel panel-default">
	<div class="panel-body">
		<?php
			if (isset($customer)) {
			?>
		<table class="sales_table_100">
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo anchor('customers/view/' . $customer_id, $customer, array('class' => 'modal-dlg', 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('customers_update'))); ?></th>
			</tr>
			<?php
				if (!empty($customer_email)) {
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_email"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
			</tr>
			<?php
				}
				?>
			<?php
				if (!empty($customer_address)) {
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_address"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $customer_address; ?></th>
			</tr>
			<?php
				}
				?>
			<?php
				if (!empty($customer_location)) {
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_location"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $customer_location; ?></th>
			</tr>
			<?php
				}
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_discount"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo ($customer_discount_type == FIXED) ? to_currency($customer_discount) : $customer_discount . '%'; ?></th>
			</tr>
			<?php if ($this->config->item('customer_reward_enable') == TRUE) : ?>
			<?php
				if (!empty($customer_rewards)) {
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("rewards_package"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['package_name']; ?></th>
			</tr>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("customers_available_points"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['points']; ?></th>
			</tr>
			<?php
				}
				?>
			<?php endif; ?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_total"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo to_currency($customer_total); ?></th>
			</tr>
			<?php
				if (!empty($mailchimp_info)) {
				?>
			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_mailchimp_status"); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $mailchimp_info['status']; ?></th>
			</tr>
			<?php
				}
				?>
		</table>
		<?php echo anchor(
			$controller_name . "/remove_customer",
			'<span class="glyphicon glyphicon-remove">&nbsp</span>' . $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer'),
			array('class' => 'k-button btn btn-danger btn-sm', 'id' => 'remove_customer_button', 'title' => $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer'))
			); ?>
		<?php } else { ?>
		<div class="form-group" id="select_customer">
			<?php echo form_open($controller_name . "/select_customer", array('id' => 'select_customer_form', 'class' => 'form-horizontal')); ?>

			<!--Pos-->
			<!--<label id="customer_label" for="customer" class="control-label" style="margin-bottom: 1em; margin-top: -1em;"><?php echo $this->lang->line('sales_select_customer'); ?></label>-->
			<div class="new_customer_container">
				<?php echo form_input(array('name' => 'customer', 'id' => 'customer', 'class' => 'form-control input-sm', 'value' => $this->lang->line('sales_start_typing_customer_name'))); ?>
				<button class='k-button btn btn-info btn-sm modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("customers/view"); ?>' title='<?php echo $this->lang->line($controller_name . '_new_customer'); ?>'>
					<span class="fas fa-user-edit">&nbsp</span>
					<!--<?php echo $this->lang->line($controller_name . '_new_customer'); ?>-->
				</button>
			</div>
			<?php } ?>
			
			<?php echo form_close(); ?>
			<table class="sales_table_100" id="sale_totals">
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_quantity_of_items', $item_count); ?></th>
					<th style="width: 45%; text-align: right;"><?php echo $total_units; ?></th>
				</tr>
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_sub_total'); ?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency($subtotal); ?></th>
				</tr>
				<?php
					foreach ($taxes as $tax_group_index => $tax) {
					?>
				<tr>
					<th style='width: 55%;'><?php echo (float) $tax['tax_rate'] . '% ' . $tax['tax_group']; ?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></th>
				</tr>
				<?php
					}
					?>
				<tr>
					<th style='width: 55%;'><?php echo $this->lang->line('sales_total'); ?></th>
					<th style="width: 45%; text-align: right;"><span id="sale_total"><?php echo to_currency($total); ?></span></th>
				</tr>
			</table>
			<?php
				// Only show this part if there are Items already in the sale.
				if (count($cart) > 0) {
				?>
			<table class="sales_table_100" id="payment_totals">
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_payments_total'); ?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency($payments_total); ?></th>
				</tr>
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_amount_due'); ?></th>
					<th style="width: 45%; text-align: right;"><span id="sale_amount_due"><?php echo to_currency($amount_due); ?></span></th>
				</tr>
			</table>
			<div id="payment_details">
				<?php
					// Show Complete sale button instead of Add Payment if there is no amount due left
					if ($payments_cover_total) {
					?>
				<?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
				<table class="sales_table_100">
					<tr>
						<td><?php echo $this->lang->line('sales_payment'); ?></td>
						<td>
							<?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'btn-default btn-sm', 'data-width' => 'auto', 'disabled' => 'disabled')); ?>
						</td>
					</tr>
					<tr>
						<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
						<td>
							<?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm disabled', 'disabled' => 'disabled', 'value' => '0', 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
						</td>
					</tr>
				</table>
				<?php echo form_close(); ?>
				<?php
					$payment_type = $this->input->post('payment_type');
					// Only show this part if the payment cover the total and in sale or return mode
					
					if ($pos_mode == '1' && $payment_type != $this->lang->line('sales_due') && !isset($customer)) {
					?>
				<div class='btn btn-sm btn-success pull-right' id='finish_sale_button' onclick="playSound()" tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
				<?php
					}
					?>
				<?php
					if ($pos_mode == '1' && $payment_type = $this->lang->line('sales_due') && isset($customer)) {
					?>
				<div class='btn btn-sm btn-success pull-right' id='finish_sale_button' tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
				<?php
					}
					?>
				<?php
					} else {
					?>
				<?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
				<table class="sales_table_100">
					<tr>
						<td><?php echo $this->lang->line('sales_payment'); ?></td>
						<td>
							<?php echo form_dropdown('payment_type', $payment_options,  $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'k-button btn-default btn-sm', 'data-width' => 'fit')); ?>
						</td>
					</tr>
					<tr>
						<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
						<td>
							<?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm non-giftcard-input', 'value' => to_currency_no_money($amount_due), 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
						</td>
					</tr>
					<tr>
						<td><?php echo "Dias a caducar"; ?></td>
						<td><?php echo form_input(array('name' => 'sale_extrainput6', 'id' => 'sale_extrainput6', 'class' => 'form-control input-sm ', 'value' => '', 'size' => '5')); ?></td>
					</tr>
				</table>
				<?php echo form_close(); ?>
				<div class='btn btn-sm btn-success pull-right' id='add_payment_button' onclick="playSound()" tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>
				<?php
					}
					?>
				<?php
					// Only show this part if there is at least one payment entered.
					if (count($payments) > 0) {
					?>
				<table class="sales_table_100">
					<thead>
						<tr>
							<th style="width: 10%;"><?php echo $this->lang->line('common_delete'); ?></th>
							<th style="width: 60%;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
							<th style="width: 20%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
						</tr>
					</thead>
					<tbody id="payment_contents">
						<?php
							foreach ($payments as $payment_id => $payment) {
							?>
						<tr>
							<td><?php echo anchor($controller_name . "/delete_payment/$payment_id", '<span class="glyphicon glyphicon-trash"></span>'); ?></td>
							<td><?php echo $payment['payment_type']; ?></td>
							<td style="text-align: right;"><?php echo to_currency($payment['payment_amount']); ?></td>
						</tr>
						<?php
							}
							?>
					</tbody>
				</table>
				<?php
					}
					?>
			</div>
			<?php echo form_open($controller_name . "/cancel", array('id' => 'buttons_form')); ?>
			<div class="form-group" id="buttons_sale">
				<div class='btn btn-sm btn-default pull-left' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
				<?php
					// Only show this part if the payment covers the total
					if (!$pos_mode && isset($customer)) {
					?>
				<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
				<?php
					}
					?>
				<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
			</div>
			<?php echo form_close(); ?>
			<?php
				// Only show this part if the payment cover the total
				if ($payments_cover_total || !$pos_mode) {
				?>
			<div class="container-fluid">
				<div class="no-gutter row">
					<div class="form-group form-group-sm">
						<div class="col-xs-12">
							<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class' => 'control-label', 'id' => 'comment_label', 'for' => 'comment')); ?>
							<?php echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'class' => 'form-control input-sm', 'value' => $comment, 'rows' => '2')); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group form-group-sm">
						<div class="col-xs-6">
							<label for="sales_print_after_sale" class="control-label checkbox">
							<?php echo form_checkbox(array('name' => 'sales_print_after_sale', 'id' => 'sales_print_after_sale', 'value' => 1, 'checked' => $print_after_sale)); ?>
							<?php echo $this->lang->line('sales_print_after_sale') ?>
							</label>
						</div>
						<?php
							if (!empty($customer_email)) {
							?>
						<div class="col-xs-6">
							<label for="email_receipt" class="control-label checkbox">
							<?php echo form_checkbox(array('name' => 'email_receipt', 'id' => 'email_receipt', 'value' => 1, 'checked' => $email_receipt)); ?>
							<?php echo $this->lang->line('sales_email_receipt'); ?>
							</label>
						</div>
						<?php
							}
							?>
						<?php
							if ($mode == "sale_work_order") {
							?>
						<div class="col-xs-6">
							<label for="price_work_orders" class="control-label checkbox">
							<?php echo form_checkbox(array('name' => 'price_work_orders', 'id' => 'price_work_orders', 'value' => 1, 'checked' => $price_work_orders)); ?>
							<?php echo $this->lang->line('sales_include_prices'); ?>
							</label>
						</div>
						<?php
							}
							?>
					</div>
				</div>
				<?php
					if (($mode == "sale") && $this->config->item('invoice_enable') == TRUE) {
					?>
				<div class="row">
					<div class="form-group form-group-sm">
						<div class="col-xs-6">
							<label for="sales_invoice_enable" class="control-label checkbox">
							<?php echo form_checkbox(array('name' => 'sales_invoice_enable', 'id' => 'sales_invoice_enable', 'value' => 1, 'checked' => $invoice_number_enabled)); ?>
							<?php echo $this->lang->line('sales_invoice_enable'); ?>
							</label>
						</div>
						<div class="col-xs-6">
							<div class="input-group input-group-sm">
								<span class="input-group-addon input-sm">#</span>
								<?php echo form_input(array('name' => 'sales_invoice_number', 'id' => 'sales_invoice_number', 'class' => 'form-control input-sm', 'value' => $invoice_number)); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
					?>
			</div>
			<?php
				}
				?>
			<?php
				}
				?>
		</div>
	</div>
</div>

<?php 
/*V1.1*/
if (!$this->input->is_ajax_request()){
?>

<script type="text/javascript">
$(document).ready(function () {
	$("input[name='item_number']").change(function () {
		var item_id = $(this).parents("tr").find("input[name='item_id']").val();
		var item_number = $(this).val();
		$.ajax({
			url: "<?php echo site_url('sales/change_item_number');?>",
			method: 'post',
			data: {
				"item_id": item_id,
				"item_number": item_number,
			},
			dataType: 'json'
		});
	});

	$(document).on("click", ".ui-menu-item", function (e) {
		e.preventDefault();
		//console.log("here");
		$("#add_item_form").ajaxSubmit({
			success: processJson
		});
	});
	/*V1.1*/
	var $project = $('#item');
	$project.autocomplete({
		source: '<?php echo site_url($controller_name."/item_search"); ?>',
		minChars: 0,
		autoFocus: false,
		delay: 500,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			if(a.which == 13) {
				$("#add_item_form").ajaxSubmit({
					success: processJson
				});
			}
			return false;
		}
	});

	$("input[name='name']").change(function () {
		var item_id = $(this).parents("tr").find("input[name='item_id']").val();
		var item_name = $(this).val();
		$.ajax({
			url: "<?php echo site_url('sales/change_item_name');?>",
			method: 'post',
			data: {
				"item_id": item_id,
				"item_name": item_name,
			},
			dataType: 'json'
		});
	});

	$("input[name='item_description']").change(function () {
		var item_id = $(this).parents("tr").find("input[name='item_id']").val();
		var item_description = $(this).val();
		$.ajax({
			url: "<?php echo site_url('sales/change_item_description');?>",
			method: 'post',
			data: {
				"item_id": item_id,
				"item_description": item_description,
			},
			dataType: 'json'
		});
	});

	function processJson(data) {
		setData(data);
		$("#item").val("");
		$("#item").focus();
		
		$('[name="discount_toggle"]').bootstrapToggle('refresh');
	}

	$project.data("ui-autocomplete")._renderItem = function (ul, item) {

		var $li = $('<li>'),
			$img = $('<img>');

		$('#item').blur(function () {
			$(this).val("<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
		});
		if (item.icon) {
			var iconSrc = item.icon;
		} else {
			var iconSrc = "<?php echo site_url('items/pic_thumb/no-img.png'); ?>";
		}
		$img.attr({
			src: iconSrc,
			alt: item.label,
			class: "icon_autocomplete"

		});

		$li.attr('data-value', item.label);
		$li.append('<a href="#">');
		var label = "<span class='item_label'>" + item.label + "</span>";
		$li.find('a').append($img).append(label);

		return $li.appendTo(ul);
	};
	/*V1.1*/
	// $('#item').focus();
	$(document).on('keypress', '#item', function (e) {
		if (e.which == 13) {
			$('#add_item_form').submit({
				success: processJson
			});
			return false;
		}
	});

	$(document).on("click", ".select_item", function (e) {
		e.preventDefault();
		var id = $(this).attr("rel");
		$(".sales_search #item").val(id);
		$("#add_item_form").ajaxSubmit({
			success: processJson
		});
		$('[name="discount_toggle"]').bootstrapToggle('refresh');

	});

	var clear_fields = function () {
		if ($(this).val().match("<?php echo $this->lang->line('sales_start_typing_item_name') . '|' . $this->lang->line('sales_start_typing_customer_name'); ?>")) {
			$(this).val('');
		}
	};

	$('#item, #customer').click(clear_fields).dblclick(function (event) {
		$(this).autocomplete("search");
	});

	$('#customer').blur(function () {
		$(this).val("<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
	});

	$("#customer").autocomplete({
		source: "<?php echo site_url("customers/suggest "); ?>",
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#select_customer_form").submit();
		}
	});

	$('#customer').keypress(function (e) {
		if (e.which == 13) {
			$('#select_customer_form').submit();
			return false;
		}
	});

	$(".giftcard-input").autocomplete({
		source: "<?php echo site_url("giftcards/suggest "); ?>",
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_payment_form").submit();
		}
	});

	$('#comment').keyup(function () {
		$.post("<?php echo site_url($controller_name."/set_comment ");?>", {
			comment: $('#comment').val()
		});
	});

	<?php
	if($this->config->item('invoice_enable') == TRUE)
	{
	?>
	$('#sales_invoice_number').keyup(function () {
		$.post("<?php echo site_url($controller_name."/set_invoice_number ");?>", {
			sales_invoice_number: $('#sales_invoice_number').val()
		});
	});

	var enable_invoice_number = function () {
		var enabled = $("#sales_invoice_enable").is(":checked");
		$("#sales_invoice_number").prop("disabled", !enabled).parents('tr').show();
		return enabled;
	}

	enable_invoice_number();

	$("#sales_invoice_enable").change(function () {
		var enabled = enable_invoice_number();
		$.post("<?php echo site_url($controller_name."/set_invoice_number_enabled ");?>", {
			sales_invoice_number_enabled: enabled
		});
	});
	<?php
	}
	?>

	$("#sales_print_after_sale").change(function () {
		$.post("<?php echo site_url($controller_name."/set_print_after_sale ");?>", {
			sales_print_after_sale: $(this).is(":checked")
		});
	});

	$("#price_work_orders").change(function () {
		$.post("<?php echo site_url($controller_name."/set_price_work_orders ");?>", {
			price_work_orders: $(this).is(":checked")
		});
	});

	$('#email_receipt').change(function () {
		$.post("<?php echo site_url($controller_name."/set_email_receipt ");?>", {
			email_receipt: $(this).is(":checked")
		});
	});

	$(document).on("click", "#finish_sale_button", function () {
		$('#buttons_form').attr('action', "<?php echo site_url($controller_name."/complete "); ?>");
		$('#buttons_form').submit();
	});

	$(document).on("click", "#finish_invoice_quote_button", function () {
		$('#buttons_form').attr('action', "<?php echo site_url($controller_name."/complete "); ?>");
		$('#buttons_form').submit();
	});

	$(document).on("click", "#suspend_sale_button", function () {
		$('#buttons_form').attr('action', "<?php echo site_url($controller_name."/suspend "); ?>");
		$('#buttons_form').submit();
	});

	$(document).on("click", "#cancel_sale_button", function () {
		if (confirm("<?php echo $this->lang->line("sales_confirm_cancel_sale "); ?>")) {
			$('#buttons_form').attr('action', "<?php echo site_url($controller_name."/cancel "); ?>");
			$('#buttons_form').submit();
		}
	});

	$(document).on("click", "#add_payment_button", function () {
		$('#add_payment_form').submit();
	});

	$("#payment_types").change(check_payment_type_giftcard).ready(check_payment_type_giftcard);

	$("#amount_tendered").keypress(function (event) {
		if (event.which == 13) {
			$('#add_payment_form').submit();
		}
	});

	$("#finish_sale_button").keypress(function (event) {
		if (event.which == 13) {
			$('#finish_sale_form').submit();
		}
	});

	dialog_support.init("a.modal-dlg, button.modal-dlg");

	table_support.handle_submit = function (resource, response, stay_open) {
		$.notify(response.message, {
			type: response.success ? 'success' : 'danger'
		});

		if (response.success) {
			if (resource.match(/customers$/)) {
				$("#customer").val(response.id);
				$("#select_customer_form").submit();
			} else {
				var $stock_location = $("select[name='stock_location']").val();
				$("#item_location").val($stock_location);
				$("#item").val(response.id);
				if (stay_open) {
					$("#add_item_form").ajaxSubmit();
				} else {
					$("#add_item_form").submit();
				}
			}
		}
	}
});

function check_payment_type_giftcard() {
	var cash_rounding = <?php echo json_encode($cash_rounding); ?>;

	if ($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>") {
		$("#sale_total").html("<?php echo to_currency($total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
		$("#amount_tendered:enabled").val('').focus();
		$(".giftcard-input").attr('disabled', false);
		$(".non-giftcard-input").attr('disabled', true);
		$(".giftcard-input:enabled").val('').focus();
	} else if ($("#payment_types").val() == "<?php echo $this->lang->line('sales_cash'); ?>" && cash_rounding) {
		$("#sale_total").html("<?php echo to_currency($cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val("<?php echo to_currency_no_money($cash_amount_due); ?>");
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	} else {
		$("#sale_total").html("<?php echo to_currency($non_cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($non_cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val("<?php echo to_currency_no_money($non_cash_amount_due); ?>");
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	}
}

function setData(data) {

	$(".alert").remove();
	$(data).find(".alert").insertBefore("#register_wrapper");

	$("#cart_contents").html($(data).find("#cart_contents").html());
	$("#sale_totals").html($(data).find("#sale_totals").html());

	if ($(data).find("#payment_totals").length)
		$("#payment_totals").html($(data).find("#payment_totals").html());
	else {
		$("#payment_totals").html("");
	}

	if ($(data).find("#amount_tendered").length) {
		$("#amount_tendered").val($(data).find("#amount_tendered").val());
	} else {
		$("#amount_tendered").val("0");
	}

	// in first time
	if ($("#finish_sale").length == 0) {
		$(data).find("#finish_sale").insertAfter("#sale_totals");
	}
	if ($("#payment_totals").length == 0) {
		$(data).find("#payment_totals").insertAfter("#sale_totals");
	}
	if ($("#payment_details").length == 0) {
		$(data).find("#payment_details").insertAfter("#payment_totals");
	}
	if ($("#buttons_form").length == 0) {
		$(data).find("#buttons_form").insertAfter("#payment_details");
	}
	$('.selectpicker').selectpicker('refresh');
}
$(function () {

	// $(document).on("click", ".delete_item", function(e) {
	// 	e.preventDefault();
	// 	let current_input = $(this);
	// 	var kit_childs_items = current_input.data("trid");
	// 	$.each($('#cart_contents .' + kit_childs_items + ' .delete_item'), function(i, j) {
	// 		$.ajax({
	// 			type: 'post',
	// 			url: $(this).data('href'),
	// 			// data: $(this).serialize(),
	// 			success: function(r) {
	// 				console.log('ajax delete form was submitted');
	// 			}
	// 		});
	// 	});
	// 	window.location.href = "<?= $controller_name ?>";
	// });

	$(document).ready(function() {
					$(window).keydown(function(event) {
						if (event.keyCode == 13) {
							event.preventDefault();
							return false;
						}
					});
				});
	/*	NEO	*/
	$(document).on("change", '[name="price"],[name="quantity"],[name="quantity_kit"],[name="discount"],[name="description"],[name="serialnumber"],[name="discounted_total"]', function(e) {
		
		e.preventDefault();
		var $this = $(this);
		var url = $this.parents("tr").prevAll("form:first").attr('action');
		updateFormElements($this, url);

	});

	
	$(document).on('change', '[name="discount_toggle"]', function (e) {
		e.preventDefault();
		var $this = $(this);
		// $('#cart_' + $(this).attr('data-line')).find('[name="discount_type"]').remove();
		// var input = $("<input>").attr("type", "hidden").attr("name", "discount_type").val(($(this).prop('checked')) ? 1 : 0);
		// $('#cart_' + $(this).attr('data-line')).append($(input));
		var dis_toggle = ($(this).prop('checked')) ? 1 : 0;
		var url = $('#cart_' + $(this).attr('data-line')).attr('action');
		updateFormElements($this, url);
	});


	$(document).on("click", ".update_item", function (e) {
		e.preventDefault();
		var rel = $(this).attr("rel");
		var url = $("#" + rel).attr("action");
		var $this = $(this);
		updateFormElements($this, url);
	});

	function updateFormElements($this, url){
		if ($this.parents("tr").find('[name="location"]').length) {
			var location = $this.parents("tr").find('[name="location"]').val();
		} else {
			var location = $this.parents("tr").find('[name="location"]').val();
		}

		if ($this.parents("tr").find('[name="location"]').length) {
			var location = $this.parents("tr").find('[name="location"]').val();
		} else {
			var location = $this.parents("tr").prev("tr").find('[name="location"]').val();
		}

		if ($this.parents("tr").find('[name="price"]').length) {
			var price = $this.parents("tr").find('[name="price"]').val();
		} else {
			var price = $this.parents("tr").prev("tr").find('[name="price"]').val();
		}


		if ($this.parents("tr").find('[name="quantity"]').length) {
			var quantity = $this.parents("tr").find('[name="quantity"]').val();
		} else {
			var quantity = $this.parents("tr").prev("tr").find('[name="quantity"]').val();
		}

		if ($this.parents("tr").find('[name="quantity_kit"]').length) {
			var quantity_kit = $this.parents("tr").find('[name="quantity_kit"]').val();
		} else {
			var quantity_kit = $this.parents("tr").prev("tr").find('[name="quantity_kit"]').val();
		}

		if ($this.parents("tr").find('[name="discount"]').length) {
			var discount = $this.parents("tr").find('[name="discount"]').val();
		} else {
			var discount = $this.parents("tr").prev("tr").find('[name="discount"]').val();
		}
		if ($this.parents("tr").find('[name="discount_type"]').length) {
			var discount_type = $this.parents("tr").find('[name="discount_type"]').val();
		} else {
			var discount_type = $this.parents("tr").prev("tr").find('[name="discount_type"]').val();
		}
		var toggle = dis_toggle = ($this.parents("tr").find('[name="discount_toggle"]').prop('checked')) ? 1 : 0;
		
		if ($this.parents("tr").find('[name="description"]').length) {
			var description = $this.parents("tr").find('[name="description"]').val();
		} else {
			var description = $this.parents("tr").next("tr").find('[name="description"]').val();
		}

		if ($this.parents("tr").find('[name="serialnumber"]').length) {
			var serialnumber = $this.parents("tr").find('[name="serialnumber"]').val();
		} else {
			var serialnumber = $this.parents("tr").next("tr").find('[name="serialnumber"]').val();
		}

		var data = {
			"csrf_ospos_v3": $('[name="csrf_ospos_v3"]').val(),
			"location": location,
			"price": price,
			"quantity": quantity,
			"quantity_kit": quantity_kit,
			"discount": discount,
			"discount_type": toggle,
			"description": description,
			"serialnumber": serialnumber
		};

		$.ajax({
			url: url,
			type: 'POST',
			data: data,
			success: function (r) {
				setData(r);
				$('.selectpicker').selectpicker('refresh');
				$('[data-toggle="toggle"]').bootstrapToggle('refresh');
				// window.location.href = "<?= base_url($controller_name); ?>";
			}

		});
	}


});


$(function () {

	$("#get_list_cat").click(function (e) {
		e.preventDefault();
		var result = "";
		if ($(".hide_cat").length > 0)
			return true;

		jQuery.ajax({
			url: "sales/get_cat",
			type: 'get',
			success: function (r) {
				var data = jQuery.parseJSON(r);
				var type;
				$.each(data, function (i, v) {
					if(v.kit_category){
						type = 'kit';
					}else{
						type = '';
					}
					if (v.category)
						result += "<a class='sales__category--item' data-type='"+ type +"' rel='" + v.category + "'  href='#'>" + v.category + "</a>";
				});
				$(".list-of-categories").show();
				$(".list-of-categories").html(result);
				$(".show_categories--button span").text("Ocultar categorías");
				$(".show_categories--button").addClass("hide_cat");
			}

		});

	});

	$(document).on("click", ".hide_cat", function (e) {
		e.preventDefault();
		$(".show_categories--button span").text("Mostrar categorías");
		$(".show_categories--button").removeClass("hide_cat");
		$(".list-of-categories").hide();
		$(".list-of-items").hide();
	});

	$(document).on("click", ".list-of-categories a", function (e) {
		e.preventDefault();
		var result = "", url;
		var cat = $(this).attr("rel");
		var type = $(this).data('type');
		if(type == "kit"){
			url = "sales/get_item_kit_by_cat";
		}else{
			url = "sales/get_item_by_cat";
		}
		jQuery.ajax({
			url: url,
			type: 'get',
			data: {
				"cat": cat
			},
			success: function (r) {
				var data = jQuery.parseJSON(r);
				var result = "";
				var iconSrc;
				$.each(data, function (i, item) {

					if (item.icon) {
						iconSrc = item.icon;
					}else{
						iconSrc = "<?php echo site_url('items/pic_thumb/no-img.png'); ?>";
					}

					result += "<div class='sales__category--images--wrapper'>";
					result += "<div class='sales__category--image'>";
					result += "<a href='' class='select_item' rel='" + item.value + "'>";
					result += "<img class='item-category-image' src='" + iconSrc + "' style='max-width: 60px; max-height: 60px;'>";
					result += "</a>";
					result += "<span class='sales__category--caption'>" + item.label + "</span>";
					result += "</div>";
					result += "</div>";

				});
				$(".list-of-items").show();
				$(".list-of-items").html(result);
				$('.selectpicker').selectpicker('refresh');
				$('[data-toggle="toggle"]').bootstrapToggle('refresh');
			}

		});
	});


});
$('.selectpicker').selectpicker('refresh');
</script>

<?php } $this->load->view("partial/footer"); /*V1.1*/?>