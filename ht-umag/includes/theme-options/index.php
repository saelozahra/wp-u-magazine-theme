<?php

add_action( 'admin_init', 'ht_custom_theme_options', 1 );

/*  Build the custom settings & update
/* ------------------------------------ */
function ht_custom_theme_options() {
    
    // Get a copy of the saved settings array.
    $saved_settings = get_option( 'option_tree_settings', array() );
    $custom_settings = array(   
        'sections'        => array(
            array(
                'id'        => 'socials',
                'title'     => __('<i class="ot-icon-star"></i> Socials', 'highthemes'),
            ),
            array(
                'id'        => 'general',
                'title'     => __('<i class="ot-icon-gear"></i> General', 'highthemes'),
            ),
            array(
                'id'        => 'menu',
                'title'     => __('<i class="ot-icon-th"></i> Menu', 'highthemes'),
            ),            
            array(
                'id'        => 'layout',
                'title'     => __('<i class="ot-icon-columns"></i> Layout', 'highthemes'),
            ),
            array(
                'id'        => 'header',
                'title'     => __('<i class="ot-icon-upload"></i> Header', 'highthemes'),
            ),
            array(
                'id'        => 'blog',
                'title'     => __('<i class="ot-icon-pencil"></i> Posts', 'highthemes'),
            ),
            array(
                'id'        => 'styling',
                'title'     => __('<i class="ot-icon-tint"></i> Styling', 'highthemes'),
            ),
            array(
                'id'        => 'sidebar',
                'title'     => __('<i class="ot-icon-th-list"></i> Create Sidebar', 'highthemes'),
            ),

        ),
    
/*  Theme options
/* ------------------------------------ */
    'settings'        => array(

        // Socials: twitter
                 
        array(
            'id'        => 'social_menu_target',
            'label'     => __('Open social links in a new page', 'highthemes'),
            'std'       => 'off',
            'type'      => 'on-off',
            'section'       => 'socials'
        ),  
        array(
            'id'      => 'twitter_id',
            'label'   => __('Twitter Profile', 'highthemes'),
            'desc'    => __('Enter your Twitter Profile URL.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: facebook
        array(
            'id'      => 'facebook_id',
            'label'   => __('Facebook Profile', 'highthemes'),
            'desc'    => __('Enter your facebook profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: Google plus
        array(
            'id'      => 'googleplus_id',
            'label'   => __('Google Plus Profile', 'highthemes'),
            'desc'    => __('Enter your Google plus profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: Flickr
        array(
            'id'      => 'flickr_id',
            'label'   => __('Flickr Profile', 'highthemes'),
            'desc'    => __('Enter your flickr profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: RSS
        array(
            'id'      => 'rss_id',
            'label'   => __('RSS', 'highthemes'),
            'desc'    => __('Enter your rss feed url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => get_bloginfo_rss('rss2_url'),          
            'section' => 'socials'
        ),  
        // Socials: linkedin
        array(
            'id'      => 'linkedin_id',
            'label'   => __('LinkedIn Profile', 'highthemes'),
            'desc'    => __('Enter your linkedin profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: dribbble
        array(
            'id'      => 'dribbble_id',
            'label'   => __('Dribbble Profile', 'highthemes'),
            'desc'    => __('Enter your Dribbble profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: github
        array(
            'id'      => 'github_id',
            'label'   => __('Github Profile', 'highthemes'),
            'desc'    => __('Enter your github profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: tumblr
        array(
            'id'      => 'tumblr_id',
            'label'   => __('Tumblr Profile', 'highthemes'),
            'desc'    => __('Enter your Tumblr profile url here', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: dropbox
        array(
            'id'      => 'dropbox_id',
            'label'   => __('Dropbox Profile', 'highthemes'),
            'desc'    => __('Enter your dropbox profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: youtube
        array(
            'id'      => 'youtube_id',
            'label'   => __('Youtube Profile', 'highthemes'),
            'desc'    => __('Enter your YouTube profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: instagram
        array(
            'id'      => 'instagram_id',
            'label'   => __('Instagram Profile', 'highthemes'),
            'desc'    => __('Enter your instagram profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),
        // Socials: skype
        array(
            'id'      => 'skype_id',
            'label'   => __('Skype Profile', 'highthemes'),
            'desc'    => __('Enter your skype profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',
            'section' => 'socials'
        ),
        // Socials: skype
        array(
            'id'      => 'soundcloud_id',
            'label'   => __('Soundcloud Profile', 'highthemes'),
            'desc'    => __('Enter your soundcloud profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',
            'section' => 'socials'
        ),
        // Socials: pinterest
        array(
            'id'      => 'pinterest_id',
            'label'   => __('Pinterest Profile', 'highthemes'),
            'desc'    => __('Enter your Pinterest profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: xing
        array(
            'id'      => 'xing_id',
            'label'   => __('Xing Profile', 'highthemes'),
            'desc'    => __('Enter your Xing profile url here.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: behance
        array(
            'id'      => 'behance_id',
            'label'   => __('Behance Profile', 'highthemes'),
            'desc'    => __('Enter your Behance Profile URL.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),  
        // Socials: Email
        array(
            'id'      => 'email_id',
            'label'   => __('Email Address', 'highthemes'),
            'desc'    => __('Enter your Email Address.', 'highthemes'),
            'type'    =>'text',
            'std'     => '',          
            'section' => 'socials'
        ),     
        // General: Custom Logo
        array(
            'id'        => 'logo_url',
            'label'     => __('Custom Logo', 'highthemes'),
            'desc'      => __('Upload your custom logo image', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),
        // General: Custom Dark Logo
        array(
            'id'        => 'dark_logo_url',
            'label'     => __('Custom Dark Logo', 'highthemes'),
            'desc'      => __('Upload your custom Dark logo image for Dark version', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),  
        // General: Retina Logo
        array(
            'id'        => 'retina_logo_url',
            'label'     => __('Retinal Logo', 'highthemes'),
            'desc'      => __('Upload your retian logo image', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ), 
        // General: Retina Dark Logo
        array(
            'id'        => 'retina_dark_logo_url',
            'label'     => __('Retinal Dark Logo', 'highthemes'),
            'desc'      => __('Upload your retian dark logo image', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),                      
        // General: Logo Align  
        array(
            'id'        => 'header_align',
            'label'     => __('Header Align', 'highthemes'),
            'desc'      => __('Align the header (Left, Center)', 'highthemes'),
            'type'      => 'radio',
            'std'       => 'left',
            'section'   => 'general',
            'choices'   => array(
                array( 
                    'value' => 'left',
                    'label' => __('Left', 'highthemes')
                ),
                array( 
                    'value' => 'center',
                    'label' => __('center', 'highthemes')
                ),
            )
        ),        
        // General: Favicon
        array(
            'id'        => 'favicon',
            'label'     => __('Favicon', 'highthemes'),
            'desc'      => __('Upload a 16x16px Png/Gif/ico image that will be your favicon', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),
        // General: iPhone Icon
        array(
            'id'        => 'apple_logo',
            'label'     => __('iPhone Icon', 'highthemes'),
            'desc'      => __('Icon for Apple iPhone 57x57px', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),
        // General: iPad Icon
        array(
            'id'        => 'apple_ipad_logo',
            'label'     => __('iPad Icon', 'highthemes'),
            'desc'      => __('Icon for Apple iPad 72x72px', 'highthemes'),
            'type'      => 'upload',
            'section'   => 'general'
        ),

        // General: Custom head codes
        array(
            'id'      => 'custom-codes-head',
            'label'   => __('Custom Head Codes', 'highthemes'),
            'desc'    => __('Add your custom codes or scripts or meta tags, this will be added before closing head tag', 'highthemes'),
            'type'    => 'textarea-simple',
            'section' => 'general',
            'rows'    => '3'
        ),
        // General: Custom Footer codes
        array(
            'id'      => 'custom-codes-footer',
            'label'   => __('Custom Footer Codes', 'highthemes'),
            'desc'    => __('Add your custom codes, analytics or scripts, this will be added before closing body tag', 'highthemes'),
            'type'    => 'textarea-simple',
            'section' => 'general',
            'rows'    => '3'
        ),
        // General: Page Navi
        array(
            'id'      => 'page_navi',           
            'label'   => __('Page Navi Pagination?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'general'
        ),
        // Menu: Second Menu
        array(
            'id'      => 'second_menu_status',
            'label'   => __('Secondary Menu?', 'highthemes'),
            'std'     => 'off',
            'type'    => 'on-off',
            'section' => 'menu',
        ),
        // Menu: Sticky Menu
        array(
            'id'        => 'sticky_status',
            'label'     => __('Sticky Navigation', 'highthemes'),
            'desc'      => __('Just working on primary navigation', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'   => 'menu'
        ),                   

        // Blog: Posts Layout
        array(
            'id'        => 'archive_post_layout',
            'label'     => __('Archive Posts Layout', 'highthemes'),
            'std'       => '3c',
            'type'      => 'radio-image',
            'section'   => 'blog',
            'choices'   => array(
                array(
                    'value'     => '1c',
                    'label'     => '1',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/1col.png'
                ),
                array(
                    'value'     => '2c',
                    'label'     => '2',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/2col.png'
                ),
                array(
                    'value'     => '3c',
                    'label'     => '3',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/3col.png'
                ),
                array(
                    'value'     => '4c',
                    'label'     => '4',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/4col.png'
                ),
            )
        ),
        array(
            'id'        => 'search_post_layout',
            'label'     => __('Search Posts Layout', 'highthemes'),
            'std'       => '3c',
            'type'      => 'radio-image',
            'section'   => 'blog',
            'choices'   => array(
                array(
                    'value'     => '1c',
                    'label'     => '1',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/1col.png'
                ),
                array(
                    'value'     => '2c',
                    'label'     => '2',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/2col.png'
                ),
                array(
                    'value'     => '3c',
                    'label'     => '3',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/3col.png'
                ),
                array(
                    'value'     => '4c',
                    'label'     => '4',
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/4col.png'
                ),
            )
        ),

        // Blog: Archive Post Thumbnail Size
        array(
            'id'          => 'archive_post_thumb_size',
            'label'       => __('Archive Post Thumbnail Size', 'highthemes'),
            'std'         => 'a',
            'type'        => 'select',
            'section'      => 'blog',
            'choices'     => array(
                array(
                    'value'       => 'a',
                    'label'       => __( '800x550 (Horizontal)', 'highthemes' ),
                ),
                array(
                    'value'       => 'b',
                    'label'       => __( '720x800 (Vertical)', 'highthemes' ),
                ),

            )
        ),
        // Blog
        array(
            'id'        => 'share_post',
            'label'     => __('Share Post Buttons', 'highthemes'),
            'desc'      => __('Shows social share buttons below the post in single post', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'       => 'blog'
        ),
        array(
            'id'        => 'next_prev_post',
            'label'     => __('Next/Previous Posts', 'highthemes'),
            'desc'      => __('Show Nex/Previous Post at the end of posts', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'       => 'blog'
        ),

        // Blog: single featured
        array(
            'id'        => 'single_featured',
            'label'     => __('Featured Image on Single post', 'highthemes'),
            'desc'      => __('If you want also showing featured image top of the post in single post, please set this ON', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'       => 'blog'
        ),
        // Blog: archive featured
        array(
            'id'        => 'archive_featured',
            'label'     => __('Featured image on all archive pages such as search, archive, category, etc', 'highthemes'),
            'desc'      => __('Set this option to ON, if you are willing to have featured images at top of posts in archive pages', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'       => 'blog'
        ),
        // Blog: Single - Authorbox
        array(
            'id'        => 'author_box',
            'label'     => __('Author Box in Single Post', 'highthemes'),
            'desc'      => __('Shows post author description, if it exists', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'   => 'blog'
        ),
        // Blog: Single - Related Posts
        array(
            'id'        => 'related_posts',
            'label'     => __('Related Posts', 'highthemes'),
            'desc'      => __('Shows randomized related articles below the post in single post', 'highthemes'),
            'std'       => 'categories',
            'type'      => 'radio',
            'section'   => 'blog',
            'choices'   => array(
                array( 
                    'value' => 'none',
                    'label' => __('Disable', 'highthemes')
                ),
                array( 
                    'value' => 'categories',
                    'label' => __('Related by categories', 'highthemes')
                ),
                array( 
                    'value' => 'tags',
                    'label' => __('Related by tags', 'highthemes')
                )
            )
        ),
        // Blog: Single - Related Posts
        array(
            'id'        => 'related_posts_num',
            'label'     => __('Related Posts Limit', 'highthemes'),
            'desc'      => __('Max number of posts if has', 'highthemes'),
            'std'       => '6',
            'type'      => 'numeric-slider',
            'section'       => 'blog',
            'min_max_step'  => '1,30,1'
        ),

        // Header: img
        array(
            'id'        => 'header_today_date_status',           
            'label'     => __('Header Today Date?', 'highthemes'),
            'std'       => 'on',
            'type'      => 'on-off',
            'section'   =>'header',         
        ),        
        array(
            'id'      => 'header_today_date',           
            'label'   => __('Header Today Date Format', 'highthemes'),
            'type'    =>'text',
            'std'     => 'l j F Y',          
            'section' =>'header',
            'desc'    => __("For more information about the format, <a href='http://www.w3schools.com/php/func_date_date.asp'>Click Here</a>", 'highthemes'),
            'condition' => 'header_today_date_status:is(on)',
            'operator'  => 'and'               
        ),
        array(
            'id'      => 'top_header_status',
            'label'   => __('Top Header Bar?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'header'
        ),
        array(
            'id'        => 'header_news_status',
            'label'     => __('Disable, Homepage or All Pages', 'highthemes'),
            'type'      => 'radio',
            'std'       => 'all',
            'section'   => 'header',
            'choices'   => array(
                array(
                    'value' => 'disable',
                    'label' => __('Disable', 'highthemes')
                ),
                array(
                    'value' => 'home',
                    'label' => __('Homepage', 'highthemes')
                ),
                array(
                    'value' => 'all',
                    'label' => __('All Pages', 'highthemes')
                )

            )
        ),
        array(
            'id'          => 'header_news_category',
            'label'       => __( 'Breaking News Category', 'highthemes' ),
            'std'         => '',
            'type'        => 'category-select',
            'section'     => 'header',
            'rows'        => '',
            'post_type'   => 'post',
            'condition'   => 'header_news_status:is(home),header_news_status:is(all)',
            'operator'    => 'or'
        ),        
        array(
            'id'      => 'header_ads_box',
            'label'   => __('Header Ads Box (728x90)', 'highthemes'),
            'desc'    => __('Paste your Google Adsense (or other) code here.', 'highthemes'),
            'type'    => 'textarea-simple',
            'section' => 'header',
            'rows'    => '3'
        ), 
        array(
            'id'      => 'search_status',           
            'label'   => __('Search on navigation?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' =>'header'
        ),
        // Layout: Responsive Layout
        array(
            'id'      => 'responsive_layout',           
            'label'   => __('Responsive Layout?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'layout'
        ), 
        // Layout: Layout
        array(
            'id'        => 'full-boxed',
            'label'     => __('Fullwide or Boxed', 'highthemes'),
            'desc'      => __('This option is effective on all pages', 'highthemes'),
            'type'      => 'radio',
            'std'       => 'full',
            'section'       => 'layout',
            'choices'   => array(
                array( 
                    'value' => 'full',
                    'label' => __('Fullwide', 'highthemes')
                ),
                array( 
                    'value' => 'boxed',
                    'label' => __('Boxed', 'highthemes')
                )

            )
        ),
        // Layout : Global
        array(
            'id'        => 'layout-global',
            'label'     => __('Global Layout', 'highthemes'),
            'desc'      => __('This option will set on all pages and posts, also you can override it on each page or post separately.', 'highthemes'),
            'std'       => 'sidebar-right',
            'type'      => 'radio-image',
            'section'   => 'layout',
            'choices'   => array(
                array(
                    'value'     => 'without-sidebar',
                    'label'     => __('Without Sidebar', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/col-1c.png'
                ),
                array(
                    'value'     => 'sidebar-right',
                    'label'     => __('1 Sidebar Right', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/col-2cl.png'
                ),
                array(
                    'value'     => 'sidebar-left',
                    'label'     => __('1 Sidebar Left', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/col-2cr.png'
                ),
            )
        ),

        // Layout: Footer status
        array(
            'id'      => 'footer_status',           
            'label'   => __('Footer Row #1 Status?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'layout'
        ),   
        // Layout: Layout Footer
        array(
            'id'        => 'footer-cols',
            'label'     => __('Footer Widget Columns', 'highthemes'),
            'desc'      => __('Choose the number footer widget blocks.', 'highthemes'),
            'std'       => '4',
            'type'      => 'radio-image',
            'section'   => 'layout',
            'condition' => 'footer_status:is(on)',
            'operator'  => 'and',            
            'choices'   => array(
                array(
                    'value'     => '1',
                    'label'     => __('1 Column', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-1.png'
                ),
                array(
                    'value'     => '2',
                    'label'     => __('2 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-2.png'
                ),
                array(
                    'value'     => '3',
                    'label'     => __('3 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-3.png'
                ),
                array(
                    'value'     => '4',
                    'label'     => __('4 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-4.png'
                )
            )
        ),

        // Layout: Footer status
        array(
            'id'      => '2nd_footer_status',
            'label'   => __('Footer Row #2 Status?', 'highthemes'),
            'std'     => 'off',
            'type'    => 'on-off',
            'section' => 'layout'
        ),
        // Layout: Layout Footer
        array(
            'id'        => '2nd-footer-cols',
            'label'     => __('Footer Widget Columns', 'highthemes'),
            'desc'      => __('Choose the number footer widget blocks.', 'highthemes'),
            'std'       => '4',
            'type'      => 'radio-image',
            'section'   => 'layout',
            'condition' => '2nd_footer_status:is(on)',
            'operator'  => 'and',
            'choices'   => array(
                array(
                    'value'     => '1',
                    'label'     => __('1 Column', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-1.png'
                ),
                array(
                    'value'     => '2',
                    'label'     => __('2 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-2.png'
                ),
                array(
                    'value'     => '3',
                    'label'     => __('3 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-3.png'
                ),
                array(
                    'value'     => '4',
                    'label'     => __('4 Columns', 'highthemes'),
                    'src'       => get_template_directory_uri() . '/framework/option-framework/assets/images/footer-widgets-4.png'
                )
            )
        ),
        // Layout: Sub Footer status
        array(
            'id'      => 'sub_footer_status',           
            'label'   => __('Sub Footer Status?', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'layout'
        ),                       
        // Layout: Footer Text
        array(
            'id'        => 'footer_text',
            'label'     => __('Footer Text', 'highthemes'),
            'desc'      => __('Enter a copyright or something else at the very bottom of the pages.', 'highthemes'),
            'std'       => __('© '.date('Y').' All Rights Reserved. Powered by <a href="http://highthemes.com">Highthemes Premium Wordpress Themes</a>', 'highthemes'),
            'type'      => 'text',
            'condition' => 'sub_footer_status:is(on)',
            'operator'  => 'and',
            'section'   => 'layout',
        ),  
        // Layout: Back To Top
        array(
            'id'      => 'Back_to_top',
            'label'   => __('Back To Top Button', 'highthemes'),
            'desc'    => __('Display Back To Top Button', 'highthemes'),
            'std'     => 'on',
            'type'    => 'on-off',
            'section' => 'layout'
        ),     
        // Sidebars: Create Areas
        array(
            'id'        => 'sidebar-areas',
            'label'     => __('Create Unlimited Sidebars', 'highthemes'),
            'desc'      => __('You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>', 'highthemes'),
            'type'      => 'list-item',
            'section'   => 'sidebar',
            'choices'   => array(),
            'settings'  => array(
                array(
                    'id'        => 'id',
                    'label'     => __('Sidebar ID', 'highthemes'),
                    'desc'      => __('This ID must be unique, for example "sidebar-about"', 'highthemes'),
                    'std'       => 'sidebar-',
                    'type'      => 'text',
                    'choices'   => array()
                )
            )
        ),
        // Styling: Dark Version
        array(
            'id'        => 'dark',
            'label'     => __('Dark Version', 'highthemes'),
            'desc'      => __('-', 'highthemes'),
            'std'       => 'off',
            'type'      => 'on-off',
            'section'   => 'styling'
        ),
        // Styling: Primary Color
        array(
            'id'      => 'accent_color',
            'label'   => __('Theme Color Scheme (Accent Color)', 'highthemes'),
            'type'    => 'colorpicker',
            'section' => 'styling',
            'class'   => '',
            'std'    =>'#e4545b'
        ),
        array(
            'id'          => 'ht_google_fonts',
            'label'       => __( 'Google Fonts', 'highthemes' ),
            'desc'        => sprintf( __( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. ', 'highthemes' ), '<code>HEAD</code>', '<code>font-family</code>' ),
            'std'         => array(
                array(
                    'family'    => 'lato',
                    'variants'  => array( '300', '300italic', 'regular', 'italic', '700', '700italic' ),
                    'subsets'   => array( 'latin' )
                )
            ),
            'type'        => 'google-fonts',
            'section'     => 'styling',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
        ),
        // General: Custom CSS
        array(
            'id'      => 'custom_css',
            'label'   => __('Custom CSS', 'highthemes'),
            'desc'    => __('add your custom css code here without style tag', 'highthemes'),
            'type'    => 'css',
            'section' => 'styling'
        ),
        // Styling: Font
        array(
            'id'      => 'font_body',
            'label'   => __( 'Body Typography', 'highthemes' ),
            'std'     => '',
            'type'    => 'typography',
            'section' => 'styling',
        ),    

        array(
            'id'      => 'font_nav',
            'label'   => __( 'Navigation Typography', 'highthemes' ),
            'std'     => '',
            'type'    => 'typography',
            'section' => 'styling',
        ),  

        array(
            'id'      => 'font_name_headlines',
            'label'   => __( 'Headlines Font Family', 'highthemes' ),
            'std'     => '',
            'type'    => 'typography',
            'section' => 'styling',
        ),

        // Styling: Body Background
        array(
            'id'      => 'body_bg',
            'label'   => __('Body Background', 'highthemes'),
            'type'    => 'background',
            'section' => 'styling',
            'desc'    => __('Just works in Boxed Layout', 'highthemes')
        ),


    )
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
    if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings ); 
    } 
}
