<?php
/**
 * Template part for displaying about landing content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section id="nosotros" class="about-landing">

   <?php $about = get_field('about_landing') ?>

   <div class="about-video">
      <video autoplay loop muted>
         <source
            src="<?php echo $about['about_video'] ?>"
            type="video/mp4">
      </video>
   </div>

   <div class="about-text-content">
      <div class="about-text">
         <?php echo $about['about_text'] ?>
      </div>
      <a href="/nosotros" class="button">Conózcanos</a>
   </div>

</section><!-- .about-landing -->