<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage UMag
 */

get_header();

// get sidebar layout
$ht_layout     = get_post_meta( get_the_ID(), '_ht_layout', true );

if( 'inherit' == $ht_layout ) {
    $ht_layout = ot_get_option( 'layout-global' );
}
// grid classes
include( locate_template('includes/layout-classes.php') );
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
                    <!-- .category-caption -->
                    <div class="row category-caption">
                        <div class="col-lg-12">
                            <?php
                            $the_categories = get_the_category();
                            $i = 0;
                            foreach($the_categories as $category) {
                                $class = ($i % 2 == 0) ? 'main-caption' : 'sub-cat' ;
                                echo '<h2 class="pull-left '.$class.'"><a href="'.get_category_link($category->term_id).'">'.$category->name.'</a></h2>';
                                $i++;
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /.category-caption -->
                    <div class="row">
                        <?php
                        while ( have_posts() ) : the_post();

                            // thumbnail size
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post_thumbnail' );
                            if ( $ht_layout == 'without-sidebar' ) {
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                            }

                            // gallery images
                            $post_gallery_list = get_post_meta( get_the_ID(), 'post-gallery', true );

                            // create the gallery images
                            if ( $post_gallery_list != '' ) {
                                $post_gallery_item = explode( ",", $post_gallery_list );
                                $gallery_thumb     = array();
                                foreach ( $post_gallery_item as $key => $value ) {
                                    if ( $ht_layout == 'without-sidebar' ) {
                                        $gallery_thumb[ $key ] = wp_get_attachment_image_src( $value, 'large' );
                                    } else {
                                        $gallery_thumb[ $key ] = wp_get_attachment_image_src( $value, 'post_thumbnail' );
                                    }
                                }
                            }

                        $the_category = get_the_category();
                        $post_format  = get_post_format();

                        $audio_code        = get_post_meta( get_the_ID(), '_audio_code', true );
                        $video_code        = get_post_meta( get_the_ID(), '_video_embed_code', true );
                        $post_gallery_list = get_post_meta( get_the_ID(), 'post-gallery', true );

                        ?>
                            <!-- POST ARTICLE START
                            ========================================================================= -->
                            <article class="col-lg-12 col-md-12">
                                <?php
                                if( $post_format == 'audio' ) {
                                    if ($audio_code != '') {
                                        echo '<div class="audio-container">' . $audio_code . '</div>';
                                    }
                                } elseif( $post_format == 'video' ) {
                                    if ($video_code != '') {
                                        echo '<div class="video-container fitvid">' . $video_code . '</div>';
                                    }
                                } elseif( $post_format == 'gallery' ) {
                                    if( $post_gallery_list != '' ) :
                                ?>
                                    <div class="gallery-carousel">
                                        <?php for ($i=0; $i < count($gallery_thumb) ; $i++) : ?>
                                        <div class="picture">
                                            <div class="category-image">
                                                <img src="<?php echo  $gallery_thumb[$i][0];?>" class="img-responsive" alt="<?php the_title_attribute();?>" >
                                            </div>
                                        </div>
                                        <?php endfor; ?>
                                    </div>
                                <?php
                                    endif;
                                } else {
                                    ?>
                                    <!-- .picture - post thumbnail -->
                                    <?php if (ot_get_option('single_featured') == 'on' && has_post_thumbnail()): ?>
                                        <div class="picture">
                                            <div class="category-image">
                                                <img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive">
                                                <h2 class="overlay-category"><?php echo esc_html($the_category[0]->name); ?></h2>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                }
                                ?>
                                <!-- /.picture -->

                                <!-- .detail - post meta -->
                                <div class="detail">
                                    <div class="info">
                                        <span class="date"><i class="fa fa-calendar-o"></i> <?php the_time('Y/m/d');?></span>
                                        <span class="comments pull-right"><i class="fa fa-comment-o"></i> <?php comments_number( 0,  1,  '%' );?></span>
                                        <span class="likes pull-right"><?php if( function_exists('zilla_likes') ) zilla_likes();?></span>
                                    </div>
                                    <h3 class="caption"><?php the_title();?></h3>
                                </div>
                                <!-- /.detail -->

                                <!-- .description - post content -->
                                <div class="description">
                                    <?php the_content();?>
                                    <?php wp_link_pages(array('before'=>'<div class="post-navi clearfix">'.__('<span class="mid">Pages</span>','highthemes'),'after'=>'</div>','link_after'=>'</b>','link_before'=>'<b>')); ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- /.description -->
                                <!-- .via - post author & tags -->
                                <hr>
                                <div>
                                    <ul class="via">
                                        <li><?php _e('VIA', 'highthemes');?></li>
                                        <li><?php the_author_posts_link();?></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <?php the_tags('<ul class="via"><li>'.__('TAGS', 'highthemes').'</li><li>', '</li><li>', '</li></ul>');?>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- /.via - post author & tags -->

                                <!-- .sharepost - share button -->
                                <?php if ( ot_get_option( 'share_post' ) == 'on' ) get_template_part('includes/share-posts');?>
                                <!-- /.sharepost - share button -->

                                <!-- .next-n-prev  -->
                                <?php if( ot_get_option( 'next_prev_post' ) == 'on' ):?>
                                <hr>
                                <div class="row next-n-prev">
                                    <?php
                                    $prev_post = get_previous_post();
                                    if ( is_a( $prev_post , 'WP_Post' ) ) : ?>
                                    <article class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="detail">
                                            <div class="info">
                                                <span class="date"><i class="fa fa-calendar-o"></i> <?php echo get_the_time('Y/m/d', $prev_post->ID);?></span>
                                                <span class="comments pull-right"><i class="fa fa-comment-o"></i> <?php echo get_comments_number($prev_post->ID);?></span>
                                                <span class="likes pull-right"> <?php if( function_exists('zilla_likes') ) zilla_likes($prev_post->ID);?></span>
                                            </div>
                                            <h2 class="caption"><?php echo get_the_title( $prev_post->ID ); ?></h2>
                                            <div class="author">
                                                <div class="pic">
                                                    <?php echo get_avatar( get_the_author_meta('email'), '50', '', '', array('class'=>'img-circle') ); ?><span class="name"><?php $post_author_id = get_post_field( 'post_author', $prev_post->ID ); the_author_meta( 'user_nicename', $post_author_id );?></span>
                                                    <span class="read-article pull-right"><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php _e('MORE','highthemes');?> <i class="fa fa-angle-left"></i></a></span>
                                                </div>
                                            </div>
                                            <div class="btns"><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php _e('PREVIOUS ARTICLE', 'highthemes');?> <i class="fa fa-angle-double-left"></i></a></div>
                                        </div>
                                    </article>
                                    <?php
                                    endif;
                                    $next_post = get_next_post();
                                    if ( is_a( $next_post , 'WP_Post' ) ) { ?>
                                        <article class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="detail">
                                                <div class="info">
                                                    <span class="date"><i class="fa fa-calendar-o"></i> <?php echo get_the_time('Y/m/d', $next_post->ID);?></span>
                                                    <span class="comments pull-right"><i class="fa fa-comment-o"></i> <?php echo get_comments_number($next_post->ID);?></span>
                                                    <span class="likes pull-right"> <?php if( function_exists('zilla_likes') ) zilla_likes($next_post->ID);?></span>
                                                </div>
                                                <h2 class="caption"><?php echo get_the_title( $next_post->ID ); ?></h2>
                                                <div class="author">
                                                    <div class="pic">
                                                        <?php echo get_avatar( get_the_author_meta('email'), '50', '', '', array('class'=>'img-circle') ); ?> <span class="name"><?php $post_author_id = get_post_field( 'post_author', $next_post->ID ); the_author_meta( 'user_nicename', $post_author_id );?></span>
                                                        <span class="read-article pull-right"><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e('MORE','highthemes');?> <i class="fa fa-angle-left"></i></a></span>
                                                    </div>
                                                </div>
                                                <div class="btns"><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php _e('NEXT ARTICLE', 'highthemes');?> <i class="fa fa-angle-double-left"></i></a></div>
                                            </div>
                                        </article>
                                    <?php } ?>
                                </div>
                                <?php endif;?>
                                <!-- /.next-n-prev  -->

                                <!-- .about-author -->
                                <?php if( ot_get_option( 'author_box' ) == 'on' ):?>
                                <hr>
                                <div class="about-author">
                                    <div class="row category-caption">
                                        <div class="col-lg-6">
                                            <h2 class="pull-left"><?php _e('ABOUT AUTHOR', 'highthemes');?></h2>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul class="s-author pull-right">
                                                <?php if( get_the_author_meta( 'facebook' ) != '' ) {?>
                                                    <li class="facebook">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'facebook' ));?>"><i class="fa fa-facebook"></i></a></div>
                                                    </li>
                                                <?php }?>
                                                <?php if( get_the_author_meta( 'twitter' ) != '' ) {?>
                                                    <li class="twitter">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'twitter' ));?>"><i class="fa fa-twitter"></i></a></div>
                                                    </li>
                                                <?php }?>
                                                <?php if( get_the_author_meta( 'googleplus' ) != '' ) {?>
                                                    <li class="google-plus">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ));?>"><i class="fa fa-google-plus"></i></a></div>
                                                    </li>
                                                <?php }?>

                                                <?php if( get_the_author_meta( 'instagram' ) != '' ) {?>
                                                    <li class="instagram">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ));?>"><i class="fa fa-instagram"></i></a></div>
                                                    </li>                                                        <?php }?>
                                                <?php if( get_the_author_meta( 'linkedin' ) != '' ) {?>
                                                    <li class="linkedin">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ));?>"><i class="fa fa-linkedin"></i></a></div>
                                                    </li>                                                        <?php }?>
                                                <?php if( get_the_author_meta( 'pinterest' ) != '' ) {?>
                                                    <li class="pinterest">
                                                        <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ));?>"><i class="fa fa-pinterest"></i></a></div>
                                                    </li>
                                                <?php }?>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?php echo get_avatar( get_the_author_meta('email'), '120', '', '', array('class'=>'img-circle') ); ?>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="name"><?php the_author_meta('display_name'); ?></div>
                                            <div class="intro">
                                                <?php
                                                if(get_the_author_meta('description') == '') {
                                                    echo __('The author didn\'t add any Information to his profile yet. ', 'highthemes');
                                                } else {
                                                    the_author_meta('description');
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <!-- /.about-author -->

                                <!-- .related-articles -->
                                <?php if( ot_get_option( 'related_posts' ) != 'none' ) get_template_part('includes/related-posts');?>
                                <!-- /.related-articles -->

                            <?php

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile;
                        ?>
                            </article>
                        <!-- POST ARTICLE END
						 ========================================================================= -->
                    </div>
                    <!-- ./row -->
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