<?php $this->load->view("partial/header"); ?>

<?php /*
<!-- QUICK ICONS -->
<div class="row quick-actions">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
				<?php $today=date('Y-m-d'); ?>
					<a class="list-group-item" href="<?php echo site_url('/reports/detailed_sales/'.$today.'/'.$today.'/all/all');?>"> <i class="ion-stats-bars"></i> Today's detailed sales report</a>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/reports/summary_items/'.$today.'/'.$today.'/all/all');?>"> <i class="ion-clipboard"></i> Today's summary items report</a>
			</div>
		</div>
			
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/receivings');?>"> <i class="ion-ios-cloud-download-outline"></i> Start a New Receiving</a>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/sales');?>"> <i class="ion-ios-cart-outline"></i> Start a New Sale</a>
			</div>
		</div>	
</div>
<!-- End Quick icons -->
*/?>

<!-- Moustafa -->
<div class="quick-actions">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
				<?php $today=date('Y-m-d'); ?>
					<a class="list-group-item" href="<?php echo site_url('/reports/detailed_sales/'.$today.'/'.$today.'/all/all');?>"> <i class="fa info"></i> Informe detallado de ventas de hoy</a>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/reports/summary_items/'.$today.'/'.$today.'/all/all');?>"> <i class="fa product"></i> Informe de articulos de resumen de hoy</a>
			</div>
		</div>
			
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/reports/specific_customer');?>"> <i class="fa credito"></i> Abonar credito</a>
			</div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="list-group">
					<a class="list-group-item" href="<?php echo site_url('/sales');?>"> <i class="fa nuevav"></i> Iniciar una Nueva Venta</a>
			</div>
		</div>	
</div>

<div class="top-boxes">
<div class="rowX">
<a class="boxes-content" href="<?php echo site_url('/reports/detailed_sales');?>">

<div class="col-sm-3 box-wrapper purple">
<div class="box-icon">
<i class="fa fa-newspaper-sales"></i>
</div>

<div class="box-details">
<div class="number"><span>
<?php 
		echo (isset($sales[0]['totals']))?$sales[0]['totals']:0;
	?>
	
</span></div>
<div class="desc">Total de Ventas</div>

</div>


</div>
</a>

<a class="boxes-content" href="<?php echo site_url('/customers');?>">

<div class="col-sm-3 box-wrapper teal">
<div class="box-icon">
<i class="fa fa-newspaper-customer"></i>
</div>
<div class="box-details">
<div class="number"><span>	<?php 
		echo (isset($customers[0]['counts']))?$customers[0]['counts']:0;
	?></span></div>
<div class="desc">

Total de Clientes</div>

</div>
</div>
</a>

<a class="boxes-content" href="<?php echo site_url('/items');?>">

<div class="col-sm-3 box-wrapper green">
<div class="box-icon">
<i class="fas fa-database"></i>
</div>

<div class="box-details">
<div class="number"><span>	<?php 
		echo (isset($count_items[0]['counts']))?$count_items[0]['counts']:0;
	?></span></div>
<div class="desc">Total de Productos</div>
</div>
</div>
</a>


<a class="boxes-content" href="<?php echo site_url('/item_kits');?>">
<div class="col-sm-3 box-wrapper red">
<div class="box-icon">
<i class="fa fa-newspaper-kits"></i>
</div>

<div class="box-details">

<div class="number"><span>	<?php 
		echo (isset($count_item_kits[0]['counts']))?$count_item_kits[0]['counts']:0;
	?></span></div>
<div class="desc">Total de Kits</div>

</div>
</div>
</a>
</div>
</div>



<div class="quick-actions" id="sales_report"></div>
<div id="inventory_report" style="display:none;"></div>
<!-- End -->

<?php /*dosedev 
<h3 class="text-center"><?php echo $this->lang->line('common_welcome_message'); ?></h3>

<div id="home_module_list">
	<?php
	foreach($allowed_modules as $module)
	{
	?>
		<div class="module_item" title="<?php echo $this->lang->line('module_'.$module->module_id.'_desc');?>">
			<a href="<?php echo site_url("$module->module_id");?>"><img src="<?php echo base_url().'images/menubar/'.$module->module_id.'.png';?>" border="0" alt="Menubar Image" /></a>
			<a href="<?php echo site_url("$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a>
		</div>
	<?php
	}
	?>
</div>
*/ ?>
<?php $this->load->view("partial/footer"); ?>
<script type="text/javascript">
/*dosedev*/
	var url="<?php echo site_url('/reports/graphical_summary_sales/');?>";
		url +="<?php echo date('Y-m-01');?>/";
		url +="<?php echo date('Y-m-d');?>/";
		url +="all/all";
		jQuery.ajax({
			url:url,
			success:function(r){
				$("#sales_report").html(r);
			}
		});

	/*var url="<?php echo site_url('/reports/inventory_summary/all/all');?>";
		jQuery.ajax({
			url:url,
			success:function(r){
				$("#inventory_report").html(r);
			}
		});*/

</script>
