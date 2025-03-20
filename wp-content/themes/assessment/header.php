<!DOCTYPE html>
<html lang="en">
	<?php wp_head(); 
		$logo = get_option('cts_logo');
	?>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<meta name="description" content="Assessment Landing">
		<meta name="keywords" content="Assessment Landing">	
		<link rel="icon" href="<?php if ($logo) echo esc_url($logo); ?>">
		<title>Assessment Landing</title>			
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css">		
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css">	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php wp_head(); 
	$logo = get_option('cts_logo');
	?>	
	</head>
	
    <body data-spy="scroll" data-offset="80">
		<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-custom navbar-light sticky">
    		<div class="container">
			    <h1 class="text-center w-100"><div class="logo text-center"><a class="navbar-brand d-flex" href="<?php echo home_url(); ?>"><img src="<?php if ($logo) echo esc_url($logo); ?>" alt=""><span><?php echo get_bloginfo('name'); ?></span></a></div></h1>
			</div>
		</nav>