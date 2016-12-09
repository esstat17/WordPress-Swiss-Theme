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
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');

	if (isset($get_meta) && !empty($get_meta)):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==1 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):

?>
<div id="weepeeswiss-cont-top" class="weepeeswiss-cont-top weepeeswiss-meta-aside weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i+1; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 weepeeswiss-box-pad"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
	</div></div>
</div>
<?php		
			endif;	
		endfor;
	endif;
}
add_action( 'weepeeswiss_content_top', 'weepeeswiss_content_top_hook');


/**
 * Content Bottom Hook
 * 
 * @return void
 */
function weepeeswiss_content_bottom_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==2 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
?>
<div id="weepeeswiss-cont-bottom" class="weepeeswiss-cont-bottom weepeeswiss-meta-aside weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i+1; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 weepeeswiss-box-pad"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
	</div></div>
</div>
<?php		
			endif;	
		endfor;
	endif;
}
add_action( 'weepeeswiss_content_bottom', 'weepeeswiss_content_bottom_hook');

/**
 * Content Right Hook
 * 
 * @return void
 */
function weepeeswiss_content_right_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	$already_printed = false;
	if (isset($get_meta) && !empty($get_meta) ):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==3 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				if(!$already_printed): 
?>
<div id="weepeeswiss-cont-right" class="weepeeswiss-cont-right pull-right">
<?php 
				endif;
?>
	<div class="weepeeswiss-cont-wrap weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i; ?> well"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php
				if(!$already_printed):
?>
</div> <!-- end of right content -->
<?php
				endif;
				$already_printed = true;
			endif;	
		endfor;
	endif;
}
add_action( 'weepeeswiss_content_right', 'weepeeswiss_content_right_hook');


/**
 * Meta in the Comment Form Above
 * 
 * @return void
 */
function weepeeswiss_content_comment_above_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	$already_printed = false;
	if (isset($get_meta) && !empty($get_meta) ):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==5 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
				if(!$already_printed): 
?>
<div id="weepeeswiss-cont-comment-above" class="weepeeswiss-cont-comment-above">
<?php 
				endif;
?>
	<div class="weepeeswiss-cont-wrap weepeeswiss-box-pad weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i; ?>"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php
				if(!$already_printed):
?>
</div> <!-- end of meta above comment -->
<?php
				endif;
				$already_printed = true;
			endif;	
		endfor;
	endif;
}
add_action( 'weepeeswiss_content_comment_above', 'weepeeswiss_content_comment_above_hook');



/**
 * Meta in the Comment Form Bottom 
 * 
 * @return void
 */
function weepeeswiss_content_comment_bottom_hook($post_id) {
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
?>
<div id="weepeeswiss-cont-comment-bottom" class="weepeeswiss-cont-comment-bottom">
<?php 
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==6 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
?>
<div class="weepeeswiss-cont-wrap weepeeswiss-box-pad weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i; ?>"><?php echo do_shortcode($get_meta[0][$i]); ?></div>
<?php		
			endif;	
		endfor;
?>
</div>
<?php	
	endif;
}
add_action( 'weepeeswiss_content_comment_bottom', 'weepeeswiss_content_comment_bottom_hook');


/**
 * Meta Hook in the Header
 * 
 * @return void
 */
function weepeeswiss_meta_header_hook() {
	if ( !is_singular() ) return;

	global $post;
	$post_id = $post->ID;
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)): 
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==7 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
 				echo do_shortcode($get_meta[0][$i]) . "\n";
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
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)): 
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==8 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):
 				echo do_shortcode($get_meta[0][$i]) . "\n";
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
	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if (isset($get_meta) && !empty($get_meta)):
		for($i=0; $i<count($get_meta[0]); $i++):
			if( $get_meta[1][$i]==4 && !empty($get_meta[0][$i]) && isset($get_meta[0][$i]) ):				
?>
<section id="hero" class="module-hero module-parallax bg-dark-60" data-background="<?php echo !empty( $get_meta[2][0] ) ? $get_meta[2][0]:""; ?>"><div class="hero-caption"><div class="wc-wrap">
<?php echo do_shortcode($get_meta[0][$i]); ?></div></div>
</section><!-- #hero -->
<?php
			endif;	
		endfor;	
	endif;
}
add_action( 'weepeeswiss_welcome_screen', 'weepeeswiss_welcome_screen_hook');


/**
 * Meta Hook for Welcome Screen Background Image 
 * 
 * @return void
 */
function weepeeswiss_welcome_bg_hook($post_id) {
	if ( !is_singular() ) return;

	$get_meta = get_post_meta($post_id, 'weepeeswiss_postmeta_key');
	if ( isset($get_meta) && !empty($get_meta) && !empty($get_meta[2][0]) ): 
 		echo do_shortcode($get_meta[2][0]);	
	endif;
}
add_action( 'weepeeswiss_background_image', 'weepeeswiss_welcome_bg_hook');



