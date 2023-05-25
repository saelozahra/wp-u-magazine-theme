<?php 
  $ht_post_metabox = array(
    'id'          => 'ht_post_metabox',
    'title'       => __( 'Highthemes Post Options', 'highthemes' ),
    'desc'        => '',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(

        array(
            'label'   => __('Layout', 'highthemes'),
            'id'    => $prefix . 'layout',
            'type'    => 'radio-image',
            'desc'    => __('Overrides the default layout option', 'highthemes'),
            'std'   => 'inherit',
            'choices' => array(
                array(
                    'value'   => 'inherit',
                    'label'   => __('Default Layout - Set from Theme Options for all pages and posts', 'highthemes'),
                    'src'   => HT_FRAMEWORK_URL . 'option-framework/assets/images/layout-off.png'
                ),
                array(
                    'value'   => 'without-sidebar',
                    'label'   => __('Without Sidebar - Fullwide', 'highthemes'),
                    'src'   => HT_FRAMEWORK_URL . 'option-framework/assets/images/col-1c.png'
                ),
                array(
                    'value'   => 'sidebar-right',
                    'label'   => __('1 Sidebar Right', 'highthemes'),
                    'src'   => HT_FRAMEWORK_URL . 'option-framework/assets/images/col-2cl.png'
                ),
                array(
                    'value'   => 'sidebar-left',
                    'label'   => __('1 Sidebar Left', 'highthemes'),
                    'src'   => HT_FRAMEWORK_URL . 'option-framework/assets/images/col-2cr.png'
                ),
            )
        ),
        array(
            'label'   => __('Sidebar', 'highthemes'),
            'id'    => $prefix . 'sidebar_primary',
            'type'    => 'sidebar-select',
            'desc'    => __('Overrides default', 'highthemes')
        ),
      array(
        'id'      => $prefix . 'page_body_bg',
        'label'   => __('Post Body Background', 'highthemes'),
        'type'    => 'background',
        'section' => 'styling',
        'desc'   => __('Only on Boxed Layout', 'highthemes'),

      ),         
    )
  );
ot_register_meta_box( $ht_post_metabox );
?>