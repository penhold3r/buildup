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
 * @package Buil_Up
 */

get_header();

while (have_posts()):
   the_post();

   if (is_front_page()):
      get_template_part('template-parts/content', 'home');

   elseif ($post->post_name === 'nosotros'):
      get_template_part('template-parts/content', 'about');

   elseif ($post->post_name === 'proyectos'):
      get_template_part('template-parts/content', 'projects');
   
   elseif ($post->post_name === 'contacto'):
      get_template_part('template-parts/content', 'contact');

   elseif ($post->post_name === 'default'):
      get_template_part('template-parts/content', 'default');

   else: get_template_part('template-parts/content', 'page');

   endif;
endwhile; // End of the loop.

get_footer();
