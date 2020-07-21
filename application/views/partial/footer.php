		</div>
	</div>
<!--
	<div id="footer">
		<div class="jumbotron push-spaces">
			<strong><?php echo $this->lang->line('common_you_are_using_ospos'); ?>
  			<?php echo $this->config->item('application_version'); ?> - <?php echo substr($this->config->item('commit_sha1'), 0, 6); ?></strong>.
			<?php echo $this->lang->line('common_please_visit_my'); ?>
			<a href="https://github.com/jekkos/opensourcepos" target="_blank"><?php echo $this->lang->line('common_website'); ?></a>
			<?php echo $this->lang->line('common_learn_about_project'); ?>
		</div>
	</div>		-->
	<?php if($this->session->userdata('confirmation_minutes')): ?>
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#confirmation-popup" style="display: none !important"></button>
		<div id="confirmation-popup" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
		      <div class="modal-header bg-danger">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title" style="color: #fff">Are You Here ?</h4>
		      </div>
		      <div class="modal-body">
		        <p>You are about to logout, please click the below button if you are here.</p>
		      </div>
		      <div class="modal-footer">
		        <a href="" class="btn btn-danger btn-block">I AM HERE</a>
		      </div>
		    </div>
		  </div>
		</div>
	<?php endif; ?>
</body>
</html>
