<?php
/**
 * After setup theme actions
 */
add_action( 'after_setup_theme', 'ht_theme_setup' );
function ht_theme_setup() {
    global $content_width;

    /* Set the $content_width for things such as video embeds. */
    if ( !isset( $content_width ) )
        $content_width = 1170;

    /* Add theme support for automatic feed links. */
    add_theme_support( 'automatic-feed-links' );

    /* Add theme support for post thumbnails (featured images). */
    add_theme_support('post-thumbnails', array('post', 'page'));

    /* Add nav menus  */
    add_action( 'init', 'ht_register_menus' );

    /* Add sidebars */
    add_action( 'widgets_init', 'ht_register_sidebars' );

    /* Load JavaScript files  */
    add_action( 'wp_enqueue_scripts', 'ht_scripts_styles' );

    /* Register Post formats */
    add_theme_support('post-formats', array('video','audio','gallery'));

    /* Add excerpt to page */
    add_post_type_support( 'page', 'excerpt' );

    /*
     * change the default.po file with poedit to create .mo file
     * The .mo file must be named based on the locale exactly.
     */
    load_theme_textdomain('highthemes', get_template_directory() .'/languages');
    locate_template( 'styles/custom-css.php', true);

    /**
     * Menu Walker Class
     */
    if ( ot_get_option('new_walker') != 'off' ) {

        class description_walker extends Walker_Nav_Menu {

              function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {

                    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

                    $value = '';

                    // get classes
                    $class_names = '';
                    $classes = empty( $object->classes ) ? array() : (array) $object->classes;
                    $class_names = join( ' ', $classes );
                    $class_names = ' class="'. esc_attr( $class_names ) . '"';

                    $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
                    $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
                    $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';

                    $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';
                    $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) .'"' : '';              

                    $main_title  = apply_filters( 'the_title', $object->title, $object->ID );

                    $object_output = $args->before;
                    $object_output .= '<a'. $attributes .'>';
                    $object_output .= $args->link_before . $main_title;
                    $object_output .= $args->link_after;                
                    $object_output .= '</a>';
                    $object_output .= $args->after;

                    $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );  

              }

                function end_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

                    global $wp_query;
                    global $post, $post_id;

                    if ( $depth == 0 && $object->object == 'category' ) {

                        // get classes
                        $class_names = '';
                        $classes = empty( $object->classes ) ? array() : (array) $object->classes;
                        $class_names = join( ' ', $classes );
                        $class_names = ' class="'. esc_attr( $class_names ) . '"';
                        $get_classes = join(',', $object->classes);

                        // get column
                        $get_start_classes = strstr($get_classes, 'col-');
                        $start_classes_pos = strpos($get_start_classes, ',');
                        $col_class   = substr($get_start_classes, 0, $start_classes_pos);

                        $cat = $object->object_id;
                        ob_start();

                        switch( $col_class ) {
                            case 'col-4':
                                $post_num = 4;
                                break;

                            case 'col-5':
                                $post_num = 5;
                                break;

                            case 'col-6':
                                $post_num = 6;
                                break;

                            default:
                                $post_num = 3;
                                break;
                        }

                        echo '<ul class="cat-mega">';
                            //$post_args = array( 'numberposts' => $post_num, 'offset'=> 0, 'category' => $cat );
                            //$menuposts = get_posts( $post_args );

                            $menu_posts_query = new WP_Query( array( 'posts_per_page' => $post_num, 'cat' => $cat ) );
                            if ( $menu_posts_query->have_posts() ) :
                                while ( $menu_posts_query->have_posts() ) :  $menu_posts_query->the_post();

                                    $post_format  = get_post_format();
                                    $post_format_icon = '';

                                    if( $post_format == 'video' ) {
                                        $post_format_icon = '<div class="play-icon"><i class="fa fa-film"></i></div>';
                                    } elseif( $post_format == 'audio' ) {
                                        $post_format_icon = '<div class="play-icon"><i class="fa fa-music"></i></div>';
                                    } elseif( $post_format == 'gallery' ) {
                                        $post_format_icon = '<div class="play-icon"><i class="fa fa-picture-o"></i></div>';
                                    } else { /* standard */ }
                                    echo '
                                    <li class="col">
                                        <div class="picture">
                                            <div class="category-image">
                                                ' . get_the_post_thumbnail($post_id, 'post_thumbnail') . '
                                                <h2 class="overlay-category">' . get_cat_name($cat) . '</h2>
                                                '. $post_format_icon .'
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <div class="caption"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>
                                        </div>
                                    </li>
                                    ';
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        echo '</ul>';
                        $output .= ob_get_clean();
                    }

                }      
        }
    } else {
            class description_walker extends Walker_Nav_Menu {}
    }

}

