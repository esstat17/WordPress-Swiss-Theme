<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
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
<div id="super-wrap" class="wrapper hfeed site">
<div id="primary-navigation" class="site-navigation primary-navigation navbar navbar-custom navbar-transparent header-bg header-txt nav-off" role="navigation">
	<div class="container">
		<div class="row head-section-1">
			<!-- LOGO OR SIMPLE TEXT -->
			<div class="brand-section col-xs-4 col-md-4">
						<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php $wps_logo_uri = apply_filters( 'wps_logo', get_template_directory_uri().'/images/logo@2x.png'); ?>
							<img src="<?php echo esc_url($wps_logo_uri); ?>">
						</a>
						<span class="site-name"><?php bloginfo( 'name' ); ?></span>
						<span class="site-desc"><?php  bloginfo( 'description'); ?></span>					
			</div> <!-- .brand-section end -->
			<div class="nav-menu native-nav col-sm-8 col-md-8">
				<div class="top-menu">
					<div class="topmost-navigation">
						<?php 
							// Better Safe
							// if ( is_active_sidebar( 'top-most-nav' ) ) {
								dynamic_sidebar( 'top-most-nav' );
							// }
							// wp_nav_menu( array( 'theme_location' => 'topmost' ) ); 
							?></div>
				</div>
			</div> <!-- .nav-menu -->
		</div>
		<div class="row head-section-2">
			<div class="col-lg-12">
				<div class="mobil-menu color-1">
					<span class="list-icon-span"><a class="glyphicon glyphicon-list" href="#navi-mobil"></a></span>
				</div>
				<div class="navi-scroll-left navi-hide navi-left-show">
					<a class="mobile-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php $wps_logo_uri = apply_filters( 'wps_logo', get_template_directory_uri().'/images/mlogo@2x.png'); ?>
						<img src="<?php echo esc_url($wps_logo_uri); ?>">
					</a>
				</div>
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<div class="navi-desktop">
					<?php 
						// Left Navigation Appears when Scroll Down
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu sf-menu', 'menu_id' => 'primary-menu' ) );
					?>
					</div>
					<div id="navi-mobil">	
						<?php
							// Mobile Menu
							wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mobile-menu', 'menu_id' => 'mobile-menu' ) );
						?>
					</div>
				<?php endif; ?>	

				<?php 
				// Right Navigation Appears when Scroll Down
				if ( is_active_sidebar( 'nav-scroll-right' ) ):
				?>
					<div class="navi-scroll-right <?php apply_filters('wps_show_nav', 'navi-scroll-show navi-hide'); ?>">
					<?php dynamic_sidebar( 'nav-scroll-right' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<div id="content-body" class="site-main">
	
	<div id="breadcrumb-wraps" class="breadcrumb-wraps">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
				<?php weepeeswiss_breadcrumb_lists(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
		$wps_screen_html = apply_filters( 'wps_screen_html', '');
		$wps_wc_bg_uri = apply_filters( 'wps_welcome_bg', get_template_directory_uri().'/images/bg-parallax.png');
		if (is_front_page() && !empty($wps_screen_html) && isset($wps_screen_html)  ): 
	?>
	<!-- HERO: just add module-full-height class in the section for full height -->
		<section id="hero" class="module-hero module-parallax bg-dark-60" data-background="<?php echo $wps_wc_bg_uri; ?>">

			<!-- HERO TEXT -->
			<div class="hero-caption">
				<div class="hero-text">
				<?php echo $wps_screen_html; ?>
				</div>
			</div>
			<!-- /HERO TEXT -->

		</section>
	<!-- /HERO -->
	<?php endif; ?>