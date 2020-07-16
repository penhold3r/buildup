<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Build_Up
 */

?>
</main><!-- #main -->

<footer class="site-footer">

   <div class="site-footer__container">

      <div class="footer-info">
         <?php

            wp_nav_menu(array(
               'theme_location'	=> 'footer-menu',
               'menu'            => 'Footer Menu',
               'container'       => 'nav',
               'container_class' => 'footer-navigation',
               'container_id'    => 'main-nav',
               'menu_class'      => 'nav-list',
               'menu_id'         => '',
               'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
            ));

         ?>

         <?php is_active_sidebar('footer') && dynamic_sidebar('footer'); ?>
      </div>

      <div class="copy">
         <small>
            <?php echo get_bloginfo('name') ?>
            <span>&nbsp;&copy;&nbsp;</span>
            <?php echo date('Y') ?>
         </small>
         <span>&nbsp;|&nbsp;</span>
         <small>
            <a href="https://github.com/penhold3r" rel="noopener noreferrer"
               target="_blank">Desarrollo: penHolder Designerd</a>
         </small>
      </div><!-- .copy -->

   </div>

</footer><!-- .site-fotter -->

<?php wp_footer(); ?>

</body>

</html>