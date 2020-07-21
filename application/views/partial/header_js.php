<script type="text/javascript">
	// live clock
	var clock_tick = function clock_tick() {
		setInterval('update_clock();', 1000);
	}

	// start the clock immediatly
	clock_tick();

	var update_clock = function update_clock() {
		document.getElementById('liveclock').innerHTML = moment().format("<?php echo dateformat_momentjs($this->config->item('dateformat').' '.$this->config->item('timeformat'))?>");
		  <?php if($this->session->userdata('logout_time')): ?>
        var hours = new Date().getHours();
        var minutes = new Date().getMinutes();
        if((hours + ':' + minutes) == "<?php echo $this->session->userdata('logout_time') ?>")
        window.location.href = "<?php echo base_url('home/logout') ?>";
        <?php endif; ?>
	}

	$.notifyDefaults({ placement: {
		align: "<?php echo $this->config->item('notify_horizontal_position'); ?>",
		from: "<?php echo $this->config->item('notify_vertical_position'); ?>"
	}});

	var cookie_name = "<?php echo $this->config->item('cookie_prefix').$this->config->item('csrf_cookie_name'); ?>";

	var csrf_token = function() {
		return Cookies.get(cookie_name);
	};

	var csrf_form_base = function() {
		return { <?php echo $this->security->get_csrf_token_name(); ?> : function () { return csrf_token();  } };
	};

	var setup_csrf_token = function() {
		$('input[name="<?php echo $this->security->get_csrf_token_name(); ?>"]').val(csrf_token());
	};

	var ajax = $.ajax;

	$.ajax = function() {
		var args = arguments[0];
		if (args['type'] && args['type'].toLowerCase() == 'post' && csrf_token()) {
			if (typeof args['data'] === 'string')
			{
				args['data'] += '&' + $.param(csrf_form_base());
			}
			else
			{
				args['data'] = $.extend(args['data'], csrf_form_base());
			}
		}

		return ajax.apply(this, arguments);
	};

	$(document).ajaxComplete(setup_csrf_token);

	var submit = $.fn.submit;

	$.fn.submit = function() {
		setup_csrf_token();
		submit.apply(this, arguments);
	};

	 <?php if($this->session->userdata('confirmation_minutes')): ?>
        var confirmation_minutes = <?php echo $this->session->userdata('confirmation_minutes'); ?>;
        var popup_time = <?php echo $this->session->userdata('popup_time'); ?>;
        var confirmation_interval;
        function tick_popup_time()
        {
            popup_time--;
            if(popup_time == 0)
                window.location.href = "<?php echo base_url('home/logout') ?>";
        }
        function tick_confirmation_minutes()
        {
            confirmation_minutes--;
            if(confirmation_minutes == 0)
            {
                clearInterval(confirmation_interval);
                $('[data-target="#confirmation-popup"]').click();
                var sound = new Audio('<?php echo base_url('audio/beep.wav'); ?>');
                sound.play();
                setInterval('tick_popup_time();', 1000);
            }
        }
        confirmation_interval = setInterval('tick_confirmation_minutes();', 60000);
    <?php endif; ?>
</script>
