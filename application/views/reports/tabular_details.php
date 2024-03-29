<?php $this->load->view("partial/header"); ?>

<div id="page_title"><?php echo $title ?></div>

<div id="page_subtitle"><?php echo $subtitle ?></div>

<div id="table_holder">
	<table id="table"></table>
</div>

<div id="report_summary">
	<?php
	$column=($overall_summary_data)?floor(12/count($overall_summary_data)):12;
	foreach($overall_summary_data as $name=>$value)
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
	?>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
	 	<?php $this->load->view('partial/bootstrap_tables_locale'); ?>

		var details_data = <?php echo json_encode($details_data); ?>;
		<?php
		if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
		{
		?>
			var details_data_rewards = <?php echo json_encode($details_data_rewards); ?>;
		<?php
		}
		?>
		var init_dialog = function() {
			<?php
			if(isset($editable))
			{
			?>
				table_support.submit_handler('<?php echo site_url("reports/get_detailed_" . $editable . "_row")?>');
				dialog_support.init("a.modal-dlg");
			<?php
			}
			?>
		};

		$('#table').bootstrapTable({
			columns: <?php echo transform_headers($headers['summary'], TRUE); ?>,
			stickyHeader: true,
			pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
			striped: true,
			pagination: true,
			sortable: true,
			showColumns: true,
			uniqueId: 'id',
			showExport: true,
			exportDataType: 'all',
			exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
			data: <?php echo json_encode($summary_data); ?>,
			iconSize: 'sm',
			paginationVAlign: 'bottom',
			detailView: true,
			escape: false,
			onPageChange: init_dialog,
			onPostBody: function() {
				dialog_support.init("a.modal-dlg");
			},
			onExpandRow: function (index, row, $detail) {
				$detail.html('<table></table>').find("table").bootstrapTable({
					columns: <?php echo transform_headers_readonly($headers['details']); ?>,
					data: details_data[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
				});

				<?php
				if($this->config->item('customer_reward_enable') == TRUE && !empty($details_data_rewards))
				{
				?>
					$detail.append('<table></table>').find("table").bootstrapTable({
						columns: <?php echo transform_headers_readonly($headers['details_rewards']); ?>,
						data: details_data_rewards[(!isNaN(row.id) && row.id) || $(row[0] || row.id).text().replace(/(POS|RECV)\s*/g, '')]
					});
				<?php
				}
				?>
			}
		});

		init_dialog();
	});
</script>

<?php $this->load->view("partial/footer"); ?>