/**
 * Defining images sizes
 */
set_post_thumbnail_size( 280, 250, true);
add_image_size('small_thumbnail', 75, 75, true);
add_image_size('small_thumbnail_b', 50, 50, true);
add_image_size('large', 1140, 570, true);
add_image_size('post_thumbnail', 800, 550, true);
add_image_size('post_thumbnail_b', 720, 800, true);


/**
 * Import Export
 */
add_action( 'init', 'ht_register_options_pages' );
function ht_register_options_pages() {

   if ( is_admin() && function_exists( 'ot_register_settings' ) ) {
    ot_register_settings( 
      array(
        array( 
          'id'              => 'import_export',
          'pages'           => array(
            array(
              'id'              => 'import_export',
              'parent_slug'     => 'themes.php',
              'page_title'      => 'Theme Options Backup/Restore',
              'menu_title'      => 'Options Backup',
              'capability'      => 'edit_theme_options',
              'menu_slug'       => 'tmq-theme-backup',
              'icon_url'        => null,
              'position'        => null,
              'updated_message' => 'Options updated.',
              'reset_message'   => 'Options reset.',
              'button_text'     => 'Save Changes',
              'show_buttons'    => false,
              'screen_icon'     => 'themes',
              'contextual_help' => null,
              'sections'        => array(
                array(
                  'id'          => 'tmq_import_export',
                  'title'       => __( 'Import/Export', 'yourtextdomain' )
                )
              ),
              'settings'        => array(
                array(
                    'id'          => 'import_data_text',
                    'label'       => 'Import Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'import-data',
                    'section'     => 'tmq_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
                  array(
                    'id'          => 'export_data_text',
                    'label'       => 'Export Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'export-data',
                    'section'     => 'tmq_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  )
              )
            )
          )
        )
      )
    );
  }
}

/**
 * Import Data
 */
if ( ! function_exists( 'ht_ot_type_import_data' ) ) {
    function ht_ot_type_import_data() {
        echo '<form method="post" id="import-data-form">';
        wp_nonce_field( 'import_data_form', 'import_data_nonce' );
        echo '<div class="format-setting type-textarea has-desc">';
        echo '<div class="description">';

        if ( OT_SHOW_SETTINGS_IMPORT ) 
            echo '<p>' . __( 'Only after you\'ve imported the Settings should you try and update your Theme Options.', 'highthemes' ) . '</p>';
            echo '<p>' . __( 'To import your Theme Options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Theme Options" button.', 'highthemes' ) . '</p>';
            echo '<button class="option-tree-ui-button blue right hug-right">' . __( 'Import Theme Options', 'highthemes' ) . '</button>';
            echo '</div>';
            echo '<div class="format-setting-inner">';
            echo '<textarea rows="10" cols="40" name="import_data" id="import_data" class="textarea"></textarea>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
    }
}

/**
 * Export Export
 */
if ( ! function_exists( 'ht_ot_type_export_data' ) ) {
    function ht_ot_type_export_data() {
        echo '<div class="format-setting type-textarea simple has-desc">';
        echo '<div class="description">';
        echo '<p>' . __( 'Export your Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Theme Options</strong> textarea on another web site.', 'highthemes' ) . '</p>';
        echo '</div>';

        $data = get_option( 'option_tree' );
        $data = ! empty( $data ) ? ot_encode( serialize( $data ) ) : '';

        echo '<div class="format-setting-inner">';
        echo '<textarea rows="10" cols="40" name="export_data" id="export_data" class="textarea">' . esc_textarea($data) . '</textarea>';
        echo '</div>';
        echo '</div>';
    }
}

if ( !is_admin() ) {
    function ht_search_filter($query) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
    add_filter('pre_get_posts','ht_search_filter');
}

/**
 * Show Recent Comments
 *
 * @param string/integer $no_comments
 * @param string/integer $comment_len
 * @param string/integer $avatar_size
 *
 * @echo string $comm
 */
function ht_recent_comments($no_comments = 5, $avatar_status =1, $comment_len = 80, $avatar_size = 75) {
    $comments_query = new WP_Comment_Query();
    $comments = $comments_query->query( array( 'number' => $no_comments ) );
    $comm = '';
    if ( $comments ) :
        foreach ( $comments as $comment ) :
            $comm .= '<li>';
            if( $avatar_status == 1 ) {
                $comm .= '<div class="pic">' . get_avatar($comment->comment_author_email, $avatar_size) . '</div>';
            }
            $comm .= '<div class="info">';
            $comm .= '<a class="author" href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">'. get_comment_author( $comment->comment_ID ) .'</a>';
            $comm .= '<div class="caption">' . strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, $comment_len ) ) . '...';
            $comm .= '</div></div></li>';

        endforeach;
    else :
        $comm .= '<li>'. __('No comments.', 'highthemes') .'</li>';
    endif;
    return $comm;
}


