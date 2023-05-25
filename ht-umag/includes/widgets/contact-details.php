<?php
/**
 * Highthemes Contact Details
 */

class ht_contact_details extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_contact_details',
			'description' => __( 'Contact Details', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);

		parent::__construct(
			'ht_contact_details',
			'Highthemes - ' . __( 'Contact Details', 'highthemes' ),
			$widget_ops // Args
		);
	}	

	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);

		if(isset($instance['contact_details'])) $instance['contact_details'] = stripslashes($instance['contact_details']);

		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
				


?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="contactus">
		<?php echo stripslashes($instance['contact_details']);?>
        </ul>
<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contact_details'] = $new_instance['contact_details'];

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array(  'title'=>'Contact Us', 'contact_details'=>'<li><i class="fa fa-building-o"></i> PO Box 16122 Collins Street West<br>Victoria 8007 Australia</li><li><i class="fa fa-phone"></i> +61 3 8376 6284</li><li><i class="fa fa-envelope-o"></i> <a href="#">info@umag.com</a></li>'));

	$contact_details = $instance['contact_details'];
	$title =  strip_tags($instance['title']);

	
	
	// print the form fields
?>

    <div class="contact-details">
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:','highthemes') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo
		esc_attr($title); ?>" />
		</p>

        <p>
			<label for="<?php echo esc_attr($this->get_field_id('contact_details')); ?>">
        	<?php _e('Contact Details:','highthemes'); ?></label>
		</p>
            <textarea cols="36" rows="15" class="widefat" name="<?php echo esc_attr($this->get_field_name('contact_details')); ?>" id="<?php echo esc_attr($this->get_field_id('contact_details')); ?>"><?php echo
            esc_attr($contact_details); ?></textarea>


    </div>
	<?php
	}
	}
