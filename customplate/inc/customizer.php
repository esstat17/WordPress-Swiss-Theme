<?php
/**
 * Custom Plate Customizer support
 *
 * @package WordPress
 * @subpackage Custom_Plate
 * @since Custom Plate 1.0
 */

/**
 * Implement Customizer additions and adjustments.
 *
 * @since Custom Plate 1.0
 * @link Customizer Advanced Topic https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function customplate_customize_register( $wp_customize ) {
	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'customplate' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'customplate' );

	// Add the featured content section in case it's not already there.
	$wp_customize->add_section( 'main_settings', array(
		'title'           => __( 'General Settings', 'customplate' ),
		'description'     => __( 'Main configuration settings for an active theme.', 'customplate'),
		'priority'        => 5
	) );

	// Add the featured content layout setting and control.
	$wp_customize->add_setting( 'show_nav_right', array(
		'default'           => 'no',
		'sanitize_callback' => 'customplate_sanitize_answer',
	) );

	$wp_customize->add_control( 'show_nav_right', array(
		'label'   		=> __( 'Show Right Widget Nav', 'customplate' ),
		'description'   => __( 'Always show right widget to the top navigation', 'customplate'),
		'section' 		=> 'main_settings',
		'type'    		=> 'select',
		'choices' 		=> array(
			'no'   => __( 'No',   'customplate' ),
			'yes' => __( 'Yes', 'customplate' ),
		),
	) );

	// Parallax Content Box in the Home Page.
	$wp_customize->add_setting( 'front_box', array(
		'default'           => '',
		'sanitize_callback' => 'customplate_sanitize_empty_check',
	) );

	$wp_customize->add_control( 'front_box', array(
		'label'   		=> __( 'Content Box', 'customplate'),
		'description'   => __( 'You can insert HTML, shortcodes, etc. ', 'customplate'),
		'section' 		=> 'static_front_page',
		'type'    		=> 'textarea',
		'active_callback' => 'is_front_page',
	) );

	// Parallax Welcome Screen in the Home Page.
	$wp_customize->add_setting( 'parallax_screen', array(
		'default'           => '',
		'sanitize_callback' => 'customplate_sanitize_empty_check',
	) );

	$wp_customize->add_control( 'parallax_screen', array(
		'label'   		=> __( 'Welcome Screen', 'customplate'),
		'description'   => __( 'Parallax HTML content in the frontpage', 'customplate'),
		'section' 		=> 'static_front_page',
		'type'    		=> 'textarea',
		'active_callback' => 'is_front_page',
	) );

	// General Settings: Custom Code in the Header
	$wp_customize->add_setting( 'custom_head', array(
		'default'	=> 
'<style type="text/css">
	/* CSS inline goes here */
</style>
<script type="text/javascript">
	// Javascript inline goes here
