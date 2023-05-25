<?php
/**
 * The template for displaying posts from categories, tags, etc
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


?>
    <!-- PAGE CONTENTS STARTS
           ========================================================================= -->
    <div class="page-contents <?php echo esc_attr($ht_page_content_class);?>">
        <div class="container">
            <div class="row">
                <!-- LEFT COLUMN STARTS
                    ========================================================================= -->
                <div class="<?php echo esc_attr($ht_grid_8_class);?>">
                    <div class="row category-caption">
                        <div class="col-lg-12">
                            <h2 class="pull-left">
                                <?php
                                if ( is_page() || is_single() ) the_title();
                                else if ( is_category() ) _e("Category : ",'highthemes'). single_cat_title('', true);
                                else if ( is_tag() ) _e("Tag : ",'highthemes').single_tag_title('', true);
                                else if ( is_year() ) echo get_the_date( _x( 'Y', 'yearly archives date format', 'highthemes' ) );
                                else if ( is_month() )  echo get_the_date( _x( 'F Y', 'monthly archives date format', 'highthemes' ) );
                                else if ( is_day() )  echo get_the_date();
                                else if ( is_author() ) echo get_the_author();
                                else if ( is_search() ) printf( __('Search results for','highthemes') . " %s", '"' . get_search_query() . '"' );
                                ?>
                            </h2>
                        </div>
                    </div>
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