<?php
/**
 * Template part for displaying about landing content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section id="nosotros" class="about-landing landing" data-aos="fade-in">

   <?php $about = get_field('about_landing') ?>

   <div class="about-video">
      <video autoplay loop muted>
         <source
            src="<?php echo $about['about_video'] ?>"
            type="video/mp4">
      </video>
   </div>

   <div class="about-text-content" data-aos="fade-up">
      <div class="about-text" data-aos="fade-up" data-aos-delay="1000">
         <?php echo $about['about_text'] ?>
      </div>
      <a href="/nosotros" class="button--outline--light about-btn" data-aos="fade-up">Conózcanos</a>
   </div>

</section><!-- .about-landing -->