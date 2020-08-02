<?php
/*
 *--------------------------------------------
 *
 * Let's make wordpress easier :P
 *
 *--------------------------------------------*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require get_template_directory() . '/ph/vendor/autoload.php';

/**
 * Get theme name
 */
function get_theme_text_domain()
{
    return wp_get_theme()->get('TextDomain');
}

/**
 * Get current language code
 */
function get_current_language()
{
    return substr(get_locale(), 0, 2);
}

/**
 * Convert plain text into link
 */
function fix_link($raw_link)
{
    $reg_ex = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^‌​,.\s])@';
    $link   = preg_replace($reg_ex, 'http$2://$4', $raw_link);
   
    return rtrim($link, '/');
}

/**
 * Use Paste As Text by default in the editor
 */
function ph_paste_as_text($init)
{
    $init['paste_as_text'] = true;
    return $init;
}
add_filter('tiny_mce_before_init', 'ph_paste_as_text');

/**
 *--------------------------------------------
 * Body class by categories
 */
function categories_to_bodyclasses($classes)
{
    $post_categories = get_the_category();
    foreach ($post_categories as $current_category) {
        $classes[] = 'category-' . $current_category->slug;
    }
   
    return $classes;
}

add_filter('body_class', 'categories_to_bodyclasses');

/**
 *--------------------------------------------
 * Body class by slug
 */
function slug_to_bodyclasses($classes)
{
    global $post;
   
    array_push($classes, $post->post_name);
   
    return $classes;
}

add_filter('body_class', 'slug_to_bodyclasses');
/**
 * Category to pages
 */
function categories_to_pages()
{
    register_taxonomy_for_object_type('post_tag', 'page');
   
    register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'categories_to_pages');

/**
 *--------------------------------------------
 * Display featured image
 */
function feat_img(array $custom = array())
{
    global $post;
   
    $defaults = array(
        'type' => 'full',
        'blur' => true,
        'classes' => array(),
        'id' => 0,
      'data' => array(),
      'placeholder' => null,
    );

    $options = array_merge($defaults, $custom);
   
    $classes = count($options['classes']) === 0
      ? 'feat-img'
      : implode(" ", $options['classes']) . ' feat-img';
      
    $data_attr = '';
    if (count($options['data']) !== 0) {
        foreach ($options['data'] as $data => $val) {
            $data_attr .= 'data-'. $data .'="'. $val .'" ';
        }
    }
   
    $image_id = $options['id'] !== 0 ? $options['id'] : $post->ID;
   
    if (has_post_thumbnail($image_id)) {
        echo '<div class="'. $classes .'" '. $data_attr .'>';

        if ($options['blur']) {
            $placeholder = $options['placeholder'] ?? get_the_post_thumbnail_url($image_id, 'thumbnail');
            echo '<div class="bg-placeholder-img" style="background-image: url(' . $placeholder . ')"></div>';
        }
      
        echo get_the_post_thumbnail($image_id, $options['type'], array(
            'class' => 'feat-img-file'
        ));
      
        echo '</div><!-- .feat-img -->';
    }
}

// blog page
function blog_feat_img(array $custom = array())
{
    global $post;

    $defaults = array(
        'type' => 'full',
        'blur' => true,
        'classes' => array(),
      'id' => 0,
      'max_width' => '1300px'
    );

    $options = array_merge($defaults, $custom);
   
    $classes = count($options['classes']) === 0
      ? 'feat-img'
      : implode(" ", $options['classes']) . ' feat-img';

    $blog = get_option('page_for_posts');
   
    echo '<div class="' . $classes . '">';
    if (is_home() && $blog) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($blog), $options['type']);
        $image_small = wp_get_attachment_image_src(get_post_thumbnail_id($blog), 'thumbnail');
        $image_srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($blog), $options['type']);

        if ($options['blur']) {
            echo '<div class="bg-placeholder-img" style="background-image: url(' . $image_small[0] . ')"></div>';
        }
      
        echo '<img class="acf-img-file" src="' . $image[0] . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $options['max_width'] . ') 100vw, ' . $options['max_width'] . '" alt="">';
    }
    echo '</div><!-- .feat-img -->';
}

// category page
function category_feat_img($type_img = 'full', $blur = true)
{
    $fn = function_exists('category_image_src');
    $category_image = $fn ? category_image_src(array(
        'size' => $type_img
    ), false) : '';
    echo '<div class="feat-img">';
    if ($blur && $fn) {
        echo '<div class="bg-placeholder-img" style="background-image: url(' . category_image_src(array(
            'size' => 'thumbnail'
        ), false) . ')"></div>';
    }
   
    echo '<img class="feat-img-file" src="' . $category_image . '" alt="">';
    echo '</div><!-- .feat-img -->';
}

// advanced custom field image
function acf_image($field, array $custom = array())
{
    global $post;
   
    $defaults = array(
        'type' => 'full',
        'blur' => true,
        'classes' => array(),
      'max_width' => '1300px',
      'data' => array(),
      'placeholder' => null,
    );

    $options = array_merge($defaults, $custom);
   
    $image_id = gettype($field) === 'string' ? get_field($field, $post->ID) : $field;
  
    if ($image_id) {
        $image_src = wp_get_attachment_image_url($image_id, $options['type']);
        $image_srcset = wp_get_attachment_image_srcset($image_id, $options['type']);
      
        $classes  = count($options['classes']) === 0
         ? 'acf-image' :
         implode(" ", $options['classes']) . ' acf-image';
      
        $data_attr = '';
        if (count($options['data']) !== 0) {
            foreach ($options['data'] as $data => $val) {
                $data_attr .= 'data-'. $data .'="'. $val .'" ';
            }
        }

        $image_template = '<div class="'. $classes .'" '. $data_attr .'>';

        if ($options['blur']) {
            $placeholder = $options['placeholder'] ?? wp_get_attachment_image_url($image_id, 'thumbnail');
            $image_template .= '<div class="bg-placeholder-img" style="background-image: url(' . $placeholder . ')"></div>';
        }
      
        $image_template .= '<img class="acf-img-file" src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $options['max_width'] . ') 100vw, ' . $options['max_width'] . '" alt="">';

        $image_template .= '</div><!-- .acf-image -->';
      
        echo $image_template;
    }
}

/**
 *--------------------------------------------
 * Custom content markup
 */

function custom_content($content)
{
    // Remove empty paragraphs
    $content = force_balance_tags($content);
    $content = preg_replace('#<p>\s*+(<br\s*/*>)?\s* </p>#i', '', $content);
    $content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);

    // Unwrap Images from Paragraph Tags
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

    // custom images markup
    $img_regex = '/(<img.*?>)/s';
    $img_template = '<div class="post-img centered">$1</div>';

    $content = preg_replace($img_regex, $img_template, $content);

    $fig_regex = '/(<figure.*?>)/s';
    $fig_template = '<figure class="wp-caption">';

    $content = preg_replace($fig_regex, $fig_template, $content);

    return $content;
}

add_filter('the_content', 'custom_content', 20, 1);

/**
 *--------------------------------------------
 * Unwrap Images from Paragraph Tags on acf
 */

function acf_img_unwrap($value, $post_id, $field)
{
    $img_template = '</p><div class="post-img">$1</div><p>';

    $value = preg_replace('/(<img.*?>)/s', $img_template, $value);

    return $value;
}

add_filter('acf/load_value/type=wysiwyg', 'acf_img_unwrap', 10, 3);

/**
 * Custom excerpts
 */
function wpdocs_custom_excerpt_length($length)
{
    return 27;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

function wpdocs_excerpt_more($more)
{
    $more = (get_locale() == 'es_ES') ? 'Leer más' : 'Read more' ;

    return '&hellip; <span class="read-more">' . $more .'<b> ></b></span>' ;
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');
              

function excerpt($txt, $limit)
{
    $txt = limit_text($txt, $limit);

    return '<p>'. strip_tags($txt) .'&hellip;</p>' ;
}

/**
 * Get first paragraph from a give text. * * @return String
 */
function get_the_first_paragraph($txt='', $limit='', $hellip=false)
{
    global $post;
    $txt = ('' == $txt) ? get_the_content() : $txt;
    $str = wpautop($txt);
    $str = ('' != $limit && $limit> 0)
      ? limit_text($str, $limit)
      : substr($str, 0, strpos($str, '</p>') + 4);
    $str = strip_tags($str);

    return ($hellip)
      ? '<p>'. rtrim($str, '/[.,]/ \t\n') .'&hellip;</p>'
      : '<p>'. $str .'</p>';
}

function the_first_paragraph($txt = '', $limit = 0, $hellip = false)
{
    echo get_the_first_paragraph('', $limit, $hellip);
}

/**
 *
* limit text by words
*/
function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]);
    }

    return $text;
}

/**
*
* Simple category title
*/
function get_category_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_subcategory()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }

    return $title;
}


function is_subcategory($cat_id = null)
{
    if (!$cat_id) {
        $cat_id = get_query_var('cat');
    }

    return (bool) (get_category($cat_id)->category_parent > 0);
}

add_filter('get_the_archive_title', 'get_category_title');
/**
* Extend WordPress search to include custom fields
*
* https://adambalee.com
*
* Join posts and postmeta tables
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
*/
function cf_search_join($join)
{
    global $wpdb;
    if (is_search()) {
        $join .= ' LEFT JOIN '. $wpdb->postmeta .' ON '. $wpdb->posts .'.ID = '. $wpdb->postmeta .'.post_id ';
    }

    return $join;
}

add_filter('posts_join', 'cf_search_join');

/**
 * Modify the search query with posts_where
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
*
*/
function cf_search_where($where)
{
    global $pagenow, $wpdb;
    if (is_search()) {
        $where = preg_replace("/\(\s*" . $wpdb->posts .
".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(" . $wpdb->posts . ".post_title LIKE $1)
   OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
    }

    return $where;
}

add_filter('posts_where', 'cf_search_where');

/**
 * Prevent duplicates
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
*/
function cf_search_distinct($where)
{
    global $wpdb;
    if (is_search()) {
        return "DISTINCT";
    }

    return $where;
}

add_filter('posts_distinct', 'cf_search_distinct');


/**
 *--------------------------------------------
* Form builder
*
* @return DOM Element
*/
function build_form(array $f_options = array())
{
    $default_options = array(
      'form_id' => 'form',
      'form_action' => 'post',
      'form_class' => 'standard-form',
      'form_attr' => array(),
      'form_after' => null,
      'form_before' => null,
      'form_field' => 'form-field',
      'fields' => array(
         array(
            'type' => 'text',
            'name' => 'name',
            'class' => '',
            'label' => false,
            'placeholder' => 'Name',
            'container_class' => false
         ),
         array(
            'type' => 'email',
            'name' => 'email',
            'class' => '',
            'label' => false,
            'placeholder' => 'E-Mail',
            'container_class' => false
         ),
         array(
            'type' => 'textarea',
            'name' => 'message',
            'class' => '',
            'label' => false,
            'placeholder' => 'Message',
            'container_class' => false
         )
      ),
      'field_container' => false,
      'required' => true,
      'submit_value' => 'Send',
      'submit_class' => 'form-submit',
      'submit_content_after' => false,
      'submit_content_before' => false
   );

    $options = array_merge($default_options, $f_options);

    if (count($options['form_attr']) > 0) {
        $form_attr = 'data-ajax="'. admin_url('admin-ajax.php') .'" ';

        foreach ($options['form_attr'] as $attr => $val) {
            $form_attr .= $attr .'="'. $val .'"';
        }
    }

    $form = '<form id="' . $options['form_id'] .'" action="'. $options['form_action'] .'"
      class="'. $options['form_class'] .'"'. $form_attr .'>';

    if ($options['form_before']) {
        $form .= $options['form_before'];
    }

    foreach ($options['fields'] as $field) {
        $input_field = '';

        if ($options['field_container']) {
            $input_field .= '<div class="field-container '. $options['field_container'] . $field['container_class'] .'">';
        }

        if ($field['label']) {
            $input_field .= '<label for="'. $field['name'] .'">'. $field['label'] .'</label>';
        }
     
        if ($field['type'] == 'textarea') {
            $input_field .= '<textarea ';
        } elseif ($field['type'] == 'select') {
            $input_field .= '<select ';
        } else {
            $input_field .= ' <input type="'. $field['type'] .'"';
        }
      
        $input_field .= ' id="'. $field['name'] .'"';
        $input_field .= ' name="'. $field['name'] .'"';
        if ($field['type'] == 'textarea') {
            $field['class'] .= 'textarea';
        }
        $input_field .= ' class="'. $options['form_field'] .' '. $field['class'] .'"';

        if ($field['placeholder']) {
            $input_field .=' placeholder="' . $field['placeholder'] . '"';
        }

        if ($options['required']) {
            $input_field .=' required';
        }

        if ($field['type'] == 'textarea') {
            $input_field .= '></textarea>';
        } elseif ($field['type'] == 'select') {
            $input_field .= '>';

            foreach ($field['options'] as $option_tag) {
                $disabled = $option_tag['disabled'] ? 'disabled' : '';
                $selected = $option_tag['selected'] ? 'selected' : '';
                $input_field .= $option_tag['value']
                    ? '<option value="'. $option_tag['value'] .'"'. $disabled .' '. $selected .'>'
                    : '<option value=""'. $disabled .' '. $selected .'>';
                $input_field .= $option_tag['text'];
                $input_field .= '</option>';
            }

            $input_field .= '</select>';
        } else {
            $input_field .= '/>';
        }
      
        if ($options['field_container']) {
            $input_field .='</div><!-- .field-container -->';
        }
      
        $form .= $input_field;
    }

    $form .='<input class="human" type="text" tabindex="-1" style="background:transparent;border:none;height:0;pointer-events:none;visibility:hidden;width:0;"/>';

    $form .='<button type="submit" class="submit '. $options['submit_class'] .'" >';
    if ($options['submit_content_after']) {
        $form .= $options['submit_content_after'];
    }
    $form .= '<span>'. $options['submit_value']  .'</span>';
    if ($options['submit_content_before']) {
        $form .= $options['submit_content_before'];
    }
    $form .= '</button>';
   
    if ($options['form_after']) {
        $form .= $options['form_after'];
    }

    $form .='</form><!-- #'. $options['form_id'] .' -->';

    echo $form;
}
//--------------------------------------------------------------
/**
 * Ajax Email function
 */

// define the wp_mail_failed callback
function action_wp_mail_failed($wp_error)
{
    return error_log(print_r($wp_error, true));
}
//add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);

// submit form
function submit_form()
{
    $data = $_POST;
    //
    $name = $data['name'];
    $email = $data['email'];
    $message = $data['message'];
    //
    $primary_color = '#009fe3';
    $secondary_color = '#00e6ff';
    $text_color = '#000b0c';
    $host_domain = $_SERVER['SERVER_NAME'];
    //
    //--------------------------------------------------------
    $dest = isset($data['dest']) ? $data['dest'] : 'penhold3r@gmail.com';
    //
    $headers = "From: $name <$email>\r\n";
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    //
    $subject = "Mensaje de contacto de ".$name." desde ". $host_domain;
    //
    $body = '<div style="font-size:18px; font-family:sans-serif; background:#EEE; padding: 0px 0px 20px;">';
    $body .= '<h2 style="background:'.$primary_color.'; color:#FFFFFF; padding:10px; margin: 0; text-transform:uppercase">Mensaje de contacto</h2>';
    $body .= '<p style="color:'.$text_color.'; padding: 0px 10px;">';
    $body .= '<span style="font-size:14px; letter-spacing:0.05em; text-transform:uppercase">Nombre:</span> <strong>'.$name.'</strong><br>';
    $body .= '<span style="font-size:14px; letter-spacing:0.05em; text-transform:uppercase">Email:</span> <em>'.$email.'</em><br>';
    $body .= '</p>';
    if ($message != '') {
        $body .= '<p style="color:'.$text_color.'; padding: 0px 10px; border-top:#DDD"><span style="font-size:14px; letter-spacing:0.05em; text-decoration: underline; text-transform:uppercase">Mensaje:</span><br/>'.$message.'</p>';
    }
    $body .= '</div>';


    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug   = 0; //SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host        = 'c1700663.ferozo.com';
        $mail->Port        = 465;
        $mail->SMTPSecure  = 'ssl';
        $mail->SMTPAuth    = true;
        $mail->Username    = 'no-reply@buildup.com.ar';
        $mail->Password    = '1BgKvh@ypV';

        $mail->setFrom($email, $name);
      
        foreach (explode(',', $dest) as $dir) {
            $mail->addAddress(trim(preg_replace('/\s+/', ' ', $dir)));
        }
      
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $message != '' ? $message : $subject . ' email: '. $email;
      
        $mail->CharSet = 'UTF-8';

        $mail->send();

        echo json_encode(array(
              'success' => true,
              'data' => $data
           ));
    } catch (Exception $e) {
        echo json_encode(array(
           'success' => false,
           'data' => $data,
           'error' => $e,
           'phpMailError' => $mail->ErrorInfo
        ));
    }
   
    die();
}

add_action('wp_ajax_submit_form', 'submit_form');
add_action('wp_ajax_nopriv_submit_form', 'submit_form');

// ajax test
function test_func()
{
    echo json_encode($_POST);
    die();
}
add_action('wp_ajax_test_func', 'test_func');
add_action('wp_ajax_nopriv_test_func', 'test_func');


//--------------------------------------------------------------
/**
 * Link to go back in browsser history
 */

function go_back_link($content, array $classes=array())
{
    $classes = count($classes) === 0
      ? 'go-back-link'
      : implode(" ", $classes) . ' go-back-link' ;
    $previous = "javascript:history.go(-1)";
   
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous=$_SERVER['HTTP_REFERER'];
    }

    return '<a href="' . $previous .'" class="'. $classes .'">'. $content . '</a>';
}
//--------------------------------------------------------------
/**
 * create custom post type
 */
function ph_create_custom_post_types($post_types)
{
    add_action('init', function () {
        global $post_types;
      
        if ($post_types) {
            foreach ($post_types as $cpt) {
                $cpt['position'] = array_search($cpt, $post_types) + 5;
                create_custom_post_type($cpt);
            }
        }
    }, 0);
}

function create_custom_post_type(array $args = array())
{
    $defaults = array(
        'singular_name'      => 'Custom Post',
        'general_name'       => 'Custom Posts',
        'slug'               => null,
        'position'           => 0,
        'description'        => '',
        'menu_icon'           => 'dashicons-admin-post'
    );

    $options = array_merge($defaults, $args);

    $theme_name = get_theme_text_domain();
 
    $labels = array(
        'name'                => _x($options['general_name'], 'Post Type General Name', $theme_name),
        'singular_name'       => _x($options['singular_name'], 'Post Type Singular Name', $theme_name),
        'menu_name'           => __($options['general_name'], $theme_name),
        'parent_item_colon'   => __('Post Superior', $theme_name),
        'all_items'           => __('Todos los Posts', $theme_name),
        'view_item'           => __('Ver Post', $theme_name),
        'add_new_item'        => __('Añadir nuevo Post', $theme_name),
        'add_new'             => __('Añadir nuevo', $theme_name),
        'edit_item'           => __('Editar Post', $theme_name),
        'update_item'         => __('Actualizar Post', $theme_name),
        'search_items'        => __('Buscar Post', $theme_name),
        'not_found'           => __('No se encontró', $theme_name),
        'not_found_in_trash'  => __('No se encontró en la Papelera', $theme_name),
    );
        
    $args = array(
        'label'               => __($options['general_name'], $theme_name),
        'description'         => __($options['description'], $theme_name),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields'),
        'taxonomies'          => array( 'category' ),
        'public'             => true,
        'show_in_rest'       => true,
        'menu_position'      => $options['position'],
        'menu_icon'          => $options['menu_icon'],
        'has_archive'        => true,
    );

    $custom_post_type_name = $options['slug']
      ? $options['slug']
      : sanitize_title($options['singular_name']);

    register_post_type($custom_post_type_name, $args);
}
//--------------------------------------------------------------
/**
 * create custom taxonomy
 */

function create_custom_taxonomy(array $args = array())
{
    $defaults = array(
        'singular_name'      => 'Custom Taxonomy',
      'general_name'       => 'Custom Taxonomies',
      'post_type'          => 'post'
   );

    $options = array_merge($defaults, $args);
   
    $options['slug'] = strtolower(
        trim(
            preg_replace(
                '/[^A-Za-z0-9-]+/',
                '-',
                $options['singular_name']
            ),
            '-'
        )
    );

    $labels = array(
      'name' => _x($options['general_name'], 'taxonomy general name'),
      'singular_name' => _x($options['singular_name'], 'taxonomy singular name'),
      'search_items' =>  __('Search '.$options['general_name']),
      'all_items' => __('All '.$options['general_name']),
      'parent_item' => __('Parent '.$options['singular_name']),
      'parent_item_colon' => __('Parent '.$options['singular_name'].':'),
      'edit_item' => __('Edit '.$options['singular_name']),
      'update_item' => __('Update '.$options['singular_name']),
      'add_new_item' => __('Add New '.$options['singular_name']),
      'new_item_name' => __('New '.$options['singular_name'].' Name'),
      'menu_name' => __($options['general_name']),
   );
   
    register_taxonomy(
        $options['slug'],
        array($options['post_type']),
        array(
         'hierarchical' => true,
         'labels' => $labels,
         'show_ui' => true,
         'show_admin_column' => true,
         'query_var' => true,
         'rewrite' => array( 'slug' => $options['slug'] ),
      )
    );
}
