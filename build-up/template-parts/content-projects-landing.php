<?php
/**
 * Template part for displaying projects landing content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="projects-landing">

   <?php $projects = get_field('projects_landing') ?>

   <?php acf_image($projects['projects_image']) ?>

   <div class="projects-landing__content">
      <div class="projects-text">
         <?php echo $projects['projects_text'] ?>
      </div>
      <a href="/proyectos" class="button">Ver proyectos</a>
   </div>

</section><!-- .projects-landing -->