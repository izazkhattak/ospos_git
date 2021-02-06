<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url();?>" />
	<title><?php echo $this->config->item('company') . ' | ' . $this->lang->line('common_powered_by') . ' NMP ' . $this->config->item('application_version') ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="images/logo.png">
	<link rel="stylesheet" type="text/css" href="<?php echo 'dist/bootswatch/' . (empty($this->config->item('theme')) ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css' ?>"/>

	<?php if ($this->input->cookie('debug') == 'true' || $this->input->get('debug') == 'true') : ?>
		<!-- bower:css -->
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css" />
		<link rel="stylesheet" href="bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" />
		<link rel="stylesheet" href="bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.css" />
		<link rel="stylesheet" href="bower_components/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-select/dist/css/bootstrap-select.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/src/bootstrap-table.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css" />
		<link rel="stylesheet" href="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css" />
		<!-- endbower -->
		<!-- start css template tags -->
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/bootstrap.autocomplete.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/invoice.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/ospos.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/ospos_print.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/popupbox.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/receipt.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/register.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/css/reports.css"/>
		<!-- end css template tags -->
		<!-- bower:js -->
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/jquery-form/src/jquery.form.js"></script>
		<script src="bower_components/jquery-validate/dist/jquery.validate.js"></script>
		<script src="bower_components/jquery-ui/jquery-ui.js"></script>
		<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
		<script src="bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
		<script src="bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
		<script src="bower_components/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<script src="bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
		<script src="bower_components/bootstrap-table/src/bootstrap-table.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/export/bootstrap-table-export.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.js"></script>
		<script src="bower_components/bootstrap-table/dist/extensions/sticky-header/bootstrap-table-sticky-header.js"></script>
		<script src="bower_components/moment/moment.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="bower_components/file-saver.js/FileSaver.js"></script>
		<script src="bower_components/html2canvas/build/html2canvas.js"></script>
		<script src="bower_components/jspdf/dist/jspdf.min.js"></script>
		<script src="bower_components/jspdf-autotable/dist/jspdf.plugin.autotable.js"></script>
		<script src="bower_components/tableExport.jquery.plugin/tableExport.min.js"></script>
		<script src="bower_components/chartist/dist/chartist.min.js"></script>
		<script src="bower_components/chartist-plugin-axistitle/dist/chartist-plugin-axistitle.min.js"></script>
		<script src="bower_components/chartist-plugin-pointlabels/dist/chartist-plugin-pointlabels.min.js"></script>
		<script src="bower_components/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
		<script src="bower_components/chartist-plugin-barlabels/dist/chartist-plugin-barlabels.min.js"></script>
		<script src="bower_components/remarkable-bootstrap-notify/bootstrap-notify.js"></script>
		<script src="bower_components/js-cookie/src/js.cookie.js"></script>
		<script src="bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
		<script src="bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
		<!-- endbower -->
		<!-- start js template tags -->
		<script type="text/javascript" src="dist/adnio/js/imgpreview.full.jquery.js"></script>
		<script type="text/javascript" src="dist/adnio/js/manage_tables.js"></script>
		<script type="text/javascript" src="dist/adnio/js/nominatim.autocomplete.js"></script>
		<!-- end js template tags -->
	<?php else : ?>
		<!--[if lte IE 8]>
		<link rel="stylesheet" media="print" href="dist/print.css" type="text/css" />
		<![endif]-->
		<!-- start mincss template tags -->
		<link rel="stylesheet" type="text/css" href="dist/jquery-ui/jquery-ui.min.css"/>
		<link rel="stylesheet" type="text/css" href="dist/opensourcepos.min.css?rel=397f582d3d"/>
		<!-- end mincss template tags -->
		<!-- start minjs template tags -->
		<script type="text/javascript" src="dist/opensourcepos.min.js?rel=9192985695"></script>
		<!-- end minjs template tags -->
	<?php endif; ?>

		<link rel="stylesheet" type="text/css" href="dist/adnio/dist/styleO.css"/>

	<?php 
	if(current_language() == "arabic" || current_language() =="kurdish"){ ?>
			<link rel="stylesheet" type="text/css" href="dist/adnio/css/rtl.css"/>
	<?php }?>

	<?php if($this->config->item('language')=="arabic"){?>
<!--	<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">	-->
		<link rel="stylesheet" type="text/css" href="dist/adnio/dist/bootstrap-rtl.css"/>
		<link rel="stylesheet" type="text/css" href="dist/adnio/dist/style-ar.css"/>
	<?php } ?>
		
		
