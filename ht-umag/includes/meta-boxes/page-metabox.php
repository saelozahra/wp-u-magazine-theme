<?php 

$ht_page_metabox = array(
  'id'          => 'page-options',
  'title'       => __('Highthemes Page Options', 'highthemes'),
  'desc'        => '',
  'pages'       => array( 'page' ),
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'label'   => __('Page Title', 'highthemes'),
      'id'    => $prefix . 'page_title',
      'type'    => 'on-off',
      'std'   => 'on',
      'desc'    => __('If you like to display page title before content please set this On', 'highthemes')
    ),
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
      'label' => __('Page Comments', 'highthemes'),
      'id'    => $prefix . 'page_comments',
      'type'  => 'on-off',
      'std'   => 'off',
      'desc'  => __('If you like to display page comments after content please set this On', 'highthemes')
    ),
    array(
      'id'      => $prefix . 'page_body_bg',
      'label'   => __('Page Body Background', 'highthemes'),
      'desc'   => __('Only on Boxed Layout', 'highthemes'),
      'type'    => 'background',
      'section' => 'styling'
    ),    

  )
);  
ot_register_meta_box( $ht_page_metabox );
?>