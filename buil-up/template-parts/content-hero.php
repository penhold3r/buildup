<?php
/**
 * Template part for displaying hero content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="hero landing">

   <?php $hero = get_field('hero') ?>

   <?php
      acf_image($hero['hero_image'], array(
         'classes' => array('lazy'),
         'data' => array('aos' => 'fade-left')
      ));
   ?>

   <div class="hero__content" data-aos="fade-right">
      <div class="content-text border-cut--light-right" data-aos="fade-right" data-aos-delay="300">

         <?php echo $hero['hero_text'] ?>

      </div>
   </div>

   <div class="hero__scroll">
      <a href="#nosotros" class="scroll">
         <i class="icon icon-chev-right"></i>
         <span>Scroll</span>
      </a>
   </div>

</section><!-- .home-banner -->