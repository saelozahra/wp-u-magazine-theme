<?php
switch ( $ht_layout ) {
    case 'without-sidebar':
        $ht_grid_8_class       = 'col-lg-12 col-md-12';
        $ht_grid_4_class       = '';
        $ht_page_content_class = 'no-sidebar';
        break;  

   case 'sidebar-left':
        $ht_grid_8_class       = 'col-lg-8 col-md-8';
        $ht_grid_4_class       = 'col-lg-4 col-md-4';
        $ht_page_content_class = 'sidebar-left';
        break; 

    case 'sidebar-right':
        $ht_grid_8_class       = 'col-lg-8 col-md-8';
        $ht_grid_4_class       = 'col-lg-4 col-md-4';
        $ht_page_content_class = 'sidebar-right';
        break;  

    default:
        $ht_grid_8_class       = 'col-lg-8 col-md-8';
        $ht_grid_4_class       = 'col-lg-4 col-md-4';
        $ht_page_content_class = 'sidebar-right';
        break;
        
}