<!--<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">		-->
	<link rel="stylesheet" type="text/css" href="dist/fontawesome-free-5.11.2-web/css/all.css">
<!--	
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
-->
	 
	 <script src="dist/adnio/js/custom.js"></script>
	<?php if($this->config->item('theme') && $this->config->item('theme')!="flatly"): ?>
	 <link rel="stylesheet" type="text/css" href="<?php echo 'dist/adnio/dist/bootswatch/' . (empty($this->config->item('theme')) ? 'flatly' : $this->config->item('theme')) . '/bootstrap.min.css' ?>"/>
	<?php endif; ?>


	<?php if(isset($_SESSION['theme']) && $_SESSION['theme'] && $_SESSION['theme']!="flatly"): ?>
	 <link rel="stylesheet" type="text/css" href="<?php echo 'dist/adnio/dist/bootswatch/' . $_SESSION['theme'] . '/bootstrap.min.css' ?>"/>
	<?php endif; ?>


	<?php $this->load->view('partial/header_js'); ?>
	<?php $this->load->view('partial/lang_lines'); ?>

	<!--  Moustafa Samir Font Awesome	& WOW-->
<!-- 	DESACTIVADO POR ANDRIUX1990
	<script src="https://use.fontawesome.com/b42b6bcabf.js"></script>
																			-->		<!--
	<script src="js/wow.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("a.menu_toggle").on('click', function(event) {
				event.preventDefault();
				$(".navbar.navbar-default").addClass('menu_appear');
				$(".overlay.hidden-print").addClass('show');
				
				/* Act on the event */
			});	
			$(".overlay.hidden-print").on('click', function(event) {
				event.preventDefault();
				console.log(123);
				$(this).removeClass('show');
				$(".navbar.navbar-default").removeClass('menu_appear');
				/* Act on the event */
			});
			var collapsed = false;
			$("a.left_toggle").on('click', function(event) {
				event.preventDefault();
				$(this).find('i').toggleClass('fa-bars');
				$(this).find('i').toggleClass('fa-chevron-right');
				$("a.menu-icon .text").toggle();

				    if(!collapsed){
         $(".navbar.navbar-default").animate({width:'7%'}, 500);
         $("div.wrapper > .container.main_content").animate({width:'93%'}, 500);
         $(".topbar > .container").animate({width:'93%'}, 500);
         $("div#footer .jumbotron.push-spaces").animate({width:'93%'}, 500);
         $(".menu-icon").css('text-align', 'center');
         $(".menu-icon i").css('padding-left', '0');
    }else{
         $(".navbar.navbar-default").animate({width:'15%'}, 500);
         $("div.wrapper > .container.main_content").animate({width:'85%'}, 500);
         $(".topbar > .container").animate({width:'85%'}, 500);
         $("div#footer .jumbotron.push-spaces").animate({width:'85%'}, 500);
         $(".menu-icon").css('text-align', 'inherit');
         $(".menu-icon i").css('padding-left', 'inherit');
    };
    collapsed = !collapsed;
			});

			$(".r_mode").on('click', function(event) {
				event.preventDefault();
				var rel=$(this).attr("rel");
				//$("[name='mode'] option").removeAttr("selected");
				$("[name='mode'] option[value='"+rel+"']").attr("selected","selected");
				$("[name='mode']").trigger("change");
			});
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	 End Moustafa Samir Font Awesome	-->
<!--
	<style type="text/css">
		html {
			overflow: auto;
		}
	</style>
	
<?php /*V1.1*/ ?>
	<style type="text/css">

	</style>
	<script type="text/javascript">
	$(document).ajaxStart(function(){
	    $("#loading").show();
	}).ajaxStop(function(){
	    $("#loading").hide();
	});
	</script>
REVISANDO ESTO 		-->
<!--	>>>>>>>>>>>>>>>>>>>>>>>>> API NEO-UX POR ANDRIUX1990 |<<<<<<<<<<<<<<<<<<<<<<<<<	-->
	<link rel="stylesheet" href="dist/nio/miux1.0.css" />
	<link rel="stylesheet" href="dist/nio/parche.css" />
	<link rel="stylesheet" href="dist/nio/display1sales.css" />
	<link rel="stylesheet" href="dist/nio/display2sales.css" />
	<link rel="stylesheet" href="dist/nio/menubar.css" />
	<link rel="stylesheet" href="dist/nio/receivings.css" />
	<link rel="stylesheet" href="dist/nio/invoice.css" />
	<link rel="stylesheet" href="dist/nio/alert-warning.css" />		
	<link rel="stylesheet" type="text/css" href="dist/nio/parche.css">
	<link rel="stylesheet" href="dist/nio/quickpick.css" /> 	
	<link rel="stylesheet" href="dist/nio/css/botonflotante.css" /> 
	<link rel="stylesheet" href="dist/nio/css/bustrapmin.css" />
