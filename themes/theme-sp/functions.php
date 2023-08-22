<?php
@ini_set( 'max_input_vars' , 15000);
@ini_set( 'upload_max_size' , '512M' );
@ini_set( 'post_max_size', '512M');

  /**
   * @package theme-sp
   */
  
  /**
   * support
   */
  require get_template_directory() . '/inc/support.php';
  
  /**
   * enqueue
   */
  require get_template_directory() . '/inc/enqueue.php';
  
  /**
   * extensions
   */
  require get_template_directory() . '/inc/extensions.php';
  
  /**
   * taxonomy
   */
  require get_template_directory() . '/inc/taxonomy.php';
  
  /**
   * clean
   */
  require get_template_directory() . '/inc/clean.php';

  /**
   * cat
   */
  require get_template_directory() . '/inc/cat.php';

  /**
   * seo
   */
  require get_template_directory() . '/inc/seo.php';

  //mx
if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    if($current_user->ID === 4) {
        show_admin_bar( false );
    }
}