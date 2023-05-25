<?php

class ht_socials extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_socials_widget clearfix',
			'description' => __( 'Display social icons', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_socials',
			'Highthemes - ' . __( 'Social Icons', 'highthemes' ),
			$widget_ops // Args
		);
	}


	// list of available socials
	public $social_list = array(
			"rss_id"         => "RSS",
			"twitter_id"     => "Twitter",
			"facebook_id"    => "Facebook",
			"gplus_id"       => "Google Plus",
			"flickr_id"      => "Flickr",
			"linkedin_id"    => "LinkedIn",
			"dribbble_id"    => "Dribbble",
			"github_id"      => "Github",
			"tumblr_id"      => "Tumblr",
			"skype_id"       => "Skype",
			"dropbox_id"     => "Dropbox",
			"instagram_id"   => "Instagram",
			"youtube_id"     => "Youtube",
			"pinterest_id"   => "Pinterest",
			"behance_id"     => "Behance",
			"xing_id"        => "Xing",
			"soundcloud_id"  => "Soundcloud",
			"email_id"       => "Email"

		);	


	public $social_icon_names = array(
			"rss_id"         => "fa-rss",
			"twitter_id"     => "fa-twitter",
			"facebook_id"    => "fa-facebook",
			"gplus_id"       => "fa-google-plus",
			"flickr_id"      => "fa-flickr",
			"linkedin_id"    => "fa-linkedin",
			"dribbble_id"    => "fa-dribbble",
			"github_id"      => "fa-github",
			"tumblr_id"      => "fa-tumblr",
			"skype_id"       => "fa-skype",
			"dropbox_id"     => "fa-dropbox",
			"instagram_id"   => "fa-instagram",
			"youtube_id"     => "fa-youtube",
			"pinterest_id"   => "fa-pinterest",
			"behance_id"     => "fa-behance",
			"xing_id"        => "fa-xing",
			"soundcloud_id"  => "fa-soundcloud",
			"email_id"       => "fa-envelope"

		);		

	
	// display the widget in the theme
	function widget( $args, $instance ) {

		extract( $args );
		// getting the checked socials
		$social_values = array();
		foreach($this->social_list as $index=>$value) {
			if( isset( $instance[$index] ) ) {
				$social_values[$index] = $instance[$index];
			}
		}


		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);		

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		// list of final socials
		$socials = array();

        /* Display a containing div */
        echo '<div class="join-us"><ul>';

		$target = (ot_get_option('social_menu_target') == 'on') ? '_blank' : '_self' ;
        foreach($social_values as $key=>$social_status){
        	if( $social_values[$key]){
        		if($key =='email_id') {
        			$socials[] = '<li class="'.substr($this->social_icon_names[$key],3).'"><div class="icon"><a target="'. $target.'" title="'. $this->social_list[$key].'" href="mailto:' . ot_get_option($key) . '"><i class="fa '.$this->social_icon_names[$key].'"></i></a></div></li>';

        		} else {
        			$socials[] = '<li class="'.substr($this->social_icon_names[$key],3).'"><div class="icon"><a target="'. $target.'" title="'. $this->social_list[$key].'" href="' . ot_get_option($key) . '"><i class="fa '.$this->social_icon_names[$key].'"></i></a></div></li>';
        		}
			
        	}
        }
		
		foreach($socials as $social){
			echo $social;
		}
		
		echo '</ul></div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		

		foreach($this->social_list as $key=>$value) {
			if(!empty($new_instance[$key])){
				$instance[$key] = $new_instance[$key];

			}
		}
				
		return $instance;
	}
		
	function form( $instance ) {
	
		/* Set up some default widget settings. */
			$title =  !empty($instance['title']) ? strip_tags($instance['title']) : '';

		foreach($this->social_list as $key=>$value) {
			$defaults[$key] = '';
		}
	
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo ($this->get_field_id('title')); ?>">
		<?php _e('Title:','highthemes'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo
			esc_attr($title); ?>" /></p>    
        
		<?php 

		foreach($this->social_list as $key=>$value) {
		?>
		<p>
			<?php if ($instance[$key]){ ?>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( $key )); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( $key )); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>"  />
			<?php } ?>
 		<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_attr($value); ?></label>

		</p>
		<?php
		}

	}
}