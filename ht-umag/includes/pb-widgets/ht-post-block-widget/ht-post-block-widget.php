<?php
/*
Widget Name: Post Block Widget
Description: The main post widget for displaying posts
Author: HighThemes
Author URI: http://highthemes.com
*/

/**
 * Add the carousel image sizes
 */
if(class_exists('SiteOrigin_Widget')){


	class SiteOrigin_Widget_PostBlock_Widget extends SiteOrigin_Widget {
		function __construct() {
			parent::__construct(
				'sow-post-block',
				__('Highthemes Post Block', 'highthemes'),
				array(
					'description' => __('Select Posts by IDs, Category, etc', 'highthemes'),
				),
				array(

				),
				array(
					'title' => array(
						'type' => 'text',
						'label' => __('Title', 'highthemes'),
					),
					'title_url' => array(
						'type' => 'text',
						'label' => __('Title URL', 'highthemes'),
					),
					'title_size' => array(
						'type' => 'select',
						'label' => __('Title Font Size', 'highthemes'),
						'options'=>array('caption'=>'Default', 'small-caption'=>'Small')
					),
					'post_columns' => array(
						'type' => 'select',
						'label' => __('Post Layout', 'highthemes'),
						'options'=>array('1c'=>'1 Column', '2c'=>'2 Columns', '3c'=>'3 Columns', '4c' => '4 Columns')
					),
					'thumb_size' => array(
						'type' => 'select',
						'label' => __('Thumbnail Size', 'highthemes'),
						'options'=>array('a'=>'800x550', 'b'=>'720x800')
					),
					'posts' => array(
						'type' => 'posts',
						'label' => __('Posts query', 'highthemes'),
					),
				),
				plugin_dir_path(__FILE__).'../'
			);
		}

		function initialize() {
			$this->register_frontend_scripts(
				array(

				)
			);
			$this->register_frontend_styles(
				array(

				)
			);
		}

		function get_template_name($instance){
			return 'base';
		}

		function get_style_name($instance){
			return false;
		}
	}

	siteorigin_widget_register('post-block', __FILE__);

}