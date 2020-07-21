<?php
/*V1.1 All Pages Was Update to ajax*/
 if (!$this->input->is_ajax_request())
	$this->load->view("partial/header"); ?>
<form>
<?php
if (isset($error))
{
	echo "<div class='alert alert-dismissible alert-danger'>".$error."</div>";
}

if (!empty($warning))
{
	echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if (isset($success))
{
	echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>
</form>
<style type="text/css">
    .item-img{
        height: 35px;
        width: 35px;
        display: inline;
        margin-right: 5px;
    }
	@media(max-width: 1000px){
		#register_wrapper-pos, #overall_sale{
			width: 100%;
		}
		#overall_sale{
		    padding-top: 10px;
		    padding-bottom: 10px;
		    margin-top: 20px;
		}
		.container{
		    width: 100%;
		}
		#overall_sale .btn{
		    margin: 0;
		}
		#register_wrapper-pos .table-responsive{
		    max-height: 625px;
		    overflow-y: scroll;
		}
		table{
		    font-size: 18px;
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
  			width: 300px;
			margin: 0 auto;
			line-height: 1;
  			-webkit-line-clamp: 3;
  			-webkit-box-orient: vertical;
  			overflow: hidden;
  			text-overflow: ellipsis;
		}

		#precio {
    		width: 65px;
		}

		#cantidad {
    		width: 65px;
		}

		#desc {
    		width: 40px;
		}
	}
