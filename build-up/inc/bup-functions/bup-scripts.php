<?php
/**
 * load CSS and JS
 *
 */
function bup_styles_and_scripts()
{
    $is_local = $_SERVER['SERVER_ADDR'] === '127.0.0.1';

    // styles
    wp_enqueue_style(
        'BUP_Style',
        get_stylesheet_directory_uri() . '/css/style.build-up.css',
        array(),
        $is_local ? time() : ''
    );
   
    // scripts
    wp_enqueue_script(
        'gmap',
        'https://maps-api-ssl.google.com/maps/api/js?key=AIzaSyBZLEliDhUUlSxi5yjNAB8F9-lDYVVAoYM'
    );
   
    wp_register_script(
        'BUP_Script',
        get_stylesheet_directory_uri() . '/js/bundle.build-up.js',
        '',
        $is_local ? time() : '',
        true
    );
   
    // theme data
    $data = array(
      'themeLocale' => get_locale(),
      'themeName' => wp_get_theme()->get('TextDomain'),
      'themeURL' => get_stylesheet_directory_uri()
   );
   
    wp_localize_script('BUP_Script', 'theme', $data);
    wp_enqueue_script('BUP_Script');
}

add_action('wp_enqueue_scripts', 'bup_styles_and_scripts');
