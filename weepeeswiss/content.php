<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
		?>

		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					weepeeswiss_posted_on($post);

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link pull-right"><?php comments_popup_link( __( 'Leave a comment', 'weepeeswiss' ), __( '1 Comment', 'weepeeswiss' ), __( '% Comments', 'weepeeswiss' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'weepeeswiss' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header -->

	<?php weepeeswiss_post_thumbnail(); ?>

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( '<span class="read-more pull-right">' . __('Read more..', 'weepeeswiss') . '</span><span class="meta-nav clearfix"></span>', false);

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'weepeeswiss' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php weepeeswiss_cat_and_tags(); ?>

</article><!-- #post-## -->
