<?php
/**
 * Template part for displaying projects content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="projects-page">

   <header class="projects-page__header">
      <div class="header-content">
         <h2 class="projects-title">
            <?php the_title()?>
         </h2>
         <div class="projects-intro">
            <?php the_field('projects_intro')?>
         </div>
      </div>
   </header>

   <section class="projects-list">

      <?php
      
      $projects = array(
         'post_type' => 'projects-post-type',
         'post_per_page' => -1,
      );

      $projects_query = new WP_Query($projects);

      if (count($projects_query->posts)):
         foreach ($projects_query->posts as $project):
      ?>

      <div class="project-item">
         <?php

         acf_image(get_field('project_image', $project->ID), array('classes' => array('lazy')));
         
         ?>

         <div class="project-details">
            <h3 class="project-title">
               <?php echo $project->post_title ?>
            </h3>
            <div class="project-desc">
               <?php the_field('project_details', $project->ID) ?>
            </div>
         </div>
      </div>

      <?php
      
         endforeach;
      endif;

      ?>


   </section>

</section>