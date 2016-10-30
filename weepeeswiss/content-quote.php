<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php weepeeswiss_post_thumbnail(); ?>

	<div class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			endif;
		?>

		<div class="entry-meta">
			<span class="post-format">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a>
			</span>

			<?php weepeeswiss_posted_on(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'weepeeswiss' ), __( '1 Comment', 'weepeeswiss' ), __( '% Comments', 'weepeeswiss' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'weepeeswiss' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'weepeeswiss' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'weepeeswiss' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php 
		if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && weepeeswiss_categorized_blog() ) : 
		$get_cats = get_the_category_list(', ');
		$count_cats = count(explode(",", $get_cats));
		$cat_txt = sprintf( _n( 'Category: %s', 'Categories: %s', $count_cats, 'weepeeswiss' ), $get_cats);
	?>
	<div class="entry-meta">
		<span class="cat-links"><?php echo $cat_txt; ?></span>
	</div>
	<?php endif; ?>
	<?php the_tags( '<div class="entry-meta"><span class="tag-links">'. __( 'Tags: ', 'weepeeswiss' ), ', ', '</span></div>' ); ?>
</article><!-- #post-## -->
