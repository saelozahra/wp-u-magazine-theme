<?php

get_header();

// get sidebar layout
$ht_layout        = get_post_meta( get_the_ID(), '_ht_layout', true );
$ht_page_title    = get_post_meta( get_the_ID(), '_ht_page_title', true);
$ht_page_comments = get_post_meta( get_the_ID(), '_ht_page_comments', true);

if( 'inherit' == $ht_layout ) {
    $ht_layout = ot_get_option( 'layout-global' );
}
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
                <div class="<?php echo esc_attr($ht_grid_8_class);?>">
                        <?php if( 'on' == $ht_page_title || empty($ht_page_title) ):?>
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
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( ( comments_open() || get_comments_number() ) && $ht_page_comments == 'on' ) :
                                        comments_template();
                                    endif;
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