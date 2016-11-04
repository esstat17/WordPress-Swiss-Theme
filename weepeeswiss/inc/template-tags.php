<?php
/**
 * Custom template tags for Weepee Swiss
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

if ( ! function_exists( 'weepeeswiss_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Custom Plate 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function weepeeswiss_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'weepeeswiss' ),
		'next_text' => __( 'Next &rarr;', 'weepeeswiss' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<span class="screen-reader-text"><?php _e( 'Posts navigation', 'weepeeswiss' ); ?></span>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'weepeeswiss_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Custom Plate 1.0
 */
function weepeeswiss_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'weepeeswiss' ) );
			else :
				previous_post_link( '%link', __( '<span class="meta-nav btn btn-default" data-prev-post="%title"><i class="glyphicon glyphicon-menu-left"></i>%title</span>', 'weepeeswiss' ) );
				next_post_link( '%link', __( '<span class="meta-nav btn btn btn-default pull-right" data-next-post="%title">%title<i class="glyphicon glyphicon-menu-right"></i></span>', 'weepeeswiss' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'weepeeswiss_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Custom Plate 1.0
 */
function weepeeswiss_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . __( 'Sticky', 'weepeeswiss' ) . '</span>';
	}

	// Default: Set up and print post meta information.
	/*
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
	*/
	printf( '<span class="entry-date"><i class="glyphicon glyphicon-time"></i> <span rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s <span class="time-passed-label">%4$s</span></time></span> <span class="ndash">&mdash;</span> <span class="author vcard"><a class="url author-url" href="%5$s" rel="author">%6$s</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( weepeeswiss_convert_date(current_time('timestamp')) ),
		__('ago', 'weepeeswiss'),
		esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'weepeeswiss_convert_date' ) ) :
	/**
 * Convert Current Time to Time Ago
 *
 * @link Human Time Diff https://codex.wordpress.org/Function_Reference/human_time_diff
 * @since Custom Plate 1.1
 */
function weepeeswiss_convert_date( $current_time ) {
	return human_time_diff( get_the_time('U'), $current_time );
}
endif;

/**
 * Find out if blog has more than one category.
 *
 * @since Custom Plate 1.0
 *
 * @return boolean true if blog has more than 1 category
 */
function weepeeswiss_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'weepeeswiss_category_count' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'weepeeswiss_category_count', $all_the_cool_cats );
	}

	if ( 1 !== (int) $all_the_cool_cats ) {
		// This blog has more than 1 category so weepeeswiss_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so weepeeswiss_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in weepeeswiss_categorized_blog.
 *
 * @since Custom Plate 1.0
 */
function weepeeswiss_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'weepeeswiss_category_count' );
}
add_action( 'edit_category', 'weepeeswiss_category_transient_flusher' );
add_action( 'save_post',     'weepeeswiss_category_transient_flusher' );

if ( ! function_exists( 'weepeeswiss_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Custom Plate 1.0
 * @since Custom Plate 1.4 Was made 'pluggable', or overridable.
 */
function weepeeswiss_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'weepeeswiss-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'weepeeswiss-full-width' );
		} else {
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		}
	?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'weepeeswiss_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Custom Plate 1.3
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function weepeeswiss_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'weepeeswiss' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'weepeeswiss_excerpt_more' );
endif;


/**
 * Breadcrumb Lists
 * Adopted from Dimox
 *
 */
if (!function_exists('weepeeswiss_breadcrumb_lists')) :

function weepeeswiss_breadcrumb_lists() {

	/* === OPTIONS === */
	$text['home']     = '<i class="glyphicon glyphicon-home"></i>'; // string for the 'Home' link
	$text['category'] = __( 'Published in ', 'weepeeswiss' ) . '&#39;%s&#39;'; // string for a category page
	$text['search']   = __( 'Query results ', 'weepeeswiss' ) . '"%s"'; // string for a search results page
	$text['tag']      = __( 'Tagged in ', 'weepeeswiss' ) . ' "%s"'; // string for a tag page
	$text['author']   = __( 'Published by ', 'weepeeswiss' ) . ' %s'; // string for an author page
	$text['404']      = __( 'Page Not Found', 'weepeeswiss' ); // string for the 404 page

	$show_current   = 0; // 1 - show current post, page, or category title in breadcrumbs, 0 - if you don't want to show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - if you don't want to show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - if you don't want to show
	$show_title     = 1; // 1 - show the title for the links, 0 - if you don't want to show
	$delimiter      = ''; // delimiter between crumbs
	$before         = '<div class="btn btn-default current"><span>'; // html element before current link
	$after          = '</div></li>'; // closing span element
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<div class="btn btn-default" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope>';
	$link_after   = '</div>';
	$link_attr    = ' itemprop="url"';
	$itemproptitle_before = '<span itemprop="title">';
	$itemproptitle_after = '</span>';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">' . $itemproptitle_before . '%2$s' . $itemproptitle_after . '</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs btn-group btn-breadcrumb">' .$link_before. '<a href="' . $home_link . '">' . $itemproptitle_before . $text['home'] . $itemproptitle_after . '</a>' .$link_after. '</div>';

	} else {

		echo '<div class="breadcrumbs btn-group btn-breadcrumb">';
		if ($show_home_link == 1) {
			echo '' . $link_before . '<a href="' . $home_link . '" ' . $link_attr . '>' . $itemproptitle_before . $text['home'] . $itemproptitle_after . '</a>' . $link_after;
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('">', '"> ' . $itemproptitle_before, $cats);
				$cats = str_replace('</a>', $itemproptitle_after . '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); 
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) 
				$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('">', '"> ' . $itemproptitle_before, $cats);
				$cats = str_replace('</a>', $itemproptitle_after . '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); 
			$cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('">', '"> ' . $itemproptitle_before, $cats);
			$cats = str_replace('</a>', $itemproptitle_after . '</a>' . $link_after, $cats);
			if ($show_title == 0) 
			$cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				printf( __('Page %s', 'weepeeswiss' ) . ' ' . get_query_var('paged') );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} 
endif;
// end weepeeswiss_breadcrumb_lists
