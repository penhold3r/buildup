<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

class BUP_Social_Widget extends WP_Widget
{

   // setup...
    public function __construct()
    {
        parent::__construct(
            'bup_social',
            'Redes Sociales',
            array(
            'classname' => 'socialmedia-widget',
            'description' => 'Links a redes sociales'
         )
        );
    }

    // back-end
    public function form($instance)
    {
        echo '<p><em>Links a email y redes sociales al pie de la página:</em></p>';
    }

    // front-end
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        // widget ID with prefix for use in ACF API functions
        $widget_id = 'widget_' . $args['widget_id'];

        echo $args['before_widget']; ?>

<a href="mailto:<?php the_field('footer_email', $widget_id) ?>"
   class="email-link">
   <?php the_field('footer_email', $widget_id) ?>
</a>

<?php

        foreach (get_field('social_options', $widget_id) as $field):
      ?>

<div class="social-link">
   <a href="<?php the_field($field['value'], $widget_id) ?>"
      class="link <?php echo $field['value'] ?>"
      title="<?php echo $field['label'] ?>">
      <i
         class="icon icon-<?php echo $field['value'] ?>"></i>
   </a>
</div>

<?php
         
      endforeach;

        the_custom_logo();
      
        echo $args['after_widget'];
    }
}

function bup_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Footer', 'build_up'),
            'id'            => 'footer',
            'description'   => esc_html__('Añadir widgets aquí.', 'build_up'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
   
    register_widget('BUP_Social_Widget');
}
add_action('widgets_init', 'bup_widgets_init');