/**
 * Get sidebar layout mode
 * @return string 
 */
function ht_get_sidebar_mode() {
    global $post;
    $layout        = get_post_meta( get_the_ID(), '_ht_layout', true );
    $layout_global = ot_get_option( 'layout-global' );
    $layout_mode   = '';

    if( 'inherit' == $layout ){
        $layout = $layout_global;
    }

    if( $layout == 'both-sidebar-right' || $layout == 'both-sidebar-left' || $layout == 'both-sidebar' ) {
        $layout_mode = '2';
    } elseif ( $layout == 'sidebar-left' || $layout == 'sidebar-right' ) {
        $layout_mode = '1';
    } else {
        $layout_mode = 'large';
    }

    return $layout_mode;    
}
/**
 * Customize theme option typography fields     
 * @param  $array    list of properties
 * @param  $field_id 
 * @return array new property list
 */
function ht_filter_typography_1( $array, $field_id ) {
   if ( $field_id == "font_body" ) {
      $array = array( 'font-family', 'font-size', 'font-weight', 'line-height');
   }
   return $array;
}
add_filter( 'ot_recognized_typography_fields', 'ht_filter_typography_1', 10, 2 );

/**
 * Customize theme option typography fields     
 * @param  $array    list of properties
 * @param  $field_id 
 * @return array new property list
 */
function ht_filter_typography_2( $array, $field_id ) {
   if ( $field_id == "font_nav" ||  $field_id == "font_name_headlines" ) {
      $array = array( 'font-family');
   }
   return $array;
}
add_filter( 'ot_recognized_typography_fields', 'ht_filter_typography_2', 10, 2 );

/**
 * Register the main navigation menus
 * @return void
 */
function ht_register_menus() {
    register_nav_menu( 'main-nav', __('Main Navigation of '.THEME_NAME,'highthemes') );
    register_nav_menu( 'second-nav', __('Second Navigation of '.THEME_NAME,'highthemes') );
}

/**
 * Register the sidebars
 * @return void
 */
