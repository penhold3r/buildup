<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('default-content'); ?>>

   <h1 class="page-title">
      <?php the_title() ?>
   </h1>

   <?php the_content() ?>

</article><!-- #post-<?php the_ID(); ?> -->