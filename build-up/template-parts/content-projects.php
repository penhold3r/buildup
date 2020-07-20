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
      <div class="header-content border-cut--grey-bottom" data-aos="fade-down">
         <h2 class="projects-title" data-aos="fade-up" data-aos-delay="400">
            <?php the_title()?>
         </h2>
         <div class="projects-intro" data-aos="fade-up" data-aos-delay="600">
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

      <div class="project-item border-cut--secondary-top" data-aos="fade-up">

         <div class="project-details">
            <h3 class="project-title">
               <?php echo $project->post_title ?>
            </h3>
            <div class="project-gallery">
               <div class="gallery-scroll">
                  <div class="slider">
                     <?php
               $images = acf_photo_gallery('project_gallery', $project->ID);
               foreach ($images as $image) {
                   echo '<div class="image-block" data-full="'. $image['full_image_url'] .'">';
                   echo '<img src="'. $image['full_image_url'] .'" srcset="'. $image['medium_srcset'] .'" alt="'. $image['title'] .'"/>';
                   echo '</div>';
               }
               ?>
                  </div>
               </div>
               <div class="prevnext">
                  <div class="arrow prev">
                     <i class="icon icon-chev-left"></i>
                  </div>
                  <div class="arrow next">
                     <i class="icon icon-chev-right"></i>
                  </div>
               </div>

               <template class="gallery-template">
                  <div class="gallery-modal">
                     <div class="inner-modal with-spinner">
                        <div class="close-modal">&times;</div>
                        <img>
                        <div class="modal-nav">
                           <span class="prev-btn">
                              <i class="icon icon-chev-left"></i>
                           </span>
                           <span class="next-btn">
                              <i class="icon icon-chev-right"></i>
                           </span>
                        </div>
                     </div><!-- .inner-modal -->
                  </div>
               </template>
            </div><!-- .gallery-images -->
         </div>
      </div>
      </div>

      <?php
      
         endforeach;
      endif;

      ?>


   </section>

</section>