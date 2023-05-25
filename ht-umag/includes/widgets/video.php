<?php

/**
 * Highthemes Video
 */

class ht_video extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname'   => 'ht_video',
            'description' => __( 'Embed a Video', 'highthemes' ),
            'panels_groups' => array( 'highthemes' )

        );

        parent::__construct(
            'ht_video',
            'Highthemes - ' . __( 'Embed Video', 'highthemes' ),
            $widget_ops // Args
        );
    }

    // display the widget in the theme
    function widget( $args, $instance ) {
        extract( $args );

        $instance['title'] ? NULL : $instance['title'] = '';
        $title = apply_filters('widget_title',$instance['title']);
        
        $output = $before_widget."\n";
        if($title) {
            $output .= $before_title.$title.$after_title;
        } else {
            $output .= '<div class="widget clearfix">';
        }

        if ( ! empty($instance['video_url']) ) {
            global $wp_embed;
             $output .= '<div class="video-container">';
                $output .= $wp_embed->run_shortcode('[embed]'.$instance['video_url'].'[/embed]');
            $output .= '</div>';

        } elseif ( ! empty($instance['video_embed_code']) ) {
            $output .= '<div class="video-container">';
            $output .=  $instance['video_embed_code'];
            $output .= '</div>';
        } else {
            $output .='';
        }
        $output .= $after_widget."\n";
        echo $output;
    }
   public function update($new,$old) {
        $instance                     = $old;
        $instance['title']            = esc_attr($new['title']);
        $instance['video_url']        = esc_url($new['video_url']);
        $instance['video_embed_code'] = $new['video_embed_code'];

        return $instance;
    }

    public function form($instance) {
        $defaults = array(
            'title'             => __('Video Widget', 'highthemes'),
            'video_url'         => '',
            'video_embed_code'  => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
?>
    <div class="ht-options-video">
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'highthemes'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id("video_url")); ?>"><?php _e('Video URL', 'highthemes'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id("video_url")); ?>" name="<?php echo esc_attr($this->get_field_name("video_url")); ?>" type="text" value="<?php echo esc_url($instance["video_url"]); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id("video_embed_code")); ?>"><?php _e('Video Embed Code', 'highthemes'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('video_embed_code')); ?>" name="<?php echo esc_attr($this->get_field_name('video_embed_code')); ?>"><?php echo esc_textarea($instance["video_embed_code"]); ?></textarea>
        </p>
    </div>
    <?php
    }
}