function ht_register_sidebars() {
    register_sidebars(1,array('name' => __('Default Sidebar','highthemes'), 'description'=>__('Used in blog, pages, etc. If you don\'n assign a custom sidebar to a page, this will be used. ', 'highthemes'), 'id'=>'primary', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title">','after_title' => '</h3>'));
    
    // first footer row
    register_sidebars(1,array('name' => __('1st Footer 1','highthemes'), 'description'=>__('Footer Widget Block 1', 'highthemes'), 'id'=>'footer-1', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('1st Footer 2','highthemes'), 'description'=>__('Footer Widget Block 2', 'highthemes'), 'id'=>'footer-2', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('1st Footer 3','highthemes'), 'description'=>__('Footer Widget Block 3', 'highthemes'), 'id'=>'footer-3', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('1st Footer 4','highthemes'), 'description'=>__('Footer Widget Block 4', 'highthemes'), 'id'=>'footer-4', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));

    // second footer row
    register_sidebars(1,array('name' => __('2nd Footer 1','highthemes'), 'description'=>__('2nd Footer Widget Block 1', 'highthemes'), 'id'=>'2nd-footer-1', 'before_widget' =>
        '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('2nd Footer 2','highthemes'), 'description'=>__('2nd Footer Widget Block 2', 'highthemes'), 'id'=>'2nd-footer-2', 'before_widget' =>
        '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('2nd Footer 3','highthemes'), 'description'=>__('2nd Footer Widget Block 3', 'highthemes'), 'id'=>'2nd-footer-3', 'before_widget' =>
        '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    register_sidebars(1,array('name' => __('2nd Footer 4','highthemes'), 'description'=>__('2nd Footer Widget Block 4', 'highthemes'), 'id'=>'2nd-footer-4', 'before_widget' =>
        '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
}

/**
 * Setup feedburner or any custom rss service
 */
function ht_custom_rss_feed( $output, $feed ) {
    if ( strpos( $output, 'comments' ) ) {
        return $output;
    }
    if( ot_get_option('rss_id') == '' ) {
        return $output;
    }
    if(  ot_get_option('rss_id') != '' ) {
        return esc_url( ot_get_option('rss_id') );
    } 

}
add_action( 'feed_link', 'ht_custom_rss_feed', 10, 2 );

/**
 * Needed scripts & styles
 */
function ht_scripts_styles() {
     global $wp_styles;

    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );    
    }

    // Needed scripts
    wp_enqueue_script( 'bootstrap-min', HT_THEME_JS_URL .'bootstrap.min.js', array('jquery') , '', true);
    wp_enqueue_script( 'sticky', HT_THEME_JS_URL .'jquery.sticky.js', array('jquery') , '', true);
    wp_enqueue_script( 'owl.carousel.min', HT_THEME_JS_URL .'owl.carousel.min.js', array('jquery') , '', true);
    wp_enqueue_script( 'fitvids', HT_THEME_JS_URL .'jquery.fitvids.js', array('jquery') , '', true);
    wp_enqueue_script( 'custom-js', HT_THEME_JS_URL .'custom.js', array('jquery') , '', true);



    // Needed Styles
    wp_enqueue_style( 'bootstrap', HT_THEME_STYLES_URL .'bootstrap.min.css' );
    wp_enqueue_style( 'owl-carousel', HT_THEME_STYLES_URL .'owl.carousel.css' );
    wp_enqueue_style( 'owl-theme', HT_THEME_STYLES_URL .'owl.theme.css' );
    wp_enqueue_style( 'owl-transitions', HT_THEME_STYLES_URL .'owl.transitions.css' );


    // Needed css files
    wp_enqueue_style( 'font-awesome.min', HT_THEME_STYLES_URL.'font-awesome.min.css' );

    // Main css
    wp_enqueue_style( 'ht-style', get_stylesheet_uri() );


    if( ot_get_option('dark') == 'on' ) {
        wp_enqueue_style( 'dark', get_stylesheet_directory_uri()  . '/styles/dark.css' );
    }

}

/**
 * Register Custom Sidebars
 */
if ( ! function_exists( 'ht_custom_sidebars' ) ) {

    function ht_custom_sidebars() {
        if ( ot_get_option('sidebar-areas') != '' ) {
            $sidebars = ot_get_option('sidebar-areas', array());
            $before_widget =  '<div id="%1$s" class="%2$s widget">';
            $after_widget  =  '</div><!-- .widget /-->';
            $before_title  =  '<h3 class="widget-title">';
            $after_title   =  '</h3>';
            
            if ( !empty( $sidebars ) ) {
                foreach( $sidebars as $sidebar ) {
                    if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
                        register_sidebar(array('name' => ''.$sidebar['title'].'','id' => ''.strtolower($sidebar['id']).'','before_widget' => $before_widget,'after_widget' => $after_widget,'before_title' => $before_title,'after_title' => $after_title));
                    }
                }
            }
        }
    }
    
}
add_action( 'widgets_init', 'ht_custom_sidebars' );

/**
 * Retrive Primary Sidebar
 */
if ( ! function_exists( 'ht_sidebar_primary' ) ) {
    
    function ht_sidebar_primary() {
        // Default sidebar
        $s_p = 'primary';

        // Check for page/post specific sidebar
        if ( is_page() || is_single() ) {
            // Reset post data
            wp_reset_postdata();
            global $post;
            // Get meta
            $metapp = get_post_meta($post->ID,'_ht_sidebar_primary',true);
            if ( $metapp ) { $s_p = $metapp; }
        }

        // Return sidebar
        return $s_p;
    }
    
}



/**
 * Set colors for cateogries
 */
function ht_category_color($cat_id) {
    $category_color = array();
    $ccategory_list = ot_get_option('ccategory_list');

    for ( $i = 0; $i < count($ccategory_list) ; $i++ ) { 
        $ccategory_cat   = !empty($ccategory_list[$i]['ccategory_cat']) ? $ccategory_list[$i]['ccategory_cat'] : '';
        $ccategory_color = !empty($ccategory_list[$i]['ccategory_color']) ? $ccategory_list[$i]['ccategory_color'] : '';
        $category_color[$ccategory_cat] = $ccategory_color;
    }            

    return !empty($category_color[$cat_id]) ? $category_color[$cat_id] : '';
}

/**
 * Social media fields for users' profile
 */
function ht_show_extra_profile_fields( $contact_method ) {
    $contact_method['facebook']   = 'FaceBook URL';
    $contact_method['twitter']    = 'Twitter URL';
    $contact_method['instagram']  = 'Instagram URL';
    $contact_method['linkedin']   = 'Linkedin URL';
    $contact_method['pinterest']  = 'Pinterest URL';
    $contact_method['googleplus'] = 'Google Plus URL';

    return $contact_method;     
}

add_filter('user_contactmethods','ht_show_extra_profile_fields',10,1);
add_action( 'personal_options_update', 'ht_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ht_save_extra_profile_fields' );

/**
 * Save profile new fields
 */
function ht_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) return false;
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
    update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
}
add_filter('user_contactmethods','ht_hide_profile_fields',10,1);

