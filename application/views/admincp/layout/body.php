<?php echo $header;?>
<body>
<body style="background: url('<?php echo base_url();?>assets/admincp/img/bg.jpg')">
<?php echo $body_data;?>
</body>

   <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>assets/admincp/js/jquery-1.10.1.min.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/admincp/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/admincp/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->

	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/typeahead/bootstrap-tagsinput.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/typeahead/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/Cookie/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/select/bootstrap-select.min.js"></script>
	
	<!--UPDATE V1.1-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/bootflat/js/icheck.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/bootflat/js/jquery.fs.selecter.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/bootflat/js/jquery.fs.stepper.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/application.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/jquery.animatecss.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/apps/global.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/toastr/toastr.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/plugins/notify/notify.min.js"></script>
	<!--END UPDATE V1.1-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox/bootbox.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admincp/js/ajax.js"></script>
	
	
	<?php echo $js_mode;?>
	<input type="hidden" value="<?php echo $this->security->get_csrf_hash();?>" name="<?php echo $this->security->get_csrf_token_name();?>"/>


</html>