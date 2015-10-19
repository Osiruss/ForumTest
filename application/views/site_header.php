<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6 ielt9"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7 ielt9"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 ielt9"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<html lang="en">
<head>
	<meta name="description" content="A general practice website">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('styles/stylesheets/style.css'); ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
    <script src="<?php echo base_url('scripts/html5shiv.min.js'); ?>"></script>
    <script src="<?php echo base_url('scripts/respond.js'); ?>"></script>
    <![endif]-->	
    <title>Home</title>
</head>
<body style='overflowY:scroll;'>
<header class='site-header'>
	<nav>
		<ul class="nav">
			<li><a href="<?php echo base_url(''); ?>">Home</a></li>
			<li><a href="<?php echo base_url('forum/'); ?>">Forum</a></li>
			<?php if (!$this->session->userdata('loggedin')) {?>
			<li><a href="<?php echo base_url('site/login'); ?>">Login</a></li>
			<li><a href="<?php echo base_url('site/register'); ?>">Register</a></li>
			<?php } else {?>
			<li><a href="<?php echo base_url('site/logout'); ?>">Logout</a></li>
			<li><a href="<?php echo base_url('user').'/'.$this->session->userdata('id'); ?>">Profile</a></li>
			<?php } ?>
			<section>
				Hello <?php echo isset($this->session->userdata()['username']) ? $this->session->userdata('username') : ''; ?>
			</section>
		</ul>
	</nav>

</header>
	<main class='site-main'>