/**
 * Hide a few fields from profile page
 */
function ht_hide_profile_fields( $contact_method ) {
    unset($contact_method['aim']);
    unset($contact_method['jabber']);
    unset($contact_method['yim']);

    return $contact_method;
}

/**
 * Related Posts
 */
if ( ! function_exists( 'ht_related_posts' ) ) {

    function ht_related_posts() {
        wp_reset_postdata();
        global $post;

        // Define shared post arguments
        $args = array(
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts'    => 1,
            'orderby'                => 'rand',
            'post__not_in'           => array($post->ID),
            'posts_per_page'         => ot_get_option('related_posts_num')
        );
        // Related by categories
        if ( ot_get_option('related-posts') == 'categories' ) {
            
            $cats = get_post_meta($post->ID, 'related-cat', true);
            
            if ( !$cats ) {
                $cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
                $args['category__in'] = $cats;
            } else {
                $args['cat'] = $cats;
            }
        }
        // Related by tags
        if ( ot_get_option('related-posts') == 'tags' ) {
        
            $tags = get_post_meta($post->ID, 'related-tag', true);
            
            if ( !$tags ) {
                $tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
                $args['tag__in'] = $tags;
            } else {
                $args['tag_slug__in'] = explode(',', $tags);
            }
            if ( !$tags ) { $break = true; }
        }
        
        $query = !isset($break)?new WP_Query($args):new WP_Query;
        return $query;
    }
    
}

/**
 * Comments template. this function used to make a custom template for comments
 */
if( ! function_exists('ht_custom_comment') ){
    function ht_custom_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
<li <?php comment_class('clearfix media'); ?> id="comment-<?php comment_ID() ?>">
    <div class="media-left">
        <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'], '', '', array('class'=>'img-circle') ); ?>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?php ($comment->comment_author_url == 'http://Website' || $comment->comment_author_url == '') ? comment_author() : comment_author_link(); ?></h4>
        <span class="date"><i class="fa fa-calendar-o"></i> <?php comment_date('d. M, Y'); ?></span>
        <?php
        if($comment->comment_approved == '0'){
            echo '<strong><em>'.__('Your comment is awaiting moderation.', 'highthemes').'</em></strong>';
        }
        ?>
        <div><?php comment_text() ?></div>
        <div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
    </div>
<?php
    }

}

