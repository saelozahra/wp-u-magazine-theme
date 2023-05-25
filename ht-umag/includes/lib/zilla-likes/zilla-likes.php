<?php


class ZillaLikes {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
		add_filter( 'body_class', array( &$this, 'body_class' ) );
		add_action( 'publish_post', array( &$this, 'setup_likes' ) );
		add_action( 'wp_ajax_zilla-likes', array( &$this, 'ajax_callback' ) );
		add_action( 'wp_ajax_nopriv_zilla-likes', array( &$this, 'ajax_callback' ) );
		//add_shortcode( 'zilla_likes', array( &$this, 'shortcode' ) );
		add_action( 'widgets_init', create_function( '', 'register_widget("ZillaLikes_Widget");' ) );
	}


	function enqueue_scripts() {
		wp_enqueue_style( 'zilla-likes', get_template_directory_uri() . '/includes/lib/zilla-likes/styles/zilla-likes.css' );
		wp_enqueue_script( 'zilla-likes', get_template_directory_uri() . '/includes/lib/zilla-likes/scripts/zilla-likes.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery' );
		wp_localize_script( 'zilla-likes', 'zilla_likes', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}


	function setup_likes( $post_id ) {
		if ( ! is_numeric( $post_id ) ) {
			return;
		}
		add_post_meta( $post_id, '_zilla_likes', '0', true );
	}

	function ajax_callback( $post_id ) {

		$options['zero_postfix'] = '';
		$options['one_postfix']  = '';
		$options['more_postfix'] = '';

		if ( isset( $_POST['likes_id'] ) ) {
			// Click event. Get and Update Count
			$post_id = str_replace( 'zilla-likes-', '', $_POST['likes_id'] );
			echo $this->like_this( $post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'update' );
		} else {
			// AJAXing data in. Get Count
			$post_id = str_replace( 'zilla-likes-', '', $_POST['post_id'] );
			echo $this->like_this( $post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'get' );
		}

		exit;
	}

	function like_this( $post_id, $zero_postfix = false, $one_postfix = false, $more_postfix = false, $action = 'get' ) {
		if ( ! is_numeric( $post_id ) ) {
			return;
		}
		$zero_postfix = strip_tags( $zero_postfix );
		$one_postfix  = strip_tags( $one_postfix );
		$more_postfix = strip_tags( $more_postfix );

		switch ( $action ) {

			case 'get':
				$likes = get_post_meta( $post_id, '_zilla_likes', true );
				if ( ! $likes ) {
					$likes = 0;
					add_post_meta( $post_id, '_zilla_likes', $likes, true );
				}

				if ( $likes == 0 ) {
					$postfix = $zero_postfix;
				} elseif ( $likes == 1 ) {
					$postfix = $one_postfix;
				} else {
					$postfix = $more_postfix;
				}

				return '<i class="fa fa-heart-o"></i><span class="zilla-likes-count">' . $likes . '</span> <span class="zilla-likes-postfix">' . $postfix . '</span>';
				break;

			case 'update':
				$likes = get_post_meta( $post_id, '_zilla_likes', true );
				if ( isset( $_COOKIE[ 'zilla_likes_' . $post_id ] ) ) {
					return $likes;
				}

				$likes ++;
				update_post_meta( $post_id, '_zilla_likes', $likes );
				setcookie( 'zilla_likes_' . $post_id, $post_id, time() * 20, '/' );

				if ( $likes == 0 ) {
					$postfix = $zero_postfix;
				} elseif ( $likes == 1 ) {
					$postfix = $one_postfix;
				} else {
					$postfix = $more_postfix;
				}

				return '<i class="fa fa-heart-o"></i><span class="zilla-likes-count">' . $likes . '</span> <span class="zilla-likes-postfix">' . $postfix . '</span>';
				break;

		}
	}

	function shortcode( $atts ) {
		extract( shortcode_atts( array(), $atts ) );

		return $this->do_likes();
	}

	function do_likes($post_id=0) {
		global $post;

		if(!$post_id) {
			$post_id = $post->ID;
		}

		$options = get_option( 'zilla_likes_settings' );
		if ( ! isset( $options['zero_postfix'] ) ) {
			$options['zero_postfix'] = '';
		}
		if ( ! isset( $options['one_postfix'] ) ) {
			$options['one_postfix'] = '';
		}
		if ( ! isset( $options['more_postfix'] ) ) {
			$options['more_postfix'] = '';
		}

		$output = $this->like_this( $post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'] );

		$class = 'zilla-likes';
		$title = __( 'Like this', 'zillalikes' );
		if ( isset( $_COOKIE[ 'zilla_likes_' . $post_id ] ) ) {
			$class = 'zilla-likes active';
			$title = __( 'You already like this', 'zillalikes' );
		}

		return '<a href="#" class="' . $class . '" data-id="zilla-likes-' . $post_id . '" title="' . $title . '">' . $output . '</a>';
	}

	function body_class( $classes ) {
		$options = get_option( 'zilla_likes_settings' );

		if ( ! isset( $options['ajax_likes'] ) ) {
			$options['ajax_likes'] = false;
		}

		if ( $options['ajax_likes'] ) {
			$classes[] = 'ajax-zilla-likes';
		}

		return $classes;
	}

}

global $zilla_likes;
$zilla_likes = new ZillaLikes();

/**
 * Template Tag
 */
function zilla_likes($post_id=0) {
	global $zilla_likes;
	echo $zilla_likes->do_likes($post_id);
}

/**
 * Widget to display posts by likes popularity
 */
class ZillaLikes_Widget extends WP_Widget {

	function __construct() {
		parent::WP_Widget( 'zilla_likes_widget', 'Post Likes', array( 'description' => __( 'Displays your most popular posts sorted by most liked', 'highthemes' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title         = apply_filters( 'widget_title', $instance['title'] );
		$desc          = $instance['description'];
		$posts         = empty( $instance['posts'] ) ? 1 : $instance['posts'];
		$display_count = $instance['display_count'];

		// Output our widget
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		if ( $desc ) {
			echo '<p>' . $desc . '</p>';
		}

		$likes_posts_args = array(
			'numberposts' => $posts,
			'orderby'     => 'meta_value_num',
			'order'       => 'DESC',
			'meta_key'    => '_zilla_likes',
			'post_type'   => 'post',
			'post_status' => 'publish'
		);
		$likes_posts      = get_posts( $likes_posts_args );

		echo '<ul class="zilla-likes-popular-posts">';
		foreach ( $likes_posts as $likes_post ) {
			$count_output = '';
			if ( $display_count ) {
				$count        = get_post_meta( $likes_post->ID, '_zilla_likes', true );
				$count_output = " <span class='zilla-likes-count'>($count)</span>";
			}
			echo '<li><a href="' . get_permalink( $likes_post->ID ) . '">' . get_the_title( $likes_post->ID ) . '</a>' . $count_output . '</li>';
		}
		echo '</ul>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['description']   = strip_tags( $new_instance['description'], '<a><b><strong><i><em><span>' );
		$instance['posts']         = strip_tags( $new_instance['posts'] );
		$instance['display_count'] = strip_tags( $new_instance['display_count'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance
		);

		$defaults = array(
			'title'         => __( 'Popular Posts', 'highthemes' ),
			'description'   => '',
			'posts'         => 5,
			'display_count' => 1
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title         = $instance['title'];
		$description   = $instance['description'];
		$posts         = $instance['posts'];
		$display_count = $instance['display_count'];
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'highthemes' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php _e( 'Description:', 'highthemes' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" type="text"
			       value="<?php echo esc_attr($description); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'posts' )); ?>"><?php _e( 'Posts:', 'highthemes' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'posts' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'posts' )); ?>" type="text" value="<?php echo esc_attr($posts); ?>"
			       size="3"/>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id( 'display_count' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'display_count' )); ?>" type="checkbox"
			       value="1" <?php checked( $display_count ); ?>>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'display_count' )); ?>"><?php _e( 'Display like counts', 'highthemes' ); ?></label>
		</p>

	<?php
	}
}