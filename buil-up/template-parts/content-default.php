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

   <hr>

   <div class="buttons">
      <h3>Buttons</h3>
      <div class="buttons-group">
         <a href="#" class="button">Button</a>
         <a href="#" class="button--upper">Uppecase</a>
         <a href="#" class="button--outline">Button outline</a>
         <a href="#" class="button-sm--outline">Button outline sm</a>
         <a href="#" class="button-sm--upper">Button uppercase sm</a>
         <a href="#" class="button-sm">Button sm</a>
      </div>
      <div class="buttons-group">
         <a href="#" class="button--primary">Button</a>
         <a href="#" class="button--upper--primary">Uppecase</a>
         <a href="#" class="button--outline--primary">Button outline</a>
         <a href="#" class="button-sm--outline--primary">Button outline sm</a>
         <a href="#" class="button-sm--upper--primary">Button uppercase sm</a>
         <a href="#" class="button-sm--primary">Button sm</a>
      </div>
      <div class="buttons-group">
         <a href="#" class="button--secondary">Button</a>
         <a href="#" class="button--upper--secondary">Uppecase</a>
         <a href="#" class="button--outline--secondary">Button outline</a>
         <a href="#" class="button-sm--outline--secondary">Button outline sm</a>
         <a href="#" class="button-sm--upper--secondary">Button uppercase sm</a>
         <a href="#" class="button-sm--secondary">Button sm</a>
      </div>
      <div class="buttons-group">
         <a href="#" class="button--accent">Button</a>
         <a href="#" class="button--upper--accent">Uppecase</a>
         <a href="#" class="button--outline--accent">Button outline</a>
         <a href="#" class="button-sm--outline--accent">Button outline sm</a>
         <a href="#" class="button-sm--upper--accent">Button uppercase sm</a>
         <a href="#" class="button-sm--accent">Button sm</a>
      </div>
      <div class="buttons-group">
         <a href="#" class="button--light">Button</a>
         <a href="#" class="button--upper--light">Uppecase</a>
         <a href="#" class="button--outline--light">Button outline</a>
         <a href="#" class="button-sm--outline--light">Button outline sm</a>
         <a href="#" class="button-sm--upper--light">Button uppercase sm</a>
         <a href="#" class="button-sm--light">Button sm</a>
      </div>
   </div>
   <hr>
   <div class="colors">
      <h3>Colors</h3>

      <div class="bg-primary">primary</div>
      <div class="bg-primary-grey">primary-grey</div>
      <div class="bg-secondary">secondary</div>
      <div class="bg-secondary-grey">secondary-grey</div>
      <div class="bg-accent">accent</div>
      <div class="bg-accent-grey">accent-grey</div>
      <hr>
      <div class="bg-dark">dark</div>
      <div class="bg-light">light</div>
      <hr>
      <div class="bg-grey-100">grey-100</div>
      <div class="bg-grey-200">grey-200</div>
      <div class="bg-grey-300">grey-300</div>
      <div class="bg-grey-400">grey-400</div>
      <div class="bg-grey-500">grey-500</div>
      <div class="bg-grey-600">grey-600</div>
      <div class="bg-grey-700">grey-700</div>
      <div class="bg-grey-800">grey-800</div>
      <div class="bg-grey-900">grey-900</div>
   </div>
</article><!-- #post-<?php the_ID(); ?> -->