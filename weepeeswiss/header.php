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
<?php 
	$wps_wc_bg_uri	 	= apply_filters( 'wps_welcome_bg', get_template_directory_uri().'/images/bg-parallax.png');
	$wps_full_screen 	= apply_filters( 'wps_full_screen', "yes");
	$wps_hide_section 	= apply_filters( 'wps_top_section_hide', "yes");
	$wps_screen_html 	= apply_filters( 'wps_screen_html', '');
?>
<div id="welcome-wrap" class="welcome-wrap <?php echo $wps_full_screen == "yes" && is_front_page() ? "module-hero module-parallax bg-dark-30 full-wide" : "half-wide"; ?>" data-background="<?php echo $wps_full_screen == 'yes' && is_front_page() ? $wps_wc_bg_uri: ''; ?>">
<?php 
	// Right Navigation Appears when Scroll Down
	if ( is_active_sidebar( 'top-toolbar' ) ):
?>
	<div id="top-toolbar" class="top-toolbar top-toolbar-bg top-toolbar-txt">
		<div class="container"><div class="row"><div class="col-lg-12"><?php dynamic_sidebar( 'top-toolbar' ); ?></div></div></div>
	</div><!-- #top-toolbar -->
<?php endif; ?>
<div id="primary-navigation" class="site-navigation primary-navigation navbar navbar-custom navbar-transparent header-bg header-txt nav-on" role="navigation">
	<div class="container">
		<div class="row head-section-1 <?php echo 'yes' == $wps_hide_section ? 'hidden-xs':'' ?>">
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
							// if ( is_active_sidebar( 'top-right-nav' ) ) {
								dynamic_sidebar( 'top-right-nav' );
							// }
							// wp_nav_menu( array( 'theme_location' => 'topmost' ) ); 
							?></div>
				</div>
			</div> <!-- .nav-menu -->
		</div>
		<div class="row head-section-2">
			<div class="col-lg-12">
				<div class="mobil-menu">
					<span class="list-icon-span"><a class="glyphicon glyphicon-list glyph2x" href="#navi-mobil"></a></span>
				</div>
				<div class="navi-mlogo pull-left navi-hide mobile-switch <?php echo 'yes' == $wps_hide_section ? 'show-mobile':'' ?>">
					<a class="mobile-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php $wps_mlogo_uri = apply_filters( 'wps_mlogo', get_template_directory_uri().'/images/mlogo@2x.png'); ?>
						<img src="<?php echo esc_url($wps_mlogo_uri); ?>">
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
					<div class="navi-scroll-right">
					<?php dynamic_sidebar( 'nav-scroll-right' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div><!-- #primary-navigation -->

<?php do_action( 'wps_before_content'); ?>

<?php
 	if (is_front_page() && !empty($wps_screen_html) && isset($wps_screen_html) ): 
?>
	<section id="hero" class="hero <?php echo $wps_full_screen == "no" ? "module-hero module-parallax bg-dark-30 half-wide-yes": "half-wide-no"; ?>" data-background="<?php echo $wps_full_screen == 'no' ? $wps_wc_bg_uri: ''; ?>">
		<div class="hero-caption"><div class="wc-wrap"><?php echo $wps_screen_html; ?></div></div>
	</section><!-- #HERO -->
<?php 
	endif; 
?>
	<?php do_action( 'wps_welcome_screen', get_the_ID()); ?>
</div><!-- #welcome-wrap -->
<div id="content-body" class="site-main">
