<?php
/**
 * vakkertech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vakkertech
 */

 define('TEMPLATE_URI', get_template_directory_uri());

 add_action('get_header', 'my_filter_head');

 function my_filter_head() {
   remove_action('wp_head', '_admin_bar_bump_cb');
 }

 // Get URI for custom logo
function get_custom_logo_uri(){
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

// Add WebPack4 Bundles
function setup_frontend_bundle(){
	wp_enqueue_script( 
		'vakkertech-js', 
		get_template_directory_uri() . '/dist/js/app.min.js', 
		[
			'jquery'
		],
		time(),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'setup_frontend_bundle' );  

// Add optional WP Admin WebPack4 Bundle
function setup_backend_bundle(){
	wp_enqueue_script( 
		'vakkertech-admin-js', 
		get_template_directory_uri() . '/dist/js/admin.min.js', 
		[
			'jquery'
		],
		time(),
		true
	);
}
add_action( 'admin_enqueue_scripts', 'setup_backend_bundle' );  

function outputFavicons(){
	$path = TEMPLATE_URI;

	$favicon_html = <<<HTML
	<link rel="apple-touch-icon" sizes="180x180" href="$path/assets/dist/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="$path/assets/dist/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="194x194" href="$path/assets/dist/icons/favicon-194x194.png">
	<link rel="icon" type="image/png" sizes="192x192" href="$path/assets/dist/icons/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="$path/assets/dist/icons/favicon-16x16.png">
	<link rel="manifest" href="$path/assets/dist/icons/site.webmanifest">
	<link rel="mask-icon" href="$path/assets/dist/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="$path/assets/dist/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="msapplication-TileImage" content="$path/assets/dist/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="$path/assets/dist/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
HTML;
	echo $favicon_html;
}

if ( ! function_exists( 'vakkertech_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vakkertech_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on vakkertech, use a find and replace
		 * to change 'vakkertech' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'vakkertech', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'vakkertech' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'vakkertech_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 440,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'vakkertech_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vakkertech_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'vakkertech_content_width', 640 );
}
add_action( 'after_setup_theme', 'vakkertech_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vakkertech_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'vakkertech' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'vakkertech' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'vakkertech_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vakkertech_scripts() {
	wp_enqueue_style( 'vakkertech-style', get_stylesheet_uri() );

	wp_enqueue_script( 'vakkertech-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'vakkertech-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vakkertech_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

