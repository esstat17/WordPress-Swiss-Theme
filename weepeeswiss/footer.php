<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */
?>
</div><!-- #content-body -->
<?php do_action( 'wps_after_content' ); ?>	
<div id="footer" class="site-footer footer-bg-rgba footer-txt-rgba" role="contentinfo">
	<div class="container">
	<?php get_sidebar( 'footer' ); ?>	
	</div>		
</div>
<div id="foot-note" class="site-footer footer-bg footer-txt" role="contentinfo">
	<div class="container">
		<div class="copyright-notice row">
		<span class="copyright-txt"><?php 
			$wps_copyright = apply_filters( 'wps_copyright', __('Copyright &copy; 2016 - All Right Reserved.', 'weepeeswiss'));
			echo esc_html($wps_copyright); ?></span>
		</div><!-- .site-info -->
	</div> <!-- .container-## -->		
</div>
<div class="scroll-up">
	<a href="#totop"><i class="fa fa-angle-double-up"></i></a>
</div>
<!-- SCROLLTOP -->
<div class="search-modal modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="fa fa-times" aria-hidden="true"></span>
				</button>
			</div>
	        <div id="modal-body" class="modal-body"></div>
	        <div class="modal-footer"></div>
		</div>
	</div>
</div>
<!-- END # Modal Search -->	
<?php wp_footer(); ?>
</div><!-- #super-wrap -->
</body>
</html>