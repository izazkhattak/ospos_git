<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
	dialog_support.init("a.modal-dlg");
</script>

<div id="page_title"><?php echo $title ?></div>

<div id="page_subtitle"><?php echo $subtitle ?></div>

<div id="table_holder">
	<table id="table"></table>
</div>

<div id="report_summary">
	<?php
	$column=($summary_data)?floor(12/count($summary_data)):12;
	foreach($summary_data as $name => $value)
	{ 
		if($name == "total_quantity")
		{
	?>
		<!-- POS -->
	<div class="summary_row col-lg-<?= $column; ?> col-md-6 col-sm-6 col-xs-12">
		<a href="#">
		<div class="dashboard-stats">
			<div class="left">
			<h3><?php echo $value; ?></h3>
			<h4><?php echo $this->lang->line('reports_'.$name); ?></h4>
			</div>
			<div class="right flatBlue">
				<i class="fa fa-usd" aria-hidden="true"></i>
			</div>
		</div>
		</a>
	</div>
		<!-- End POS -->
	<?php
		}
		else
		{
	?>
		<!-- POS -->
	<div class="summary_row col-lg-<?= $column; ?> col-md-6 col-sm-6 col-xs-12">
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
		<!-- End POS -->
	<?php
		}
	}
	?>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

		$('#table').bootstrapTable({
			columns: <?php echo transform_headers($headers, TRUE, FALSE); ?>,
			stickyHeader: true,
			pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
			striped: true,
			sortable: true,
			showExport: true,
			exportDataType: 'all',
			exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
			pagination: true,
			showColumns: true,
			data: <?php echo json_encode($data); ?>,
			iconSize: 'sm',
			paginationVAlign: 'bottom',
			escape: false
		});

	});
</script>

<?php $this->load->view("partial/footer"); ?>
