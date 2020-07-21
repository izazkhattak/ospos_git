<?php 
/*dosedev*/
if (!$this->input->is_ajax_request())
$this->load->view("partial/header"); ?>

<div id="chart_report_summary">
	<?php
	foreach($summary_data_1 as $name=>$value)
	{
	?>
		<!-- Moustafa -->
	<div class="summary_row col-lg-2 col-md-6 col-sm-6 col-xs-12">
		<a href="#">
		<div class="dashboard-stats">
			<div class="left">
			<h3><?php echo to_currency($value); ?></h3>
			<h4><?php echo $this->lang->line('reports_'.$name); ?></h4>
			</div>
			<div class="right flatBlue">
				<i class="fa fa-usd" aria-hidden="true"></i>
			</div>
		</div>
		</a>
	</div>
	
		<!-- End Moustafa -->
	<?php
	}
	?>
</div>



<div id="page_title"><?php echo $title ?></div>
<div id="page_subtitle"><?php echo $subtitle ?></div>
<div class="ct-chart ct-golden-section" id="chart1"></div>

<?php $this->load->view($chart_type); ?>

<?php 
/*dosedev*/
if (!$this->input->is_ajax_request())
	$this->load->view("partial/footer"); 
?>
