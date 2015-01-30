<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMINCP</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/admincp/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/admincp/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS - Update v1.1 -->
    <link href="<?php echo base_url();?>assets/admincp/css/site.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/admincp/bootflat/css/bootflat.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/admincp/css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admincp/js/plugins/datatables/dataTables.bootstrap.css" type="text/css" />
	
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/admincp/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/js/toastr/toastr.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admincp/css/plugins/bootstrap-tagsinput.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admincp/css/plugins/select/bootstrap-select.min.css" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		var base_url='<?php echo base_url();?>';
		var site_url='<?php echo site_url();?>';
		var security={
			'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>',	
		};
	</script>
	
</head>