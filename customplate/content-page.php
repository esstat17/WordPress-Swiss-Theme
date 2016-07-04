<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Page thumbnail and title.
		customplate_post_thumbnail();
		the_title( '<div class="entry-header"><h1 class="entry-title color-2">', '</h1></div><!-- .entry-header -->' );
	?>

	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'customplate' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'customplate' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
