<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
	<?php the_title( '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h6>' ); ?>
	<?php weepeeswiss_cat_and_tags(); ?>
	</div><!-- .entry-header -->
</article><!-- #post-## -->
