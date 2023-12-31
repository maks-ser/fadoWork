<?php
if (!function_exists('theme_sp_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function theme_sp_setup()
  {

    // Add default posts and comments RSS feed links to head.
//    add_theme_support('automatic-feed-links');

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
//    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
//    register_nav_menus(array(
//      'nav-main' => 'Главное меню',
//    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

  }
endif;
add_action('after_setup_theme', 'theme_sp_setup');



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_sp_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html__('Sidebar', 'theme-sp'),
    'id' => 'sidebar-1',
    'description' => esc_html__('Add widgets here.', 'theme-sp'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
}

//add_action('widgets_init', 'theme_sp_widgets_init');
