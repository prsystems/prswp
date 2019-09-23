<?php
/**
 * prstheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prstheme
 */

if ( ! function_exists( 'prswp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function prswp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on prstheme, use a find and replace
		 * to change 'prswp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'prswp', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'prswp' ),
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
		add_theme_support( 'custom-background', apply_filters( 'prswp_custom_background_args', array(
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
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => __( 'strong magenta', 'themeLangDomain' ),
				'slug' => 'strong-magenta',
				'color' => '#a156b4',
			),
			array(
				'name' => __( 'light grayish magenta', 'themeLangDomain' ),
				'slug' => 'light-grayish-magenta',
				'color' => '#d0a5db',
			),
			array(
				'name' => __( 'very light gray', 'themeLangDomain' ),
				'slug' => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name' => __( 'very dark gray', 'themeLangDomain' ),
				'slug' => 'very-dark-gray',
				'color' => '#444',
			),
		) );
		
		add_theme_support( 'align-wide' );
		
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' => __( 'Small', 'themeLangDomain' ),
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => __( 'Normal', 'themeLangDomain' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => __( 'Large', 'themeLangDomain' ),
				'size' => 36,
				'slug' => 'large'
			),
			array(
				'name' => __( 'Huge', 'themeLangDomain' ),
				'size' => 50,
				'slug' => 'huge'
			)
		) );
		
		add_theme_support('editor-styles');
		
		add_editor_style( 'style-editor.css' );
		
		add_theme_support( 'wp-block-styles' );

	}
endif;
add_action( 'after_setup_theme', 'prswp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prswp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'prswp_content_width', 640 );
}
add_action( 'after_setup_theme', 'prswp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prswp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'prswp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'prswp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'prswp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function prswp_scripts() {
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
	
    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.11.1/css/all.css' );
    
	wp_enqueue_style( 'prswp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery') );
    
	wp_enqueue_script( 'prswp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'prswp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'prswp_scripts' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';