<?php
/*
Template Name: Front Page
*/
get_header(); 

$hero_image = get_option('cts_hero_image');
$hero_heading = get_option('cts_hero_heading');
$cts_front_image = get_option('cts_front_image');
$hero_subheading = get_option('cts_hero_subheading');
$button_url = get_option('cts_button_url');
$checkbox_enabled = get_option('cts_checkbox');
?>
<section data-stellar-background-ratio="0.3" id="home" class="home_bg" style="background-image: url(<?php if ($hero_image) echo esc_url($hero_image); ?>); background-size: cover; background-position: center center;">
			<div class="container">
				<div class="row">
				  <div class="col-lg-7 col-sm-12 col-xs-12">
					<div class="hero-text">
						<h2><?php if ($hero_heading) echo $hero_heading; ?></h2>
						 <p><?php if ($hero_subheading) echo $hero_subheading; ?></p>
						<div class="home_btn">
							<a href="<?php if ($button_url) echo $button_url; ?>" target="<?php if ($checkbox_enabled) echo "_blank"; ?>" class="app-btn">Get Started <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
</svg></a>
						</div>
					</div> 
				  </div>	
				  <div class="col-lg-4 col-sm-12 col-xs-12 text-center">
					<div class="hero-text-img">
						<img src="<?php if ($cts_front_image) echo esc_url($cts_front_image); ?>" alt="">
					</div>
					
				  </div>		  
				</div>
			</div>
		</section>
		

		<!-- START MAIN FEATURES -->
		<section class="why_choose_us sect-2 section-padding" style="padding:4vw 0">
			<div class="container">
				<div class="section-title text-center"  style="margin-bottom:2vw;">
					<h2>Dynamic Section Displaying<br> Fetched API Data</h2>
					<div class="line"></div>
					<p>Display the fetched data dynamically on the landing page in a styled card format.</p>
						
				</div>				
				<div class="row" id="api_container">
					
				<!-- API Data will append here -->									
				</div>		
			</div>		
		</section>
<?php echo do_shortcode('[assessment_product_grid]'); ?>
<?php get_footer(); ?>
