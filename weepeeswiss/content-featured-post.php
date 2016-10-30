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
	</div><!-- .entry-header -->
</article><!-- #post-## -->
