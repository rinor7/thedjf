<?php
/**
 * @package Standard
 */

 function standard_scripts_and_style() {
	wp_enqueue_style( 'base-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'base-theme-bootstrap-style', get_template_directory_uri() . '/assets/css/libs/bootstrap.min.css', array(), null );
	wp_enqueue_style('base-theme-main-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), filemtime(get_template_directory() . '/assets/css/style.min.css'));
	wp_enqueue_style( 'base-theme-swiper-style', get_template_directory_uri() . '/assets/css/libs/swiper.css', array(), null );
	wp_enqueue_style( 'base-theme-awesome-style', get_template_directory_uri() . '/assets/css/libs/fontawesome/css/all.css', array(), null );
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/libs/bootstrap.min.js', array(), null, true );
	wp_enqueue_script( 'base-theme-jquery-js', get_template_directory_uri() . '/assets/js/libs/jquery.js', array(), null, false );
	wp_enqueue_script( 'base-theme-swiper-js', get_template_directory_uri() . '/assets/js/libs/swiper.js', array(), null, true );
	wp_enqueue_script( 'base-theme-main-js', get_template_directory_uri() . '/assets/js/main.min.js',array(), filemtime(get_template_directory() . '/assets/js/main.min.js'), true );
}
add_action( 'wp_enqueue_scripts', 'standard_scripts_and_style' );


// Include files from the 'theme-options' directory
require get_template_directory() . '/theme-options/post-types.php';
require get_template_directory() . '/theme-options/menus.php';
require get_template_directory() . '/theme-options/site-identity.php';
require get_template_directory() . '/theme-options/acf-relocate.php';
require get_template_directory() . '/theme-options/widgets.php';
require get_template_directory() . '/theme-options/enable-php-on-widgets.php';
require get_template_directory() . '/theme-options/container-admin-customize.php';
require get_template_directory() . '/theme-options/general-functions.php';
require get_template_directory() . '/theme-options/taxonomies.php';
require get_template_directory() . '/theme-options/global-headers.php';