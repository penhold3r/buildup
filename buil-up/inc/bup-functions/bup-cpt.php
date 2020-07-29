<?php


/*
* Creating  CPT
*/

 
function bup_cpt()
{
    $sections = array(
      array(
         'singular_name'   => 'Proyecto',
         'general_name'    => 'Proyectos',
         'slug'            => 'projects-post-type'
      )
   );

    //  add icon and menu position
    foreach ($sections as $cpt) {
        $cpt['position'] = array_search($cpt, $sections) + 10;
        create_custom_post_type($cpt);
    }

    //
   // create_custom_taxonomy(array(
   //    'singular_name' => 'Bodega',
   //    'general_name' => 'Bodegas',
   //    'post_type' => 'product'
   // ));
}

add_action('init', 'bup_cpt', 0);
