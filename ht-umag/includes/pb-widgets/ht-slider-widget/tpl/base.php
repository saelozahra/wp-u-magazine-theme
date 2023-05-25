<?php
$query            = siteorigin_widget_post_selector_process_query( $instance['posts'] );
$the_query        = new WP_Query( $query );
$slide_item_count = $the_query->post_count;
$j                = 0;
$layout           = $instance['layout'];

if ( $the_query->have_posts() ) :?>
	<!-- SLIDER STARTS
	========================================================================= -->
	<div>
			<div class="row slider">
				<?php if( $layout == '1/slide' ||  $slide_item_count == 1 ) : ?>
						<!-- Slide Wrapper Start -->
							<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();
								$categories          = get_the_category();
								$first_category_name = $categories[0]->name;
								$first_category_link = get_category_link( $categories[0]->term_id );
								$img                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

								$thumbnail_url = has_post_thumbnail() ? $img[0] : 'http://placehold.it/1140x550';
								?>
								<div class="row">
									<!-- Column 1 Starts -->
									<div class="col-lg-12">
										<div class="pic-with-overlay">
											<img src="<?php echo sow_esc_url( $thumbnail_url ) ?>" class="img-responsive" alt="">
											<div class="bg">&nbsp;</div>
											<div><span class="category"><?php echo esc_html($first_category_name); ?></span></div>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<div class="author"><?php _e( 'By', 'highthemes' ); ?> <?php the_author_posts_link(); ?></div>
										</div>
									</div>
								</div>
								<?php
							endwhile;
							?>

				<?php elseif($layout == '2/slide' || $slide_item_count == 2):?>
					<?php for ( $i = 0; $i < $slide_item_count; $i += 2 ): ?>
						<!-- Slide Wrapper Start -->
						<div class="slide-wrapper">
							<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();
								$categories          = get_the_category();
								$first_category_name = $categories[0]->name;
								$first_category_link = get_category_link( $categories[0]->term_id );
								$img                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post_thumbnail' );

								$thumbnail_url = has_post_thumbnail() ? $img[0] : 'http://placehold.it/800x550';
								?>
									<div class="col-lg-6">
										<div class="pic-with-overlay">
											<img src="<?php echo sow_esc_url( $thumbnail_url ) ?>" class="img-responsive" alt="">
											<div class="bg">&nbsp;</div>
											<div><span class="category"><?php echo esc_html($first_category_name); ?></span></div>
											<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<div class="author"><?php _e( 'By', 'highthemes' ); ?> <?php the_author_posts_link(); ?></div>
										</div>
									</div>
								<?php
								$j ++;
								if ( $j % 2 == 0 ) {
									break;
								}
							endwhile;
							?>
						</div>
						<!-- Slide Wrapper Ends -->
					<?php
					endfor;
				?>
				<?php else : ?>
					<?php for ( $i = 0; $i < $slide_item_count; $i += 3 ): ?>
					<!-- Slide Wrapper Start -->
					<div class="slide-wrapper">
						<?php
						$k = 0;
						while ( $the_query->have_posts() ) : $the_query->the_post();
							$categories          = get_the_category();
							$first_category_name = $categories[0]->name;
							$first_category_link = get_category_link( $categories[0]->term_id );
							$img                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post_thumbnail' );

							$thumbnail_url = has_post_thumbnail() ? $img[0] : 'http://placehold.it/800x550';
							if ( $k == 0 ) { ?>
								<!-- Column 1 Starts -->
								<div class="col-lg-8 col-md-8">
									<div class="pic-with-overlay">
										<img src="<?php echo sow_esc_url( $thumbnail_url ) ?>" class="img-responsive" alt="">
										<div class="bg">&nbsp;</div>
										<div><span class="category"><?php echo esc_html($first_category_name); ?></span></div>
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<div class="author"><?php _e( 'By', 'highthemes' ); ?> <?php the_author_posts_link(); ?></div>
									</div>
								</div>
								<!-- Column 1 Ends -->
							<?php } elseif ( $k == 1 ) { ?>
								<!-- Column 2 Starts -->
								<div class="col-lg-4 col-md-4">
									<div class="row">
										<div class="col-lg-12">
											<div class="pic-with-overlay-2">
												<img src="<?php echo sow_esc_url( $thumbnail_url ) ?>" class="img-responsive" alt="">
												<div class="bg">&nbsp;</div>
												<div><span class="category"><?php echo esc_html($first_category_name); ?></span></div>
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<div class="author"><?php _e( 'By', 'highthemes' ); ?> <?php the_author_posts_link(); ?></div>
											</div>
										</div>
								<?php if ( $j + 1 == $slide_item_count ) {
									echo '</div>
										</div><!-- Column 2 End-->';
									}
								} elseif ( $k == 2 ) { ?>
										<div class="col-lg-12">
											<div class="pic-with-overlay-2">
												<img src="<?php echo sow_esc_url( $thumbnail_url ) ?>" class="img-responsive" alt="">
												<div class="bg">&nbsp;</div>
												<div><span class="category"><?php echo esc_html($first_category_name); ?></span></div>
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<div class="author"><?php _e( 'By', 'highthemes' ); ?> <?php the_author_posts_link(); ?></div>
											</div>
										</div>

									</div>
								</div>
								<!-- Column 2 Ends -->
							<?php
							}
							$j ++;
							$k ++;
							if ( $j % 3 == 0 ) {
								break;
							}
						endwhile;
						?>
					</div>
					<!-- Slide Wrapper Ends -->
				<?php
				endfor;
				endif;
					?>
			</div>
	</div>
	<!-- /. SLIDER ENDS
		========================================================================= -->
<?php endif; ?>
<?php wp_reset_postdata(); ?>