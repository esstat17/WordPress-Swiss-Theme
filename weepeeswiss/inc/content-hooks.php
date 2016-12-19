<?php
/**
 * Content Hooks for Post Meta
 *
 * Metadata and other hooks for the page/post content can be found here.
 *
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

/**
 * Content Top Hook
 * 
 * @return void
 */
function weepeeswiss_content_top_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
		$already_printed = false;
		$counting = 0;
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==1 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				$counting++;
				if(!$already_printed): 
?>
<div id="wps-cont-top" class="wps-cont-top wps-meta-aside">
<?php 
				endif;
?>
<div class="wps-meta-box wps-meta-<?php echo $counting; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 wps-box-pad"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
	</div></div>
</div>
<?php
				$already_printed = true;
			endif;
				if($already_printed && count($get_meta[0]) == $i+1):
?>
</div> <!-- #wps-cont-top -->
<?php
				endif;
		endfor;
	endif;
}
add_action( 'wps_content_top', 'weepeeswiss_content_top_hook');


/**
 * Content Bottom Hook
 * 
 * @return void
 */
function weepeeswiss_content_bottom_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
		$already_printed = false;
		$counting = 0;
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==2 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				$counting++;
				if(!$already_printed): 
?>
<div id="wps-cont-bottom" class="wps-cont-bottom wps-meta-aside">
<?php 
				endif;
?>
<div class="wps-meta-box wps-meta-<?php echo $counting; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 wps-box-pad"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
	</div></div>
</div>
<?php
				$already_printed = true;
			endif;
				if($already_printed && count($get_meta[0]) == $i+1):
?>
</div> <!-- #wps-cont-bottom -->
<?php
				endif;
		endfor;
	endif;
}
add_action( 'wps_content_bottom', 'weepeeswiss_content_bottom_hook');

/**
 * Content Right Hook
 * 
 * @return void
 */
function weepeeswiss_content_right_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta) ):
		$already_printed = false;
		$counting = 0;
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==3 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				$counting++;
				if(!$already_printed): 
?>
<div id="wps-cont-right" class="wps-cont-right pull-right">
<?php 
				endif;
?>
	<div class="wps-cont-wrap wps-meta-box wps-meta-<?php echo $counting; ?> well"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php
				$already_printed = true;
			endif;
				if($already_printed && count($get_meta[0]) == $i+1):
?>
</div> <!-- #wps-cont-right -->
<?php
				endif;
		endfor;
	endif;
}
add_action( 'wps_content_right', 'weepeeswiss_content_right_hook');


/**
 * Meta in the Comment Form Above
 * 
 * @return void
 */
function weepeeswiss_content_comment_above_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta) ):
		$already_printed = false;
		$counting = 0;
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==5 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				$counting++;
				if(!$already_printed): 
?>
<div id="wps-cont-comment-above" class="wps-cont-comment-above">
<?php 
				endif;
?>
	<div class="wps-cont-wrap wps-box-pad wps-meta-box wps-meta-<?php echo $counting; ?>"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php
				$already_printed = true;
			endif;
				if($already_printed && count($get_meta[0]) == $i+1):
?>
</div> <!-- #wps-cont-comment-above -->
<?php
				endif;
		endfor;
	endif;
}
add_action( 'wps_content_comment_above', 'weepeeswiss_content_comment_above_hook');



/**
 * Meta in the Comment Form Bottom 
 * 
 * @return void
 */
function weepeeswiss_content_comment_bottom_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
		$already_printed = false;
		$counting = 0;
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==6 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				$counting++;
				if(!$already_printed):
?>
<div id="wps-cont-comment-bottom" class="wps-cont-comment-bottom">
<?php 
				endif;
?>

<div class="wps-cont-wrap wps-box-pad wps-meta-box wps-meta-<?php echo $counting; ?>"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php
				$already_printed = true;
			endif;
				if($already_printed && count($get_meta[0]) == $i+1):
?>
</div> <!-- #wps-cont-comment-bottom -->
<?php
				endif;
		endfor;
	endif;
}
add_action( 'wps_content_comment_bottom', 'weepeeswiss_content_comment_bottom_hook');


/**
 * Meta Hook in the Header
 * 
 * @return void
 */
function weepeeswiss_meta_header_hook() {
	if ( !is_singular() ) return;

	global $post;
	$post_id = $post->ID;
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)): 
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==7 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
 				echo "\n" . do_shortcode($get_meta[0][$i]) . "\n";
			endif;	
		endfor;		
	endif;
}
add_action( 'wp_head', 'weepeeswiss_meta_header_hook');

/**
 * Meta Hook in the Footer
 * 
 * @return void
 */
function weepeeswiss_meta_footer_hook() {
	if ( !is_singular() ) return;

	global $post;
	$post_id = $post->ID;
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)): 
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==8 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
 				echo "\n" . do_shortcode($get_meta[0][$i]) . "\n";
			endif;	
		endfor;		
	endif;
}
add_action( 'wp_footer', 'weepeeswiss_meta_footer_hook');


/**
 * Meta for Welcome Screen 
 * 
 * @return void
 */
function weepeeswiss_welcome_screen_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	
	// Return if not single
	if (!is_single()) return;

	if (isset($get_meta) && !empty($get_meta)):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==4 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):				
?>
<section id="hero" class="module-hero module-parallax bg-dark-30" data-background="<?php echo !empty( $get_meta[2][1] ) ? $get_meta[2][1]:""; ?>" style="background-color:<?php echo !empty( $get_meta[2][0] ) ? $get_meta[2][0]:""; ?>"><div class="hero-caption"><div class="wc-wrap">
<?php echo do_shortcode($get_meta[0][$i]); ?></div></div>
</section><!-- #hero -->
<?php
			endif;	
		endfor;	
	endif;
}
add_action( 'wps_welcome_screen', 'weepeeswiss_welcome_screen_hook');


/**
 * Meta Hook for Welcome Screen Background Image 
 * 
 * @return void
 */
function weepeeswiss_welcome_bg_hook($post_id) {
	if ( !is_singular() ) return;

	$get_meta = get_post_meta($post_id, 'wps_postmeta_key');
	if ( isset($get_meta) && !empty($get_meta) && !empty($get_meta[2][0]) ): 
 		echo do_shortcode($get_meta[2][0]);	
	endif;
}
add_action( 'wps_background_image', 'weepeeswiss_welcome_bg_hook');



