<?php

// redirect 301 url Uppercase to lowercase + get parameters remain
class WPForceLowercaseURLs
{
  /**
   * Initialize plugin
   */
  public static function init()
  {
    // If page is non-admin, force lowercase URLs
    if (!is_admin()) {
      add_action('init', ['WPForceLowercaseURLs', 'toLower']);
    }
  }

  /**
   * Changes the requested URL to lowercase and redirects if modified
   */
  public static function toLower()
  {

    // Grab requested URL
    $url = $_SERVER['REQUEST_URI'];
    $params = $_SERVER['QUERY_STRING'];

    // If URL contains a period, halt (likely contains a filename and filenames are case specific)
    if (preg_match('/[\.]/', $url)) {
      return;
    }
    // If URL contains a capital letter
    if (preg_match('/[A-Z]/', $url)) {
      // Convert URL to lowercase
      $lc_url = empty($params)
        ? strtolower($url)
        : strtolower(substr($url, 0, strrpos($url, '?'))) . '?' . $params;

      // if url was modified, re-direct
      if ($lc_url !== $url) {

        // 301 redirect to new lowercase URL
        header('Location: ' . $lc_url, true, 301);
        exit();
      }
    }
  }
}

WPForceLowercaseURLs::init();

// Hiding the page of the author's archive page
if (!is_admin()) {
  add_filter('pre_handle_404', 'remove_author_pages_page');
  add_filter('author_link', 'remove_author_pages_link');

  // set 404 status
  function remove_author_pages_page($false)
  {
    if (is_author()) {
      global $wp_query;
      $wp_query->set_404();
      status_header(404);
      nocache_headers();

      return true; // to break the hook
    }

    return $false;
  }

  // remove the link
  function remove_author_pages_link($content)
  {
    return home_url();
  }
}

/**
 * get primary category
 * $post_categories = get_post_primary_category($id, 'category');
 * $primary_category = $post_categories['primary_category'];
 * echo $primary_category->name;
 */
function get_post_primary_category($post_id, $term = 'category')
{
  $return = [];

  if (class_exists('WPSEO_Primary_Term')) {
    // Show Primary category by Yoast if it is enabled & set
    $wpseo_primary_term = new WPSEO_Primary_Term($term, $post_id);
    $primary_term = get_term($wpseo_primary_term->get_primary_term());

    if (!is_wp_error($primary_term)) {
      $return['primary_category'] = $primary_term;
    }
  }
  return $return;
}