<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<title>Gestion de contacts avec Code igniter</title>
	<?php  echo link_tag('assets/css/bootstrap.css'); ?>
<!--link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'-->
<!--link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!--link href='http://fonts.googleapis.com/css?family=Source+Code+Pro' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery-1.11.3.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>/assets/js/bootstrap.js"></script>

</head>
<body>
   <div class="container">
	<?php $this->load->view('templates/bandeau.php');?>
	<?php if (isset($content)) $this->load->view($content); ?>
	<?php $this->load->view('templates/pied.php');?>
</body>
</html>
