<?php
/**
 * Zegal Assignment Theme Customizer
 *
 * @package Zegal Assignment
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zegal_assignment_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->panel = 'zegal_assignment_general_panel';
	$wp_customize->get_section( 'header_image' )->panel = 'zegal_assignment_general_panel';
	$wp_customize->get_section( 'background_image' )->panel = 'zegal_assignment_general_panel';
	$wp_customize->get_section( 'colors' )->panel = 'zegal_assignment_general_panel';
	$wp_customize->add_panel( 'zegal_assignment_general_panel',
		array(
			'title'      => esc_html__( 'General Settings', 'zegal-assignment' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'zegal_assignment_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'zegal_assignment_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_panel(
        'zegal_assignment_home_panel', 
    	array(
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Front Page Settings', 'zegal-assignment' ),
        ) 
    );

	$zegal_assignment_cat_list = zegal_assignment_category_list();

	$wp_customize->add_section( 'home_banner_section',
		array(
		'title'      => esc_html__( 'Home Banner', 'zegal-assignment' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'zegal_assignment_home_panel',
		)
	);

	$wp_customize->add_setting('home_header_banner',
		array(
			'default' => 1,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zegal_assignment_sanitize_checkbox',
		)
	);
	$wp_customize->add_control('home_header_banner',
		array(
			'label' => esc_html__('Enable Banner Section', 'zegal-assignment'),
			'section' => 'home_banner_section',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting('home_banner_category',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zegal_assignment_sanitize_category',
		)
	);
	$wp_customize->add_control('home_banner_category',
		array(
			'label' => esc_html__('Home Banner Category', 'zegal-assignment'),
			'section' => 'home_banner_section',
			'type' => 'select',
			'choices' => $zegal_assignment_cat_list,
		)
	);

	$wp_customize->add_section( 'home_category_filter_section',
		array(
		'title'      => esc_html__( 'Home Category Filter Section', 'zegal-assignment' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'zegal_assignment_home_panel',
		)
	);

	$wp_customize->add_setting('enable_home_category_filter_section',
		array(
			'default' => 1,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'zegal_assignment_sanitize_checkbox',
		)
	);
	$wp_customize->add_control('enable_home_category_filter_section',
		array(
			'label' => esc_html__('Enable Home Category Filter Section', 'zegal-assignment'),
			'section' => 'home_category_filter_section',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_category_filter_section_shortcode',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control(
		'home_category_filter_section_shortcode',
		array(
			'label' => esc_html__('Section Shortcode','zegal-assignment'),
			'type' => 'text',
			'section' => 'home_category_filter_section'
		)
	);
}
add_action( 'customize_register', 'zegal_assignment_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function zegal_assignment_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function zegal_assignment_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zegal_assignment_customize_preview_js() {
	wp_enqueue_script( 'zegal-assignment-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'zegal_assignment_customize_preview_js' );

if( !function_exists('zegal_assignment_sanitize_checkbox') ):

	/**
	* Customizer Checkbox Sanitize
	**/

	function zegal_assignment_sanitize_checkbox($input){

	    if($input == 1){
	        return 1;
	    }else{
	        return '';
	    }

	}

endif;

if( !function_exists('zegal_assignment_sanitize_category') ):

	/**
	* Customizer Category Sanitize
	**/

	function zegal_assignment_sanitize_category($input){

	    $zegal_assignment_Category_list = zegal_assignment_category_list();

	    if(array_key_exists($input,$zegal_assignment_Category_list)){
	        return $input;
	    }
	    else{
	        return '';
	    }
	}

endif;