<?php

get_header();

// get sidebar layout
$ht_layout     = ot_get_option( 'layout-global' );

// grid classes
include( locate_template('includes/layout-classes.php') );
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