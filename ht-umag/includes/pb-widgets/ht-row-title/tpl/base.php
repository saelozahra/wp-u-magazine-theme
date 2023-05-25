<?php if ( ! empty($instance['categories'])) {
    $instance['title']     = get_cat_name($instance['categories']);
    $instance['title_url'] = get_category_link($instance['categories']);
}
?>
<div>
    <div class="category-caption">
        <div class="clearfix">
            <h2 class="pull-left"><?php echo esc_html($instance['title']); ?></h2>
            <?php if ( ! empty($instance['title_url'])): ?>
                <a href="<?php echo esc_url($instance['title_url']); ?>"><span class="pull-right">
                        <i class="fa fa-plus"></i></span></a>
            <?php endif; ?>
        </div>
    </div>
</div>
