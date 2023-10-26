<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="preload" href="<?php echo get_template_directory_uri() ?>/fonts/AkiraExpanded-SuperBold.woff2" as="font"
    type="font/woff2" crossorigin="anonymous">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!--header sction-->


  <header class="main-header">
    <div class="container">
      <div class="header-row">
        <div class="logo">
          <a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_value('driverite_header_logo'); ?>"
              alt=""></a>
        </div>
        <div class="hdr-rt">
          <div class="main-menu">
            <div class="nav_close" onclick="menu_close()">
              <i class="far fa-times-circle"></i>
            </div>

            <ul>
              <li>
                <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
              </li>
            </ul>
            <div class="for-mobile">
              <ul>
                <li><a href="<?php echo site_url('search'); ?>"><img
                      src="<?php bloginfo('template_directory'); ?>/assets/images/search.png" alt=""></a></li>
                <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/user.png" alt=""></a>
                </li>
                <li><a href="<?php echo wc_get_cart_url(); ?>"><img
                      src="<?php bloginfo('template_directory'); ?>/assets/images/cart.png" alt="">
                    <span class="cart-item">
                      <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                  </a></li>
              </ul>

            </div>
          </div>
          <div onclick="menu_open()" class="nav_btn">
            <i class="fas fa-bars"></i>
          </div>
        </div>
        <div class="for-desktop">
          <ul>
            <li><a href="<?php echo site_url('search'); ?>"><img
                  src="<?php bloginfo('template_directory'); ?>/assets/images/search.png" alt=""></a></li>
            <li><a href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/images/user.png" alt=""></a></li>
            <li><a href="<?php echo wc_get_cart_url(); ?>"><img
                  src="<?php bloginfo('template_directory'); ?>/assets/images/cart.png" alt="">
                <span class="cart-item">
                  <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
              </a></li>
          </ul>

        </div>
      </div>
    </div>

  </header>


  <!--header sction-->
  <script>

    jQuery(document).ready(function () {
      jQuery(".search-box-field").click(function () {
        jQuery(".search-box").toggle();
        jQuery(this).toggleClass("active-search")
      });
    });

  </script>