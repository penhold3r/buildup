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
        get_stylesheet_directory_uri() . '/css/style.buil-up.css',
        array(),
        $is_local ? time() : ''
    );
   
    // javascript
    wp_enqueue_script(
        'BUP_Script',
        get_stylesheet_directory_uri() . '/js/bundle.buil-up.js',
        '',
        $is_local ? time() : '',
        true
    );
   
    // theme data
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false
      ? 'http'
      : 'https';
    
    $data = array(
      'host' => $protocol.'://'.$_SERVER['HTTP_HOST'],
      'themeLocale' => get_locale(),
      'themeName' => wp_get_theme()->get('TextDomain'),
      'themeURL' => get_stylesheet_directory_uri(),
      'adminAjax' => admin_url('admin-ajax.php')
   );
   
    wp_localize_script('BUP_Script', 'theme', $data);
}

add_action('init', 'bup_styles_and_scripts');