</style>
<div id="pos">
<div id="register_wrapper">
<!-- Top register controls -->
	<?php $tabindex = 0; ?>
	<?php echo form_open($controller_name."/change_mode?action=pos", array('id'=>'mode_form', 'class'=>'form-horizontal panel panel-default')); ?>
		<div class="panel-body form-group">
			<ul>				<!--
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('sales_mode'); ?></label>
				</li>			-->
				<li class="pull-left">
					<?php echo form_dropdown('mode', $modes, $mode, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php
				if($this->config->item('dinner_table_enable') == TRUE)
				{
				?>					<!--
					<li class="pull-left first_li">
						<label class="control-label"><?php echo $this->lang->line('sales_table'); ?></label>
					</li>			-->
					<li class="pull-left">
						<?php echo form_dropdown('dinner_table', $empty_tables, $selected_table, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
					</li>
				<?php
				}
				if(count($stock_locations) > 1)
				{
				?>					<!--
					<li class="pull-left">
						<label class="control-label"><?php echo $this->lang->line('sales_stock_location'); ?></label>
					</li>			-->
					<li class="pull-left">
						<?php echo form_dropdown('stock_location', $stock_locations, $stock_location, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
					</li>
				<?php
				}
				?>

				<li class="pull-right">
					<button class='btn btn-default btn-sm modal-dlg' id='show_suspended_sales_button' data-href="<?php echo site_url($controller_name."/suspended"); ?>"
							title="<?php echo $this->lang->line('sales_suspended_sales'); ?>">
						<span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspended_sales'); ?>
					</button>
				</li>

				<?php
				if($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id')))
				{
				?>
					<li class="pull-right">
						<?php echo anchor($controller_name."/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'),
									array('class'=>'btn btn-primary btn-sm', 'id'=>'sales_takings_button', 'title'=>$this->lang->line('sales_takings'))); ?>
					</li>
				<?php
				}
				?>
			</ul>
		</div>

	<?php echo form_close(); ?>

	<?php echo form_open($controller_name."/add?action=pos", array('id'=>'add_item_form', 'class'=>'form-horizontal panel panel-default')); ?>
		<div class="panel-body form-group">
			<ul>			<!--
				<li class="pull-left first_li">
					<label for="item" class='control-label'><?php echo $this->lang->line('sales_find_or_scan_item_or_receipt'); ?></label>
				</li>		-->
				<li class="pull-left sales_search">
					<?php echo form_input(array('name'=>'item', 'id'=>'item', 'class'=>'form-control input-sm', 'size'=>'40', 'tabindex'=>++$tabindex,'placeholder'=>$this->lang->line('sales_start_typing_item_name'))); ?>
					<span class="ui-helper-hidden-accessible" role="status"></span>
					<button id='new_item_button' class='btn btn-info btn-sm pull-right modal-dlg' data-btn-new='<?php echo $this->lang->line('common_new') ?>' data-btn-submit='<?php echo $this->lang->line('common_submit')?>' data-href='<?php echo site_url("items/view"); ?>'
							title='<?php echo $this->lang->line($controller_name . '_new_item'); ?>'>
						<span class="glyphicon glyphicon-tag">&nbsp</span>
						<span class="text"><?php echo $this->lang->line($controller_name. '_new_item'); ?></span>
					</button>
					<i class="fa fa-question-circle flashit flashstyle" data-toggle="tooltip" title="Seach Item Here"></i>
				</li>
			
				<?php
				if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id')))
				{
				?>

				<?php
				}
				?>

				<div class="sales_category__panel--toggle-button" id="get_list_cat">				
					<button type="button" class="show_categories--button"><i class="fas fa-sort"></i><span>Show Categories</span></button>
				</div>

			</ul>
		</div>
	<?php echo form_close(); ?>


<?php /* 

		<a href="#" id="get_list_cat">get_list_cat</a>
	<ul class="list-of-categories">
				
	</ul>

	<div class="list-of-items"></div>
  */ ?>
<div class="sales_category">
	<div class="panel-body form-group">
		<div class="sales_category__panel">		<!--
			<div class="sales_category__panel--title">
				<label class="">Productos <?php echo $this->config->item('company'); ?></label>
			</div>
			<div class="sales_category__panel--toggle-button" id="get_list_cat">				
				<button type="button" class="show_categories--button"><i class="fa item_kits show_category-icon"></i><span>Show Categories</span></button>
			</div>
												-->
		</div>

		<div class="sales__category--wrapper list-of-categories" style="display: block">
					
		</div>		
	</div>
</div>

<div class="sales_category">
	<div class="sales_category_image panel-body form-group list-of-items" style="display: none">

	</div>
</div>
            </div>


<!-- Overall Sale -->

<div id="overall_sale" class="panel panel-default">		<!--
<ul class="customers_sales_buttons">
				<div class="btn-group">
					<button type="button" class="btn btn-more dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="ion-android-more-horizontal"></i>
					</button>
					<ul class="dropdown-menu sales-dropdown" role="menu">				
						<?php 
							$active1=$active2=$active3=$active4="";

							if($mode=="sale"){
								$active1="active";
							}else if($mode=="sale_invoice"){
								$active2="active";
							}else if($mode=="sale_quote"){
								$active3="active";
							}else if($mode=="return"){
								$active4="active";
							}else{
								$active1="active";
							}
						?>
						<li>
							<a href="#" class="r_mode <?php echo $active1; ?>" rel="sale">Sale</a>
						</li>

						<li>
							<a href="#" class="r_mode <?php echo $active2; ?>" rel="sale_invoice">Sale by Invoice</a>
						</li>

						<li>
							<a href="#" class="r_mode <?php echo $active3; ?>" rel="sale_quote" >Quote</a>
						</li>

						<li>
							<a href="#" class="r_mode <?php echo $active4; ?>" rel="return">Return</a>
						</li>					
					</ul>
                </div>

				<li class="pull-right">
					<button class='btn btn-default btn-sm modal-dlg' id='show_suspended_sales_button' data-href='<?php echo site_url($controller_name."/suspended"); ?>'
							title='<?php echo $this->lang->line('sales_suspended_sales'); ?>'>
						<span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspended_sales'); ?>
					</button>
				</li>
			
				<?php
				if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id')))
				{
				?>
					<li class="pull-right">						
						<?php echo anchor($controller_name."/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'), 
									array('class'=>'btn btn-primary btn-sm', 'id'=>'sales_takings_button', 'title'=>$this->lang->line('sales_takings'))); ?>
					</li>
				<?php
				}
				?>
			</ul>		-->
            <div class="new_customer_container">
					<?php echo form_input(array('name'=>'customer', 'id'=>'customer', 'class'=>'form-control input-sm', 'value'=>$this->lang->line('sales_start_typing_customer_name')));?>

					<button class='btn btn-info btn-sm modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("customers/view"); ?>'
							title='<?php echo $this->lang->line($controller_name. '_new_customer'); ?>'>
						<span class="glyphicon glyphicon-user">&nbsp</span><!--<?php echo $this->lang->line($controller_name. '_new_customer'); ?>-->
					</button>
					</div>
    <!-- Sale Items List -->
    <div id="register_wrapper-pos">
	<div class="table-responsive">
	<table class="sales_table_100 t_holder_table" id="register">
		<thead class="register_table_heading">
			<tr>
				<th style="width: 5%;"><span class="glyphicon glyphicon-trash"></th>
		<!--	<th style="width: auto !important; float: none;"><?php echo $this->lang->line('sales_item_number'); ?></th>		-->
				<th style="width: 35%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
				<th style="width: 17%;"><?php echo $this->lang->line('sales_price'); ?></th>
				<th style="width: 14%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
				<th style="width: 20%;"><?php echo $this->lang->line('sales_discount'); ?></th>
				<th style="width: 16%;"><?php echo $this->lang->line('sales_total'); ?></th>
				<!-- <th style="width: 5%;"><?php echo $this->lang->line('sales_update'); ?></th> -->
			</tr>
		</thead>

		<tbody id="cart_contents">
			<?php
			if(count($cart) == 0)
			{
			?>
				<tr>
					<td colspan='8'>
						<div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
					</td>
				</tr>
			<?php
			}
			else
			{				
				foreach(array_reverse($cart, true) as $line=>$item)
				{					
			?>
					<?php echo form_open($controller_name."/edit_item/$line?action=pos", array('class'=>'form-horizontal', 'id'=>'cart_'.$line)); ?>
						<tr class="form-top">
							<td><?php echo anchor($controller_name."/delete_item/$line?action=pos", '<span class="glyphicon glyphicon-trash"></span>',array("class"=>"delete_item"));?></td>
					<!--	<td><?php echo $item['item_number']; ?></td>	-->
							<td style="align: center;">
								<?php echo $item['name']; ?>
								<span style="font-weight:bold">
								<?php //if($item['stock_type'] == '0'): echo '[' . to_quantity_decimals($item['in_stock']) . ' in ' . $item['stock_name'] . ']'; endif; ?>
								</span>
								<?php echo form_hidden('location', $item['item_location']); ?>
							</td>

							<?php
							if ($items_module_allowed)
							{
							?>
								<td><?php echo form_input(array('id'=>'precio', 'name'=>'price', 'class'=>'form-control input-sm', 'value'=>to_currency_no_money($item['price']), 'tabindex'=>++$tabindex, 'onClick'=>'this.select();'));?></td>
							<?php
							}
							else
							{
							?>
								<td>
									<?php echo to_currency($item['price']); ?>
									<?php echo form_hidden('price', to_currency_no_money($item['price'])); ?>
								</td>
							<?php
							}
							?>

							<td>
								<?php
								if($item['is_serialized']==1)
								{
									echo to_quantity_decimals($item['quantity']);
									echo form_hidden('quantity', $item['quantity']);
								}
								else
								{
									echo form_input(array('name'=>'quantity', 'class'=>'form-control input-sm', 'value'=>to_quantity_decimals($item['quantity']), 'tabindex'=>++$tabindex, 'onClick'=>'this.select();'));
								}
								?>
							</td>

							<td>
								<div id="des" class="input-group">
									<?php echo form_input(array('name'=>'discount', 'class'=>'form-control input-sm', 'value'=>$item['discount'], 'tabindex'=>++$tabindex, 'onClick'=>'this.select();')); ?>
									<span class="input-group-btn">
										<?php echo form_checkbox(array('id'=>'discount_toggle', 'name'=>'discount_toggle', 'value'=>1, 'data-toggle'=>"toggle",'data-size'=>'small', 'data-onstyle'=>'success', 'data-on'=>'<b>'.$this->config->item('currency_symbol').'</b>', 'data-off'=>'<b>%</b>', 'data-line'=>$line, 'checked'=>$item['discount_type'])); ?>
									</span>
								</div> 
							</td>

							<td>
								<?php
								if($item['item_type'] == ITEM_AMOUNT_ENTRY)
								{
									echo form_input(array('name'=>'discounted_total', 'class'=>'form-control input-sm', 'value'=>to_currency_no_money($item['discounted_total']), 'tabindex'=>++$tabindex, 'onClick'=>'this.select();'));
								}
								else
								{
									echo to_currency($item['discounted_total']);
								}
								?>
							</td>

						</tr>
						<?php /*
						<tr class="form-bottom">
							<?php 
							if($item['allow_alt_description']==1)
							{
							?>
								<td style="color: #2F4F4F;"><?php echo $this->lang->line('sales_description_abbrv');?></td>
							<?php 
							}
							?>
							<!-- Moustafa just align-->
							<td colspan='2' style="text-align: center;">
								<?php
								if($item['allow_alt_description']==1)
								{
									echo form_input(array('name'=>'description', 'class'=>'form-control input-sm', 'value'=>$item['description']));
								}
								else
								{
									if ($item['description']!='')
									{
										echo $item['description'];
										echo form_hidden('description', $item['description']);
									}
									else
									{
										echo $this->lang->line('sales_no_description');
										echo form_hidden('description','');
									}
								}
								?>
							</td>
							<td>&nbsp;</td>
							<td style="color: #2F4F4F;">
								<?php
								if($item['is_serialized']==1)
								{
									echo $this->lang->line('sales_serial');
								}
								?>
							</td>
							<td colspan='4' style="text-align: center;">
								<?php
								if($item['is_serialized']==1)
								{
									echo form_input(array('name'=>'serialnumber', 'class'=>'form-control input-sm', 'value'=>$item['serialnumber']));
								}
								else
								{
									echo form_hidden('serialnumber', '');
								}
								?>
							</td>
						</tr>
						*/ 
						?>
					<?php echo form_close(); ?>
			<?php
				}
			}
			?>
		</tbody>
	</table>
	</div>
	</div>
	<div class="panel-body">
			
<?php echo form_open($controller_name."/change_mode?action=pos", array('id'=>'mode_form', 'class'=>'form-horizontal panel panel-default form_register_mode')); ?>
		<div class="panel-body form-group">
			<ul>
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('sales_mode'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_dropdown('mode', $modes, $mode, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php
				if($this->config->item('dinner_table_enable') == TRUE)
				{
				?>
					<li class="pull-left first_li">
						<label class="control-label"><?php echo $this->lang->line('sales_table'); ?></label>
					</li>
					<li class="pull-left">
						<?php echo form_dropdown('dinner_table', $empty_tables, $selected_table,array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
					</li>
				<?php
				}
				if (count($stock_locations) > 1)
				{
				?>
					<li class="pull-left">
						<label class="control-label"><?php echo $this->lang->line('sales_stock_location'); ?></label>
					</li>
					<li class="pull-left">
						<?php echo form_dropdown('stock_location', $stock_locations, $stock_location, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
					</li>
				<?php
				}
				?>


			</ul>
		</div>

	<?php echo form_close(); ?>

		<?php
		if(isset($customer))
		{
		?>
			<table class="sales_table_100 customer_summary">
				<tr>
					<th style='width: 55%;'><?php echo $this->lang->line("sales_customer"); ?></th>
					<th style="width: 45%; text-align: right;"><?php echo $customer; ?></th>
				</tr>
				<tr>
						<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_email"); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
					</tr>
				<?php
				if(!empty($customer_email))
				{
				?>
					<tr>
						<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_email"); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
					</tr>
				<?php
				}
				?>
				<?php
				if(!empty($customer_address))
				{
				?>
					<tr>
						<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_address"); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo $customer_address; ?></th>
					</tr>
				<?php
				}
				?>
				<?php
				if(!empty($customer_location))
				{
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
					<th style="width: 45%; text-align: right;"><?php echo $customer_discount_percent . ' %'; ?></th>
				</tr>
				<?php if($this->config->item('customer_reward_enable') == TRUE): ?>
				<?php
				if(!empty($customer_rewards) &&  isset($customer_rewards))
				{
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
					<th style="width: 45%; text-align: right; position: absolute; right: 5px;"><?php echo to_currency($customer_total); ?></th>
				</tr>
			</table>

			<?php echo anchor($controller_name."/remove_customer", '<span class="glyphicon glyphicon-remove">&nbsp</span>' . $this->lang->line('common_remove').' '.$this->lang->line('customers_customer'),
								array('class'=>'btn btn-danger btn-sm', 'id'=>'remove_customer_button', 'title'=>$this->lang->line('common_remove').' '.$this->lang->line('customers_customer'))); ?>
		<?php
		}
		else
		{
		?>
			<?php echo form_open($controller_name."/select_customer?action=pos", array('id'=>'select_customer_form', 'class'=>'form-horizontal')); ?>
				<div class="form-group" id="select_customer">
				<!--Moustafa-->
					<!--<label id="customer_label" for="customer" class="control-label" style="margin-bottom: 1em; margin-top: -1em;"><?php echo $this->lang->line('sales_select_customer'); ?></label>-->

				</div>
			<?php echo form_close(); ?>
		<?php
		}
		?>

		<table style="position: relative" class="sales_table_100" id="sale_totals">
			<tr>
				<th style="width: 55%;"><?php echo $this->lang->line('sales_sub_total'); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo to_currency($this->config->item('tax_included') ? $tax_exclusive_subtotal : $subtotal); ?></th>
			</tr>
			
			<?php
			foreach($taxes as $name=>$value)
			{
			?>
				<tr>
					<th style='width: 55%;float: left'><?php echo $name; ?></th>
					<th style="text-align: right; float: right; right:0"><?php echo to_currency($value); ?></th>
				</tr>
			<?php
			}
			?>

			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line('sales_total'); ?></th>
				<th style="text-align: right; float:right;"><?php echo to_currency($total); ?></th>
			</tr>
		</table>
	
		<?php
		// Only show this part if there are Items already in the sale.
		if(count($cart) > 0)
		{
		?>
			<table class="sales_table_100" id="payment_totals">
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_payments_total');?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency($payments_total); ?></th>
				</tr>
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_amount_due');?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency($amount_due); ?></th>
				</tr>
			</table>

			<div id="payment_details">
				<?php
				// Show Complete sale button instead of Add Payment if there is no amount due left
				if($payments_cover_total)
				{
				?>
					<?php echo form_open($controller_name."/add_payment?action=pos", array('id'=>'add_payment_form', 'class'=>'form-horizontal')); ?>
						<table class="sales_table_100">
							<tr>
						<!--	<td><?php echo $this->lang->line('sales_payment');?></td>	-->
								<td>
									<?php echo form_dropdown('payment_type', $payment_options, array(), array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'auto', 'disabled'=>'disabled')); ?>
								</td>
								<td>
									<?php echo form_input(array('name'=>'amount_tendered', 'id'=>'amount_tendered', 'class'=>'form-control input-sm disabled', 'disabled'=>'disabled', 'value'=>'0', 'size'=>'5', 'tabindex'=>++$tabindex)); ?>
								</td>
							</tr>
							<tr>
						<!--	<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>	-->
								
							</tr>
						</table>
					<?php echo form_close(); ?>
	   					<?php
	    				// Only show this part if the payment cover the total and in sale or return mode
		    			if ($pos_mode == '1')
			    		{
				    	?>
  						<div class='btn btn-sm btn-success pull-right' id='finish_sale_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>

  						<div class='btn btn-sm btn-default pull-center' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
					<?php
					// Only show this part if the payment cover the total
					if ($quote_or_invoice_mode && isset($customer))
					{
					?>
					<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
					<?php
					}
					?>
					<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>



						<?php
    					}
	   					?>
 				<?php
				}
				else
				{
				?>
					<?php echo form_open($controller_name."/add_payment?action=pos", array('id'=>'add_payment_form', 'class'=>'form-horizontal')); ?>
						<table class="sales_table_100">
							<tr>
					<!--		<td><?php echo $this->lang->line('sales_payment');?></td>	-->
								<td>
									<?php echo form_dropdown('payment_type', $payment_options, array(), array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'auto')); ?>
								</td>
								<td>
									<?php echo form_input(array('name'=>'amount_tendered', 'id'=>'amount_tendered', 'class'=>'form-control input-sm', 'value'=>to_currency_no_money($amount_due), 'size'=>'5', 'tabindex'=>++$tabindex)); ?>
								</td>
							</tr>
							<tr>
						<!--	<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>	-->
								
							</tr>
						</table>
					<?php echo form_close(); ?>

					<div class='btn btn-sm btn-success pull-right' id='add_payment_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>


					<div class='btn btn-sm btn-default pull-center' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
					<?php
					// Only show this part if the payment cover the total
					if ($quote_or_invoice_mode && isset($customer))
					{
					?>
					<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
					<?php
					}
					?>
					<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>



				<?php
				}
				?>

				<?php
				// Only show this part if there is at least one payment entered.
				if(count($payments) > 0)
				{
				?>
					<table class="sales_table_100 amount_table" id="register">
						<thead>
							<tr>
								<th style="width: 35% !important;"><?php echo $this->lang->line('common_delete'); ?></th>
								<th style="width: 100%; float:none;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
								<th style="width: 20%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
							</tr>
						</thead>
			
						<tbody id="payment_contents">
							<?php
							foreach($payments as $payment_id=>$payment)
							{
							?>
								<tr>
									<td><?php echo anchor($controller_name."/delete_payment/$payment_id?action=pos", '<span class="glyphicon glyphicon-trash"></span>'); ?></td>
									<td><?php echo $payment['payment_type']; ?></td>
									<td style="text-align: center;"><?php echo to_currency( $payment['payment_amount'] ); ?></td>
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
  						
			<?php echo form_open($controller_name."/cancel?action=pos", array('id'=>'buttons_form')); ?>
				<div class="form-group" id="buttons_sale">
					
<!--
<div class='btn btn-sm btn-success pull-left' id='finish_sale_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>			-->
<!--
					<div class='btn btn-sm btn-default pull-center' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
					<?php
					// Only show this part if the payment cover the total
					if ($quote_or_invoice_mode && isset($customer))
					{
					?>
					<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
					<?php
					}
					?>


					<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>	-->
				</div>
			<?php echo form_close(); ?>


			<?php
			// Only show this part if the payment cover the total
			if(1 != 1)
			{
			?>
				<div class="container-fluid">
					<div class="no-gutter row">
						<div class="form-group form-group-sm">
							<div class="col-xs-12">
								<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class'=>'control-label', 'id'=>'comment_label', 'for'=>'comment')); ?>
								<?php echo form_textarea(array('name'=>'comment', 'id'=>'comment', 'class'=>'form-control input-sm', 'value'=>$comment, 'rows'=>'2')); ?>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="form-group form-group-sm">
							<div class="col-xs-6">
								<label for="sales_print_after_sale" class="control-label checkbox">
									<?php echo form_checkbox(array('name'=>'sales_print_after_sale', 'id'=>'sales_print_after_sale', 'value'=>1, 'checked'=>$print_after_sale)); ?>
									<?php echo $this->lang->line('sales_print_after_sale')?>
								</label>
							</div>

							<?php
							if(!empty($customer_email))
							{
							?>
								<div class="col-xs-6">
									<label for="email-receipt" class="control-label checkbox">
										<?php echo form_checkbox(array('name'=>'email_receipt', 'id'=>'email_receipt', 'value'=>1, 'checked'=>$email_receipt)); ?>
										<?php echo $this->lang->line('sales_email_receipt');?>
									</label>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				<?php
				if (($mode == "sale") && $this->config->item('invoice_enable') == TRUE)
				{
				?>
					<div class="row">
						<div class="form-group form-group-sm">

							<div class="col-xs-6">
								<label class="control-label checkbox" for="sales_invoice_enable">
									<?php echo form_checkbox(array('name'=>'sales_invoice_enable', 'id'=>'sales_invoice_enable', 'value'=>1, 'checked'=>$invoice_number_enabled)); ?>
									<?php echo $this->lang->line('sales_invoice_enable');?>
								</label>
							</div>

							<div class="col-xs-6">
								<div class="input-group input-group-sm">
									<span class="input-group-addon input-sm">#</span>
									<?php echo form_input(array('name'=>'sales_invoice_number', 'id'=>'sales_invoice_number', 'class'=>'form-control input-sm', 'value'=>$invoice_number));?>
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

<?php 
/*V1.1*/
if (!$this->input->is_ajax_request()){ ?>
<script type="text/javascript">
$(document).ready(function()
{
	
	$(document).on("click",".ui-menu-item",function(e){
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
		
		return false;
	}
  });

  function processJson(data) {
  	setData(data);
	$("#item").val("");
	$("#item").focus();
	}


  $project.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    
    var $li = $('<li>'),
        $img = $('<img>');

       if(item.icon){
       		var iconSrc=item.icon;
	    }else{
	    	var iconSrc="<?php echo base_url('items/pic_thumb/no-img.png'); ?>";
	    }
	    $img.attr({
	      src:iconSrc,
	      alt: item.label,
	      class:"icon_autocomplete"

	    });

    $li.attr('data-value', item.label);
    $li.append('<a href="#">');
    var label ="<span class='item_label'>"+item.label+"</span>";
    $li.find('a').append($img).append(label);    

    return $li.appendTo(ul);
  };
  /*V1.1*/
 // $('#item').focus();
	$('#item').keypress(function (e) {
		if (e.which == 13) {
			$('#add_item_form').ajaxSubmit({
					      	  success: processJson
					   		 });
			return false;
		}
	});

	 $(document).on("click",".select_item",function(e) {
		 e.preventDefault();
		var id= $(this).attr("rel");
		$(".sales_search #item").val(id);
		
		$("#add_item_form").ajaxSubmit({
      	  success: processJson
   		 });

	});

    $('#item').blur(function()
    {
        $(this).val("<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
    });

    var clear_fields = function()
    {
        if ($(this).val().match("<?php echo $this->lang->line('sales_start_typing_item_name') . '|' . $this->lang->line('sales_start_typing_customer_name'); ?>"))
        {
            $(this).val('');
        }
    };

    $("#customer").autocomplete(
    {
		source: '<?php echo site_url("customers/suggest"); ?>',
    	minChars: 0,
    	delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#select_customer_form").submit();
		}
    });

	$('#item, #customer').click(clear_fields).dblclick(function(event)
	{
		$(this).autocomplete("search");
	});

	$('#customer').blur(function()
    {
    	$(this).val("<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
    });

	$('#comment').keyup(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_comment");?>', {comment: $('#comment').val()});
	});

	<?php
	if ($this->config->item('invoice_enable') == TRUE) 
	{
	?>
		$('#sales_invoice_number').keyup(function() 
		{
			$.post('<?php echo site_url($controller_name."/set_invoice_number");?>', {sales_invoice_number: $('#sales_invoice_number').val()});
		});

		var enable_invoice_number = function() 
		{
			var enabled = $("#sales_invoice_enable").is(":checked");
			$("#sales_invoice_number").prop("disabled", !enabled).parents('tr').show();
			return enabled;
		}

		enable_invoice_number();
		
		$("#sales_invoice_enable").change(function()
		{
			var enabled = enable_invoice_number();
			$.post('<?php echo site_url($controller_name."/set_invoice_number_enabled");?>', {sales_invoice_number_enabled: enabled});
		});
	<?php
	}
	?>

	$("#sales_print_after_sale").change(function()
	{
		$.post('<?php echo site_url($controller_name."/set_print_after_sale");?>', {sales_print_after_sale: $(this).is(":checked")});
	});
	
	$('#email_receipt').change(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_email_receipt");?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
	});
	
    $(document).on("click","#finish_sale_button",function()
    {
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/complete?action=pos"); ?>');
		$('#buttons_form').submit();
    });

    $(document).on("click","#finish_invoice_quote_button",function()
    {
        $('#buttons_form').attr('action', '<?php echo site_url($controller_name."/complete?action=pos"); ?>');
        $('#buttons_form').submit();
    });

    $(document).on("click","#suspend_sale_button",function()
	{ 	
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/suspend?action=pos"); ?>');
		$('#buttons_form').submit();
	});

    $(document).on("click","#cancel_sale_button",function()
    {
    	if (confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
    	{
			$('#buttons_form').attr('action', '<?php echo site_url($controller_name."/cancel?action=pos"); ?>');
    		$('#buttons_form').submit();
    	}
    });

	$(document).on("click","#add_payment_button",function()
	{
		$('#add_payment_form').submit();
    });

	$("#payment_types").change(check_payment_type_giftcard).ready(check_payment_type_giftcard);

	$("#cart_contents input").keypress(function(event)
	{
		if (event.which == 13)
		{
			$(this).parents("tr").prevAll("form:first").submit();
		}
	});

	$("#amount_tendered").keypress(function(event)
	{
		if( event.which == 13 )
		{
			$('#add_payment_form').submit();
		}
	});
	
    $("#finish_sale_button").keypress(function(event)
	{
		if ( event.which == 13 )
		{
			$('#finish_sale_form').submit();
		}
	});

	dialog_support.init("a.modal-dlg, button.modal-dlg");

	table_support.handle_submit = function(resource, response, stay_open)
	{
		if(response.success) {
			if (resource.match(/customers$/))
			{
				$("#customer").val(response.id);
				$("#select_customer_form").submit();
			}
			else
			{
				var $stock_location = $("select[name='stock_location']").val();
				$("#item_location").val($stock_location);
				$("#item").val(response.id);
				if (stay_open)
				{
					$("#add_item_form").ajaxSubmit();
				}
				else
				{
					$("#add_item_form").submit();
				}
			}
		}
	}

	$(document).on("focusout",'[name="price"],[name="quantity"],[name="discount"],[name="description"],[name="serialnumber"]',function() {
		
		var input=$(this).attr("name");
		var value =$(this).val();
		
		if($(this).parents("tr").find('[name="location"]').length){
			var location =$(this).parents("tr").find('[name="location"]').val();
		}else{
			var location = $(this).parents("tr").find('[name="location"]').val();
		}

		if($(this).parents("tr").find('[name="location"]').length){
			var location =$(this).parents("tr").find('[name="location"]').val();
		}else{
			var location = $(this).parents("tr").prev("tr").find('[name="location"]').val();
		}

		if($(this).parents("tr").find('[name="price"]').length){
			var price =$(this).parents("tr").find('[name="price"]').val();
		}else{
			var price = $(this).parents("tr").prev("tr").find('[name="price"]').val();
		}


		if($(this).parents("tr").find('[name="quantity"]').length){
			var quantity =$(this).parents("tr").find('[name="quantity"]').val();
		}else{
			var quantity = $(this).parents("tr").prev("tr").find('[name="quantity"]').val();
		}

		if($(this).parents("tr").find('[name="discount"]').length){
			var discount =$(this).parents("tr").find('[name="discount"]').val();
		}else{
			var discount = $(this).parents("tr").prev("tr").find('[name="discount"]').val();
		}

		if($(this).parents("tr").find('[name="description"]').length){
			var description =$(this).parents("tr").find('[name="description"]').val();
		}else{
			var description = $(this).parents("tr").next("tr").find('[name="description"]').val();
		}

		if($(this).parents("tr").find('[name="serialnumber"]').length){
			var serialnumber =$(this).parents("tr").find('[name="serialnumber"]').val();
		}else{
			var serialnumber = $(this).parents("tr").next("tr").find('[name="serialnumber"]').val();
		}

		var data={
			"csrf_ospos_v3":$('[name="csrf_ospos_v3"]').val(),
			"location":location,
			"price":price,
			"quantity":quantity,
			"discount":discount,
			"description":description,
			"serialnumber":serialnumber
			};
		$(this).parents("tr").prevAll("form:first").ajaxSubmit({
		  data:data,
      	  success: processJson
   		 });
	});
/*	NEO	*/
	$('[name="price"],[name="quantity"],[name="discount"],[name="description"],[name="serialnumber"],[name="discounted_total"]').change(function() {
		$(this).parents("tr").prevAll("form:first").submit()
	});

	$('[name="discount_toggle"]').change(function() {
		var input = $("<input>").attr("type", "hidden").attr("name", "discount_type").val(($(this).prop('checked'))?1:0);
		$('#cart_'+ $(this).attr('data-line')).append($(input));
		$('#cart_'+ $(this).attr('data-line')).submit();
	});
/*	NEO	FINAL */	
});

function check_payment_type_giftcard()
{
	if ($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
	{
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
		$("#amount_tendered:enabled").val('').focus();
	}
	else
	{
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val('<?php echo to_currency_no_money($amount_due); ?>');
	}
}
function setData(data){

	$(".alert").remove();
	$(data).find(".alert").insertBefore("#register_wrapper");

	$("#cart_contents").html($(data).find("#cart_contents").html());
  	$("#sale_totals").html($(data).find("#sale_totals").html());

  	if($(data).find("#payment_totals").length)
  		$("#payment_totals").html($(data).find("#payment_totals").html());
  	else{
  		$("#payment_totals").html("");
  	}
  	if($(data).find("#amount_tendered").length){
  		$("#amount_tendered").val($(data).find("#amount_tendered").val());	
  	}else{
  		$("#amount_tendered").val("0");	
  	}
  	
  	// in first time
  	if($("#finish_sale").length==0){
  		$(data).find("#finish_sale").insertAfter("#sale_totals");
  	}
  	if($("#payment_totals").length==0){
  		$(data).find("#payment_totals").insertAfter("#sale_totals");
  	}
    if($("#payment_details").length==0){
		$(data).find("#payment_details").insertAfter("#payment_totals");  		
  	}
   	if($("#buttons_form").length==0){
 		$(data).find("#buttons_form").insertAfter("#payment_details");  		
  	} 	
  	$('.selectpicker').selectpicker('refresh');
}
	$(function(){

		$(document).on("click",".delete_item",function(e){
			e.preventDefault();
			var url =$(this).attr("href");
			jQuery.ajax({
				url:url,
				success:function(r){
					setData(r);
				}

			});
		});

		$(document).on("click",".update_item",function(e){
			e.preventDefault();
			var rel =$(this).attr("rel");
			var url=$("#"+rel).attr("action");

		if($(this).parents("tr").find('[name="location"]').length){
			var location =$(this).parents("tr").find('[name="location"]').val();
		}else{
			var location = $(this).parents("tr").find('[name="location"]').val();
		}

		if($(this).parents("tr").find('[name="location"]').length){
			var location =$(this).parents("tr").find('[name="location"]').val();
		}else{
			var location = $(this).parents("tr").prev("tr").find('[name="location"]').val();
		}

		if($(this).parents("tr").find('[name="price"]').length){
			var price =$(this).parents("tr").find('[name="price"]').val();
		}else{
			var price = $(this).parents("tr").prev("tr").find('[name="price"]').val();
		}


		if($(this).parents("tr").find('[name="quantity"]').length){
			var quantity =$(this).parents("tr").find('[name="quantity"]').val();
		}else{
			var quantity = $(this).parents("tr").prev("tr").find('[name="quantity"]').val();
		}

		if($(this).parents("tr").find('[name="discount"]').length){
			var discount =$(this).parents("tr").find('[name="discount"]').val();
		}else{
			var discount = $(this).parents("tr").prev("tr").find('[name="discount"]').val();
		}

		if($(this).parents("tr").find('[name="description"]').length){
			var description =$(this).parents("tr").find('[name="description"]').val();
		}else{
			var description = $(this).parents("tr").next("tr").find('[name="description"]').val();
		}

		if($(this).parents("tr").find('[name="serialnumber"]').length){
			var serialnumber =$(this).parents("tr").find('[name="serialnumber"]').val();
		}else{
			var serialnumber = $(this).parents("tr").next("tr").find('[name="serialnumber"]').val();
		}

		var data={
			"csrf_ospos_v3":$('[name="csrf_ospos_v3"]').val(),
			"location":location,
			"price":price,
			"quantity":quantity,
			"discount":discount,
			"description":description,
			"serialnumber":serialnumber
			};
				
			jQuery.ajax({
				url:url,
				type:'POST',
				data:data,
				success:function(r){
					setData(r);
				}

			});
		});


		


	});


	$(function(){


	 $(document).on("click",".list-of-categories a",function(e) {
		 e.preventDefault();
		var result = "";
		var cat= $(this).attr("rel");
		jQuery.ajax({
			url:"sales/get_item_by_cat",
			type:'get',
			data:{
				"cat":cat
			},
			success:function(r){
				var data  = jQuery.parseJSON(r);
				var result ="";
				$.each(data,function(i,item){ 

				     if(item.icon){
				       		var iconSrc=item.icon;
					    }else{
					    	var iconSrc="<?php echo site_url('items/pic_thumb/no-img.png'); ?>";
					    }
						result +="<a href='' class='select_item' rel='"+item.value+"'>";
						result +="<div class='sales__category--images--wrapper'>";
							result +="<div class='sales__category--image'>";
								
								result +="<img class='item-category-image' src='"+iconSrc+"'>";
									
								result +="<span class='sales__category--caption'>"+item.label+"</span>";
							result +="</div>";
						result +="</div>";
						result +="</a>";

				});
				$(".list-of-items").show();
				$(".list-of-items").html(result);
			}

		});	
	});
		$("#get_list_cat").click(function(e){
			e.preventDefault();
			var result = "";
			if($(".hide_cat").length > 0)
				return true;
			
			jQuery.ajax({
				url:"sales/get_cat",
				type:'get',
				success:function(r){
					var data  = jQuery.parseJSON(r);
					$.each(data,function(i,v){
						if(v.category)
						result +="<a class='sales__category--item' rel='"+v.category+"'  href='#'>"+v.category+"</a>";
					});
					$(".list-of-categories").show();
					$(".list-of-categories").html(result);
					$(".show_categories--button span").text(" Ocultar categorías");
					$(".show_categories--button").addClass("hide_cat");
					$(".list-of-categories a:first").click();
				}

			});			
			
		});
	
	$("#get_list_cat").trigger("click");
	 $(document).on("click",".hide_cat",function(e) {
		 e.preventDefault();
		 	$(".show_categories--button span").text(" Mostrar categorías");
			$(".show_categories--button").removeClass("hide_cat");
			$(".list-of-categories").hide();
			$(".list-of-items").hide();
	});


	
	
	});

</script>



<?php 
$this->load->view("partial/footer"); 
}
/*V1.1*/
?>
</div>
