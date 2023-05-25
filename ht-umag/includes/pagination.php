<?php if( ot_get_option('page_navi') == 'on' && function_exists('wp_pagenavi') ) { ?>
	<div class="navi clearfix">
			<?php wp_pagenavi(); ?>
	</div><!--/.pagination-->
<?php } else { ?>
	<div class="navi clearfix">
			<div class="pagination_default clearfix">
				<div class="newer pull-left"><?php previous_posts_link(); ?></div>
				<div class="older pull-right"><?php next_posts_link(); ?></div>
			</div>
	</div><!--/.pagination-->
<?php } ?>