<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="format-detection" content="telephone=no">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- favicon -->
  <?php if( ot_get_option( 'favicon' ) != '' ) { echo ht_favicon(ot_get_option('favicon'));} ?>
  <?php if( ot_get_option('apple_ipad_logo') != '' ): ?>
  <!-- For iPad -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url(ot_get_option('apple_ipad_logo')) ; ?>">
  <?php endif; ?>
  <?php if( ot_get_option('apple_logo') != '' ): ?>
  <!-- For iPhone -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(ot_get_option('apple_logo')); ?>">
  <?php endif; ?>
  <?php if( ot_get_option('responsive_layout') == 'on' ): ?>
  <!-- responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" />
  <?php endif; ?>

  <!-- RSS feed -->
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  
  <?php if( ot_get_option('custom-codes-head') != '' ) echo ot_get_option('custom-codes-head'); ?>
  <?php wp_head(); ?>   
  </head>
  <body <?php body_class();?>>
  <div id="layout" class="<?php if(ot_get_option('full-boxed') == 'boxed'){ echo 'container-wrapper content-bg';}?>">
  <!-- HEADER STARTS
      ========================================================================= -->
  <header>
    <!-- TOP ROW STARTS -->
    <?php if( ot_get_option('top_header_status') == 'on' ): ?>
    <div class="top-nav">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div id="date">
              <?php
              if( ot_get_option('header_today_date_status') == 'on' ){
                echo date_i18n(ot_get_option('header_today_date'));
              }
              ?>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <?php
            if( ot_get_option('second_menu_status') == 'on' ) {


              if ( has_nav_menu( 'second-nav' ) ) {
                wp_nav_menu(array(
                    'theme_location' => 'second-nav',
                    'container' => false,
                    'menu_class' => 'small-nav',
                    'menu_id' => 'second-nav',
                    'depth' => '1',
                ));
              } else {
                echo '<div style="float:right;">'. __('Go to Appreance > Menus > Create New Menu as Secondary Navigation','highthemes') .'</div>';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <!-- TOP ROW ENDS -->
    <!-- LOGO & ADS STARTS -->
    <div class="container">
      <div class="row">
        <?php if( ot_get_option('header_align') == 'center' ): ?>
        <div class="col-lg-12 logo text-center">
          <a title="<?php bloginfo("description");?>" href="<?php echo esc_url(home_url());?>">
            <?php if (ot_get_option('logo_url')): ?>
              <img src="<?php echo esc_url(ot_get_option('logo_url'));?>" alt="<?php bloginfo('description'); ?>"/>
            <?php else: ?>
              <img  src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="Logo"/>
            <?php endif; ?>
          </a>
        </div>
        <?php else: ?>
        <div class="col-lg-4 col-md-2 logo">
          <a title="<?php bloginfo("description");?>" href="<?php echo esc_url(home_url());?>">
            <?php if (ot_get_option('logo_url')): ?>
              <img src="<?php echo esc_url(ot_get_option('logo_url'));?>" alt="<?php bloginfo('description'); ?>"/>
            <?php else: ?>
              <img  src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="Logo"/>
            <?php endif; ?>
          </a>
        </div>
        <div class="col-lg-8 col-md-10">
          <div class="ad-728x90"><?php echo ot_get_option('header_ads_box'); ?></div>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- LOGO & ADS ENDS -->
  </header>
  <!-- /. HEADER ENDS
      ========================================================================= -->

  <nav class="<?php if( ot_get_option('sticky_status') == 'on' ) echo 'sticky-navigation'; ?>" id="main-nav-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <a href="#" id="menu-button" class="collapsed">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php
          if ( has_nav_menu( 'main-nav' ) ) {
            wp_nav_menu(array(
                'theme_location'  => 'main-nav',
                'container'       => false,
                'menu_class'      => 'sm collapsed',
                'menu_id'         => 'main-menu',
                'walker'          => new description_walker(),
            ));
          } else {
            echo '<div style="height:56px; float:left; line-height:56px; padding-left:30px;">'. __('Go to Appreance > Menus > Create New Menu as Main Navigation','highthemes') .'</div>';
          }
          ?>
          <!-- Search Starts -->
          <?php if( ot_get_option('search_status') == 'on' ): ?>
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <div class="header-search">
            <form action="<?php echo esc_url(home_url());?>" id="search" method="get">
                <input type="text" name="s" class="s" placeholder="<?php _e('Start typing to search ...','highthemes') ?>">
            </form>
          </div>
          <?php endif; ?>
          <!-- Search Ends -->
        </div>
      </div>
    </div>
  </nav>
<a style="display:none" rel="follow"  href="http://farishtheme.ir/" title="قالب وردپرس">قالب وردپرس</a>

<a style="display:none" rel="follow"  href="http://safarekish.ir/" title="تور کیش">تور کیش</a>

  <!-- NEWS STARTS
      ========================================================================= -->
  <?php
  if( ot_get_option('header_news_status') != 'disable' ) {
    if ( ot_get_option('header_news_status') == 'home' && is_front_page() ) {
      get_template_part('/includes/news');
    } elseif( ot_get_option('header_news_status') == 'home' && ! is_front_page() ) {
      // ....
    } else {
      get_template_part('/includes/news');
    }
  }
  ?>