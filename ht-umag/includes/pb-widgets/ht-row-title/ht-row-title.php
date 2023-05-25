<?php
/*
Widget Name: Row Title
Description: Special Title for Rows
Author: HighThemes
Author URI: http://highthemes.com
*/

/**
 * Title for rows
 */

if(class_exists('SiteOrigin_Widget')) {

	class SiteOrigin_Widget_RowTitle_Widget extends SiteOrigin_Widget {

		function __construct() {
			parent::__construct(
				'sow-row-title',
				__( 'Highthemes Row Title', 'highthemes' ),
				array(
					'description' => __( 'Add a special title to each row', 'highthemes' ),

				),
				array(),
				array(
					'title'      => array(
						'type'  => 'text',
						'label' => __( 'Title', 'highthemes' ),
					),
					'title_url'  => array(
						'type'  => 'text',
						'label' => __( 'Title URL', 'highthemes' ),
					),
					'categories' => array(
						'type'    => 'select',
						'label'   => __( 'Or Select a category instead', 'highthemes' ),
						'options' => $this->get_categories()
					),

				),
				plugin_dir_path( __FILE__ ) . '../'
			);
		}

		function get_categories() {
			$categories     = array( '' => '-- category --' );
			$categories_obj = get_categories( 'hide_empty=0' );
			foreach ( $categories_obj as $highcat ) {
				$categories[ $highcat->cat_ID ] = $highcat->cat_name;
			}

			return $categories;
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

	siteorigin_widget_register( 'row-title', __FILE__ );
}