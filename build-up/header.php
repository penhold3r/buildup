<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Build_Up
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

   <head>
      <meta
         charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="profile" href="https://gmpg.org/xfn/11">
      <link href="https://cdn.jsdelivr.net/gh/penhold3r/basic-icons@master/css/basic-icons.css"
         rel="stylesheet" />

      <?php wp_head(); ?>
   </head>

   <body <?php body_class(); ?>>
      <?php wp_body_open(); ?>
      <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'build_up'); ?></a>

      <header class="site-header">
         <div class="site-header__content">

            <input type="checkbox" name="menutoggle" class="menutoggle">
            <div class="shaddow"></div>
            <label class="mobile-menu" for="menutoggle" title="menú">
               <div class="bars">
                  <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
               </div>
            </label>

            <h1 class="site-logo" data-aos="fade-up">
               <?php the_custom_logo(); ?>
            </h1>

            <?php

               wp_nav_menu(array(
                  'theme_location'	=> 'header-menu',
                  'menu'            => 'Header Menu',
                  'container'       => 'nav',
                  'container_class' => 'navigation',
                  'container_id'    => 'main-nav',
                  'menu_class'      => 'nav-list',
                  'menu_id'         => '',
                  'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                  //"walker"          => new Qatar_Walker()
               ));

            ?>

         </div><!-- .site-header__content-->

      </header><!-- .site-header -->

      <main class="site-main fader">