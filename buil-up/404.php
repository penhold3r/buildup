<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Buil_Up
 */

get_header();
?>


<section class="error-404 not-found">

   <div class="error-404__content">

      <h2 class="not-found-title">404</h2>

      <p class="not-found-text">
         La página que buscas parece no existir o no está disponible por el momento.
      </p>

      <a href="/" class="button--outline--upper">
         Volver al inicio
      </a>

   </div>

</section><!-- .error-404 -->


<?php
get_footer();
