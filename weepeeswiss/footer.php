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
<div id="footer" class="site-footer footer-bg color-5" role="contentinfo">
	<div class="container">
	<?php get_sidebar( 'footer' ); ?>	
	</div>		
</div>
<div id="foot-note" class="site-footer color-5" role="contentinfo">
	<div class="container">
		<div class="copyright-notice row">
		<?php do_action( 'weepeeswiss_foot_html_hook' ); ?>
		<span><?php 
			$ctp_copyright = apply_filters( 'ctp_copyright', __('Copyright &copy; 2016 - All Right Reserved.', 'weepeeswiss'));
			echo esc_html($ctp_copyright); ?></span>
		</div><!-- .site-info -->
	</div> <!-- .container-## -->		
</div>
<!-- SCROLLTOP -->
<div class="scroll-up">
	<a href="#totop"><i class="glyphicon glyphicon-menu-up"></i></a>
</div>

<!-- Modal Search -->
<div class="search-modal modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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