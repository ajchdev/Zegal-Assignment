<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zegal Assignment
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zegal-assignment' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">

			<div class="zegal-header-top">

				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$zegal_assignment_description = get_bloginfo( 'description', 'display' );
					if ( $zegal_assignment_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $zegal_assignment_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
				
				<div class="header-search-form">
					<?php get_search_form(); ?>
				</div>
				<div class="login-signup">
					<?php if( !is_user_logged_in() ){ ?>
						<a href="#"><?php esc_html_e('Login/Register','zegal-assignment'); ?></a>
					<?php } ?>
					
				</div>
			</div>

			<div class="zegal-header-nav">
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>

		</div>
	</header><!-- #masthead -->
