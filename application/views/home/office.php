<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
	dialog_support.init("a.modal-dlg");
</script>

<h3 class="text-center"><?php echo $this->lang->line('common_welcome_message'); ?></h3>

<div class="top-boxes">
<div class="rowN">
<a class="boxes-content" href="<?php echo site_url('/employees');?>">

<div class="col-sm-3 box-wrapper purple">
<div class="box-icon">
<i class="fa fa-newspaper-vendedores"></i>
</div>

<div class="box-details">
<div class="number"><span>
<?php 
		echo (isset($employees[0]['counts']))?$employees[0]['counts']:0;
	?>
	
</span></div>
<div class="desc">Vendedores</div>

</div>


</div>
</a>

<a class="boxes-content" href="<?php echo site_url('/taxes');?>">

<div class="col-sm-3 box-wrapper teal">
<div class="box-icon">
<i class="fa fa-newspaper-impuestos"></i>
</div>
<div class="box-details">
<div class="number"><span>	<?php 
		echo (isset($taxes[0]['counts']))?$taxes[0]['counts']:0;
	?></span></div>
<div class="desc">

Impuestos</div>

</div>
</div>
</a>

<a class="boxes-content" href="<?php echo site_url('/attributes');?>">

<div class="col-sm-3 box-wrapper green">
<div class="box-icon">
<i class="fa fa-newspaper-atributos"></i>
</div>

<div class="box-details">
<div class="number"><span>	<?php 
		echo (isset($attributes[0]['counts']))?$attributes[0]['counts']:0;
	?></span></div>
<div class="desc">Atributos</div>
</div>
</div>
</a>


<a class="boxes-content" href="<?php echo site_url('/config');?>">
<div class="col-sm-3 box-wrapper red">
<div class="box-icon">
<i class="fa fa-newspaper-tienda"></i>
</div>

<div class="box-details">

<div class="number"><span>	<?php 
		echo (isset($config[0]['counts']))?$config[0]['counts']:0;
	?></span></div>
<div class="desc">Configuracion de la tienda</div>

</div>
</div>
</a>
</div>
</div>

<?php $this->load->view("partial/footer"); ?>