/**
 * Comment form template
 */
if( ! function_exists('ht_comment_form') ){
    function ht_comment_form($form_options) {
        global $user_identity, $post_id;
        if(!isset($commenter['comment_author'])){$commenter['comment_author'] = 'Name';}
        if(!isset($commenter['comment_author_email'])){$commenter['comment_author_email'] = 'Email';}
        if(!isset($commenter['comment_author_url'])){$commenter['comment_author_url'] = 'Website';}
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        // Fields Array
        $fields = array(

            'author' =>
            '<div class="span3">' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="fullname" class="txt" name="author" type="text"  size="30"' . $aria_req . '  />' .
            '</div>',

            'email' =>
            '<div class="span3">' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input  id="email" name="email" class="txt" type="text"  size="30"' . $aria_req . ' />' .
                '</div>',

            'url' =>
            '<div class="span3">'  .
                '<input name="url" class="txt" size="30" id="url" type="text"  />' .
                '</div>',

        );

        // Form Options Array
        $form_options = array(
            // Include Fields Array
            'fields' => apply_filters( 'comment_form_default_fields', $fields ),

            // Template Options
            'comment_field' =>

            '<div class="form-data"><p>' .
                '<label for="form_message">'. __('Comment','highthemes').'</label><textarea  name="comment" id="form_message" aria-required="true" rows="8" cols="45" ></textarea>' .
                '</p></div>',

            'must_log_in' =>
            '<p class="must-log-in">' .
                sprintf( __( 'You must be', 'highthemes') .' <a href="%s">'.__('logged in','highthemes') . '</a> '.__('to post a comment.', 'highthemes' ),
                    wp_login_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ) ) .
                '</p>',

            'logged_in_as' =>
            '<p class="logged-in-as">' .
                sprintf( __( 'Logged in as', 'highthemes') .' <a href="%1$s">%2$s</a>. <a href="%3$s" title="' . __('Log out of this account', 'highthemes') .'">'.__('Log out?', 'highthemes') . '</a>',
                    admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink($post_id)) ) ) .
                '</p>',

            'comment_notes_before' =>
            '',

            'comment_notes_after' => '',

            // Rest of Options
            'id_form' => 'form-comment',
            'id_submit' => 'submit',
            'title_reply' => __( 'Leave a Reply', 'highthemes' ),
            'title_reply_to' => __( 'Leave a Reply to', 'highthemes' ) .' %s',
            'cancel_reply_link' => __( '<span>Cancel reply</span>', 'highthemes' ),
            'label_submit' => __( 'Post Comment' , 'highthemes'),
        );

        return $form_options;
    }
}
add_filter('comment_form_defaults', 'ht_comment_form');

/**
 * Author bio box
 */
if( ! function_exists('ht_author_bio') ){
    function ht_author_bio() { 
        global $post;?>
            <div class="author_post mbf clearfix">
                <div class="title"><h4><?php the_author_meta('display_name'); ?></h4></div>
                <div class="author_co clearfix">
                    <?php echo get_avatar( get_the_author_meta('email'), '80' ); ?>
                    <p>
                    <?php 
                    if(get_the_author_meta('description') == '') {
                        echo __('The author didn\'t add any Information to his profile yet. ', 'highthemes');
                    } else {
                        the_author_meta('description');
                    } 
                    ?>
                    </p>
                    <div class="social">
                    <?php if( get_the_author_meta( 'facebook' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'facebook' ));?>" class="toptip" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <?php }?>
                    <?php if( get_the_author_meta( 'twitter' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'twitter' ));?>" class="toptip" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <?php }?>
                    <?php if( get_the_author_meta( 'googleplus' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'googleplus' ));?>" class="toptip" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                    <?php }?>    
                    <?php if( get_the_author_meta( 'dribbble' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'dribbble' ));?>" class="toptip" title="Dribbble"><i class="fa fa-dribbble"></i></a>
                    <?php }?>        
                    <?php if( get_the_author_meta( 'instagram' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'instagram' ));?>" class="toptip" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <?php }?>    
                    <?php if( get_the_author_meta( 'linkedin' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ));?>" class="toptip" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                    <?php }?>  
                    <?php if( get_the_author_meta( 'pinterest' ) != '' ) {?>
                        <a href="<?php echo esc_url(get_the_author_meta( 'pinterest' ));?>" class="toptip" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                    <?php }?>  

                    </div><!-- /social -->
                </div><!-- /author co -->
            </div><!-- /author -->  
        <?php
    }

}


