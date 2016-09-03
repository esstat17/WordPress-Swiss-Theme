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
		
		</div><!-- #main -->

		<div id="footer" class="site-footer footer-bg-rgba footer-txt-rgba" role="contentinfo">
			<div class="container">
				<?php get_sidebar( 'footer' ); ?>	
			</div> <!-- .container-## -->		
		</div><!-- #colophon -->
	</div><!-- #page -->
	<div id="foot-note" class="site-footer footer-bg footer-txt" role="contentinfo">
			<div class="container">
				<div class="copyright-notice row">
					<?php do_action( 'weepeeswiss_foot_html_hook' ); ?>
					<span><?php 
						$wps_copyright = apply_filters( 'wps_copyright', __('Copyright &copy; 2016 - All Right Reserved.', 'weepeeswiss'));
						echo esc_html($wps_copyright);
						?></span>
				</div><!-- .site-info -->
			</div> <!-- .container-## -->		
		</div><!-- #colophon -->
	</div><!-- #page -->
<!-- SCROLLTOP -->
	<div class="scroll-up">
		<a href="#totop"><i class="glyphicon glyphicon-menu-up"></i></a>
	</div>

	<?php wp_footer(); ?>
</body>
</html>