<!--			>> API JS NIO <<			-->
	<script type="text/javascript" src="dist/nio/js/fullscreen.js"></script>
	<script type="text/javascript" src="dist/nio/js/keyup.js"></script>
	<script type="text/javascript" src="dist/nio/js/calprecio.js"></script>
	<script type="text/javascript" src="dist/nio/js/copyindex.js"></script>
	<script type="text/javascript" src="dist/nio/js/fullscreen.js"></script>
	<script type="text/javascript" src="dist/nio/js/ventana.js"></script>
	<script type="text/javascript" src="dist/nio/js/botonflotante.js"></script>

<!--	|##########|	PHPPOINTOFSALE	|##########|	-->		<!--	ANDRIUX1990
	<link rel="icon" href="https://demo.phppointofsale.com/favicon.ico" type="image/x-icon"/>	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<base href="https://demo.phppointofsale.com/" />
	
		<style>
	@page {
		margin: 0;
		padding: 0;
	}
	</style>		-->
		<link rel="icon" href="<?php echo base_url('uploads/' . $this->Appconfig->get('company_logo')); ?>" type="image/x-icon"/>
	<script type="text/javascript">
		
		var APPLICATION_VERSION= "17.1";
		var SITE_URL= "https://demo.phppointofsale.com/index.php";
		var BASE_URL= "https://demo.phppointofsale.com/";
		var CURRENT_URL = "https://demo.phppointofsale.com/index.php/home";
		var CURRENT_URL_RELATIVE = "home";
		var ENABLE_SOUNDS = false;
		var JS_DATE_FORMAT = "MM\/DD\/YYYY";
		var JS_TIME_FORMAT = "hh:mm a";
		var LOCALE =  "es";
		var MONEY_NUM_DECIMALS = 2;
		var IS_MOBILE = false;
		var ENABLE_QUICK_EDIT = false;
		var PER_PAGE = 20;
		var EMPLOYEE_PERSON_ID = "1";
		var INVOICE_NO =  "083019670821";
		var CONFIRM_CLONE = "\u00bfSeguro que quieres clonar esto?";
		var CONFIRM_IMAGE_DELETE = "\u00bfEst\u00e1s seguro de que quieres borrar esta imagen?";
	</script>

	<link rel="stylesheet" type="text/css" href="dist/nio/css/allup.css?1575956430" />
	<script src="dist/nio/js/all.js?1560195399" type="text/javascript" charset="UTF-8"></script>

	<script type="text/javascript">
		
		 
		var SCREEN_WIDTH = $(window).width();
		var SCREEN_HEIGHT = $(window).height();
		COMMON_SUCCESS = "\u00c9xito";
		COMMON_ERROR = "Error";
		
		bootbox.addLocale('ar', {
		    OK : 'حسنا',
		    CANCEL : 'إلغاء',
		    CONFIRM : 'تأكيد'			
		});
		
		bootbox.addLocale('km', {
		    OK :'យល់ព្រម',
		    CANCEL : 'បោះបង់',
		    CONFIRM : 'បញ្ជាក់ការ'			
		});
		bootbox.setLocale(LOCALE);		
		
		$.ajaxSetup ({
			cache: false,
			headers: { "cache-control": "no-cache" }
		});
		
		$(document).on('show.bs.modal','.bootbox.modal', function (e) 
		{
			var isShown = ($(".bootbox.modal").data('bs.modal') || {}).isShown;
			//If we have a dialog already don't open another one
			if (isShown)
			{
				//Cleanup the dialog(s) that was added to dom
				$('.bootbox.modal:not(:first)').remove();
				
				//Prevent double modal from showing up
				return e.preventDefault();
			}
		});
		
		
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
		
    $.fn.editableform.buttons = 
      '<button tabindex="-1" type="submit" class="btn btn-primary btn-sm editable-submit">'+
        '<i class="icon ti-check"></i>'+
      '</button>'+
      '<button tabindex="-1" type="button" class="btn btn-default btn-sm editable-cancel">'+
        '<i class="icon ti-close"></i>'+
      '</button>';
	  
 	  $.fn.editable.defaults.emptytext = "Vac\u00edo";
		
		$(document).ready(function()
		{
			
				$(".wrapper.mini-bar .left-bar").hover(
				   function() {
				     $(this).parent().removeClass('mini-bar');
				   }, function() {
				     $(this).parent().addClass('mini-bar');
				   }
				 );
			
			

	    $('.menu-bar').click(function(e){                  
	    	e.preventDefault();
	        $(".wrapper").toggleClass('mini-bar');        
	    }); 
    					
			//Ajax submit current location
			$(".set_employee_current_location_id").on('click',function(e)
			{
				e.preventDefault();

				var location_id = $(this).data('location-id');
				$.ajax({
				    type: 'POST',
				    url: 'https://demo.phppointofsale.com/index.php/home/set_employee_current_location_id',
				    data: { 
				        'employee_current_location_id': location_id, 
				    },
				    success: function(){
				    	window.location.reload(true);	
				    }
				});
				
			});
			
			$(".set_employee_language").on('click',function(e)
			{
				e.preventDefault();

				var language_id = $(this).data('language-id');
				$.ajax({
				    type: 'POST',
				    url: 'https://demo.phppointofsale.com/index.php/employees/set_language',
				    data: { 
				        'employee_language_id': language_id, 
				    },
				    success: function(){
				    	window.location.reload(true);	
				    }
				});
				
			});
			
					});
	</script>
	<script src="//phppointofsale.com/js/iframeResizer.contentWindow.min.js"></script>