</script>',
		'sanitize_callback' => 'customplate_sanitize_empty_check',
		'transport'	=> 'refresh'
	) );

	$wp_customize->add_control( 'custom_head', array(
		'label'   => __( 'Header Insert Code', 'customplate' ),
		'description' => __('Miscellaneous code for an active theme in the Header. You can hack CSS, JS, etc', 'customplate'),
		'section' => 'main_settings',
		'type'    => 'textarea',
	) );

	// General Settings: Custom Code in the Footer
	$wp_customize->add_setting( 'custom_footer', array(
		'default'	=> '',
		'sanitize_callback' => 'customplate_sanitize_empty_check',
		'transport'	=> 'refresh'
	) );

	$wp_customize->add_control( 'custom_footer', array(
		'label'   => __( 'Footer Insert Code', 'customplate' ),
		'description' => __('Miscellaneous code for an active theme in the footer.', 'customplate'),
		'section' => 'main_settings',
		'type'    => 'textarea',
	) );

	// Site Indentity: Footer Copyright Notice
	$wp_customize->add_setting( 'footer_copyright', array(
		'default'	=> 'Copyright 2016 - All Right Reserved', 'customplate',
		'sanitize_callback' => 'esc_html',
		'transport'	=> 'postMessage'
	) );

	$wp_customize->add_control( 'footer_copyright', array(
		'label'   => __( 'Copyright Notice', 'customplate' ),
		'section' => 'title_tagline',
	) );

	// Removing this color setting
	$wp_customize->remove_control( 'header_textcolor' );

	// Color Settings
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'text_color', '#504c4d', __('Text Color', 'customplate' ), '', 'colors', 'sanitize_hex_color', 'postMessage');
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'link_color', '#4b8abb', __('Link Color', 'customplate' ), '', 'colors', 'sanitize_hex_color', 'postMessage');
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'htags_color', '#555555', __('H-Tags Color', 'customplate' ), '', 'colors', 'sanitize_hex_color', 'postMessage');
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'header_bg', '#ffffff', __('Header Background', 'customplate' ), '', 'colors', 'sanitize_hex_color', 'postMessage');
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'footer_bg', '#262626', __('Footer Background', 'customplate' ), '', 'colors', 'sanitize_hex_color', 'postMessage');
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'color_1', '#f68712', __('Color #1 (Unused)', 'customplate' ), __('Insert <code>.color-1</code> or <code>.bg-color-1</code> class', 'customplate'), 'colors', 'sanitize_hex_color', 'postMessage' );
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'color_2', '#f4e7ba', __('Color #2 (Unused)', 'customplate' ), __('Insert <code>.color-2</code> or <code>.bg-color-2</code> class', 'customplate'), 'colors', 'sanitize_hex_color', 'postMessage' );
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'color_3', '#92c095', __('Color #3 (Unused)', 'customplate' ), __('Insert <code>.color-3</code> or <code>.bg-color-3</code> class', 'customplate'), 'colors', 'sanitize_hex_color', 'postMessage' );
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'color_4', '#eeeeee', __('Color #4', 'customplate' ), __('Insert <code>.color-4</code> or <code>.bg-color-4</code> class. Used in the Footer H-Tag.', 'customplate'), 'colors', 'sanitize_hex_color', 'postMessage' );
	customplate_customize_color($wp_customize, 'WP_Customize_Color_Control', 'color_5', '#bab0b0', __('Color #5', 'customplate' ), __('Insert <code>.color-5</code> or <code>.bg-color-5</code> class. Used in the Footer Text.', 'customplate'), 'colors', 'sanitize_hex_color', 'postMessage' );

	// Upload Logo
	customplate_customize_color($wp_customize, 'WP_Customize_Image_Control', 'add_logo', '', 'Upload a Logo', 'Suggested Logo Dimension 320 x 200 pixel', 'title_tagline', 'customplate_sanitize_img_uri', 'refresh');

	// Upload Welcome Screen Background
	customplate_customize_color($wp_customize, 'WP_Customize_Image_Control', 'welcome_bg', '', 'Upload Welcome Screen Background', 'Suggested Dimension <b>1920 x 1080</b>px', 'static_front_page', 'customplate_sanitize_img_uri', 'refresh');
	
	/*
	// Color setting and control. 5 Customized Colors.
	$wp_customize->add_setting( 'color_1', array(
		'default'           => '#f4bbba',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_1', array(
		'label'       => __( 'Color #1', 'customplate' ),
		'section'     => 'colors',
		'description' => __( 'For usage, insert this value `color-1` into attribute class.', 'customplate')
	) ) );
	*/
}
add_action( 'customize_register', 'customplate_customize_register' );

/**
 * Color setting and controls.
 *
 * @since Custom Plate 1.0
 *
 * @param string $wp_customize object for theme customizer.
 * @param string $sanitize Sanitize Callback Functon
 * @param string $setting_id Theme Setting ID.
 * @param string $default_color Default Color Fallback.
 * @param string $label Used in the Label
 * @param string $desc Description in the Color Controls
 * @param string $section Theme Section.
 * @param string $sanitize Sanitize Callback function
 * @param string $transport Refresh or Async refresh/transport
 * @return void
 */
