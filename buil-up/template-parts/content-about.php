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

      <div class="header-content" data-aos="fade-right">
         <h2 class="about-title" data-aos="fade-down" data-aos-delay="600">
            <?php the_title(); ?>
         </h2>
         <div class="about-text border-cut--light-left" data-aos="fade-down" data-aos-delay="500">
            <?php the_field('header_text') ?>
         </div>
      </div>
   </header>

   <section class="about-page__mission" data-aos="fade-up">

      <div class="mission-content border-cut--secondary-left">
         <div class="mission-text" data-aos="fade-right" data-aos-delay="300">
            <?php the_field('mission_text') ?>
         </div>
      </div>

      <?php acf_image('mission_image', array('classes' => array('lazy'))) ?>
   </section>

   <section class="about-page__clients" data-aos="fade-up">
      <?php acf_image('clients_image', array('classes' => array('lazy'))) ?>

      <div class="clients-content border-cut--secondary-right">
         <div class="clients-text" data-aos="fade-left" data-aos-delay="600">
            <?php the_field('clients_text') ?>
         </div>
      </div>
   </section>

   <div class="about-page__closing" data-aos="fade-up">
      <div class="closing-content border-cut--secondary-grey-top" data-aos="fade-up"
         data-aos-delay="600">
         <div class="closing-text" data-aos="fade-down" data-aos-delay="1200">
            <?php the_field('closing_text') ?>
         </div>
         <a href="/proyectos" class="button" data-aos="fade-up" data-aos-delay="1200">Ver
            proyectos</a>
      </div>
   </div>

</article>