/**
 * Social icons list
 */
if( !function_exists('ht_social_icons_list') ) {
    function ht_social_icons_list() {
               
        $target           = (ot_get_option('social_menu_target') == 1) ? '_blank' : '_self' ;
        $socails_arr      = array();        

        if( ot_get_option('twitter_id') )$socails_arr['twitter']        = 'fa-twitter';
        if( ot_get_option('facebook_id') ) $socails_arr['facebook']     = 'fa-facebook';
        if( ot_get_option('googleplus_id') ) $socails_arr['googleplus'] = 'fa-google-plus';
        if( ot_get_option('flickr_id') ) $socails_arr['flickr']         = 'fa-flickr';
        if( ot_get_option('rss_id') ) $socails_arr['rss']               = 'fa-rss';
        if( ot_get_option('linkedin_id') ) $socails_arr['linkedin']     = 'fa-linkedin';
        if( ot_get_option('dribbble_id') ) $socails_arr['dribbble']     = 'fa-dribbble';
        if( ot_get_option('github_id') ) $socails_arr['github']         = 'fa-github';
        if( ot_get_option('tumblr_id') ) $socails_arr['tumblr']         = 'fa-tumblr';
        if( ot_get_option('dropbox_id') ) $socails_arr['dropbox']       = 'fa-dropbox';
        if( ot_get_option('youtube_id') ) $socails_arr['youtube']       = 'fa-youtube';
        if( ot_get_option('instagram_id') ) $socails_arr['instagram']   = 'fa-instagram';
        if( ot_get_option('pinterest_id') ) $socails_arr['pinterest']   = 'fa-pinterest';
        if( ot_get_option('xing_id') ) $socails_arr['xing']             = 'fa-xing'; 
        if( ot_get_option('behance_id') ) $socails_arr['behance']       = 'fa-behance';
        if( ot_get_option('email_id') ) $socails_arr['email']           = 'fa-envelope';   

        foreach ( $socails_arr as $socail_name => $socail_value ) {

            if ( $socail_name == 'email' ) {
                $socail_link = 'mailto:' . ot_get_option(''.$socail_name.'_id');
            } else {
                $socail_link = ot_get_option(''.$socail_name.'_id');
            }  
                       
            echo '<a target="'.$target.'" href="' . $socail_link . '" class="bottomtip" title="'. $socail_name .'"><i class="fa '. $socail_value .'"></i></a>';
        }
       
    }  
}

/**
 *  Tweak wp_title to make it more useful
 */
