<?php
/**
 * Content Hooks
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
			if($get_meta[1][$i]==1):
?>
<div id="weepeeswiss-cont-top" class="weepeeswiss-cont-top weepeeswiss-meta-aside weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i+1; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 weepeeswiss-box-pad"><?php echo $get_meta[0][$i]; ?></div>
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
			if($get_meta[1][$i]==2):
?>
<div id="weepeeswiss-cont-bottom" class="weepeeswiss-cont-bottom weepeeswiss-meta-aside weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i+1; ?>">
	<div class="container"><div class="row">
		<div class="col-lg-12 weepeeswiss-box-pad"><?php echo $get_meta[0][$i]; ?></div>
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
	if (isset($get_meta) && !empty($get_meta)):
?>
<div id="weepeeswiss-cont-right" class="weepeeswiss-cont-right pull-right">
<?php 
		for($i=0; $i<count($get_meta[0]); $i++):
			if($get_meta[1][$i]==3):
?>
<div class="weepeeswiss-cont-wrap weepeeswiss-meta-box weepeeswiss-meta-<?php echo $i; ?> well"><?php echo $get_meta[0][$i]; ?></div>
<?php		
			endif;	
		endfor;
?>
</div>
<?php	
	endif;
}
add_action( 'weepeeswiss_content_right', 'weepeeswiss_content_right_hook');
