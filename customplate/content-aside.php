<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php customplate_post_thumbnail(); ?>

	<div class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && customplate_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'customplate' ) ); ?></span>
		</div><!-- .entry-meta -->
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title color-2">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title color-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<div class="entry-meta">
			<span class="post-format">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'aside' ) ); ?>"><?php echo get_post_format_string( 'aside' ); ?></a>
			</span>

			<?php customplate_posted_on(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'customplate' ), __( '1 Comment', 'customplate' ), __( '% Comments', 'customplate' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'customplate' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'customplate' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'customplate' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