if( ! function_exists('ht_filter_wp_title') ){
    function ht_filter_wp_title( $title, $separator ) {
        if ( is_feed() )
            return $title;

        global $paged, $page;

        if ( is_search() ) {
            $title = sprintf( __( 'Search results for','highthemes').' %s', '"' . get_search_query() . '"' );
            if ( $paged >= 2 )
                $title .= " $separator " . sprintf( __( 'Page','highthemes' ) . ' %s', $paged );
            $title .= " $separator " . get_bloginfo( 'name', 'highthemes' );
            return $title;
        }

        $title .= get_bloginfo( 'name', 'highthemes' );

        $site_description = get_bloginfo( 'description', 'highthemes' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title .= " $separator " . $site_description;

        if ( $paged >= 2 || $page >= 2 )
            $title .= " $separator " . sprintf( __( 'Page','highthemes' ) . ' %s', max( $paged, $page ) );

        return $title;
    }

}
add_filter( 'wp_title', 'ht_filter_wp_title', 10, 2 );



/**
 * Convert Twitter Links
 */
if (!function_exists('ht_tp_convert_links')) {
    function ht_tp_convert_links($status,$targetBlank=true,$linkMaxLen=250){
     
        // the target
            $target = $targetBlank ? " target=\"_blank\" " : "";

        // convert link to url
            $status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
         
        // convert @ to follow
            $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
         
        // convert # to search
            $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
         
        // return the status
            return $status;
    }
}


/**
 * Twitter Time
 */
if (!function_exists('ht_tp_relative_time')) {
    function ht_tp_relative_time($a) {
        //get current timestampt
        $b = strtotime("now"); 
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
            
        if(is_numeric($d) && $d > 0) {
            //if less then 3 seconds
            if($d < 3) return "right now";
            //if less then minute
            if($d < $minute) return floor($d) . " seconds ago";
            //if less then 2 minutes
            if($d < $minute * 2) return "about 1 minute ago";
            //if less then hour
            if($d < $hour) return floor($d / $minute) . " minutes ago";
            //if less then 2 hours
            if($d < $hour * 2) return "about 1 hour ago";
            //if less then day
            if($d < $day) return floor($d / $hour) . " hours ago";
            //if more then day, but less then 2 days
            if($d > $day && $d < $day * 2) return "yesterday";
            //if less then year
            if($d < $day * 365) return floor($d / $day) . " days ago";
            //else return more than a year
            return "over a year ago";
        }
    }   
}

/**
 * Add thumbs view to admin post lists
 */
if ( !function_exists('ht_add_thumb_col') && function_exists('add_theme_support') ) {

    function ht_add_thumb_col($cols) {

        $cols['thumbnail'] = __('Thumbnail','highthemes');

        return $cols;
    }
    function fb_add_thumb_value($column_name, $post_id) {

        $width = (int) 80;
        $height = (int) 80;

        if ( 'thumbnail' == $column_name ) {
            // thumbnail of WP 2.9
            $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
            // image from gallery
            $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
            if ($thumbnail_id)
                $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
            elseif ($attachments) {
                foreach ( $attachments as $attachment_id => $attachment ) {
                    $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                }
            }
            if ( isset($thumb) && $thumb ) {
                echo $thumb;
            } else {
                echo __('None','highthemes');
            }
        }
    }

    // for posts
    add_filter( 'manage_posts_columns', 'ht_add_thumb_col' );
    add_action( 'manage_posts_custom_column', 'fb_add_thumb_value', 10, 2 );
}
/**
 * Include post formats needed scripts
 */
if ( ! function_exists( 'ht_post_formats_script' ) ) {

    function ht_post_formats_script( $hook ) {
        // Only load on posts, pages
        if ( !in_array($hook, array('post.php','post-new.php')) )
            return;
        wp_enqueue_script('post-formats', get_template_directory_uri() . '/framework/assets/js/post.js', array( 'jquery' ));
    }
    
}
add_action( 'admin_enqueue_scripts', 'ht_post_formats_script');

/**
 * get container class
 */

 function ht_get_container_class(){
     $layout = ot_get_option('full-boxed');
     return ($layout == 'boxed') ? '' : 'container';
 }

/**
 * @param $tabs
 *
 * @return array
 * add a widget tab to siteorigin pagebuilder widgets
 */
function ht_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('Highthemes Sidebar Widgets', 'highthemes'),
        'filter' => array(
            'groups' => array('highthemes')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'ht_add_widget_tabs', 20);

function ht_pb_widgets( $widgets ){
    $widgets = array(
        'ht-post-block-widget' => true,
        'ht-row-title' => true,
        'ht-slider-widget' => true,
        'so-button-widget' => true,
        'so-google-map-widget' => true,
        'so-image-widget' => true,
        'so-slider-widget' => true,
        'so-post-carousel-widget' => true,
    );
    return $widgets;
}
add_filter('siteorigin_widgets_active_widgets', 'ht_pb_widgets');

function ht_add_widget_folders( $folders ){
    $folders[] = get_template_directory() . '/includes/pb-widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'ht_add_widget_folders');
