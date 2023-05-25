<?php
/**
 * Highthemes Tabs
 */

class ht_tabs extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'ht_tabs',
			'description' => __( 'List posts, comments and tags.', 'highthemes' ),
			'panels_groups' => array( 'highthemes' )

		);
		parent::__construct(
			'ht_tabs',
			'Highthemes - ' . __( 'Tabs', 'highthemes' ),
			$widget_ops // Args
		);
	}
		
	public function widget($args, $instance) {

		extract( $args );

		$title_tab1 = empty($instance['title_tab1']) ? __('POPULAR','highthemes') : $instance['title_tab1'];
		$title_tab2 = empty($instance['title_tab2']) ? __('COMMENTS','highthemes') : $instance['title_tab2'];
		$title_tab3 = empty($instance['title_tab3']) ? __('TAGS','highthemes') : $instance['title_tab3'];
		$title_tab4 = empty($instance['title_tab4']) ? __('CATEGORIES','highthemes') : $instance['title_tab4'];

		if( empty( $instance['tab1_status']  ) ) $instance['tab1_status'] = '';
		if( empty( $instance['tab2_status']  ) ) $instance['tab2_status'] = '';
		if( empty( $instance['tab3_status']  ) ) $instance['tab3_status'] = '';
		if( empty( $instance['tab4_status']  ) ) $instance['tab4_status'] = '';

		$tab_count = 0;

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

		$tab_id = uniqid();
		?>
		<div class="tabs">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<?php if( '1' == $instance['tab1_status'] ): $tab_count++; ?>
					<li role="presentation"><a href="#popular-<?php echo esc_attr($tab_id); ?>" role="tab" data-toggle="tab"><?php echo $title_tab1; ?></a></li>
					<?php endif; ?>
					<?php if( '1' == $instance['tab2_status'] ): $tab_count++; ?>
					<li role="presentation"><a href="#comments-<?php echo esc_attr($tab_id); ?>" role="tab" data-toggle="tab"><?php echo $title_tab2; ?></a></li>
					<?php endif; ?>
					<?php if( '1' == $instance['tab3_status'] ): $tab_count++; ?>
					<li role="presentation"><a href="#tags-<?php echo esc_attr($tab_id); ?>" role="tab" data-toggle="tab"><?php echo $title_tab3; ?></a></li>
					<?php endif; ?>
					<?php if( '1' == $instance['tab4_status'] ):
						$tab_count++;
							if( $tab_count < 4 ):
					?>
								<li role="presentation"><a href="#categories-<?php echo esc_attr($tab_id); ?>" role="tab" data-toggle="tab"><?php echo $title_tab4; ?></a></li>
					<?php
						endif;
							endif;
					?>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<?php if( '1' == $instance['tab1_status'] ): ?>
					<!-- POPULAR STARTS -->
					<div role="tabpanel" class="tab-pane active" id="popular-<?php echo esc_attr($tab_id); ?>">
						<ul class="tabs-posts">
							<?php
							while ( $posts->have_posts() ): $posts->the_post();
							?>
							<li>
								<?php if( '1' == $instance['posts_thumb_status'] ): ?>
								<div class="pic"><?php the_post_thumbnail('small_thumbnail'); ?></div>
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
					<!-- POPULAR ENDS -->
					<?php endif; ?>
					<?php if( '1' == $instance['tab2_status'] ): ?>
					<!-- COMENTS STARTS -->
					<div role="tabpanel" class="tab-pane" id="comments-<?php echo esc_attr($tab_id); ?>">
						<ul class="tabs-posts">
							<?php echo ht_recent_comments($instance['comm_num'],$instance['comm_thumb_status']); ?>
						</ul>
					</div>
					<!-- COMENTS ENDS -->
					<?php endif; ?>
					<?php if( '1' == $instance['tab3_status'] ): ?>
					<!-- TAG STARTS -->
					<div role="tabpanel" class="tab-pane" id="tags-<?php echo esc_attr($tab_id); ?>">
						<div class="tag-list">
							<?php
							$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
							foreach ( (array) $tags as $tag ) {
								echo '<a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . ' (' . $tag->count . ') </a>';
							}
							?>
						</div>
					</div>
					<!-- TAGS ENDS -->
					<?php endif; ?>
					<?php if( '1' == $instance['tab4_status'] && $tab_count < 4 ): ?>
					<!-- Categories Starts -->
					<div role="tabpanel" class="tab-pane" id="categories-<?php echo esc_attr($tab_id); ?>">
						<div class="categories">
							<ul class="cats">
								<?php
								$cat_args = array(
									'order'     => 'desc',
									'orderby'   => 'count',
									'parent'    => 0,
									'number' => $instance['cat_num'],
								);
								$categories = get_categories( $cat_args );

								foreach ( $categories as $category ):
									$image_url = (function_exists('z_taxonomy_image_url')) ? z_taxonomy_image_url($category->term_id, array(50, 50)) : '';
								?>
									<li>
										<?php
										if( '1' == $instance['cat_thumb_status'] ) {
											if (!empty($image_url)) echo '<img alt="" class="img-circle" src="' . $image_url . '" />';
										}
										?>
										<a href="<?php echo esc_url(get_category_link( $category->term_id )); ?>"><?php echo $category->name; ?></a>
										<span class="pull-right"><?php echo esc_html($category->count); ?></span>
									</li>
								<?php
								endforeach;
								?>
							</ul>
						</div>
					</div>
					<!-- Categories Ends -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php

	}

	public function update($new, $old) {
		$instance                          = $old;
		$instance['title_tab1']            = strip_tags($new['title_tab1']);
		$instance['title_tab2']            = strip_tags($new['title_tab2']);
		$instance['title_tab3']            = strip_tags($new['title_tab3']);
		$instance['title_tab4']            = strip_tags($new['title_tab4']);
		if( isset( $new['tab1_status'] ) ) $instance['tab1_status'] = strip_tags($new['tab1_status']);
		if( isset( $new['tab2_status'] ) ) $instance['tab2_status'] = strip_tags($new['tab2_status']);
		if( isset( $new['tab3_status'] ) ) $instance['tab3_status'] = strip_tags($new['tab3_status']);
		if( isset( $new['tab4_status'] ) ) $instance['tab4_status'] = strip_tags($new['tab4_status']);
		$instance['posts_thumb_status']    = strip_tags($new['posts_thumb_status']);
		$instance['cat_thumb_status']      = strip_tags($new['cat_thumb_status']);
		$instance['comm_thumb_status']     = strip_tags($new['comm_thumb_status']);
		$instance['posts_num']             = strip_tags($new['posts_num']);
		$instance['cat_num']               = strip_tags($new['cat_num']);
		$instance['comm_num']              = strip_tags($new['comm_num']);
		$instance['posts_cat_id']          = strip_tags($new['posts_cat_id']);
		$instance['posts_orderby']         = strip_tags($new['posts_orderby']);
		$instance['posts_time']            = strip_tags($new['posts_time']);

		return $instance;
	}

	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title_tab1' 	     => '',
			'title_tab2' 	     => '',
			'title_tab3' 	     => '',
			'title_tab4' 	     => '',
			'tab1_status' 	     => '',
			'tab2_status' 	     => '',
			'tab3_status' 	     => '',
			'tab4_status' 	     => '',
			'posts_thumb_status' => '1',
			'cat_thumb_status'   => '1',
			'comm_thumb_status'  => '1',
			'posts_num' 		 => '4',
			'cat_num' 		     => '4',
			'comm_num' 		     => '4',
			'posts_cat_id' 		 => '0',
			'posts_orderby' 	 => 'date',
			'posts_time' 		 => '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<div class="ht-options-posts">
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="hidden" value="" />
		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['tab1_status'], 1); ?> id="<?php echo  esc_attr($this->get_field_id('tab1_status')); ?>" name="<?php echo esc_attr($this->get_field_name('tab1_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('tab1_status')); ?>"><?php _e('Posts tab status','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_tab1')); ?>"><?php _e('Posts tab title:', 'highthemes'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_tab1')); ?>" name="<?php echo esc_attr($this->get_field_name('title_tab1')); ?>" type="text" value="<?php echo esc_attr($instance["title_tab1"]); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts_thumb_status')); ?>"><?php _e('Show thumbnails','highthemes') ?></label>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['posts_thumb_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('posts_thumb_status')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_thumb_status')); ?>" />
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

		<hr>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['tab2_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('tab2_status')); ?>" name="<?php echo esc_attr($this->get_field_name('tab2_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('tab2_status')); ?>"><?php _e('Comments tab status','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_tab2')); ?>"><?php _e('Comments tab title:', 'highthemes'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_tab2')); ?>" name="<?php echo esc_attr($this->get_field_name('title_tab2')); ?>" type="text" value="<?php echo esc_attr($instance["title_tab2"]); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['comm_thumb_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('comm_thumb_status')); ?>" name="<?php echo esc_attr($this->get_field_name('comm_thumb_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('comm_thumb_status')); ?>"><?php _e('Show avatars','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("comm_num")); ?>"><?php _e('Items to show: ', 'highthemes'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id("comm_num")); ?>" name="<?php echo esc_attr($this->get_field_name("comm_num")); ?>" type="text" value="<?php echo esc_attr(absint($instance["comm_num"])); ?>" size='3' />
		</p>

		<hr>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['tab3_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('tab3_status')); ?>" name="<?php echo esc_attr($this->get_field_name('tab3_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('tab3_status')); ?>"><?php _e('Tags tab status','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_tab3')); ?>"><?php _e('Tags tab title:', 'highthemes'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_tab3')); ?>" name="<?php echo esc_attr($this->get_field_name('title_tab3')); ?>" type="text" value="<?php echo esc_attr($instance["title_tab3"]); ?>" />
		</p>

		<hr/>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['tab4_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('tab4_status')); ?>" name="<?php echo esc_attr($this->get_field_name('tab4_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('tab4_status')); ?>"><?php _e('Categories tab status','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_tab4')); ?>"><?php _e('Categories tab title:', 'highthemes'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_tab4')); ?>" name="<?php echo esc_attr($this->get_field_name('title_tab4')); ?>" type="text" value="<?php echo esc_attr($instance["title_tab4"]); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked($instance['cat_thumb_status'], 1); ?> id="<?php echo esc_attr($this->get_field_id('cat_thumb_status')); ?>" name="<?php echo esc_attr($this->get_field_name('cat_thumb_status')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('cat_thumb_status')); ?>"><?php _e('Show thumbnails','highthemes') ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id("cat_num")); ?>"><?php _e('Items to show: ', 'highthemes'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id("cat_num")); ?>" name="<?php echo esc_attr($this->get_field_name("cat_num")); ?>" type="text" value="<?php echo esc_attr(absint($instance["cat_num"])); ?>" size='3' />
		</p>
	</div>
<?php

}

}
