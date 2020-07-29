<?php
/**
 * Template part for displaying closing landing content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="closing-landing landing">

   <?php $closing = get_field('closing_landing') ?>

   <?php

   acf_image($closing['closing_image'], array(
      'classes' => array('lazy'),
      'data' => array('aos' => 'fade-up')
   ));
   
   ?>

   <div class="closing-landing__text" data-aos="zoom-out">

      <?php echo $closing['closing_text'] ?>

   </div>

</section><!-- .closing-landing -->