function customplate_customize_color($wp_customize, $new_control, $setting_id, $default_color, $label, $desc, $section, $sanitize, $transport){
	
	$wp_customize->add_setting( $setting_id, array(
		'default'           => $default_color,
		'sanitize_callback' => $sanitize,
		'transport'         => $transport,
	) );

	$wp_customize->add_control( new $new_control( $wp_customize, $setting_id, array(
		'label'       => $label,
		'section'     => $section,
		'description' => $desc
	) ) );
}

/**
 * Sanitize Yes/No value.
 *
 * @since Custom Plate 1.0
 *
 * @param string $answer Layout type.
 * @return string Filtered answer type (no/yes).
 */
function customplate_sanitize_answer( $answer ) {
	if ( ! in_array( $answer, array( 'no', 'yes' ) ) ) {
		$answer = 'no';
	}
	return $answer;
}

/**
 * Sanitize Custom Code.
 *
 * @since Custom Plate 1.0
 * @param string $value Data from the Textarea in the Custom Head and Footer Section.
 * @return string $value or none.
 */
function customplate_sanitize_empty_check($value){
	if(!empty($value) && isset($value)){
		return $value;
	}
	return ''; // Bail out!
}

/**
 * Sanitize Logo Image URL.
 *
 * @since Custom Plate 1.0
 * @param string $value Data from the Textarea in the Static Front Page.
 * @return string $value or none.
 */
function customplate_sanitize_img_uri($value){
	$value = esc_url($value);
	return $value;
}

/**
 * Bind JS handlers to make Customizer preview reload changes asynchronously.
 *
 * @since Custom Plate 1.0
 */
