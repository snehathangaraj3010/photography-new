<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet"> 
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
     
<!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container top-nav">
      <div class="row-fluid">
      <div class="span9">   
        <div class="navbar">
          <div class="navbar-inner">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
              <?php

     
                        $args = array(
                        'theme_location' => 'primary',
                        'depth' => 3,
                        'container' => false,
                        'menu_class' => 'nav',
                        'fallback_cb' => false,
                        'walker' => new edenfresh_bootstrap_walker_nav_menu()
                        );

                         
                        wp_nav_menu($args);

                         
                        ?>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
      </div>
      <div class="span3" align="right">
        <a class="brand" href="<?php echo home_url('/'); ?>"><?php edenfresh_logo(); ?></a>
      </div>
      </div>
      </div>  
      
      <?php
          if(is_front_page()) get_template_part('homepage','top');
      ?>
      
    </div><!-- /.navbar-wrapper -->
        