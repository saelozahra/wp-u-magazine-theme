<?php
$query = siteorigin_widget_post_selector_process_query( $instance['posts'] );
$the_query = new WP_Query( $query );
$thumbnail_size = ( $instance['thumb_size'] == 'a' ) ? 'post_thumbnail' : 'post_thumbnail_b';
$ht_post_layout = $instance['post_columns'];

switch($ht_post_layout){
	case '1c':
		$ht_post_classes = 'col-lg-12';
		break;
	case '2c':
		$ht_post_classes = 'col-lg-6 col-md-6';
		break;
	case '3c':
		$ht_post_classes = 'col-lg-4 col-md-4';
		break;
	case '4c':
		$ht_post_classes = 'col-lg-3 col-md-4';
		break;
	default:
		$ht_post_classes = 'col-lg-6 col-md-6';
		break;
}
?>
<?php if($the_query->have_posts()) : ?>
	<div>
		<?php if(!empty($instance['title'])):?>
		<div class="row category-caption">
			<div class="col-lg-12">
				<h2 class="pull-left"><?php echo esc_html($instance['title']);?></h2>
				<?php if(!empty($instance['title_url'])):?>
				<a href="<?php echo esc_url($instance['title_url']);?>"><span class="pull-right"><i class="fa fa-plus"></i></span></a>
				<?php endif;?>
			</div>
		</div>
		<?php endif;?>
			<div class="row">
				<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php
					$categories          = get_the_category();
					$first_category_name = $categories[0]->name;
					$first_category_link = get_category_link( $categories[0]->term_id );
					$post_format         = get_post_format();

					?>
					<!-- ARTICLE STARTS -->
					<article class="<?php echo esc_attr($ht_post_classes);?>">
						<?php if( has_post_thumbnail() ) : $img = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size); ?>
						<div class="picture">
							<div class="category-image">
								<img src="<?php echo sow_esc_url($img[0]) ?>" class="img-responsive" alt="" >
								<h2 class="overlay-category"><a href="<?php echo esc_url($first_category_link);?>"><?php echo esc_html($first_category_name);?></a></h2>
								<?php if( $post_format == 'video' ) { ?>
									<div class="play-icon"><i class="fa fa-film"></i></div>
								<?php } elseif( $post_format == 'audio' ) { ?>
									<div class="play-icon"><i class="fa fa-music"></i></div>
								<?php } elseif( $post_format == 'gallery' ) { ?>
									<div class="play-icon"><i class="fa fa-picture-o"></i></div>
								<?php } else { /* standard */ } ?>
							</div>
						</div>
						<?php endif?>

						<div class="detail">
							<div class="info">
								<span class="date"><i class="fa fa-calendar-o"></i> <?php echo ht_time_ago();?></span>
								<span class="comments pull-right"><a href="<?php echo get_comments_link();?>"><i class="fa fa-comment-o"></i> <?php comments_number('0', '1', '%');?></a></span>
								<span class="likes pull-right"><?php if( function_exists('zilla_likes') ) zilla_likes();?></span>
							</div>
							<h3 class="<?php echo ($instance['title_size'] == 'small-caption') ? 'small-caption' : 'caption'; ?>"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<div class="author">
								<div class="pic">
									<?php echo get_avatar( get_the_author_meta('email'), '50', '', '', array('class'=>'img-circle') ); ?>
									<span class="name"><?php the_author_posts_link();?></span>
									<span class="read-article pull-right"><a href="<?php the_permalink();?>"><?php _e('MORE', 'highthemes');?> <i class="fa fa-angle-left"></i></a></span>
								</div>
							</div>
						</div>
					</article>
					<!-- ARTICLE ENDS -->
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
	</div>
<?php endif; ?>