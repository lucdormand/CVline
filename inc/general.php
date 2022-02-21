<?php

/**
 * Projet CVtheques functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Projet_CVtheques
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function projet_cvtheques_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Projet CVtheques, use a find and replace
        * to change 'projet-cvtheques' to the name of your theme in all the template files.
        */
    load_theme_textdomain('projet-cvtheques', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'projet-cvtheques'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'projet_cvtheques_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'projet_cvtheques_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function projet_cvtheques_content_width()
{
    $GLOBALS['content_width'] = apply_filters('projet_cvtheques_content_width', 640);
}
add_action('after_setup_theme', 'projet_cvtheques_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function projet_cvtheques_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'projet-cvtheques'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'projet-cvtheques'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'projet_cvtheques_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function projet_cvtheques_scripts()
{

    wp_enqueue_style('projet-cvtheques-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '1.0.0');

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true);




    wp_enqueue_script('todo-skill', get_template_directory_uri() . '/asset/js/todo-skill.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('todo-hobbies', get_template_directory_uri() . '/asset/js/todo-hobbies.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-generatecv', get_template_directory_uri() . '/asset/js/ajax-generatecv.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-experience', get_template_directory_uri() . '/asset/js/ajax-experience.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-skill', get_template_directory_uri() . '/asset/js/ajax-skill.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-hobbie', get_template_directory_uri() . '/asset/js/ajax-hobbie.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-school', get_template_directory_uri() . '/asset/js/ajax-school.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('ajax-final', get_template_directory_uri() . '/asset/js/ajax-final.js', array('jquery'), _S_VERSION, true);


    wp_add_inline_script('ajax-generatecv', 'const ajaxUrl = ' . json_encode(admin_url('admin-ajax.php')), 'before');


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'projet_cvtheques_scripts');

function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/asset/img/logoCVline.svg);
            width: 100%;
            background-repeat: no-repeat;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

function my_custom_login()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/asset/sass/pages/login.scss" />';
}
add_action('login_head', 'my_custom_login');
