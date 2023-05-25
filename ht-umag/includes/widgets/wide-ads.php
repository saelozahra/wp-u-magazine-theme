<?php
/**
 * HighThemes  ads
 */

class ht_wide_ads extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_wide_ads',
			'description' => __( 'Displays 6 300x250 ads blocks', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_wide_ads',
			'Highthemes - ' . __( 'Custom Ads 300x250', 'highthemes' ),
			$widget_ops // Args
		);
	}

	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$ad1       = esc_url($instance['ad1']);
		$ad2       = esc_url($instance['ad2']);
		$ad3       = esc_url($instance['ad3']);
		$ad4       = esc_url($instance['ad4']);
		$ad5       = esc_url($instance['ad5']);
		$ad6       = esc_url($instance['ad6']);
		$link1     = $instance['link1'];
		$link2     = $instance['link2'];
		$link3     = $instance['link3'];
		$link4     = $instance['link4'];
		$link5     = $instance['link5'];
		$link6     = $instance['link6'];
		$randomize = $instance['random'];

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		//Randomize ads order in a new array
		$ads = array();

        /* Display a containing div */
        echo '<div class="ad-300x250">';

		/* Display Ad 1. */
		if ( $link1 )
			$ads[] = '<a href="' . $link1 . '"><img src="' . $ad1 . '"  alt="" /></a>';
			
		elseif ( $ad1 )
		 	$ads[] = '<img src="' . $ad1 . '" alt="" />';
		
		/* Display Ad 2. */
		if ( $link2 )
			$ads[] = '<a href="' . $link2 . '"><img src="' . $ad2 . '"  alt="" /></a>';
			
		elseif ( $ad2 )
		 	$ads[] = '<img src="' . $ad2 . '"  alt="" />';
			
		/* Display Ad 3. */
		if ( $link3 )
			$ads[] = '<a href="' . $link3 . '"><img src="' . $ad3 . '"  alt="" /></a>';
			
		elseif ( $ad3 )
		$ads[] = '<img src="' . $ad3 . '"  alt="" />';
		
		/* Display Ad 4. */
		if ( $link4 )
			$ads[] = '<a href="' . $link4 . '"><img src="' . $ad4 . '"  alt="" /></a>';
			
		elseif ( $ad4 )
		 	$ads[] = '<img src="' . $ad4 . '"  alt="" />';
			
		/* Display Ad 5. */
		if ( $link5 )
			$ads[] = '<a href="' . $link5 . '"><img src="' . $ad5 . '"  alt="" /></a>';
			
		elseif ( $ad5 )
		 	$ads[] = '<img src="' . $ad5 . '"  alt="" />';
			
		/* Display Ad 6. */
		if ( $link6 )
			$ads[] = '<a href="' . $link6 . '"><img src="' . $ad6 . '"  alt="" /></a>';
			
		elseif ( $ad6 )
		 	$ads[] = '<img src="' . $ad6 . '"  alt="" />';
		
		//Randomize order if user want it
		if ($randomize){
			shuffle($ads);
		}

		//Display ads
		foreach($ads as $ad){
			echo '<div class="ad-block">' .  $ad . '</div>' ;
		}
		
		echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];
		$instance['ad5'] = $new_instance['ad5'];
		$instance['ad6'] = $new_instance['ad6'];
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['link5'] = $new_instance['link5'];
		$instance['link6'] = $new_instance['link6'];
		$instance['random'] = $new_instance['random'];
		
		return $instance;
	}
		
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Advertisement',
		'ad1' => get_template_directory_uri()."/images/ads2.jpg",
		'link1' => 'http://www.highthemes.com',
		'ad2' => get_template_directory_uri()."/images/ads2.jpg",
		'link2' => 'http://www.highthemes.com',
		'ad3' => '',
		'link3' => '',
		'ad4' => '',
		'link4' => '',
		'ad5' => '',
		'link5' => '',
		'ad6' => '',
		'link6' => '',
		'random' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<div>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad1' )); ?>"><?php _e('Ad 1 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad1' )); ?>" value="<?php echo esc_attr($instance['ad1']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link1' )); ?>"><?php _e('Ad 1 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link1' )); ?>" value="<?php echo esc_attr($instance['link1']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad2' )); ?>"><?php _e('Ad 2 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad2' )); ?>" value="<?php echo esc_attr($instance['ad2']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link2' )); ?>"><?php _e('Ad 2 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link2' )); ?>" value="<?php echo esc_attr($instance['link2']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad3' )); ?>"><?php _e('Ad 3 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad3' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad3' )); ?>" value="<?php echo esc_attr($instance['ad3']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link3' )); ?>"><?php _e('Ad 3 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link3' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link3' )); ?>" value="<?php echo esc_attr($instance['link3']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad4' )); ?>"><?php _e('Ad 4 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad4' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad4' )); ?>" value="<?php echo esc_attr($instance['ad4']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link4' )); ?>"><?php _e('Ad 4 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link4' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link4' )); ?>" value="<?php echo esc_attr($instance['link4']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad5' )); ?>"><?php _e('Ad 5 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad5' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad5' )); ?>" value="<?php echo esc_attr($instance['ad5']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link5' )); ?>"><?php _e('Ad 5 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link5' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link5' )); ?>" value="<?php echo esc_attr($instance['link5']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'ad6' )); ?>"><?php _e('Ad 6 image url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'ad6' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'ad6' )); ?>" value="<?php echo esc_attr($instance['ad6']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'link6' )); ?>"><?php _e('Ad 6 link url:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'link6' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link6' )); ?>" value="<?php echo esc_attr($instance['link6']); ?>" />
		</p>
		
		<p>
			<?php if ($instance['random']){ ?>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'random' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'random' )); ?>" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'random' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'random' )); ?>"  />
			<?php } ?>
			<label for="<?php echo esc_attr($this->get_field_id( 'random' )); ?>"><?php _e('Randomize ads order?','highthemes') ?></label>
		</p>
		</div>
	<?php
	}
}
