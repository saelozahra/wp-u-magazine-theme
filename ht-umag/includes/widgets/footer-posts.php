<?php
/**
 * Highthemes Footer Posts
 */

class ht_footer_posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_footer_posts',
			'description' => __( 'List posts for footer.', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_footer_posts',
			'Highthemes - ' . __( 'Footer Posts', 'highthemes' ),
			$widget_ops // Args
		);
	}
		
	public function widget($args, $instance) {

		extract( $args );

		$title = empty($instance['title']) ? __('Recent Posts','highthemes') : $instance['title'];

		$posts = new WP_Query( array(
			'post_type'           => array( 'post' ),
			'showposts'           => $instance['posts_num'],
			'cat'                 => $instance['posts_cat_id'],
			'ignore_sticky_posts' => true,
			'orderby'             => $instance['posts_orderby'],
			'order'               => 'desc',
			'date_query' => array(
				array(
					'after' => $instance['posts_time'],
				),
			),
		) );

		?>
		<!-- FEATURED POSTS STARTS -->
		<div class="footer-posts-widget">
			<h3><?php echo $title; ?></h3>
			<ul class="footer-posts">
				<?php
				while ( $posts->have_posts() ): $posts->the_post();
				?>
				<li>
					<?php if( '1' == $instance['posts_thumb_status'] ): ?>
						<div class="pic"><?php the_post_thumbnail(array(75, 75), array('class'=>'img-circle') ); ?></div>
					<?php endif; ?>
					<div class="info">
						<span class="date"><i class="fa fa-calendar-o"></i> <?php the_time('m/d/Y'); ?></span>
						<span class="comments pull-right"><i class="fa fa-comment-o"></i> <?php comments_number( '0','1','%'); ?></span>
						<span class="likes pull-right"><?php if( function_exists('zilla_likes') ) zilla_likes();?></span>
					</div>
					<div class="caption"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
				</li>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
		</div>
		<!-- FEATURED POSTS ENDS -->
	<?php

	}

	public function update($new, $old) {
		$instance                          = $old;
		$instance['title']            = strip_tags($new['title']);
		$instance['posts_thumb_status']    = strip_tags($new['posts_thumb_status']);
		$instance['posts_num']             = strip_tags($new['posts_num']);
		$instance['posts_cat_id']          = strip_tags($new['posts_cat_id']);
		$instance['posts_orderby']         = strip_tags($new['posts_orderby']);
		$instance['posts_time']            = strip_tags($new['posts_time']);

		return $instance;
	}

	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title'    	         => '',
			'posts_thumb_status' => '1',
			'posts_num' 		 => '4',
			'posts_cat_id' 		 => '0',
			'posts_orderby' 	 => 'date',
			'posts_time' 		 => '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<div class="ht-options-posts">
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('First Tab Title :', 'highthemes'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['posts_thumb_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('posts_thumb_status')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_thumb_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('posts_thumb_status')); ?>"><?php _e('Show thumbnails','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("posts_num")); ?>"><?php _e('Items to show: ', 'highthemes'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id("posts_num")); ?>" name="<?php echo esc_attr($this->get_field_name("posts_num")); ?>" type="text" value="<?php echo esc_attr(absint($instance["posts_num"])); ?>" size='3' />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("posts_cat_id")); ?>"><?php _e('Category:', 'highthemes'); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("posts_cat_id"), 'selected' => $instance["posts_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("posts_orderby")); ?>"><?php _e('Order by:', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("posts_orderby")); ?>" name="<?php echo esc_attr($this->get_field_name("posts_orderby")); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>><?php _e('Most recent', 'highthemes'); ?></option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>><?php _e('Most commented', 'highthemes'); ?></option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>><?php _e('Random', 'highthemes'); ?></option>
			</select>	
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("posts_time")); ?>"><?php _e('Posts from:', 'highthemes'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id("posts_time")); ?>" name="<?php echo esc_attr($this->get_field_name("posts_time")); ?>">
			  <option value="0"<?php selected( $instance["posts_time"], "0" ); ?>><?php _e('All time', 'highthemes'); ?></option>
			  <option value="1 year ago"<?php selected( $instance["posts_time"], "1 year ago" ); ?>><?php _e('This year', 'highthemes'); ?></option>
			  <option value="1 month ago"<?php selected( $instance["posts_time"], "1 month ago" ); ?>><?php _e('This month', 'highthemes'); ?></option>
			  <option value="1 week ago"<?php selected( $instance["posts_time"], "1 week ago" ); ?>><?php _e('This week', 'highthemes'); ?></option>
			  <option value="1 day ago"<?php selected( $instance["posts_time"], "1 day ago" ); ?>><?php _e('Past 24 hours', 'highthemes'); ?></option>
			</select>	
		</p>

	</div>
<?php

}

}