<!--	|##########|	/PHPPOINTOFSALE	|##########|	-->
</head>
<!-- <audio id="payment" src="dist/nio/audio/1.mp3"></audio> -->
<!-- <audio id="touch" src="dist/nio/audio/2.mp3"></audio> -->
<body>
	<div class="modal fade hidden-print" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"></div>
	<div class="modal fade hidden-print" id="myModalDisableClose" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>
	
	<div class="wrapper mini-bar sales-bar">
		<div class="left-bar hidden-print" >
			<div class="admin-logo" style="">
				<div class="logo-holder pull-left">
					<img src="<?php echo base_url('uploads/' . $this->Appconfig->get('company_logo')); ?>" class="hidden-print logo" id="header-logo" alt="" />
				</div>
				<!-- /LOGO -->
							
			</div>
			<!-- admin-logo -->

			<ul class="list-unstyled menu-parent" id="mainMenu">
				
				<li class="<?php echo "home" == $this->uri->segment(1)? 'active': ''; ?>">
							<a href="<?php echo site_url(); ?>" class="menu-icon">
								<i class="fa dashboard"></i>
							<!--<br />	ANDRIUX1990 DESAB -->
								<span class="text">Panel</span>
							</a>
						</li>

						<?php foreach($allowed_modules as $module): ?>
						<li class="<?php echo $module->module_id == $this->uri->segment(1)? 'active': ''; ?>">
							<a href="<?php echo site_url("$module->module_id");?>" title="<?php echo $this->lang->line("module_".$module->module_id);?>" class="menu-icon">
								<i class="fa <?php echo $module->module_id; ?>"></i>
							<!--<br />	ANDRIUX1990 DESAB -->
								<span class="text"><?php echo $this->lang->line("module_".$module->module_id) ?></span>
							</a>
						</li>
						<?php endforeach; ?>													
                <li>
					<a href="<?php echo site_url("home/logout");?>" tabindex="-1"><i class="fas fa-sign-out-alt"></i><span class="text">Salir</span></a>
                </li>
			</ul>
		</div>
		<!-- left-bar -->

		<div class="content" id="content">
		<div class="overlay hidden-print"></div>			
			<div class="top-bar hidden-print">				
				<nav class="navbar navbar-default top-bar">
					<div class="menu-bar-mobile" id="open-left"><i class="fa fa-bars"></i></div>
					<div class="nav navbar-nav top-elements navbar-breadcrumb hidden-xs">
						 <a  tabindex="-1"  href=""><strong id="compania"><?php echo $this->config->item('company'); ?></strong></a>
					</div>	

					<ul class="nav navbar-nav navbar-right top-elements">		
				<!--MENSAJE A USUARIOS-->
					<li>
					<a href="" class="visible-lg">
						<span class="avatar_info visible-md visible-lg">
							<?php echo $user_info->comments . ($this->input->get("debug") == "true" ? $this->session->userdata('session_sha1') : ''); ?>
						</span>
					</a>
					</li>
				<!--/MENSAJE A USUARIOS-->

				<!--RELOJ-->		
					<li>
					<a href="" class="visible-lg"></a>
					<a href="" class="visible-lg">
						<i class="fa fa-external-time"></i> &nbsp; <strong id="liveclock"><?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat')) ?></strong></a>
					</li>
				<!--/RELOJ-->								
			
				<!--POS-->
				<li class="dropdown">
				<a class="redirect-link" href="<?php echo site_url("sales/pos");?>"><i class="fas fa-cart-arrow-down"></i> &nbsp; <span class="nav-pos-item">Pos</span></a>
				</li>
				<!--/POS-->

				<!-- Calculadora -->

				<!-- /Calculadora -->

				<!-- TEMA -->
				<li class="dropdown">
					<?php 
						$arrayColors=array(
								'flatly:Defecto'=>"#fff",
								"cerulean:Verde"=>"#51A33D",
								
								'cyborg:Amarillo'=>"#FB8C00",
								'darkly:Rojo'=>"#E53935",
								'journal:Turquesa'=>"#00897B",
								//'cosmo:Blue'=>"#3498db",
							);
					?>

					<a tabindex="-1" href="#" class="dropdown-toggle language-dropdown" data-toggle="dropdown" role="button" aria-expanded="false">
					<i class="fas fa-fill-drip"></i>
							<span class="hidden-sm"> 
							 Tema</span>
							<span class="drop-icon">
					<!--	<i class="ion ion-chevron-down"></i>		-->
							</span>
					</a>

					<ul class="dropdown-menu animated fadeInUp wow language-drop neat_drop animated" data-wow-duration="500ms" role="menu" style="visibility: visible; animation-duration: 500ms; animation-name: fadeInUp;">
						<?php foreach ($arrayColors as $keyColor => $value) {
							$exploded=explode(":", $keyColor);
							
							if($this->config->item('theme')==$exploded[0] && !isset($_SESSION['theme']))
								continue;
							?>
								<li>
									<a tabindex="-1" href="<?php echo site_url("home/setTheme?theme=$exploded[0]");?>"  class="set_employee_color">
										<span class="color-theme" style="background-color:<?php echo $value;?>"></span>
										<?php echo ucfirst($exploded[1]); ?>
									</a>
								</li>
							<?php
						}?>						
					</ul>
				</li>
				<!-- /TEMA -->																		
				
				<!-- IDIOMA -->
				
				<!-- /IDIOMA -->	
				
				<!-- USER -->
				<li class="dropdown" >
								<a tabindex="-1" href="#" class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false">
						<!--		<span class="avatar-holder">
									<img src="<?php echo base_url();?>/images/avatar-default.png" alt="">
									</span>		-->
									<i id="avatar" class="fas fa-user-circle"></i>
									<span class="avatar_info visible-md visible-lg">
									<?php echo $user_info->first_name . ' ' . $user_info->last_name . ($this->input->get("debug") == "true" ? $this->session->userdata('session_sha1') : ''); ?>
									</span>
								</a>
					<ul class="dropdown-menu user-dropdown animated fadeInUp wow animated" data-wow-duration="500ms" style="visibility: visible; animation-duration: 500ms; animation-name: fadeInUp;">	
							<li>
								<a href="<?php echo site_url("config");?>" tabindex="-1">
									<i class="fa settings"></i><span class="text"><?php echo $this->lang->line("module_config")?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url("employees");?>" tabindex="-1">
									<i class="fas fa-user-edit"></i></i><span class="text"><?php echo $this->lang->line("trabajador")?></span>
								</a>
							</li>
							<li>
								<a id='calculadora' href="<?php echo site_url("reports/detailed_sales");?>" tabindex="-1">
									<i class="fas fa-download"></i></i><span class="text"><?php echo $this->lang->line("documentation")?></span>
								</a>
							</li>
							<li>
								<a id='calculadora' href="<?php echo site_url("reports/detailed_sales");?>" tabindex="-1">
									<i class="fas fa-download"></i></i><span class="text"><?php echo $this->lang->line("update")?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url("reports/detailed_sales");?>" tabindex="-1">
									<i class="fas fa-list-ol"></i><span class="text"><?php echo $this->lang->line("reports_completed_sales")?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url("home/logout");?>" >
									<i class="fas fa-sign-out-alt"></i>	
									<span class="text"><?php echo $this->lang->line("common_logout")?></span>
								</a>
							</li>
					</ul>
				</li>																						
				<!-- USER -->		


					</ul>
				</nav>
			</div>
			<!-- /top-bar -->

			<!-- CONTENIDDO -->
			<div class="main-content">
				
				<div class="text-center">					
					<div class="row">
						
					</div>
				</div>

			</div>
			<!-- /CONTENIDDO -->
		
			<!---content -->
			</div>
					<div class="container main_content  toggle-sidebar-content <?= @$class_content; ?>">
		<!-- End Moustafa -->
					<div class="row">
