<?php
/**
 * Template part for displaying Contact content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Build_Up
 */

?>

<section class="contact-page">

   <header class="contact-page__header">
      <?php the_title('<h2 class="title">', '</h2>') ?>


   </header>

   <div class="contact-page__content">
      <div class="contact-info">
         <?php the_field('contact_info') ?>
      </div>

      <?php

         $fields = get_field('fields');
         $recipient = get_field('recipient');

         $form_fields = array();
         
         if ($fields) {
             foreach ($fields as $field) {
                 $type = 'text';

                 $type = $field['value'] === 'email' ? 'email' : $type;
                 $type = $field['value'] === 'phone' ? 'number' : $type;
                 $type = $field['value'] === 'message' ? 'textarea' : $type;

                 $icon = '';
                 $icon = $field['value'] === 'name' ? 'icon-user' : $icon;
                 $icon = $field['value'] === 'last_name' ? 'icon-user' : $icon;
                 $icon = $field['value'] === 'email' ? 'icon-at' : $icon;
                 $icon = $field['value'] === 'phone' ? 'icon-phone' : $icon;
                 $icon = $field['value'] === 'message' ? 'icon-comment' : $icon;
               
                 array_push($form_fields, array(
                  'type' => $type,
                  'name' => $field['value'],
                  'placeholder' => $field['label'],
                  'container_class' => ' icon '. $icon
               ));
             }
         };

         if (count($form_fields) !== 0) {
             build_form(
                 array(
                  'form_class' => 'contact-form',
                  'form_attr' => array('data-recip' => $recipient),
                  'fields' => $form_fields,
                  'field_container' => 'contact-form__field-container',
                  'required' => true,
                  'submit_value' => 'Enviar',
                  'submit_class' => 'contact-form__submit',
                  'submit_content_before' => '<i class="icon icon-arrow-right"></i>',
                  'form_after' => '<div class="output-msg"><p></p></div>'
               )
             );
         }
   

      ?>
   </div><!-- .contact-page__content -->

</section>