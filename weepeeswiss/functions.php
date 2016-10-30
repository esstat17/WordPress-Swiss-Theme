<?php
/**
 * Weepee Swiss functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.2
 *
 * @see Interchangeable Text or String
 *	Weepee Swiss - Title in the comment header
 *	Weepee_Swiss - Sub Package comment header
 *	weepeeswiss - Class prefix
 *	wps - initials / prefix
 *	weepeeswiss - domain
 *	Weepee_Swiss - Class
 *
 *
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see weepeeswiss_content_width()
 *
 * @since Weepee Swiss 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Weepee Swiss only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'weepeeswiss_setup' ) ) :
/**
 * Weepee Swiss setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_setup() {

	/*
	 * Make Weepee Swiss available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Weepee Swiss, use a find and
	 * replace to change 'weepeeswiss' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'weepeeswiss', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', weepeeswiss_font_url(), 'fonts/genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'weepeeswiss-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary menu in the header', 'weepeeswiss' ),
		'topmost' => __( 'Topmost header menu e.g. Login|Logout|Cart', 'weepeeswiss' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'weepeeswiss_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'weepeeswiss_get_featured_posts',
		'max_posts' => 6,
	) );

	add_theme_support( 'title-tag' );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // weepeeswiss_setup
add_action( 'after_setup_theme', 'weepeeswiss_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'weepeeswiss_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Weepee Swiss 1.0
 *
 * @return array An array of WP_Post objects.
 */
function weepeeswiss_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Weepee Swiss.
	 *
	 * @since Weepee Swiss 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'weepeeswiss_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Weepee Swiss 1.0
 *
 * @return bool Whether there are featured posts.
 */
function weepeeswiss_has_featured_posts() {
	return ! is_paged() && (bool) weepeeswiss_get_featured_posts();
}

/**
 * Register three Weepee Swiss widget areas.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'weepeeswiss_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'weepeeswiss' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'weepeeswiss' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Top Right Navigation', 'weepeeswiss' ),
		'id'            => 'top-most-nav',
		'description'   => __( 'Appears in the Top Right Nav Section', 'weepeeswiss' ),
		'before_widget' => '<div id="%1$s" class="widget-top %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Bottom Right Navigation', 'weepeeswiss' ),
		'id'            => 'nav-scroll-right',
		'description'   => __( 'Appears in the Bottom Right Nav Section. e.g. Cart Icons, Call to action buttons, etc.', 'weepeeswiss' ),
		'before_widget' => '<div id="%1$s" class="widget-top %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (1)', 'weepeeswiss' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer (1) section of the site.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title footer-txt">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (2)', 'weepeeswiss' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears in the footer (2) section of the site.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title footer-txt">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (3)', 'weepeeswiss' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Appears in the footer (3) section of the site.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title footer-txt">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (4)', 'weepeeswiss' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Appears in the footer (4) section of the site.', 'weepeeswiss' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title footer-txt">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'weepeeswiss_widgets_init' );

/**
 * Register Lato Google font for Weepee Swiss.
 *
 * @since Weepee Swiss 1.0
 *
 * @return string
 */
function weepeeswiss_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'weepeeswiss' ) ) {
		$query_args = array(
			'family' => urlencode( 'Open Sans:300,400,700,900,300italic,400italic,700italic' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}
	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'weepeeswiss-lato', weepeeswiss_font_url(), array(), null );
	
	// Add Bootstrap 3.0 stylesheet.
	wp_enqueue_style( 'wps-bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4' );
	
	// Font Awesome
	// wp_enqueue_style( 'wps-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.3.0' );

	// Load our main stylesheet.
	wp_enqueue_style( 'weepeeswiss-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	// wp_enqueue_style( 'weepeeswiss-ie', get_template_directory_uri() . '/css/ie.css', array( 'weepeeswiss-style' ), '20131205' );
	// wp_style_add_data( 'weepeeswiss-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'weepeeswiss-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402', true );
	}

	wp_enqueue_script( 'wps-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.4', false );
	wp_enqueue_script( 'wps-superfish-script', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '1.7.5', false );
	wp_enqueue_script( 'wps-weepee-scripts', get_template_directory_uri() . '/js/weepee-scripts.min.js', array( 'jquery' ), '1.0.1', false );
	wp_enqueue_script( 'wps-init-script', get_template_directory_uri() . '/js/weepee-init.js', array( 'jquery' ), '1.0.3', true );
}
add_action( 'wp_enqueue_scripts', 'weepeeswiss_scripts' );


function weepeeswiss_admin_scripts($pagenow) {

	if ( 'widgets.php' != $pagenow) {
		return;
	}
	// 	wp_enqueue_script( 'weepeeswiss_customizer_ajax', get_template_directory_uri() . '/js/customizer-ajax.js', array( 'customize-preview' ), '20161008', true );
	// Add Bootstrap 3.0 stylesheet.
	wp_enqueue_script( 'wps-admin-ajax-js', get_template_directory_uri() . '/js/customizer-ajax.js', array('jquery', 'customize-preview'), '1.0.1' );
}
add_action( 'admin_enqueue_scripts', 'weepeeswiss_admin_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_admin_fonts() {
	wp_enqueue_style( 'weepeeswiss-lato', weepeeswiss_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'weepeeswiss_admin_fonts' );

if ( ! function_exists( 'weepeeswiss_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Weepee Swiss attachment size.
	 *
	 * @since Weepee Swiss 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'weepeeswiss_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'weepeeswiss_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Weepee Swiss 1.0
 */
function weepeeswiss_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'weepeeswiss' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Weepee Swiss 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function weepeeswiss_body_class_attr( $classes ) {
	// Just add this as text color
	$classes[] = 'text-color';

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) 
		|| is_active_sidebar( 'sidebar-4' )
		|| is_active_sidebar( 'sidebar-5' )
		|| is_active_sidebar( 'sidebar-6' )
	) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'weepeeswiss_body_class_attr' );

/**
 * Dynamic Class in the Primary Content
 *
 *  @since Weepee Swiss 1.0
 *	@return void
 */
function weepeeswiss_primary_class_attr(){
	$classes = array();
	if (!is_front_page() || 'posts' == get_option( 'show_on_front' )){
		$classes[] = "col-xs-12";
		$classes[] = "col-sm-6";
		$classes[] = "col-md-8";
		$classes[] = "col-md-8";
	} else {
		$classes[] = "col-lg-12 front-page no-right-sidebar";	
	}
	$plain = implode(" ", $classes);
	echo $plain;
}
add_filter( 'primary_class', 'weepeeswiss_primary_class_attr' );

/**
 * Dynamic Class in the Secondary Content
 *
 *  @since Weepee Swiss 1.0
 *	@return void
 */
function weepeeswiss_secondary_class_attr(){
	$classes[] = "col-xs-6";
	$classes[] = "col-md-4";
	$plain = implode(" ", $classes);
	echo $plain;
}
add_filter( 'secondary_class', 'weepeeswiss_secondary_class_attr' );

/**
 * Dynamic Class in the Secondary Content / Sidebar
 *
 */

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Weepee Swiss 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function weepeeswiss_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'weepeeswiss_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Weepee Swiss 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function weepeeswiss_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'weepeeswiss' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'weepeeswiss_wp_title', 10, 2 );

/**
 * Declare WooCommerce support
 *
 * @since Weepee Swiss 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @return void
 */
function weepeeswiss_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'weepeeswiss_woocommerce_support' );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/wp-footer-hooks.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
// if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
// 	require get_template_directory() . '/inc/featured-content.php';
// }


