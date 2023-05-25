<?php
$ht_related = ht_related_posts();
if ( $ht_related->have_posts() ):
?>
<hr>
<!-- Related Articles Starts -->
<div class="related-articles">
	<div class="row category-caption">
		<div class="col-lg-12">
			<h2 class="pull-left"><?php _e('RELATED ARTICLES', 'highthemes');?></h2>
		</div>
	</div>
	<div class="row">
		<?php
		$i = 1;
		while ( $ht_related->have_posts() ) : $ht_related->the_post();
			if (has_post_thumbnail()) {
				$ht_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mega_thumbnail');
				$ht_image_url = $ht_image_url[0];
			} else {
				$ht_image_url = get_template_directory_uri() . '/images/800x550.png';
			}
			$ht_category = get_the_category();
			$ht_category_name = $ht_category[0]->name;
			$ht_post_format  = get_post_format();
		?>
		<article class="col-lg-6 col-md-6 col-sm-6">
			<div class="picture">
				<div class="category-image">
					<img src="<?php echo esc_url($ht_image_url);?>" alt="<?php the_title_attribute()?>" title="<?php the_title();?>">
					<h2 class="overlay-category"><?php echo esc_html($ht_category_name);?></h2>
					<?php if( $ht_post_format == 'video' ) { ?>
						<div class="play-icon"><i class="fa fa-film"></i></div>
					<?php } elseif( $ht_post_format == 'audio' ) { ?>
						<div class="play-icon"><i class="fa fa-music"></i></div>
					<?php } elseif( $ht_post_format == 'gallery' ) { ?>
						<div class="play-icon"><i class="fa fa-picture-o"></i></div>
					<?php } else { /* standard */ } ?>
				</div>
			</div>
			<div class="detail">
				<div class="info">
					<span class="date"><i class="fa fa-calendar-o"></i> <?php the_time("Y/m/d");?></span>
					<span class="comments pull-right"><i class="fa fa-comment-o"></i> <?php echo get_comments_number();?></span>
					<span class="likes pull-right"> <?php if(function_exists('zilla_likes')) echo zilla_likes();?></span>
				</div>
				<div class="caption"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
				<div class="author">
					<div class="pic">
						<?php echo get_avatar( get_the_author_meta('email'), '50', '', '', array('class'=>'img-circle ') );?> <span class="name"><a href=""><?php the_author_meta('display_name'); ?></a></span>
						<span class="read-article pull-right"><a href="<?php the_permalink();?>"><?php _e('MORE', 'highthemes');?> <i class="fa fa-angle-left"></i></a></span>
					</div>
				</div>
			</div>
		</article>
		<!-- ARTICLE ENDS -->
		<?php
			if($i % 2 == 0) echo '<div style="clear:both"></div>';
			$i++;?>
		<?php endwhile; ?>

	</div>
</div>
<!-- Related Articles Ends -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>