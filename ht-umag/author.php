<?php
/**
 * The template for displaying posts from a specific author
 *
 * @package WordPress
 * @subpackage UMag
 */
get_header();

// get sidebar layout
$ht_layout     = ot_get_option( 'layout-global' );

// grid classes
include( locate_template('includes/layout-classes.php') );

// get category post layout
$ht_post_layout      =  ot_get_option('archive_post_layout')  ? ot_get_option( 'archive_post_layout' ) : '2c' ;
$ht_post_layout_cols = substr( $ht_post_layout, 0, 1 );

// Get current user info
global $wp_query;
$curauth = $wp_query->get_queried_object();

?>
    <!-- PAGE CONTENTS STARTS
           ========================================================================= -->
    <div class="page-contents <?php echo esc_attr($ht_page_content_class);?>">
        <div class="container">
            <div class="row">
                <!-- LEFT COLUMN STARTS
                    ========================================================================= -->
                <div class="<?php echo esc_attr($ht_grid_8_class);?>">
                    <!-- .about-author -->
                        <div class="about-author">
                            <div class="row category-caption">
                                <div class="col-lg-12">
                                    <h2 class="pull-left"><?php _e('ABOUT AUTHOR', 'highthemes');?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <?php echo get_avatar( get_the_author_meta('email', $curauth->ID), '120', '', '', array('class'=>'img-circle') ); ?>
                                </div>
                                <div class="col-md-10">
                                    <div class="name"><?php the_author_meta('display_name', $curauth->ID); ?></div>
                                    <div class="intro">
                                        <?php
                                        if(get_the_author_meta('description', $curauth->ID) == '') {
                                            echo __('The author didn\'t add any Information to his profile yet. ', 'highthemes');
                                        } else {
                                            the_author_meta('description', $curauth->ID);
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-12">
                                    <ul class="s-author pull-right">
                                        <?php if( get_the_author_meta( 'facebook', $curauth->ID ) != '' ) {?>
                                            <li class="facebook">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'facebook', $curauth->ID ));?>"><i class="fa fa-facebook"></i></a></div>
                                            </li>
                                        <?php }?>
                                        <?php if( get_the_author_meta( 'twitter', $curauth->ID ) != '' ) {?>
                                            <li class="twitter">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'twitter', $curauth->ID ));?>"><i class="fa fa-twitter"></i></a></div>
                                            </li>
                                        <?php }?>
                                        <?php if( get_the_author_meta( 'googleplus', $curauth->ID ) != '' ) {?>
                                            <li class="google-plus">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'googleplus', $curauth->ID ));?>"><i class="fa fa-google-plus"></i></a></div>
                                            </li>
                                        <?php }?>

                                        <?php if( get_the_author_meta( 'instagram', $curauth->ID ) != '' ) {?>
                                            <li class="instagram">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'instagram', $curauth->ID ));?>"><i class="fa fa-instagram"></i></a></div>
                                            </li>                                                        <?php }?>
                                        <?php if( get_the_author_meta( 'linkedin', $curauth->ID ) != '' ) {?>
                                            <li class="linkedin">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'linkedin', $curauth->ID ));?>"><i class="fa fa-linkedin"></i></a></div>
                                            </li>                                                        <?php }?>
                                        <?php if( get_the_author_meta( 'pinterest', $curauth->ID ) != '' ) {?>
                                            <li class="pinterest">
                                                <div class="icon"><a href="<?php echo esc_url(get_the_author_meta( 'pinterest', $curauth->ID ));?>"><i class="fa fa-pinterest"></i></a></div>
                                            </li>
                                        <?php }?>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    <!-- /.about-author -->
                    <div class="row posts clearfix">
                        <?php
                        if ( have_posts() ) :
                            $z = 1;
                            while ( have_posts() ): the_post();
                                include(locate_template('includes/templates/content.php'));
                                if($z % $ht_post_layout_cols == 0) echo '<div style="clear:both"></div>';
                                $z++;
                            endwhile;


                        else:
                            get_template_part( 'includes/templates/no-results' );
                        endif;
                        ?>
                    </div><!-- end posts -->
                    <?php get_template_part('includes/pagination');?>

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