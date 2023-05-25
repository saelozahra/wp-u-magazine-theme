<?php
/*
Template Name: Sitemap
*/
get_header();

// get sidebar layout
$ht_layout     = ot_get_option( 'layout-global' );
$ht_page_title = get_post_meta( get_the_ID(), '_ht_page_title', true);

// grid classes
include( locate_template('includes/layout-classes.php') );

?>
	<!-- PAGE CONTENTS STARTS
		========================================================================= -->
	<div class="page-contents <?php echo esc_attr($ht_page_content_class);?>">
		<div class="container">
			<div class="row">
				<!-- LEFT COLUMN STARTS
					========================================================================= -->
				<div class="col-lg-12">
					<div>

						<?php if( 'on' == $ht_page_title ):?>
							<div class="row category-caption">
								<div class="col-lg-12">
									<h2 class="pull-left"><?php echo strtoupper(get_the_title());?></h2>
								</div>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-lg-12">
									<?php
									if(have_posts()):
										while (have_posts()) :the_post();
											?>
											<div class="description">
												<?php the_content(); ?>
											</div>
										<?php
										endwhile;
									else:
										get_template_part( 'includes/templates/no-results' );
									endif;
									?>
							</div>
						</div>
						<div class="row category-caption">
							<div class="col-lg-3">
								<h2><?php _e('PAGES', 'highthemes');?></h2>
								<ul class="sitemap"><?php wp_list_pages('title_li=' ); ?></ul>
							</div>
							<div class="col-lg-3">
								<h2><?php _e('CATEGORIES', 'highthemes');?></h2>
								<ul class="sitemap"><?php wp_list_categories('title_li=&orderby=name&show_count=1&hierarchical=0&feed=RSS'); ?></ul>
							</div>
							<div class="col-lg-3">
								<h2><?php _e('ARCHIVE', 'highthemes');?></h2>
								<ul class="sitemap">
									<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
								</ul>
							</div>
							<div class="col-lg-3">
								<h2><?php _e('PAGES', 'highthemes');?></h2>
								<ul class="sitemap">
									<li><a title="Full content" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','highthemes'); ?></a></li>
									<li><a title="Comment Feed" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','highthemes'); ?></a></li>
								</ul>
							</div>
						</div>

					</div>


				</div>

			</div>
		</div>

	</div>
	<!-- /. PAGE CONTENTS ENDS
		========================================================================= -->
<?php  get_footer();?>