<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

get_header();

while (have_posts()) :
   the_post();

   if (is_front_page()):
      get_template_part('template-parts/content', 'home');

   elseif ($post->post_name === 'rutas'):
      get_template_part('template-parts/content', 'routes');
   
   elseif ($post->post_name === 'contacto'):
      get_template_part('template-parts/content', 'contact');

   else: get_template_part('template-parts/content', 'page');

   endif;
endwhile; // End of the loop.

get_footer();
