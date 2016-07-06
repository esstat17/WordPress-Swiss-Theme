<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="primary-navigation" class="site-navigation primary-navigation navbar navbar-custom navbar-transparent bg-color-3" role="navigation">
	<div class="container">
		<div class="row head-section-1">
			<!-- LOGO OR SIMPLE TEXT -->
			<div class="brand-section col-xs-6 col-md-4">
						<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php $ctp_logo_uri = apply_filters( 'ctp_logo', get_template_directory_uri().'/images/logo@2x.png'); ?>
							<img src="<?php echo esc_url($ctp_logo_uri); ?>" style="max-width: 160px;max-height: 100px;">
						</a>
						<span class="site-name color-5"><?php bloginfo( 'name' ); ?></span>
						<span class="site-desc color-5"><?php  bloginfo( 'description'); ?></span>					
			</div> <!-- .brand-section end -->
			<div class="nav-menu native-nav col-xs-12 col-md-8">
				<?php if ( has_nav_menu( 'topmost' ) ) : ?>
				<div class="row row-top-menu">
		    		<div class="top-menu">
						<div class="topmost-navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'topmost' ) ); ?>
						</div>
					  
					</div>
				</div>
				<?php endif; ?>
			</div> <!-- .nav-menu -->
		</div>
		<div class="row head-section-2 ">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<div class="primary-menu">
					<button class="menu-toggle"><?php _e( 'Primary Menu', 'customplate' ); ?></button>
					<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'customplate' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu sf-menu', 'menu_id' => 'primary-menu' ) ); ?>
				</div>
			<?php endif; ?>
				<div class="search-box hide">
					<?php // get_search_form(); 
					?>
				</div>	
		</div>
	</div>
</div>			
<div id="page" class="wrapper hfeed site">
	<div id="content-body" class="site-main">
	<?php 
		$ctp_screen_html = apply_filters( 'ctp_screen_html', '');
		$ctp_wc_bg_uri = apply_filters( 'ctp_welcome_bg', get_template_directory_uri().'/images/bg-parallax.png');
		if (is_front_page() && !empty($ctp_screen_html) && isset($ctp_screen_html)  ): 
	?>
	<!-- HERO: just add module-full-height class in the section for full height -->
		<section id="hero" class="module-hero module-parallax bg-dark-60" data-background="<?php echo $ctp_wc_bg_uri; ?>">

			<!-- HERO TEXT -->
			<div class="hero-caption">
				<div class="hero-text">
				<?php echo $ctp_screen_html; ?>
				</div>
			</div>
			<!-- /HERO TEXT -->

		</section>
	<!-- /HERO -->
	<?php endif; ?>