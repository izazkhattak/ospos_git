<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id'=>'employee_form', 'class'=>'form-horizontal')); ?>
	<ul class="nav nav-tabs nav-justified" data-tabs="tabs">
		<li class="active" role="presentation">
			<a data-toggle="tab" href="#employee_basic_info"><?php echo $this->lang->line("employees_basic_information"); ?></a>
		</li>
		<li role="presentation">
			<a data-toggle="tab" href="#employee_login_info"><?php echo $this->lang->line("employees_login_info"); ?></a>
		</li>
		<li role="presentation">
			<a data-toggle="tab" href="#employee_permission_info"><?php echo $this->lang->line("employees_permission_info"); ?></a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="employee_basic_info">
			<fieldset>
				<?php $this->load->view("people/form_basic_info"); ?>
			</fieldset>
		</div>

		<div class="tab-pane" id="employee_login_info">
			<fieldset>
				<div class="form-group form-group-sm">	
					<?php echo form_label($this->lang->line('employees_username'), 'username', array('class'=>'required control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-user"></span></span>
							<?php echo form_input(array(
									'name'=>'username',
									'id'=>'username',
									'class'=>'form-control input-sm',
									'value'=>$person_info->username)
									);?>
						</div>
					</div>
				</div>

				<?php $password_label_attributes = $person_info->person_id == "" ? array('class'=>'required') : array(); ?>

				<div class="form-group form-group-sm">	
					<?php echo form_label($this->lang->line('employees_password'), 'password', array_merge($password_label_attributes, array('class'=>'control-label col-xs-3'))); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-lock"></span></span>
							<?php echo form_password(array(
									'name'=>'password',
									'id'=>'password',
									'class'=>'form-control input-sm')
									);?>
						</div>
					</div>
				</div>

				<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('employees_repeat_password'), 'repeat_password', array_merge($password_label_attributes, array('class'=>'control-label col-xs-3'))); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-lock"></span></span>
							<?php echo form_password(array(
									'name'=>'repeat_password',
									'id'=>'repeat_password',
									'class'=>'form-control input-sm')
									);?>
						</div>
					</div>
				</div>


					
                <div class="form-group form-group-sm">  
                    <?php echo form_label("Shift Start", 'timefrom', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'time_from',
                                    'id'=>'timefrom',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->time_from ?: '10:00')
                                    );?>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm">  
                    <?php echo form_label("Early login Minutes", 'early_access', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'early_access',
                                    'id'=>'early_access',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->early_access ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>
 
                <div class="form-group form-group-sm">  
                    <?php echo form_label("Shift End", 'timeto', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'time_to',
                                    'id'=>'timeto',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->time_to ?: '20:00')
                                    );?>
                        </div>
                    </div>
                </div>

                 <div class="form-group form-group-sm">  
                    <?php echo form_label("Late logout Minutes", 'late_access', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'late_access',
                                    'id'=>'late_access',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->late_access ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>
 
                <div class="form-group form-group-sm">  
                    <?php echo form_label("Confirmation Minutes", 'confirmation_minutes', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'confirmation_minutes',
                                    'id'=>'confirmation_minutes',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->confirmation_minutes ?: '10')
                                    );?>
                        </div>
                    </div>
                </div>
 
                <div class="form-group form-group-sm">  
                    <?php echo form_label("Popup Seconds", 'popup_time', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'popup_time',
                                    'id'=>'popup_time',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->popup_time ?: '10')
                                    );?>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm">  
                    <?php echo form_label("Total Sellary", 'sellary_per_minutes', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'sellary_per_minutes',
                                    'id'=>'sellary_per_minutes',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->sellary_per_minutes ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>

             <div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('employees_emp_sellary'), 'emp_sellary', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'emp_sellary',
							'type'=>'radio',
							'id'=>'emp_sellary',
							'value'=>1,
							'checked'=>$person_info->emp_sellary == 1)
					); ?> <?php echo 'Yes' ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'emp_sellary',
							'type'=>'radio',
							'id'=>'emp_sellary',
							'value'=>0,
							'checked'=>$person_info->emp_sellary == 0)
					); ?> <?php echo 'No' ?>
				</label>
			</div>
		</div>

		 <div class="form-group form-group-sm">  
                    <?php echo form_label("Sellary(day to day)",'day_day'
                    , array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'day_day',
                                    'id'=>'day_day',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->day_day ?: '1/1')
                                    );?>
                        </div>
                    </div>
                </div>
 
               <div class="form-group form-group-sm">  
                    <?php echo form_label("Extra Minutes Sellary", 'sellary_per_extraminutes', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'sellary_per_extraminutes',
                                    'id'=>'sellary_per_extraminutes',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->sellary_per_extraminutes ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>
 
               <div class="form-group form-group-sm">  
                    <?php echo form_label("Missing Minutes Sellary ", 'missing_per_minutes', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'missing_per_minutes',
                                    'id'=>'missing_per_minutes',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->missing_per_minutes ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('employees_use_device'), 'use_device', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
            <div class="col-xs-8">
                <label class="radio-inline">
                    <?php echo form_radio(array(
                            'name'=>'use_device',
                            'type'=>'radio',
                            'id'=>'use_device',
                            'value'=>1,
                            'checked'=>$person_info->use_device == 1)
                    ); ?> <?php echo 'Yes' ?>
                </label>
                <label class="radio-inline">
                    <?php echo form_radio(array(
                            'name'=>'use_device',
                            'type'=>'radio',
                            'id'=>'use_device',
                            'value'=>0,
                            'checked'=>$person_info->use_device == 0)
                    ); ?> <?php echo 'No' ?>
                </label>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <?php echo form_label($this->lang->line('employees_ent_cordinates'), 'use_cordinates', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
            <div class="col-xs-8">
                <label class="radio-inline">
                    <?php echo form_radio(array(
                            'name'=>'use_cordinates',
                            'type'=>'radio',
                            'id'=>'use_cordinates',
                            'value'=>1,
                            'checked'=>$person_info->use_cordinates == 1)
                    ); ?> <?php echo 'Yes' ?>
                </label>
                <label class="radio-inline">
                    <?php echo form_radio(array(
                            'name'=>'use_cordinates',
                            'type'=>'radio',
                            'id'=>'use_cordinates',
                            'value'=>0,
                            'checked'=>$person_info->use_cordinates == 0)
                    ); ?> <?php echo 'No' ?>
                </label>
            </div>
        </div>
		
		<div class="form-group form-group-sm">  
                    <?php echo form_label("Enter Cordinates", 'ent_cordinates', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'ent_cordinates',
                                    'id'=>'ent_cordinates',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->ent_cordinates ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group-sm">  
                    <?php echo form_label("Define Range", 'ent_range', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <div class="input-group">
                            <span class="input-group-addon input-sm"><span class="glyphicon glyphicon-time"></span></span>
                            <?php echo form_input(array(
                                    'name'=>'ent_range',
                                    'id'=>'ent_range',
                                    'class'=>'form-control input-sm',
                                    'value'=>$person_info->ent_range ?: '0')
                                    );?>
                        </div>
                    </div>
                </div>

                 <div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('employees_allow_accesss'), 'cookie_set', !empty($basic_version) ? array('class'=>'required control-label col-xs-3') : array('class'=>'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'cookie_set',
							'type'=>'radio',
							'id'=>'cookie_set',
							'value'=>2,
							'checked'=>$person_info->cookie_set == 2)
					); ?> <?php echo 'Yes' ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'cookie_set',
							'type'=>'radio',
							'id'=>'cookie_set',
							'value'=>1,
							'checked'=>$person_info->cookie_set == 1)
					); ?> <?php echo 'No' ?>
				</label>
			</div>
		</div>
 

                <div class="form-group form-group-sm">
					<?php echo form_label($this->lang->line('employees_language'), 'language', array('class' => 'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							<?php 
								$languages = get_languages();
								$languages[':'] = $this->lang->line('employees_system_language');
								$language_code = current_language_code();
								$language = current_language();
								
								// If No language is set then it will display "System Language"
								if($language_code === current_language_code(TRUE))
								{
									$language_code = '';
									$language = '';
								}
								
								echo form_dropdown(
									'language',
									$languages,
									$language_code . ':' . $language,
									array('class' => 'form-control input-sm')
									);
							?>
						</div>
					</div>
				</div>
			</fieldset>
		</div>

		<div class="tab-pane" id="employee_permission_info">
			<fieldset>
				<p><?php echo $this->lang->line("employees_permission_desc"); ?></p>

				 <div class="form-group form-group-sm">  
                    <?php echo form_label("Item Access", 'popup_time', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <label>
                            <input type="checkbox" value="1" name="item_edit" <?php if($person_info->item_edit): ?> checked <?php endif; ?>>
                             Edit
                        </label>
                        <label sytle="margin-left: 10px">
                            <input type="checkbox" value="1" name="item_delete" <?php if($person_info->item_delete): ?> checked <?php endif; ?>>
                             Delete
                        </label>
                        <label sytle="margin-left: 10px">
                            <input type="checkbox" value="1" name="item_inventory" <?php if($person_info->item_inventory): ?> checked <?php endif; ?>>
                             Update Inventory
                        </label>
                    </div>
                </div>
                <div class="form-group form-group-sm">  
                    <?php echo form_label("ItemKit Access", 'popup_time', array('class'=>'required control-label col-xs-3')); ?>
                    <div class='col-xs-8'>
                        <label sytle="margin-left: 10px">
                            <input type="checkbox" value="1" name="itemkit_edit" <?php if($person_info->itemkit_edit): ?> checked <?php endif; ?>>
                             Edit
                        </label>
                        <label>
                            <input type="checkbox" value="1" name="itemkit_delete" <?php if($person_info->itemkit_delete): ?> checked <?php endif; ?>>
                             Delete
                        </label>
                    </div>
                </div>

				<ul id="permission_list">
					<?php
					foreach($all_modules as $module)
					{
					?>
						<li>	
							<?php echo form_checkbox("grant_".$module->module_id, $module->module_id, $module->grant, "class='module'"); ?>
							<?php echo form_dropdown("menu_group_".$module->module_id, array(
								'home' => $this->lang->line('module_home'),
								'office' => $this->lang->line('module_office'),
								'both' => $this->lang->line('module_both')
							), $module->menu_group, "class='module'"); ?>
							<span class="medium"><?php echo $this->lang->line('module_'.$module->module_id);?>:</span>
							<span class="small"><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></span>
							<?php
								foreach($all_subpermissions as $permission)
								{
									$exploded_permission = explode('_', $permission->permission_id, 2);
									if($permission->module_id == $module->module_id)
									{
										$lang_key = $module->module_id.'_'.$exploded_permission[1];
										$lang_line = $this->lang->line($lang_key);
										$lang_line = ($this->lang->line_tbd($lang_key) == $lang_line) ? ucwords(str_replace("_", " ",$exploded_permission[1])) : $lang_line;
										if(!empty($lang_line))
										{
							?>
											<ul>
												<li>
													<?php echo form_checkbox("grant_".$permission->permission_id, $permission->permission_id, $permission->grant); ?>
													<?php echo form_hidden("menu_group_".$permission->permission_id, "--"); ?>
													<span class="medium"><?php echo $lang_line ?></span>
												</li>
											</ul>
							<?php
										}
									}
								}
							?>
						</li>
					<?php
					}
					?>
				</ul>
			</fieldset>
		</div>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$.validator.setDefaults({ ignore: [] });

	$.validator.addMethod('module', function (value, element) {
		var result = $('#permission_list input').is(':checked');
		$('.module').each(function(index, element)
		{
			var parent = $(element).parent();
			var checked =  $(element).is(':checked');
			if($('ul', parent).length > 0 && result)
			{
				result &= !checked || (checked && $('ul > li > input:checked', parent).length > 0);
			}
		});
		return result;
	}, "<?php echo $this->lang->line('employees_subpermission_required'); ?>");

	$('ul#permission_list > li > input.module').each(function()
	{
		var $this = $(this);
		$('ul > li > input,select', $this.parent()).each(function()
		{
			var $that = $(this);
			var updateInputs = function (checked)
			{
				$that.prop('disabled', !checked);
				!checked && $that.prop('checked', false);
			}
			$this.change(function() {
				updateInputs($this.is(':checked'));
			});
			updateInputs($this.is(':checked'));
		});
	});
	
	$('#employee_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
					dialog_support.hide();
					table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
				},
				dataType: 'json'
			});
		},

		errorLabelContainer: '#error_message_box',

		rules:
		{
			first_name: 'required',
			last_name: 'required',
			username:
			{
				required: true,
				minlength: 5
			},
			password:
			{
				<?php
				if($person_info->person_id == '')
				{
				?>
					required: true,
				<?php
				}
				?>
				minlength: 8
			},	
			repeat_password:
			{
				equalTo: '#password'
			},
			email: 'email'
		},

		messages: 
		{
			first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
			last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
			username:
			{
				required: "<?php echo $this->lang->line('employees_username_required'); ?>",
				minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>"
			},
			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required: "<?php echo $this->lang->line('employees_password_required'); ?>",
				<?php
				}
				?>
				minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
			},
			repeat_password:
			{
				equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
			},
			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
		}
	}, form_support.error));
});
</script>
