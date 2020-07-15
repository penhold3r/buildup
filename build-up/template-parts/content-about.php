<?php
/**
 * Template part for displaying About content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<article class="about-page">

   <header class="about-page__header">
      <?php acf_image('header_image', array('classes' => array('lazy'))) ?>

      <div class="header-content">
         <h2 class="about-title">
            <?php the_title(); ?>
         </h2>
         <div class="about-text">
            <?php the_field('header_text') ?>
         </div>
      </div>
   </header>

   <section class="about-page__mission">

      <div class="mission-content">
         <h2 class="hidden">Misión</h2>
         <div class="mission-text">
            <?php the_field('mission_text') ?>
         </div>
      </div>

      <?php acf_image('mission_image', array('classes' => array('lazy'))) ?>
   </section>

   <section class="about-page__clients">
      <?php acf_image('clients_image', array('classes' => array('lazy'))) ?>

      <div class="clients-content">
         <h2 class="hidden">Clientes</h2>
         <div class="clients-text">
            <?php the_field('clients_text') ?>
         </div>
      </div>
   </section>

   <div class="about-page__closing">
      <div class="closing-content">
         <div class="closing-text">
            <?php the_field('closing_text') ?>
         </div>
         <a href="/proyectos" class="button">Ver proyectos</a>
      </div>
   </div>

</article>