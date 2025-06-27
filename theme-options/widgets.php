<?php

function standard_widgets_init() {
	register_sidebar(
		array('name'          => esc_html__( 'Logo Header', 'standard' ),
			'id'            => 'widget-1',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Policy Privacy Menu Footer', 'standard' ),
			'id'            => 'footer-2',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Contact Info Footer', 'standard' ),
			'id'            => 'footer-3',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Copyright Footer', 'standard' ),
			'id'            => 'footer-5',)
	);
}
add_action( 'widgets_init', 'standard_widgets_init' );