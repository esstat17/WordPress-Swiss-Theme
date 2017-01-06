<?php
/**
 * Weepee Swiss Starter Content
 *
 * This only works for WP Version 4.7 and above
 *
 * @package WordPress
 * @subpackage Weepee_Swiss
 * @since Weepee Swiss 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function weepeeswiss_470_setup() {
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	// add_editor_style( array( 'assets/css/editor-style.css', weepeeswiss_fonts_url() ) );

	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_about'
			),
			'sidebar-2' => array(
				'search',
				'recent-posts'
			),
			'sidebar-3' => array(
				'text_about' => array(
					'title' => '',
					'text' => join( '', array(
								'<div class="site-foot-name"><strong>',
								get_bloginfo( 'name' ),
								'</strong></div>',
								'<div class="site-foot-desc"><strong>',
								get_bloginfo( 'description'),
								'</strong></div>',
					)),
				)
			),
			
			'sidebar-4' => array(
				// 'text_business_info',
				'text_business_info' => array(
					'title' => _x( 'Info', 'Wordpress 4.7 and Up', 'weepeeswiss'),
					'text' => join( '', array(
						'<p><strong>' . _x( '<i class="glyphicon glyphicon-map-marker"></i>&nbsp; Address', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</strong><br />',
						_x( '123 Main Street', 'Wordpress 4.7 and Up', 'weepeeswiss') . '<br />' . _x( 'New York, NY 10001', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</p>',
						'<p><strong>' . _x( '<i class="glyphicon glyphicon-time"></i>&nbsp; Hours', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</strong><br />',
						_x( 'Monday&mdash;Friday: 9:00AM&ndash;5:00PM', 'Wordpress 4.7 and Up', 'weepeeswiss') . '<br /></p>',
						'<p><strong>' . _x( '<i class="glyphicon glyphicon-envelope"></i>&nbsp; Email me', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</strong><br />',
						_x( '<a href="mailto:hello@wordpress.com">hello@wordpress.com</a>', 'Wordpress 4.7 and Up', 'weepeeswiss') . '<br /></p>') 
					),
				)
			),
			'sidebar-5' => array(
				'recent-posts',
			),
			'sidebar-6' => array(
				'search' => array(
					'title' => _x( 'Search', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
				),
			),
			'top-right-nav' => array(
				'text_about' => array(
					'title' => '',
					'text' => join( '', array(
						'<div class="nav-list-starter"><ul>',
						'<li>' . _x( '<a href="#">Login</a>', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</li>',
						'<li>' . _x( '<a href="#">Pricing</a>', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</li>',
						'<li>' . _x( '<a href="#">Shop</a>', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</li>',
						'<li>' . _x( '<a href="#">Cart</a>', 'Wordpress 4.7 and Up', 'weepeeswiss') . '</li>',
						'</ul></div>'
					)),
				),
			),
			'nav-scroll-right' => array(
				'text_about' => array(
					'title' => '',
					'text' => '<a href="#" class="btn btn-primary bg-color-1 color-2 btn-oval page-scroll">' . _x( 'Explore', 'Wordpress 4.7 and Up', 'weepeeswiss' ) . '</a>',
				),
			),
			'top-toolbar' => array(
				'text_about' => array(
					'title' => '',
					'text' => _x( 'Got a nice day lately?!', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
				),
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				// 'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				// 'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				// 'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'post_title' => _x( 'Homepage Section', 'Wordpress 4.7 and Up' ),
				// 'thumbnail' => '{{image-espresso}}',
			),	
		),
//
//		'attachments' => array(
//			'image-espresso' => array(
//				'post_title' => _x( 'Espresso', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
//				'file' => 'assets/images/espresso.jpg',
//			),
//			'image-sandwich' => array(
//				'post_title' => _x( 'Sandwich', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
//				'file' => 'assets/images/sandwich.jpg',
//			),
//			'image-coffee' => array(
//				'post_title' => _x( 'Coffee', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
//				'file' => 'assets/images/coffee.jpg',
//			),
//			'image-front-parallax' => array(
//				'post_title' => _x( 'Parallax', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
//				'file' => 'images/bg-parallax.png',
//			),
//		),

		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// 'theme_mods' => array(
// 			'panel_1' => '{{homepage-section}}',
// 			'panel_2' => '{{about}}',
// 			'panel_3' => '{{blog}}',
// 			'panel_4' => '{{contact}}',
// 		),

		'theme_mods' => array(
 			'parallax_screen' => join( '', array(
 									'<h5 class="wc-text text-uppercase color-2">',
	 								 _x( 'Hello! Welcome Guest', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
	 								 '</h5><hr class="shorty-hr border-color-1"><p class="lead color-2">',
	 								 _x( 'I will tell you a story as you continue reading', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
	 								 '</p><a href="#more" class="btn btn-primary bg-color-1 color-2 wc-btn">',
	 								 _x( 'READ MORE', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
	 								 '</a>'
 								 )),
 			'front_box' => join( '', array(
 								'<div class="section-front front-box-1"><div class="container"><div class="row">',
 								'<h2 class="section-heading text-center">',
 								_x( '4 Cool Boxes', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</h2>',
 								'<hr class="shorty-hr border-color-1">',
 								'<div class="col-xs-6 col-sm-3 text-center">',
 								'<div class="service-box"><i class="glyphicon glyphicon-apple glyph5x color-1"></i>',
 								'<h3>',
 								_x( 'Box One', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</h3>',
 								'<p class="box-txt">',
 								_x( 'Let me tell you the story for box one.', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</p>',
 								'</div></div>',
 								'<div class="col-xs-6 col-sm-3 text-center">',
 								'<div class="service-box"><i class="glyphicon glyphicon-cloud glyph5x color-1"></i>',
 								'<h3>',
 								_x( 'Box Two', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</h3>',
 								'<p class="box-txt">',
 								_x( 'Let me tell you the story for box two.', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</p>',
 								'</div></div>',
 								'<div class="col-xs-6 col-sm-3 text-center">',
 								'<div class="service-box"><i class="glyphicon glyphicon-grain glyph5x color-1"></i>',
 								'<h3>',
 								_x( 'Box Three', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</h3>',
 								'<p class="box-txt">',
 								_x( 'Let me tell you the story for box three.', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</p>',
 								'</div></div>',
 								'<div class="col-xs-6 col-sm-3 text-center">',
 								'<div class="service-box"><i class="glyphicon glyphicon-cog glyph5x color-1"></i>',
 								'<h3>',
 								_x( 'Box Four', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</h3>',
 								'<p class="box-txt">',
 								_x( 'Let me tell you the story for box four.', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
 								'</p>',
 								'</div></div>',
 								'</div></div></div>',
 								"\n",
 								'<div class="section-front front-box-2 bg-color-1">',
								'<div class="container"><div class="row">',
								'<div class="col-lg-8 col-lg-offset-2 text-center">',
								'<h2 class="section-heading color-4">',
								_x( 'Just Another Section', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
								'</h2>',
								'<hr class="shorty-hr border-color-2">',
								'<p class="lead color-2">',
								_x( 'Why not to start another section of your story here? Happy to hear your thoughts!', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
								'</p><p>',
								'<a class="page-scroll btn btn-default btn-oval">',
								_x( 'Get Started', 'Wordpress 4.7 and Up', 'weepeeswiss' ),
								'</a></p></div></div></div></div>'
 							)),
 		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'weepeeswiss' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'topmost' => array(
				'name' => __( 'Top Menu', 'weepeeswiss' ),
				'items' => array(
					'page_about',
					'page_contact',
				),
			),
//			
//			'social' => array(
//				'name' => __( 'Social Links Menu', 'weepeeswiss' ),
//				'items' => array(
//					'link_yelp',
//					'link_facebook',
//					'link_twitter',
//					'link_instagram',
//					'link_email',
//				),
//			),

		),
	) );
}
add_action( 'after_setup_theme', 'weepeeswiss_470_setup' );


/**
 * Expand a theme's starter content configuration using core-provided data.
 *
 * @since 4.7.0
 *
 * @return array Array of starter content.
 */
