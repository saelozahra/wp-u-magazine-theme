<?php
/**
 * Highthemes Authors
 */

class ht_authors extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_authors',
			'description' => __( 'Displays list of authors', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_authors',
			'Highthemes - ' . __( 'Authors', 'highthemes' ),
			$widget_ops // Args
		);
	}
		
	public function widget($args, $instance) {
		$display_admins = $instance['admins'];
		$order_by       = $instance['order_by'];
		$order          = $instance['order'];
		$role           = $instance['role'];
		$hide_empty     = $instance['hide_empty'];
		$avatar_size    = 70;

		$title = apply_filters('widget_title', empty($instance['title']) ? __('FEATURED AUTHORS', 'highthemes') : $instance['title'], $instance, $this->id_base);

		// if admin is allowed
		if ( $display_admins == 'true' ) {
			$blogusers = get_users( 'orderby=' . $order_by . '&role=' . $role );
		} else {

			$admins  = get_users( 'role=administrator' );
			$exclude = array();

			foreach ( $admins as $ad ) {
				$exclude[] = $ad->ID;
			}

			$exclude   = implode( ',', $exclude );
			$blogusers = get_users( 'exclude=' . $exclude . '&orderby=' . $order_by . '&order=' . $order . '&role=' . $role );
		}

		$authors = array();
		foreach ( $blogusers as $bloguser ) {
			$user = get_userdata( $bloguser->ID );

			if ( $hide_empty == 'true' ) {
				$numposts = count_user_posts( $user->ID );
				if ( $numposts < 1 ) {
					continue;
				}
			}
			$authors[] = (array) $user;
		}

		echo $args['before_widget'];
		?>
		<div class="featured-authors">
		<div class="row">
			<div class="col-lg-12">
				<?php echo $args['before_title'] . $title . $args['after_title'] ?>
			</div>
		</div>
		<ul>
		<?php
		foreach ( $authors as $author ) {
			$avatar             = get_avatar( $author['ID'], $avatar_size );
			$author_profile_url = get_author_posts_url( $author['ID'] );

			echo '<li>';
			echo '<a href="', $author_profile_url, '">', $avatar, '</a>';
			echo '</li>';
		}

		echo '</ul></div>';
		/* After widget (defined by themes). */
		echo $args['after_widget'];
	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;


		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['admins']     = $new_instance['admins'];
		$instance['order_by']   = $new_instance['order_by'];
		$instance['order']      = $new_instance['order'];
		$instance['role']       = $new_instance['role'];
		$instance['hide_empty'] = $new_instance['hide_empty'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title'      => 'Featured Authors',
			'admins'     => true,
			'order_by'   => 'post_count',
			'order'      => 'DESC',
			'role'       => '',
			'hide_empty' => false,

		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>

		<div>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title') ); ?>"><?php _e('Title:','highthemes') ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id( 'title') ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id("admins")); ?>"><?php _e('Display Admins?', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("admins")); ?>" name="<?php echo esc_attr($this->get_field_name("admins")); ?>">
			  <option value="true"<?php selected( $instance["admins"], "true" ); ?>><?php _e('Yes', 'highthemes'); ?></option>
			  <option value="false"<?php selected( $instance["admins"], "false" ); ?>><?php _e('No', 'highthemes'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("order_by")); ?>"><?php _e('Order by:', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("order_by")); ?>" name="<?php echo esc_attr($this->get_field_name("order_by")); ?>">
			  <option value="post_count"<?php selected( $instance["order_by"], "post_count" ); ?>><?php _e('Post Count', 'highthemes'); ?></option>
			  <option value="nicename"<?php selected( $instance["order_by"], "Nicename" ); ?>><?php _e('Nicename', 'highthemes'); ?></option>
			  <option value="email"<?php selected( $instance["order_by"], "email" ); ?>><?php _e('Email', 'highthemes'); ?></option>
			  <option value="url"<?php selected( $instance["order_by"], "url" ); ?>><?php _e('URL', 'highthemes'); ?></option>
			  <option value="registered"<?php selected( $instance["order_by"], "registered" ); ?>><?php _e('Registered', 'highthemes'); ?></option>
			  <option value="display_name"<?php selected( $instance["order_by"], "display_name" ); ?>><?php _e('Display Name', 'highthemes'); ?></option>

			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id("order")); ?>"><?php _e('Order', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("order")); ?>" name="<?php echo esc_attr($this->get_field_name("order")); ?>">
			  <option value="ASC"<?php selected( $instance["order"], "ASC" ); ?>><?php _e('ASC', 'highthemes'); ?></option>
			  <option value="DESC"<?php selected( $instance["order"], "DESC" ); ?>><?php _e('DESC', 'highthemes'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id("role")); ?>"><?php _e('Order by:', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("role")); ?>" name="<?php echo esc_attr($this->get_field_name("role")); ?>">
			  <option value=""<?php selected( $instance["role"], "" ); ?>><?php _e('All', 'highthemes'); ?></option>
			  <option value="subscriber"<?php selected( $instance["role"], "subscriber" ); ?>><?php _e('Subscriber', 'highthemes'); ?></option>
			  <option value="contributor"<?php selected( $instance["role"], "contributor" ); ?>><?php _e('Contributor', 'highthemes'); ?></option>
			  <option value="editor"<?php selected( $instance["role"], "editor" ); ?>><?php _e('Editor', 'highthemes'); ?></option>
			  <option value="author"<?php selected( $instance["role"], "author" ); ?>><?php _e('Author', 'highthemes'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id("hide_empty")); ?>"><?php _e('Hide Empty', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("hide_empty")); ?>" name="<?php echo esc_attr($this->get_field_name("hide_empty")); ?>">
			  <option value="true"<?php selected( $instance["hide_empty"], "true" ); ?>><?php _e('Yes', 'highthemes'); ?></option>
			  <option value="false"<?php selected( $instance["hide_empty"], "false" ); ?>><?php _e('No', 'highthemes'); ?></option>
			</select>
		</p>

		</div>
	<?php
	}
}




