<div class="breaking-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-2">
                <h2 class="title"><?php _e('News', 'highthemes'); ?></h2>
            </div>
            <div class="col-lg-11 col-md-10">
                <div class="newsticker">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'cat'       => ot_get_option('header_news_category'),
                    );
                    $head_news = new WP_Query( $args );
                    if ( $head_news->have_posts() ) {
                        while ($head_news->have_posts()) : $head_news->the_post();
                            ?>
                            <div><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>