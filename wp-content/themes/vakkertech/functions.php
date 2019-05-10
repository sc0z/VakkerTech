<?php
/**
 * vakkertech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vakkertech
 */

define('TEMPLATE_DIR', get_template_directory());
define('TEMPLATE_URI', get_template_directory_uri());
define('ASSETS_URI', get_template_directory_uri() . '/dist');
define('ASSETS_DIR', get_template_directory() . '/dist');
// add_action('get_header', 'my_filter_head');

//  function my_filter_head() {
//    remove_action('wp_head', '_admin_bar_bump_cb');
//  }

// Get URI for custom logo
function get_custom_logo_uri()
{
	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id, 'full');
	return $image[0];
}

// Add WebPack4 Bundles
function setup_frontend_bundle()
{
	wp_enqueue_script(
		'vakkertech-js',
		get_template_directory_uri() . '/dist/js/app.min.js',
		['jquery'],
		time(),
		true
	);
	wp_enqueue_style(
		'vakkertech-css',
		get_template_directory_uri() . '/dist/css/app.min.css',
		[],
		time(),
		'all'
	);
}
add_action('init', 'setup_frontend_bundle');

// Add optional WP Admin WebPack4 Bundle
function setup_backend_bundle()
{
	wp_enqueue_script(
		'vakkertech-admin-js',
		get_template_directory_uri() . '/dist/js/admin.min.js',
		['jquery'],
		time(),
		true
	);
}
add_action('admin_enqueue_scripts', 'setup_backend_bundle');

function outputFavicons()
{
	$path = TEMPLATE_URI . '/dist';

	$favicon_html = <<<HTML
	<link rel="apple-touch-icon" sizes="180x180" href="$path/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="$path/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="194x194" href="$path/icons/favicon-194x194.png">
	<link rel="icon" type="image/png" sizes="192x192" href="$path/icons/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="$path/icons/favicon-16x16.png">
	<link rel="manifest" href="$path/icons/site.webmanifest">
	<link rel="mask-icon" href="$path/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="$path/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="msapplication-TileImage" content="$path/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="$path/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
HTML;
	echo $favicon_html;
}

if (!function_exists('vakkertech_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vakkertech_setup()
	{
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-primary' => esc_html__('Primary', 'vakkertech'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('vakkertech_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 100,
			'width'       => 440,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'vakkertech_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vakkertech_widgets_init()
{
	// register_sidebar( array(
	// 	'name'          => esc_html__( 'Sidebar', 'vakkertech' ),
	// 	'id'            => 'sidebar-1',
	// 	'description'   => esc_html__( 'Add widgets here.', 'vakkertech' ),
	// 	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	// 	'after_widget'  => '</section>',
	// 	'before_title'  => '<h2 class="widget-title">',
	// 	'after_title'   => '</h2>',
	// ) );
}
add_action('widgets_init', 'vakkertech_widgets_init');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Removes Comments from admin menu
add_action( 'admin_menu', 'vt_remove_admin_menus' );
function vt_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes Comments from post and pages
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes Comments from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// Disable WordPress from loading it's version of jQuery
// wp_deregister_script('jquery'); 
// wp_register_script('jquery', '', '', '', true);

/**
 * Disable the emoji's for performance
 */
function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, array($emoji_svg_url));
	}

	return $urls;
}
