<?php
/*
Template Name: Authors
*/
get_header();

// get sidebar layout
$ht_layout     = ot_get_option( 'layout-global' );
$ht_page_title = get_post_meta( get_the_ID(), '_ht_page_title', true);

// grid classes
include( locate_template('includes/layout-classes.php') );

// Get users
$count_users_res = count_users();

?>
	<!-- PAGE CONTENTS STARTS
		========================================================================= -->
	<div class="inner-page-contents <?php echo esc_attr($ht_page_content_class);?>">
		<div class="container">
			<div class="row">
				<!-- LEFT COLUMN STARTS
					========================================================================= -->
				<div class="<?php echo esc_attr($ht_grid_8_class);?>">
					<div>
						<?php if( 'on' == $ht_page_title ):?>
							<div class="row category-caption">
								<div class="col-lg-12">
									<h2 class="pull-left"><?php echo strtoupper(get_the_title());?> (<?php echo esc_html($count_users_res['total_users']); ?>)</h2>
								</div>
							</div>
						<?php endif; ?>
						<div class="row">
							<?php
							if(have_posts()):
								while (have_posts()) :the_post();
									$blogusers = get_users();
									foreach( $blogusers as $author):
										?>
											<!-- About Author Starts -->
											<div class="col-lg-12 col-md-12">
												<div class="about-author">
													<div class="row">

															<div class="col-md-2">
																<?php echo get_avatar( get_the_author_meta('email', $author->ID), '120', '', '', array('class'=>'img-circle') ); ?>
															</div>
														<div class="col-md-10">
															<div class="name"><a href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) );?>"><?php echo esc_html($author->display_name);?></a> (<?php echo count_user_posts( $author->ID ); ?>) </div>
															<div class="intro"><?php echo get_the_author_meta('description', $author->ID);?></div>
														</div>
														<div class="col-lg-12">
															<ul class="s-author pull-right">
																<?php if( get_the_author_meta( 'facebook' , $author->ID ) != '' ) {?>
																	<li class="facebook">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'facebook' , $author->ID ));?>"><i class="fa fa-facebook"></i></a></div>
																	</li>
																<?php }?>
																<?php if( get_the_author_meta( 'twitter' , $author->ID ) != '' ) {?>
																	<li class="twitter">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'twitter' , $author->ID ));?>"><i class="fa fa-twitter"></i></a></div>
																	</li>
																<?php }?>
																<?php if( get_the_author_meta( 'googleplus' , $author->ID ) != '' ) {?>
																	<li class="google-plus">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'googleplus' , $author->ID ));?>"><i class="fa fa-google-plus"></i></a></div>
																	</li>
																<?php }?>

																<?php if( get_the_author_meta( 'instagram' , $author->ID ) != '' ) {?>
																	<li class="instagram">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'instagram' , $author->ID ));?>"><i class="fa fa-instagram"></i></a></div>
																	</li>                                                        <?php }?>
																<?php if( get_the_author_meta( 'linkedin' , $author->ID ) != '' ) {?>
																	<li class="linkedin">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' , $author->ID ));?>"><i class="fa fa-linkedin"></i></a></div>
																	</li>                                                        <?php }?>
																<?php if( get_the_author_meta( 'pinterest' , $author->ID ) != '' ) {?>
																	<li class="pinterest">
																		<div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'pinterest' , $author->ID ));?>"><i class="fa fa-pinterest"></i></a></div>
																	</li>
																<?php }?>
															</ul>
														</div>
													</div>
												</div>
												<hr>
											</div>
											<!-- About Author Ends -->
									<?php
									endforeach;
								endwhile;
							else:
								get_template_part( 'includes/templates/no-results' );
							endif;
							?>
						</div>
					</div>


				</div>
				<!-- /. LEFT COLUMN ENDS
					========================================================================= -->
				<?php if('without-sidebar' != $ht_layout):?>
					<!-- RIGHT COLUMN STARTS
						========================================================================= -->
					<div class="<?php echo esc_attr($ht_grid_4_class);?>">
						<?php  get_sidebar('primary'); ?>
					</div>
					<!-- /. RIGHT COLUMN ENDS
						========================================================================= -->
				<?php endif;?>
			</div>
		</div>

	</div>
	<!-- /. PAGE CONTENTS ENDS
		========================================================================= -->
<?php  get_footer();?>