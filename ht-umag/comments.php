<?php
/**
 * @package WordPress
 */
// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Please do not load this page directly. Thanks!','highthemes'));

    if ( post_password_required() ) { ?>
        <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','highthemes');?></p>
    <?php
        return;
    }
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<!-- .comments -->
<div class="comments">
    <div class="row category-caption">
        <div class="col-lg-12">
            <h2 class="pull-left"><?php comments_number(__('No Comments','highthemes'), __('One Comment','highthemes'), '% '.__('Comments','highthemes') );?></h2>
        </div>
    </div>

    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link(__(' < Older Comments','highthemes')) ?></div>
        <div class="alignright"><?php next_comments_link(__(' < Newer Comments','highthemes')) ?></div>
    </div><!-- .navigation  -->

    <div class="row">
        <div class="col-lg-12">
            <ul class="media-list">
                <?php wp_list_comments(array('avatar_size' => 70, 'callback' => 'ht_custom_comment')); ?>
            </ul><!-- .media-list  -->
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.comments -->
    <?php else : // this is displayed if there are no comments so far ?>

        <?php if ( comments_open() ) : ?>
        <!-- If comments are open, but there are no comments. -->
        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->

    <?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
    <hr>
<div id="respond" class="leave-comment">
    <div class="row category-caption">
        <div class="col-lg-12">
            <h2 class="pull-left">
                <?php comment_form_title( __('Leave a comment','highthemes'), __('Leave a reply','highthemes')  ); ?>
            </h2>
            <span class="cancel-comment-reply">
                <small><?php cancel_comment_reply_link(__('| Cancel reply','highthemes')); ?></small>
            </span>
        </div>
    </div>
    <div class="row">
<form action="<?php echo esc_url(get_option('siteurl')); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
    <p class="col-lg-12">
        <?php _e('You must be','highthemes');?> 
        <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in','highthemes');?></a> <?php _e('to post a comment.','highthemes');?>
    </p>
    <br>
<?php else : ?>
    <?php if ( is_user_logged_in() ) : ?>
    <p class="col-lg-12">
        <?php _e('Logged in as','highthemes'); ?> <a href="<?php echo esc_url(get_option('siteurl') . '/wp-admin/profile.php') ?>"><?php echo esc_html($user_identity); ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','highthemes');?>"><?php _e('Log out','highthemes'); ?> &raquo;</a>
    </p>
    <?php endif; ?>   

<?php if ( is_user_logged_in() ) : ?>

<?php else : ?>

    <div class="col-lg-4 col-md-4">
        <input type="text" placeholder="<?php esc_attr_e('Name','highthemes') ?> <?php if ($req) echo "*"; ?>" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
    </div>
    <div class="col-lg-4 col-md-4">
        <input type="text" placeholder="<?php esc_attr_e('Mail','highthemes') ?> <?php if ($req) echo "*"; ?>" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />            
    </div>
    <div class="col-lg-4 col-md-4">
        <input type="text" placeholder="<?php esc_attr_e('Website','highthemes') ?>" name="url" id="url" value="<?php echo esc_url($comment_author_url); ?>" tabindex="3" />
    </div>

<?php endif; ?>
    <div class="col-lg-12 col-md-12">
        <textarea name="comment" rows="8" cols="40" placeholder="<?php esc_textarea('Your Message','highthemes') ?> <?php if ($req) echo "*"; ?>" required="" tabindex="4"></textarea>
    </div>
    <div class="comment-notes fll col-lg-12">
    <?php _e('Your email address will not be published. Required fields are marked. <span class="required">*</span>','highthemes'); ?> 
    </div>
    <div class="col-lg-12">
        <input name="submit" type="submit" class="send-message button" value="<?php esc_attr_e('Submit','highthemes');?>" tabindex="5">
    </div>    
    
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>
</div><!-- /.row-->
<?php endif; // If registration required and not logged in ?>
</div><!-- #respond  -->

<?php endif; // if you delete this the sky will fall on your head ?>