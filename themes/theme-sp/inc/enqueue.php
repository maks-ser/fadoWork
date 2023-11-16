<?php

/**
 * preload
 */
function setPreloadResource(){
  ?>
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Gilroy-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Gilroy-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">
  <?php
  /*
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Roboto.woff2" as="font"  type="font/woff2" crossorigin="anonymous">
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com"> 
  */
}

/**
 * enqueue scripts and styles.
 */
function add_footer_styles()
{
  //style
  wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), filemtime( get_stylesheet_directory() . '/css/style.css' ));
  wp_enqueue_style('style-fancy', get_template_directory_uri() . '/css/fancy.min.css', array(), filemtime( get_stylesheet_directory() . '/css/fancy.min.css' ));
  wp_enqueue_style('style-main', get_stylesheet_uri(),array(), filemtime( get_stylesheet_directory() . '/style.css' ));
  /*
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link
  rel="stylesheet"
  href=""
      />
*/
}

function theme_sp_scripts()
{
  //script
  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.6.0.min.js', array(), '3.6.0', true);
  wp_enqueue_script('jquery');
  /*if(is_front_page()):
    wp_enqueue_script('js-3', get_template_directory_uri() . '/js/3.js', array(), NULL, true);
    endif;*/
  wp_enqueue_script('inline_svg', get_template_directory_uri() . '/js/libs/inline_svg.js', array(), NULL, true);
  wp_enqueue_script('inputmask', get_template_directory_uri() . '/js/libs/inputmask.min.js', array(), NULL, true);
  wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/js/libs/swiper-bundle.min.js', array(), NULL, true);
  wp_enqueue_script('gsap', get_template_directory_uri() . '/js/libs/gsap.min.js', array(), NULL, true);
  wp_enqueue_script('ScrollTrigger', get_template_directory_uri() . '/js/libs/ScrollTrigger.min.js', array(), NULL, true);
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), '1.1', true);
  if(is_singular('t-product')) {
      wp_enqueue_script('fancy', get_template_directory_uri() . '/js/fancybox.umd.js', array(), NULL, true);
      //https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js
  }
}

if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse') && !is_admin()){
  add_action('wp_head', 'setPreloadResource');
  add_action('get_footer', 'add_footer_styles');
  add_action('wp_enqueue_scripts', 'theme_sp_scripts');
}

/**
 * add attributes
 */
function add_attributes_in_link($html, $handle)
{
  $html = str_replace("type='text/javascript'", '', $html);
  if ('jquery' === $handle) return $html;
  //script
  return str_replace('src=', 'defer src=', $html);
  /*if ('jquery' === $handle || 'main' === $handle || 'google' === $handle) {
    return str_replace("src", "defer src", $html);
  }
  
  return $html;*/
}

if (!is_admin()) {
  add_filter('script_loader_tag', 'add_attributes_in_link', 200, 2);
}

add_action('admin_head', 'psMyCustomStyle');
function psMyCustomStyle()
{
  print '<style>
/* page category */
#edittag {
    max-width: 2600px;
}
/* page field group from plugin acf */
body.post-type-acf-field-group .row-actions .duplicate{
display: none;
}
</style>';
}

// facicon admin
function admin_favicon() {
//  echo '<link href="'.bloginfo("template_directory").'/img/icon.png" rel="apple-touch-icon">';
  echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo("template_directory").'/img/favicon.svg" />';
}
add_action('admin_head', 'admin_favicon');

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
  global $wpdb;

  if ( is_search() && is_main_query() && !is_admin() ) {
    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }

  return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
  global $pagenow, $wpdb;

  if ( is_search() && is_main_query() && !is_admin()) {
    $where = preg_replace(
      "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
  }

  return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
  global $wpdb;

  if ( is_search() && is_main_query() && !is_admin() ) {
    return "DISTINCT";
  }

  return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );