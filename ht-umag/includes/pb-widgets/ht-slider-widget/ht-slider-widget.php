<?php

/*
Widget Name: Main Slider
Description: The UMag Main Slider
Author: HighThemes
Author URI: http://highthemes.com
*/

if(class_exists('SiteOrigin_Widget')) {

	class SiteOrigin_Widget_MainSlider_Widget extends SiteOrigin_Widget {
		function __construct() {
			parent::__construct(
				'sow-main-slider',
				__( 'Highthemes Main Slider', 'highthemes' ),
				array(
					'description' => __( 'Shows three posts in each slider', 'highthemes' ),

				),
				array(),
				array(
					'layout' => array(
						'type'        => 'select',
						'label'       => __( 'The Slider Layout', 'highthemes' ),
						'options'     => array(
							'3/slide' => __( '3 Posts per slide', 'highthemes' ),
							'2/slide' => __( '2 Posts per slide', 'highthemes' ),
							'1/slide' => __( '1 Post per slide', 'highthemes' )
						),
						'description' => __( 'In order to get the best result, select the number of posts based on the slider layout. For example if you have chosen 3 posts per slide, make sure you have 3, or 6 or 9 posts slected', 'highthemes' )
					),
					'posts'  => array(
						'type'  => 'posts',
						'label' => __( 'Posts query', 'highthemes' ),
					),
				),
				plugin_dir_path( __FILE__ ) . '../'
			);
		}

		function initialize() {
			$this->register_frontend_scripts(
				array()
			);
			$this->register_frontend_styles(
				array()
			);
		}

		function get_template_name( $instance ) {
			return 'base';
		}

		function get_style_name( $instance ) {
			return false;
		}
	}

	siteorigin_widget_register( 'main-slider', __FILE__ );
}