<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */
?>

		
		</div><!-- #main -->

		<div id="footer" class="site-footer footer-bg color-5" role="contentinfo">
			<div class="container">
				<?php get_sidebar( 'footer' ); ?>	
			</div> <!-- .container-## -->		
		</div><!-- #colophon -->
	</div><!-- #page -->
	<div id="foot-note" class="site-footer color-5" role="contentinfo">
			<div class="container">
				<div class="copyright-notice row">
					<?php do_action( 'customplate_foot_html_hook' ); ?>
					<span><?php 
						$ctp_copyright = apply_filters( 'ctp_copyright', __('Copyright &copy; 2016 - All Right Reserved.', 'customplate'));
						echo esc_html($ctp_copyright);
						?></span>
				</div><!-- .site-info -->
			</div> <!-- .container-## -->		
		</div><!-- #colophon -->
	</div><!-- #page -->
<!-- SCROLLTOP -->
	<div class="scroll-up">
		<a href="#totop"><i class="fa fa-angle-double-up"></i></a>
	</div>

	<?php wp_footer(); ?>
</body>
</html>