function customplate_customize_preview_js() {
	wp_enqueue_script( 'customplate_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'customplate_customize_preview_js' );


/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function customplate_link_color_css() {
	$background_color = get_theme_mod( 'background_color', '#ffffff' );
	$link_color = get_theme_mod( 'link_color', '#4b8abb' );
	$htags_color = get_theme_mod( 'htags_color', '#555555' );
	$header_bg = get_theme_mod( 'header_bg', '#ffffff' );
	$footer_bg = get_theme_mod( 'footer_bg', '#262626' );
	$text_color = get_theme_mod( 'text_color', '#504c4d' );
	$color_1 = get_theme_mod( 'color_1', '#f68712' );
	$color_2 = get_theme_mod( 'color_2', '#f4e7ba' );
	$color_3 = get_theme_mod( 'color_3', '#92c095' );
	$color_4 = get_theme_mod( 'color_4', '#eeeeee' );
	$color_5 = get_theme_mod( 'color_5', '#bab0b0' );

	// Hide or Display Site Title and Description
	$display_header_text = display_header_text()==1?'.site-name, .site-desc{clip:auto;position:static;}':'.site-name, .site-desc{clip: rect(1px 1px 1px 1px);position: absolute;}';
	$header_image = false==get_header_image()?'':'#primary-navigation{background-image:url("'.get_header_image().'");}';
	

	$css = array(
		'display_header_text'	=> $display_header_text,
		'header_image'		    => $header_image,
		'background_color'     	=> $background_color,
		'link_color'     		=> $link_color,
		'htags_color'     		=> $htags_color,
		'header_bg'     		=> $header_bg,
		'footer_bg'     		=> $footer_bg,
		'text_color'     		=> $text_color,
		'color_1'     			=> $color_1,
		'color_2'     			=> $color_2,
		'color_3'     			=> $color_3,
		'color_4'     			=> $color_4,
		'color_5'     			=> $color_5,		
	);
	$css = customplate_css_factory($css);
	wp_add_inline_style( 'customplate-style', $css );
}
add_action( 'wp_enqueue_scripts', 'customplate_link_color_css', 11 );


/**
 * Customplate CSS Factory.
 *
 * @since Custom Plate 1.0
 *
 * @see 
 */
function customplate_css_factory($css) {
	$css = wp_parse_args( $css, array(
		'background_color'      => '',
		'header_image'			=> '',
		'display_header_text' 	=> '',
		'link_color' 			=> '',
		'htags_color'     		=> '',
		'header_bg'     		=> '',
		'footer_bg'     		=> '',
		'text_color'       		=> '',
		'color_1'       		=> '',
		'color_2'       		=> '',
		'color_3'       		=> '',
		'color_4'       		=> '',
		'color_5'       		=> '',
	));
	$style = <<<CSS
.custom-background {
	background-color: #{$css['background_color']};
}
.text-color {
	color: {$css['text_color']};
}
a, a:hover, a:focus{
    color: {$css['link_color']};
}
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{
    color: {$css['htags_color']};
}
.header-bg {
	background-color: {$css['header_bg']};
}
.footer-bg {
	background-color: {$css['footer_bg']};
}
.color-1, .color-1 a {
	color: {$css['color_1']};
}
.color-2, .color-2 a{
	color: {$css['color_2']};
}
.color-3, .color-3 a{
	color: {$css['color_3']};
}
.color-4, .color-4 a{
	color: {$css['color_4']};
}
.color-5, .color-5 a{
	color: {$css['color_5']};
}
.bg-color-1{
	background-color: {$css['color_1']};
}
.bg-color-2{
	background-color: {$css['color_2']};
}
.bg-color-3{
	background-color: {$css['color_3']};
}
.bg-color-4{
	background-color: {$css['color_4']};
}
.bg-color-5{
	background-color: {$css['color_5']};
}
{$css['display_header_text']}
{$css['header_image']}


CSS;

$min_style = preg_replace('/\s+/', ' ',$style);
return $min_style;
}

/**
 * Output Hooks
 */ 
// Hook for Logo image URL.
function customplate_theme_logo($img_url) {
	$img_url_mod = get_theme_mod( 'add_logo');
	if(!empty($img_url_mod) && isset($img_url_mod)){
		$img_url = $img_url_mod;
	}
	return $img_url;
}
add_filter( 'ctp_logo', 'customplate_theme_logo' );

// Hook for Welcome Screen image URL.
function customplate_wc_screen_bg($img_url) {
	$img_url_mod = get_theme_mod( 'welcome_bg');
	if(!empty($img_url_mod) && isset($img_url_mod)){
		$img_url = $img_url_mod;
	}
    return $img_url;
}
add_filter( 'ctp_welcome_bg', 'customplate_wc_screen_bg' );

// Always show Navigation Scroll Right show_nav_right
function customplate_show_nav_scroll($nav_scroll) {
	$nav_scroll_mod = get_theme_mod( 'show_nav_right');
	if(!empty($nav_scroll_mod) && $nav_scroll_mod =="yes"){
		$nav_scroll = 'navi-always-show';
	}
    echo $nav_scroll;
}
add_filter( 'ctp_show_nav', 'customplate_show_nav_scroll' );

// Header Hook
function customplate_head_hook() {
	$custom_head = get_theme_mod( 'custom_head', '');
	echo $custom_head;
}
add_action('wp_head','customplate_head_hook');

// Footer Hook
function customplate_foot_hook() {
	$custom_footer = get_theme_mod( 'custom_footer', '');
	echo $custom_footer;
}
add_action('wp_footer','customplate_foot_hook');

// Parallax Screen Hook
function customplate_parallax_screen_html() {
	$html = get_theme_mod( 'parallax_screen', '');
    return $html;
}
add_filter('ctp_screen_html','customplate_parallax_screen_html');

// Conten Box in the Frontend Hook
function customplate_parallax_front_box() {
	$html = do_shortcode(get_theme_mod( 'front_box', ''));
    echo $html;
}
add_action('ctp_front_section_before','customplate_parallax_front_box');

// Hook Footer Copyright Notice
function customplate_copyright_notice() {
	$footer_copyright = get_theme_mod( 'footer_copyright', '');
    return $footer_copyright;
}
add_filter( 'ctp_copyright', 'customplate_copyright_notice' );





