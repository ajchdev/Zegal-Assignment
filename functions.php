<?php
/**
 * Zegal Assignment functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Zegal Assignment
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zegal_assignment_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Zegal Assignment, use a find and replace
		* to change 'zegal-assignment' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'zegal-assignment', get_template_directory() . '/languages' );

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
	add_image_size('zegal-assignment-grid', 350, 350, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'zegal-assignment' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zegal_assignment_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'zegal_assignment_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zegal_assignment_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zegal_assignment_content_width', 640 );
}
add_action( 'after_setup_theme', 'zegal_assignment_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zegal_assignment_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zegal-assignment' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zegal-assignment' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zegal_assignment_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zegal_assignment_scripts() {

	$the_words_font_query_args = array('family' => 'Roboto:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
    wp_enqueue_style('zegal-assignment-google-fonts', add_query_arg($the_words_font_query_args, "//fonts.googleapis.com/css"));
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.css' );
	wp_enqueue_style( 'zegal-assignment-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'zegal-assignment-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'zegal-assignment-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zegal_assignment_scripts' );

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

if( !function_exists('zegal_assignment_category_list') ):

	/** Post Category List **/
	function zegal_assignment_category_list(){
	    $cat_lists = get_categories(
	        array(
	            'hide_empty' => '0',
	            'exclude' => '1',
	        )
	    );
	    $cat_array = array();
	    $cat_array[] = esc_html__('Choose Category','zegal-assignment');
	    foreach( $cat_lists as $cat_list ){
	        $cat_array[$cat_list->slug] = $cat_list->name;
	    }
	    return $cat_array;
	}

endif;

if( !function_exists('zegal_assignment_home_banner') ):

	/** Post Category List **/
	function zegal_assignment_home_banner(){
		$home_banner_category = get_theme_mod('home_banner_category');

		$banner_post_args = array(
			'poat_type' => 'post',
			'order' => 'DESC',
			'posts_per_page' => 20,
			'post_status' => 'publish',
			'category_name' => $home_banner_category
		); 
		$banner_post_query = new WP_Query( $banner_post_args );

		if( $banner_post_query->have_posts() ): ?>

			<div class="home-banner">
				<div class="home-banner-action">

					<?php
					while( $banner_post_query->have_posts() ){
						$banner_post_query->the_post();

						$banner_post_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
						$banner_post_image = isset( $banner_post_image[0] ) ? $banner_post_image[0] : ''; ?>

						<div class="home-banner-item">
							<div class="home-banner-content-wrap">
								<div class="home-banner-image" <?php if( $banner_post_image ){ ?> style="background-image: url(<?php echo esc_url( $banner_post_image ); ?> );" <?php } ?> ></div>

								<div class="home-banner-content">
									<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words( get_the_title(),10,'...' ) ); ?></a></h4>
								</div>
							</div>
						</div>

					<?php }
					wp_reset_postdata(); ?>

				</div>
			</div>

		<?php endif;
	}

endif;

if( !function_exists('zegal_assignment_home_category_filter_section') ):

	/** Post Category List **/
	function zegal_assignment_home_category_filter_section(){
		$home_category_filter_section_shortcode = get_theme_mod('home_category_filter_section_shortcode');
		if( $home_category_filter_section_shortcode ){
			echo do_shortcode( $home_category_filter_section_shortcode );
		}
	}

endif;