function weepeeswiss_get_starter_content() {
	$theme_support = get_theme_support( 'starter-content' );
	if ( is_array( $theme_support ) && ! empty( $theme_support[0] ) && is_array( $theme_support[0] ) ) {
		$config = $theme_support[0];
	} else {
		$config = array();
	}

	$core_content = array(
		'widgets' => array(
			'text_business_info' => array( 'text', array(
				'title' => _x( 'Find Us', 'Wordpress 4.7 and Up' ),
				'text' => join( '', array(
					'<p><strong>' . _x( 'Address', 'Wordpress 4.7 and Up' ) . '</strong><br />',
					_x( '123 Main Street', 'Wordpress 4.7 and Up' ) . '<br />' . _x( 'New York, NY 10001', 'Wordpress 4.7 and Up' ) . '</p>',
					'<p><strong>' . _x( 'Hours', 'Wordpress 4.7 and Up' ) . '</strong><br />',
					_x( 'Monday&mdash;Friday: 9:00AM&ndash;5:00PM', 'Wordpress 4.7 and Up' ) . '<br />' . _x( 'Saturday &amp; Sunday: 11:00AM&ndash;3:00PM', 'Wordpress 4.7 and Up' ) . '</p>'
				) ),
			) ),
			'text_about' => array( 'text', array(
				'title' => _x( 'Amout is ayte!', 'Wordpress 4.7 and Up' ),
				'text' => _x( 'This is not real!.', 'Wordpress 4.7 and Up' ),
			) ),
			'archives' => array( 'archives', array(
				'title' => _x( 'Archives', 'Wordpress 4.7 and Up' ),
			) ),
			'calendar' => array( 'calendar', array(
				'title' => _x( 'Calendar', 'Wordpress 4.7 and Up' ),
			) ),
			'categories' => array( 'categories', array(
				'title' => _x( 'Categories', 'Wordpress 4.7 and Up' ),
			) ),
			'meta' => array( 'meta', array(
				'title' => _x( 'Meta', 'Wordpress 4.7 and Up' ),
			) ),
			'recent-comments' => array( 'recent-comments', array(
				'title' => _x( 'Recent Comments', 'Wordpress 4.7 and Up' ),
			) ),
			'recent-posts' => array( 'recent-posts', array(
				'title' => _x( 'Recent Posts', 'Wordpress 4.7 and Up' ),
			) ),
			'search' => array( 'search', array(
				'title' => _x( 'Search', 'Wordpress 4.7 and Up' ),
			) ),
		),
		'nav_menus' => array(
			'page_home' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{home}}',
			),
			'page_about' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{about}}',
			),
			'page_blog' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{blog}}',
			),
			'page_news' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{news}}',
			),
			'page_contact' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{contact}}',
			),

			'link_email' => array(
				'title' => _x( 'Email', 'Wordpress 4.7 and Up' ),
				'url' => 'mailto:wordpress@example.com',
			),
			'link_facebook' => array(
				'title' => _x( 'Facebook', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.facebook.com/wordpress',
			),
			'link_foursquare' => array(
				'title' => _x( 'Foursquare', 'Wordpress 4.7 and Up' ),
				'url' => 'https://foursquare.com/',
			),
			'link_github' => array(
				'title' => _x( 'GitHub', 'Wordpress 4.7 and Up' ),
				'url' => 'https://github.com/wordpress/',
			),
			'link_instagram' => array(
				'title' => _x( 'Instagram', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.instagram.com/explore/tags/wordcamp/',
			),
			'link_linkedin' => array(
				'title' => _x( 'LinkedIn', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.linkedin.com/company/1089783',
			),
			'link_pinterest' => array(
				'title' => _x( 'Pinterest', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.pinterest.com/',
			),
			'link_twitter' => array(
				'title' => _x( 'Twitter', 'Wordpress 4.7 and Up' ),
				'url' => 'https://twitter.com/wordpress',
			),
			'link_yelp' => array(
				'title' => _x( 'Yelp', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.yelp.com',
			),
			'link_youtube' => array(
				'title' => _x( 'YouTube', 'Wordpress 4.7 and Up' ),
				'url' => 'https://www.youtube.com/channel/UCdof4Ju7amm1chz1gi1T2ZA',
			),
		),
		'posts' => array(
			'home' => array(
				'post_type' => 'page',
				'post_title' => _x( 'Home', 'Wordpress 4.7 and Up' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Wordpress 4.7 and Up' ),
			),
			'about' => array(
				'post_type' => 'page',
				'post_title' => _x( 'About', 'Wordpress 4.7 and Up' ),
				'post_content' => _x( 'You might be an artist who would like to introduce yourself and your work here or maybe you&rsquo;re a business with a mission to describe.', 'Wordpress 4.7 and Up' ),
			),
			'contact' => array(
				'post_type' => 'page',
				'post_title' => _x( 'Contact', 'Wordpress 4.7 and Up' ),
				'post_content' => _x( 'This is a page with some basic contact information, such as an address and phone number. You might also try a plugin to add a contact form.', 'Wordpress 4.7 and Up' ),
			),
			'blog' => array(
				'post_type' => 'page',
				'post_title' => _x( 'Blog', 'Wordpress 4.7 and Up' ),
			),
			'news' => array(
				'post_type' => 'page',
				'post_title' => _x( 'News', 'Wordpress 4.7 and Up' ),
			),

			'homepage-section' => array(
				'post_type' => 'page',
				'post_title' => _x( 'A homepage section', 'Wordpress 4.7 and Up' ),
				'post_content' => _x( 'This is an example of a homepage section. Homepage sections can be any page other than the homepage itself, including the page that shows your latest blog posts.', 'Wordpress 4.7 and Up' ),
			),
		),
	);

	$content = array();

	foreach ( $config as $type => $args ) {
		switch( $type ) {
			// Use options and theme_mods as-is.
			case 'options' :
			case 'theme_mods' :
				$content[ $type ] = $config[ $type ];
				break;

			// Widgets are grouped into sidebars.
			case 'widgets' :
				foreach ( $config[ $type ] as $sidebar_id => $widgets ) {
					foreach ( $widgets as $id => $widget ) {
						if ( is_array( $widget ) ) {

							// Item extends core content.
							if ( ! empty( $core_content[ $type ][ $id ] ) ) {
								$widget = array(
									$core_content[ $type ][ $id ][0],
									array_merge( $core_content[ $type ][ $id ][1], $widget ),
								);
							}

							$content[ $type ][ $sidebar_id ][] = $widget;
						} elseif ( is_string( $widget ) && ! empty( $core_content[ $type ] ) && ! empty( $core_content[ $type ][ $widget ] ) ) {
							$content[ $type ][ $sidebar_id ][] = $core_content[ $type ][ $widget ];
						}
					}
				}
				break;

			// And nav menu items are grouped into nav menus.
			case 'nav_menus' :
				foreach ( $config[ $type ] as $nav_menu_location => $nav_menu ) {

					// Ensure nav menus get a name.
					if ( empty( $nav_menu['name'] ) ) {
						$nav_menu['name'] = $nav_menu_location;
					}

					$content[ $type ][ $nav_menu_location ]['name'] = $nav_menu['name'];

					foreach ( $nav_menu['items'] as $id => $nav_menu_item ) {
						if ( is_array( $nav_menu_item ) ) {

							// Item extends core content.
							if ( ! empty( $core_content[ $type ][ $id ] ) ) {
								$nav_menu_item = array_merge( $core_content[ $type ][ $id ], $nav_menu_item );
							}

							$content[ $type ][ $nav_menu_location ]['items'][] = $nav_menu_item;
						} elseif ( is_string( $nav_menu_item ) && ! empty( $core_content[ $type ] ) && ! empty( $core_content[ $type ][ $nav_menu_item ] ) ) {
							$content[ $type ][ $nav_menu_location ]['items'][] = $core_content[ $type ][ $nav_menu_item ];
						}
					}
				}
				break;

			// Attachments are posts but have special treatment.
			case 'attachments' :
				foreach ( $config[ $type ] as $id => $item ) {
					if ( ! empty( $item['file'] ) ) {
						$content[ $type ][ $id ] = $item;
					}
				}
				break;

			// All that's left now are posts (besides attachments). Not a default case for the sake of clarity and future work.
			case 'posts' :
				foreach ( $config[ $type ] as $id => $item ) {
					if ( is_array( $item ) ) {

						// Item extends core content.
						if ( ! empty( $core_content[ $type ][ $id ] ) ) {
							$item = array_merge( $core_content[ $type ][ $id ], $item );
						}

						// Enforce a subset of fields.
						$content[ $type ][ $id ] = wp_array_slice_assoc(
							$item,
							array(
								'post_type',
								'post_title',
								'post_excerpt',
								'post_name',
								'post_content',
								'menu_order',
								'comment_status',
								'thumbnail',
								'template',
							)
						);
					} elseif ( is_string( $item ) && ! empty( $core_content[ $type ][ $item ] ) ) {
						$content[ $type ][ $item ] = $core_content[ $type ][ $item ];
					}
				}
				break;
		}
	}

	/**
	 * Filters the expanded array of starter content.
	 *
	 * @since 4.7.0
	 *
	 * @param array $content Array of starter content.
	 * @param array $config  Array of theme-specific starter content configuration.
	 */
	return apply_filters( 'weepeeswiss_get_starter_content', $content, $config );
}

// add_filter( 'get_theme_starter_content', 'weepeeswiss_get_starter_content', 10, 3);