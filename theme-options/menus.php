<?php 

function menu_setup() {
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Main Header Menu', 'standard' ),
			'menu-2' => esc_html__( 'Policy Privacy Menu', 'standard' ),
		)
	);
}
add_action( 'after_setup_theme', 'menu_setup' );