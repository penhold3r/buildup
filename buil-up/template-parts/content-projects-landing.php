<?php
/**
 * Template part for displaying projects landing content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="projects-landing landing" data-aos="fade-up">

   <?php $projects = get_field('projects_landing') ?>

   <?php
   
   acf_image($projects['projects_image'], array(
      'classes' => array('lazy')
   ));
   
   ?>

   <div class="projects-landing__content">
      <div class="projects-text" data-aos="fade-left" data-aos-delay="500">
         <?php echo $projects['projects_text'] ?>
      </div>
      <a href="/proyectos" class="button" data-aos="fade-up" data-aos-delay="600">Ver proyectos</a>
   </div>

</section><!-- .projects-landing -->